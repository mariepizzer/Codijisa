<?php 
    $atributos = array('class' => 'form-inline', 'role' => 'form');
?>
<header class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
                    <a href="<?php echo base_url();?>"><img src="<?php echo asset_url();?>/img/quilla.png" class="img-responsive"></a>
                </div>
            </div>
            <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                        <?php echo form_open("resetear_contrasena/" . $code,$atributos); ?>
                            <input type="password" class="form-control" name="nueva_contrasena" id="nueva_contrasena" placeholder="Nueva Contraseña *">
                            <input type="password" class="form-control" name="confirma_contrasena" id="confirma_contrasena" placeholder="Confirma Contraseña *">
                            <?php echo form_hidden($csrf); ?>
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
                            <button class="btn btn-default form-control" type="submit"><span class="glyphicon glyphicon-save"></span> Guardar Cambios</button>                            
                        </form>
                        <a href="<?php echo base_url();?>olvide_contrasena" title='Olvidó su contraseña'>¿No recuerdas tu contraseña?</a><br/>
                        <a href="<?php echo base_url();?>crear_usuario" title='Registrarse' class="text-right">Regístrate <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                    </div>

                    <h5 class=" text-center"><a href="<?php echo base_url();?>iniciar_sesion"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a></h5>
                </div>
            </div>
        </div>
    </div>
</header>
