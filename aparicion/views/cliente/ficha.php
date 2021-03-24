

<div class="col-xs-12">
	<h3><?php echo $cliente['nombre']; ?></h3>
</div>
<div class="col-sm-3">
	<p><strong>Zona</strong>: <?php echo $cliente['zona']; ?></p>
    <p ="PCelular"><strong>Celular</strong>:
        <div class="col-xs-6">
            <input class="form-control" id="Celular" name="Celular" value="<?php echo $cliente['celular']; ?>" type="text" Placeholder='9XXXXXXXX'>
        </div>
        <div class="col-xs-6">
            <button id="botonCelular" class="btn btn-info control_mediano" type="submit" type="button" onclick="guardar_celular(<?php echo $cliente['id'];?>)">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            </button>
        </div>
    </p>
<br><br>
	<p><strong>Dirección</strong>: <?php echo $cliente['direccion']; ?></p>
	<p><strong>Colgate</strong>: <?php if($cliente['colgate']==1){?>
		<img src="<?php echo asset_url();?>/img/colgate.png" class="img-responsive" style="height:25px;float:right;"><?php }else{?>
		<img src="<?php echo asset_url();?>/img/colgate_no.png" class="img-responsive" style="height:25px;float:right;"><?php }?>
	</p>
	<a href="<?php echo base_url();?>vender/<?php echo $cliente['id'];?>" class="btn btn-lg btn-warning text-center">Venderle <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
</div>
<div class="col-sm-9">
    <table class="table table-responsive table-stripped">
    	<thead>
    		<tr>
    			<th>Producto</th>
    			<th>Fecha</th>
    			<th>Volumen</th>
                <th>Monto</th>
    			<th></th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php foreach ($ventas as $venta) { ?>
    		<tr id="venta<?php echo $venta['id'];; ?>">
    			<td><?php echo "<strong>". $venta['marca']."</strong>: ".$venta['producto']; ?></td>
    			<td><?php echo $venta['fecha'];; ?></td>
    			<td><?php echo $venta['volumen'];; ?></td>
                <td><?php echo $venta['Monto'];; ?></td>
    			<td>
    				<button class="btn btn-default control_mediano" type="submit" type="button" onclick="anularVenta(<?php echo $venta['id'];?>)">
    					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
    				</button>
    			</td>
    		</tr>
    		<?php }?>
    	</tbody>
    </table>
</div>


<script>
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