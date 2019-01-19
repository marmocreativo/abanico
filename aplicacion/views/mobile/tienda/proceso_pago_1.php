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
                  <!-- <p>Identificación</p> -->
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-default btn-circle" disabled="disabled">2</a>
                  <!-- <p>Dirección</p> -->
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-default btn-circle" disabled="disabled">3</a>
                  <!-- <p>Pago</p> -->
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                  <!-- <p>Confirmación</p> -->
                </div>
              </div>

            </div>
            <!-- <hr> -->
            <div class="row">
              <div class="col text-center">
                <h6 class="my-3"><i class="fa fa-sign-in-alt"></i> Iniciar Sesión</h6>
                <form class="" action="<?php echo base_url('login/iniciar');?>" method="post">
                  <input type="hidden" name="UrlRedirect" value="<?php echo base_url('proceso_pago_1'); ?>">
                   <div class="form-group">
                     <label for="CorreoUsuario">Correo</label>
                     <input type="email" class="form-control form-control-sm" id="CorreoUsuario" name="CorreoUsuario" placeholder="Su correo electrónico">
                   </div>
                   <div class="form-group">
                     <label for="PassUsuario">Contraseña</label>
                     <input type="password" class="form-control form-control-sm" id="PassUsuario" name="PassUsuario" placeholder="Contraseña">
                   </div>
                   <hr>
                   <button type="submit" class="btn btn-sm btn-primary btn-block">Iniciar Sesión</button>
                 </form>
                 <hr>
                 <nav class="nav justify-content-center nav-fill">
                   <a class="nav-link" href="<?php echo base_url('login/olvide');?>"> <span class="fa fa-question-circle"></span> Olvide mi contraseña</a>
                   <a class="nav-link" href="<?php echo base_url('usuario/registrar');?>"> <span class="fa fa-pen-square"></span> Registrarme</a>
                 </nav>
              </div>
              <!--
              <div class="col border-left text-center">
                <h6> <i class="fa fa-user"></i> Invitado</h6>
                <form class="" action="<?php echo base_url('pago_invitado_paso_2');?>" method="post">
                   <div class="form-group">
                     <label for="NombreUsuario">Nombre</label>
                     <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" value="<?=!form_error('NombreUsuario')?set_value('NombreUsuario'):''?>">
                   </div>
                   <div class="form-group">
                     <label for="ApellidosUsuario">Apellidos</label>
                     <input type="text" class="form-control" id="ApellidosUsuario" name="ApellidosUsuario" placeholder="" value="<?=!form_error('ApellidosUsuario')?set_value('ApellidosUsuario'):''?>">
                   </div>
                   <div class="form-group">
                     <label for="CorreoUsuario">Correo Electrónico</label>
                     <input type="email" class="form-control" id="CorreoUsuario" name="CorreoUsuario" placeholder="" value="<?=!form_error('CorreoUsuario')?set_value('CorreoUsuario'):''?>">
                   </div>
                   <div class="form-check">
                     <input type="checkbox" class="form-check-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                     <label class="form-check-label" for="TerminosyCondiciones">Acepto los Términos y Condiciones</label>
                   </div>
                   <hr>
                   <button type="submit" class="btn btn-primary btn-block">Comprar</button>
                 </form>
              </div>
            -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
