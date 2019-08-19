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
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h6"> <span class="fa fa-user-tie"></span> Perfiles de Servicio</h1>
          </div>
          <div class="formulario">
            <form class="form-inline" action="<?php echo base_url('admin/tiendas/busqueda');?>" method="get">
              <div class="form-group">
                <label for="Busqueda" class="sr-only">Busqueda</label>
                <input type="text" class="form-control form-control-sm" id="Busqueda" name="Busqueda" placeholder="Buscar">
              </div>
              <button type="submit" class="btn btn<?php echo $primary ?> btn-sm"> <span class="fa fa-search"></span> </button>
            </form>
          </div>
          <div class="opciones d-flex">
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-hover table-striped">
            <thead class="text-light bg<?php echo $primary; ?>">
              <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Razón social</th>
                <th class="text-center">R.F.C.</th>
                <th class="text-center">Estado</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($perfiles as $perfil){ ?>
              <tr>
                <td class="text-center"><?php echo $perfil->PERFIL_NOMBRE; ?></td>
                <td class="text-center"><?php echo $perfil->PERFIL_RAZON_SOCIAL; ?></td>
                <td class="text-center"><?php echo $perfil->PERFIL_RFC; ?></td>
                <td class="text-center">
                  <?php if($perfil->PERFIL_ESTADO=='activo'){ ?>
                    <a href="<?php echo base_url('admin/perfiles_servicios/activar')."?id=".$perfil->ID_PERFIL."&estado=".$perfil->PERFIL_ESTADO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                  <?php }if($perfil->PERFIL_ESTADO=='inactivo'){ ?>
                    <a href="<?php echo base_url('admin/perfiles_servicios/activar')."?id=".$perfil->ID_PERFIL."&estado=".$perfil->PERFIL_ESTADO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                  <?php }if($perfil->PERFIL_ESTADO=='pendiente'){ ?>
                    <button type="button" class="btn btn-warning" name="button">Pendiente</button>
                  <?php } ?>
                  <?php $paquete = $this->PlanesModel->plan_activo_usuario($perfil->ID_USUARIO,'servicios'); ?>
                  <?php if($paquete==null){ ?>
                  <span class="badge badge-danger">Plan inactivo</span>
                  <?php }else{ ?>
                      <span class="badge badge-success">Plan activo</span>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('admin/usuarios/perfil')."?id_usuario=".$perfil->ID_USUARIO; ?>" class="btn btn-sm btn-success"> <span class="fa fa-id-card"></span> Usuario</a>
                    <a href="<?php echo base_url('admin/servicios')."?id_usuario=".$perfil->ID_USUARIO; ?>" class="btn btn-sm btn-info"> <span class="fa fa-tools"></span> Servicios</a>
                    <a href="<?php echo base_url('admin/perfiles_servicios/actualizar')."?id_usuario=".$perfil->ID_USUARIO."&id_perfil=".$perfil->ID_PERFIL; ?>" class="btn btn-sm btn-warning"> <span class="fa fa-pencil-alt"></span> </a>
                    <button data-enlace='<?php echo base_url('admin/perfiles_servicios/borrar')."?id=".$perfil->ID_PERFIL; ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Perfil de Servicios"> <span class="fa fa-trash"></span> </button>
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
