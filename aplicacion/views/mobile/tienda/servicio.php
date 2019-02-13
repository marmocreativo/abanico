<div class="bxInfoContent bxDetalle pb-4">
  <div class="container">
    <div class="row">
      <div class="col mb-4">
        <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
        <img src="<?php echo base_url($ruta_portada) ?>" class="img-thumbnail img-fluid" alt="Profile image example">
      </div>
      <div class="col-12 mb-4">
        <h4 class="h4 product-title mb-2"><?php echo $servicio['SERVICIO_NOMBRE']; ?> </h4>
        <?php echo $servicio['USUARIO_NOMBRE']; ?>
        <hr>
        <div class="row">
          <div class="col">
            <a href="<?php echo base_url('servicio/contacto?id='.$servicio['ID_SERVICIO']); ?>" class="btn btn-info btn- btn-block"> <span class="fa fa-envelope"></span> Contactar</a>
          </div>
        </div>
      </div>

      <div class="col-12 mb-4">
        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detalles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Acerca del Responsable</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="">
              <p class="h6 py-3">
                <strong><?php echo $servicio['SERVICIO_DESCRIPCION']; ?></strong>
              <p>
                <div class="row">
                  <div class="col">
                    <div class="card-group">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $this->lang->line('pagina_servicio_zona_trabajo'); ?></h5>
                          <p class="card-text"><?php echo $this->lang->line('pagina_servicio_zona_trabajo_pais'); ?>: <?php echo $servicio['SERVICIO_PAIS']; ?></p>
                          <p class="card-text"><?php echo $this->lang->line('pagina_servicio_zona_trabajo_estado'); ?>: <?php echo $servicio['SERVICIO_ESTADO_DIR']; ?></p>
                        </div>
                        <!--
                        <div class="card-footer">
                          <small class="text-muted">Horario de trabajo: 10:00 a 18:00</small>
                        </div>
                      -->
                      </div>
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $this->lang->line('pagina_servicio_zona_servicio'); ?></h5>
                          <?php echo $servicio['SERVICIO_ZONA_TRABAJO']; ?>
                        </div>
                      </div>
                      <?php if(!empty($adjuntos)){ ?>
                        <div class="card border-primary">
                          <h6 class="card-header bg-primary-15"><?php echo $this->lang->line('pagina_servicio_adjuntos_titulo'); ?></h6>
                          <div class="card-body text-primary">
                            <div class="list-group">
                              <?php foreach($adjuntos as $adjunto){ ?>
                              <a href="<?php echo base_url('contenido/adjuntos/servicios/'.$adjunto->ADJUNTO_ARCHIVO); ?>" class="list-group-item list-group-item-action" target="_blank">
                                <i class="far fa-file-alt"></i>
                                <span class="border-right mx-2"></span>
                                <?php echo $adjunto->ADJUNTO_NOMBRE; ?>
                              </a>
                            <?php } ?>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
            </div>
          </div>

        </div>
      </div>

      <div class="col-12 mb-4">
        <div class="mb-4">
          <?php $promedio_calificaciones = $promedio_calificaciones['CALIFICACION_ESTRELLAS']; $estrellas_restan= 5-$promedio_calificaciones; ?>
          <h5 class="mb-3">
            <?php for($i = 1; $i<=$promedio_calificaciones; $i++){ ?>
            <i class="fa fa-star" style="font-size:0.8em;"></i>
            <?php } ?>
            <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
            <i class="fa far-star" style="font-size:0.8em;"></i>
            <?php } ?>
            Calif (<?php echo number_format($promedio_calificaciones,1); ?>)
          </h5>
          <?php $e = 5; foreach($estrellas as $estrella){ ?>
        <?php $restan = 5-$e; ?>
        <?php if($cantidad_calificaciones!=0){ $porcentaje = ($estrella*100)/$cantidad_calificaciones; }else{ $porcentaje=0; }?>
        <div class="row">
          <div class="col">
            <ul class=" list-unstyled rating m-0">
              <?php for($i = 1; $i<=$e; $i++){ ?>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
              <?php } ?>
              <?php for($i = 1; $i<=$restan; $i++){ ?>
                <i class="far fa-star" style="font-size:0.8em;"></i>
              <?php } ?>
            </ul>
          </div>
          <div class="col-7">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?php echo $porcentaje; ?>%" aria-valuenow="<?php echo $porcentaje; ?>" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
          </div>
        </div>
      <?php $e--; } ?>
        </div>

        <div class="row mb-4">
            <div class="col">
              <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                <?php if(empty($mi_calificacion)){ ?>
                <div class="card">
                    <div class="card-body">
                      <form class="" action="<?php echo base_url('servicio/calificar'); ?>" method="post">
                        <input type="hidden" name="IdServicio" value="<?php echo $servicio['ID_SERVICIO']; ?>">
                        <input type="hidden" name="IdUsuario" value="<?php echo $servicio['ID_USUARIO']; ?>">
                        <input type="hidden" name="IdCalificador" value="<?php echo $_SESSION['usuario']['id'] ?>">
                        <label for="EstrellasCalificacion"><?php echo $this->lang->line('pagina_servicio_formulario_calificaciones_invita'); ?></label>
                        <div class="estrellas"></div>
                        <input type="hidden" id="EstrellasCalificacion" name="EstrellasCalificacion" value="1">
                        <div class="form-group">
                          <label for="ComentarioCalificacion"><?php echo $this->lang->line('pagina_servicio_formulario_calificaciones_comentario'); ?></label>
                          <textarea class="form-control" name="ComentarioCalificacion" rows="2" cols="80"></textarea>
                        </div>
                        <button type="submit" class="btn <?php echo 'btn'.$primary; ?> btn-sm float-right" name="button"> <i class="fa fa-star"></i> <?php echo $this->lang->line('pagina_servicio_formulario_calificaciones_calificar'); ?></button>
                      </form>
                    </div>
                </div>
              <?php }else{ ?>
                <h6><?php echo $this->lang->line('pagina_servicio_formulario_calificaciones_gracias'); ?></h6>
              <?php } ?>
              <?php }else{ ?>
                <div class="card">
                  <div class="card-body">
                    <p><?php echo $this->lang->line('pagina_servicio_formulario_calificaciones_para_calificar'); ?></p>
                    <a href="<?php echo base_url('login?url_redirect='.base_url('servicio/?id='.$servicio['ID_SERVICIO'])); ?>" class="btn <?php echo 'btn-outline'.$primary; ?> btn-block"> <i class="fa fa-sign-in-alt"></i> Inicia Sesión</a>
                  </div>
                </div>
              <?php } ?>
            </div>
        </div>

        <ul class="list-unstyled mb-4">
          <?php if(!empty($mi_calificacion)){ ?>
            <li class="media p-3">
                <img class="mr-3 img-thumbnail rounded-circle" src="<?php echo base_url('assets/global/img/usuario_default.png') ?>" width="64" alt="">
                <div class="media-body">
                  <h5 class="mt-0 mb-1"><?php echo $mi_calificacion['USUARIO_NOMBRE'].' '.$mi_calificacion['USUARIO_APELLIDOS']; ?></h5>
                  <div class="d-flex border-top border-bottom py-3">
                    <?php $estrellas = $mi_calificacion['CALIFICACION_ESTRELLAS']; $estrellas_restan= 5-$estrellas; ?>
                    <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                      <i class="fa fa-star"></i>
                    <?php } ?>
                    <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                      <i class="far fa-star"></i>
                    <?php } ?>
                  </div>
                  <p><?php echo $mi_calificacion['CALIFICACION_COMENTARIO']; ?></p>
                </div>
            </li>
            <?php } ?>
          <?php foreach($calificaciones as $calificacion){ ?>
            <li class="media p-3">
                <img class="mr-3 img-thumbnail rounded-circle" src="<?php echo base_url('assets/global/img/usuario_default.png') ?>" width="64" alt="">
                <div class="media-body">
                  <h5 class="mt-0 mb-1"><?php echo $calificacion->USUARIO_NOMBRE.' '.$calificacion->USUARIO_APELLIDOS; ?></h5>
                  <div class="d-flex border-top border-bottom py-3">
                    <?php $estrellas = $calificacion->CALIFICACION_ESTRELLAS; $estrellas_restan= 5-$estrellas; ?>
                    <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                      <i class="fa fa-star"></i>
                    <?php } ?>
                    <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                      <i class="fa far-star"></i>
                    <?php } ?>
                  </div>
                  <p><?php echo $calificacion->CALIFICACION_COMENTARIO; ?></p>
                </div>
            </li>
            <?php } ?>
        </ul>
      </div>

    </div>
  </div>
</div>
