<div class="col-xs-12">
	<h3><?php echo $datos['marca'] . ': ' .$datos['nombre']; ?></h3>
</div>
<div class="col-sm-8">

	<table class="table">
		<tr class="info">
			<td>Pedido Mínimo</td>
			<td><?php echo $datos['pedido_minimo']; ?></td>
		</tr>
		<tr class="info">
			<td>Presentación</td>
			<td><?php echo $datos['presentacion']; ?></td>
		</tr>
		<tr class="info">
			<td>Activo</td>
			<td><?php echo $datos['activo']; ?></td>
		</tr>
	</table>
	<div class="clearfix"></div>

	<div class="col-xs-12" id="para_calificacion_<?php echo $datos['id'];?>">
	    <div class="form-group col-xs-12 col-sm-5">
	        <button class="btn btn-default form-control" type="submit" onclick="vender(<?php echo $datos['id'];?>,0,'voto')"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button>
	    </div>
	</div>
</div>
<div class="col-sm-4">
    <a href="<?php echo base_url();?>producto/<?php echo $datos['id'];?>"><img src="<?php echo asset_url();?>img/productos/<?php echo $datos['imagen'];?>.jpg" alt="..." class="img-responsive"></a>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-3 col-sm-offset-3"  id="boton_recomendar">
    <a href="<?php echo base_url();?>usuario/vender" class="btn btn-lg btn-warning text-center">Seguir vendiendo <span class="glyphicon glyphicon-forward" aria-hidden="true"></span></a>
</div>
