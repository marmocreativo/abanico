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
            <h1 class="h5"> <span class="fa fa-store"></span> Tiendas</h1>
          </div>
          <div class="formulario">
            <form class="form-inline" action="<?php echo base_url('admin/tiendas/busqueda');?>" method="get">
              <div class="form-group">
                <label for="Busqueda" class="sr-only">Busqueda</label>
                <input type="text" class="form-control" id="Busqueda" name="Busqueda" placeholder="Buscar">
              </div>
              <button type="submit" class="btn btn<?php echo $primary ?>"> <span class="fa fa-search"></span> </button>
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
              <?php foreach($tiendas as $tienda){ ?>
              <tr>
                <td class="text-center"><?php echo $tienda->TIENDA_NOMBRE; ?></td>
                <td class="text-center"><?php echo $tienda->TIENDA_RAZON_SOCIAL; ?></td>
                <td class="text-center"><?php echo $tienda->TIENDA_RFC; ?></td>
                <td class="text-center">
                  <?php if($tienda->TIENDA_ESTADO=='activo'){ ?>
                    <a href="<?php echo base_url('admin/tiendas/activar')."?id=".$tienda->ID_TIENDA."&estado=".$tienda->TIENDA_ESTADO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                  <?php }else{ ?>
                    <a href="<?php echo base_url('admin/tiendas/activar')."?id=".$tienda->ID_TIENDA."&estado=".$tienda->TIENDA_ESTADO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('admin/usuarios/perfil')."?id_usuario=".$tienda->ID_USUARIO; ?>" class="btn btn-sm btn-success" title="Usuario Propietario de la tienda"> <span class="fa fa-id-card"></span> Usuario</a>
                    <a href="<?php echo base_url('admin/productos')."?id_usuario=".$tienda->ID_USUARIO; ?>" class="btn btn-sm btn-info" title="Productos asociados a la tienda"> <span class="fa fa-box"></span> Productos</a>
                    <a href="<?php echo base_url('admin/tiendas/actualizar')."?id_tienda=".$tienda->ID_TIENDA; ?>" class="btn btn-sm btn-warning" title="Editar Tienda"> <span class="fa fa-pencil-alt"></span> </a>
                    <button data-enlace='<?php echo base_url('admin/tiendas/borrar')."?id=".$tienda->ID_TIENDA; ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Tienda"> <span class="fa fa-trash"></span> </button>
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
