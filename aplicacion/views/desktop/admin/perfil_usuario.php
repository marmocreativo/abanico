<div class="row">
  <div class="col">
      <?php retro_alimentacion(); ?>
  </div>
</div>
<div class="row">
  <div class="col-8">
        <div class="card">
          <div class="card-header">
            <h5> <i class="fa fa-user"></i> Datos Personales</h5>
          </div>
          <div class="card-body">
            <?php if(empty($usuario)){ ?>
              <div class="alert alert-warning">
                <h4> <i class="fa fa-exclamation-triangle"></i> No hay datos de usuario, es probable que el usuario haya borrado sus datos personales.</h4>
              </div>
            <?php } ?>
              <div class="row justify-content-center">
                <div class="col-3">
                    <img src="<?php echo base_url('assets/global/img/usuario_default.png'); ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                </div>
                <div class="col-9">
                  <table class="table table-striped">
                    <tr>
                      <td><b>Nombre</b><br></td>
                      <td><?php echo $usuario['USUARIO_NOMBRE'].' '.$usuario['USUARIO_APELLIDOS']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Correo</b></td>
                      <td><?php echo $usuario['USUARIO_CORREO']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Teléfono</b></td>
                      <td><?php echo $usuario['USUARIO_TELEFONO']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Fecha de Nacimiento</b></td>
                      <td><?php echo $usuario['USUARIO_FECHA_NACIMIENTO']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Lista de correo</b></td>
                      <td><?php echo $usuario['USUARIO_LISTA_DE_CORREO']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Registrado el: </b></td>
                      <td><?php echo $usuario['USUARIO_FECHA_REGISTRO']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Actualizado el: </b></td>
                      <td><?php echo $usuario['USUARIO_FECHA_ACTUALIZACION']; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
          </div>
          <?php if(!empty($usuario)){ ?>
          <div class="card-footer">
            <a href="<?php echo base_url('admin/usuarios/actualizar?id='.$usuario['ID_USUARIO']); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> Editar</a>
          </div>
          <?php } ?>
        </div>
  </div>
  <?php if(!empty($usuario)){ ?>
  <div class="col-4">
      <div class="card border-success text-center mb-4">
        <div class="card-header bg-success text-white">
          <h4 class="h5"> <span class="fa fa-shopping-bag"></span> Pedidos</h4>
        </div>
        <div class="card-body">
          <a href="<?php echo base_url('admin/pedidos?id_usuario='.$usuario['ID_USUARIO']);?>" class="disabled">Lista de pedidos</a>
        </div>
      </div>
    <div class="card border<?php echo $primary; ?> text-center mb-4">
      <div class="card-header bg<?php echo $primary; ?> text-white">
        <h4 class="h5"> <span class="fa fa-map-marker-alt"></span> Direcciones</h4>
      </div>
      <div class="card-body">
        <a href="<?php echo base_url('admin/direcciones?id_usuario='.$usuario['ID_USUARIO']);?>" class="disabled">Direcciones registradas</a>
      </div>
    </div>
    <div class="card border-warning text-center  mb-4">
      <div class="card-header bg-warning text-white">
        <h4 class="h5"> <span class="fa fa-user-lock"></span> Contraseña</h4>
      </div>
      <div class="card-body">
        <a href="<?php echo base_url('admin/usuarios/pass?id_usuario='.$usuario['ID_USUARIO']);?>">Cambiar contraseña</a>
      </div>
    </div>
    <div class="card border-danger text-center  mb-4">
      <div class="card-header bg-danger text-white">
        <h4 class="h5"> <span class="fa fa-trash"></span> Borrar cuenta</h4>
      </div>
      <div class="card-body">
        <button type="button" class="btn btn-link borrar_entrada" data-enlace="<?php echo base_url('admin/usuarios/borrar?id='.$usuario['ID_USUARIO']);?>">Borrar tu cuenta</button>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<div class="row">
    <div class="col-6">
      <?php if(!empty($perfil)){ ?>
        <div class="card">
          <div class="card-header">
            <h5> <i class="fa fa-user-tie"></i> Perfil de Servicios</h5>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-3">
                    <img src="<?php echo base_url('contenido/img/perfiles/completo/'.$perfil['PERFIL_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                </div>
                <div class="col-12">
                  <table class="table table-sm table-borderless">
                    <tr>
                      <td><b>Nombre Público</b></td>
                      <td><?php echo $perfil['PERFIL_NOMBRE']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Razón Social</b></td>
                      <td><?php echo $perfil['PERFIL_RAZON_SOCIAL']; ?></td>
                    </tr>
                    <tr>
                      <td><b>R.F.C.</b></td>
                      <td><?php echo $perfil['PERFIL_RFC']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Teléfono</b></td>
                      <td><?php echo $perfil['PERFIL_TELEFONO']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Registro</b><br><?php echo $perfil['PERFIL_FECHA_REGISTRO']; ?></td>
                      <td><b>Actualización</b><br><?php echo $perfil['PERFIL_FECHA_ACTUALIZACION']; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="row border-top pt-3">
                <div class="col">
                  <h6>Dirección</h6>
                  <p><?php echo $direccion_perfil; ?></p>
                </div>
              </div>
          </div>
          <div class="card-footer">
            <a href="<?php echo base_url('admin/perfiles_servicios/actualizar?id_usuario='.$usuario['ID_USUARIO'].'&id_perfil='.$perfil['ID_PERFIL']); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> Editar</a>
          </div>
        </div>
      <?php }else{ ?>
        <div class="card">
          <div class="card-header">
            <h5> <i class="fa fa-user-tie"></i> Perfil de Servicios</h5>
          </div>
          <div class="card-body">
                <h6>Para que un usuario pueda ofrecer servicios debe crear un Perfil de Servicios</h6>
                <hr>
                <?php if(!empty($usuario)){ ?>
                <a href="<?php echo base_url('admin/perfiles_servicios/crear?id_usuario='.$usuario['ID_USUARIO']); ?>" class="btn btn-outline-info btn-block">Crear un Perfil para <?php echo $usuario['USUARIO_NOMBRE'].' '.$usuario['USUARIO_APELLIDOS']; ?></a>
                <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="col-6">
      <?php if(!empty($tienda)){ ?>
        <div class="card">
          <div class="card-header">
            <h5> <i class="fa fa-store"></i> Tienda</h5>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-3">
                    <img src="<?php echo base_url('contenido/img/tiendas/completo/'.$tienda['TIENDA_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                </div>
                <div class="col-12">
                  <table class="table table-sm table-borderless">
                    <tr>
                      <td><b>Nombre Público</b></td>
                      <td><?php echo $tienda['TIENDA_NOMBRE']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Razón Social</b></td>
                      <td><?php echo $tienda['TIENDA_RAZON_SOCIAL']; ?></td>
                    </tr>
                    <tr>
                      <td><b>R.F.C.</b></td>
                      <td><?php echo $tienda['TIENDA_RFC']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Teléfono</b></td>
                      <td><?php echo $tienda['TIENDA_TELEFONO']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Registro</b><br><?php echo $tienda['TIENDA_FECHA_REGISTRO']; ?></td>
                      <td><b>Actualización</b><br><?php echo $tienda['TIENDA_FECHA_ACTUALIZACION']; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="row border-top pt-3">
                <div class="col">
                  <h6>Dirección Fiscal</h6>
                  <p><?php echo $direccion_tienda; ?></p>
                </div>
              </div>
          </div>
          <div class="card-footer">
            <a href="<?php echo base_url('admin/tiendas/actualizar?id_usuario='.$usuario['ID_USUARIO'].'&id_tienda='.$tienda['ID_TIENDA']); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> Editar</a>
          </div>
        </div>
        <div class="card border-warning text-center  mb-4">
          <div class="card-body">
            <a href="<?php echo base_url('admin/productos?id_usuario='.$usuario['ID_USUARIO']);?>">Ver Productos</a>
          </div>
        </div>
      <?php }else{ ?>
        <div class="card">
          <div class="card-header">
            <h5> <i class="fa fa-store"></i> Tienda</h5>
          </div>
          <div class="card-body">
                <h6>Para que un usuario pueda ofrecer productos debe crear una Tienda </h6>
                <hr>
                <?php if(!empty($usuario)){ ?>
                <a href="<?php echo base_url('admin/tiendas/crear?id_usuario='.$usuario['ID_USUARIO']); ?>" class="btn btn-outline-info btn-block">Crear un Tienda para <?php echo $usuario['USUARIO_NOMBRE'].' '.$usuario['USUARIO_APELLIDOS']; ?></a>
                <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
</div>
