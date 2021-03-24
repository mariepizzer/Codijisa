<?php 
    $atributos = array('class' => 'form-group', 'role' => 'form');
?>
<div class="clearfix visible-xs"></div>
<div class="col-sm-6 col-sm-offset-3">
<h2 class="page-header text-center"><?php echo $titulo;?></h2>    
    <?php echo form_open_multipart("subir_sincro",$atributos); ?>

        <div class="form-group col-sm-6">
            <label for="sincro" class="sr-only">Sincro *</label>
            <input type="file" class="form-control" name="sincro" id="sincro" placeholder="Sincro"  value="">
        </div>
        <div class="form-group col-sm-6">
            <button class="btn btn-info btn-block" type="submit"><span class="glyphicon glyphicon-cloud-upload"></span> Subir Sincro </button>
        </div>

        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <button class="btn btn-info btn-block" type="button" onclick="importar_clientes()"><span class="glyphicon glyphicon-import"></span> Importar Clientes </button>
        </div>
        <div class="form-group col-sm-6">
            <button class="btn btn-info btn-block" type="button" onclick="importar_productos()"><span class="glyphicon glyphicon-import"></span> Importar Productos </button>
        </div>
    </form>
    
    <div id="resultado">
        
    </div>
</div>