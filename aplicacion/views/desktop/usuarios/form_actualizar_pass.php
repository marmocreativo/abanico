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
                  case 'pass_incorrecto':
                    $alerta = 'alert-danger';
                    $mensaje = 'Has escrito mal la contraseña Actual, por favor verifícala.';
                  break;
                  case 'pass_actualizado':
                    $alerta = 'alert-success';
                    $mensaje = 'Tu contraseña se ha actualizado con éxito';
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
              <form class="" action="<?php echo base_url('usuario/pass');?>" method="post">
                <div class="form-group">
                  <label for="PassActualUsuario">Contraseña Actual</label>
                  <input type="password" class="form-control" id="PassActualUsuario" name="PassActualUsuario" placeholder="Contraseña Actual">
                </div>
                 <div class="form-group">
                   <label for="PassUsuario">Nueva Contraseña</label>
                   <input type="password" class="form-control" id="PassUsuario" name="PassUsuario" placeholder="Nueva Contraseña">
                 </div>
                 <div class="form-group">
                   <label for="PassUsuario">Confirmar Nueva Contraseña</label>
                   <input type="password" class="form-control" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="Confirmar Contraseña">
                 </div>
                 <hr>
                 <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Cambiar Contraseña</button>
               </form>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-md-2">
          <div class="card border<?php echo $primary; ?> text-center mb-4">
            <div class="card-header bg<?php echo $primary; ?> text-white">
              <h4 class="h5"> <span class="fa fa-map-marker-alt"></span> Direcciones</h4>
            </div>
            <div class="card-body">
              <a href="usuario/direcciones">Ver mis direcciones registradas</a>
            </div>
          </div>
          <div class="card border-warning text-center  mb-4">
            <div class="card-header bg-warning text-white">
              <h4 class="h5"> <span class="fa fa-user-lock"></span> Mi Contraseña</h4>
            </div>
            <div class="card-body">
              <a href="usuario/pass">Cambiar mi contraseña</a>
            </div>
          </div>
          <div class="card border-danger text-center  mb-4">
            <div class="card-header bg-danger text-white">
              <h4 class="h5"> <span class="fa fa-trash"></span> Borrar mi cuenta</h4>
            </div>
            <div class="card-body">
              <a href="usuario/borrar">Borrar tu cuenta</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
