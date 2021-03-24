<?php
if (sizeof($datos_productos)>0)
{   
    ?>
    <div class="col-xs-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-star" aria-hidden="true"></span> <?php echo $titulo; ?>
            </div>
            <table class="table table-striped table-responsive">
                <thead>
                    <tr class="info">
                        <th>Nombre</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($datos_productos as $producto) {
                        ?>
                        <tr>
                            <td><strong><a href="<?php echo base_url().'producto/'.$producto['id'];?>"><?php echo $producto['marca'] . ': ' .$producto['nombre'];?></a></strong></td>
                            <td><a href="<?php echo base_url().'producto/'.$producto['id'];?>"><img src="<?php echo asset_url()."img/productos/".$producto['imagen'].".jpg";?>" style="width:80px;"></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}
else
{
    imprimir_mensaje("No se encontró resultados.",'advertencia');
}
?>