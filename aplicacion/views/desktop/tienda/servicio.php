<div class="contenido_principal">
  <div class="fila">
    <div class="container">
      <div class="row">
        <div class="col">
          <!-- Fila de Galer+ia y Datos principales -->
          <div class="row">
            <div class="col-4 d-flex">
              <div class="product-gallery d-flex w-100 h-100">
                <div class="product-gallery-thumbnails ">
                  <ol class="thumbnails-list list-unstyled w-25">
                    <?php foreach($galerias as $galeria){
                      $ruta_galeria = $op['ruta_imagenes_servicios'].'completo/'.$galeria->GALERIA_ARCHIVO;
                      ?>
                    <li><img src="<?php echo base_url($ruta_galeria) ?>" alt=""></li>
                  <?php } ?>
                  </ol>
                </div>
                <div class="product-gallery-featured d-flex align-items-center w-75 h-100">
                  <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
                  <img src="<?php echo base_url($ruta_portada) ?>" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="col">
              <div class="product-payment-details">
                <h4 class="product-title mb-2"><?php echo $servicio['SERVICIO_NOMBRE']; ?></h4>
                <?php echo $servicio['SERVICIO_DESCRIPCION']; ?>
                <hr>
                <div class="row">
                  <div class="col">
                    <a href="<?php echo base_url('servicio/contacto?id='.$servicio['ID_SERVICIO']); ?>" class="btn <?php echo 'btn'.$primary; ?> btn- btn-block"> <span class="fa fa-envelope"></span> Contactar</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="fila fila-gris">

              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col">
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
                    <div class="p-3">
                      <?php echo $servicio['SERVICIO_DETALLES']; ?>
                    </div>
                  </div>
                  <div class="tab-pane fade p-3" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                      <div class="col-3">
                          <img src="<?php echo base_url('contenido/img/tiendas/completo/'.$tienda['TIENDA_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                      </div>
                      <div class="col-9">
                        <table class="table table-sm table-borderless">
                          <tr>
                            <td><b>Nombre Público</b></td>
                            <td><?php echo $tienda['TIENDA_NOMBRE']; ?></td>
                          </tr>
                          <tr>
                            <td><b>Razón Social</b></td>
                            <td><?php echo $tienda['TIENDA_RAZON_SOCIAL']; ?></td>
                          </tr>
                          <tr>
                            <td><b>R.F.C.</b></td>
                            <td><?php echo $tienda['TIENDA_RFC']; ?></td>
                          </tr>
                          <tr>
                            <td><b>Teléfono</b></td>
                            <td><?php echo $tienda['TIENDA_TELEFONO']; ?></td>
                          </tr>
                          <tr>
                            <td><b>Registro</b><br><?php echo $tienda['TIENDA_FECHA_REGISTRO']; ?></td>
                            <td><b>Actualización</b><br><?php echo $tienda['TIENDA_FECHA_ACTUALIZACION']; ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="row border-top pt-3">
                      <div class="col">
                        <h6>Dirección Fiscal</h6>
                        <p><?php echo $direccion_formateada; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

              <div class="col-4">
                <?php $promedio_calificaciones = $promedio_calificaciones['CALIFICACION_ESTRELLAS']; $estrellas_restan= 5-$promedio_calificaciones; ?>
                <h5 class="mb-3">
                  <?php for($i = 1; $i<=$promedio_calificaciones; $i++){ ?>
                    <i class="fa fa-star"></i>
                  <?php } ?>
                  <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                    <i class="far fa-star"></i>
                  <?php } ?>
                   Calificaciones (<?php echo $cantidad_calificaciones; ?>)</h5>
                <?php $e = 5; foreach($estrellas as $estrella){ ?>
                <?php $restan = 5-$e; ?>
                <?php if($cantidad_calificaciones!=0){ $porcentaje = ($estrella*100)/$cantidad_calificaciones; }else{ $porcentaje=0; }?>
                <div class="row">
                  <div class="col-4 ">
                    <ul class=" list-unstyled rating m-0">
                      <?php for($i = 1; $i<=$e; $i++){ ?>
                        <i class="fa fa-star" style="font-size:0.8em;"></i>
                      <?php } ?>
                      <?php for($i = 1; $i<=$restan; $i++){ ?>
                        <i class="far fa-star" style="font-size:0.8em;"></i>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="col-8">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $porcentaje; ?>%" aria-valuenow="<?php echo $porcentaje; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                  </div>
                </div>
              <?php $e--; } ?>
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
                            <label for="EstrellasCalificacion">Califica este servicio</label>
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
                        <a href="<?php echo base_url('login?url_redirect='.base_url('producto/?id='.$servicio['ID_SERVICIO'])); ?>" class="btn <?php echo 'btn-outline'.$primary; ?> btn-block"> <i class="fa fa-sign-in-alt"></i> Inicia Sesión</a>
                      </div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
                <ul class="list-unstyled">
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
                          <i class="far fa-star"></i>
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
    </div>
  </div>
</div>
