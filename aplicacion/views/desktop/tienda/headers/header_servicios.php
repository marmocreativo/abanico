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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/flexslider/flexslider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/estilos_abanico_desktop.css">
    <title><?php echo $op['titulo_sitio']; ?></title>
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
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-principal">
      <nav class="navbar navbar-expand">
        <div class="d-flex justify-content-arround align-items-center">
          <a class="navbar-brand mr-1" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" alt=""></a>
          <a class="btn <?php echo 'btn-outline'.$primary; ?> mr-3" data-toggle="collapse" href="#menu-categorias" role="button" aria-expanded="false" aria-controls="menu-categorias">SERVICIOS <span class="fa fa-list"></span> </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse d-flex justify-content-between">
          <form class="w-75" action="<?php echo base_url('categoria/busqueda') ?>" method="get">
            <div class="input-group">
              <input class="form-control w-50" type="search" name="Busqueda" placeholder="Busca lo Mejor" aria-label="Search">
              <select class="form-control" aria-label="Example select with button addon">
                <option value="todo">En Todo</option>
                <option value="productos">En productos</option>
                <option value="servicios">En servicios</option>
              </select>
              <div class="input-group-append">
                <button type="submit" class="btn <?php echo 'btn'.$primary; ?>" type="button"> <i class="fa fa-search"></i> </button>
              </div>
            </div>
          </form>
          <div class="w-25 d-flex justify-content-end">
            <a class="btn <?php echo 'btn-outline'.$primary; ?>" href="<?php echo base_url('usuario/favoritos'); ?>"> <span class="fa fa-heart"></span> Favoritos</a>
            <button class="btn btn-carrito <?php echo 'btn-outline'.$primary; ?>  ml-3" data-toggle="modal" data-target="#ModalCarrito"> <span class="fa fa-shopping-cart"></span> Carrito</button>
          </div>
        </div>
      </nav>
    </div>
    <div class="menu-inferior collapse" id="menu-categorias">
      <div class="" >
        <div class="card card-body">
          <div class="row">
            <div class="col-12">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" href="<?php echo base_url('categoria/servicios'); ?>"> <i class="fa fa-boxes"></i> TODOS LOS SERVICIOS</a>
                <?php $i=0; foreach($categorias as $categoria){ ?>
                <a class="nav-link <?php if($i==0){ echo 'active bg'.$primary;} ?>" id="menu-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" data-toggle="pill" href="#cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" role="tab" aria-controls='cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>' aria-selected="true">
                  <i class="<?php echo $categoria->CATEGORIA_ICONO; ?>"></i> <?php echo $categoria->CATEGORIA_NOMBRE; ?>
                </a>
                <?php ++$i;  } ?>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Termina Header -->
