<?php if (!isset($plato['idPlato'])) 
{
    echo "NO EXISTE PLATO." .$idPlato;
    return;
}?>
<input id="idPlato" type="hidden" value="<?php echo $plato['idPlato'];?>">
<div class="clearfix visible-xs"></div>
<div class="col-sm-12 ">
    <h2 class="page-header"><?php echo $titulo;?>
        <button class="btn btn-warning control_mediano" type="submit" type="button" onclick="borrar_plato(<?php echo $idPlato;?>)">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        </button>
    </h2>  
        
    <div class="col-sm-6">
        <div class="col-xs-6">
            <strong>Nombre</strong>
            <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre*" value="<?php echo $plato['Nombre'];?>">
        </div>        
                    
        <div class="col-xs-6">
            <strong>Categoría</strong>
            <select  class="form-control" name="Categoria" id="Categoria" >
                <?php 
                foreach ($categorias as $categoria) 
                {
                    if($categoria['Tipo']=='P')
                        { 
                        ?>
                        <option value="<?php echo $categoria['idCategoria'];?> " <?php if($categoria['idCategoria']==$plato['Categoria']){ echo "selected";} ?> ><?php echo $categoria['idCategoria'];?></option>
                        <?php
                        } 
                }
                ?>
            </select>
        </div>
        
        <div class="col-xs-12">
            <strong>Comentario</strong>
            <textarea class="form-control"  name="Comentario"  id="Comentario" rows="5" cols="50"><?php echo $plato['Comentario'];?></textarea>
        </div> 

        <div class="clearfix"></div>

        <h4>
            <button id="botonActualizar" type="button" class="btn btn-success control_mediano" onclick="actualizar_plato(<?php echo $idPlato;?>)">
                Actualizar Plato <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            </button>
        
            <button type="button" data-toggle="collapse" data-target="#campos_agregar_ingrediente_plato" aria-expanded="false" aria-controls="campos_agregar_ingrediente_plato" class="btn btn-info control_mediano">
                Agregar Ingredientes  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
        </h4>

        <div class="collapse" id="campos_agregar_ingrediente_plato">
          <div class="card card-body">
              <div class="row"> 
                <div class="col-xs-6" >
                    <input class="form-control typeahead" data-provide="typeahead" placeholder="Ingredientes..." type="text" id="Frase_ingrediente" autocomplete="off">
                </div>
                <div class="col-xs-2">
                    <button id="botonAgregarIngredientePlato" class="btn btn-blue control_mediano" type="submit" type="button" onclick="agregar_ingrediente_plato(<?php echo $idPlato;?>)">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    </button>
                    <!-- <button class="btn btn-blue control_mediano" type="button" onclick="crear_ingrediente(<?php echo $idPlato;?>);">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </button> -->
                </div>
              </div>
          </div>
        </div>
    </div>
    
    <div class="col-sm-6" id="ingredientes">
        <h3>INGREDIENTES</h3>
        <table class="table table-responsive table-bordered table-striped" id="ingredientes_plato">
            <thead>
                <tr>
                    <th>Ingrediente</th>
                    <th>Retirar</th>
                </tr>
            </thead>
            <tbody>
                 <?php 
                    foreach ($ingredientes as $ingrediente) {
                        ?>
                        <tr id="ingrediente_<?php echo $idPlato.'_'.$ingrediente['idIngrediente']; ?>">
                            <td><p><?php echo $ingrediente['Nombre'];?></p></td>
                            <td>
                                <button class="btn btn-default control_mediano" type="submit" type="button" onclick="retirar_ingrediente_plato(<?php echo $ingrediente['idIngrediente'];?>,<?php echo $idPlato;?>)">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr id="nueva_fila" style="display:none;">
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

</div>

<script type="text/javascript">

    $("#Nombre").keyup(function(event){
        if(event.keyCode == 13){
            $("#botonActualizar").click();
        }
    });

    $("#Frase_ingrediente").keyup(function(event){
        if(event.keyCode == 13){
            $("#botonAgregarIngredientePlato").click();
        }
    });    

</script>