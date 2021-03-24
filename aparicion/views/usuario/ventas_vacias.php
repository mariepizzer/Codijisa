<h3>VENTAS VACÍAS</h3>
<table class="table table-responsive table-bordered table-striped" id="ventas_meta">
        <thead>
            <tr>
                <th>Día</th>
                <th>Ventas</th>
            </tr>
        </thead>
        <tbody>
             <?php 
                foreach ($ventas as $venta) {
                    ?>
                    <tr>
                        <td><p><?php echo ucfirst($venta['Fecha']);?></p></td>
                        <td><p><?php echo ucfirst($venta['Ventas']);?></p></td>
                    </tr>
                    <?php
                }
                ?>
        </tbody>
    </table>

