<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <?php retro_alimentacion(); ?>
              <div class="row">
                <div class="col-2">
                  <ul class="list-group">
                    <li class="list-group-item"><a href="<?php echo base_url('usuario/mensajes') ?>"> <i class="fa fa-inbox"></i> Recibidos </a></li>
                    <li class="list-group-item"><a href="<?php echo base_url('usuario/mensajes_enviados') ?>"> <i class="fa fa-share-square"></i> Enviados </a></li>
                  </ul>
                </div>
                <div class="col-4">
                  <div class="card">
                    <div class="card-body">
                      <ul class="list-unstyled">
                      <?php foreach ($conversaciones as $conversacion) { ?>
                        <li class="media border-bottom p-3 mb-3">
                          <a href="<?php echo base_url('usuario/mensajes/conversacion?id='.$conversacion->ID_CONVERSACION); ?>">
                            <img class="mr-3" src="<?php echo base_url('assets/global/img/usuario_default.png'); ?>" width="30" alt="Generic placeholder image">
                            <div class="media-body">
                            <h6 class="mt-0 mb-1"><?php echo $conversacion->USUARIO_NOMBRE.' '.$conversacion->USUARIO_APELLIDOS ?></h6>
                          </a>
                        </li>
                    <?php  } ?>
                    </ul>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
