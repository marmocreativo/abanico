<div class="contenido_principal">
  <div class="fila">
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="h5 text-center my-3">Inicio de Sesión</h1>
        </div>
      </div>
    </div>
  </div>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="h5 pt-2 text-center">¿Olvidaste tu contraseña?</h4>
            </div>
            <div class="card-body">
              <?php retro_alimentacion();?>
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
                <hr>
              <?php } ?>
                <form class="" action="<?php echo base_url('login/olvide');?>" method="post">
                   <div class="form-group">
                     <label for="CorreoUsuario">Escribe el Correo con el que te registraste</label>
                     <input type="email" class="form-control form-control-sm" id="CorreoUsuario" name="CorreoUsuario" placeholder="Su correo electrónico">
                   </div>
                   <hr>
                   <button type="submit" class="btn btn-sm btn-primary btn-block">Recuperar Contraseña</button>
                 </form>
            </div>
            <div class="card-footer">
              <nav class="nav justify-content-center nav-fill">
                <a class="nav-link" href="<?php echo base_url('login');?>"> <span class="fa fa-pen-square"></span> Volver a Iniciar Sesión</a>
                <a class="nav-link" href="<?php echo base_url('usuario/registrar');?>"> <span class="fa fa-pen-square"></span> Registrarme</a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
