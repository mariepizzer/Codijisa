<?php
if (sizeof($datos)>0)
{   
    ?>
    <div class="col-xs-12">
    <?php 
        foreach ($datos as $resultado) {
            ?>
            <div draggable="true" ondragstart="drag(event)" id="<?php echo $resultado['Tipo'].'_'.$resultado['Id'];?>" class="plato_o_ingrediente col-xs-6 col-sm-3 resultado_<?php echo $resultado['Tipo'];?>">
                <span class="Nombre"><?php echo $resultado['Nombre'];?> </span><span class="borrar"><a href="<?php echo base_url();?>semana/plato/<?php echo $resultado['Id'];?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></span><span class="borrar"><a href="#" onclick="retirar_plato_o_ingrediente('<?php echo $resultado['Tipo'].'_'.$resultado['Id'];?>');">x</a></span>
                <p class="Tipo" style="display:none;"><?php echo $resultado['Tipo'];?></p>
                <p class="Id" style="display:none;"><?php echo $resultado['Id'];?></p>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
else
{
    imprimir_mensaje("No se encontró resultados de platos o ingrediente.",'advertencia');
}
?>


<!-- agregar id a plato e ingrediente , con todos los cambios q requiera. retirar_plato_o_ingrediente(id, tipo) -->