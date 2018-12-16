<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" width="50px" alt=""> ABANICO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="<?php echo base_url('categoria'); ?>">CATEGORÍAS <span class="fa fa-list"></span> </a>
              <!--
              <a class="nav-link" data-toggle="collapse" href="#menu-categorias" role="button" aria-expanded="false" aria-controls="menu-categorias">CATEGORÍAS <span class="fa fa-list"></span> </a>-->

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
          <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true"> <span class="fa fa-mobile-alt"></span> Tecnología y Computación</a>
          <a class="nav-link " id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="true"> <span class="fa fa-umbrella-beach"></span> Belleza y Salud</a>
          <a class="nav-link " id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="true"> <span class="fa fa-futbol"></span> Deportes y Aire Libre</a>
          <a class="nav-link " id="v-pills-4-tab" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-4" aria-selected="true"> <span class="fa fa-home"></span> Hogar y Electrodomésticos</a>
          <a class="nav-link " id="v-pills-5-tab" data-toggle="pill" href="#v-pills-5" role="tab" aria-controls="v-pills-5" aria-selected="true"> <span class="fa fa-toolbox"></span> Herramientas e Industria</a>
          <a class="nav-link " id="v-pills-6-tab" data-toggle="pill" href="#v-pills-6" role="tab" aria-controls="v-pills-6" aria-selected="true"> <span class="fa fa-horse"></span> Juguetes y Bebés</a>
          <a class="nav-link " id="v-pills-7-tab" data-toggle="pill" href="#v-pills-7" role="tab" aria-controls="v-pills-7" aria-selected="true"> <span class="fa fa-book"></span> Libros</a>
          <a class="nav-link " id="v-pills-8-tab" data-toggle="pill" href="#v-pills-8" role="tab" aria-controls="v-pills-8" aria-selected="true"> <span class="fa fa-gem"></span> Moda, Joyas, Relojes</a>
          <a class="nav-link " id="v-pills-9-tab" data-toggle="pill" href="#v-pills-9" role="tab" aria-controls="v-pills-9" aria-selected="true"> <span class="fa fa-building"></span> Inmuebles</a>
          <a class="nav-link " id="v-pills-10-tab" data-toggle="pill" href="#v-pills-10" role="tab" aria-controls="v-pills-10" aria-selected="true"> <span class="fa fa-car"></span> Vehículos y Accesorios</a>
        </div>
      </div>
      <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
            <div class="row">
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <img src="assets/global/img/logo_grande.png" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
            <div class="row">
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <img src="assets/global/img/default.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
            <div class="row">
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <img src="assets/global/img/default.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-4-tab">
            <div class="row">
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <img src="assets/global/img/default.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-5-tab">
            <div class="row">
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <img src="assets/global/img/default.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-6" role="tabpanel" aria-labelledby="v-pills-6-tab">
            <div class="row">
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <img src="assets/global/img/default.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-7" role="tabpanel" aria-labelledby="v-pills-7-tab">
            <div class="row">
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <img src="assets/global/img/default.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-8" role="tabpanel" aria-labelledby="v-pills-8-tab">
            <div class="row">
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <img src="assets/global/img/default.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-9" role="tabpanel" aria-labelledby="v-pills-9-tab">
            <div class="row">
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <img src="assets/global/img/default.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-10" role="tabpanel" aria-labelledby="v-pills-10-tab">
            <div class="row">
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <h4> <a href="categoria">Título Grupo</a> </h4>
                <ul>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                  <li> <a href="categoria">Subcategoría</a></li>
                </ul>
              </div>
              <div class="col">
                <img src="assets/global/img/default.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
    </div>

    <!-- Termina Header -->
