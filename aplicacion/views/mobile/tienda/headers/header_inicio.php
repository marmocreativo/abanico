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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/flexslider/flexslider.css?ver=<?php echo date('U'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/estilos_abanico_mobile.css?ver=<?php echo date('U'); ?>">
    <title><?php echo $op['titulo_sitio']; ?></title>
  </head>
  <body>
    <!-- Header -->

  <div class="menu-superior bg<?php echo $primary; ?>">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="btn-group float-right text-white" role="group" aria-label="Button group with nested dropdown">
            <?php $this->load->view('desktop/tienda/widgets/menu_notificaciones'); ?>
            <?php $this->load->view('mobile/tienda/widgets/menu_divisa'); ?>
            <?php $this->load->view('mobile/tienda/widgets/menu_lenguaje'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="menu-principal">
    <nav class="navbar navbar-expand">
      <a class="navbar-brand mr-2" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" alt=""></a>

      <form class="form-inline my-3 mr-2 w-75" action="<?php echo base_url('busqueda') ?>" method="get">
        <div class="input-group input-group-sm">
          <input class="form-control" type="search" name="Busqueda" placeholder="Busca lo Mejor" aria-label="Search" value="<?php if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){ echo filter_var ( $_GET['Busqueda'], FILTER_SANITIZE_STRING); } ?>">
          <select class="form-control" name="BuscarEn">
            <option value="productos" <?php if(isset($_GET['BuscarEn'])&&$_GET['BuscarEn']=='productos'){ echo 'selected'; } ?>>En productos</option>
            <option value="servicios" <?php if(isset($_GET['BuscarEn'])&&$_GET['BuscarEn']=='servicios'){ echo 'selected'; } ?>>En servicios</option>
          </select>
          <div class="input-group-append">
            <button type="submit" class="btn" type="button"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>

      <ul class="navbar-nav">
        <li class="nav-item">
          <button type="button" class="btn btn-sm btnBx collapsed btnFunction" data-toggle="collapse" href="#menu-categorias" role="button" aria-expanded="false" aria-controls="menu-categorias">
            <!-- <i class="fas fa-bars"></i> -->
            <span class="hamburger-top-bread"></span>
            <span class="hamburger-patty"></span>
            <span class="hamburger-bottom-bread"></span>
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="btn btn-sm <?php echo 'btn-link'.$primary; ?> text-primary" data-toggle="modal" data-target="#ModalCarrito" style="background:transparent;"> <span class="fa fa-shopping-cart text-primary-1"></span></button>
        </li>
      </ul>
    </nav>

    <div class="card btnSubmenu">
      <button type="button" class="btn btn-sm btnFunction2 bg<?php echo $primary; ?>" data-toggle="collapse" href="#menu-productos" role="button" aria-expanded="false" aria-controls="menu-productos">Productos</button>
      <button type="button" class="btn btn-sm btnFunction3 bg<?php echo $primary; ?>" data-toggle="collapse" href="#menu-servicios" role="button" aria-expanded="false" aria-controls="menu-servicios">Servicios</button>
    </div>

    <div class="bandaMenu">
      <div class="barra-color barra-azul"></div>
      <div class="barra-color barra-rosa"></div>
      <div class="barra-color barra-amarillo"></div>
      <div class="barra-color barra-verde"></div>
      <div class="barra-color barra-morado"></div>
    </div>
  </div>

  <div class="menu-inferior collapse" id="menu-categorias">
    <div class="card py-3 px-2">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <?php $this->load->view('mobile/tienda/widgets/menu_usuario'); ?>
        <span class="separador mt-3 mb-3"></span>
        <a class="nav-link" href="<?php echo base_url('usuarios/favoritos') ?>"> <i class="fas fa-heart"></i> Favoritos</a>
      </div>
    </div>
  </div>

  <div class="menu-inferior submenu collapse" id="menu-productos">
    <div class="card py-3 px-2">

      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link" href="<?php echo base_url('categoria'); ?>"> <i class="fa fa-boxes"></i> TODOS LOS PRODUCTOS</a>
          <?php $i=0; foreach($categorias as $categoria){ ?>
          <a class="nav-link" id="menu-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" href="<?php echo base_url('categoria?slug='.$categoria->CATEGORIA_URL); ?>">
            <i class="<?php echo $categoria->CATEGORIA_ICONO; ?>"></i> <?php echo $categoria->CATEGORIA_NOMBRE; ?>
          </a>
          <?php $i++;  } ?>
       </div>

    </div>
  </div>

  <div class="menu-inferior submenu collapse" id="menu-servicios">
    <div class="card py-3 px-2">

      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link" href="<?php echo base_url('categoria/servicios'); ?>"> <i class="fa fa-boxes"></i> TODOS LOS SERVICIOS</a>
        <?php $i=0; foreach($categorias_servicios as $categoria){ ?>
        <a class="nav-link" id="menu-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" href="<?php echo base_url('categoria/servicios?slug='.$categoria->CATEGORIA_URL); ?>">
          <i class="<?php echo $categoria->CATEGORIA_ICONO; ?>"></i> <?php echo $categoria->CATEGORIA_NOMBRE; ?>
        </a>
        <?php $i++;  } ?>
      </div>

    </div>
  </div>

  <!-- Termina Header -->
