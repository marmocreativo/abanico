<div class="contenido_principal">
  <div class="main">
      <div class="serv-profile">
        <div class="jumbotron mb-2">
        </div>
        <div class="container">
          <div class="row mb-5">
            <div class="col-3">
              <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
              <img src="<?php echo base_url($ruta_portada) ?>" class="img-thumbnail image-profile float-left" width="180" alt="Profile image example">
            </div>
            <div class="col-9">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active <?php echo 'text'.$primary; ?>" aria-current="page">Mis servicios</li>
                  </ol>
                </nav>
                <h2><?php echo $servicio['SERVICIO_NOMBRE']; ?></h2>
                <h6><?php echo $servicio['USUARIO_NOMBRE']; ?></h6>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-12">
              <div class="card card-desc-servicio">
                <div class="card-header">
                  <h5 class="card-title">Descripción</h5>
                </div>
                <div class="card-body fila-gris">
                  <div class="row">
                    <div class="card-text col-6">
                      <?php echo $servicio['SERVICIO_DESCRIPCION']; ?>
                    </div>
                    <div class="col-6">
                      <div class="card border-primary">
                        <h6 class="card-header bg-primary-15">Anexos</h6>
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

                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-8">
              <div class="card-group">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Zona de Trabajo</h5>
                    <p class="card-text">Pais: <?php echo $servicio['SERVICIO_PAIS']; ?></p>
                    <p class="card-text">Estado: <?php echo $servicio['SERVICIO_ESTADO_DIR']; ?></p>
                  </div>
                  <!--
                  <div class="card-footer">
                    <small class="text-muted">Horario de trabajo: 10:00 a 18:00</small>
                  </div>
                -->
                </div>
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Zona de Servicio</h5>
                    <div class="alert alert-info">Pendiente</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-4">
              <a href="<?php echo base_url('servicio/contacto?id='.$servicio['ID_SERVICIO']); ?>" class="btn <?php echo 'btn'.$primary; ?> btn-lg btn-block btn-contacto"> <span class="fa fa-envelope"></span> Contactar</a>
            </div>
          </div>
          <div class="row mb-5">
            <div class="container-fluid fila-gris py-4">
              <div class="col-12">
                <div class="card opiniones-serv">
                  <div class="card-body">
                    <?php $promedio_calificaciones = $promedio_calificaciones['CALIFICACION_ESTRELLAS']; $estrellas_restan= 5-$promedio_calificaciones; ?>
                    <h5 class="card-title">Calificación promedio</h5>
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
                    <h6 class="card-subtitle my-3 text-muted">Opiniones de los usuarios</h6>
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
                              <label for="EstrellasCalificacion">Califica este producto</label>
                              <div class="estrellas"></div>
                              <input type="hidden" id="EstrellasCalificacion" name="EstrellasCalificacion" value="1">
                              <div class="form-group">
                                <label for="ComentarioCalificacion">Comentario</label>
                                <textarea class="form-control" name="ComentarioCalificacion" rows="2" cols="80"></textarea>
                              </div>
                              <button type="submit" class="btn <?php echo 'btn'.$primary; ?> btn-sm float-right" name="button"> <i class="fa fa-star"></i> Calificar</button>
                            </form>
                          </div>
                      </div>
                    <?php }else{ ?>
                      <h6>Gracias por tu Calificación</h6>
                    <?php } ?>
                    <?php }else{ ?>
                      <div class="card">
                        <div class="card-body">
                          <p>Para calificar este producto.</p>
                          <a href="<?php echo base_url('login?url_redirect='.base_url('producto/?id='.$producto['ID_PRODUCTO'])); ?>" class="btn <?php echo 'btn-outline'.$primary; ?> btn-block"> <i class="fa fa-sign-in-alt"></i> Inicia Sesión</a>
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
