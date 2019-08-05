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
            <?php retro_alimentacion(); ?>
            <!--begin:: Widgets/Trends-->
            <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
              <div class="kt-portlet__body">
                <div class="row">
                  <div class="col">
                    <div class="card">
                      <div class="card-header d-flex justify-content-between">
                        <div class="titulo">
                          <h1 class="h5"> <span class="fa fa-ban"></span> Restricciones</h1>
                        </div>
                        <div class="formulario">
                        </div>
                        <div class="opciones d-flex">
                        </div>
                      </div>
                      <div class="card-body p-0">
                        <div class="row">
                            <div class="col p-3">
                              <form class="" action="<?php echo base_url('admin/transportistas_restricciones/crear'); ?>" method="post">
                                <input type="hidden" name="IdTransportista" value="<?php echo $transportista['ID_TRANSPORTISTA'] ?>">
                                <input type="hidden" name="TipoObjeto" value="tienda">
                                <h6> <i class="fa fa-store"></i> Tiendas exclusivas</h6>
                                <div class="form-group">
                                  <label for="IdObjeto">Añadir una tienda</label>
                                  <select class="form-control" name="IdObjeto">
                                    <option value="">Selecciona una tienda</option>
                                    <?php foreach($tiendas as $tienda){ ?>
                                      <option value="<?php echo $tienda->ID_TIENDA; ?>"><?php echo $tienda->TIENDA_NOMBRE; ?> | <?php echo $tienda->TIENDA_RFC; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="button"> <i class="fa fa-save"></i> Añadir</button>
                              </form>
                              <hr>
                              <ul>
                                <?php foreach($restricciones_tiendas as $r_tiendas){ ?>
                                  <?php $tienda = $this->TiendasModel->detalles($r_tiendas->ID_OBJETO); ?>
                                  <li><?php echo $tienda['TIENDA_NOMBRE']; ?> <a href="<?php echo base_url('admin/transportistas_restricciones/borrar?id=').$r_tiendas->ID_RESTRICCION; ?>"> <i class="fa fa-trash"></i> </a></li>
                                <?php } ?>
                              </ul>
                            </div>
                            <div class="col pt-3">
                              <form class="" action="<?php echo base_url('admin/transportistas_restricciones/crear'); ?>" method="post">
                                <input type="hidden" name="IdTransportista" value="<?php echo $transportista['ID_TRANSPORTISTA'] ?>">
                                <input type="hidden" name="TipoObjeto" value="producto">
                                <h6> <i class="fa fa-box"></i> Productos exclusivos</h6>
                                <div class="form-group">
                                  <label for="">Añadir un producto</label>
                                  <select class="form-control" name="IdObjeto">
                                    <option value="">Selecciona un producto</option>
                                    <?php foreach($productos as $producto){ ?>
                                      <option value="<?php echo $producto->ID_PRODUCTO; ?>"><?php echo $producto->PRODUCTO_NOMBRE; ?> | <?php echo $producto->ID_PRODUCTO; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="button"> <i class="fa fa-save"></i> Añadir</button>
                              </form>
                              <hr>
                              <ul>
                                <?php foreach($restricciones_productos as $r_productos){ ?>
                                  <?php $producto = $this->ProductosModel->detalles($r_productos->ID_OBJETO); ?>
                                  <li><?php echo $producto['PRODUCTO_NOMBRE']; ?> <a href="<?php echo base_url('admin/transportistas_restricciones/borrar?id=').$r_productos->ID_RESTRICCION; ?>"> <i class="fa fa-trash"></i> </a> </li>
                                <?php } ?>
                              </ul>
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
