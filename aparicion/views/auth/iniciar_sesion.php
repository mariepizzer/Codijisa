<?php 
    $atributos = array('class' => 'form-inline', 'role' => 'form');
?>
<header class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <img src="<?php echo asset_url();?>/img/quilla.png" class="img-responsive">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                </div>
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <?php echo form_open("iniciar_sesion",$atributos); ?>
                        <input type="text" class="form-control" placeholder="<?php echo $etiqueta_identidad;?>" required autofocus name="identity" id="identity" value="<?php echo set_value('email')?>">
                        <input type="password" class="form-control" placeholder="Contraseña" name="contrasena" id="contrasena" required>
                        <button class="btn btn-default form-control" type="submit">Ingresar <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></button>
                        
                    </form>
                    <a href="<?php echo base_url();?>olvide_contrasena" title='Olvidó su contraseña'>¿No recuerdas tu contraseña?</a><br/>
                    <a href="<?php echo base_url();?>crear_usuario" title='Registrarse' class="text-right">Regístrate <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                </div>
            </div>
        </div>
    </div>
</header>
