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
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kalam&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/estilos_abanico_desktop.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/barrating/themes/fontawesome-stars.css">
    <title>Pago | <?php echo $op['titulo_sitio'] ?></title>
  </head>
  <body>
    <!-- Header -->
    <div class="menu-superior bg<?php echo $primary; ?>">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
          </div>
          <div class="col">
            <div class="btn-group float-right" role="group" aria-label="Button group with nested dropdown">
              <?php $this->load->view('desktop/tienda/widgets/menu_divisa'); ?>
              <?php //$this->load->view('desktop/tienda/widgets/menu_lenguaje'); ?>
              <?php $this->load->view('desktop/tienda/widgets/menu_usuario'); ?>
              <button type="button" class="btn btn-sm <?php echo 'btn-link'.$primary; ?> text-light" data-toggle="modal" data-target="#ModalAyuda" style="background:transparent;"><i class="far fa-question-circle"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-principal">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" width="50px" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
    </div>
    <div class="menu-inferior">
    </div>

    <!-- Termina Header -->
