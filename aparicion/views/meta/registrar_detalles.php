<?php if (!isset($meta['Marca'])) 
{
    echo "NO EXISTE META.";
    return;
}?>

<div class="clearfix visible-xs"></div>
<div class="col-sm-12 ">
    <h2 class="page-header"><?php echo $titulo;?>
        <button class="btn btn-warning control_mediano" type="submit" type="button" onclick="retirar_meta(<?php echo $idMETA;?>)">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        </button>
    </h2>  
        
    <div class="col-sm-6">
        <div class="col-sm-6">
            <strong>Marca</strong>
            <p id="Marca"><?php echo $meta['Marca'];?>
            </p>
        </div>

        <div class="clearfix"></div>

        <div class="col-xs-6">
            <strong>Nombre</strong>
            <input type="text" class="form-control" name="Nombre_Meta" id="Nombre_Meta" placeholder="Nombre de Meta*" value="<?php echo $meta['Nombre_Meta'];?>">
        </div>

        <?php if ($meta['Tipo']=='COBERTURA'){ ?>
            <div class="col-xs-3">
                <strong>Cobertura</strong>
                <input type="text" class="form-control" name="Cobertura" id="Cobertura" placeholder="Cobertura *" value="<?php echo $meta['Cobertura'];?>">
                <input type="hidden" class="form-control" name="Volumen" id="Volumen" placeholder="Volumen *" value="<?php echo $meta['Cobertura'];?>">
            </div>
        <?php } ?>
        
        <?php if ($meta['Tipo']=='VOLUMEN'){?>
            <div class="col-xs-3">
                <strong>Volumen</strong>
                <input type="text" class="form-control" name="Volumen" id="Volumen" placeholder="Volumen *" value="<?php echo $meta['Volumen'];?>">
                <input type="hidden" class="form-control" name="Cobertura" id="Cobertura" placeholder="Cobertura *" value="<?php echo $meta['Cobertura'];?>">
            </div>   
        <?php } ?>
        
                    
        <div class="col-xs-3">
            <strong>Incentivo</strong>
            <input type="text" class="form-control" name="Incentivo" id="Incentivo" placeholder="Incentivo" value="<?php echo $meta['Incentivo'];?>">
        </div>
        
        <div class="clearfix"></div>

        <div class="col-sm-2 col-xs-6">
            <strong>Mostrar</strong>
            <input type="checkbox" class="form-control" name="Mostrar" id="Mostrar" <?php if($meta['Mostrar']==1) echo "checked";?>>
        </div>
        <div class="col-sm-2 col-xs-6">
            <strong>Prioridad</strong>
            <input type="checkbox" class="form-control" name="Prioridad" id="Prioridad" <?php if($meta['Prioridad']==1) echo "checked";?>>
        </div>

        
        <div class="clearfix visible-xs"></div>

        <div class="col-sm-4 col-xs-6">
            <strong>Inicio</strong>
            <input type="date" class="form-control" name="Fecha_inicio" id="Fecha_inicio" placeholder="Inicio *" value="<?php echo $meta['Fecha_inicio'];?>">
        </div>
        <div class="col-sm-4 col-xs-6">
            <strong>Fin</strong>
            <input type="date" class="form-control" name="Fecha_fin" id="Fecha_fin" placeholder="Fin *" value="<?php echo $meta['Fecha_fin'];?>">
        </div>
        <div class="clearfix"></div>

         <h4>
            <button id="botonActualizar" type="button" class="btn btn-success control_mediano" onclick="actualizar_meta(<?php echo $idMETA;?>)">
                Actualizar <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            </button>
        
            <button type="button" data-toggle="collapse" data-target="#campos_agregar_detalle_meta" aria-expanded="false" aria-controls="campos_agregar_detalle_meta" class="btn btn-info control_mediano" onclick="cargar_campos_agregar_detalle_meta(<?php echo $idMETA;?>, '<?php echo $meta['Marca'];?>')">
                Agregar Producto  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>

            <button type="button" data-toggle="collapse" data-target="#productos" aria-expanded="false" aria-controls="productos" class="btn btn-info control_mediano">
                Ver Productos  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
            </button>
        
            <button type="button" data-toggle="collapse" data-target="#ventas" aria-expanded="false" aria-controls="ventas" class="btn btn-info control_mediano" onclick="ventas_por_meta(<?php echo $idMETA;?>)">
                Ver Ventas <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
            </button>
        </h4>

        <div class="collapse" id="campos_agregar_detalle_meta">
          <div class="card card-body">
              <div class="row"> 
                <div class="col-xs-12" style="padding-bottom:10px;">
                    <button class="btn btn-blue" type="submit" type="button" onclick="agregar_todos_producto_meta(<?php echo $idMETA;?>,'<?php echo $meta['Marca'];?>')">
                        Agregar todos los productos <strong><?php echo $meta['Marca'];?></strong> a la meta <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-xs-6" id="productos_a_agregar">
                </div>
                <div class="col-xs-4">
                    <input class="form-control" id="Pedido_minimo_a_agregar" name="Pedido_minimo_a_agregar" value="0.5" type="number" step="0.5">
                </div>
                <div class="col-xs-2">
                    <button class="btn btn-blue control_mediano" type="submit" type="button" onclick="agregar_producto_meta(<?php echo $idMETA;?>)">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </button>
                </div>
              </div>
          </div>
        </div>
    </div>
    
    <div class="collapse col-sm-6" id="productos">
        <h3>PRODUCTOS POR META</h3>
        <table class="table table-responsive table-bordered table-striped" id="productos_meta">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Pedido Mínimo</th>
                    <th>Retirar</th>
                </tr>
            </thead>
            <tbody>
                 <?php 
                    foreach ($detalles as $detalle) {
                        ?>
                        <tr id="detalle_<?php echo $idMETA.'_'.$detalle['idPRODUCTO']; ?>">
                            <td><p><?php echo $detalle['idPRODUCTO'];?></p></td>
                            <td><p><?php echo $detalle['Nombre'];?></p></td>
                            <td><p><?php echo $detalle['Pedido_minimo'];?></p></td>
                            <td>
                                <button class="btn btn-default control_mediano" type="submit" type="button" onclick="retirar_detalle_meta(<?php echo $detalle['idPRODUCTO'];?>,<?php echo $idMETA;?>)">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr id="nueva_fila" style="display:none;">
                        <td><p></p></td>
                        <td><p></p></td>
                        <td><p></p></td>
                        <td>
                            <button class='btn btn-default control_mediano' type='submit' type='button'>
                                <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                            </button>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>

    <div class="col-sm-6 collapse" id="ventas">
        
    </div>  
</div>

<script type="text/javascript">

    $("#Nombre").keyup(function(event){
        if(event.keyCode == 13){
            $("#botonActualizar").click();
        }
    });

</script>
