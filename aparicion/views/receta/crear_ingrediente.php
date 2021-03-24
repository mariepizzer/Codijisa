<?php 
    $atributos = array('class' => 'form-group', 'role' => 'form');
?>
<div class="clearfix visible-xs"></div>
<div class="col-sm-6 col-sm-offset-3">
<h2 class="page-header text-center"><?php echo $titulo;?></h2>    
    <?php echo form_open("semana/crear_ingrediente",$atributos); ?>
        
        <div class="form-group col-sm-6">
            <label for="Nombre" class="sr-only">Nombre Ingrediente*</label>
            <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre *" value="">
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label for="Categoria" class="sr-only">Categoría *</label>
            <select  class="form-control" name="Categoria" id="Categoria" >
                <?php 
                foreach ($categorias as $categoria) 
                {
                    if($categoria['Tipo']=='I')
                        { 
                        ?>
                        <option value="<?php echo $categoria['idCategoria'];?>"><?php echo $categoria['idCategoria'];?></option>
                        <?php
                        } 
                }
                ?>
            </select>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label for="Comentario" class="sr-only">Comentario*</label>
            <input type="text" class="form-control" name="Comentario" id="Comentario" placeholder="Comentario *" value="">
        </div>
        <div class="form-group col-sm-6">
            <button class="btn btn-info btn-block" type="submit"><span class="glyphicon glyphicon-save"></span> Guardar Ingrediente</button>
        </div>
    </form>
</div>