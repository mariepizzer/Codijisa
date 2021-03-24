<?php
if (sizeof($datos_clientes)>0)
{   
    ?>
    <div class="col-xs-12">
        <div class="panel panel-success">
            
            <table class="table table-responsive table-hover" id="resultado_clientes">
                <thead>
                    <tr class="info">
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Celular</th>
                        <th>Zona</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($datos_clientes as $cliente) {
                        ?>
                        <tr class="<?php if($cliente['activo']) echo "activo"; else echo "no_activo";?>">
                            <td>
                                <strong><?php echo $cliente['id'];?></strong>
                                <a href="<?php echo base_url().'cliente/'.$cliente['id'];?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a> 
                            </td>
                            <td>
                                <strong>
                                    <a href="<?php echo base_url().'vender/'.$cliente['id'];?>"><?php echo $cliente['nombre'];?></a>
                                </strong>
                            </td>
                            <td><strong><a href='tel:"<?php echo $cliente['celular'];?>"'><?php echo $cliente['celular'];?></a></strong></td>
                            <td><strong><?php 
                                switch ($cliente['zona']) {
                                    case 'Monday':
                                        echo 'Lunes';
                                        break;
                                    case 'Tuesday':
                                        echo 'Martes';
                                        break;
                                    case 'Wednesday':
                                        echo 'Miércoles';
                                        break;
                                    case 'Thursday':
                                        echo 'Jueves';
                                        break;
                                    case 'Friday':
                                        echo 'Viernes';
                                        break;
                                    case 'Saturday':
                                        echo 'Sábado';
                                        break;
                                    default:
                                        break;
                                }
                                ?></strong></td>
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