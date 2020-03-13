<?php
  $id_usuario = $producto['ID_USUARIO'];
  if(isset($_GET['tab'])){ $tab = $_GET['tab']; } else { $tab=''; }
?>

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
                  <div class="protector_formulario"> <div class="p4 text-center"><h3><i class="fa fa-spinner fa-pulse"></i> Por favor espere...</h3></div> </div>
                  <?php retro_alimentacion(); ?>
                  <!-- Alertas de Validación -->
                  <?php if(!empty(validation_errors())){ ?>
                    <div class="alert alert-danger">
                      <?php echo validation_errors(); ?>
                    </div>
                    <hr>
                  <?php } ?>

                  <form class="" action="<?php echo base_url('admin/productos/actualizar'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="TipoProducto" value="<?php echo $tipo_producto; ?>">
                    <input type="hidden" name="IdUsuario" value="<?php echo $producto['ID_USUARIO']; ?>">
                    <input type="hidden" name="IdTienda" value="<?php echo $tienda['ID_TIENDA']; ?>">
                    <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="UrlProducto" value="<?php echo $producto['PRODUCTO_URL']; ?>">
                    <input type="hidden" name="SeccionActiva" id="SeccionActiva" value="">
                    <div class="row border-top border-bottom my-1 mb-5 py-1 bg-gray">
                      <div class="col">
                        <div class="btn-group float-right">
                          <button type="submit" class="btn btn-outline-success btn-sm" name="Guardar" value="salir"> <span class="fa fa-chevron-left"></span> <span class="fa fa-chevron-left"></span> Guardar y ver todos los productos</button>
                          <button type="submit" class="btn btn-success btn-sm" name="Guardar" value="tienda"> <span class="fa fa-chevron-left"></span> Guardar y ver los productos de <b><?php echo $tienda['TIENDA_NOMBRE'];  ?></b> </button>
                          <button type="submit" class="btn btn-outline-primary btn-sm" name="Guardar" value="combinaciones"> <span class="fa fa-sitemap"></span> Guardar y editar <b>combinaciones</b></button>
                          <button type="submit" class="btn btn-outline-primary btn-sm" name="Guardar" value="rangos"> <span class="fa fa-sitemap"></span> Guardar y editar <b>Rangos Mayoreo</b></button>
                          <button type="submit" class="btn btn-primary btn-sm" name="Guardar" value="guardar"> <span class="fa fa-save"></span> Guardar y seguir editando</button>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="EstadoProducto"> <i class="fa fa-check-circle"></i> Estado del Producto</label>
                          <select class="form-control" id="EstadoProducto" name="EstadoProducto" placeholder="">
                            <option value="activo" <?php if($producto['PRODUCTO_ESTADO']=='activo'){ echo 'selected';} ?> >Publicado</option>
                            <option value="inactivo" <?php if($producto['PRODUCTO_ESTADO']=='inactivo'){ echo 'selected';} ?>>Borrador</option>
                          </select>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="ContraEntregaProducto"><i class="fa fa-money-bill"></i> Pago a contra entrega</label>
                          <select class="form-control" id="ContraEntregaProducto" name="ContraEntregaProducto" placeholder="">
                            <option value="no" <?php if($producto['PRODUCTO_CONTRA_ENTREGA']=='no'){ echo 'selected';} ?> >No</option>
                            <option value="si" <?php if($producto['PRODUCTO_CONTRA_ENTREGA']=='si'){ echo 'selected';} ?>>Si</option>
                          </select>
                        </div>
                      </div>
                      <div class="col">
        								<div class="form-group">
        									<label for="MayoreoProducto"><i class="fa fa-money-bill"></i> Disponible en mayoreo</label>
        									<select class="form-control" id="MayoreoProducto" name="MayoreoProducto" placeholder="">
        										<option value="no" <?php if($producto['PRODUCTO_MAYOREO']=='no'){ echo 'selected';} ?>>No</option>
        										<option value="si" <?php if($producto['PRODUCTO_MAYOREO']=='si'){ echo 'selected';} ?>>Si</option>
        									</select>
        								</div>
        							</div>
                      <div class="col">
                        <div class="form-group">
                          <label for="EnvioGratuitoProducto"><i class="fa fa-truck"></i> Envio Gratuito con Transportista:</label>
                          <select class="form-control" name="EnvioGratuitoProducto">
                            <option value="no">Ninguno</option>
                            <?php foreach($transportistas as $transportista){ ?>
                              <option value="<?php echo $transportista->ID_TRANSPORTISTA; ?>" <?php if($producto['PRODUCTO_ENVIO_GRATUITO']==$transportista->ID_TRANSPORTISTA){ echo 'selected';} ?>><?php echo $transportista->TRANSPORTISTA_NOMBRE; ?></option>
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
                          <input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="<?php echo $producto['PRODUCTO_NOMBRE']; ?>">
                        </div>
                      </div>
                      <div class="col-12">
                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block" type="button" data-toggle="collapse" data-target="#MetaTituloCollapse" aria-expanded="false" aria-controls="MetaTituloCollapse"><i class="fa fa-plus"></i> Meta datos</button>
                      </div>
                      <div class="col-12 collapse" id="MetaTituloCollapse">
                        <div class="form-group">
                          <label for="MetaTitulo">Meta Título</label>
                          <input type="text" class="form-control" id="MetaTitulo" name="MetaTitulo" placeholder="" value="<?php echo $producto['META_TITULO']; ?>">
                          <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Para mejorar el posicionamiento en internet, un título corto menos de 70 caracteres</small>
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
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col">
                        <div class="form-group">
                          <label for="DivisaDefaultProducto">Divisa</label>
                          <select class="form-control" name="DivisaDefaultProducto">
                          <?php foreach($divisas_activas as $divisas){ ?>
                            <option value="<?php echo $divisas->DIVISA_ISO; ?>" <?php if($producto['PRODUCTO_DIVISA_DEFAULT']==$divisas->DIVISA_ISO){ echo 'selected'; } ?>><?php echo $divisas->DIVISA_ISO; ?></option>
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
                          <input type="number" step="0.01" min="<?php echo $producto['PRODUCTO_PRECIO']+1; ?>" class="form-control" id="PrecioListaProducto" name="PrecioListaProducto" placeholder="" value="<?php if($producto['PRODUCTO_PRECIO_LISTA']!='0.00'){ echo $producto['PRODUCTO_PRECIO_LISTA']; }; ?>">
                          </div>
                          <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> <?php echo $this->lang->line('usuario_form_producto_precio_lista_instrucciones'); ?></small>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="CantidadProducto"><?php echo $this->lang->line('usuario_form_producto_cantidad'); ?></label>
                          <input type="number" class="form-control" id="CantidadProducto" required name="CantidadProducto" placeholder="" min="0" value="<?php echo $producto['PRODUCTO_CANTIDAD']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="OrigenProducto">Origen</label>
                          <select class="form-control form-control-sm" name="OrigenProducto" id="OrigenProducto">
                            <option value="México" <?php if($producto['PRODUCTO_ORIGEN']=='México'){ echo 'selected';} ?>>México</option>
                            <option value="Otro" <?php if($producto['PRODUCTO_ORIGEN']=='Otro'){ echo 'selected';} ?>>Otro</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="CondicionProducto">Condición</label>
                          <select class="form-control form-control-sm" name="CondicionProducto" id="CondicionProducto">
                            <option value="nuevo" <?php if($producto['PRODUCTO_CONDICION']=='nuevo'){ echo 'selected';} ?>>Nuevo</option>
                            <option value="usado" <?php if($producto['PRODUCTO_CONDICION']=='usuado'){ echo 'selected';} ?>>Usuado</option>
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
                    </div>
                    <div class="row mb-3">
                      <div class="col-12 text-center">
                        <h4 class="border-bottom my-4 pb-2"> <i class="fa fa-cube"></i> Dimensiones</h4>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="AnchoProducto">Ancho</label>
                          <div class="input-group mb-2">
                            <input type="text" class="form-control" id="AnchoProducto" name="AnchoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_ANCHO']; ?>">
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
                            <input type="text" class="form-control" id="AltoProducto" name="AltoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_ALTO']; ?>">
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
                          <input type="text" class="form-control" id="ProfundoProducto" name="ProfundoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PROFUNDO']; ?>">
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
                          <div class="input-group mb-2">
                          <input type="text" class="form-control" id="PesoNetoProducto" name="PesoNetoProducto" placeholder="" value="<?php echo $producto['PRODUCTO_PESO_NETO']; ?>">
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
                                <input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" value="<?php echo $producto['PRODUCTO_MODELO']; ?>">
                              </div>
                            </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label for="SkuProducto">SKU (Clave de Inventario)</label>
                                <input type="text" class="form-control" id="SkuProducto" name="SkuProducto" placeholder="" value="<?php echo $producto['PRODUCTO_SKU']; ?>">
                              </div>
                            </div>
                            <input type="hidden" id="CantidadMinimaProducto" name="CantidadMinimaProducto" value="<?php echo $producto['PRODUCTO_CANTIDAD_MINIMA']; ?>">
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
                    </div>
                    <div class="row mb-3">
                      <div class="col-12 text-center">
                        <h4 class="border-bottom my-4 pb-2"> <i class="fa fa-clipboard"></i> Descripciones</h4>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="DescripcionProducto">Descripción corta</label>
                          <textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control SmallEditor" rows="3"><?php echo $producto['PRODUCTO_DESCRIPCION']; ?></textarea>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="DetallesProducto">Detalles del producto</label>
                          <textarea id="DetallesProducto" name="DetallesProducto" class="form-control Editor" rows="5"><?php echo $producto['PRODUCTO_DETALLES']; ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 text-center">
                        <h4 class="border-bottom my-4 pb-2"> <i class="fa fa-list"></i> Categorías</h4>
                      </div>
                      <?php $categorias_producto = $this->CategoriasProductoModel->lista($producto['ID_PRODUCTO']);

                      $categorias_seleccionadas = array();
                      foreach($categorias_producto as $cat_select){
                        $categorias_seleccionadas[] = $cat_select->ID_CATEGORIA;
                      }

                      ?>
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
                                              class="custom-control-input <?php if(in_array($segunda_categoria->ID_CATEGORIA,$categorias_seleccionadas)){ echo 'abrir'; } ?>"
                                              value="<?php echo $segunda_categoria->ID_CATEGORIA; ?>"
                                              <?php if(in_array($segunda_categoria->ID_CATEGORIA,$categorias_seleccionadas)){ echo 'checked'; } ?>
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
                                                <?php if(in_array($tercera_categoria->ID_CATEGORIA,$categorias_seleccionadas)){ echo 'checked'; } ?>
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
                      <div class="col-8">
                        <table class="table table-bordered table-sm">
                          <thead>
                            <tr>
                              <th class="text-center">id</th>
                              <th class="text-center">Imagen</th>
                              <th class="text-center">Portada</th>
                              <th class="text-right">Controles</th>
                            </tr>
                          </thead>
                          <tbody class="ui-sortable" data-tabla="galeria_productos" data-columna="ID_GALERIA">
                            <?php foreach($galerias as $galeria){ ?>
                              <tr id="item-<?php echo $galeria->ID_GALERIA; ?>" class="ui-sortable-handle">
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
                                    <button type="button" data-enlace="<?php echo base_url('admin/productos/borrar_galeria')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>
                                  </div>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
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
