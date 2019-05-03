<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8">
        <div class="card">
          <div class="card-body">
            <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" class="btn btn-primary btn-circle">1</a>
                  <p><?php echo $this->lang->line('proceso_pago_1_identificacion'); ?></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-default btn-circle" disabled="disabled">2</a>
                  <p><?php echo $this->lang->line('proceso_pago_1_direccion'); ?></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-default btn-circle" disabled="disabled">3</a>
                  <p><?php echo $this->lang->line('proceso_pago_1_pago'); ?></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                  <p><?php echo $this->lang->line('proceso_pago_1_confirmacion'); ?></p>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col text-center">
                <h6> <i class="fa fa-sign-in-alt"></i> <?php echo $this->lang->line('usuario_formulario_login_titulo'); ?></h6>
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
                 <hr>
                 <nav class="nav justify-content-center nav-fill">
                   <a class="nav-link" href="<?php echo base_url('login/olvide');?>"> <span class="fa fa-question-circle"></span> <?php echo $this->lang->line('usuario_formulario_olvide_pass'); ?></a>
                 </nav>
              </div>
              <div class="col border-left text-center">
                <h6> <i class="fa fa-user"></i> <?php echo $this->lang->line('proceso_pago_1_registro_rapido'); ?></h6>
                <?php retro_alimentacion(); ?>
                <?php if(!empty(validation_errors())){ ?>
                  <div class="alert alert-danger">
                    <?php echo validation_errors(); ?>
                  </div>
                  <hr>
                <?php } ?>
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

<!-- Modal de flujos -->

<!-- Modal -->
<div class="modal fade" id="ModalAyuda" tabindex="-1" role="dialog" aria-labelledby="ModalAyuda" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-question-circle"></i> Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">

          <div class="linea-colores-delgada">
            <div class="barra-color barra-azul"></div>
            <div class="barra-color barra-rosa"></div>
            <div class="barra-color barra-amarillo"></div>
            <div class="barra-color barra-verde"></div>
            <div class="barra-color barra-morado"></div>
          </div>
        <!-- Slider Ayuda-->
        <div id="carouselAyuda" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselAyuda" data-slide-to="0" class="active"></li>
            <li data-target="#carouselAyuda" data-slide-to="1"></li>
            <li data-target="#carouselAyuda" data-slide-to="2"></li>
            <li data-target="#carouselAyuda" data-slide-to="3"></li>
            <li data-target="#carouselAyuda" data-slide-to="4"></li>
            <li data-target="#carouselAyuda" data-slide-to="5"></li>
            <li data-target="#carouselAyuda" data-slide-to="6"></li>
            <li data-target="#carouselAyuda" data-slide-to="7"></li>
            <li data-target="#carouselAyuda" data-slide-to="8"></li>
            <li data-target="#carouselAyuda" data-slide-to="9"></li>
            <li data-target="#carouselAyuda" data-slide-to="10"></li>
            <li data-target="#carouselAyuda" data-slide-to="11"></li>
            <li data-target="#carouselAyuda" data-slide-to="12"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.1.png'); ?>" alt="Registro paso 1">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.2.png'); ?>" alt="Registro paso 2">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.3.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.4.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.5.png'); ?>" alt="Registro paso 5">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.6.png'); ?>" alt="Registro paso 6">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.7.png'); ?>" alt="Registro paso 7">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.8.png'); ?>" alt="Registro paso 8">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.9.png'); ?>" alt="Registro paso 9">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.10.png'); ?>" alt="Registro paso 10">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.11.png'); ?>" alt="Registro paso 11">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.12.png'); ?>" alt="Registro paso 12">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselAyuda" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselAyuda" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
