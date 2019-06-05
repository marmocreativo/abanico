<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="titulo">
                  <h1 class="h5"> <span class="fa fa-box"></span> <?php echo $this->lang->line('usuario_listas_generales_actualizar'); ?> <?php echo $this->lang->line('usuario_lista_combinaciones_singular'); ?></h1>
                </div>
                <div class="herramientas">
                    <a href="<?php echo base_url('usuario/productos'); ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-arrow-left"></span> <?php echo $this->lang->line('usuario_form_producto_regresar'); ?></a>
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
                              <form class="" action="<?php echo base_url('usuario/productos_combinaciones/actualizar'); ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
                                <input type="hidden" name="IdProducto" value="<?php echo $combinacion['ID_PRODUCTO']; ?>">
                                <h6> <i class="fa fa-sitemap"></i> <?php echo $this->lang->line('usuario_form_producto_combinaciones_editar'); ?></h6>
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="GrupoCombinacion"><?php echo $this->lang->line('usuario_form_producto_combinaciones_grupo'); ?> <small><?php echo $this->lang->line('usuario_form_producto_combinaciones_grupo_instrucciones'); ?></small> </label>
                                      <input type="text" class="form-control" id="GrupoCombinacion" name="GrupoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_GRUPO']; ?>">
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="OpcionCombinacion"><?php echo $this->lang->line('usuario_form_producto_combinaciones_opcion'); ?> <small><?php echo $this->lang->line('usuario_form_producto_combinaciones_opcion_instrucciones'); ?></small> </label>
                                      <input type="text" class="form-control" id="OpcionCombinacion" name="OpcionCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_OPCION']; ?>">
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="PrecioCombinacion"><?php echo $this->lang->line('usuario_form_producto_precio_venta'); ?></label>
                                      <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">$</div>
                                        </div>
                                      <input type="text" class="form-control" id="PrecioCombinacion" name="PrecioCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PRECIO']; ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="CantidadCombinacion">Cantidad en Existencia </label>
                                        <input type="number" class="form-control" id="CantidadCombinacion" name="CantidadCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_CANTIDAD']; ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="AnchoCombinacion"><?php echo $this->lang->line('usuario_form_producto_ancho'); ?></label>
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
                                      <label for="AltoCombinacion"><?php echo $this->lang->line('usuario_form_producto_alto'); ?></label>
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
                                      <label for="ProfundoCombinacion"><?php echo $this->lang->line('usuario_form_producto_profundo'); ?></label>
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
                                      <label for="PesoCombinacion"><?php echo $this->lang->line('usuario_form_producto_peso'); ?></label>
                                      <div class="input-group input-group-sm mb-2">
                                      <input type="text" class="form-control" id="PesoCombinacion" name="PesoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PESO']; ?>">
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
                                  <?php foreach($galerias as $galeria){ ?>
                                    <div class="col-1 text-center">
                                      <label for="ImagenCombinacion-<?php echo $galeria->ID_GALERIA; ?>">
                                        <img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO) ?>" class="img-fluid" alt="">
                                        <hr>
                                        <input class="form-check-input" type="radio" name="ImagenCombinacion" id="ImagenCombinacion-<?php echo $galeria->ID_GALERIA; ?>" <?php if($galeria->GALERIA_ARCHIVO==$combinacion['COMBINACION_IMAGEN']){ echo 'checked'; } ?> value="<?php echo $galeria->GALERIA_ARCHIVO; ?>">
                                      </label>
                                    </div>
                                  <?php } ?>
                                </div>
                                <hr>
                                <div class="row pt-3">
                                  <div class="col">
                                    <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> <?php echo $this->lang->line('usuario_form_producto_combinaciones_actualizar'); ?></button>
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
</div>
