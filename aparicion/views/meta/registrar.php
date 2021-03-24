<?php 
    $atributos = array('class' => 'form-group', 'role' => 'form');
?>
<div class="clearfix visible-xs"></div>
<div class="col-sm-6 col-sm-offset-3">
<h2 class="page-header text-center"><?php echo $titulo;?></h2>    
    <?php echo form_open("meta/registrar",$atributos); ?>
        
        <div class="form-group col-sm-6">
            <label for="Marca" class="sr-only">Marca *</label>
            <select  class="form-control" name="Marca" id="Marca" >
                <?php foreach ($Marcas as $marca) {?>
                <option value="<?php echo $marca['idMARCA'];?>"><?php echo $marca['idMARCA'];?></option>
                <?php }?>
            </select>
            
        </div>
        <div class="form-group col-sm-6">
            <label for="Tipo" class="sr-only">Tipo de Meta *</label>
            <select  class="form-control" name="Tipo" id="Tipo" >
                <option value="COBERTURA">Cobertura</option>
                <option value="VOLUMEN">Volumen</option>
            </select>
            <!-- <input type="text" class="form-control" name="Tipo" id="Tipo" placeholder="Tipo de Meta*" value="<?php echo set_value('Tipo'); ?>"> -->
        </div>
        <div class="form-group col-xs-6">
            <label for="Nombre_Meta" class="sr-only">Nombre *</label>
            <input type="text" class="form-control" name="Nombre_Meta" id="Nombre_Meta" placeholder="Nombre de Meta*" value="<?php echo set_value('Nombre_Meta'); ?>">
        </div>
        <div class="form-group col-xs-6">
            <label for="Incentivo" class="sr-only">Incentivo *</label>
            <input type="text" class="form-control" name="Incentivo" id="Incentivo" placeholder="Incentivo *" value="<?php echo set_value('Incentivo'); ?>">
        </div>
        <div class="clearfix"></div>

        <div class="form-group col-xs-5">
            <label for="Cobertura" class="sr-only">Cobertura</label>
            <input type="text" class="form-control" name="Cobertura" id="Cobertura" placeholder="Cobertura *" value="<?php echo set_value('Cobertura'); ?>">
        </div>
        <div class="form-group col-xs-5">
            <label for="Volumen" class="sr-only">Volumen</label>
            <input type="text" class="form-control" name="Volumen" id="Volumen" placeholder="Volumen *" value="<?php echo set_value('Volumen'); ?>">
        </div>
        <div class="form-group col-xs-2">
            <label for="Mostrar" class="sr-only">Mostrar</label>
            <input type="checkbox" class="form-control" name="Mostrar" id="Mostrar" <?php if(set_value('Incentivo')==1) echo "checked";?>>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label for="Fecha_inicio" class="sr-only">Inicio</label>
            <input type="date" class="form-control" name="Fecha_inicio" id="Fecha_inicio" placeholder="Inicio *" value="<?php echo set_value('Fecha_inicio'); ?>">
        </div>
        <div class="form-group col-sm-6">
            <label for="Fecha_fin" class="sr-only">Fin</label>
            <input type="date" class="form-control" name="Fecha_fin" id="Fecha_fin" placeholder="Fin *" value="<?php echo set_value('Fecha_fin'); ?>">
        </div>
        <div class="clearfix"></div>

        <div class="form-group col-sm-6 col-sm-offset-6">
            <button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-save"></span> Guardar datos</button>
        </div>
    </form>
</div>