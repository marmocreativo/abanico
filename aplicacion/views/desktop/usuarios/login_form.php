<div class="contenido_principal">
  <div class="fila fila-titulo">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <h1 class="h3"> <?php echo $this->lang->line('usuario_formulario_login_titulo'); ?></h1>
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
              <h4> <?php echo $this->lang->line('usuario_formulario_login_bienvenido'); ?></h4>
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
                     <label for="CorreoUsuario"> <?php echo $this->lang->line('usuario_formulario_login_correo'); ?></label>
                     <input type="email" class="form-control" id="CorreoUsuario" name="CorreoUsuario" placeholder="Tu correo electrónico">
                   </div>
                   <div class="form-group">
                     <label for="PassUsuario"> <?php echo $this->lang->line('usuario_formulario_login_pass'); ?></label>
                     <input type="password" class="form-control" id="PassUsuario" name="PassUsuario" placeholder="Contraseña">
                   </div>
                   <hr>
                   <button type="submit" class="btn btn-primary btn-block"> <?php echo $this->lang->line('usuario_formulario_boton_iniciar'); ?></button>
                 </form>
            </div>
            <div class="card-footer">
              <nav class="nav justify-content-center nav-fill">
                <a class="nav-link" href="<?php echo base_url('login/olvide');?>"> <span class="fa fa-question-circle"></span> <?php echo $this->lang->line('usuario_formulario_olvide_pass'); ?></a>
                <a class="nav-link" href="<?php echo base_url('usuario/registrar');?>"> <span class="fa fa-pen-square"></span> <?php echo $this->lang->line('usuario_formulario_registro'); ?></a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
