
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
					<div class="protector_formulario"> <div class="p4 text-center"><h3><i class="fa fa-spinner fa-pulse"></i> Por favor espere...</h3></div> </div>
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
						<div class="row border-top border-bottom my-1 mb-5 py-1 bg-gray">
							<div class="col">
								<div class="btn-group float-right">
									<button type="submit" class="btn btn-outline-success btn-sm" name="Guardar" value="salir"> <span class="fa fa-chevron-left"></span> <span class="fa fa-chevron-left"></span> Guardar y ver todos los productos</button>
									<button type="submit" class="btn btn-success btn-sm" name="Guardar" value="tienda"> <span class="fa fa-chevron-left"></span> Guardar y ver los productos de <b><?php echo $tienda['TIENDA_NOMBRE'];  ?></b> </button>
									<button type="submit" class="btn btn-outline-primary btn-sm" name="Guardar" value="combinaciones"> <span class="fa fa-sitemap"></span> Guardar y editar <b>combinaciones</b></button>
									<button type="submit" class="btn btn-primary btn-sm" name="Guardar" value="guardar"> <span class="fa fa-save"></span> Guardar y seguir editando</button>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="EstadoProducto"> <i class="fa fa-check-circle"></i> Estado del Producto</label>
									<select class="form-control" id="EstadoProducto" name="EstadoProducto" placeholder="">
										<option value="activo"  >Publicado</option>
										<option value="inactivo" >Borrador</option>
									</select>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="ContraEntregaProducto"><i class="fa fa-money-bill"></i> Pago a contra entrega</label>
									<select class="form-control" id="ContraEntregaProducto" name="ContraEntregaProducto" placeholder="">
										<option value="no" >No</option>
										<option value="si">Si</option>
									</select>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="MayoreoProducto"><i class="fa fa-money-bill"></i> Disponible en mayoreo</label>
									<select class="form-control" id="MayoreoProducto" name="MayoreoProducto" placeholder="">
										<option value="no">Solo Online</option>
										<option value="mayoreo">Solo Mayoreo</option>
										<option value="si">Online y Mayoreo</option>
									</select>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="EnvioGratuitoProducto"><i class="fa fa-truck"></i> Envio Gratuito con Transportista:</label>
									<select class="form-control" name="EnvioGratuitoProducto">
										<option value="no">Ninguno</option>
										<?php foreach($transportistas as $transportista){ ?>
											<option value="<?php echo $transportista->ID_TRANSPORTISTA; ?>"><?php echo $transportista->TRANSPORTISTA_NOMBRE; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12 text-center">
								<h4 class="border-bottom my-4 pb-2"> <i class="fa fa-clipboard-list"></i> Datos Generales</h4>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label for="NombreProducto">Nombre del producto</label>
									<input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="">
								</div>
							</div>
							<div class="col-12">
								<button type="button" class="btn btn-outline-secondary btn-sm btn-block" type="button" data-toggle="collapse" data-target="#MetaTituloCollapse" aria-expanded="false" aria-controls="MetaTituloCollapse"><i class="fa fa-plus"></i> Meta datos</button>
							</div>
							<div class="col-12 collapse" id="MetaTituloCollapse">
								<div class="form-group">
									<label for="MetaTitulo">Meta Título</label>
									<input type="text" class="form-control" id="MetaTitulo" name="MetaTitulo" placeholder="" value="">
									<small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Para mejorar el posicionamiento en internet, un título corto menos de 70 caracteres</small>
								</div>
								<div class="form-group">
									<label for="MetaDescripcion">Meta Descripción</label>
									<textarea class="form-control" name="MetaDescripcion" rows="3" cols="80"></textarea>
									<small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Para mejorar el posicionamiento en internet, un título corto menos de 140 caracteres</small>
								</div>
								<div class="form-MetaKeywords">
									<label for="MetaDescripcion">Meta Keywords</label>
									<textarea class="form-control" name="MetaKeywords" rows="3" cols="80"></textarea>
									<small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Para mejorar el posicionamiento en internet, de 1 a 10 frases separadas por coma que describan tu servicio</small>
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<div class="form-group">
									<label for="DivisaDefaultProducto">Divisa</label>
									<select class="form-control" name="DivisaDefaultProducto">
									<?php foreach($divisas_activas as $divisas){ ?>
										<option value="<?php echo $divisas->DIVISA_ISO; ?>" ><?php echo $divisas->DIVISA_ISO; ?></option>
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
									<input type="text" class="form-control" id="PrecioProducto" name="PrecioProducto" required placeholder="" value="">
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
									<input type="number" step="0.01" min="" class="form-control" id="PrecioListaProducto" name="PrecioListaProducto" placeholder="" value="">
									</div>
									<small class="form-text text-muted"> <i class="fa fa-info-circle"></i> <?php echo $this->lang->line('usuario_form_producto_precio_lista_instrucciones'); ?></small>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="PrecioMayoreoProducto">Precio Mayoreo <small>Opcional</small></label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
											<div class="input-group-text">$</div>
										</div>
									<input type="number" step="0.01" min="" class="form-control" id="PrecioMayoreoProducto" name="PrecioMayoreoProducto" placeholder="" value="">
									</div>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="CantidadProducto"><?php echo $this->lang->line('usuario_form_producto_cantidad'); ?></label>
									<input type="number" class="form-control" id="CantidadProducto" required name="CantidadProducto" placeholder="" min="0" value="">
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-4">
								<div class="form-group">
									<label for="OrigenProducto">Origen</label>
									<select class="form-control form-control-sm" name="OrigenProducto" id="OrigenProducto">
										<option value="México" >México</option>
										<option value="Otro">Otro</option>
									</select>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label for="CondicionProducto">Condición</label>
									<select class="form-control form-control-sm" name="CondicionProducto" id="CondicionProducto">
										<option value="nuevo" >Nuevo</option>
										<option value="usado" >Usuado</option>
									</select>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label for="ArtesanalProducto">¿Es un producto Artesanal?</label>
									<select class="form-control form-control-sm" name="ArtesanalProducto" id="ArtesanalProducto">
										<option value="no" >No</option>
										<option value="si">Si</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12 text-center">
								<h4 class="border-bottom my-4 pb-2"> <i class="fa fa-cube"></i> Dimensiones</h4>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="AnchoProducto">Ancho</label>
									<div class="input-group mb-2">
										<input type="text" class="form-control" id="AnchoProducto" name="AnchoProducto" required placeholder="" value="">
										<div class="input-group-append">
											<div class="input-group-text">cm</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="AltoProducto">Alto</label>
									<div class="input-group mb-2">
										<input type="text" class="form-control" id="AltoProducto" name="AltoProducto" required placeholder="" value="">
										<div class="input-group-append">
											<div class="input-group-text">cm</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="ProfundoProducto">Profundo</label>
									<div class="input-group mb-2">
									<input type="text" class="form-control" id="ProfundoProducto" name="ProfundoProducto" required placeholder="" value="">
										<div class="input-group-append">
											<div class="input-group-text">cm</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="PesoProducto">Peso Total</label>
									<div class="input-group mb-2">
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
									<div class="input-group mb-2">
									<input type="text" class="form-control" id="PesoNetoProducto" name="PesoNetoProducto" placeholder="" value="">
										<div class="input-group-append">
											<div class="input-group-text">Kg</div>
										</div>
									</div>
									<small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Peso neto del producto</small>
								</div>
							</div>
							<div class="col-12">
								<button type="button" class="btn btn-outline-secondary btn-sm btn-block" type="button" data-toggle="collapse" data-target="#ModeloCollapse" aria-expanded="false" aria-controls="ModeloCollapse"><i class="fa fa-plus"></i> Modelo y claves</button>
							</div>
							<div class="col-12 collapse" id="ModeloCollapse">
									<div class="row my-3">
										<div class="col-4">
											<div class="form-group">
												<label for="ModeloProducto">Modelo</label>
												<input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" value="">
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label for="SkuProducto">SKU (Clave de Inventario)</label>
												<input type="text" class="form-control" id="SkuProducto" name="SkuProducto" placeholder="" value="">
											</div>
										</div>
										<input type="hidden" id="CantidadMinimaProducto" name="CantidadMinimaProducto" value="">
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
						</div>
						<div class="row mb-3">
							<div class="col-12 text-center">
								<h4 class="border-bottom my-4 pb-2"> <i class="fa fa-clipboard"></i> Descripciones</h4>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label for="DescripcionProducto">Descripción corta</label>
									<textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control SmallEditor" rows="3"></textarea>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label for="DetallesProducto">Detalles del producto</label>
									<textarea id="DetallesProducto" name="DetallesProducto" class="form-control Editor" rows="5"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 text-center">
								<h4 class="border-bottom my-4 pb-2"> <i class="fa fa-list"></i> Categorías</h4>
							</div>

								<?php $i=1; foreach($categorias as $categoria){ ?>
									<div class="col-12 card"> <!-- Título y botón de categoría -->
										<div class="card-header" id="heading<?php echo $i; ?>">
												<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
													<h6><i class="<?php echo $categoria->CATEGORIA_ICONO; ?>"></i> <?php echo $categoria->CATEGORIA_NOMBRE; ?></h6>
													<?php $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
												</button>
										</div>
											<div class="row collapse" id="collapse<?php echo $i; ?>" aria-labelledby="heading<?php echo $i; ?>">
											<?php foreach($segundo_categorias as $segunda_categoria){ ?>
												<div class="col-4">
													<div class="p-3">
														<div class="custom-control custom-checkbox">
															<input  type="checkbox"
																			id="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>"
																			name="CategoriaProducto[]"
																			class="custom-control-input"
																			value="<?php echo $segunda_categoria->ID_CATEGORIA; ?>"

																			data-padre='<?php echo 'collapse'.$i; ?>'
																			>
															<label class="custom-control-label h6" for="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>">-<?php echo $segunda_categoria->CATEGORIA_NOMBRE; ?></label>
														</div>
													<?php $tercero_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'',''); ?>
													<ul class="list list-unstyled ml-3">
														<?php foreach($tercero_categorias as $tercera_categoria){ ?>
														<li>
															<div class="custom-control custom-checkbox">
																<input  type="checkbox"
																				id="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
																				name="CategoriaProducto[]" class="custom-control-input"
																				value="<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
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
						<div class="row">
							<div class="col-12 text-center">
								<h4 class="border-bottom my-4 pb-2"> <i class="fa fa-images"></i> Galería</h4>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label for="ImagenProducto">Añadir Imagen</label>
									<input type="file" class="form-control" id="ImagenProducto" name="ImagenProducto">
								</div>
							</div>
						</div>

						<div class="row border-top mt-3 pt-3">
							<div class="col">
								<div class="btn-group float-right">
									<button type="submit" class="btn btn-outline-success btn-sm" name="Guardar" value="salir"> <span class="fa fa-chevron-left"></span> <span class="fa fa-chevron-left"></span> Guardar y ver todos los productos</button>
									<button type="submit" class="btn btn-success btn-sm" name="Guardar" value="tienda"> <span class="fa fa-chevron-left"></span> Guardar y ver los productos de <?php echo $tienda['TIENDA_NOMBRE'];  ?> </button>
									<button type="submit" class="btn btn-outline-primary btn-sm" name="Guardar" value="combinaciones"> <span class="fa fa-sitemap"></span> Guardar y editar <b>combinaciones</b></button>
									<button type="submit" class="btn btn-primary btn-sm" name="Guardar" value="guardar"> <span class="fa fa-save"></span> Guardar y seguir editando</button>
								</div>
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
