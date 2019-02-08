<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 my-2 mt-4">
        <h1 class="h5 text-center">Inicio de sesión</h1>
      </div>
    </div>
  </div>

  <div class="fila">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-5">
          <div class="card">
            <div class="card-header">
              <h4 class="h5 pt-2 text-center">Bienvenido</h4>
            </div>
            <div class="card-body">
              <?php retro_alimentacion(); ?>
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
                <hr>
              <?php } ?>
                <form class="" action="<?php echo base_url('login/iniciar');?>" method="post">
                  <?php if(isset($_GET['url_redirect'])&&!empty($_GET['url_redirect'])){ ?>
                    <input type="hidden" name="UrlRedirect" value="<?php echo $_GET['url_redirect'] ?>">
                  <?php } ?>
                   <div class="form-group">
                     <label for="CorreoUsuario">Correo</label>
                     <input type="email" class="form-control form-control-sm" id="CorreoUsuario" name="CorreoUsuario" placeholder="Tu correo electrónico">
                   </div>
                   <div class="form-group">
                     <label for="PassUsuario">Contraseña</label>
                     <input type="password" class="form-control form-control-sm" id="PassUsuario" name="PassUsuario" placeholder="Contraseña">
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
