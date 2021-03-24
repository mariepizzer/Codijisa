<?php 
    $atributos = array('class' => 'form-group', 'role' => 'form');
?>
    
    <div class="container">
        <?php echo form_open("meta/registro_premios",$atributos); ?>
            <div class="col-sm-4 col-xs-6">
                <label for="Marca" class="sr-only">Marca</label>
                <select  class="form-control" name="Marca" id="Marca" >
                    <?php foreach ($Marcas as $marca) {?>
                    <option value="<?php echo $marca['idMARCA'];?>"><?php echo $marca['idMARCA'];?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-sm-4 col-xs-6">
                <label for="Mes" class="sr-only">Mes</label>
                <input type="date" class="form-control" name="Mes" id="Mes" placeholder="Mes" value="<?php echo set_value('Mes'); ?>">
            </div>
            <div class="col-sm-4 col-xs-12">
                <button type="submit" title="Graba Premios Alcanzados" class="btn btn-info form-control">
                     Ver Premios <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                </button>
            </div>
        </form>
    </div>
<br><br>

<?php
if (sizeof($premios)>0)
{   
    ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
            <table class="table table-responsive table-hover table-striped" id="resultado_metas">
                <thead>
                    <tr class="info">
                        <th>Meta</th>
                        <th>Tipo (Objetivo)</th>
                        <th>Alcance</th>
                        <th>Premio Efectivo</th>
                        <th>Pagado</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    
                    $total = 0;
                    foreach ($premios as $premio) {
                        $total = $total + $premio['Efectivo'];
                        ?>
                        <tr id="META_<?php echo $premio['idMETA'];?>"class="<?php if($premio['Pagado']) echo "activo"; else echo "no_activo";?>">
                            <td><?php echo $premio['Nombre_Meta']."<br>".$premio['Mes'];?></td>
                            <td><?php echo $premio['Tipo'];?> (<?php if($premio['Tipo']=='COBERTURA') echo  $premio['Cobertura']." puntos"; if($premio['Tipo']=='VOLUMEN') echo  "S/. ".$premio['Volumen'];?>)</td>
                            <td><?php if($premio['Tipo']=='COBERTURA') echo $premio['Alcanzado'].' puntos';if($premio['Tipo']=='VOLUMEN') echo "S/. ".$premio['Alcanzado'];?></td>
                            <td>S/. <?php echo $premio['Efectivo'];?></td>
                            <td>
                                <?php if($premio['Pagado']==0){ ?>
                                <button class="btn btn-info control_mediano" type="submit" type="button" onclick="pagarPremio(<?php echo $premio['idMETA'];?>, '<?php echo set_value('Mes'); ?>',<?php echo $idUsuario;?>)">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                </button>
                                <?php }else{?>
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-weight:bolder;font-size:1.5em;color:red;">S/. <?php echo $total;?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <?php
}else{
    imprimir_mensaje("No se encontró premios para el mes y/o marca seleccionados.",'advertencia');
}
?>

<script type="text/javascript">

</script>
