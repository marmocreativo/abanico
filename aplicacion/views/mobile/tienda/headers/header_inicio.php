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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/flexslider/flexslider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/estilos_abanico_mobile.css">
    <title><?php echo $op['titulo_sitio']; ?></title>
  </head>
  <body>
    <!-- Header -->

  <div class="menu-principal">
    <nav class="navbar navbar-expand">
      <a class="navbar-brand mr-2" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" alt=""></a>

      <form class="form-inline my-3 mr-2 w-75" action="<?php echo base_url('categoria/busqueda') ?>" method="get">
        <div class="input-group input-group-sm">
          <input class="form-control" type="search" name="Busqueda" placeholder="Busca lo Mejor" aria-label="Search">
          <div class="input-group-append">
            <button type="submit" class="btn <?php echo 'btn'.$primary; ?>" type="button"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="btn <?php echo 'btn-link'.$primary; ?> btn-sm btnSearch btnBx collapsed" data-toggle="collapse" href="#menu-categorias" role="button" aria-expanded="false" aria-controls="menu-categorias">
            <!-- <i class="fas fa-bars"></i> -->
            <span class="hamburger-top-bread"></span>
            <span class="hamburger-patty"></span>
            <span class="hamburger-bottom-bread"></span>
          </a>
        </li>
        <li class="nav-item">
          <button type="button" class="btn btn-sm <?php echo 'btn-link'.$primary; ?> text-primary" data-toggle="modal" data-target="#ModalCarrito" style="background:transparent;"> <span class="fa fa-shopping-cart text-primary-1"></span></button>
        </li>
      </ul>
    </nav>
  </div>

  <div class="menu-inferior collapse navbar-collapse" id="menu-categorias">
    <div class="card pt-3 pb-3">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link" href="<?php echo base_url('usuario/registrar'); ?>"> <i class="fas fa-user-plus"></i> Registrarse</a>
        <a class="nav-link" href="#"> <i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
        <span class="separador mt-3 mb-3"></span>
        <a class="nav-link" href="<?php echo base_url('categoria'); ?>"> <i class="fa fa-boxes"></i> TODOS LOS PRODUCTOS</a>
        <?php $i=0; foreach($categorias as $categoria){ ?>
        <a class="nav-link <?php if($i==0){ echo 'active'.$primary;} ?>" id="menu-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" data-toggle="pill" href="#cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" role="tab" aria-controls='cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>' aria-selected="true">
          <i class="<?php echo $categoria->CATEGORIA_ICONO; ?>"></i> <?php echo $categoria->CATEGORIA_NOMBRE; ?>
        </a>
        <?php $i++;  } ?>
      </div>
    </div>
  </div>

  <!-- Termina Header -->
