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
                            <div class="row pt-3">
                              <div class="col">
                                <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Actualizar Combinación</button>
                              </div>
                            </div>
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
                              <div class="col">
                                <div class="form-group">
                                  <label for="PrecioMayoreoCombinacion">Precio de Mayoreo</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">$</div>
                                    </div>
                                  <input type="text" class="form-control" id="PrecioMayoreoCombinacion" name="PrecioMayoreoCombinacion" placeholder="" value="<?php echo $combinacion['COMBINACION_PRECIO_MAYOREO']; ?>">
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
                                  <label for="AnchoCombinacion">Ancho</label>
                                  <div class="input-group mb-2">
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
                                  <div class="input-group mb-2">
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
                                  <div class="input-group mb-2">
                                  <input type="text" class="form-control" id="ProfundoCombinacion" name="ProfundoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PROFUNDO']; ?>">
                                    <div class="input-group-append">
                                      <div class="input-group-text">cm</div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <label for="PesoCombinacion">Peso Total</label>
                                  <div class="input-group mb-2">
                                  <input type="text" class="form-control" id="PesoCombinacion" name="PesoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PESO']; ?>">
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
                                  <div class="input-group mb-2">
                                  <input type="text" class="form-control" id="PesoNetoCombinacion" name="PesoNetoCombinacion" placeholder="" value="<?php echo $combinacion['COMBINACION_PESO_NETO']; ?>">
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
                              <?php foreach($galerias as $galeria){ ?>
                                <div class="col-1 text-center">
                                  <label for="ImagenCombinacion-<?php echo $galeria->ID_GALERIA; ?>">
                                    <img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO) ?>" class="img-fluid" alt="">
                                    <hr>
                                    <input class="form-check-input" type="radio" name="ImagenCombinacion" id="ImagenCombinacion-<?php echo $galeria->ID_GALERIA; ?>" <?php if($galeria->GALERIA_ARCHIVO==$combinacion['COMBINACION_IMAGEN']){ echo 'checked'; } ?> value="<?php echo $galeria->GALERIA_ARCHIVO; ?>">
                                  </label>
                                </div>
                              <?php } ?>
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
