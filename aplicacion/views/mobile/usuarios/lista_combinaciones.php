<!-- empieza panel usuario resposivo -->

<div class="fila-gris">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('mobile/usuarios/widgets/menu_control_usuario'); ?>
      </div>
    </div>
  </div>
</div>

<div class="container py-3 mb-3">
  <div class="row">
    <div class="col-12">

      <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
           <h5 class="h5 pt-1"> <span class="fa fa-sitemap"></span> Combinaciones</h5>
           <a href="http://localhost/abanico-master/usuario/productos" class="btn mt-1 btn-sm btn-outline-success"> <span class="fa fa-arrow-left"></span></a>
        </div>

        <div class="card-body">
          <div class="border border-info p-3 mb-4">
            <p><i class="fas fa-info-circle"></i> Las combinaciones puedes usarlas para que los usuarios elijan características específicas de tu producto, por ejemplo Talle, Color, Capacidad, o Contenido.<br><br><i class="fas fa-info-circle"></i> En cada combinación puedes especificar Precio y dimensiones en caso de que tengan algún cambio con respecto al producto por defecto.</p>
          </div>

          <div class="card mb-3 border-0">
            <div class="">
              <h3 class="h6"><strong>Grupo: </strong>Talla</h3>
              <h3 class="h6"><strong>Opcion</strong>: Chica</h3>
              <h3 class="h6"><strong>Precio:</strong> $123.00</h3>
              <div class="btn-group float-right">
                <a href="" class="btn btn-sm btn-warning" title="Editar Dirección"> <span class="fa fa-pencil-alt"></span> </a>
                <button data-enlace="" class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Dirección"> <span class="fa fa-trash"></span> </button>
              </div>
            </div>
            <hr>
            <div class="">
              <h3 class="h6"><strong>Grupo: </strong>Talla 2</h3>
              <h3 class="h6"><strong>Opcion</strong>: Mediana</h3>
              <h3 class="h6"><strong>Precio:</strong> $123.00</h3>
              <div class="btn-group float-right">
                <a href="" class="btn btn-sm btn-warning" title="Editar Dirección"> <span class="fa fa-pencil-alt"></span> </a>
                <button data-enlace="" class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Dirección"> <span class="fa fa-trash"></span> </button>
              </div>
            </div>
          </div>

        </div>
      </div>


      <div class="card">
        <div class="card-header">
          <h5 class="pt-2"> <span class="fa fa-sitemap"></span> Crear Combinaciones</h5>
        </div>
        <div class="card-body">
          <form class="" action="" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label for="">Grupo <small>Ej. Talla</small> </label>
                <input type="text" class="form-control form-control-sm" id="" name="" required="" placeholder="" value="">
              </div>

              <div class="form-group">
                <label for="">Opción <small>Ej. Chica</small> </label>
                <input type="text" class="form-control form-control-sm" id="" name="" required="" placeholder="" value="">
              </div>

              <div class="form-group">
                <label for="">Precio de Venta</label>
                <div class="input-group input-group-sm mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">$</div>
                  </div>
                <input type="text" class="form-control form-control-sm" id="" name="" required="" placeholder="" value="123.00">
                </div>
              </div>

              <div class="form-group">
                <label for="">Ancho</label>
                <div class="input-group input-group-sm mb-2">
                  <input type="text" class="form-control form-control-sm" id="" name="" required="" placeholder="" value="12.00">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="">Alto</label>
                <div class="input-group input-group-sm mb-2">
                  <input type="text" class="form-control form-control-sm" id="" name="" required="" placeholder="" value="123.00">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="">Profundo</label>
                <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control form-control-sm" id="" name="" required="" placeholder="" value="1324.00">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="">Peso</label>
                <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control form-control-sm" id="" name="" required="" placeholder="" value="123.00">
                  <div class="input-group-append">
                    <div class="input-group-text">Kg</div>
                  </div>
                </div>
              </div>

              <div class="text-right">
                <button type="submit" class="btn btn-sm btn-primary mb-4"> <span class="fa fa-save"></span> Agregar Combinación</button>
              </div>

          </form>
        </div>
      </div>




    </div>
  </div>
</div>

<hr><hr><hr>

<!-- termina panel usuario resposivo -->

<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="titulo">
                  <h1 class="h5"> <span class="fa fa-box"></span> Actualizar <?php echo $producto['PRODUCTO_NOMBRE']; ?></h1>
                </div>
                <div class="herramientas">
                    <a href="<?php echo base_url('usuario/productos'); ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-arrow-left"></span> Regresar a los productos</a>
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
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab='); ?>"> <span class="fa fa-list"></span> Datos Básicos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab=categoria'); ?>"> <span class="fa fa-list"></span> Categorias</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab=datos'); ?>"> <span class="fa fa-file-alt"></span> Descripción</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab=galeria'); ?>"> <span class="fa fa-image"></span> Galeria</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id']); ?>" > <span class="fa fa-sitemap"></span> Combinaciones</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active p-3" id="galeria" role="tabpanel" aria-labelledby="extras-tab">
                        <div class="row">
                          <div class="col">
                            <div class="border p-3 mb-3">
                              <form class="" action="<?php echo base_url('usuario/productos_combinaciones/crear'); ?>" method="post" enctype="multipart/form-data">
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
                                  <th>Precio</th>
                                  <th class="text-right">Controles</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($combinaciones as $combinacion){ ?>
                                <tr>
                                  <td><?php echo $combinacion->COMBINACION_GRUPO; ?></td>
                                  <td><?php echo $combinacion->COMBINACION_OPCION; ?></td>
                                  <td><?php echo $combinacion->COMBINACION_PRECIO; ?></td>
                                  <td>
                                    <div class="btn-group float-right">
                                      <a href="<?php echo base_url('usuario/productos_combinaciones/actualizar?id='.$combinacion->ID_COMBINACION); ?>" class="btn btn-sm btn-warning" title="Editar Combinacion"> <span class="fa fa-pencil-alt"></span> </a>
                                      <button data-enlace='<?php echo base_url('usuario/productos_combinaciones/borrar?id='.$combinacion->ID_COMBINACION); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Combinacion"> <span class="fa fa-trash"></span> </button>
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
</div>
