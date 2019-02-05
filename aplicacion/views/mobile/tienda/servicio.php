<div class="bxInfoContent bxDetalle pb-4">
  <div class="container">
    <div class="row">
      <div class="col mb-4 d-flex justify-content-center">
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
                          <?php echo $servicio['SERVICIO_ZONA_TRABAJO']; ?>
                        </div>
                      </div>
                      <?php if(!empty($adjuntos)){ ?>
                        <div class="card border-primary">
                          <h6 class="card-header bg-primary-15">Adjuntos</h6>
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
          <h5 class="mb-3">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
            Calificaciones (1)
          </h5>
          <div class="row">
            <div class="col-4 ">
              <ul class=" list-unstyled rating m-0">
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
              </ul>
            </div>
            <div class="col-8">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-4 ">
              <ul class=" list-unstyled rating m-0">
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
              </ul>
            </div>
            <div class="col-8">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-4 ">
              <ul class=" list-unstyled rating m-0">
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
              </ul>
            </div>
            <div class="col-8">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-4 ">
              <ul class=" list-unstyled rating m-0">
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
              </ul>
            </div>
            <div class="col-8">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <ul class=" list-unstyled rating m-0">
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
              </ul>
            </div>
            <div class="col-8">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <p>Para calificar este producto.</p>
                    <a href="http://localhost/abanico-master/login?url_redirect=http://localhost/abanico-master/producto/?id=11" class="btn btn-outline-info btn-block"> <i class="fa fa-sign-in-alt"></i> Inicia Sesión</a>
                  </div>
                </div>
            </div>
        </div>

        <ul class="list-unstyled mb-4">
            <li class="media p-3">
                <img class="mr-3 img-thumbnail rounded-circle" src="http://localhost/abanico-master/assets/global/img/usuario_default.png" width="64" alt="">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">Manuel Marmolejo Martínez</h5>
                  <div class="d-flex border-top border-bottom py-3">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="far fa-star"></i>
                      <i class="far fa-star"></i>
                  </div>
                  <p>hola</p>
                </div>
            </li>
        </ul>
      </div>

    </div>
  </div>
</div>
