<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
  <div class="kt-container kt-body kt-grid kt-grid--ver" id="kt_body">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

      <!-- begin:: Subheader -->
      <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
        </div>
        <div class="kt-subheader__toolbar">
        </div>
      </div>

      <!-- end:: Subheader -->

      <!-- begin:: Content -->
      <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--Begin::Dashboard 8-->

        <!--Begin::Section-->
        <div class="row mb-3">
          <div class="col-xl-12">

            <!--begin:: Widgets/Trends-->
            <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
              <div class="kt-portlet__body">
<div class="row">
  <div class="col mt-3">
    <?php retro_alimentacion(); ?>
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <div class="titulo">
          <?php switch ($tipo_categoria) {
            case 'productos':
              $titulo = 'Categorias de Productos Minoristas';
              break;
            case 'mayoreo':
              $titulo = 'Categorias de Productos de Mayoreo';
              break;
            case 'servicios':
              $titulo = 'Categorias de Servicios';
              break;
            case 'ayuda':
              $titulo = 'Temas de Ayuda';
              break;
            default:
              $titulo = 'Categorias Principales';
              break;
          } ?>
          <h1 class="h5"> <span class="fa fa-list"></span> <?php echo $titulo; ?></h1>
        </div>
      </div>
      <div class="card-body">
          <div id="accordion">
            <?php foreach($categorias as $categoria){ ?>
                <div class="card">
                  <div class="card-header  d-flex justify-content-between" id="categoria-<?php echo $categoria->ID_CATEGORIA; ?>">
                    <div class="titulo">
                      <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $categoria->ID_CATEGORIA; ?>" aria-expanded="true" aria-controls="collapseOne">
                          <span class="<?php echo $categoria->CATEGORIA_ICONO; ?>"></span> <span style="<?php if($categoria->CATEGORIA_ESTADO=='borrada'){echo 'text-decoration: line-through';} ?>"><?php echo $categoria->CATEGORIA_NOMBRE; ?></span>
                        </button>
                        <?php foreach($lenguajes as $lenguaje){ ?>
                          <?php if($lenguaje->LENGUAJE_ISO!='es'){ ?>
                            <?php $traduccion = $this->TraduccionesModel->lista($categoria->ID_CATEGORIA,'categoria',$lenguaje->LENGUAJE_ISO); ?>
                            <br><b><?php echo $lenguaje->LENGUAJE_ISO ?></b> <small><?php echo $traduccion['TITULO']; ?></small>
                          <?php }// reviso que no sea Español ?>
                        <?php }// Bucle de todos los mensajes ?>
                      </h5>
                    </div>
                    <div class="opciones">
                      <div class="btn-group btn-sm">
                        <a href="<?php echo base_url('admin/categorias/actualizar?id='.$categoria->ID_CATEGORIA.'&tipo_categoria='.$tipo_categoria.'&tab='.$categoria->ID_CATEGORIA); ?>" class="btn btn-sm btn-warning" title="Editar Categoría"> <span class="fa fa-pencil-alt"></span> Editar</a>
                        <button data-enlace='<?php echo base_url('admin/categorias/borrar?id='.$categoria->ID_CATEGORIA.'&tipo_categoria='.$tipo_categoria.'&tab='.$categoria->ID_CATEGORIA); ?>' class="btn btn-danger btn-sm borrar_entrada" title="Eliminar Categoría"> <span class="fa fa-trash"></span> Borrar</button>
                      </div>

                    </div>
                  </div>

                  <div id="collapse<?php echo $categoria->ID_CATEGORIA; ?>" class="collapse <?php if(isset($_GET['tab'])&&$_GET['tab']=='collapse'.$categoria->ID_CATEGORIA){ echo 'show'; } ?>" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="row">
                            <?php
                              // Segundo Nivel
                              $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'','');
                              foreach($segundo_categorias as $segunda_categoria){
                            ?>
                              <div class="col-4 mb-3">
                                <div class="border border-default p-2">
                                  <p class="h6">
                                    <span style="<?php if($segunda_categoria->CATEGORIA_ESTADO=='borrada'){echo 'text-decoration: line-through';} ?>" ><?php echo $segunda_categoria->CATEGORIA_NOMBRE  ?></span>
                                    <a href="<?php echo base_url('admin/categorias/actualizar?id='.$segunda_categoria->ID_CATEGORIA.'&tipo_categoria='.$tipo_categoria.'&tab='.$categoria->ID_CATEGORIA); ?>" class="btn btn-outline-warning btn-sm" title="Editar Categoría"> <span class="fa fa-pencil-alt"></span> </a>
                                    <button data-enlace='<?php echo base_url('admin/categorias/borrar?id='.$segunda_categoria->ID_CATEGORIA.'&tipo_categoria='.$tipo_categoria.'&tab='.$categoria->ID_CATEGORIA); ?>' class="btn btn-outline-danger btn-sm borrar_entrada" title="Eliminar Categoría"> <span class="fa fa-trash"></span> </button>
                                    <?php foreach($lenguajes as $lenguaje){ ?>
                                      <?php if($lenguaje->LENGUAJE_ISO!='es'){ ?>
                                        <?php $traduccion = $this->TraduccionesModel->lista($segunda_categoria->ID_CATEGORIA,'categoria',$lenguaje->LENGUAJE_ISO); ?>
                                        <br><b><?php echo $lenguaje->LENGUAJE_ISO ?></b> <small><?php echo $traduccion['TITULO']; ?></small>
                                      <?php }// reviso que no sea Español ?>
                                    <?php }// Bucle de todos los mensajes ?>
                                  </p>
                                    <ul class="list-group mb-3">
                                    <?php
                                      // Segundo Nivel
                                      $tercero_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'','');
                                      foreach($tercero_categorias as $tercera_categoria){
                                    ?>
                                      <li class="list-group-item">
                                        <span style="<?php if($tercera_categoria->CATEGORIA_ESTADO=='borrada'){echo 'text-decoration: line-through';} ?>" > <?php echo $tercera_categoria->CATEGORIA_NOMBRE ?></span>
                                        <a href="<?php echo base_url('admin/categorias/actualizar?id='.$tercera_categoria->ID_CATEGORIA.'&tipo_categoria='.$tipo_categoria.'&tab='.$categoria->ID_CATEGORIA); ?>" class="btn btn-outline-warning btn-sm"> <span class="fa fa-pencil-alt"></span> </a>
                                        <button data-enlace='<?php echo base_url('admin/categorias/borrar?id='.$tercera_categoria->ID_CATEGORIA.'&tipo_categoria='.$tipo_categoria.'&tab='.$categoria->ID_CATEGORIA); ?>' class="btn btn-outline-danger btn-sm borrar_entrada" title="Eliminar Categoría"> <span class="fa fa-trash"></span> </button>
                                        <?php foreach($lenguajes as $lenguaje){ ?>
                                          <?php if($lenguaje->LENGUAJE_ISO!='es'){ ?>
                                            <?php $traduccion = $this->TraduccionesModel->lista($tercera_categoria->ID_CATEGORIA,'categoria',$lenguaje->LENGUAJE_ISO); ?>
                                            <br><b><?php echo $lenguaje->LENGUAJE_ISO ?></b> <small><?php echo $traduccion['TITULO']; ?></small>
                                          <?php }// reviso que no sea Español ?>
                                        <?php }// Bucle de todos los mensajes ?>
                                      </li>
                                    <?php } ?>
                                    </ul>
                                    <a href="<?php echo base_url('admin/categorias/crear?tipo_categoria='.$segunda_categoria->CATEGORIA_TIPO.'&categoria_padre='.$segunda_categoria->ID_CATEGORIA.'&tab='.$categoria->ID_CATEGORIA); ?>" class="btn btn-outline-success btn-sm"> <span class="fa fa-plus"></span> Nueva Categoría Nivel 3</a>
                                </div>
                              </div>
                            <?php } ?>
                            <div class="col-4 mb-3">
                              <div class="border border-default p-2">
                                <a href="<?php echo base_url('admin/categorias/crear?tipo_categoria='.$tipo_categoria.'&categoria_padre='.$categoria->ID_CATEGORIA.'&tab='.$categoria->ID_CATEGORIA); ?>" class="btn btn-outline-success"> <span class="fa fa-plus"></span> Nueva Categoría Nivel 2</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <?php } ?>
            <hr>
            <a href="<?php echo base_url('admin/categorias/crear?tipo_categoria='.$tipo_categoria); ?>" class="btn btn-outline-success btn-lg"> <span class="fa fa-plus"></span> Nueva Categoría Principal</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<!--end:: Widgets/Trends-->
</div>
</div>
<!--End::Section-->

<!--End::Dashboard 8-->
</div>

<!-- end:: Content -->
</div>
</div>
</div>
