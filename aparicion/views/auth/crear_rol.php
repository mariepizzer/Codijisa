<?php 
    $atributos = array('class' => 'form-group', 'role' => 'form');
?>
<div class="clearfix visible-xs"></div>
<div class="col-xs-12  col-md-3 col-md-offset-3">
    
    <?php echo form_open("crear_grupo",$atributos); ?>
        <h3 class="form-signin-heading text-center"><?php echo $titulo?></h3>
        
        <div class="form-group col-xs-12">
            <label for="nombre_grupo" class="sr-only">Nombre</label>
            <input type="text" class="form-control" name="nombre_grupo" id="nombre_grupo" placeholder="Nombre (sin espacios) *" value="<?php echo set_value('nombre_grupo');?>">
        </div>
        <div class="form-group col-xs-12">
            <label for="descripcion_grupo" class="sr-only">Descripción</label>
            <input type="text" class="form-control" name="descripcion_grupo" id="descripcion_grupo" placeholder="Descripción *" value="<?php echo set_value('descripcion_grupo');?>">
        </div>
        <div class="form-group col-xs-12">
            <button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-save"></span> Guardar Datos</button>
        </div>
    </form>
</div>