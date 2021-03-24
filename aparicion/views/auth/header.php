<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Quilla">
    <meta name="author" content="Marie Pizzer">
    <link rel="shortcut icon" href="<?php echo asset_url();?>img/favicon.png">
    
    <title><?php if (isset($titulo)) echo $titulo." -";?> Quilla</title>
    <link href="<?php echo asset_url();?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>css/iniciar_sesion.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js IE8   support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo asset_url();?>js/html5shiv.js"></script>
      <script src="<?php echo asset_url();?>js/respond.js"></script>
      <![endif]-->
    <script src="<?php echo asset_url();?>js/jquery-1.11.2.min.js"></script>
</head>
<body data-spy="scroll" >