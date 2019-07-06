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
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-box"></span> Nuevo Producto</h1>
          </div>
        </div>
        <div class="card-body">
          <?php retro_alimentacion(); ?>
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <div class="row">
            <div class="col">
              <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('admin/productos/actualizar?id='.$_GET['id'].'&tab='); ?>"> <span class="fa fa-list"></span> Datos Básicos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('admin/productos/actualizar?id='.$_GET['id'].'&tab=categoria'); ?>"> <span class="fa fa-list"></span> Categorias</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('admin/productos/actualizar?id='.$_GET['id'].'&tab=datos'); ?>"> <span class="fa fa-file-alt"></span> Descripción</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('admin/productos/actualizar?id='.$_GET['id'].'&tab=galeria'); ?>"> <span class="fa fa-image"></span> Galeria</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="<?php echo base_url('admin/productos/actualizar?id='.$_GET['id']); ?>" > <span class="fa fa-sitemap"></span> Combinaciones</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active p-3" id="galeria" role="tabpanel" aria-labelledby="extras-tab">
                  <div class="row">
                    <div class="col">
                      <div class="border p-3 mb-3">
                        <form class="" action="<?php echo base_url('admin/productos_combinaciones/crear'); ?>" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="IdProducto" value="<?php echo $_GET['id']; ?>">
                          <h6> <i class="fa fa-sitemap"></i> Nueva Combinación</h6>
                          <div class="row">
                            <div class="col">
                                <div class="border border-info p-3 mb-3">
                                  <p> <i class="fas fa-info-circle"></i> Las combinaciones puedes usarlas para que los usuarios elijan características específicas de tu producto, por ejemplo Talle, Color, Capacidad, o Contenido.<br>
                                    <i class="fas fa-info-circle"></i> En cada combinación puedes especificar Precio y dimensiones en caso de que tengan algún cambio con respecto al producto por defecto.
                                  </p>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label for="GrupoCombinacion">Grupo <small>Ej. Talla</small> </label>
                                <input type="text" class="form-control" id="GrupoCombinacion" name="GrupoCombinacion" required placeholder="" value="<?=!form_error('GrupoCombinacion')?set_value('GrupoCombinacion'):''?>">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label for="OpcionCombinacion">Opción <small>Ej. Chica</small> </label>
                                <input type="text" class="form-control" id="OpcionCombinacion" name="OpcionCombinacion" required placeholder="" value="<?=!form_error('OpcionCombinacion')?set_value('OpcionCombinacion'):''?>">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label for="PrecioCombinacion">Precio de Venta</label>
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                  </div>
                                <input type="text" class="form-control" id="PrecioCombinacion" name="PrecioCombinacion" required placeholder="" value="<?php echo $producto['PRODUCTO_PRECIO']; ?>">
                                </div>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label for="CantidadCombinacion">Cantidad en Existencia </label>
                                <input type="number" class="form-control" id="CantidadCombinacion" name="CantidadCombinacion" required placeholder="" value="1">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label for="AnchoCombinacion">Ancho</label>
                                <div class="input-group input-group-sm mb-2">
                                  <input type="text" class="form-control" id="AnchoCombinacion" name="AnchoCombinacion" required placeholder="" value="<?php echo $producto['PRODUCTO_ANCHO']; ?>">
                                  <div class="input-group-append">
                                    <div class="input-group-text">cm</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label for="AltoCombinacion">Alto</label>
                                <div class="input-group input-group-sm mb-2">
                                  <input type="text" class="form-control" id="AltoCombinacion" name="AltoCombinacion" required placeholder="" value="<?php echo $producto['PRODUCTO_ALTO']; ?>">
                                  <div class="input-group-append">
                                    <div class="input-group-text">cm</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label for="ProfundoCombinacion">Profundo</label>
                                <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" id="ProfundoCombinacion" name="ProfundoCombinacion" required placeholder="" value="<?php echo $producto['PRODUCTO_PROFUNDO']; ?>">
                                  <div class="input-group-append">
                                    <div class="input-group-text">cm</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label for="PesoCombinacion">Peso</label>
                                <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" id="PesoCombinacion" name="PesoCombinacion" required placeholder="" value="<?php echo $producto['PRODUCTO_PESO']; ?>">
                                  <div class="input-group-append">
                                    <div class="input-group-text">Kg</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <label for="">Imagen</label>
                            </div>
                            <?php $i =0; foreach($galerias as $galeria){ ?>
                              <div class="col-1 text-center">
                                <label for="ImagenCombinacion-<?php echo $galeria->ID_GALERIA; ?>">
                                  <img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO) ?>" class="img-fluid" alt="">
                                  <hr>
                                  <input class="form-check-input" type="radio" name="ImagenCombinacion" id="ImagenCombinacion-<?php echo $galeria->ID_GALERIA; ?>" <?php if($i==0){echo 'checked';} ?> value="<?php echo $galeria->GALERIA_ARCHIVO; ?>">
                                </label>
                              </div>
                            <?php $i ++; } ?>
                          </div>
                          <hr>
                          <div class="row pt-3">
                            <div class="col">
                              <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Agregar Combinación</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <h5> <i class="fa fa-sitemap"></i> Combinaciones actuales</h5>
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th>Grupo</th>
                            <th>Opción</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Imagen</th>
                            <th class="text-right">Controles</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($combinaciones as $combinacion){ ?>
                          <tr>
                            <td><?php echo $combinacion->COMBINACION_GRUPO; ?></td>
                            <td><?php echo $combinacion->COMBINACION_OPCION; ?></td>
                            <td><?php echo $combinacion->COMBINACION_CANTIDAD; ?></td>
                            <td>$<?php echo $combinacion->COMBINACION_PRECIO; ?></td>
                            <td><img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$combinacion->COMBINACION_IMAGEN) ?>" width="100px;"></td>
                            <td>
                              <div class="btn-group float-right">
                                <a href="<?php echo base_url('admin/productos_combinaciones/actualizar?id='.$combinacion->ID_COMBINACION); ?>" class="btn btn-sm btn-warning" title="Editar Combinacion"> <span class="fa fa-pencil-alt"></span> </a>
                                <button data-enlace='<?php echo base_url('admin/productos_combinaciones/borrar?id='.$combinacion->ID_COMBINACION); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Combinacion"> <span class="fa fa-trash"></span> </button>
                              </div>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
