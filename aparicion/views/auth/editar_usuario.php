<?php 
    $atributos = array('class' => 'form-group', 'role' => 'form');
?>
<div class="clearfix visible-xs"></div>
<div class="col-sm-6 col-sm-offset-3">
<h2 class="page-header text-center"><?php echo $titulo?></h2>    
    <?php echo form_open("editar_usuario/".$user->id, $atributos); ?>
        
        <div class="form-group col-sm-6">
            <label for="nombres" class="sr-only">Nombres *</label>
            <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres *"  value="<?php echo set_value('nombres', $user->first_name); ?>">
        </div>
        <div class="form-group col-sm-6">
            <label for="apellidos" class="sr-only">Apellidos *</label>
            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos *" value="<?php echo set_value('apellidos', $user->last_name); ?>">
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label for="email" class="sr-only">Email *</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email *" value="<?php echo set_value('email', $user->email); ?>">
        </div>
        <div class="form-group col-sm-6">
            <label for="telefono" class="sr-only">Teléfono *</label>
            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo set_value('telefono', $user->phone); ?>">
        </div>
        <div class="clearfix"></div>
        <?php echo form_hidden('id', $user->id);?>
        <?php echo form_hidden($csrf); ?>

        <div class="form-group col-sm-6 col-sm-offset-3">
            <button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-save"></span> Actualizar datos</button>
        </div>
    </form>
</div>