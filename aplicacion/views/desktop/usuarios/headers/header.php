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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/estilos_abanico_desktop.css">
    <title>Usuarios | <?php echo $op['titulo_sitio']; ?></title>
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
              <?php //$this->load->view('desktop/tienda/widgets/menu_lenguaje'); ?>
              <?php $this->load->view('desktop/tienda/widgets/menu_usuario'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-principal">
      <nav class="navbar navbar-expand">
        <div class="d-flex justify-content-arround align-items-center">
          <a class="navbar-brand mr-1" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" alt=""></a>
        </div>
        <div class="collapse navbar-collapse d-flex justify-content-between">
          <div class="w-100 d-flex justify-content-end">
            <a class="nav-link" href="<?php echo base_url(); ?>"> <span class="fa fa-shopping-bag"></span> Volver a la tienda</a>

          <?php if(isset($_SESSION['usuario'])&&verificar_permiso(['tec-5','adm-6'])){ ?>
            <a class="nav-link" href="<?php echo base_url('admin'); ?>"> <span class="fa fa-tachometer-alt"></span> Administrador</a>
          <?php } ?>
          </div>
        </div>
      </nav>
    </div>
    <!-- Termina Header -->
