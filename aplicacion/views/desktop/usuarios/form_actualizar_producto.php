<?php if(isset($_GET['tab'])){ $tab = $_GET['tab']; } else { $tab=''; } ?>
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
              <form class="" action="<?php echo base_url('usuario/productos/actualizar'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="TipoProducto" value="<?php echo $tipo_producto; ?>">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
                <input type="hidden" name="IdTienda" value="<?php echo $tienda['ID_TIENDA']; ?>">
                <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
                <input type="hidden" name="UrlProducto" value="<?php echo $producto['PRODUCTO_URL']; ?>">
                <div class="row">
                  <div class="col">
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link <?php if($tab==''){ echo 'active'; } ?>" id="basicos-tab" data-toggle="tab" href="#basicos" role="tab" aria-controls="basicos" aria-selected="false"> <span class="fa fa-list"></span>
                          <?php echo $this->lang->line('usuario_form_producto_datos'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link <?php if($tab=='categoria'){ echo 'active'; } ?>" id="categoria-tab" data-toggle="tab" href="#categoria" role="tab" aria-controls="categoria" aria-selected="false"> <span class="fa fa-list"></span>
                          <?php echo $this->lang->line('usuario_form_producto_categorias'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link <?php if($tab=='datos'){ echo 'active'; } ?>" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="true"> <span class="fa fa-file-alt"></span>
                          <?php echo $this->lang->line('usuario_form_producto_descripcion'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link <?php if($tab=='galeria'){ echo 'active'; } ?>" id="galeria-tab" data-toggle="tab" href="#galeria" role="tab" aria-controls="galeria" aria-selected="false"> <span class="fa fa-image"></span>
                          <?php echo $this->lang->line('usuario_form_producto_galeria'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos_combinaciones?id='.$_GET['id']); ?>" > <span class="fa fa-sitemap"></span>
                          <?php echo $this->lang->line('usuario_form_producto_combinaciones'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos_traducciones?id='.$_GET['id']); ?>" > <span class="fa fa-language"></span>
                          Traducciones
                        </a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade <?php if($tab==''){ echo 'show active'; } ?> p-3" id="basicos" role="tabpanel" aria-labelledby="basicos-tab">
                        <div class="row mb-3">
                          <div class="col-9">
                            <div class="border border-primary p-2">
                              <h6 class="border-bottom pb-2"> <i class="fa fa-tag"></i> <?php echo $this->lang->line('usuario_form_producto_info_basica_titulo'); ?></h6>
                              <div class="row">
                                <div class="col-12">
                                  <div class="form-group">
                                    <label for="NombreProducto"><?php echo $this->lang->line('usuario_form_producto_nombre'); ?></label>
                                    <input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="<?php echo $producto['PRODUCTO_NOMBRE']; ?>">
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                    <label for="PrecioProducto"><?php echo $this->lang->line('usuario_form_producto_precio_venta'); ?></label>
                                    <div class="input-group mb-2">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                      </div>
                                    <input type="text" class="form-control" id="PrecioProducto" name="PrecioProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PRECIO']; ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                    <label for="PrecioListaProducto"><?php echo $this->lang->line('usuario_form_producto_precio_lista'); ?></label>
                                    <div class="input-group mb-2">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                      </div>
                                    <input type="text" class="form-control" id="PrecioListaProducto" name="PrecioListaProducto" placeholder="" value="<?php echo $producto['PRODUCTO_PRECIO_LISTA']; ?>">
                                    </div>
                                    <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> <?php echo $this->lang->line('usuario_form_producto_precio_lista_instrucciones'); ?></small>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                    <label for="CantidadProducto"><?php echo $this->lang->line('usuario_form_producto_cantidad'); ?></label>
                                    <input type="number" class="form-control" id="CantidadProducto" required name="CantidadProducto" placeholder="" min="1" value="<?php echo $producto['PRODUCTO_CANTIDAD']; ?>">
                                  </div>
                                </div>
                              </div>
                              <h6 class="border-bottom pb-2"> <i class="fa fa-clipboard-list"></i> <?php echo $this->lang->line('usuario_form_producto_cantidades_titulo'); ?></h6>
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="ModeloProducto"><?php echo $this->lang->line('usuario_form_producto_modelo'); ?></label>
                                      <input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" value="<?php echo $producto['PRODUCTO_MODELO']; ?>">
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="SkuProducto"><?php echo $this->lang->line('usuario_form_producto_sku'); ?> <?php echo $this->lang->line('usuario_form_producto_sku_instrucciones'); ?></label>
                                      <input type="text" class="form-control" id="SkuProducto" name="SkuProducto" placeholder="" value="<?php echo $producto['PRODUCTO_SKU']; ?>">
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="CantidadMinimaProducto"><?php echo $this->lang->line('usuario_form_producto_venta_minima'); ?></label>
                                      <input type="number" class="form-control" id="CantidadMinimaProducto" required name="CantidadMinimaProducto" placeholder="" min="1" value="<?php echo $producto['PRODUCTO_CANTIDAD_MINIMA']; ?>">
                                    </div>
                                  </div>
                                </div>
                              <h6 class="border-bottom pb-2"> <i class="fa fa-cube"></i> <?php echo $this->lang->line('usuario_form_producto_dimensiones_titulo'); ?></h6>
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label for="AnchoProducto"><?php echo $this->lang->line('usuario_form_producto_ancho'); ?></label>
                                    <div class="input-group input-group-sm mb-2">
                                      <input type="text" class="form-control" id="AnchoProducto" name="AnchoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_ANCHO']; ?>">
                                      <div class="input-group-append">
                                        <div class="input-group-text">cm</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                    <label for="AltoProducto"><?php echo $this->lang->line('usuario_form_producto_alto'); ?></label>
                                    <div class="input-group input-group-sm mb-2">
                                      <input type="text" class="form-control" id="AltoProducto" name="AltoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_ALTO']; ?>">
                                      <div class="input-group-append">
                                        <div class="input-group-text">cm</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                    <label for="ProfundoProducto"><?php echo $this->lang->line('usuario_form_producto_profundo'); ?></label>
                                    <div class="input-group input-group-sm mb-2">
                                    <input type="text" class="form-control" id="ProfundoProducto" name="ProfundoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PROFUNDO']; ?>">
                                      <div class="input-group-append">
                                        <div class="input-group-text">cm</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                    <label for="PesoProducto"><?php echo $this->lang->line('usuario_form_producto_peso'); ?></label>
                                    <div class="input-group input-group-sm mb-2">
                                    <input type="text" class="form-control" id="PesoProducto" name="PesoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PESO']; ?>">
                                      <div class="input-group-append">
                                        <div class="input-group-text">Kg</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="border border-default p-2">
                            <div class="form-group">
                              <label for="EstadoProducto"><?php echo $this->lang->line('usuario_form_producto_estado'); ?></label>
                              <select class="form-control" id="EstadoProducto" name="EstadoProducto" placeholder="">
                                <option value="activo" <?php if($producto['PRODUCTO_ESTADO']=='activo'){ echo 'selected';} ?> ><?php echo $this->lang->line('usuario_form_producto_estado_publicado'); ?></option>
                                <option value="inactivo" <?php if($producto['PRODUCTO_ESTADO']=='inactivo'){ echo 'selected';} ?>><?php echo $this->lang->line('usuario_form_producto_estado_borrador'); ?></option>
                              </select>
                            </div>
                          </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade <?php if($tab=='categoria'){ echo 'show active'; } ?> p-3" id="categoria" role="tabpanel" aria-labelledby="datos-tab">
                        <div class="row">
                            <?php $i=1; foreach($categorias as $categoria){ ?>
                                <div class="col-12 border border-default p-3">
                                  <h6 class="border-bottom pb-3"><?php echo $categoria->CATEGORIA_NOMBRE; ?></h6>
                                  <?php $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
                                  <div class="row">
                                  <?php foreach($segundo_categorias as $segunda_categoria){ ?>
                                    <div class="col-4">
                                      <div class="border border-default p-3">
                                      <h6 class="border-bottom pb-3"><?php echo $segunda_categoria->CATEGORIA_NOMBRE; ?></h6>
                                      <?php $tercero_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'',''); ?>
                                      <ul class="list list-unstyled">
                                        <?php foreach($tercero_categorias as $tercera_categoria){ ?>
                                        <li>
                                          <div class="custom-control custom-radio">
                                            <input  type="radio"
                                                    id="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
                                                    name="CategoriaProducto" class="custom-control-input"
                                                    value="<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
                                                    <?php if($relacion_categorias['ID_CATEGORIA']==$tercera_categoria->ID_CATEGORIA){ echo 'checked'; } ?>

                                                    >
                                            <label class="custom-control-label" for="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>">-<?php echo $tercera_categoria->CATEGORIA_NOMBRE; ?></label>
                                          </div>
                                        </li>
                                      <?php } ?>
                                      </ul>
                                      </div>
                                    </div>
                                  <?php } ?>
                                  </div>
                                </div>
                            <?php ++$i; } ?>
                        </div>
                      </div>
                      <div class="tab-pane fade <?php if($tab=='datos'){ echo 'show active'; } ?> p-3" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                        <div class="form-group">
                          <label for="DescripcionProducto"><?php echo $this->lang->line('usuario_form_producto_descripcion_corta'); ?></label>
                          <textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control" rows="3"><?php echo $producto['PRODUCTO_DESCRIPCION']; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label for="DetallesProducto"><?php echo $this->lang->line('usuario_form_producto_detalles'); ?></label>
                          <textarea id="DetallesProducto" name="DetallesProducto" class="form-control Editor" rows="5"><?php echo $producto['PRODUCTO_DETALLES']; ?></textarea>
                        </div>
                        <div class="row">
                          <div class="col-4">
                            <div class="form-group">
                              <label for="OrigenProducto"><?php echo $this->lang->line('usuario_form_producto_origen'); ?></label>
                              <select class="form-control form-control-sm" name="OrigenProducto" id="OrigenProducto">
                                <option value="México" <?php if($producto['PRODUCTO_ORIGEN']=='México'){ echo 'selected';} ?>><?php echo $this->lang->line('usuario_form_producto_origen_mexico'); ?></option>
                                <option value="Otro" <?php if($producto['PRODUCTO_ORIGEN']=='Otro'){ echo 'selected';} ?>><?php echo $this->lang->line('usuario_form_producto_origen_otro'); ?></option>
                              </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for="CondicionProducto"><?php echo $this->lang->line('usuario_form_producto_condicion'); ?></label>
                              <select class="form-control form-control-sm" name="CondicionProducto" id="CondicionProducto">
                                <option value="nuevo" <?php if($producto['PRODUCTO_CONDICION']=='nuevo'){ echo 'selected';} ?>><?php echo $this->lang->line('usuario_form_producto_condicion_nuevo'); ?></option>
                                <option value="usado" <?php if($producto['PRODUCTO_CONDICION']=='usuado'){ echo 'selected';} ?>><?php echo $this->lang->line('usuario_form_producto_condicion_usuado'); ?></option>
                              </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for="ArtesanalProducto">¿Es un producto Artesanal?</label>
                              <select class="form-control form-control-sm" name="ArtesanalProducto" id="ArtesanalProducto">
                                <option value="no" <?php if($producto['PRODUCTO_ARTESANAL']=='no'){ echo 'selected';} ?>>No</option>
                                <option value="si" <?php if($producto['PRODUCTO_ARTESANAL']=='si'){ echo 'selected';} ?>>Si</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for="UpcProducto">UPC</label>
                              <input type="text" class="form-control form-control-sm" id="UpcProducto" name="UpcProducto" placeholder="" value="<?php echo $producto['PRODUCTO_UPC']; ?>">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for="EanProducto">EAN</label>
                              <input type="text" class="form-control form-control-sm" id="EanProducto" name="EanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_EAN']; ?>">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for="JanProducto">JAN</label>
                              <input type="text" class="form-control form-control-sm" id="JanProducto" name="JanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_JAN']; ?>">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <label for="IsbnProducto">ISBN</label>
                              <input type="text" class="form-control form-control-sm" id="IsbnProducto" name="IsbnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_ISBN']; ?>">
                            </div>
                          </div>
                          <div class="col-4">

                            <div class="form-group">
                              <label for="MpnProducto">MPN</label>
                              <input type="text" class="form-control form-control-sm" id="MpnProducto" name="MpnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_MPN']; ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade <?php if($tab=='galeria'){ echo 'show active'; } ?> p-3" id="galeria" role="tabpanel" aria-labelledby="extras-tab">
                        <div class="row">
                          <div class="col">
                            <div class="row">
                              <div class="col-3">
                                <img src="<?php echo base_url('contenido/img/productos/completo/default.jpg') ?>" id="PrevisualizarImagen" alt="" class="img-fluid img-thumbnail rounded">
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <label for="ImagenProducto"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                                  <input type="file" class="form-control" id="ImagenProducto" name="ImagenProducto">
                                </div>
                              </div>
                            </div>
                            <table class="table table-bordered table-sm">
                              <thead>
                                <tr>
                                  <th class="text-center"><?php echo $this->lang->line('usuario_form_producto_lista_imagen_id'); ?></th>
                                  <th class="text-center"><?php echo $this->lang->line('usuario_form_producto_lista_imagen'); ?></th>
                                  <th class="text-center"><?php echo $this->lang->line('usuario_form_producto_lista_imagen_portada'); ?></th>
                                  <th class="text-right"><?php echo $this->lang->line('usuario_listas_generales_controles'); ?></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($galerias as $galeria){ ?>
                                  <tr>
                                    <td class="text-center"><?php echo $galeria->ID_GALERIA; ?></td>
                                    <td class="text-center">
                                      <img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO) ?>" alt="" width="50">
                                    </td>
                                    <td class="text-center">
                                      <?php if($galeria->GALERIA_PORTADA=='si'){ ?>
                                        <a href="<?php echo base_url('usuario/productos/portada')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                                      <?php }else{ ?>
                                        <a href="<?php echo base_url('usuario/productos/portada')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                                      <?php } ?>
                                    </td>
                                    <td class="text-right">
                                      <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" data-enlace="<?php echo base_url('usuario/productos/borrar_galeria')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>

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
                <div class="row border-top mt-3 pt-3">
                  <div class="col">
                    <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> <?php echo $this->lang->line('usuario_form_producto_actualizar_producto'); ?></button>
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
