<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h5 class="float-left"> <span class="fa fa-box"></span> <?php echo $this->lang->line('usuario_listas_generales_nuevo'); ?> <?php echo $this->lang->line('usuario_lista_productos_singular'); ?></h5>
            </div>
            <div class="card-body">
              <div class="protector_formulario"> <div class="p4 text-center"><h3><i class="fa fa-spinner fa-pulse"></i> Por favor espere...</h3></div> </div>
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
    						<div class="row border-top border-bottom my-1 mb-5 py-1 bg-gray">
    							<div class="col">
    								<div class="btn-group float-right">
    									<button type="submit" class="btn btn-outline-success btn-sm" name="Guardar" value="salir"> <span class="fa fa-chevron-left"></span> <span class="fa fa-chevron-left"></span> Guardar y ver todos los productos</button>
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
