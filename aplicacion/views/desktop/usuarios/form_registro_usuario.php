<div class="contenido_principal">
  <div class="fila fila-titulo">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <h1 class="h3"><?php echo $this->lang->line('usuario_formulario_registro_titulo'); ?></h1>
        </div>
      </div>
    </div>
  </div>
  <div class="fila">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-8">
          <div class="card">
            <div class="card-header">
              <h4><?php echo $this->lang->line('usuario_formulario_registro_instrucciones'); ?></h4>
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
                    <div class="col">
                       <div class="form-group">
                         <label for="NombreUsuario"><?php echo $this->lang->line('usuario_formulario_registro_nombre'); ?></label>
                         <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" value="<?=!form_error('NombreUsuario')?set_value('NombreUsuario'):''?>">
                       </div>
                    </div>
                    <div class="col">
                       <div class="form-group">
                         <label for="ApellidosUsuario"><?php echo $this->lang->line('usuario_formulario_registro_apellidos'); ?></label>
                         <input type="text" class="form-control" id="ApellidosUsuario" name="ApellidosUsuario" placeholder="" value="<?=!form_error('ApellidosUsuario')?set_value('ApellidosUsuario'):''?>">
                       </div>
                    </div>
                  </div>
                   <div class="form-group">
                     <label for="CorreoUsuario"><?php echo $this->lang->line('usuario_formulario_registro_correo'); ?></label>
                     <input type="email" class="form-control" id="CorreoUsuario" name="CorreoUsuario" placeholder="" value="<?=!form_error('CorreoUsuario')?set_value('CorreoUsuario'):''?>">
                   </div>
                   <div class="row">
                     <div class="col">
                       <div class="form-group">
                         <label for="PassUsuario"><?php echo $this->lang->line('usuario_formulario_registro_pass'); ?></label>
                         <input type="password" class="form-control" id="PassUsuario" name="PassUsuario" placeholder="">
                       </div>
                     </div>
                     <div class="col">
                       <div class="form-group">
                         <label for="PassUsuario"><?php echo $this->lang->line('usuario_formulario_registro_pass_confirmar'); ?></label>
                         <input type="password" class="form-control" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="">
                       </div>
                     </div>
                   </div>
                   <div class="form-check">
                     <input type="checkbox" class="form-check-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                     <label class="form-check-label" for="TerminosyCondiciones"><?php echo $this->lang->line('usuario_formulario_registro_terminos_y_condiciones'); ?></label>
                   </div>
                   <hr>
                   <button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('usuario_formulario_registro_registrarme'); ?></button>
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
