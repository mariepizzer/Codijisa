<div class="item">
    <?php
    if($muestra_sinopsis)
    {
        ?>
        <div class="col-sm-4">
            <a href="<?php echo base_url();?>producto/<?php echo $ficha['id'];?>"><img src="<?php echo asset_url();?>img/productos/<?php echo $ficha['imagen'];?>.jpg" alt="<?php echo $ficha['nombre'];?>"></a>
        </div>
        <div class="col-sm-8">
            <div class="col-xs-12">
                <h4><?php echo $ficha['nombre']; ?></h4>
                <p><?php echo $ficha['marca']; ?></p>
            </div>
            <div class="col-xs-12" id="para_calificacion_<?php echo $ficha['id'];?>">
                <div class="form-group col-xs-4 col-sm-5">
                    <button class="btn btn-default form-control" type="submit" onclick="calificar(<?php echo $ficha['id'];?>,0,'<?php echo $modo;?>')"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button>
                </div>
            </div>
        </div>
        <?php
    }
    else
    {
        ?>
        <a href="<?php echo base_url();?>producto/<?php echo $ficha['id'];?>"><img title="<?php echo $ficha['nombre'];?>" alt="<?php echo $ficha['nombre'];?>" src="<?php echo asset_url();?>img/productos/<?php echo $ficha['imagen'];?>.jpg" alt="<?php echo $ficha['nombre'];?>"></a>
        <?php
    }

    ?>
</div> 