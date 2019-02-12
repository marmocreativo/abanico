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
                    <li class="list-group-item msjs-inbox"><a href="<?php echo base_url('usuario/mensajes') ?>"> <i class="fa fa-inbox text-primary-7"></i>
                      <?php echo $this->lang->line('usuario_lista_conversaciones_entrada'); ?>
                    </a></li>
                    <li class="list-group-item msjs-serv"><a href="<?php echo base_url('usuario/mensajes?tipo='.'mensaje servicio') ?>"> <i class="fas fa-briefcase text-primary-6"></i>
                      <?php echo $this->lang->line('usuario_lista_conversaciones_servicios'); ?>
                    </a></li>
                    <li class="list-group-item msjs-preg"><a href="<?php echo base_url('usuario/mensajes?tipo='.'pregunta producto') ?>"> <i class="fas fa-question text-primary-3"></i>
                      <?php echo $this->lang->line('usuario_lista_conversaciones_productos'); ?>
                    </a></li>
                    <li class="list-group-item msjs-sent"><a href="<?php echo base_url('usuario/mensajes/enviados') ?>"> <i class="fa fa-share-square text-primary-12"></i>
                      <?php echo $this->lang->line('usuario_lista_conversaciones_enviados'); ?>
                    </a></li>
                  </ul>
                </div>
                <div class="col-4">
                  <div class="card cont-conversaciones p-3">
                    <div class="card-body p-0">
                      <ul class="list-unstyled">
                        <a href="<?php echo base_url('usuario/mensajes/conversacion?id='.$conversacion['ID_CONVERSACION']); ?>">
                          <li class="media mb-2 <?php echo url_title($conversacion['CONVERSACION_TIPO']); ?>">
                            <img class="align-self-start mr-3" src="<?php echo base_url('assets/global/img/usuario_default.png'); ?>" width="30" alt="Generic placeholder image">
                            <div class="media-body">
                              <h6 class="mt-0 mb-1"><small>De:</small> <?php echo $conversacion['USUARIO_NOMBRE'].' '.$conversacion['USUARIO_APELLIDOS'] ?></h6>
                              <?php $remitente= $this->UsuariosModel->detalles($conversacion['ID_USUARIO_B']); ?>
                              <h6 class="mt-0 mb-1"><small>Para:</small> <?php echo $remitente['USUARIO_NOMBRE'].' '.$remitente['USUARIO_APELLIDOS'] ?></h6>
                              <p class="mt-2 mb-0"><small><?php echo $conversacion['CONVERSACION_TIPO']; ?> | <?php echo $conversacion['CONVERSACION_FECHA_ACTUALIZACION']; ?></small></p>
                            </div>
                          </li>
                        </a>
                      </ul>
                  </div>
                </div>
              </div>
                <div class="col-6">
                  <div class="card conversacion">
                    <div class="card-body p-3">
                    <ul class="list-unstyled">
                    <?php foreach ($mensajes as $mensaje) { ?>
                      <li class="media mb-2 text-primary speech-bubble <?php if($mensaje->ID_REMITENTE==$_SESSION['usuario']['id']){ echo 'mi-mensaje'; } ?>">
                          <div class="media-body">
                              <?php echo $mensaje->MENSAJE_TEXTO; ?>
                              <?php $remitente= $this->UsuariosModel->detalles($mensaje->ID_REMITENTE); ?>
                            <div class="card-footer text-right p-1">
                              <small class="text-muted"><?php echo $remitente['USUARIO_NOMBRE'].' '.$remitente['USUARIO_APELLIDOS']; ?></small>
                            </div>
                          </div>
                      </li>
                    <?php } ?>
                    </ul>
                    <hr>
                    <form class="" action="<?php echo base_url('usuario/mensajes/conversacion'); ?>" method="post">
                      <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
                      <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
                      <textarea name="MensajeTexto" class="form-control" rows="4"></textarea>
                      <button type="submit" class="btn btn-primary btn-sm float-right"> <i class="fa fa-paper-plane"></i> <?php echo $this->lang->line('usuario_lista_conversaciones_responder'); ?> </button>
                    </form>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
