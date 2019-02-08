
  <div class="row">
    <div class="col">
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
                </td>
                <td class="text-right">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('admin/usuarios/perfil')."?id_usuario=".$perfil->ID_USUARIO; ?>" class="btn btn-sm btn-success"> <span class="fa fa-id-card"></span> Usuario</a>
                    <a href="<?php echo base_url('admin/servicios')."?id_usuario=".$perfil->ID_USUARIO; ?>" class="btn btn-sm btn-info"> <span class="fa fa-tools"></span> Servicios</a>
                    <a href="<?php echo base_url('admin/perfiles_servicios/actualizar')."?id_usuario=".$perfil->ID_USUARIO."&id_perfil=".$perfil->ID_PERFIL; ?>" class="btn btn-sm btn-warning"> <span class="fa fa-pencil-alt"></span> </a>
                    <a href="<?php echo base_url('admin/pperfiles_usuarios/borrar')."?id=".$perfil->ID_PERFIL; ?>" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></a>
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
