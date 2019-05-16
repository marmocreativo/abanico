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
          <h1 class="h6"> <span class="fa fa-file-signature"></span> Planes</h1>
        </div>
        <div class="opciones d-flex">
          <div class="btn-group btn-sm">
            <a href="<?php echo base_url('admin/planes/crear'); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nuevo Plan </a>
          </div>

        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-sm table-hover table-striped">
          <thead class="text-light bg<?php echo $primary; ?>">
            <tr>
              <th class="text-center">Nombre</th>
              <th class="text-center">Tipo</th>
              <th class="text-center">Mensualidad</th>
              <th class="text-center">Comisión</th>
              <th class="text-center">Nivel</th>
              <th class="text-right">Controles</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($planes as $plan){ ?>
            <tr>
              <td class="text-center"><?php echo $plan->PLAN_NOMBRE; ?></td>
              <td class="text-center"><?php echo $plan->PLAN_TIPO; ?></td>
              <td class="text-center">$<?php echo $plan->PLAN_MENSUALIDAD; ?></td>
              <td class="text-center"><?php echo $plan->PLAN_COMISION; ?>%</td>
              <td class="text-center"><?php echo $plan->PLAN_NIVEL; ?></td>
              <td class="text-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="<?php echo base_url('admin/planes/actualizar')."?id=".$plan->ID_PLAN; ?>" class="btn btn-sm btn-warning" title="Editar Plan"> <span class="fa fa-pencil-alt"></span> </a>

                  <button type="button" class="btn btn-danger btn-sm borrar_entrada" data-enlace="<?php echo base_url('admin/planes/borrar')."?id=".$plan->ID_PLAN; ?>" title="Eliminar Plan"><span class="fa fa-trash"></span></button>

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
