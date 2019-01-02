
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
                <th class="text-center">Razón Social</th>
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
                    <a href="<?php echo base_url('admin/usuarios/activar')."?id=".$tienda->ID_TIENDA."&estado=".$tienda->TIENDA_ESTADO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                  <?php }else{ ?>
                    <a href="<?php echo base_url('admin/usuarios/activar')."?id=".$tienda->ID_TIENDA."&estado=".$tienda->TIENDA_ESTADO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('admin/usuarios/perfil')."?id=".$tienda->ID_USUARIO; ?>" class="btn btn-sm btn-success" title="Usuario Propietario de la tienda"> <span class="fa fa-id-card"></span> Usuario</a>
                    <a href="<?php echo base_url('admin/productos')."?id_usuario=".$tienda->ID_USUARIO; ?>" class="btn btn-sm btn-info" title="Productos asociados a la tienda"> <span class="fa fa-box"></span> Productos</a>
                    <a href="<?php echo base_url('admin/usuarios/actualizar')."?id=".$tienda->ID_TIENDA; ?>" class="btn btn-sm btn-warning" title="Editar Tienda"> <span class="fa fa-pencil-alt"></span> </a>
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
