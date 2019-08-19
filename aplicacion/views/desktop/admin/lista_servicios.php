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
<?php if(isset($_GET['id_usuario'])){ ?>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-four">
              <div class="stat-icon dib">
                  <i class="fa fa-user-tag text-muted"></i>
              </div>
              <div class="stat-content">
                  <div class="text-left dib">
                      <div class="stat-heading">Usuario</div>
                      <div class="stat-text"><?php echo $usuario['USUARIO_NOMBRE'].' '.$usuario['USUARIO_APELLIDOS']; ?></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-four">
              <div class="stat-icon dib">
                  <i class="fa fa-user-tie text-muted"></i>
              </div>
              <div class="stat-content">
                  <div class="text-left dib">
                      <div class="stat-heading">Perfil</div>
                      <div class="stat-text"><?php echo $perfil['PERFIL_NOMBRE']; ?></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h6"> <span class="fa fa-user-tie"></span> Servicios</h1>
          </div>
          <div class="formulario">
            <form class="form-inline" action="<?php echo base_url('admin/servicios/busqueda');?>" method="get">
              <?php if(isset($_GET['id_usuario'])){ ?>
                <input type="hidden" name="id_usuario" value="<?php echo $_GET['id_usuario']; ?>">
              <?php } ?>
              <div class="form-group">
                <label for="Busqueda" class="sr-only">Busqueda</label>
                <input type="text" class="form-control form-control-sm" id="Busqueda" name="Busqueda" placeholder="Buscar">
              </div>
              <button type="submit" class="btn btn-sm btn<?php echo $primary ?>"> <span class="fa fa-search"></span> </button>
            </form>
          </div>
          <div class="opciones d-flex">
            <div class="btn-group btn-sm">
              <?php if(isset($_GET['id_usuario'])){ ?>
              <a href="<?php echo base_url('admin/servicios/crear?id_usuario='.$_GET['id_usuario']); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nuevo Servicio </a>
              <?php } ?>
            </div>

          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-hover table-striped">
            <thead class="text-light bg<?php echo $primary; ?>">
              <tr>
                <th class="text-left">Nombre</th>
                <th class="text-left">Servicio</th>
                <th class="text-center">Estado</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($servicios as $servicio){ ?>
              <tr>
                <td class="text-left"><?php echo $servicio->USUARIO_NOMBRE; ?></td>
                <td class="text-left"><?php echo $servicio->SERVICIO_NOMBRE; ?></td>
                <td class="text-center">
                  <?php if($servicio->SERVICIO_ESTADO=='activo'){ ?>
                    <a href="<?php echo base_url('admin/servicios/activar')."?id=".$servicio->ID_SERVICIO."&estado=".$servicio->SERVICIO_ESTADO."&id_usuario=".$servicio->ID_USUARIO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                  <?php }else{ ?>
                    <a href="<?php echo base_url('admin/servicios/activar')."?id=".$servicio->ID_SERVICIO."&estado=".$servicio->SERVICIO_ESTADO."&id_usuario=".$servicio->ID_USUARIO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                  <?php } ?>
                  <?php $paquete = $this->PlanesModel->plan_activo_usuario($servicio->ID_USUARIO,'servicios'); ?>
                  <?php if($paquete==null){ ?>
                  <span class="badge badge-danger">Plan inactivo</span>
                  <?php }else{ ?>
                      <span class="badge badge-success">Plan activo</span>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('admin/servicios/actualizar'."?id=".$servicio->ID_SERVICIO); ?>" class="btn btn-sm btn-warning" title="Editar Servicio"> <span class="fa fa-pencil-alt"></span> </a>
                    <button data-enlace='<?php echo base_url('admin/servicios/borrar')."?id=".$servicio->ID_SERVICIO."&id_usuario=".$servicio->ID_USUARIO; ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Servicio"> <span class="fa fa-trash"></span> </button>
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
