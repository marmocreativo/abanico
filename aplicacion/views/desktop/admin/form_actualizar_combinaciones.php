<?php
  $id_usuario = $producto['ID_USUARIO'];
  if(isset($_GET['tab'])){ $tab = $_GET['tab']; } else { $tab=''; }
?>
<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="titulo">
              <h1 class="h5"> <span class="fa fa-box"></span> Actualizar <?php echo $producto['PRODUCTO_NOMBRE']; ?></h1>
            </div>
            <div class="herramientas">
                <a href="<?php echo base_url('admin/productos/'); ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-arrow-left"></span> Salir a todos los Productos </a>
                <a href="<?php echo base_url('admin/productos/?id_usuario='.$usuario_producto['ID_USUARIO']); ?>" class="btn btn-sm btn-success"> <span class="fa fa-chevron-left"></span> Salir a Productos de <?php echo $usuario_producto['USUARIO_NOMBRE']." ".$usuario_producto['USUARIO_APELLIDOS'];  ?> </a>
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
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active p-3" id="galeria" role="tabpanel" aria-labelledby="extras-tab">
                    <div class="row">
                      <div class="col">
                        <div class="border p-3 mb-3">
                          <form class="" action="<?php echo base_url('admin/productos_combinaciones/actualizar'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
                            <input type="hidden" name="IdProducto" value="<?php echo $combinacion['ID_PRODUCTO']; ?>">
                            <h6> <i class="fa fa-sitemap"></i> Editar Combinación</h6>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label for="GrupoCombinacion">Grupo <small>Ej. Talla</small> </label>
                                  <input type="text" class="form-control" id="GrupoCombinacion" name="GrupoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_GRUPO']; ?>">
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <label for="OpcionCombinacion">Opción <small>Ej. Chica</small> </label>
                                  <input type="text" class="form-control" id="OpcionCombinacion" name="OpcionCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_OPCION']; ?>">
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <label for="PrecioCombinacion">Precio de Venta</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">$</div>
                                    </div>
                                  <input type="text" class="form-control" id="PrecioCombinacion" name="PrecioCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PRECIO']; ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label for="AnchoCombinacion">Ancho</label>
                                  <div class="input-group input-group-sm mb-2">
                                    <input type="text" class="form-control" id="AnchoCombinacion" name="AnchoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_ANCHO']; ?>">
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
                                    <input type="text" class="form-control" id="AltoCombinacion" name="AltoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_ALTO']; ?>">
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
                                  <input type="text" class="form-control" id="ProfundoCombinacion" name="ProfundoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PROFUNDO']; ?>">
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
                                  <input type="text" class="form-control" id="PesoCombinacion" name="PesoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PESO']; ?>">
                                    <div class="input-group-append">
                                      <div class="input-group-text">Kg</div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row pt-3">
                              <div class="col">
                                <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Actualizar Combinación</button>
                              </div>
                            </div>
                          </form>
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
