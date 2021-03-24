<h3>VENTAS POR META</h3>
<table class="table table-responsive table-bordered table-striped" id="ventas_meta">
        <thead>
            <tr>
                <th>PED_PK</th>
                <th>Fecha</th>
                <th>idCliente</th>
                <th>Volumen</th>
                <th>Monto</th>
                <th>Producto</th>
            </tr>
        </thead>
        <tbody>
             <?php 
                foreach ($ventas as $venta) {
                    ?>
                    <tr id="venta_<?php echo $venta['PED_PK']; ?>">
                        <td><p><?php echo $venta['PED_PK']; ?></p></td>
                        <td><p><?php echo $venta['Fecha'];?></p></td>
                        <td><a href="<?php echo base_url();?>cliente/<?php echo $venta['idCliente'];?>"><?php echo $venta['idCliente'];?></a></td>
                        <td><p><?php echo $venta['Volumen'];?></p></td>
                        <td><p><?php echo $venta['Monto'];?></p></td>
                        <td><p><?php echo $venta['Nombre'];?></p></td>
                    </tr>
                    <?php
                }
                ?>
        </tbody>
    </table>

