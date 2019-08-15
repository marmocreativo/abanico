<div class="contenido_principal">

  <div class="formMobile">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
                <hr>
              <?php } ?>

                <form class="" action="<?php echo base_url('usuario/registro_rapido/registro_usuario');?>" method="post">
                  <div class="row">
                    <div class="col mb-3 text-center">
                      <img src="<?php echo base_url('assets/global/img/logo.png'); ?>" width="200" alt="">
                      <h2>Regístrate como vendedor</h2>
                    </div>
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

                       <div class="row">
                         <div class="col-12">
                            <div class="form-group">
                              <label for="NombrePerfil"><?php echo $this->lang->line('usuario_vista_tienda_nombre'); ?></label>
                              <input type="text" class="form-control" id="NombrePerfil" name="NombrePerfil" placeholder="" autocomplete="nope" value="<?php if(form_error('NombrePerfil') != NULL){echo set_value('NombrePerfil');}?>">
                            </div>
                            <hr>
                            <h6 class="mb-3"><span class="fa fa-file-invoice"></span> <?php echo $this->lang->line('usuario_form_perfil_servicio_datos_contaco'); ?></h6>
                            <div class="form-group">
                              <label for="TelefonoPerfil"><?php echo $this->lang->line('usuario_vista_tienda_telefono'); ?></label>
                              <input type="text" class="form-control" id="TelefonoPerfil" name="TelefonoPerfil" required placeholder="" value="<?php echo set_value('TelefonoPerfil'); ?>">
                            </div>
                            <hr>
                            <h5>Plan</h5>
                            <div class="form-group">
                              <label for="IdPlan">Plan seleccionado</label>
                              <select class="form-control" name="IdPlan">
                                <?php foreach($planes as $plan){ ?>
                                  <option value="<?php echo $plan->ID_PLAN; ?>" <?php if($plan->ID_PLAN==$_GET['plan']){ echo 'selected'; } ?>><?php echo $plan->PLAN_NOMBRE; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                         </div>
                       </div>

                       <div class="form-check">
                         <input type="checkbox" class="form-check-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                         <label class="form-check-label" for="TerminosyCondiciones"><?php echo $this->lang->line('usuario_formulario_registro_terminos_y_condiciones'); ?></label>
                       </div>
                       <hr>
                       <a href="<?php echo base_url('publicacion/terminos-y-condiciones-de-servicio-para-usuarios-nil'); ?>" target="_blank">Términos y condiciones usuarios</a>
                       <br>
                       <a href="<?php echo base_url('publicacion/terminos-y-condiciones-de-servicio-para-vendedores-y-prestadores-de-servicios-7oc'); ?>" target="_blank">Términos y condiciones vendedores y prestadores de servicios</a>
                       <hr>
                       <button type="submit" class="btn btn-primary btn-sm btn-block">Registrarme</button>

                    </div>
                  </div>
                 </form>
            </div>
            <div class="card-footer">
              <nav class="nav justify-content-center nav-fill">
                <a class="nav-link" href="<?php echo base_url('planes?tipo=servicios');?>"> <span class="fa fa-chevron-left"></span> Volver a los planes</a>
                <a class="nav-link" href="<?php echo base_url('login');?>"> <span class="fa fa-pen-square"></span> ¿Ya estas registrado como usuario?</a>
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
