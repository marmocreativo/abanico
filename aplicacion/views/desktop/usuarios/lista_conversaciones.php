<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <?php retro_alimentacion(); ?>
              <div class="row no-gutters">
                <div class="col-2 bg-primary-10 text-white" id="shelf">
                  <ul class="list-group">
                    <li class="list-group-item <?php if(!isset($_GET['tipo'])){ echo 'activo'; } ?>"><a href="<?php echo base_url('usuario/mensajes') ?>"> <i class="fa fa-inbox"></i> Recibidos </a></li>
                    <li class="list-group-item <?php if(isset($_GET['tipo'])&&$_GET['tipo']=='mensaje servicio'){ echo 'activo'; } ?>"><a href="<?php echo base_url('usuario/mensajes?tipo='.'mensaje servicio') ?>"> <i class="fa fa-inbox"></i> Mensajes de Servicios </a></li>
                    <li class="list-group-item <?php if(isset($_GET['tipo'])&&$_GET['tipo']=='pregunta producto'){ echo 'activo'; } ?>"><a href="<?php echo base_url('usuario/mensajes?tipo='.'pregunta producto') ?>"> <i class="fa fa-inbox"></i> Preguntas en Productos </a></li>
                    <li class="list-group-item <?php if(base_url(uri_string())==base_url('usuario/mensajes/enviados')){ echo 'activo'; } ?>"><a href="<?php echo base_url('usuario/mensajes/enviados') ?>"> <i class="fa fa-share-square "></i> Enviados </a></li>
                  </ul>
                </div>
                <div class="col-4">
                  <div class="card">
                    <div class="card-body">
                      <ul class="list-unstyled">
                      <?php foreach ($conversaciones as $conversacion) { ?>
                        <li class="media border-bottom mb-3 <?php echo url_title($conversacion->CONVERSACION_TIPO); ?>">
                          <a href="<?php echo base_url('usuario/mensajes/conversacion?id='.$conversacion->ID_CONVERSACION); ?>">
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
              <div class="col-6">
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
