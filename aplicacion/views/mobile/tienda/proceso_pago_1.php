<!-- empieza proceso pago 1 -->

<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card mb-3">
          <div class="card-body pb-0">
            <div class="stepwizard">

              <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" class="btn btn-primary btn-circle">1</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-default btn-circle" disabled="disabled">2</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-default btn-circle" disabled="disabled">3</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                </div>
              </div>

            </div>
          </div>

          <div class="card-body pl-0 pr-0 pb-0">

            <ul class="nav nav-tabs justify-content-center mb-4" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo $this->lang->line('usuario_formulario_login_titulo'); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?php echo $this->lang->line('proceso_pago_1_registro_rapido'); ?></a>
              </li>
            </ul>

            <div class="tab-content">

              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card-body text-center">
                  <h6 class="mb-3"> <i class="fa fa-sign-in-alt"></i> <?php echo $this->lang->line('usuario_formulario_login_titulo'); ?></h6>
                  <form class="" action="<?php echo base_url('login/iniciar');?>" method="post">
                    <input type="hidden" name="UrlRedirect" value="<?php echo base_url('proceso_pago_1'); ?>">
                     <div class="form-group">
                       <label for="CorreoUsuario"><?php echo $this->lang->line('usuario_formulario_login_correo'); ?></label>
                       <input type="email" class="form-control" id="CorreoUsuario" name="CorreoUsuario" placeholder="Tu correo electrónico">
                     </div>
                     <div class="form-group">
                       <label for="PassUsuario"><?php echo $this->lang->line('usuario_formulario_login_pass'); ?></label>
                       <input type="password" class="form-control" id="PassUsuario" name="PassUsuario" placeholder="Contraseña">
                     </div>
                     <hr>
                     <button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('usuario_formulario_boton_iniciar'); ?></button>
                   </form>
                   <!-- <hr> -->

                </div>
                <div class="card-footer">
                  <nav class="nav justify-content-center nav-fill">
                    <a class="nav-link" href="<?php echo base_url('login/olvide');?>"> <span class="fa fa-question-circle"></span> <?php echo $this->lang->line('usuario_formulario_olvide_pass'); ?></a>
                  </nav>
                </div>
              </div>

              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card-body text-center">
                  <h6 class="mb-3"> <i class="fa fa-user"></i> <?php echo $this->lang->line('proceso_pago_1_registro_rapido'); ?></h6>
                  <?php if(!empty(validation_errors())){ ?>
                    <div class="alert alert-danger">
                      <?php echo validation_errors(); ?>
                    </div>
                    <hr>
                    <form class="" action="<?php echo base_url('invitado_pago_2');?>" method="post">
                       <div class="form-group">
                         <label for="NombreUsuario"><?php echo $this->lang->line('usuario_formulario_registro_nombre'); ?></label>
                         <input type="text" class="form-control" name="NombreUsuario" placeholder="" required value="<?=!form_error('NombreUsuario')?set_value('NombreUsuario'):''?>">
                       </div>
                       <div class="form-group">
                         <label for="ApellidosUsuario"><?php echo $this->lang->line('usuario_formulario_registro_apellidos'); ?></label>
                         <input type="text" class="form-control" name="ApellidosUsuario" placeholder="" required value="<?=!form_error('ApellidosUsuario')?set_value('ApellidosUsuario'):''?>">
                       </div>
                       <div class="form-group">
                         <label for="CorreoUsuario"><?php echo $this->lang->line('usuario_formulario_registro_correo'); ?></label>
                         <input type="email" class="form-control" name="CorreoUsuario" placeholder="" required value="<?=!form_error('CorreoUsuario')?set_value('CorreoUsuario'):''?>">
                       </div>
                       <div class="form-group">
                         <label for="PassUsuario"><?php echo $this->lang->line('usuario_formulario_registro_pass'); ?></label>
                         <input type="password" class="form-control" name="PassUsuario" placeholder="" required value="<?=!form_error('PassUsuario')?set_value('PassUsuario'):''?>">
                       </div>
                       <div class="form-group">
                         <label for="TelefonoUsuario"><?php echo $this->lang->line('usuario_form_usuario_telefono'); ?></label>
                         <input type="text" class="form-control" name="TelefonoUsuario" placeholder="" required value="<?=!form_error('TelefonoUsuario')?set_value('TelefonoUsuario'):''?>">
                       </div>
                       <div class="form-check">
                         <input type="checkbox" class="form-check-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                         <label class="form-check-label" for="TerminosyCondiciones"><?php echo $this->lang->line('usuario_formulario_registro_terminos_y_condiciones'); ?></label>
                       </div>
                       <hr>
                       <button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('carrito_comprar'); ?></button>
                     </form>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<!-- termina proceso pago 1 -->
