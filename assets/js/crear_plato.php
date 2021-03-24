<?php 
    $atributos = array('class' => 'form-group', 'role' => 'form');
?>
<div class="clearfix visible-xs"></div>
<div class="col-sm-6 col-sm-offset-3">
<h2 class="page-header text-center"><?php echo $titulo;?></h2>    
    <?php echo form_open("semana/plato/nuevo",$atributos); ?>
        
        <div class="form-group col-sm-6">
            <label for="Nombre" class="sr-only">Nombre Plato*</label>
            <input type="text" class="form-control crear_plato" name="Nombre" id="Nombre" placeholder="Nombre *" value=""  data-provide="typeahead"   autocomplete="off">
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label for="Categoria" class="sr-only">Categoría *</label>
            <select  class="form-control" name="Categoria" id="Categoria" >
                <?php 
                foreach ($categorias as $categoria) 
                {
                    if($categoria['Tipo']=='P')
                        { 
                        ?>
                        <option value="<?php echo $categoria['idCategoria'];?>"><?php echo $categoria['idCategoria'];?></option>
                        <?php
                        } 
                }
                ?>
            </select>
        </div>
        <div class="form-group col-sm-6">
            <button class="btn btn-info btn-block" type="submit"><span class="glyphicon glyphicon-save"></span> Guardar Plato</button>
        </div>
    </form>
</div>