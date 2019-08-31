<?php if(isset($_GET['tab'])){ $tab = $_GET['tab']; } else { $tab=''; } ?>
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

      <div class="card border-bottom-0 mb-3">
        <!-- <div class="card-header">
          <h5 class="pt-2"> <span class="fa fa-box"></span> Actualizar Producto</h5>
        </div> -->
        <div class="card-header d-flex justify-content-between">
           <h5 class="h6 pt-1"> <span class="fa fa-box"></span> <?php echo $this->lang->line('usuario_listas_generales_actualizar'); ?> <small> <?php echo $producto['PRODUCTO_NOMBRE']; ?></small></h5>
           <a href="<?php echo base_url('usuario/productos'); ?>" class="btn mt-1 btn-sm btn-outline-success"> <span class="fa fa-arrow-left"></span></a>
        </div>
      </div>
      <?php retro_alimentacion(); ?>
      <?php if(!empty(validation_errors())){ ?>
        <div class="alert alert-danger">
          <?php echo validation_errors(); ?>
        </div>
        <hr>
      <?php } ?>
      <?php
        $productos_activo = null;
        $fotografias_producto = null;
        $servicios_activos = null;
        $fotografias_servicios = null;
        $anexos = false;
        $plan = $this->PlanesModel->plan_activo_usuario($_SESSION['usuario']['id'],'productos');
        if(!empty($plan)){
          $productos_activo = $plan['PLAN_LIMITE_PRODUCTOS'];
          $fotografias_producto = $plan['PLAN_FOTOS_PRODUCTOS'];
          $servicios_activos = $plan['PLAN_LIMITE_SERVICIOS'];
          $fotografias_servicios = $plan['PLAN_FOTOS_SERVICIOS'];
          if($plan['PLAN_NIVEL']>1){
            $anexos = true;
          }
        }
      ?>
      <div class="card border-0 mb-3">
        <div class="protector_formulario"> <div class="p4 text-center"><h3><i class="fa fa-spinner fa-pulse"></i> Por favor espere...</h3></div> </div>

          <form class="" action="<?php echo base_url('usuario/productos/actualizar'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="TipoProducto" value="<?php echo $tipo_producto; ?>">
            <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
            <input type="hidden" name="IdTienda" value="<?php echo $tienda['ID_TIENDA']; ?>">
            <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="UrlProducto" value="<?php echo $producto['PRODUCTO_URL']; ?>">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                       <span class="fa fa-list"></span> <?php echo $this->lang->line('usuario_form_producto_datos'); ?>
                    </button>
                  </h2>
                </div>

                <div id="collapseOne" class="<?php if($tab!=''){ echo 'collapse'; } ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">

                    <div class="form-group">
                      <label for="EstadoProducto"><?php echo $this->lang->line('usuario_form_producto_estado'); ?></label>
                      <select class="form-control" id="EstadoProducto" name="EstadoProducto" placeholder="">
                        <option value="activo" <?php if($producto['PRODUCTO_ESTADO']=='activo'){ echo 'selected';} ?> ><?php echo $this->lang->line('usuario_form_producto_estado_publicado'); ?></option>
                        <option value="inactivo" <?php if($producto['PRODUCTO_ESTADO']=='inactivo'){ echo 'selected';} ?>><?php echo $this->lang->line('usuario_form_producto_estado_borrador'); ?></option>
                      </select>
                    </div>

                    <hr>

                    <div class="border border-primary p-2">
                      <h6 class="border-bottom pb-2"> <i class="fa fa-tag"></i> <?php echo $this->lang->line('usuario_form_producto_info_basica_titulo'); ?></h6>
                      <div class="form-group">
                        <label for="NombreProducto"><?php echo $this->lang->line('usuario_form_producto_nombre'); ?></label>
                        <input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="<?php echo $producto['PRODUCTO_NOMBRE']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="MetaTitulo">Meta Título</label>
                        <input type="text" class="form-control" id="MetaTitulo" name="MetaTitulo" placeholder="" value="<?php echo $producto['META_TITULO']; ?>">
                        <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Para mejorar el posicionamiento en internet, un título corto menos de 70 caracteres</small>
                      </div>
                      <div class="form-group">
                        <label for="DivisaDefaultProducto">-</label>
                        <select class="form-control" name="DivisaDefaultProducto">
                        <?php foreach($divisas_activas as $divisas){ ?>
                          <option value="<?php echo $divisas->DIVISA_ISO; ?>" <?php if($producto['PRODUCTO_DIVISA_DEFAULT']==$divisas->DIVISA_ISO){ echo 'selected'; } ?>><?php echo $divisas->DIVISA_ISO; ?></option>
                        <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="PrecioProducto"><?php echo $this->lang->line('usuario_form_producto_precio_venta'); ?></label>
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                        <input type="text" class="form-control" id="PrecioProducto" name="PrecioProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PRECIO']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="PrecioListaProducto"><?php echo $this->lang->line('usuario_form_producto_precio_lista'); ?></label>
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                        <input type="text" class="form-control" id="PrecioListaProducto" name="PrecioListaProducto" placeholder="" value="<?php echo $producto['PRODUCTO_PRECIO_LISTA']; ?>">
                        </div>
                        <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> <?php echo $this->lang->line('usuario_form_producto_precio_lista_instrucciones'); ?></small>
                      </div>
                      <div class="form-group">
                        <label for="CantidadProducto"><?php echo $this->lang->line('usuario_form_producto_cantidad'); ?></label>
                        <input type="number" class="form-control" id="CantidadProducto" required name="CantidadProducto" placeholder="" min="1" value="<?php echo $producto['PRODUCTO_CANTIDAD']; ?>">
                      </div>
                      <h6 class="border-bottom pb-2"> <i class="fa fa-clipboard-list"></i> <?php echo $this->lang->line('usuario_form_producto_cantidades_titulo'); ?></h6>
                      <div class="form-group">
                        <label for="ModeloProducto"><?php echo $this->lang->line('usuario_form_producto_modelo'); ?></label>
                        <input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" value="<?php echo $producto['PRODUCTO_MODELO']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="SkuProducto"><?php echo $this->lang->line('usuario_form_producto_sku'); ?> <?php echo $this->lang->line('usuario_form_producto_sku_instrucciones'); ?></label>
                        <input type="text" class="form-control" id="SkuProducto" name="SkuProducto" placeholder="" value="<?php echo $producto['PRODUCTO_SKU']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="CantidadMinimaProducto"><?php echo $this->lang->line('usuario_form_producto_venta_minima'); ?></label>
                        <input type="number" class="form-control" id="CantidadMinimaProducto" required name="CantidadMinimaProducto" placeholder="" min="1" value="<?php echo $producto['PRODUCTO_CANTIDAD_MINIMA']; ?>">
                      </div>
                      <h6 class="border-bottom pb-2"> <i class="fa fa-cube"></i> <?php echo $this->lang->line('usuario_form_producto_dimensiones_titulo'); ?></h6>
                      <div class="form-group">
                        <label for="AnchoProducto"><?php echo $this->lang->line('usuario_form_producto_ancho'); ?></label>
                        <div class="input-group input-group-sm mb-2">
                          <input type="text" class="form-control" id="AnchoProducto" name="AnchoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_ANCHO']; ?>">
                          <div class="input-group-append">
                            <div class="input-group-text">cm</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="AltoProducto"><?php echo $this->lang->line('usuario_form_producto_alto'); ?></label>
                        <div class="input-group input-group-sm mb-2">
                          <input type="text" class="form-control" id="AltoProducto" name="AltoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_ALTO']; ?>">
                          <div class="input-group-append">
                            <div class="input-group-text">cm</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="ProfundoProducto"><?php echo $this->lang->line('usuario_form_producto_profundo'); ?></label>
                        <div class="input-group input-group-sm mb-2">
                        <input type="text" class="form-control" id="ProfundoProducto" name="ProfundoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PROFUNDO']; ?>">
                          <div class="input-group-append">
                            <div class="input-group-text">cm</div>
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
                          <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Peso estimado del producto para el envío, incluyendo caja, sobre, etc.</small>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="PesoNetoProducto">Peso Neto</label>
                          <div class="input-group input-group-sm mb-2">
                          <input type="text" class="form-control" id="PesoNetoProducto" name="PesoNetoProducto" placeholder="" value="<?php echo $producto['PRODUCTO_PESO_NETO']; ?>">
                            <div class="input-group-append">
                              <div class="input-group-text">Kg</div>
                            </div>
                          </div>
                          <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Peso neto del producto</small>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                       <span class="fa fa-list"></span> Categorias
                    </button>
                  </h2>
                </div>

                <div id="collapseTwo" class="<?php if($tab!='categoria'){ echo 'collapse'; } ?>" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                    <?php $categorias_producto = $this->CategoriasProductoModel->lista($producto['ID_PRODUCTO']);
                    $categorias_seleccionadas = array();
                      $categorias_seleccionadas[] = $categorias_producto['ID_CATEGORIA'];
                    ?>
                      <?php $i=1; foreach($categorias as $categoria){ ?>
                        <div class="col-12 card"> <!-- Título y botón de categoría -->
                          <div class="card-header" id="heading<?php echo $i; ?>">
                            <h5 class="mb-0">
                              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                <h5><?php echo $categoria->CATEGORIA_NOMBRE; ?></h5>
                                <?php $segundo_categorias = $this->CategoriasModel->lista_no_admin(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
                              </button>
                            </h5>
                          </div>

                            <div class="row collapse" id="collapse<?php echo $i; ?>" aria-labelledby="heading<?php echo $i; ?>">
                            <?php foreach($segundo_categorias as $segunda_categoria){ ?>
                              <div class="col-6">
                                <div class="p-3">
                                  <div class="custom-control custom-radio">
                                    <input  type="radio"
                                            id="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>"
                                            name="CategoriaProducto" class="custom-control-input"
                                            value="<?php echo $segunda_categoria->ID_CATEGORIA; ?>"
                                            <?php if(in_array($segunda_categoria->ID_CATEGORIA,$categorias_seleccionadas)){ echo 'checked'; } ?>
                                            >
                                    <label class="custom-control-label h6" for="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>">-<?php echo $segunda_categoria->CATEGORIA_NOMBRE; ?></label>
                                  </div>
                                <?php $tercero_categorias = $this->CategoriasModel->lista_no_admin(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'',''); ?>
                                <ul class="list list-unstyled">
                                  <?php foreach($tercero_categorias as $tercera_categoria){ ?>
                                  <li>
                                    <div class="custom-control custom-radio">
                                      <input  type="radio"
                                              id="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
                                              name="CategoriaProducto" class="custom-control-input"
                                              value="<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
                                              <?php if(in_array($segunda_categoria->ID_CATEGORIA,$categorias_seleccionadas)){ echo 'checked'; } ?>
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
              </div>
              <div class="card">
                <div class="card-header" id="headingThree">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                       <span class="fa fa-file-alt"></span> Descripción
                    </button>
                  </h2>
                </div>
                <div id="collapseThree" class="<?php if($tab!='datos'){ echo 'collapse'; } ?>" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="card-body">

                    <div class="form-group">
                      <label for="DescripcionProducto"><?php echo $this->lang->line('usuario_form_producto_descripcion_corta'); ?></label>
                      <textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control SmallEditor" rows="3"><?php echo $producto['PRODUCTO_DESCRIPCION']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="MetaDescripcion">Meta Descripción</label>
                      <textarea class="form-control" name="MetaDescripcion" rows="3" cols="80"><?php echo $producto['META_DESCRIPCION']; ?></textarea>
                      <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Para mejorar el posicionamiento en internet, un título corto menos de 140 caracteres</small>
                    </div>
                    <div class="form-MetaKeywords">
                      <label for="MetaDescripcion">Meta Keywords</label>
                      <textarea class="form-control" name="MetaKeywords" rows="3" cols="80"><?php echo $producto['META_KEYWORDS']; ?></textarea>
                      <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Para mejorar el posicionamiento en internet, de 1 a 10 frases separadas por coma que describan tu servicio</small>
                    </div>
                    <div class="form-group">
                      <label for="DetallesProducto"><?php echo $this->lang->line('usuario_form_producto_detalles'); ?></label>
                      <textarea id="DetallesProducto" name="DetallesProducto" class="form-control Editor" rows="5"><?php echo $producto['PRODUCTO_DETALLES']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="OrigenProducto"><?php echo $this->lang->line('usuario_form_producto_origen'); ?></label>
                      <select class="form-control form-control-sm" name="OrigenProducto" id="OrigenProducto">
                        <option value="México" <?php if($producto['PRODUCTO_ORIGEN']=='México'){ echo 'selected';} ?>><?php echo $this->lang->line('usuario_form_producto_origen_mexico'); ?></option>
                        <option value="Otro" <?php if($producto['PRODUCTO_ORIGEN']=='Otro'){ echo 'selected';} ?>><?php echo $this->lang->line('usuario_form_producto_origen_otro'); ?></option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="CondicionProducto"><?php echo $this->lang->line('usuario_form_producto_condicion'); ?></label>
                      <select class="form-control form-control-sm" name="CondicionProducto" id="CondicionProducto">
                        <option value="nuevo" <?php if($producto['PRODUCTO_CONDICION']=='nuevo'){ echo 'selected';} ?>><?php echo $this->lang->line('usuario_form_producto_condicion_nuevo'); ?></option>
                        <option value="usado" <?php if($producto['PRODUCTO_CONDICION']=='usuado'){ echo 'selected';} ?>><?php echo $this->lang->line('usuario_form_producto_condicion_usuado'); ?></option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="ArtesanalProducto">¿Es un producto Artesanal?</label>
                      <select class="form-control form-control-sm" name="ArtesanalProducto" id="ArtesanalProducto">
                        <option value="no" <?php if($producto['PRODUCTO_ARTESANAL']=='no'){ echo 'selected';} ?>>No</option>
                        <option value="si" <?php if($producto['PRODUCTO_ARTESANAL']=='si'){ echo 'selected';} ?>>Si</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="">UPC</label>
                      <input type="text" class="form-control form-control-sm" id="UpcProducto" name="UpcProducto" placeholder="" value="<?php echo $producto['PRODUCTO_UPC']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="">EAN</label>
                      <input type="text" class="form-control form-control-sm" id="EanProducto" name="EanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_EAN']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="">JAN</label>
                      <input type="text" class="form-control form-control-sm" id="JanProducto" name="JanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_JAN']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="">ISBN</label>
                      <input type="text" class="form-control form-control-sm" id="IsbnProducto" name="IsbnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_ISBN']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="">MPN</label>
                      <input type="text" class="form-control form-control-sm" id="MpnProducto" name="MpnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_MPN']; ?>">
                    </div>

                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingFour">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <span class="fa fa-image"></span> Galeria
                    </button>
                  </h2>
                </div>
                <div id="collapseFour" class="<?php if($tab!='galeria'){ echo 'collapse'; } ?>" aria-labelledby="headingFour" data-parent="#accordionExample">
                  <div class="card-body">
                    <hr>
                    <img src="<?php echo base_url('contenido/img/productos/completo/default.jpg') ?>" id="PrevisualizarImagen" alt="" class="img-fluid img-thumbnail rounded">
                    <?php
                      $cantidad_imagenes = count($galerias);
                    ?>
                    <?php if($fotografias_producto!=null&&($fotografias_producto>$cantidad_imagenes||$fotografias_producto==0)){ ?>
                    <div class="form-group">
                      <input type="file" class="form-control" id="ImagenProducto" name="ImagenProducto" placeholder="" value="">
                      <label class="" for=""><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                    </div>
                  <?php }else{ ?>
                    <p class="text-danger">Límite de imágenes alcanzado</p>
                  <?php } ?>
                    <?php foreach($galerias as $galeria){ ?>
                    <div class="mb-2">
                      <div class="row">
                        <div class="col">
                          <img class="mb-3" src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO) ?>" alt="" width="50">
                          <?php if($galeria->GALERIA_PORTADA=='si'){ ?>
                            <a href="<?php echo base_url('usuario/productos/portada')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                          <?php }else{ ?>
                            <a href="<?php echo base_url('usuario/productos/portada')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                          <?php } ?>
                        </div>
                        <div class="col">
                          <div class="btn-group float-right mb-3">
                            <button type="button" data-enlace="<?php echo base_url('usuario/productos/borrar_galeria?id='.$galeria->ID_GALERIA.'&id_producto='.$galeria->ID_PRODUCTO); ?>" class="btn btn-sm btn-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-sm mt-3 btn-primary float-right"> <span class="fa fa-save"></span> <?php echo $this->lang->line('usuario_form_producto_actualizar_producto'); ?></button>
          </form>
          <hr>
          <a href="<?php echo base_url('usuario/productos_combinaciones?id='.$_GET['id']); ?>" class="btn btn-sm mt-3 btn-primary"><span class="fa fa-sitemap"></span> <?php echo $this->lang->line('usuario_form_producto_combinaciones'); ?></a>

      </div>

    </div>
  </div>
</div>
