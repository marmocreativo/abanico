<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <?php retro_alimentacion(); ?>
              <div class="row no-gutters h-100">
                <div class="col-2" id="shelf">
                  <ul class="list-group">
                    <li class="list-group-item msjs-inbox <?php if(!isset($_GET['tipo'])&&base_url(uri_string())==base_url('usuario/mensajes')){ echo 'activo'; } ?>"><a href="<?php echo base_url('usuario/mensajes') ?>"> <i class="fa fa-inbox text-primary-7"></i> Bandeja de Entrada </a></li>
                    <li class="list-group-item msjs-serv <?php if(isset($_GET['tipo'])&&$_GET['tipo']=='mensaje servicio'){ echo 'activo'; } ?>"><a href="<?php echo base_url('usuario/mensajes?tipo='.'mensaje servicio') ?>"> <i class="fas fa-briefcase text-primary-3"></i> Mensajes de Servicios </a></li>
                    <li class="list-group-item msjs-preg <?php if(isset($_GET['tipo'])&&$_GET['tipo']=='pregunta producto'){ echo 'activo'; } ?>"><a href="<?php echo base_url('usuario/mensajes?tipo='.'pregunta producto') ?>"> <i class="fas fa-question text-primary-6"></i> Preguntas en Productos </a></li>
                    <li class="list-group-item msjs-sent <?php if(base_url(uri_string())==base_url('usuario/mensajes/enviados')){ echo 'activo'; } ?>"><a href="<?php echo base_url('usuario/mensajes/enviados') ?>"> <i class="fa fa-share-square text-primary-12"></i> Enviados </a></li>
                  </ul>
                </div>
                <div class="col-4">
                  <div class="card cont-conversaciones p-3">
                    <div class="card-body p-0">
                      <ul class="list-unstyled">
                      <?php foreach ($conversaciones as $conversacion) { ?>
                        <a href="<?php echo base_url('usuario/mensajes/conversacion?id='.$conversacion->ID_CONVERSACION); ?>">
                          <li class="media mb-2 <?php echo url_title($conversacion->CONVERSACION_TIPO); ?>">
                            <?php if($conversacion->CONVERSACION_ESTADO=='no leido'){ ?>
                              <i class="fa fa-envelope"></i>
                            <?php }else{ ?>
                              <i class="fa fa-envelope-open"></i>
                            <?php } ?>
                            <img class="align-self-start mr-3" src="<?php echo base_url('assets/global/img/usuario_default.png'); ?>" width="30" alt="Generic placeholder image">
                            <div class="media-body">
                              <h6 class="mt-0 mb-1"><small>De:</small> <?php echo $conversacion->USUARIO_NOMBRE.' '.$conversacion->USUARIO_APELLIDOS ?></h6>
                              <?php $remitente= $this->UsuariosModel->detalles($conversacion->ID_USUARIO_B); ?>
                              <h6 class="mt-0 mb-1"><small>Para:</small> <?php echo $remitente['USUARIO_NOMBRE'].' '.$remitente['USUARIO_APELLIDOS'] ?></h6>
                              <p class="mt-2 mb-0"><small><?php echo $conversacion->CONVERSACION_TIPO; ?> | <?php echo $conversacion->CONVERSACION_FECHA_ACTUALIZACION; ?></small></p>
                            </div>
                          </li>
                        </a>
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
