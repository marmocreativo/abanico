
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
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/productos/crear'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="TipoProducto" value="<?php echo $tipo_producto; ?>">
            <input type="hidden" name="IdUsuario" value="<?php echo $_GET['id_usuario']; ?>">
            <input type="hidden" name="IdTienda" value="<?php echo $tienda['ID_TIENDA']; ?>">
            <!--
            Menú de pestañas
            -->
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="basicos-tab" data-toggle="tab" href="#basicos" role="tab" aria-controls="basicos" aria-selected="false"> <span class="fa fa-list"></span> Datos Básicos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="categoria-tab" data-toggle="tab" href="#categoria" role="tab" aria-controls="categoria" aria-selected="false"> <span class="fa fa-list"></span> Categorias</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="true"> <span class="fa fa-file-alt"></span> Descripción</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="galeria-tab" data-toggle="tab" href="#galeria" role="tab" aria-controls="galeria" aria-selected="false"> <span class="fa fa-image"></span> Galeria</a>
              </li>
            </ul>
            <!--
            Tabs
            -->
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade active show p-3" id="basicos" role="tabpanel" aria-labelledby="basicos-tab">
                <div class="row mb-3">
                  <div class="col-9">
                    <div class="border border-primary p-2">
                      <h6 class="border-bottom pb-2"> <i class="fa fa-tag"></i> Información Básica Obligatoria</h6>
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="NombreProducto">Nombre del producto</label>
                            <input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="<?=!form_error('NombreProducto')?set_value('NombreProducto'):''?>">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="DivisaDefaultProducto">-</label>
                            <select class="form-control" name="DivisaDefaultProducto">
                            <?php foreach($divisas_activas as $divisas){ ?>
                              <option value="<?php echo $divisas->DIVISA_ISO; ?>"><?php echo $divisas->DIVISA_ISO; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="PrecioProducto"><?php echo $this->lang->line('usuario_form_producto_precio_venta'); ?></label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                              </div>
                            <input type="text" class="form-control" id="PrecioProducto" name="PrecioProducto" required placeholder="" value="<?=!form_error('PrecioProducto')?set_value('PrecioProducto'):''?>">
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
                            <input type="text" class="form-control" id="PrecioListaProducto" name="PrecioListaProducto" placeholder="" value="<?=!form_error('PrecioListaProducto')?set_value('PrecioListaProducto'):''?>">
                            </div>
                            <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> <?php echo $this->lang->line('usuario_form_producto_precio_lista_instrucciones'); ?></small>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="CantidadProducto"><?php echo $this->lang->line('usuario_form_producto_cantidad'); ?></label>
                            <input type="number" class="form-control" id="CantidadProducto" required name="CantidadProducto" placeholder="" min="1" value="1">
                          </div>
                        </div>
                      </div>
                      <h6 class="border-bottom pb-2"> <i class="fa fa-clipboard-list"></i> Cantidades</h6>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="ModeloProducto">Modelo</label>
                              <input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" value="<?=!form_error('ModeloProducto')?set_value('ModeloProducto'):''?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label for="SkuProducto">SKU (Clave de Inventario)</label>
                              <input type="text" class="form-control" id="SkuProducto" name="SkuProducto" placeholder="" value="">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label for="CantidadMinimaProducto">Venta mínima</label>
                              <input type="number" class="form-control" id="CantidadMinimaProducto" required name="CantidadMinimaProducto" placeholder="" min="1" value="1">
                            </div>
                          </div>
                        </div>
                      <h6 class="border-bottom pb-2"> <i class="fa fa-cube"></i> Dimensiones</h6>
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="AnchoProducto">Ancho</label>
                            <div class="input-group input-group-sm mb-2">
                              <input type="text" class="form-control" id="AnchoProducto" name="AnchoProducto" required placeholder="" value="<?=!form_error('AnchoProducto')?set_value('AnchoProducto'):''?>">
                              <div class="input-group-append">
                                <div class="input-group-text">cm</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="AltoProducto">Alto</label>
                            <div class="input-group input-group-sm mb-2">
                              <input type="text" class="form-control" id="AltoProducto" name="AltoProducto" required placeholder="" value="<?=!form_error('AltoProducto')?set_value('AltoProducto'):''?>">
                              <div class="input-group-append">
                                <div class="input-group-text">cm</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="ProfundoProducto">Profundo</label>
                            <div class="input-group input-group-sm mb-2">
                            <input type="text" class="form-control" id="ProfundoProducto" name="ProfundoProducto" required placeholder="" value="<?=!form_error('ProfundoProducto')?set_value('ProfundoProducto'):''?>">
                              <div class="input-group-append">
                                <div class="input-group-text">cm</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="PesoProducto">Peso Total</label>
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
                  <div class="col-3">
                    <div class="border border-default p-2">
                    <div class="form-group">
                      <label for="EstadoProducto">Estado del Producto</label>
                      <select class="form-control" id="EstadoProducto" name="EstadoProducto" placeholder="">
                        <option value="activo" >Publicado</option>
                        <option value="inactivo">Borrador</option>
                      </select>
                    </div>
										<div class="form-group">
											<label for="ContraEntregaProducto">Pago a contra entrega</label>
											<select class="form-control" id="ContraEntregaProducto" name="ContraEntregaProducto" placeholder="">
												<option value="no" >No</option>
												<option value="si" >Si</option>
											</select>
										</div>
										<div class="form-group">
											<label for="EnvioGratuitoProducto">Envio Gratuito con Transportista:</label>
											<select class="form-control" name="EnvioGratuitoProducto">
												<option value="no">Ninguno</option>
												<?php foreach($transportistas as $transportista){ ?>
													<option value="<?php echo $transportista->ID_TRANSPORTISTA; ?>" ><?php echo $transportista->TRANSPORTISTA_NOMBRE; ?></option>
												<?php } ?>
											</select>
										</div>
                  </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade p-3" id="categoria" role="tabpanel" aria-labelledby="datos-tab">
                <div class="row">
                    <!-- inicia categoria -->
                    <?php $i=1; foreach($categorias as $categoria){ ?>
                        <div class="col-12 card"> <!-- Título y botón de categoría -->
                          <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h6 class="border-bottom pb-3"><?php echo $categoria->CATEGORIA_NOMBRE; ?></h6>
                                <?php $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
                              </button>
                            </h5>
                          </div>

                          <div class="row collapse show" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample">
                          <?php $i = 1; foreach($segundo_categorias as $segunda_categoria){ ?>
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

                                            >
                                    <label class="custom-control-label" for="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>">-<?php echo $tercera_categoria->CATEGORIA_NOMBRE; ?></label>
                                  </div>
                                </li>
                              <?php } ?>
                              </ul>
                              </div>
                            </div>
                          <?php ++$i; } ?>
                          </div>
                        </div>
                    <?php } ?>
                    <!-- termina categoria -->
                </div>
              </div>
              <div class="tab-pane fade p-3" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                <div class="form-group">
                  <label for="DescripcionProducto">Descripción corta</label>
                  <textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control SmallEditor" rows="3"><?=!form_error('DescripcionProducto')?set_value('DescripcionProducto'):''?></textarea>
                </div>
                <div class="form-group">
                  <label for="DetallesProducto">Detalles del producto</label>
                  <textarea id="DetallesProducto" name="DetallesProducto" class="form-control Editor" rows="5"><?=!form_error('DetallesProducto')?set_value('DetallesProducto'):''?> </textarea>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="OrigenProducto">Origen</label>
                      <select class="form-control form-control-sm" name="OrigenProducto" id="OrigenProducto">
                        <option value="México">México</option>
                        <option value="Otro">Otro</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="CondicionProducto">Condición</label>
                      <select class="form-control form-control-sm" name="CondicionProducto" id="CondicionProducto">
                        <option value="nuevo">Nuevo</option>
                        <option value="usado">Usuado</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="ArtesanalProducto">¿Es un producto Artesanal?</label>
                      <select class="form-control form-control-sm" name="ArtesanalProducto" id="ArtesanalProducto">
                        <option value="no">No</option>
                        <option value="si">Si</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="UpcProducto">UPC</label>
                      <input type="text" class="form-control form-control-sm" id="UpcProducto" name="UpcProducto" placeholder="" value="">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="EanProducto">EAN</label>
                      <input type="text" class="form-control form-control-sm" id="EanProducto" name="EanProducto" placeholder="" value="">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="JanProducto">JAN</label>
                      <input type="text" class="form-control form-control-sm" id="JanProducto" name="JanProducto" placeholder="" value="">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="IsbnProducto">ISBN</label>
                      <input type="text" class="form-control form-control-sm" id="IsbnProducto" name="IsbnProducto" placeholder="" value="">
                    </div>
                  </div>
                  <div class="col-4">

                    <div class="form-group">
                      <label for="MpnProducto">MPN</label>
                      <input type="text" class="form-control form-control-sm" id="MpnProducto" name="MpnProducto" placeholder="" value="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade p-3" id="galeria" role="tabpanel" aria-labelledby="extras-tab">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="ImagenProducto">Añadir Imagen</label>
                      <input type="file" class="form-control" id="ImagenProducto" name="ImagenProducto">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row border-top mt-3 pt-3">
              <div class="col">
                <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Crear Producto</button>
              </div>
            </div>
          </form>
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
