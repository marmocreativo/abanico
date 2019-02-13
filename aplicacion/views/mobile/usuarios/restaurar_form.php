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
        <div class="col-12 col-sm-5">
          <div class="card">
            <div class="card-header">
              <h4 class="h5 pt-2 text-center"><?php echo $this->lang->line('usuario_formulario_restaurar_pass_instrucciones'); ?></h4>
            </div>
            <div class="card-body">
              <?php retro_alimentacion(); ?>
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
                <hr>
              <?php } ?>
                <form class="" action="<?php echo base_url('login/restaurar?id='.$_GET['id'].'&clave='.$_GET['clave']);?>" method="post">
                   <div class="form-group">
                     <label for="PassUsuario"><?php echo $this->lang->line('usuario_formulario_registro_nuevo_pass'); ?></label>
                     <input type="password" class="form-control form-control-sm" id="PassUsuario" name="PassUsuario" placeholder="Contraseña">
                   </div>
                   <div class="form-group">
                     <label for="PassUsuario"><?php echo $this->lang->line('usuario_formulario_registro_nuevo_pass_confirmar'); ?></label>
                     <input type="password" class="form-control form-control-sm" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="Confirmar">
                   </div>
                   <hr>
                   <button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('usuario_formulario_registro_restaurar'); ?></button>
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
