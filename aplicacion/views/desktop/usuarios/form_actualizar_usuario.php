<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h2 class="h5"> <span class="fa fa-id-card"></span> Perfil y datos personales</h2>
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
                <form class="" action="<?php echo base_url('usuario/actualizar'); ?>" method="post">
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
                    </div>
                    <div class="col">
                      <div class="border p-2">
                        <h4 class="h5">Datos Opcionales</h4>
                        <div class="form-group">
                          <label for="TelefonoUsuario">Teléfono</label>
                          <input type="text" class="form-control" id="TelefonoUsuario" name="TelefonoUsuario" placeholder="" value="<?php if(empty(form_error('TelefonoUsuario'))){ echo $usuario['USUARIO_TELEFONO']; } else { set_value('TelefonoUsuario'); } ?> ">
                          <small class="form-text text-muted">Ayúdanos a contactarte rápidamente proporcionando un número de teléfono fijo o celular</small>
                        </div>
                        <div class="form-group">
                          <label for="FechaNacimientoUsuario">Fecha Nacimiento</label>
                          <input type="date" class="form-control" id="FechaNacimientoUsuario" name="FechaNacimientoUsuario" placeholder="" value="<?php echo $usuario['USUARIO_FECHA_NACIMIENTO']; ?>">

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
        <div class="col-sm-3 col-md-2">
          <!--
          <div class="card border<?php echo $primary; ?> text-center mb-4">
            <div class="card-header bg<?php echo $primary; ?> text-white">
              <h4 class="h5"> <span class="fa fa-map-marker-alt"></span> Direcciones</h4>
            </div>
            <div class="card-body">
              <a href="<?php echo base_url('usuario/direcciones');?>" class="disabled">Ver mis direcciones registradas</a>
            </div>
          </div>
        -->
          <div class="card border-warning text-center  mb-4">
            <div class="card-header bg-warning text-white">
              <h4 class="h5"> <span class="fa fa-user-lock"></span> Mi Contraseña</h4>
            </div>
            <div class="card-body">
              <a href="<?php echo base_url('usuario/pass');?>">Cambiar mi contraseña</a>
            </div>
          </div>
          <div class="card border-danger text-center  mb-4">
            <div class="card-header bg-danger text-white">
              <h4 class="h5"> <span class="fa fa-trash"></span> Borrar mi cuenta</h4>
            </div>
            <div class="card-body">
              <!--<a href="<?php echo base_url('usuario/borrar');?>">Borrar tu cuenta</a>-->
              <button type="button" id="borrar_perfil" class="btn btn-link" data-enlace="<?php echo base_url('usuario/borrar');?>">Borrar tu cuenta</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
