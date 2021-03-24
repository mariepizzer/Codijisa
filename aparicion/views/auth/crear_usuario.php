<?php 
    $atributos = array('class' => 'form-group', 'role' => 'form');
?>

<header class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <a href="<?php echo base_url();?>"><img src="<?php echo asset_url();?>/img/logo.png" class="text-center"></a>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <?php echo form_open("crear_usuario",$atributos); ?>
                        <h3 class="form-signin-heading text-center"><?php echo $titulo?></h3>
                        
                        <div class="form-group col-sm-6">
                            <label for="nombres" class="sr-only">Nombres *</label>
                            <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres *"  value="<?php echo set_value('nombres'); ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="apellidos" class="sr-only">Apellidos *</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos *" value="<?php echo set_value('apellidos'); ?>">
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-sm-6">
                            <label for="email" class="sr-only">Email *</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email *" value="<?php echo set_value('email'); ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="telefono" class="sr-only">Teléfono *</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo set_value('telefono'); ?>">
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-sm-6">
                            <label for="contrasena" class="sr-only">Contraseña *</label>
                            <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Contraseña *">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="confirma_contrasena" class="sr-only">Confirma Contraseña *</label>
                            <input type="password" class="form-control" name="confirma_contrasena" id="confirma_contrasena" placeholder="Confirma Contraseña *">
                        </div>  

                        <div class="clearfix"></div>
                        <div class="form-group col-sm-6 col-sm-offset-3">
                            <button class="btn btn-default form-control" type="submit">Regístrate <span class="glyphicon glyphicon-chevron-right"></span></button>
                        </div>
                        <div class="form-group col-sm-6 col-sm-offset-3">
                            <a href="<?php echo base_url();?>iniciar_sesion" title='Inicia sesión' class="">Inicia sesión <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</header>