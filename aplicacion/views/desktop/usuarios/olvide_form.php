<div class="contenido_principal">
  <div class="fila fila-titulo">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <h1 class="h3">Inicio de sesión</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="fila">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-5">
          <div class="card">
            <div class="card-header">
              <h4>¿Olvidaste tu contraseña?</h4>
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
                     <label for="CorreoUsuario">Escribe el correo con el que te registraste.</label>
                     <input type="email" class="form-control" id="CorreoUsuario" name="CorreoUsuario" placeholder="Tu correo electrónico">
                   </div>
                   <hr>
                   <button type="submit" class="btn btn-primary btn-block">Recuperar Contraseña</button>
                 </form>
            </div>
            <div class="card-footer">
              <nav class="nav justify-content-center nav-fill">
                <a class="nav-link" href="<?php echo base_url('login');?>"> <span class="fa fa-pen-square"></span> Volver a iniciar sesión</a>
                <a class="nav-link" href="<?php echo base_url('usuario/registrar');?>"> <span class="fa fa-pen-square"></span> Registrarme</a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
