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
      <?php retro_alimentacion(); ?>
      <div class="card border-bottom-0 mb-3">
        <div class="card-header">
          <h5 class="pt-2"> <span class="fa fa-box"></span> <?php echo $this->lang->line('usuario_listas_generales_nuevo'); ?> <?php echo $this->lang->line('usuario_lista_productos_singular'); ?></h5>
        </div>
      </div>
      <?php if(!empty(validation_errors())){ ?>
        <div class="alert alert-danger">
          <?php echo validation_errors(); ?>
        </div>
        <hr>
      <?php } ?>
      <form class="" action="<?php echo base_url('usuario/productos/crear'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="TipoProducto" value="<?php echo $tipo_producto; ?>">
        <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
        <input type="hidden" name="IdTienda" value="<?php echo $tienda['ID_TIENDA']; ?>">
        <!-- menu de acordion -->
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header p-1" id="headingOne">
              <h4 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                   <span class="fa fa-list"></span> <?php echo $this->lang->line('usuario_form_producto_datos'); ?>
                </button>
              </h4>
            </div>

            <div id="collapseOne" class="" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">

                <div class="form-group">
                  <label for="EstadoProducto"><?php echo $this->lang->line('usuario_form_producto_estado'); ?></label>
                  <select class="form-control" id="EstadoProducto" name="EstadoProducto" placeholder="">
                    <option value="activo" ><?php echo $this->lang->line('usuario_form_producto_estado_publicado'); ?></option>
                    <option value="inactivo"><?php echo $this->lang->line('usuario_form_producto_estado_borrador'); ?></option>
                  </select>
                </div>

                <hr>

                <div class="border border-primary p-2">
                  <h6 class="border-bottom pb-2"> <i class="fa fa-tag"></i> <?php echo $this->lang->line('usuario_form_producto_info_basica_titulo'); ?></h6>
                  <div class="form-group">
                    <label for="NombreProducto"><?php echo $this->lang->line('usuario_form_producto_nombre'); ?></label>
                    <input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="<?=!form_error('NombreProducto')?set_value('NombreProducto'):''?>">
                  </div>
                  <div class="form-group">
                    <label for="DivisaDefaultProducto">-</label>
                    <select class="form-control" name="DivisaDefaultProducto">
                    <?php foreach($divisas_activas as $divisas){ ?>
                      <option value="<?php echo $divisas->DIVISA_ISO; ?>"><?php echo $divisas->DIVISA_ISO; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="PrecioProducto"><?php echo $this->lang->line('usuario_form_producto_precio_venta'); ?></label>
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                      </div>
                    <input type="text" class="form-control" id="PrecioProducto" name="PrecioProducto" required placeholder="" value="<?=!form_error('PrecioProducto')?set_value('PrecioProducto'):''?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="PrecioListaProducto"><?php echo $this->lang->line('usuario_form_producto_precio_lista'); ?></label>
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                      </div>
                    <input type="text" class="form-control" id="PrecioListaProducto" name="PrecioListaProducto" placeholder="" value="<?=!form_error('PrecioListaProducto')?set_value('PrecioListaProducto'):''?>">
                    </div>
                    <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> <?php echo $this->lang->line('usuario_form_producto_precio_lista_instrucciones'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="CantidadProducto"><?php echo $this->lang->line('usuario_form_producto_cantidad'); ?></label>
                    <input type="number" class="form-control" id="CantidadProducto" required name="CantidadProducto" placeholder="" min="1" value="1">
                  </div>
                  <h6 class="border-bottom pb-2"> <i class="fa fa-clipboard-list"></i> <?php echo $this->lang->line('usuario_form_producto_cantidades_titulo'); ?></h6>
                  <div class="form-group">
                    <label for="ModeloProducto"><?php echo $this->lang->line('usuario_form_producto_modelo'); ?></label>
                    <input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" value="<?=!form_error('ModeloProducto')?set_value('ModeloProducto'):''?>">
                  </div>
                  <div class="form-group">
                    <label for="SkuProducto"><?php echo $this->lang->line('usuario_form_producto_sku'); ?> <?php echo $this->lang->line('usuario_form_producto_sku_instrucciones'); ?></label>
                    <input type="text" class="form-control" id="SkuProducto" name="SkuProducto" placeholder="" value="">
                  </div>
                  <div class="form-group">
                    <label for="CantidadMinimaProducto"><?php echo $this->lang->line('usuario_form_producto_venta_minima'); ?></label>
                    <input type="number" class="form-control" id="CantidadMinimaProducto" required name="CantidadMinimaProducto" placeholder="" min="1" value="1">
                  </div>
                  <h6 class="border-bottom pb-2"> <i class="fa fa-cube"></i> <?php echo $this->lang->line('usuario_form_producto_dimensiones_titulo'); ?></h6>
                  <div class="form-group">
                    <label for="AnchoProducto"><?php echo $this->lang->line('usuario_form_producto_ancho'); ?></label>
                    <div class="input-group input-group-sm mb-2">
                      <input type="text" class="form-control" id="AnchoProducto" name="AnchoProducto" required placeholder="" value="<?=!form_error('AnchoProducto')?set_value('AnchoProducto'):''?>">
                      <div class="input-group-append">
                        <div class="input-group-text">cm</div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="AltoProducto"><?php echo $this->lang->line('usuario_form_producto_alto'); ?></label>
                    <div class="input-group input-group-sm mb-2">
                      <input type="text" class="form-control" id="AltoProducto" name="AltoProducto" required placeholder="" value="<?=!form_error('AltoProducto')?set_value('AltoProducto'):''?>">
                      <div class="input-group-append">
                        <div class="input-group-text">cm</div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ProfundoProducto"><?php echo $this->lang->line('usuario_form_producto_profundo'); ?></label>
                    <div class="input-group input-group-sm mb-2">
                    <input type="text" class="form-control" id="ProfundoProducto" name="ProfundoProducto" required placeholder="" value="<?=!form_error('ProfundoProducto')?set_value('ProfundoProducto'):''?>">
                      <div class="input-group-append">
                        <div class="input-group-text">cm</div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="PesoProducto"><?php echo $this->lang->line('usuario_form_producto_peso'); ?></label>
                      <div class="input-group input-group-sm mb-2">
                      <input type="text" class="form-control" id="PesoProducto" name="PesoProducto" required placeholder="" value="">
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
                      <input type="text" class="form-control" id="PesoNetoProducto" name="PesoNetoProducto" placeholder="" value="">
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

            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                <?php $i = 1; foreach($categorias as $categoria){ ?>
              <h6 class="mb-3"><?php echo $categoria->CATEGORIA_NOMBRE; ?></h6>
              <?php $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
              <?php foreach($segundo_categorias as $segunda_categoria){ ?>
                <input  type="radio"
                        id="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>"
                        name="CategoriaProducto" class=""
                        value="<?php echo $segunda_categoria->ID_CATEGORIA; ?>"

                        >
                <label class="h6" for="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>">-<?php echo $segunda_categoria->CATEGORIA_NOMBRE; ?></label>
                <?php $tercero_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'',''); ?>
                <ul class="list list-unstyled">
                  <?php foreach($tercero_categorias as $tercera_categoria){ ?>
                  <li>
                    <div class="custom-control custom-radio">
                      <input  type="radio"
                              id="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
                              name="CategoriaProducto" class=""
                              value="<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
                              >
                      <label class="" for="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>">-<?php echo $tercera_categoria->CATEGORIA_NOMBRE; ?></label>
                    </div>
                  </li>
                <?php }// Termina el bucle tercera categoria ?>
                </ul>
              <?php } // Termina Bucle segunda categoría ?>
            <?php } // Termina Bucle primera categoría ?>

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
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">

                <div class="form-group">
                  <label for="DescripcionProducto"><?php echo $this->lang->line('usuario_form_producto_descripcion_corta'); ?></label>
                  <textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control SmallEditor" rows="3"><?=!form_error('DescripcionProducto')?set_value('DescripcionProducto'):''?></textarea>
                </div>
                <div class="form-group">
                  <label for="DetallesProducto"><?php echo $this->lang->line('usuario_form_producto_detalles'); ?></label>
                  <textarea id="DetallesProducto" name="DetallesProducto" class="form-control Editor" rows="5"><?=!form_error('DetallesProducto')?set_value('DetallesProducto'):''?> </textarea>
                </div>

                <div class="form-group">
                  <label for="OrigenProducto"><?php echo $this->lang->line('usuario_form_producto_origen'); ?></label>
                  <select class="form-control form-control-sm" name="OrigenProducto" id="OrigenProducto">
                    <option value="México"><?php echo $this->lang->line('usuario_form_producto_origen_mexico'); ?></option>
                    <option value="Otro"><?php echo $this->lang->line('usuario_form_producto_origen_otro'); ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="CondicionProducto"><?php echo $this->lang->line('usuario_form_producto_condicion'); ?></label>
                  <select class="form-control form-control-sm" name="CondicionProducto" id="CondicionProducto">
                    <option value="nuevo"><?php echo $this->lang->line('usuario_form_producto_condicion_nuevo'); ?></option>
                    <option value="usado"><?php echo $this->lang->line('usuario_form_producto_condicion_usuado'); ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ArtesanalProducto">¿Es un producto Artesanal?</label>
                  <select class="form-control form-control-sm" name="ArtesanalProducto" id="ArtesanalProducto">
                    <option value="no">No</option>
                    <option value="si">Si</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">UPC</label>
                  <input type="text" class="form-control form-control-sm" id="UpcProducto" name="UpcProducto" placeholder="" value="">
                </div>

                <div class="form-group">
                  <label for="">EAN</label>
                  <input type="text" class="form-control form-control-sm" id="EanProducto" name="EanProducto" placeholder="" value="">
                </div>

                <div class="form-group">
                  <label for="">JAN</label>
                  <input type="text" class="form-control form-control-sm" id="JanProducto" name="JanProducto" placeholder="" value="">
                </div>

                <div class="form-group">
                  <label for="">ISBN</label>
                  <input type="text" class="form-control form-control-sm" id="IsbnProducto" name="IsbnProducto" placeholder="" value="">
                </div>

                <div class="form-group">
                  <label for="">MPN</label>
                  <input type="text" class="form-control form-control-sm" id="MpnProducto" name="MpnProducto" placeholder="" value="">
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
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
              <div class="card-body">
                <img src="<?php echo base_url('contenido/img/productos/completo/default.jpg') ?>" id="PrevisualizarImagen" alt="" class="img-fluid img-thumbnail rounded">
                <div class="custom-file file-sm mb-3">
                  <input type="file" class="form-control" id="ImagenProducto" name="ImagenProducto" placeholder="" value="">
                  <label for="ImagenProducto"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                </div>

              </div>
            </div>
          </div>
        </div>


        <button type="submit" class="btn btn-sm mt-3 btn-primary float-right"> <span class="fa fa-save"></span>  <?php echo $this->lang->line('usuario_form_producto_crear_producto'); ?></button>

      </form>

    </div>
  </div>
</div>

<!-- Modal de flujos -->

<!-- Modal -->
<div class="modal fade" id="ModalAyuda" tabindex="-1" role="dialog" aria-labelledby="ModalAyuda" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-question-circle"></i> Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">

          <div class="linea-colores-delgada">
            <div class="barra-color barra-azul"></div>
            <div class="barra-color barra-rosa"></div>
            <div class="barra-color barra-amarillo"></div>
            <div class="barra-color barra-verde"></div>
            <div class="barra-color barra-morado"></div>
          </div>
        <!-- Slider Ayuda-->
        <div id="carouselAyuda" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselAyuda" data-slide-to="0" class="active"></li>
            <li data-target="#carouselAyuda" data-slide-to="1"></li>
            <li data-target="#carouselAyuda" data-slide-to="2"></li>
            <li data-target="#carouselAyuda" data-slide-to="3"></li>
            <li data-target="#carouselAyuda" data-slide-to="4"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo4.1.png'); ?>" alt="Registro paso 1">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo4.2.png'); ?>" alt="Registro paso 2">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo4.3.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo4.4.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo4.5.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo4.6.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo4.7.png'); ?>" alt="Registro paso 4">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselAyuda" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselAyuda" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
