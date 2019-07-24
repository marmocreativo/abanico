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
                  <h1 class="h5"> <span class="fa fa-box"></span> <?php echo $this->lang->line('usuario_listas_generales_actualizar'); ?> <?php echo $producto['PRODUCTO_NOMBRE']; ?></h1>
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
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab='); ?>"> <span class="fa fa-list"></span>
                          <?php echo $this->lang->line('usuario_form_producto_datos'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab=categoria'); ?>"> <span class="fa fa-list"></span>
                          <?php echo $this->lang->line('usuario_form_producto_categorias'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab=datos'); ?>"> <span class="fa fa-file-alt"></span>
                          <?php echo $this->lang->line('usuario_form_producto_descripcion'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab=galeria'); ?>"> <span class="fa fa-image"></span>
                          <?php echo $this->lang->line('usuario_form_producto_galeria'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id']); ?>" > <span class="fa fa-sitemap"></span>
                          <?php echo $this->lang->line('usuario_form_producto_combinaciones'); ?>
                        </a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active p-3" id="galeria" role="tabpanel" aria-labelledby="extras-tab">
                        <div class="row">
                          <div class="col">
                            <div class="border p-3 mb-3">
                              <form class="" action="<?php echo base_url('usuario/productos_combinaciones/crear'); ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="IdProducto" value="<?php echo $_GET['id']; ?>">
                                <h6> <i class="fa fa-sitemap"></i> <?php echo $this->lang->line('usuario_form_producto_combinaciones_nueva'); ?></h6>
                                <div class="row">
                                  <div class="col">
                                      <div class="border border-info p-3 mb-3">
                                        <p> <i class="fas fa-info-circle"></i> <?php echo $this->lang->line('usuario_form_producto_combinaciones_regla_1'); ?><br>
                                          <i class="fas fa-info-circle"></i> <?php echo $this->lang->line('usuario_form_producto_combinaciones_regla_2'); ?>
                                        </p>
                                      </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="GrupoCombinacion"><?php echo $this->lang->line('usuario_form_producto_combinaciones_grupo'); ?> <small><?php echo $this->lang->line('usuario_form_producto_combinaciones_grupo_instrucciones'); ?></small> </label>
                                      <input type="text" class="form-control" id="GrupoCombinacion" name="GrupoCombinacion" required placeholder="" value="<?=!form_error('GrupoCombinacion')?set_value('GrupoCombinacion'):''?>">
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="OpcionCombinacion"><?php echo $this->lang->line('usuario_form_producto_combinaciones_opcion'); ?> <small><?php echo $this->lang->line('usuario_form_producto_combinaciones_opcion_instrucciones'); ?></small> </label>
                                      <input type="text" class="form-control" id="OpcionCombinacion" name="OpcionCombinacion" required placeholder="" value="<?=!form_error('OpcionCombinacion')?set_value('OpcionCombinacion'):''?>">
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="PrecioCombinacion"><?php echo $this->lang->line('usuario_form_producto_precio_venta'); ?></label>
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
                                      <label for="AnchoCombinacion"><?php echo $this->lang->line('usuario_form_producto_ancho'); ?></label>
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
                                      <label for="AltoCombinacion"><?php echo $this->lang->line('usuario_form_producto_alto'); ?></label>
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
                                      <label for="ProfundoCombinacion"><?php echo $this->lang->line('usuario_form_producto_profundo'); ?></label>
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
                                      <label for="PesoCombinacion"><?php echo $this->lang->line('usuario_form_producto_peso'); ?></label>
                                      <div class="input-group input-group-sm mb-2">
                                      <input type="text" class="form-control" id="PesoCombinacion" name="PesoCombinacion" required placeholder="" value="<?php echo $producto['PRODUCTO_PESO']; ?>">
                                        <div class="input-group-append">
                                          <div class="input-group-text">Kg</div>
                                        </div>
                                      </div>
                                      <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Peso estimado del producto para el envío, incluyendo caja, sobre, etc.</small>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="PesoNetoCombinacion">Peso Neto</label>
                                      <div class="input-group input-group-sm mb-2">
                                      <input type="text" class="form-control" id="PesoNetoCombinacion" name="PesoNetoCombinacion" placeholder="" value="<?php echo $producto['PRODUCTO_PESO_NETO']; ?>">
                                        <div class="input-group-append">
                                          <div class="input-group-text">Kg</div>
                                        </div>
                                      </div>
                                      <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Peso neto del producto</small>
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
                                  <?php if(empty($galeria)){ ?>
                                    <div class="col-1 text-center">
                                      <label for="ImagenCombinacion-0">
                                        <img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/default.jpg') ?>" class="img-fluid" alt="">
                                        <hr>
                                        <input class="form-check-input" type="radio" name="ImagenCombinacion" id="ImagenCombinacion-0" checked value="default.jpg">
                                      </label>
                                    </div>
                                  <?php } ?>
                                </div>
                                <hr>
                                <div class="row pt-3">
                                  <div class="col">
                                    <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> <?php echo $this->lang->line('usuario_form_producto_combinaciones_agregar'); ?></button>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <h5> <i class="fa fa-sitemap"></i> <?php echo $this->lang->line('usuario_form_producto_combinaciones_actuales'); ?></h5>
                            <table class="table table-sm">
                              <thead>
                                <tr>
                                  <th>Grupo</th>
                                  <th>Opción</th>
                                  <th>Cantidad</th>
                                  <th>Peso Total</th>
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
                                  <td><?php echo $combinacion->COMBINACION_PESO; ?>Kg</td>
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
</div>
