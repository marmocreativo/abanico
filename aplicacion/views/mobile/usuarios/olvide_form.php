<div class="contenido_principal">
  <div class="fila">
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="h5 text-center my-3"><?php echo $this->lang->line('usuario_formulario_login_titulo'); ?></h1>
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
              <h4 class="h5 pt-2 text-center"><?php echo $this->lang->line('usuario_formulario_olvide_titulo'); ?></h4>
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
                     <label for="CorreoUsuario"><?php echo $this->lang->line('usuario_formulario_olvide_instrucciones'); ?></label>
                     <input type="email" class="form-control form-control-sm" id="CorreoUsuario" name="CorreoUsuario" placeholder="Tu correo electrónico">
                   </div>
                   <hr>
                   <button type="submit" class="btn btn-sm btn-primary btn-block"><?php echo $this->lang->line('usuario_formulario_olvide_recuperar'); ?></button>
                 </form>
            </div>
            <div class="card-footer">
              <nav class="nav justify-content-center nav-fill">
                <a class="nav-link" href="<?php echo base_url('login');?>"> <span class="fa fa-pen-square"></span> <?php echo $this->lang->line('usuario_formulario_olvide_volver_iniciar_sesion'); ?></a>
                <a class="nav-link" href="<?php echo base_url('usuario/registrar');?>"> <span class="fa fa-pen-square"></span> <?php echo $this->lang->line('usuario_formulario_registro'); ?></a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
