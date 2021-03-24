<?php
    //Siempre que se llame a este archivo, se necesitará estar logueado.
    if (!$this->ion_auth->logged_in())
    {
        redirect('iniciar_sesion');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="RECETAS">
    <meta name="author" content="Marie Pizzer">
    <link rel="shortcut icon" href="<?php echo asset_url();?>img/favicon.png">
    
    <title><?php if (isset($titulo)) echo $titulo." -";?> RECETAS</title>
    <link type="text/css"  rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap.css">
    <link type="text/css"  rel="stylesheet" href="<?php echo asset_url();?>css/style_receta.css">
    <!-- HTML5 shim and Respond.js IE8   support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo asset_url();?>js/html5shiv.js"></script>
      <script src="<?php echo asset_url();?>js/respond.js"></script>
      <![endif]-->
    <script src="<?php echo asset_url();?>js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript">
        var VariablesPHP = {
            base_url: '<?php echo base_url() ?>',
            application_url: '<?php echo application_url() ?>',
            asset_url: '<?php echo asset_url();?>'
        }
        //window.location.reload(true);
    </script>
</head>

<body>

<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top"  style="border:0px solid red;">
        <div class="container">
            <div class="navbar-header"  style="border:0px solid red;">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Ver menú</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a style="margin-top: -10px;" class="navbar-brand" href="<?php echo base_url();?>semana"> <img src="<?php echo asset_url();?>img/logo.png"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse"  style="border:0px solid red;">
                <div class="navbar-form navbar-right" style="border:0px solid red;">
                    <div class="input-group" style="padding-top:10px;font-size:1.4em;">
                        <a href="<?php echo base_url();?>semana/plato/nuevo"  title="Nuevo Plato"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a> 
                        <a href="<?php echo base_url();?>semana/crear_ingrediente"  title="Nuevo Ingrediente"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a> 
                        <a href="<?php echo base_url();?>semana/ingredientes"  title="Ingredientes"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a> 
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div id="mensaje" style="padding-top:70px">
                <?php 

                    if (isset($mensaje) && !empty($mensaje))
                    {
                        if (!isset($tipo_mensaje))
                        {
                            $tipo_mensaje = '';
                        }
                        imprimir_mensaje($mensaje,$tipo_mensaje);
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- <div class="jumbotron"> -->
        <div class="container">
            