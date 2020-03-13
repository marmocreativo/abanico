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

                  <?php retro_alimentacion(); ?>
                  <?php if(!empty(validation_errors())){ ?>
                    <div class="alert alert-danger">
                      <?php echo validation_errors(); ?>
                    </div>
                    <hr>
                  <?php } ?>

                  <div class="row">
                    <div class="col-12 border-top border-bottom my-1 mb-5 py-1 bg-gray">
                      <div class="btn-group float-right">
                        <a href="<?php echo base_url('admin/productos'); ?>" class="btn btn-outline-success btn-sm"><span class="fa fa-chevron-left"></span> <span class="fa fa-chevron-left"></span> Volver a todos los productos</a>
                        <a href="<?php echo base_url('admin/productos?id_usuario='.$usuario['ID_USUARIO']); ?>" class="btn btn-success btn-sm"><span class="fa fa-chevron-left"></span>Volver a los productos de <b><?php echo $tienda['TIENDA_NOMBRE'];  ?></b></a>
                        <a href="<?php echo base_url('admin/productos/actualizar?id='.$producto['ID_PRODUCTO']); ?>" class="btn btn-outline-success btn-sm"><span class="fa fa-pencil"></span> <span class="fa fa-chevron-left"></span> Volver al editor del producto</a>
                      </div>
                    </div>
                    <div class="col">
                      <div class="border p-3 mb-3">
                        <form class="" action="<?php echo base_url('admin/productos_rangos_mayoreo/crear'); ?>" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="IdProducto" value="<?php echo $_GET['id']; ?>">
                          <h6> <i class="fa fa-sitemap"></i> Nuevo rango de precio</h6>
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label for="UnidadRango">Unidad <small>Ej. Kilos</small> </label>
                                <input type="text" class="form-control" id="UnidadRango" name="UnidadRango" required placeholder="" value="<?=!form_error('GrupoCombinacion')?set_value('GrupoCombinacion'):''?>">
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
                      <h5> <i class="fa fa-sitemap"></i> Combinaciones actuales</h5>
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th>Unidad</th>
                            <th>Mínimo</th>
                            <th>Máximo</th>
                            <th>Precio</th>
                            <th class="text-right">Controles</th>
                          </tr>
                        </thead>
                        <tbody class="ui-sortable" data-tabla="productos_combinaciones" data-columna="ID_COMBINACION">
                          <?php foreach($rangos_mayoreo as $rango){ ?>
                          <tr id="item-<?php echo $rango->ID_RANGO; ?>" class="ui-sortable-handle">
                            <td><?php echo $rango->RANGO_UNIDAD; ?></td>
                            <td><?php echo $rango->RANGO_MIN; ?></td>
                            <td><?php echo $rango->RANGO_MAX; ?></td>
                            <td>$<?php echo $rango->RANGO_PRECIO_UNIDAD; ?></td>
                            <td>
                              <div class="btn-group float-right">
                                <a href="<?php echo base_url('admin/productos_combinaciones/actualizar?id='.$rango->ID_RANGO); ?>" class="btn btn-sm btn-warning" title="Editar Combinacion"> <span class="fa fa-pencil-alt"></span> </a>
                                <button data-enlace='<?php echo base_url('admin/productos_combinaciones/borrar?id='.$rango->ID_RANGO); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Combinacion"> <span class="fa fa-trash"></span> </button>
                              </div>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-12 border-top border-bottom my-1 mb-5 py-1 bg-gray">
                      <div class="btn-group float-right">
                        <a href="<?php echo base_url('admin/productos'); ?>" class="btn btn-outline-success btn-sm"><span class="fa fa-chevron-left"></span> <span class="fa fa-chevron-left"></span> Volver a todos los productos</a>
                        <a href="<?php echo base_url('admin/productos?id_usuario='.$usuario['ID_USUARIO']); ?>" class="btn btn-success btn-sm"><span class="fa fa-chevron-left"></span>Volver a los productos de <b><?php echo $tienda['TIENDA_NOMBRE'];  ?></b></a>
                        <a href="<?php echo base_url('admin/productos/actualizar?id='.$producto['ID_PRODUCTO']); ?>" class="btn btn-outline-success btn-sm"><span class="fa fa-pencil"></span> <span class="fa fa-chevron-left"></span> Volver al editor del producto</a>
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
