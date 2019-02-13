<div class="contenido_principal">
  <div class="container">
    <div class="row">
      <div class="col-12 my-3 mt-4">
        <h5 class="text-center"><?php echo $this->lang->line('usuario_formulario_registro_titulo'); ?></h1>
      </div>
    </div>
  </div>

  <div class="formMobile">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header">
              <h1 class="h5 pt-2 text-center"><?php echo $this->lang->line('usuario_formulario_registro_instrucciones'); ?></h4>
            </div>
            <div class="card-body">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
                <hr>
              <?php } ?>

                <form class="" action="<?php echo base_url('usuario/registrar');?>" method="post">
                  <div class="row">
                    <div class="col-12">

                       <div class="form-group">
                         <label for="NombreUsuario"><?php echo $this->lang->line('usuario_formulario_registro_nombre'); ?></label>
                         <input type="text" class="form-control form-control-sm" id="NombreUsuario" name="NombreUsuario" placeholder="" value="<?=!form_error('NombreUsuario')?set_value('NombreUsuario'):''?>">
                       </div>
                       <div class="form-group">
                         <label for="ApellidosUsuario"><?php echo $this->lang->line('usuario_formulario_registro_apellidos'); ?></label>
                         <input type="text" class="form-control form-control-sm" id="ApellidosUsuario" name="ApellidosUsuario" placeholder="" value="<?=!form_error('ApellidosUsuario')?set_value('ApellidosUsuario'):''?>">
                       </div>
                       <div class="form-group">
                         <label for="CorreoUsuario"><?php echo $this->lang->line('usuario_formulario_registro_correo'); ?></label>
                         <input type="email" class="form-control form-control-sm" id="CorreoUsuario" name="CorreoUsuario" placeholder="" value="<?=!form_error('CorreoUsuario')?set_value('CorreoUsuario'):''?>">
                       </div>
                       <div class="form-group">
                         <label for="PassUsuario"><?php echo $this->lang->line('usuario_formulario_registro_pass'); ?></label>
                         <input type="password" class="form-control form-control-sm" id="PassUsuario" name="PassUsuario" placeholder="">
                       </div>
                       <div class="form-group">
                         <label for="PassUsuario"><?php echo $this->lang->line('usuario_formulario_registro_pass_confirmar'); ?></label>
                         <input type="password" class="form-control form-control-sm" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="">
                       </div>

                       <div class="form-check">
                         <input type="checkbox" class="form-check-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                         <label class="form-check-label" for="TerminosyCondiciones"><?php echo $this->lang->line('usuario_formulario_registro_terminos_y_condiciones'); ?></label>
                       </div>
                       <hr>
                       <button type="submit" class="btn btn-primary btn-sm btn-block">Registrarme</button>

                    </div>
                  </div>
                 </form>
            </div>
            <div class="card-footer">
              <nav class="nav justify-content-center nav-fill">
                <a class="nav-link" href="<?php echo base_url('login');?>"> <span class="fa fa-pen-square"></span> <?php echo $this->lang->line('usuario_formulario_registro_iniciar_sesion'); ?></a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
