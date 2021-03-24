<?php
if (sizeof($datos_cliente)==0)
{   
    imprimir_mensaje("No se encontró cliente.",'advertencia');
}
else{ 
    ?>
    <div class="col-xs-12 datos_clientes" >
        <div class="col-sm-6">
            <h4 ><?php echo $datos_cliente['id'];?> - <?php echo $datos_cliente['nombre'];?> <a href="<?php echo base_url().'cliente/'.$datos_cliente['id'];?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
            </h4>
        </div>
        <div class="col-sm-6">
        
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-earphone"></span></span>
                <input class="form-control" id="Celular" name="Celular" value="<?php echo $datos_cliente['celular']; ?>" type="text" Placeholder='9XXXXXXXX' aria-describedby="basic-addon1">
                <div class="input-group-btn">
                    <button id="botonCelular" class="btn btn-info control_mediano" type="submit" type="button" onclick="guardar_celular(<?php echo $datos_cliente['id'];?>)">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

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
            </div>
       </div>
       <div class="col-xs-12" id="metas">
            <?php
                if (sizeof($metas)>0)
                {   
                    foreach ($metas as $meta) {
                        if($meta['Mostrar']==1){
                        ?>
                            <div id="meta_<?php echo $meta['idMETA']; ?>" class='col-sm-2 meta <?php if($meta['Coberturado']) echo "coberturado"; ?>' style="<?php if($meta['Porcentaje']>=80 && $meta['Porcentaje']<100) echo 'background-color:orange;color:white;';?>" >
                                <a style="<?php if($meta['Porcentaje']>=80 && $meta['Porcentaje']<100) echo 'color:#252323;'; else if($meta['Porcentaje']>=100) echo 'color:#252323;';else echo 'color:#252323;'; ?>;" href="<?php echo base_url().'meta/detalles/'.$meta['idMETA'];?>"><?php echo $meta['Nombre'];?></a>
                            </div>
                        
                        <?php
                        }
                    }
                }
            ?>
        </div>
        <div class="col-xs-12" id="resultado"></div>
    <?php
   
}
?>

<script type="text/javascript">

     $("#cliente_a_buscar2").keyup(function(event){
        if(event.keyCode == 13){
            $("#botonbuscarCliente").click();
        }
    });

var Celular = document.getElementById("Celular");

Celular.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("botonCelular").click();
  }else{
    cambiar_color();
  }
  
});

function cambiar_color(){

    if ( document.getElementById("botonCelular").classList.contains('btn-info')){
        document.getElementById("botonCelular").classList.remove('btn-info');
        document.getElementById("botonCelular").classList.add('btn-warning');
    }
    if ( document.getElementById("botonCelular").classList.contains('btn-success')){
        document.getElementById("botonCelular").classList.remove('btn-success');
        document.getElementById("botonCelular").classList.add('btn-warning');
    }
}
</script>
