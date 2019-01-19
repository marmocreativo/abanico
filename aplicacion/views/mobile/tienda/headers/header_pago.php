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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/estilos_abanico_mobile.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/barrating/themes/fontawesome-stars.css">
    <title>Pago | <?php echo $op['titulo_sitio'] ?></title>
  </head>
  <body>
    <!-- Header -->
    <!-- Header -->
    <div class="menu-superior bg<?php echo $primary; ?>"></div>
    </div>
    <div class="menu-principal">
      <nav class="navbar navbar-expand menuUsuario">
        <div class="d-flex justify-content-arround align-items-center">
          <a class="navbar-brand mr-1" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" alt=""></a>
        </div>

        <div class="collapse navbar-collapse d-flex justify-content-between">
          <div class="w-100 d-flex">
            <a class="nav-link" href="<?php echo base_url(); ?>"> <span class="fa fa-shopping-bag"></span> Volver a la tienda</a>
          </div>
        </div>

        <ul class="navbar-nav">
          <li class="nav-item">
            <button type="button" class="btn btn-sm btnBx collapsed btnFunction" data-toggle="collapse" href="#menu-categorias" role="button" aria-expanded="false" aria-controls="menu-categorias">
              <span class="hamburger-top-bread"></span>
              <span class="hamburger-patty"></span>
              <span class="hamburger-bottom-bread"></span>
            </button>
          </li>
        </ul>
      </nav>

      <div class="bandaMenu">
        <div class="barra-color barra-azul"></div>
        <div class="barra-color barra-rosa"></div>
        <div class="barra-color barra-amarillo"></div>
        <div class="barra-color barra-verde"></div>
        <div class="barra-color barra-morado"></div>
      </div>
    </div>

    <div class="menu-inferior menuUsuarioBefore collapse" id="menu-categorias">
      <div class="card py-3 px-2">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link" href="<?php echo base_url('usuario/registrar'); ?>"> <i class="fas fa-user-plus"></i> Registrarse</a>
          <a class="nav-link" href="#"> <i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
          <span class="separador mt-3 mb-3"></span>
          <a class="nav-link" href="http://localhost/abanico-master/usuario/favoritos"> <i class="fas fa-heart"></i> Favoritos</a>
          <span class="separador mt-3 mb-3"></span>
        </div>
      </div>
    </div>

    <!-- Termina Header -->
