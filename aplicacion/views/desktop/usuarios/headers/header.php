<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/estilos_abanico_desktop.css">
    <title>Prueba <?php //echo $op['titulo_sitio'] ?></title>
  </head>
  <body>
    <!-- Header -->
    <div class="menu-superior bg<?php echo $primary; ?>">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <a href="#" class="btn btn-link"> <span class="fa fa-phone"></span> Atención a Clientes 01 5555-5555</a>
          </div>
          <div class="col">
            <div class="btn-group float-right" role="group" aria-label="Button group with nested dropdown">
              <?php $this->load->view('desktop/tienda/widgets/menu_divisa'); ?>
              <?php $this->load->view('desktop/tienda/widgets/menu_lenguaje'); ?>
              <?php $this->load->view('desktop/tienda/widgets/menu_usuario'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-principal">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo $baseurl=base_url(); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" width="50px" alt=""> ABANICO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <!--<li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#menu-categorias" role="button" aria-expanded="false" aria-controls="menu-categorias">CATEGORÍAS <span class="fa fa-list"></span> </a>
            </li>-->
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $baseurl=base_url(); ?>"> <span class="fa fa-shopping-bag"></span> Volver a la tienda</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <!-- Termina Header -->
