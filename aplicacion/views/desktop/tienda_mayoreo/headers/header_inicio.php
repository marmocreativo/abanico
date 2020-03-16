<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/global/img/favicon.png">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/global/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kalam&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/flexslider/flexslider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/slider-pro-master/css/slider-pro.css?ver=<?php echo date('U'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/estilos_abanico_desktop.css?ver=<?php echo date('U'); ?>">
    <title><?php echo $titulo; ?></title>
    <meta name="description" content="<?php echo $descripcion; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="robots" content="index, follow" />
    <meta property="og:url"  content="<?php echo current_url(); ?>" />
  	<meta property="og:type" content="website" />
  	<meta property="og:title" content="<?php echo $titulo; ?>" />
  	<meta property="og:description" content="<?php echo $descripcion; ?>" />
  	<meta property="og:image" content="<?php echo $imagen; ?>" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-143900653-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-143900653-1');
    </script>


  </head>
  <body>
    <!-- Header -->
    <div class="menu-superior bg<?php echo $primary; ?>">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <ul class="list-inline mb-0">
              <li class="list-inline-item"><a class="btn btn-sm <?php echo 'btn-link'.$primary; ?> text-white" target="_blank" href="tel:<?php echo $op['telefono_sitio']; ?>"><i class="fa fa-phone"></i> <?php echo $op['telefono_sitio']; ?></a></li>
            </ul>
          </div>
          <div class="col">
            <div class="btn-group float-right" role="group" aria-label="Button group with nested dropdown">
              <?php $this->load->view('desktop/tienda/widgets/menu_usuario'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-principal">
      <nav class="navbar navbar-expand">
        <div class="d-flex justify-content-arround align-items-center">
          <a class="navbar-brand mr-1" href="<?php echo base_url('tienda-mayoreo'); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse">
        </div>
        <ul class="navbar-nav">
          <li class="nav-item">
            <?php
              $conteo_carrito = 0;
              if(isset($_SESSION['carrito']['productos'])){
                foreach($_SESSION['carrito']['productos'] as $producto){
                  $conteo_carrito += $producto['cantidad_producto'];
                }
              }
            ?>
            <button type="button" class="btn btn-sm btn-carrito <?php echo 'btn-link'.$primary; ?> text-primary" data-toggle="modal" data-target="#ModalCarritoMayoreo" style="background:transparent;"> <span class="fa fa-shopping-cart text-primary-1"></span> <?php echo $this->lang->line('header_boton_carrito'); ?> (<?php echo $conteo_carrito; ?>)</button>
          </li>
        </ul>
      </nav>
    </div>
    <div class="pre-footer">
      <div class="barra-color barra-azul"></div>
      <div class="barra-color barra-rosa"></div>
      <div class="barra-color barra-amarillo"></div>
      <div class="barra-color barra-verde"></div>
      <div class="barra-color barra-morado"></div>
    </div>

    <!-- Termina Header -->
