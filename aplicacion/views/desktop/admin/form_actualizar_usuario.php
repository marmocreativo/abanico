<div class="container">
  <div class="row">
    <div class="col mt-4">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-users"></span> Actualizar <?php echo $usuario['USUARIO_NOMBRE']; ?></h1>
          </div>
        </div>

        <div class="card-body">

          <?php if(isset($_GET['mensaje'])){
            switch($_GET['mensaje']){
              case 'actualizacion_correcta':
                $alerta = 'alert-success';
                $mensaje = 'Tu información se actualizó correctamente';
              break;
            }
            ?>

            <div class="alert <?php echo  $alerta; ?>">
              <p><?php echo  $mensaje; ?></p>
            </div>
          <?php }// Termina la condicionante ?>
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
            <form class="" action="<?php echo base_url('admin/usuarios/actualizar'); ?>" method="post">
                <input type="hidden" name="Identificador" value="<?php echo $usuario['ID_USUARIO']; ?>">
                <input type="hidden" name="TipoUsuario" value="<?php echo $usuario['USUARIO_TIPO']; ?>">
              <div class="row">
                <div class="col">
                  <h3 class="h5">Datos Requeridos</h3>
                   <div class="form-group">
                     <label for="NombreUsuario">Nombre</label>
                     <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" value="<?php if(empty(form_error('NombreUsuario'))){ echo $usuario['USUARIO_NOMBRE']; } else { set_value('NombreUsuario'); } ?>">
                   </div>
                   <div class="form-group">
                     <label for="ApellidosUsuario">Apellidos</label>
                     <input type="text" class="form-control" id="ApellidosUsuario" name="ApellidosUsuario" placeholder="" value="<?php if(empty(form_error('ApellidosUsuario'))){ echo $usuario['USUARIO_APELLIDOS']; } else { set_value('ApellidosUsuario'); } ?>">
                   </div>
                   <div class="form-group">
                     <label for="CorreoUsuario">Correo Electrónico</label>
                     <input type="email" class="form-control" id="CorreoUsuario" name="CorreoUsuario" placeholder="" value="<?php if(empty(form_error('CorreoUsuario'))){ echo $usuario['USUARIO_CORREO']; } else { set_value('CorreoUsuario'); } ?>">
                     <small class="form-text text-muted">Este correo es el que usarás para iniciar sesión. y nuestro medio principal para contactarte</small>
                   </div>
                   <div class="form-group">
                     <label for="PassUsuario">Contraseña</label>
                     <input type="password" class="form-control" id="PassUsuario" name="PassUsuario" placeholder="">
                     <small class="form-text text-info">Si no deseas actualizar la contraseña deja este campo vacío</small>
                   </div>
                   <div class="form-group">
                     <label for="PassUsuario">Confirmar Contraseña</label>
                     <input type="password" class="form-control" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="">
                     <small class="form-text text-info">Si no deseas actualizar la contraseña deja este campo vacío</small>
                   </div>
                </div>
                <div class="col">
                  <div class="border p-2 mb-4">
                    <h4 class="h5">Estado del Usuario</h4>
                    <div class="form-group">
                      <label for="EstadoUsuario">Estado Usuario</label>
                      <select class="form-control" id="EstadoUsuario" name="EstadoUsuario" placeholder="">
                        <option value="activo" <?php if($usuario['USUARIO_ESTADO']=='activo'){ echo 'selected'; } ?> >Activo</option>
                        <option value="pendiente" <?php if($usuario['USUARIO_ESTADO']=='pendiente'){ echo 'selected'; } ?> >Pendiente de verificación</option>
                        <option value="inactivo" <?php if($usuario['USUARIO_ESTADO']=='inactivo'){ echo 'selected'; } ?> >Inactivo</option>
                      </select>
                    </div>
                  </div>
                  <div class="border p-2">
                    <h4 class="h5">Datos Opcionales</h4>
                    <div class="form-group">
                      <label for="TelefonoUsuario">Teléfono</label>
                      <input type="text" class="form-control" id="TelefonoUsuario" name="TelefonoUsuario" placeholder="" value="<?php if(empty(form_error('TelefonoUsuario'))){ echo $usuario['USUARIO_TELEFONO']; } else { set_value('TelefonoUsuario'); } ?>">
                    </div>
                    <div class="form-group">
                      <label for="FechaNacimientoUsuario">Fecha Nacimiento</label>
                      <input type="date" class="form-control" id="FechaNacimientoUsuario" name="FechaNacimientoUsuario" placeholder="" value="<?php if(empty(form_error('FechaNacimientoUsuario'))){ echo $usuario['USUARIO_FECHA_NACIMIENTO']; } else { set_value('FechaNacimientoUsuario'); } ?>">

                    </div>
                  </div>
                </div>
              </div>
            <hr>
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
