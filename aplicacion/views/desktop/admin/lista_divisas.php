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
          <h1 class="h6"> <span class="fa fa-money-bill"></span> Divisas</h1>
        </div>
        <div class="formulario">
          <form class="form-inline" action="<?php echo base_url('admin/divisas/busqueda');?>" method="get">
            <div class="form-group">
              <label for="Busqueda" class="sr-only">Busqueda</label>
              <input type="text" class="form-control form-control-sm" id="Busqueda" name="Busqueda" placeholder="Buscar">
            </div>
            <button type="submit" class="btn btn<?php echo $primary ?> btn-sm"> <span class="fa fa-search"></span> </button>
          </form>
        </div>
        <div class="opciones d-flex">
          <div class="btn-group btn-sm">
            <a href="<?php echo base_url('admin/divisas/crear'); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nueva divisa </a>
          </div>

        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-sm table-hover table-striped">
          <thead class="text-light bg<?php echo $primary; ?>">
            <tr>
              <th class="text-center">Nombre</th>
              <th class="text-center">Iso</th>
              <th class="text-center">Signo</th>
              <th class="text-center">Conversión</th>
              <th class="text-center">Estado</th>
              <th class="text-right">Controles</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($divisas as $divisa){ ?>
            <tr>
              <td class="text-center"><?php echo $divisa->DIVISA_NOMBRE; ?></td>
              <td class="text-center"><?php echo $divisa->DIVISA_ISO; ?></td>
              <td class="text-center"><?php echo $divisa->DIVISA_SIGNO; ?></td>
              <td class="text-center"><?php echo $divisa->DIVISA_CONVERSION; ?></td>
              <td class="text-center">
                <?php if($divisa->DIVISA_ESTADO=='activo'){ ?>
                  <a href="<?php echo base_url('admin/divisas/activar')."?id=".$divisa->ID_DIVISA."&estado=".$divisa->DIVISA_ESTADO; ?>" class="btn btn-sm btn-outline-success" title="Activar Divisa"> <span class="fa fa-check-circle"></span> </a>
                <?php }else{ ?>
                  <a href="<?php echo base_url('admin/divisas/activar')."?id=".$divisa->ID_DIVISA."&estado=".$divisa->DIVISA_ESTADO; ?>" class="btn btn-sm btn-outline-danger" title="Desactivar Divisa"> <span class="fa fa-times-circle"></span> </a>
                <?php } ?>
              </td>
              <td class="text-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="<?php echo base_url('admin/divisas/actualizar')."?id=".$divisa->ID_DIVISA; ?>" class="btn btn-sm btn-warning" title="Editar Divisa"> <span class="fa fa-pencil-alt"></span> </a>
                  <?php if($divisa->ID_DIVISA!=$op['divisa_predeterminada']){ ?>
                    <button type="button" class="btn btn-danger btn-sm borrar_entrada" data-enlace="<?php echo base_url('admin/divisas/borrar')."?id=".$divisa->ID_DIVISA; ?>" title="Eliminar Divisa"><span class="fa fa-trash"></span></button>
                  <?php } ?>
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
