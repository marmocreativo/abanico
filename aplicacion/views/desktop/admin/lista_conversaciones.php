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
          <ul class="list-unstyled">
          <?php foreach ($conversaciones as $conversacion) { ?>
            <li class="media border-bottom mb-3">
              <a href="<?php echo base_url('admin/servidores_mensajes/mensajes?id='.$conversacion->ID_CONVERSACION); ?>">
                <img class="mr-3" src="<?php echo base_url('assets/global/img/usuario_default.png'); ?>" width="30" alt="Generic placeholder image">
                <div class="media-body">
                  <h6 class="mt-0 mb-1"><small>De:</small> <?php echo $conversacion->USUARIO_NOMBRE.' '.$conversacion->USUARIO_APELLIDOS ?></h6>
                  <?php $remitente= $this->UsuariosModel->detalles($conversacion->ID_USUARIO_B); ?>
                  <h6 class="mt-0 mb-1"><small>Para:</small> <?php echo $remitente['USUARIO_NOMBRE'].' '.$remitente['USUARIO_APELLIDOS'] ?></h6>
                  <p><?php echo $conversacion->CONVERSACION_TIPO; ?></p>
                  <p><small><?php echo $conversacion->CONVERSACION_FECHA_ACTUALIZACION; ?></small></p>
                </div>
              </a>
            </li>
        <?php  } ?>
        </ul>
      </div>
      </div>
    </div>
  </div>
