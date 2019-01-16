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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/slider-pro-master/css/slider-pro.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/estilos_abanico_desktop.css">
    <title><?php echo $op['titulo_sitio']; ?></title>
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
          <a class="btn <?php echo 'btn-link'.$primary; ?> mr-3" data-toggle="collapse" href="#menu-categorias" role="button" aria-expanded="false" aria-controls="menu-categorias"><i class="fas fa-angle-down mr-2"></i>CATEGORÍAS</a>
          <a class="btn <?php echo 'btn-link'.$primary; ?> mr-3" data-toggle="collapse" href="#menu-categorias" role="button" aria-expanded="false" aria-controls="menu-categorias"><i class="fas fa-angle-down mr-2"></i>SERVICIOS</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse">
          <form class="form-inline my-2 my-lg-0 mr-auto w-75" action="<?php echo base_url('categoria/busqueda') ?>" method="get">
            <div class="input-group w-100">
              <input class="form-control w-50" type="search" name="Busqueda" placeholder="Busca lo Mejor" aria-label="Search">
              <select class="form-control" aria-label="Example select with button addon">
                <option value="todo">En Todo</option>
                <option value="productos">En Productos</option>
                <option value="servicios">En Servicios</option>
              </select>
              <div class="input-group-append">
                <button type="submit" class="btn <?php echo 'btn-outline'.$primary; ?>" type="button"> <i class="fa fa-search"></i> </button>
              </div>
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link btn-sm" href="<?php echo base_url('usuario/favoritos'); ?>"><i class="far fa-heart text-primary-6"></i> Favoritos</a>
            </li>
            <li class="nav-item">
              <button type="button" class="btn btn-sm <?php echo 'btn-link'.$primary; ?> text-primary" data-toggle="modal" data-target="#ModalCarrito" style="background:transparent;"> <span class="fa fa-shopping-cart text-primary-1"></span> Carrito</button>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="pre-footer">
      <div class="barra-color barra-azul"></div>
      <div class="barra-color barra-rosa"></div>
      <div class="barra-color barra-amarillo"></div>
      <div class="barra-color barra-verde"></div>
      <div class="barra-color barra-morado"></div>
    </div>
    <div class="menu-inferior collapse" id="menu-categorias">
<div class="" >
  <div class="card card-body">
    <div class="row">
      <div class="col-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link" href="<?php echo base_url('categoria'); ?>"> <i class="fa fa-boxes"></i> TODOS LOS PRODUCTOS</a>
          <?php $i=0; foreach($categorias as $categoria){ ?>
          <a class="nav-link <?php if($i==0){ echo 'active bg'.$primary;} ?>" id="menu-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" data-toggle="pill" href="#cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" role="tab" aria-controls='cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>' aria-selected="true">
            <i class="<?php echo $categoria->CATEGORIA_ICONO; ?>"></i> <?php echo $categoria->CATEGORIA_NOMBRE; ?>
          </a>
          <?php $i++;  } ?>
        </div>
      </div>
      <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
          <?php $i=0; foreach($categorias as $categoria){ ?>
          <div class="tab-pane fade <?php if($i==0){ echo 'active show';} ?>" id="cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" role="tabpanel" aria-labelledby="v-pills-1-tab">
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
        <?php $i++; } ?>
        </div>
      </div>
    </div>

  </div>
</div>
    </div>

    <!-- Termina Header -->
