  <div class="row">
    <div class="col">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="titulo d-flex align-items-center">
              <h1 class="h6"> <span class="fa fa-user"></span> Usuarios</h1>
            </div>
            <div class="formulario d-flex align-items-center">
              <form class="form-inline" action="<?php echo base_url('admin/usuarios/busqueda');?>" method="get">
                <input type="hidden" name="tipo_usuario" value="<?php echo $tipo_usuario; ?>">
                <div class="form-group">
                  <label for="Busqueda" class="sr-only">Busqueda</label>
                  <input type="text" class="form-control form-control-sm" id="Busqueda" name="Busqueda" placeholder="Buscar">
                </div>
                <button type="submit" class="btn btn<?php echo $primary ?> btn-sm"> <span class="fa fa-search"></span> </button>
              </form>
            </div>
            <div class="opciones d-flex align-items-center">
              <div class="btn-group btn-sm">
                <a href="<?php echo base_url('admin/usuarios/crear?tipo_usuario='.$tipo_usuario); ?>" class="btn btn-success btn-sm"> <span class="fa fa-plus"></span> Nuevo Usuario </a>
              </div>

            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover table-striped">
              <thead class="text-light bg<?php echo $primary; ?>">
                <tr>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Correo</th>
                  <th class="text-center">Estado</th>
                  <th class="text-right">Controles</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($usuarios as $usuario){ ?>
                <tr>
                  <td class="text-center"><?php echo $usuario->USUARIO_NOMBRE.' '.$usuario->USUARIO_APELLIDOS; ?></td>
                  <td class="text-center"><?php echo $usuario->USUARIO_CORREO; ?></td>
                  <td class="text-center">
                      <?php
                        switch($usuario->USUARIO_ESTADO){
                          case 'activo':
                            $estado_actual = 'Activo';
                            $color = 'success';
                            $icono = 'fa-check-circle';
                          break;
                          case 'inactivo':
                          $estado_actual = 'Inactivo';
                            $color = 'danger';
                            $icono = 'fa-times-circle';
                          break;
                          case 'pendiente':
                          $estado_actual = 'Pendiente';
                            $color = 'warning';
                            $icono = 'fa-exclamation-circle';
                          break;
                        }
                      ?>
                    <div class="dropdown">
                      <button type="button" class="btn <?php echo 'btn-'.$color; ?> btn-sm dropdown-toggle" data-toggle="dropdown">
                        <?php echo $estado_actual; ?>
                      </button>
                      <div class="dropdown-menu">
                        <a href="<?php echo base_url('admin/usuarios/estado?id='.$usuario->ID_USUARIO.'&estado=activo&tipo_usuario='.$usuario->USUARIO_TIPO); ?>" class="dropdown-item text-<?php echo $color; ?>"> <span class="fa <?php echo $icono; ?>"></span> Cambiar estado a Activo</a>
                        <a href="<?php echo base_url('admin/usuarios/estado?id='.$usuario->ID_USUARIO.'&estado=pendiente&tipo_usuario='.$usuario->USUARIO_TIPO); ?>" class="dropdown-item text-<?php echo $color; ?>"> <span class="fa <?php echo $icono; ?>"></span> Cambiar estado a Pendiente</a>
                        <a href="<?php echo base_url('admin/usuarios/estado?id='.$usuario->ID_USUARIO.'&estado=inactivo&tipo_usuario='.$usuario->USUARIO_TIPO); ?>" class="dropdown-item text-<?php echo $color; ?>"> <span class="fa <?php echo $icono; ?>"></span> Cambiar estado a Inactivo</a>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="<?php echo base_url('admin/usuarios/perfil')."?id_usuario=".$usuario->ID_USUARIO; ?>" class="btn btn-sm btn-success" title="Ver todos los datos del Usuario"> <span class="fa fa-id-card"></span> Detalles</a>
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
