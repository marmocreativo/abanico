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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/flexslider/flexslider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/tienda/js/slider-pro-master/css/slider-pro.css?ver=<?php echo date('U'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/estilos_abanico_desktop.css?ver=<?php echo date('U'); ?>">
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
              <?php $this->load->view('desktop/tienda/widgets/menu_notificaciones'); ?>
              <?php $this->load->view('desktop/tienda/widgets/menu_divisa'); ?>
              <?php $this->load->view('desktop/tienda/widgets/menu_lenguaje'); ?>
              <?php $this->load->view('desktop/tienda/widgets/menu_usuario'); ?>
              <button type="button" class="btn btn-sm <?php echo 'btn-link'.$primary; ?> text-light" data-toggle="modal" data-target="#ModalAyuda" style="background:transparent;"><i class="far fa-question-circle"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-principal">
      <nav class="navbar navbar-expand">
        <div class="d-flex justify-content-arround align-items-center">
          <a class="navbar-brand mr-1" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/global/img/logo.png" alt=""></a>
          <a class="btn <?php echo 'btn-link'.$primary; ?> mr-3" id="desplegar-menu-productos" data-toggle="collapse" href="#menu-categorias" role="button" aria-expanded="false" aria-controls="menu-categorias"><i class="fas fa-angle-down mr-2"></i><?php echo $this->lang->line('header_categorias_productos_boton'); ?></a>
          <a class="btn <?php echo 'btn-link'.$primary; ?> mr-3" id="desplegar-menu-servicios" data-toggle="collapse" href="#menu-categorias-servicios" role="button" aria-expanded="false" aria-controls="menu-categorias-servicios"><i class="fas fa-angle-down mr-2"></i><?php echo $this->lang->line('header_categorias_servicios_boton'); ?></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse">
          <form class="form-inline my-2 my-lg-0 mr-auto w-75" action="<?php echo base_url('busqueda') ?>" method="get">
            <div class="input-group w-100">
              <input class="form-control w-50" type="search" name="Busqueda" placeholder="<?php echo $this->lang->line('header_formulario_busqueda_buscar'); ?>" aria-label="Search" value="<?php if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){ echo filter_var ( $_GET['Busqueda'], FILTER_SANITIZE_STRING); } ?>">
              <select class="form-control" name="BuscarEn">
                <option value="productos" <?php if(isset($_GET['BuscarEn'])&&$_GET['BuscarEn']=='productos'){ echo 'selected'; } ?>><?php echo $this->lang->line('header_formulario_busqueda_en_productos'); ?></option>
                <option value="servicios" <?php if(isset($_GET['BuscarEn'])&&$_GET['BuscarEn']=='servicios'){ echo 'selected'; } ?>><?php echo $this->lang->line('header_formulario_busqueda_en_servicios'); ?></option>
              </select>
              <div class="input-group-append">
                <button type="submit" class="btn <?php echo 'btn-outline'.$primary; ?>" type="button"> <i class="fa fa-search"></i> </button>
              </div>
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a href="<?php echo base_url('usuario/favoritos'); ?>">
              <button type="button" class="btn btn-sm btn-carrito btn-link-primary text-primary">
                <i class="far fa-heart text-primary-6"></i> <?php echo $this->lang->line('header_boton_favoritos'); ?>
              </button>
              </a>
            </li>
            <li class="nav-item">
              <button type="button" class="btn btn-sm btn-carrito <?php echo 'btn-link'.$primary; ?> text-primary" data-toggle="modal" data-target="#ModalCarrito" style="background:transparent;"> <span class="fa fa-shopping-cart text-primary-1"></span> <?php echo $this->lang->line('header_boton_carrito'); ?></button>
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
                <a class="nav-link" href="<?php echo base_url('categoria'); ?>"> <i class="fa fa-boxes"></i> <?php echo $this->lang->line('header_categorias_productos_todos'); ?></a>
                <?php $i=0; foreach($categorias as $categoria){ ?>
                  <?php
                    // Variables de traducción
                    if($_SESSION['lenguaje']['iso']=='es'){
                      $titulo = $categoria->CATEGORIA_NOMBRE;
                    }else{
                      $traduccion = $this->TraduccionesModel->lista($categoria->ID_CATEGORIA,'categoria',$_SESSION['lenguaje']['iso']);
                      if(!empty($traduccion['TITULO'])){
                        $titulo = $traduccion['TITULO'];
                      }else{
                        $titulo = $categoria->CATEGORIA_NOMBRE;
                      }
                    }
                  ?>
                <a class="nav-link <?php if($i==0){ echo 'active';} ?> text<?php echo $categoria->CATEGORIA_COLOR; ?>" id="menu-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" data-toggle="pill" href="#cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" role="tab" aria-controls='cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>' aria-selected="true">
                  <i class="<?php echo $categoria->CATEGORIA_ICONO; ?>"></i> <?php echo $titulo; ?>
                </a>
                <?php ++$i;  } ?>
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
                          <?php
                            // Variables de traducción
                            if($_SESSION['lenguaje']['iso']=='es'){
                              $titulo_segundo = $segunda_categoria->CATEGORIA_NOMBRE;
                            }else{
                              $traduccion = $this->TraduccionesModel->lista($segunda_categoria->ID_CATEGORIA,'categoria',$_SESSION['lenguaje']['iso']);
                              if(!empty($traduccion['TITULO'])){
                                $titulo_segundo = $traduccion['TITULO'];
                              }else{
                                $titulo_segundo = $segunda_categoria->CATEGORIA_NOMBRE;
                              }
                            }
                          ?>
                          <div class="col-4">
                            <h4><a href="<?php echo base_url('categoria?slug='.$segunda_categoria->CATEGORIA_URL); ?>" class="text<?php echo $segunda_categoria->CATEGORIA_COLOR; ?>">
                              <?php echo $titulo_segundo; ?>
                            </a></h4>
                            <?php   $tercero_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'',''); ?>
                            <ul class="list list-unstyled">
                              <?php foreach($tercero_categorias as $tercera_categoria){ ?>
                                <?php
                                  // Variables de traducción
                                  if($_SESSION['lenguaje']['iso']=='es'){
                                    $titulo_tercero = $tercera_categoria->CATEGORIA_NOMBRE;
                                  }else{
                                    $traduccion = $this->TraduccionesModel->lista($tercera_categoria->ID_CATEGORIA,'categoria',$_SESSION['lenguaje']['iso']);
                                    if(!empty($traduccion['TITULO'])){
                                      $titulo_tercero = $traduccion['TITULO'];
                                    }else{
                                      $titulo_tercero = $tercera_categoria->CATEGORIA_NOMBRE;
                                    }
                                  }
                                ?>
                                <li> <a href="<?php echo base_url('categoria?slug='.$tercera_categoria->CATEGORIA_URL); ?>">
                                  <?php echo $titulo_tercero;  ?>
                                </a></li>
                              <?php } ?>
                            </ul>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="col">
                      <img src="<?php echo base_url('contenido/img/categorias/completo/'.$categoria->CATEGORIA_IMAGEN); ?>" class="img-fluid" alt="">
                    </div>
                  </div>
                </div>
              <?php ++$i; } ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="menu-inferior collapse" id="menu-categorias-servicios">
      <div class="" >
        <div class="card card-body">
          <div class="row">
            <div class="col-3">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" href="<?php echo base_url('categoria/servicios'); ?>"> <i class="fa fa-boxes"></i> <?php echo $this->lang->line('header_categorias_servicios_todos'); ?></a>
                <?php $i=0; foreach($categorias_servicios as $categoria){ ?>
                  <?php
                    // Variables de traducción
                    if($_SESSION['lenguaje']['iso']=='es'){
                      $titulo = $categoria->CATEGORIA_NOMBRE;
                    }else{
                      $traduccion = $this->TraduccionesModel->lista($categoria->ID_CATEGORIA,'categoria',$_SESSION['lenguaje']['iso']);
                      if(!empty($traduccion['TITULO'])){
                        $titulo = $traduccion['TITULO'];
                      }else{
                        $titulo = $categoria->CATEGORIA_NOMBRE;
                      }
                    }
                  ?>
                <a class="nav-link <?php if($i==0){ echo 'active';} ?> text<?php echo $categoria->CATEGORIA_COLOR; ?>" id="menu-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" data-toggle="pill" href="#cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" role="tab" aria-controls='cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>' aria-selected="true">
                  <i class="<?php echo $categoria->CATEGORIA_ICONO; ?>"></i> <?php echo $titulo; ?>
                </a>
                <?php ++$i;  } ?>
              </div>
            </div>
            <div class="col-9">
              <div class="tab-content" id="v-pills-tabContent">
                <?php $i=0; foreach($categorias_servicios as $categoria){ ?>
                <div class="tab-pane fade <?php if($i==0){ echo 'active show';} ?>" id="cont-categoria-<?php echo $categoria->ID_CATEGORIA; ?>" role="tabpanel" aria-labelledby="v-pills-1-tab">
                  <div class="row">
                    <div class="col-9">
                      <?php   $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
                      <div class="row">
                        <?php foreach($segundo_categorias as $segunda_categoria){ ?>
                          <?php
                            // Variables de traducción
                            if($_SESSION['lenguaje']['iso']=='es'){
                              $titulo_segundo = $segunda_categoria->CATEGORIA_NOMBRE;
                            }else{
                              $traduccion = $this->TraduccionesModel->lista($segunda_categoria->ID_CATEGORIA,'categoria',$_SESSION['lenguaje']['iso']);
                              if(!empty($traduccion['TITULO'])){
                                $titulo_segundo = $traduccion['TITULO'];
                              }else{
                                $titulo_segundo = $segunda_categoria->CATEGORIA_NOMBRE;
                              }
                            }
                          ?>
                          <div class="col-4">
                            <h4><a href="<?php echo base_url('categoria/servicios?slug='.$segunda_categoria->CATEGORIA_URL); ?>" class="text<?php echo $segunda_categoria->CATEGORIA_COLOR; ?>">
                              <?php echo $titulo_segundo; ?>
                            </a></h4>
                            <?php   $tercero_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'',''); ?>
                            <ul class="list list-unstyled">
                              <?php foreach($tercero_categorias as $tercera_categoria){ ?>
                                <?php
                                  // Variables de traducción
                                  if($_SESSION['lenguaje']['iso']=='es'){
                                    $titulo_tercero = $tercera_categoria->CATEGORIA_NOMBRE;
                                  }else{
                                    $traduccion = $this->TraduccionesModel->lista($tercera_categoria->ID_CATEGORIA,'categoria',$_SESSION['lenguaje']['iso']);
                                    if(!empty($traduccion['TITULO'])){
                                      $titulo_tercero = $traduccion['TITULO'];
                                    }else{
                                      $titulo_tercero = $tercera_categoria->CATEGORIA_NOMBRE;
                                    }
                                  }
                                ?>
                                <li> <a href="<?php echo base_url('categoria?slug='.$tercera_categoria->CATEGORIA_URL); ?>"><?php echo $titulo_tercero;  ?></a></li>
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
              <?php ++$i; } ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <?php
    $CI =& get_instance();
    $CI->load->model('ConcursosModel');
    $concurso = $CI->ConcursosModel->activo();
    $productos_concurso = explode(' ',$concurso['PRODUCTOS']);
    $frase_concurso = explode(' ',$concurso['FRASE']);
    shuffle($frase_concurso);
    ?>
    <?php if(!empty($concurso)){ ?>
      <div>
        <div class="container">
        <div class="row py-4" style="min-height:50px" id="sortable">
          <?php foreach($frase_concurso as $palabra){ ?>
          <div class="col p-3 border border-primary" >
            <?php echo $palabra; ?>
          </div>
          <?php } ?>
        </div>
        </div>
      </div>
    <?php } ?>
    <!-- Termina Header -->
