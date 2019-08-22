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
<div class="contenido_principal">
  <div class="main">
      <div class="serv-profile">
        <div class="jumbotron mb-2" style="background-image:url('<?php echo base_url('assets/global/img/bg-servicios.jpg'); ?>'); background-position: center center;">
        </div>
        <div class="container">
          <div class="row mb-5">
            <div class="col-3">

                <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
              <div class="cont-foto-servicio img-thumbnail align-center" style="width:90%; padding-top:90%; background-position: center; background-repeat: no-repeat; background-size: contain; background-image:url(<?php echo base_url($ruta_portada) ?>);">

              </div>
            </div>
            <div class="col-9">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('pagina_servicio_migas_inicio'); ?></a></li>
                    <li class="breadcrumb-item active <?php echo 'text'.$primary; ?>" aria-current="page"><?php echo $this->lang->line('pagina_servicio_migas_servicio'); ?></li>
                  </ol>
                </nav>
                <h2><?php echo $titulo; ?></h2>
                <h6><?php echo $servicio['USUARIO_NOMBRE']; ?></h6>
                <div class="pt-2 border-top">
                  <?php if($servicio['SERVICIO_TIPO']=='digital'){ ?>
                    <h4><span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio"><?php echo $this->lang->line('pagina_servicio_digital'); ?></span> <?php echo $this->lang->line('pagina_servicio_digital_descripcion'); ?></h4>
                  <?php }else{ ?>
                    <h4><span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio"><?php echo $this->lang->line('pagina_servicio_profesional'); ?></span> <?php echo $this->lang->line('pagina_servicio_profesional_descripcion'); ?></h4>
                  <?php } ?>
                </div>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-12">
              <div class="card card-desc-servicio">
                <div class="card-body fila-gris">
                  <div class="row">
                    <div class="card-text col-6">
                      <?php echo $descripcion_corta; ?>
                      <hr>
                      <?php echo $descripcion_larga; ?>
                    </div>
                    <div class="col-6">
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

          <div class="row">
            <div class="col">
              <div class="row">
                <div class="col-12 mb-3 slider-fotos d-flex align-items-center justify-content-center">
                  <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
                  <img src="<?php echo base_url($ruta_portada) ?>" class="img-fluid visor-galeria-producto" style="max-height:500px" alt="<?php echo $titulo.'-portada' ?>" title="<?php echo $titulo.'-portada' ?>">
                </div>
              </div>
              <div class="row">
                <?php $i=1; foreach($galerias as $galeria){ ?>
                  <?php $ruta_galeria = $op['ruta_imagenes_servicios'].'completo/'.$galeria->GALERIA_ARCHIVO; ?>
                  <div class="col-2 mb-2 px-1">
                  <div class="card slider-thumbs deck-imagenes" style="background-image:url('<?php echo base_url($ruta_galeria) ?>'); background-size:contain; background-position:center; background-repeat:no-repeat;" title="<?php echo $titulo.'-galeria-'.$i; ?>">
                  </div>
                </div>
                <?php $i++; } ?>
              </div>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-8">
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
              </div>
            </div>
            <div class="col-4">
              <a href="<?php echo base_url('servicio/contacto?id='.$servicio['ID_SERVICIO']); ?>" class="btn <?php echo 'btn'.$primary; ?> btn-lg btn-block btn-contacto"> <span class="fa fa-envelope"></span> <?php echo $this->lang->line('pagina_servicio_boton_contactar'); ?></a>
              <hr>
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
          <div class="row mb-5">
            <div class="container-fluid fila-gris py-4">
              <div class="col-12">
                <div class="card opiniones-serv">
                  <div class="card-body">
                    <?php $promedio_calificaciones = $promedio_calificaciones['CALIFICACION_ESTRELLAS']; $estrellas_restan= 5-$promedio_calificaciones; ?>
                    <h5 class="card-title"><?php echo $this->lang->line('pagina_servicio_calificaciones_promedio'); ?></h5>
                    <h1 style="display:inline;"><?php echo number_format($promedio_calificaciones,1); ?></h1>
                    <?php for($i = 1; $i<=$promedio_calificaciones; $i++){ ?>
                      <span class="fa fa-star <?php echo 'text'.$primary; ?>"></span>
                    <?php } ?>
                    <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                      <span class="far fa-star <?php echo 'text'.$primary; ?>"></span>
                    <?php } ?>
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
                    <h6 class="card-subtitle my-3 text-muted"><?php echo $this->lang->line('pagina_servicio_calificaciones_opiniones'); ?></h6>
                    <div class="row mt-3">
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
                          <a href="<?php echo base_url('login?url_redirect='.base_url('servicio/?id='.$servicio['ID_SERVICIO'])); ?>" class="btn <?php echo 'btn-outline'.$primary; ?> btn-block"> <i class="fa fa-sign-in-alt"></i> <?php echo $this->lang->line('pagina_servicio_formulario_calificaciones_iniciar_sesion'); ?></a>
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                    <div class="list-group">
                      <?php if(!empty($mi_calificacion)){ ?>
                      <li class="media border border-info p-3">
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
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                          <div class="d-flex w-100 justify-content-between">
                            <ul class="rating pl-0">
                              <?php $estrellas = $calificacion->CALIFICACION_ESTRELLAS; $estrellas_restan= 5-$estrellas; ?>
                              <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                                <li class="fa fa-star <?php echo 'text'.$primary; ?>"></li>
                              <?php } ?>
                              <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                                <li class="far fa-star <?php echo 'text'.$primary; ?>"></li>
                              <?php } ?>
                            </ul>
                            <small><?php echo $calificacion->CALIFICACION_FECHA_REGISTRO; ?></small>
                          </div>
                          <p class="mb-1"><?php echo $calificacion->CALIFICACION_COMENTARIO; ?></p>
                          <small><?php echo $calificacion->USUARIO_NOMBRE.' '.$calificacion->USUARIO_APELLIDOS; ?></small>
                        </a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div> <!-- /container -->
</div>
