<?php
if (sizeof($ingredientes)>0)
{   
    ?>
    <div class="" id="mamita" style="padding-left:0px; margin-left:0px;">
        <h3 style="text-align:center;">Ingredientes <button class="btn btn-default" type="button" onclick="ocultar_numeros();"><span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></button></h3> 
    <?php 

    $bandera = 1;
    while ($ingrediente_actual = current($ingredientes) )
    {
        $siguiente = next($ingredientes);

        if($bandera ==1 ){
            $bandera = 0;
                ?>
                <div class='clearfix'></div>
                <div class="categoria">
                    <button class="btn btn-default " type="button" id="boton<?php echo $ingrediente_actual['Categoria']; ?>" >
                        <?php if($ingrediente_actual['Categoria']=='') echo "Sin Categoría"; else echo $ingrediente_actual['Categoria']; ?>
                    </button>
                </div>
                <div class='clearfix'></div>
                <?php 
        }
        ?>

        <div class="row">
            <div class="col-xs-6" style="padding-right:0px; margin-right:0px;">
                <div class="input-group">
                    <input id="ingrediente_<?php echo $ingrediente_actual['idIngrediente'];?>" readonly type="text" class="form-control <?php if($ingrediente_actual['Mostrar']==1) echo 'ingrediente_activo'; else echo 'ingrediente_no_activo'?>" placeholder="<?php echo $ingrediente_actual['Nombre'];?>" value="<?php echo $ingrediente_actual['Nombre'];?>" >
                    <span class="input-group-addon">
                        <input type="checkbox" aria-label="..." class="ingrediente" name="<?php echo $ingrediente_actual['idIngrediente'];?>" id="<?php echo $ingrediente_actual['idIngrediente'];?>" <?php if($ingrediente_actual['Mostrar']==1) echo "checked";?> >
                    </span>
                </div>
            </div>
            <div class="col-xs-6" style="padding-left:0px; margin-left:0px;" >
                <div class="input-group">
                    <input aria-describedby="basic-addon1" type="text" class="form-control comentario <?php if($ingrediente_actual['Mostrar']==1) echo 'ingrediente_activo'; else echo 'ingrediente_no_activo'?>" name="comentario_<?php echo $ingrediente_actual['idIngrediente'];?>" id="comentario_<?php echo $ingrediente_actual['idIngrediente'];?>" value="<?php echo $ingrediente_actual['Comentario'];?>">
                    <span id="basic-addon1" class="input-group-addon basic-addon1 <?php 
                        if($ingrediente_actual['Nro_platos']==1) 
                            echo "ingrediente_poco";
                        else{
                            if($ingrediente_actual['Nro_platos']>=2 && $ingrediente_actual['Nro_platos']<=4) 
                                echo "ingrediente_medio";
                            else if($ingrediente_actual['Nro_platos']>4) 
                                echo "ingrediente_mucho";
                        } 
                        if($ingrediente_actual['Mostrar']==0)  echo ' opaco'?>"><?php echo $ingrediente_actual['Nro_platos']; ?>
                    </span>   
                </div>
            </div><!-- /.col-lg-6 -->
        </div>
        <?php
        if (false !== $siguiente &&  $siguiente['Categoria'] != $ingrediente_actual['Categoria'])
        {
            ?>
            <div class='clearfix' style="padding-bottom: 20px;"></div>
            <div class="categoria">
                <button class="btn btn-default " type="button" id="boton<?php echo $siguiente['Categoria']; ?>" >
                    <?php echo $siguiente['Categoria'];?>
                </button>
            </div>
            <div class='clearfix'></div>
            <?php
        }
    }
    ?>
    </div>
    <?php  }   else  { }  ?>

<script type="text/javascript">
    $(function()
        {
        $('input.ingrediente').change(function()
            {
            NuevoEstado = $(this).is(':checked');
            idIngrediente = $(this).attr('id');

            url="semana/cambiarEstadoIngrediente";
            $.ajax({
                async:false,
                cache:false,
                url: VariablesPHP.base_url+url,
                type: 'POST',
                dataType: 'html',
                data: {
                    NuevoEstado: NuevoEstado,
                    idIngrediente: idIngrediente,
                },
            })
            .done(function(html) {
                //console.log("cambiarEstadoIngrediente!!!");
                if(NuevoEstado==0){
                    $('#ingrediente_'+idIngrediente).css( "color", "#dcdcdc" );
                    $('#comentario_'+idIngrediente).removeClass("ingrediente_activo");
                    $('#comentario_'+idIngrediente).addClass("ingrediente_no_activo");
                    $('#comentario_'+idIngrediente).next().addClass("opaco");
                }
                if(NuevoEstado==1){
                    $('#ingrediente_'+idIngrediente).css( "color", "black" );
                    $('#comentario_'+idIngrediente).removeClass("ingrediente_no_activo");
                    $('#comentario_'+idIngrediente).addClass("ingrediente_activo");
                    $('#comentario_'+idIngrediente).next().removeClass("opaco");
                }
            })
            .fail(function() {
                console.log("Error fail cambiarEstadoIngrediente ");
            });
          });

        $('input.comentario').change(function()
            {
            nuevoComentario = $(this).val();
            idIngrediente = $(this).attr('id').split('_')[1];
            
            url="semana/cambiarComentario";
            $.ajax({
                async:false,
                cache:false,
                url: VariablesPHP.base_url+url,
                type: 'POST',
                dataType: 'html',
                data: {
                    nuevoComentario: nuevoComentario,
                    idIngrediente: idIngrediente,
                },
            })
            .done(function(html) {
                //console.log("cambiarComentario!!!");
            })
            .fail(function() {
                console.log("Error fail cambiarComentario ");
            });
          });

        });
</script>