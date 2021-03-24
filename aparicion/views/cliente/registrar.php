<?php 
    $atributos = array('class' => 'form-group', 'role' => 'form');
?>
<div class="clearfix visible-xs"></div>
<div class="col-sm-6 col-sm-offset-3">
<h2 class="page-header text-center"><?php echo $titulo;?></h2>    
    <?php echo form_open("cliente/registrar",$atributos); ?>
        
        <div class="form-group col-sm-6">
            <label for="idCliente" class="sr-only">Código *</label>
            <input type="text" class="form-control" name="idCliente" id="idCliente" placeholder="Código"  value="">
        </div>
        <div class="form-group col-sm-6">
            <label for="Nombre" class="sr-only">Nombre *</label>
            <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre *" value="">
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label for="Zona" class="sr-only">Zona</label>
            <input type="text" class="form-control" name="Zona" id="Zona" placeholder="Zona *" value="">
        </div>
        <div class="form-group col-sm-6">
            <label for="Celular" class="sr-only">Celular *</label>
            <input type="text" class="form-control" name="Celular" id="Celular" placeholder="Celular" value="">
        </div>
        <div class="clearfix"></div>

        <div class="form-group col-sm-6">
            <label for="Direccion" class="sr-only">Dirección *</label>
            <input type="text" class="form-control" name="Direccion" id="Direccion" placeholder="Dirección" value="">
        </div>

        <div class="form-group col-sm-6">
            <button class="btn btn-info btn-block" type="submit"><span class="glyphicon glyphicon-save"></span> Guardar datos</button>
        </div>
    </form>
</div>