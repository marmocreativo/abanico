<div class="contenido_principal">
  <div class="fila">
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="h5 text-center my-3">Inicio de sesión</h1>
        </div>
      </div>
    </div>
  </div>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-5">
          <div class="card">
            <div class="card-header">
              <h4 class="h5 pt-2 text-center">Restaura tu contraseña</h4>
            </div>
            <div class="card-body">
              <?php if(isset($_GET['mensaje'])){
                switch($_GET['mensaje']){
                  case 'error_login':
                    $alerta = 'alert-danger';
                    $mensaje = 'Tu contraseña o correo electrónico son incorrectos';
                  break;
                  case 'error_activo':
                    $alerta = 'alert-danger';
                    $mensaje = 'Lo sentimos tu cuenta se encuentra Inactiva, por favor comunícate con nosotros para restaurarla.';
                  break;
                  case 'sesion_cerrada':
                    $alerta = 'alert-success';
                    $mensaje = 'Sesión cerrada correctamente';
                  break;
                  case 'registro_correcto':
                    $alerta = 'alert-success';
                    $mensaje = 'Usuario Creado correctamente, por favor inicia sesión';
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
                <form class="" action="<?php echo base_url('login/restaurar?id='.$_GET['id'].'&clave='.$_GET['clave']);?>" method="post">
                   <div class="form-group">
                     <label for="PassUsuario">Nueva Contraseña</label>
                     <input type="password" class="form-control form-control-sm" id="PassUsuario" name="PassUsuario" placeholder="Contraseña">
                   </div>
                   <div class="form-group">
                     <label for="PassUsuario">Confirmar Nueva Contraseña</label>
                     <input type="password" class="form-control form-control-sm" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="Confirmar">
                   </div>
                   <hr>
                   <button type="submit" class="btn btn-sm btn-primary btn-block">Iniciar sesión</button>
                 </form>
            </div>
            <div class="card-footer">
              <nav class="nav justify-content-center nav-fill">
                <a class="nav-link" href="<?php echo base_url('login/olvide');?>"> <span class="fa fa-question-circle"></span> Olvidé mi contraseña</a>
                <a class="nav-link" href="<?php echo base_url('usuario/registrar');?>"> <span class="fa fa-pen-square"></span> Registrarme</a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
