<?php echo form_open("eliminar_grupo/".$group->id);?>
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class="modal-title">Confirmar Eliminación</h4>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de eliminar el rol <strong><?php echo $group->description;?></strong>?</p>
                    <?php echo form_hidden($csrf); ?>
                    <?php echo form_hidden(array('id'=>$group->id)); ?>
                    <?php echo form_hidden(array('confirm'=>'yes')); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Sí, eliminar</button>
                </div>
            </div>
        </div>
    </div>
</form>