<div class="contenido_principal">
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 fila fila-gris p-0">
      <?php $this->load->view('desktop/admin/widgets/menu_control_administrador'); ?>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-user"></span> Usuarios</h1>
          </div>
          <div class="formulario">
            <form class="form-inline" action="<?php echo base_url('admin/usuarios/busqueda');?>" method="get">
              <input type="hidden" name="tipo_usuario" value="<?php echo $_GET['tipo_usuario']; ?>">
              <div class="form-group">
                <label for="Busqueda" class="sr-only">Busqueda</label>
                <input type="text" class="form-control" id="Busqueda" name="Busqueda" placeholder="Buscar">
              </div>
              <button type="submit" class="btn btn<?php echo $primary ?>"> <span class="fa fa-search"></span> </button>
            </form>
          </div>
          <div class="opciones d-flex">
            <div class="btn-group btn-sm">
              <a href="<?php echo base_url('admin/usuarios/crear?tipo_usuario='.$_GET['tipo_usuario']); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nuevo Usuario </a>
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
                  <?php if($usuario->USUARIO_ESTADO=='activo'){ ?>
                    <a href="<?php echo base_url('admin/usuarios/activar')."?id=".$usuario->ID_USUARIO."&estado=".$usuario->USUARIO_ESTADO."&tipo_usuario=".$usuario->USUARIO_TIPO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                  <?php }else{ ?>
                    <a href="<?php echo base_url('admin/usuarios/activar')."?id=".$usuario->ID_USUARIO."&estado=".$usuario->USUARIO_ESTADO."&tipo_usuario=".$usuario->USUARIO_TIPO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                  <?php } ?>
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
