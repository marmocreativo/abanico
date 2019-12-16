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
                       <div class="form-group">
                         <label for="PrimerContacto">¿Cómo te enteraste de nosotros?</label>
                         <select class="form-control" name="PrimerContacto" id="primer-contacto">
                           <option value="">Selecciona una opción</option>
                           <option value="recomendacion">Recomendación de un amigo o familiar</option>
                           <option value="redes sociales">Redes sociales</option>
                           <option value="busqueda">Buscando un producto en internet</option>
                           <option value="otro">Otro</option>
                         </select>
                       </div>
                       <div class="collapse" id="otro-seleccionado">
                         <div class="form-group">
                           <label for="OtroContacto">¿Puedes explicarnos cómo?</label>
                           <input type="text" class="form-control" id="OtroContacto" name="OtroContacto" placeholder="" value="<?=!form_error('OtroContacto')?set_value('OtroContacto'):''?>">
                         </div>
                       </div>
                       <script src="https://www.google.com/recaptcha/api.js?render=6LdiDcgUAAAAAESUj4C8u00DMeEWJfj8lBLQrv61"></script>
           						 <script>
           						 grecaptcha.ready(function() {
           								grecaptcha.execute('6LdiDcgUAAAAAESUj4C8u00DMeEWJfj8lBLQrv61', {action: 'homepage'}).then(function(token) {
           									var recaptchaResponse = document.getElementById('recaptchaResponse');
           									recaptchaResponse.value = token;
           								});
           						});
           						 </script>
                       <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
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
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo1.1.png'); ?>" alt="Registro paso 1">
              <div class="carousel-caption d-none d-md-block">
                <h5>Paso 1</h5>
                <p>En la barra de navegación superior da click en el menú "Usuarios".</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo1.2.png'); ?>" alt="Registro paso 2">
              <div class="carousel-caption d-none d-md-block">
                <h5>Paso 2</h5>
                <p>Haz clic en la opción, Registro.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo1.3.png'); ?>" alt="Registro paso 3">
              <div class="carousel-caption d-none d-md-block">
                <h5>Paso 3</h5>
                <p>Llena el formulario de registro con todos tus datos.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo1.4.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo1.5.png'); ?>" alt="Registro paso 5">
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
