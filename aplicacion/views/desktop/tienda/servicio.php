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
                    <button class="btn <?php echo 'btn'.$primary; ?> btn- btn-block"> <span class="fa fa-envelope"></span> Contactar</button>
                  </div>
                </div>
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
          </div>
          <div class="row mt-5 pt-3 border-top">
            <div class="col-12">
                <h6 class=""> <span class="fa fa-comments"></span> Comentarios</h6>
            </div>
            <div class="col-8 pt-3">
              <ul class="list-unstyled">
                <li class="media">
                  <img class="mr-3 img-thumbnail rounded-circle" src="<?php echo base_url('assets/global/img/usuario_default.png') ?>" width="64" alt="">
                  <div class="media-body">
                    <h5 class="mt-0 mb-1">Nombre del comentario</h5>
                    <div class="d-flex border-top border-bottom py-3">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <p>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="col-4">
                <form class="" action="usuario/calificacion" method="post">
                  <div class="form-group">
                    <label for="Calificacion">Calificación</label>
                    <select id="example" class="form-control">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Comentario">Comentario</label>
                    <textarea name="name" class="form-control" rows="3" cols="80"></textarea>
                  </div>
                  <button type="submit" class="btn <?php echo 'btn'.$primary; ?> float-right"> Comentario</button>
                </form>
            </div>
          </div>
        </div>
        <div class="col-2">
          <div class="fila fila-gris">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
