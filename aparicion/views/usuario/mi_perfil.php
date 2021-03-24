<div class="col-xs-12">
    <div class="panel-heading input-group">
        <input id="cliente_a_buscar2" name="cliente_a_buscar2" autofocus type="text" class="form-control control_grande" placeholder="Buscar cliente...">
        <span class="input-group-btn">
                <button class="btn btn-default control_grande" type="submit" type="button" id="botonbuscarCliente" onclick="buscar_cliente($('#cliente_a_buscar2').val());">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </button>
            </span>
        <span class="input-group-btn">
            <button class="btn btn-default control_grande" type="submit" type="button" id="botonLimpiarBuscador" onclick="limpiarBuscador();"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        </span>
        <select  class="form-control control_grande" name="Zona" id="Zona" >
            <option value=""></option>
            <option value="Monday">Lunes</option>
            <option value="Tuesday">Martes</option>
            <option value="Wednesday">Miércoles</option>
            <option value="Thursday">Jueves</option>
            <option value="Friday">Viernes</option>
            <option value="Saturday">Sábado</option>
        </select>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div id="resultado"></div>
</div>
<div class="clearfix"></div>

<div class="col-xs-12" id="metas" style="width:auto;">  
    <?php
        if (sizeof($metas)>0)
        {   
            foreach ($metas as $meta) {
              if($meta['Mostrar']==1){
                if($meta['Tipo']=='COBERTURA')
                    {
                    ?>  
                    <div class="col-md-2 col-xs-6">
                        <div class="meter orange nostripes">
                            <?php $hola= $meta['Avance_Cobertura']*100/$meta['Objetivo'];?>
                            <a style="color:black;" href="meta/detalles/<?php echo $meta['idMETA']; ?>"><?php echo $meta['Nombre'];?> - <span style="color:blue;font-weight:bold;"><?php echo floor($hola);?>%</span></a>
                            <span style="<?php if($hola>=100) echo 'background-color:red;color:white;'; else if($hola<100 && $hola>=80) echo 'background-color:orange;color:white;'; else echo 'color:blue;'?> width: <?php echo $hola;?>%"><?php echo $meta['Avance_Cobertura'];?>/<?php echo $meta['Objetivo'];?></span>
                        </div>
                    </div>
                    
                    <?php
                    }
                  if($meta['Tipo']=='VOLUMEN')
                    {
                    ?>  
                    <div class="col-md-2 col-xs-6">
                        <div class="meter orange nostripes">
                            <?php 
                            $hola= $meta['Avance_Volumen']*100/($meta['Volumen']);
                            ?>
                            <a style="color:black;" href="meta/detalles/<?php echo $meta['idMETA']; ?>">
                              <?php echo $meta['Nombre'];?> - <span style="font-weight:bold;"><?php echo floor($hola);?>%</span>
                            </a>
                            <span style="<?php if($hola>=100) echo 'background-color:red;color:white;'; else if($hola<100 && $hola>=80) echo 'background-color:orange;color:white;'; else echo 'color:blue;'?>width: <?php echo $hola;?>%"><?php echo round($meta['Avance_Volumen'],1);?>/<?php echo ($meta['Volumen']);?></span>
                        </div>
                    </div>
                    
                    <?php
                    }
                }
            }
        }
    ?>
</div>

<script type="text/javascript">

    $("#cliente_a_buscar2").keyup(function(event){
        if(event.keyCode == 13){
            $("#botonbuscarCliente").click();
        }
    });

    $(function() {
      $(".meter > span").each(function() {
        var relativePercentage = ($(this).width()/$(this).parent('div').width())*100;
        if(relativePercentage>100){
          relativePercentage=100;
        }
          
        $(this)
            .data("origWidth", $(this).width())
            .width(0)
            .animate({
                width: relativePercentage + '%'
            }, 800);
      });

      
        console.log("HOLAAA");

        $('#Zona').change(function()
            {

            Zona = $('#Zona').find(":selected").val();


            $("#metas").hide().fadeIn("Fast");
            $("#resultado").html("");
            $("#botonbuscarCliente > span").addClass('glyphicon-refresh-animate');
          
            url="cliente/BuscarPorZona";
            $.ajax({
                async:false,
                cache:false,
                url: VariablesPHP.base_url+url,
                type: 'POST',
                dataType: 'html',
                data: {
                    Zona: Zona,
                },
            })
            .done(function(html) {

                $("#metas").html("").fadeOut("Fast");
                $("#botonbuscarCliente > span").removeClass("glyphicon-refresh-animate");
                $("#resultado").html(html).fadeIn("Fast");
            })
            .fail(function() {
                console.log("Error fail BuscarPorZona ");
            });
          });
    });

    
</script>

<style>
    .meter {
        position: relative;
        margin:5px 0 5px 4px;
        background: #dcd4d4;
        padding: 8px;
        -webkit-box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);
        -moz-box-shadow   : inset 0 -1px 1px rgba(255,255,255,0.3);
        box-shadow        : inset 0 -1px 1px rgba(255,255,255,0.3);
        font-size: 110%;
    }
    .meter > span {
        display: block;        
        background-color: #29ee5d;
        position: relative;
        overflow: visible;
    }
    .meter > span:after, .animate > span > span {
        content: "";
        position: absolute;
        top: 0; left: 0; bottom: 0; right: 0;
        z-index: 1;
        -webkit-background-size: 50px 50px;
        -moz-background-size: 50px 50px;
        background-size: 50px 50px;
        overflow: hidden;
    }

    .animate > span:after {
        display: none;
    }

    @-webkit-keyframes move {
        0% {
           background-position: 0 0;
        }
        100% {
           background-position: 50px 50px;
        }
    }

    @-moz-keyframes move {
        0% {
           background-position: 0 0;
        }
        100% {
           background-position: 50px 50px;
        }
    }
</style>
