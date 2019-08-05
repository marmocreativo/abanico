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
    <div class="col mt-3">
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-truck"></span> Transportistas</h1>
          </div>
          <div class="formulario">
            <form class="form-inline" action="<?php echo base_url('admin/transportistas/busqueda');?>" method="get">
              <div class="form-group">
                <label for="Busqueda" class="sr-only">Busqueda</label>
                <input type="text" class="form-control" id="Busqueda" name="Busqueda" placeholder="Buscar">
              </div>
              <button type="submit" class="btn btn<?php echo $primary ?>"> <span class="fa fa-search"></span> </button>
            </form>
          </div>
          <div class="opciones d-flex">
            <div class="btn-group btn-sm">
              <a href="<?php echo base_url('admin/transportistas/crear'); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nuevo Transportista </a>
            </div>

          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-hover table-striped">
            <thead class="text-light bg<?php echo $primary; ?>">
              <tr>
                <th>Logo</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Tiempo de Entrega</th>
                <th class="text-center">Estado</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($transportistas as $transportista){ ?>
              <tr>
                <td class="text-center"> <img src="<?php echo base_url($op['ruta_imagenes_transportistas'].$transportista->TRANSPORTISTA_LOGO); ?>" class="img-thumbnail" width="50" alt=""> </td>
                <td class="text-center"><?php echo $transportista->TRANSPORTISTA_NOMBRE; ?></td>
                <td class="text-center"><?php echo $transportista->TRANSPORTISTA_DESCRIPCION; ?></td>
                <td class="text-center"><?php echo $transportista->TRANSPORTISTA_TIEMPO_ENTREGA; ?></td>
                <td class="text-center">
                  <?php if($transportista->TRANSPORTISTA_ESTADO=='activo'){ ?>
                    <a href="<?php echo base_url('admin/transportistas/activar')."?id=".$transportista->ID_TRANSPORTISTA."&estado=".$transportista->TRANSPORTISTA_ESTADO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                  <?php }else{ ?>
                    <a href="<?php echo base_url('admin/transportistas/activar')."?id=".$transportista->ID_TRANSPORTISTA."&estado=".$transportista->TRANSPORTISTA_ESTADO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('admin/transportistas_rangos')."?id_transportista=".$transportista->ID_TRANSPORTISTA; ?>" class="btn btn-sm btn-outline-primary" title="Editar Transportista"> <span class="fa fa-pencil-alt"></span> Rangos de Precios </a>
                    <a href="<?php echo base_url('admin/transportistas/actualizar')."?id=".$transportista->ID_TRANSPORTISTA; ?>" class="btn btn-sm btn-warning" title="Editar Transportista"> <span class="fa fa-pencil-alt"></span> </a>
                    <a href="<?php echo base_url('admin/transportistas_restricciones')."?id=".$transportista->ID_TRANSPORTISTA; ?>" class="btn btn-sm btn-outline-danger" title="Restricciones Transportista"> <span class="fa fa-ban"></span> </a>
                    <button data-enlace='<?php echo base_url('admin/transportistas/borrar')."?id=".$transportista->ID_TRANSPORTISTA; ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Transportista"> <span class="fa fa-trash"></span> </button>
                  </div>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
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
