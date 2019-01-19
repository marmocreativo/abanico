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

  <div class="menu-superior bg<?php echo $primary; ?>"></div>
  <div class="menu-principal">
    <nav class="navbar navbar-expand">
      <a class="navbar-brand mr-2" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" alt=""></a>

      <form class="form-inline my-3 mr-2 w-75" action="<?php echo base_url('categoria/busqueda') ?>" method="get">
        <div class="input-group input-group-sm">
          <input class="form-control" type="search" name="Busqueda" placeholder="Busca lo Mejor" aria-label="Search">
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
        <a class="nav-link" href="<?php echo base_url('usuario/registrar'); ?>"> <i class="fas fa-user-plus"></i> Registrarse</a>
        <a class="nav-link" href="#"> <i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
        <span class="separador mt-3 mb-3"></span>
        <a class="nav-link" href="http://localhost/abanico-master/usuario/favoritos"> <i class="fas fa-heart"></i> Favoritos</a>
      </div>
    </div>
  </div>

  <div class="menu-inferior submenu collapse" id="menu-productos">
    <div class="card py-3 px-2">

      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link" href="http://localhost/abanico-master/categoria"> <i class="fa fa-boxes"></i> TODOS LOS PRODUCTOS</a>
          <a class="nav-link" id="menu-categoria-24" data-toggle="pill" href="#cont-categoria-24" role="tab" aria-controls="cont-categoria-24" aria-selected="true"> <i class="fas fa-laptop"></i> Tecnología, Computación y Gadgets</a>
          <a class="nav-link" id="menu-categoria-25" data-toggle="pill" href="#cont-categoria-25" role="tab" aria-controls="cont-categoria-25" aria-selected="true"> <i class="fas fa-spa"></i> Belleza y Cuidado Personal</a>
          <a class="nav-link" id="menu-categoria-26" data-toggle="pill" href="#cont-categoria-26" role="tab" aria-controls="cont-categoria-26" aria-selected="true"> <i class="fas fa-futbol"></i> Deportes y Aire Libre</a>
          <a class="nav-link" id="menu-categoria-27" data-toggle="pill" href="#cont-categoria-27" role="tab" aria-controls="cont-categoria-27" aria-selected="true"> <i class="fas fa-blender"></i> Hogar y Electrodomésticos</a>
          <a class="nav-link" id="menu-categoria-28" data-toggle="pill" href="#cont-categoria-28" role="tab" aria-controls="cont-categoria-28" aria-selected="true"> <i class="fas fa-wrench"></i> Herramientas e Industria</a>
          <a class="nav-link" id="menu-categoria-29" data-toggle="pill" href="#cont-categoria-29" role="tab" aria-controls="cont-categoria-29" aria-selected="true"> <i class="fas fa-shapes"></i> Juguetes y Bebés</a>
          <a class="nav-link" id="menu-categoria-30" data-toggle="pill" href="#cont-categoria-30" role="tab" aria-controls="cont-categoria-30" aria-selected="true"> <i class="fas fa-book"></i> Libros</a>
          <a class="nav-link" id="menu-categoria-31" data-toggle="pill" href="#cont-categoria-31" role="tab" aria-controls="cont-categoria-31" aria-selected="true"> <i class="fas fa-tshirt"></i> Moda Joyas y Relojes</a>
          <a class="nav-link" id="menu-categoria-32" data-toggle="pill" href="#cont-categoria-32" role="tab" aria-controls="cont-categoria-32" aria-selected="true"> <i class="fas fa-couch"></i> Muebles</a>
          <a class="nav-link" id="menu-categoria-33" data-toggle="pill" href="#cont-categoria-33" role="tab" aria-controls="cont-categoria-33" aria-selected="true"> <i class="fas fa-car"></i> Vehículos y Accesorios</a>
          <a class="nav-link" id="menu-categoria-34" data-toggle="pill" href="#cont-categoria-34" role="tab" aria-controls="cont-categoria-34" aria-selected="true"> <i class="fas fa-hand-holding-heart"></i> Manualidades y Artesanías</a>
          <a class="nav-link" id="menu-categoria-35" data-toggle="pill" href="#cont-categoria-35" role="tab" aria-controls="cont-categoria-35" aria-selected="true"> <i class="fas fa-apple-alt"></i> El Super</a>
       </div>

    </div>
  </div>

  <div class="menu-inferior submenu collapse" id="menu-servicios">
    <div class="card py-3 px-2">

      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link" href="http://localhost/abanico-master/categoria/servicios"> <i class="fa fa-boxes"></i> TODOS LOS SERVICIOS</a>
          <a class="nav-link" id="menu-categoria-104" data-toggle="pill" href="#cont-categoria-104" role="tab" aria-controls="cont-categoria-104" aria-selected="true"><i class="fas fa-wrench"></i> Ingeniería y Construcción</a>
          <a class="nav-link" id="menu-categoria-105" data-toggle="pill" href="#cont-categoria-105" role="tab" aria-controls="cont-categoria-105" aria-selected="true"><i class="fas fa-home"></i> Mantenimiento y Hogar</a>
          <a class="nav-link" id="menu-categoria-106" data-toggle="pill" href="#cont-categoria-106" role="tab" aria-controls="cont-categoria-106" aria-selected="true"><i class="fas fa-car"></i> Mecánicos y Automotrices</a>
          <a class="nav-link" id="menu-categoria-107" data-toggle="pill" href="#cont-categoria-107" role="tab" aria-controls="cont-categoria-107" aria-selected="true"><i class="fas fa-user-tie"></i> Administración</a>
          <a class="nav-link" id="menu-categoria-108" data-toggle="pill" href="#cont-categoria-108" role="tab" aria-controls="cont-categoria-108" aria-selected="true"><i class="fas fa-paint-brush"></i> Arte y entretenimiento</a>
          <a class="nav-link" id="menu-categoria-109" data-toggle="pill" href="#cont-categoria-109" role="tab" aria-controls="cont-categoria-109" aria-selected="true"><i class="fas fa-briefcase-medical"></i> Salud</a>
      </div>

    </div>
  </div>

  <!-- Termina Header -->
