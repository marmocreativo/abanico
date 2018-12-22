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
            <a href="#" class="btn btn-link"> <span class="fa fa-phone"></span> Atención a Clientes <?php echo $op['telefono_sitio'] ?></a>
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
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" width="50px" alt=""> ABANICO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#menu-categorias" role="button" aria-expanded="false" aria-controls="menu-categorias">CATEGORÍAS <span class="fa fa-list"></span> </a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0 w-50 d-flex flex-row" action="<?php echo base_url('categoria/busqueda') ?>" method="get">
            <input class="form-control mr-sm-2 w-75" type="search" name="Busqueda" placeholder="Busca lo Mejor" aria-label="Search">
            <button class="btn btn<?php echo $primary; ?> my-2 my-sm-0 mw-100" type="submit"> <span class="fa fa-search"></span> Buscar</button>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#"> <span class="fa fa-heart"></span> Favoritos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> <span class="fa fa-shopping-cart"></span> Carrito</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="menu-inferior">
<div class="collapse" id="menu-categorias">
  <div class="card card-body">
    <div class="row">
      <div class="col-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link" href="<?php echo base_url('categoria'); ?>"> <i class="fa fa-boxes"></i> TODOS LOS PRODUCTOS</a>
          <?php foreach($categorias as $categoria){ ?>
          <a class="nav-link" id="menu-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" data-toggle="pill" href="#cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" role="tab" aria-controls="cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" aria-selected="true"> <i class="<?php echo $categoria->CATEGORIA_ICONO; ?>"></i> <?php echo $categoria->CATEGORIA_NOMBRE; ?></a>
          <?php } ?>
        </div>
      </div>
      <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
          <?php foreach($categorias as $categoria){ ?>
          <div class="tab-pane fade" id="cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" role="tabpanel" aria-labelledby="v-pills-1-tab">
            <div class="row">
              <div class="col-9">
                <?php   $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
                <div class="row">
                  <?php foreach($segundo_categorias as $segunda_categoria){ ?>
                    <div class="col-4">
                      <h4><?php echo $segunda_categoria->CATEGORIA_NOMBRE; ?></h4>
                      <?php   $tercero_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'',''); ?>
                      <ul class="list list-unstyled">
                        <?php foreach($tercero_categorias as $tercera_categoria){ ?>
                          <li> <a href="<?php echo base_url('categoria?slug='.$tercera_categoria->CATEGORIA_URL); ?>"><?php echo $tercera_categoria->CATEGORIA_NOMBRE;  ?></a></li>
                        <?php } ?>
                      </ul>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <div class="col">
                <img src="<?php echo base_url('assets/tienda/img/categorias/completo/'.$categoria->CATEGORIA_IMAGEN); ?>" class="img-fluid" alt="">
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>

  </div>
</div>
    </div>

    <!-- Termina Header -->
