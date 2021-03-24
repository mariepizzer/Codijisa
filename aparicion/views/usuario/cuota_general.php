<div class="col-xs-12" id="marcas" style="width:auto;">  
    <?php
        if (sizeof($marcas)>0)
        {   
            ?>  
            <table class="table table-responsive table-bordered table-striped table-hover  header-fixed" id="ventas_marca">
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Cuota</th>
                        <th>Acumulado</th>
                        <th>Cuota Diaria</th>
                        <th>Venta Hoy</th>
                        <th>Avance Real</th>
                        <th>Avance Ideal</th>
                        <th>Marca</th>
                    </tr>
                </thead>
                <tbody>
                     <?php 
                        foreach ($marcas as $marca) {
                            if($marca['AvanceReal']>=$marca['AvanceIdeal'])
                                $color = "green";
                            if($marca['AvanceReal']<$marca['AvanceIdeal'])
                                $color = "orange";
                            ?>
                            <tr id="venta_<?php echo $marca['Marca']; ?>">
                                <td><strong><?php echo $marca['Marca']; ?></strong></td>
                                <td><p>S/. <?php echo $marca['Cuota']; ?></p></td>
                                <td><p>S/. <?php echo $marca['Acumulado'];?></p></td>
                                <td><p>S/. <?php echo $marca['CuotaDiaria'];?></p></td>
                                <td><p>S/. <?php echo $marca['Venta_Hoy'];?></p></td>
                                <td style="background-color:<?php echo $color;?>;color:white"><p><b><?php echo $marca['AvanceReal'];?>%</b></p></td>
                                <td><p><?php echo $marca['AvanceIdeal'];?>%</p></td>
                                <td><strong><?php echo $marca['Marca']; ?></strong></td>
                            </tr>
                            <?php
                        }
                        ?>
                </tbody>
            </table>
            
            <?php
            
        }
    ?>
</div>


<style type="text/css">

</style>