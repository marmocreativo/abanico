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
                          <form class="" action="<?php echo base_url('admin/productos_rangos_mayoreo/crear'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="IdProducto" value="<?php echo $_GET['id']; ?>">
                            <input type="hidden" name="Identificador" value="<?php echo $rango['ID_RANGO']; ?>">
                            <h6> <i class="fa fa-sitemap"></i> Nuevo rango de precio</h6>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label for="UnidadRango">Unidad <small>Ej. Kilos</small> </label>
                                  <input type="text" class="form-control" id="UnidadRango" name="UnidadRango" required placeholder="" value="<?php echo $?>">
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <label for="MinimoRango">Mínimo </label>
                                  <input type="text" class="form-control" id="MinimoRango" name="MinimoRango" required placeholder="" value="<?=!form_error('GrupoCombinacion')?set_value('GrupoCombinacion'):''?>">
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <label for="MaximoRango">Máximo </label>
                                  <input type="text" class="form-control" id="MaximoRango" name="MaximoRango" required placeholder="" value="<?=!form_error('GrupoCombinacion')?set_value('GrupoCombinacion'):''?>">
                                </div>
                              </div>

                              <div class="col">
                                <div class="form-group">
                                  <label for="PrecioUnidadRango">Precio de Venta</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">$</div>
                                    </div>
                                  <input type="text" class="form-control" id="PrecioUnidadRango" name="PrecioUnidadRango" required placeholder="" value="<?php echo $producto['PRODUCTO_PRECIO']; ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row pt-3">
                              <div class="col">
                                <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Agregar Rango</button>
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
