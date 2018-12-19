<div class="contenido_principal">
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 fila fila-gris p-0">
      <?php $this->load->view('desktop/admin/widgets/menu_control_administrador'); ?>
    </div>
    <div class="col mt-3">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="titulo">
              <h1 class="h5"> <span class="fa fa-user"></span> Usuarios</h1>
            </div>
            <div class="formulario">
              <form class="form-inline" action="<?php echo base_url('admin/usuarios/busqueda');?>" method="get">
                <input type="hidden" name="tipo_usuario" value="<?php echo $tipo_usuario; ?>">
                <div class="form-group">
                  <label for="Busqueda" class="sr-only">Busqueda</label>
                  <input type="text" class="form-control" id="Busqueda" name="Busqueda" placeholder="Buscar">
                </div>
                <button type="submit" class="btn btn<?php echo $primary ?>"> <span class="fa fa-search"></span> </button>
              </form>
            </div>
            <div class="opciones d-flex">
              <div class="btn-group btn-sm">
                <a href="<?php echo base_url('admin/usuarios/crear?tipo_usuario='.$tipo_usuario); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nuevo Usuario </a>
                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="fa fa-cogs"></span>
                </button>
                <div class="dropdown-menu">
                  <!--
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a>
                -->
                </div>
              </div>

            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm table-hover table-striped">
              <thead class="text-light bg<?php echo $primary; ?>">
                <tr>
                  <th class="text-center">id</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Apellidos</th>
                  <th class="text-center">Correo</th>
                  <th class="text-center">Estado</th>
                  <th class="text-right">Controles</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($usuarios as $usuario){ ?>
                <tr>
                  <td class="text-center"><?php echo $usuario->ID_USUARIO; ?></td>
                  <td class="text-center"><?php echo $usuario->USUARIO_NOMBRE; ?></td>
                  <td class="text-center"><?php echo $usuario->USUARIO_APELLIDOS; ?></td>
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
                      <button type="button" class="btn <?php echo 'btn-'.$color; ?> dropdown-toggle" data-toggle="dropdown">
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
                      <a href="<?php echo base_url('admin/usuarios/perfil')."?id=".$usuario->ID_USUARIO; ?>" class="btn btn-sm btn-success"> <span class="fa fa-id-card"></span> Detalles</a>
                      <a href="<?php echo base_url('admin/usuarios/actualizar')."?id=".$usuario->ID_USUARIO; ?>" class="btn btn-sm btn-warning"> <span class="fa fa-pencil-alt"></span> </a>
                      <a href="<?php echo base_url('admin/usuarios/borrar')."?id=".$usuario->ID_USUARIO; ?>" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></a>
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
