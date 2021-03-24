<?php 
    $atributos = array('class' => 'form-group', 'role' => 'form');
?>
<div class="clearfix visible-xs"></div>
<div class="col-xs-12 col-md-6 col-md-offset-3">
    <h2 class="page-header text-center"><?php echo $titulo?></h2>
    <?php echo form_open("cambiar_contrasena",$atributos); ?>
        
        <div class="form-group col-xs-12">
            <label for="antigua_contrasena" class="sr-only">Antigua Contraseña *</label>
            <input type="password" class="form-control" name="antigua_contrasena" id="antigua_contrasena" placeholder="Antigua Contraseña *">
        </div>
        <div class="form-group col-xs-12">
            <label for="nueva_contrasena" class="sr-only">Nueva Contraseña *</label>
            <input type="password" class="form-control" name="nueva_contrasena" id="nueva_contrasena" placeholder="Nueva Contraseña *">
        </div>
        <div class="form-group col-xs-12">
            <label for="confirma_contrasena" class="sr-only">Confirma Contraseña *</label>
            <input type="password" class="form-control" name="confirma_contrasena" id="confirma_contrasena" placeholder="Confirma Contraseña *">
        </div>
        <div class="form-group col-xs-12">
            <button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-save"></span> Guardar Cambios</button>
        </div>
        <?php echo form_hidden('user_id', $user_id);?>
    </form>
</div>