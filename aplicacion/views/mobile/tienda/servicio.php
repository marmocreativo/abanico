<?php
  // Variables de Traducción
  if($_SESSION['lenguaje']['iso']==$servicio['LENGUAJE']){
    $titulo = $servicio['SERVICIO_NOMBRE'];
    $descripcion_corta = $servicio['SERVICIO_DESCRIPCION'];
    $descripcion_larga = $servicio['SERVICIO_DETALLES'];
  }else{
    $traduccion = $this->TraduccionesModel->lista($servicio['ID_SERVICIO'],'servicio',$_SESSION['lenguaje']['iso']);
    if(!empty($traduccion)){
      $titulo = $traduccion['TITULO'];
      $descripcion_corta = $traduccion['DESCRIPCION_CORTA'];
      $descripcion_larga = $traduccion['DESCRIPCION_LARGA'];
    }else{
      $titulo = $servicio['SERVICIO_NOMBRE'];
      $descripcion_corta = $servicio['SERVICIO_DESCRIPCION'];
      $descripcion_larga = $servicio['SERVICIO_DETALLES'];
    }
  }
?>
<div class="bxInfoContent bxDetalle pb-4">
  <div class="container">
    <div class="row">
      <div style="width:100%; height:100px; background-image:url('<?php echo base_url('assets/global/img/bg-servicios.jpg'); ?>'); background-position: center; background-size:cover;">

      </div>
      <div class="col my-4 d-flex justify-content-center">
        <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
        <div class="border rounded-circle" style="width:70%; padding-top:70%; background-position: center; background-repeat: no-repeat; background-size: contain; background-image:url(<?php echo base_url($ruta_portada) ?>);"></div>
      </div>
      <div class="col-12 mb-4">
        <h4 class="h4 product-title mb-2"><?php echo $titulo; ?> </h4>
        <?php echo $servicio['USUARIO_NOMBRE']; ?>
        <div class="pt-2 border-top">
          <?php if($servicio['SERVICIO_TIPO']=='digital'){ ?>
            <p><span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio"><?php echo $this->lang->line('pagina_servicio_digital'); ?></span> <?php echo $this->lang->line('pagina_servicio_digital_descripcion'); ?></p>
          <?php }else{ ?>
            <p><span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio"><?php echo $this->lang->line('pagina_servicio_profesional'); ?></span> <?php echo $this->lang->line('pagina_servicio_profesional_descripcion'); ?></p>
          <?php } ?>
        </div>
        <hr>
        <hr>
        <div class="row">
          <div class="col">
            <a href="<?php echo base_url('servicio/contacto?id='.$servicio['ID_SERVICIO']); ?>" class="btn btn-info btn- btn-block"> <span class="fa fa-envelope"></span> Contactar</a>
          </div>
        </div>
      </div>

      <div class="col-12 mb-4">
        <div class="row mb-5">
          <div class="col-12">
            <div class="card card-desc-servicio">
              <div class="card-body fila-gris">
                <div class="row">
                  <div class="card-text col-12">
                    <?php echo $descripcion_corta; ?>
                    <hr>
                    <?php echo $descripcion_larga; ?>
                  </div>
                  <div class="col-12">
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
            <div class="slideBxProducto mb-4">
              <ul class="slides">
                <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
                <?php foreach($galerias as $galeria){ ?>
                <li data-imagen='<?php echo $galeria->GALERIA_ARCHIVO; ?>'>
                    <?php $ruta_galeria = $op['ruta_imagenes_servicios'].'completo/'.$galeria->GALERIA_ARCHIVO; ?>
                  <img src="<?php echo base_url($ruta_galeria) ?>" alt="">
                </li>
                <?php } ?>
              </ul>
            </div>
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

              <div class="card">
                <div class="card-body">
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                    <a class="a2a_button_facebook"></a>
                    <a class="a2a_button_twitter"></a>
                    <a class="a2a_button_whatsapp"></a>
                    <a class="a2a_button_pinterest"></a>
                    </div>
                    <script async src="https://static.addtoany.com/menu/page.js"></script>
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
