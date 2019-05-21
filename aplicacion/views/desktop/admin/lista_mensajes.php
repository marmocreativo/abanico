<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
  <div class="kt-container kt-body kt-grid kt-grid--ver" id="kt_body">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

      <!-- begin:: Subheader -->
      <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
        </div>
        <div class="kt-subheader__toolbar">
        </div>
      </div>

      <!-- end:: Subheader -->

      <!-- begin:: Content -->
      <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--Begin::Dashboard 8-->

        <!--Begin::Section-->
        <div class="row mb-3">
          <div class="col-xl-12">

            <!--begin:: Widgets/Trends-->
            <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
              <div class="kt-portlet__body">
<?php if(isset($_GET['id_usuario'])){ ?>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-four">
              <div class="stat-icon dib">
                  <i class="fa fa-user-tag text-muted"></i>
              </div>
              <div class="stat-content">
                  <div class="text-left dib">
                      <div class="stat-heading">Usuario</div>
                      <div class="stat-text"><?php echo $usuario['USUARIO_NOMBRE'].' '.$usuario['USUARIO_APELLIDOS']; ?></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-four">
              <div class="stat-icon dib">
                  <i class="fa fa-user-tie text-muted"></i>
              </div>
              <div class="stat-content">
                  <div class="text-left dib">
                      <div class="stat-heading">Perfil</div>
                      <div class="stat-text"><?php echo $perfil['PERFIL_NOMBRE']; ?></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
      <div class="card">

        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <div class="card">
                <div class="card-body">
                  <ul class="list-unstyled">
                    <li class="media border-bottom mb-3">
                      <a href="<?php echo base_url('usuario/mensajes/conversacion?id='.$conversacion['ID_CONVERSACION']); ?>">
                        <img class="mr-3" src="<?php echo base_url('assets/global/img/usuario_default.png'); ?>" width="30" alt="Generic placeholder image">
                        <div class="media-body">
                          <h6 class="mt-0 mb-1"><small>De:</small> <?php echo $conversacion['USUARIO_NOMBRE'].' '.$conversacion['USUARIO_APELLIDOS'] ?></h6>
                          <?php $remitente= $this->UsuariosModel->detalles($conversacion['ID_USUARIO_B']); ?>
                          <h6 class="mt-0 mb-1"><small>Para:</small> <?php echo $remitente['USUARIO_NOMBRE'].' '.$remitente['USUARIO_APELLIDOS'] ?></h6>
                          <p><?php echo $conversacion['CONVERSACION_TIPO']; ?></p>
                          <p><small><?php echo $conversacion['CONVERSACION_FECHA_ACTUALIZACION']; ?></small></p>
                      </div>
                      </a>
                    </li>
                  </ul>
              </div>
            </div>
          </div>
            <div class="col">
              <div class="card">
                <div class="card-body">
                <ul class="list-unstyled">
                <?php foreach ($mensajes as $mensaje) { ?>
                  <li class="media border p-2 mb-3 rounded">
                      <div class="media-body">
                        <?php echo $mensaje->MENSAJE_TEXTO; ?>
                        <?php $remitente= $this->UsuariosModel->detalles($mensaje->ID_REMITENTE); ?>
                        <p class="text-muted text-right" style="font-size:0.8em;"><?php echo $remitente['USUARIO_NOMBRE'].' '.$remitente['USUARIO_APELLIDOS']; ?></p>
                      </div>
                  </li>
                <?php } ?>
                </ul>
                <!--
                <form class="" action="<?php echo base_url('usuario/mensajes/conversacion'); ?>" method="post">
                  <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
                  <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
                  <textarea name="MensajeTexto" class="form-control" rows="4"></textarea>
                  <hr>
                  <button type="submit" class="btn btn-primary btn-sm float-right"> <i class="fa fa-paper-plane"></i> Responder</button>
                </form>
              -->
              </div>
            </div>
          </div>
          </div>
      </div>
      </div>
    </div>
  </div>
</div>
</div>

<!--end:: Widgets/Trends-->
</div>
</div>
<!--End::Section-->

<!--End::Dashboard 8-->
</div>

<!-- end:: Content -->
</div>
</div>
</div>
