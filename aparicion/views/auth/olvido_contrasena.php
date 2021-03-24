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
                    <?php echo form_open("olvide_contrasena", $atributos); ?>
                        <h3 class="form-signin-heading text-center">Olvidó Contraseña</h3>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" required autofocus name="email" id="email" value="<?php echo set_value('email')?>">
                        </div>
                        <button class="btn btn-default form-control" type="submit">Enviar <span class="glyphicon glyphicon-send"></span></button>
                    </form>
                    <h5 class=" text-center"><a href="<?php echo base_url();?>iniciar_sesion"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a></h5>
                </div>
            </div>
        </div>
    </div>
</header>
