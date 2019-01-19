<div class="contenido_principal">
  <div class="main">
      <div class="serv-profile">
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Inicio</a></li>
              <li class="breadcrumb-item active <?php echo 'text'.$primary; ?>" aria-current="page">Mis servicios</li>
            </ol>
          </nav>
          <?php retro_alimentacion(); ?>
          <div class="row mb-5">
            <div class="col-8">
              <div class="slider-pro" id="my-slider">
              	<div class="sp-slides">
                  <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
              		<!-- Slide 1 -->
                  <?php foreach($galerias as $galeria){ ?>
                    <?php $ruta_galeria = $op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO; ?>
              		<div class="sp-slide">
              			<img class="sp-image" src="<?php echo base_url($ruta_galeria) ?>"/>
              		</div>
                  <?php } ?>
              	</div>
                <div class="sp-thumbnails">
                  <?php foreach($galerias as $galeria){ ?>
                    <?php $ruta_galeria = $op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO; ?>
                  <div class="sp-thumbnail">
              			<img class="sp-thumbnail-image" src="<?php echo base_url($ruta_galeria) ?>"/>
              		</div>
                  <?php } ?>
              	</div>
              </div>
              <div class="cuadricula-productos">
                <!--
              <div class="product-content text-center">
                  <h3 class="title text-primary"><?php echo $producto['PRODUCTO_NOMBRE']; ?></h3>
                    <div class="price-list"><small>$</small> 000 <small>MXN </small> </div>
                  <div class="price"><small>$</small> 000 <small>MXN </small></div>
                  <ul class="rating">
                      <li class="fa fa-star text-primary"></li>
                      <li class="far fa-star text-primary"></li>
                    <li class="fa text-dark"></li>
                  </ul>
              </div>
            -->
            </div>
            </div>
            <div class="col-4">
              <h5><?php echo $producto['PRODUCTO_NOMBRE']; ?></h5>
              <hr>
              <?php echo $producto['PRODUCTO_DESCRIPCION']; ?>
              <hr>
              <?php if(!empty($producto['PRODUCTO_PRECIO_LISTA'])&&$producto['PRODUCTO_PRECIO_LISTA']>$producto['PRODUCTO_PRECIO']){ ?>
              <h3 class="product-price-descuento h6"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto['PRODUCTO_PRECIO_LISTA'],2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></h3>
              <?php } ?>
              <h2 class="product-price display-6" >
                <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                  <span id="Precio_Producto" ><?php echo number_format($_SESSION['divisa']['conversion']*$producto['PRODUCTO_PRECIO'],2); ?></span>
                <small><?php echo $_SESSION['divisa']['iso']; ?> </small>
              </h2>
              <div class="row my-3">
                  <?php if(!empty($combinaciones)){ ?>
                  <div class="col">
                    <div class="form-group">
                      <label for="CombinacionProducto" class="sr-only">Opciones</label>
                      <select class="form-control CombinacionProducto" name="CombinacionProducto">
                      <?php foreach($combinaciones as $combinacion){?>
                        <option value="<?php echo  $combinacion->COMBINACION_OPCION; ?>"
                          data-precio-producto='<?php echo $combinacion->COMBINACION_PRECIO; ?>'
                          data-precio-visible-producto='<?php echo number_format($_SESSION['divisa']['conversion']*$combinacion->COMBINACION_PRECIO,2); ?>'
                          data-detalles-producto='<?php echo $combinacion->COMBINACION_GRUPO.'-'.$combinacion->COMBINACION_OPCION; ?>'
                          ><?php echo $combinacion->COMBINACION_GRUPO.'-'.$combinacion->COMBINACION_OPCION; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php } ?>
                <div class="col">
                  <div class="form-group">
                    <label for="" class="sr-only">Cantidad</label>
                    <input type="number" class="form-control" name="CantidadProducto" id='CantidadProducto' min="1" max="<?php echo $producto['PRODUCTO_CANTIDAD']; ?>" value="<?php echo $producto['PRODUCTO_CANTIDAD_MINIMA']; ?>">
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn <?php echo 'btn'.$primary; ?> btn- btn-block" id="BotonComprar"
                      data-id-producto='<?php echo $producto['ID_PRODUCTO']; ?>'
                      data-nombre-producto='<?php echo $producto['PRODUCTO_NOMBRE']; ?>'
                      data-imagen-producto='<?php echo base_url($ruta_portada) ?>'
                      data-peso-producto='<?php echo $producto['PRODUCTO_PESO']; ?>'
                      data-detalles-producto=''
                      data-precio-producto='<?php echo $producto['PRODUCTO_PRECIO']; ?>'
                      data-id-tienda='<?php echo $tienda['ID_TIENDA']; ?>'
                      data-nombre-tienda='<?php echo $tienda['TIENDA_NOMBRE']; ?>'
                      >
                     <span class="fa fa-shopping-cart"></span> Comprar Ahora</button>
                </div>
              </div>
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
                          <form class="" action="<?php echo base_url('producto/calificar'); ?>" method="post">
                            <input type="hidden" name="IdProducto" value="<?php echo $producto['ID_PRODUCTO']; ?>">
                            <input type="hidden" name="IdUsuario" value="<?php echo $producto['ID_USUARIO']; ?>">
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

          <div class="row mb-5">
            <div class="col-12">
              <ul class="nav nav-tabs nav-fill fila-gris" id="tabProductos" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detalles</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Características</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="preguntas-tab" data-toggle="tab" href="#preguntas" role="tab" aria-controls="preguntas" aria-selected="false">Preguntas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Acerca del Vendedor</a>
                </li>
              </ul>
              <div class="tab-content fila-gris" id="contProductos">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="p-3">
                    <h5>Información detallada del producto</h5>
                    <?php echo $producto['PRODUCTO_DETALLES']; ?>
                  </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="p-3">
                    <div class="row">
                      <div class="col">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th colspan="2">Modelo y Claves</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Modelo</td>
                              <td><?php echo $producto['PRODUCTO_MODELO']; ?> </td>
                            </tr>
                            <tr>
                              <td>Origen</td>
                              <td><?php echo $producto['PRODUCTO_ORIGEN']; ?> </td>
                            </tr>
                            <tr>
                              <td>SKU</td>
                              <td><?php echo $producto['PRODUCTO_SKU']; ?> </td>
                            </tr>
                            <tr>
                              <td>UPC</td>
                              <td><?php echo $producto['PRODUCTO_UPC']; ?> </td>
                            </tr>
                            <tr>
                              <td>EAN</td>
                              <td><?php echo $producto['PRODUCTO_EAN']; ?> </td>
                            </tr>
                            <tr>
                              <td>JAN</td>
                              <td><?php echo $producto['PRODUCTO_JAN']; ?> </td>
                            </tr>
                            <tr>
                              <td>ISBN</td>
                              <td><?php echo $producto['PRODUCTO_ISBN']; ?> </td>
                            </tr>
                            <tr>
                              <td>MPN</td>
                              <td><?php echo $producto['PRODUCTO_MPN']; ?> </td>
                            </tr>
                            <tr>
                              <td>EAN</td>
                              <td><?php echo $producto['PRODUCTO_EAN']; ?> </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th colspan="2">Dimensiones y Peso</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Ancho</td>
                              <td><?php echo number_format($producto['PRODUCTO_ANCHO'],2); ?> <small>cm</small> </td>
                            </tr>
                            <tr>
                              <td>Alto</td>
                              <td><?php echo number_format($producto['PRODUCTO_ALTO'],2); ?> <small>cm</small> </td>
                            </tr>
                            <tr>
                              <td>Profundo</td>
                              <td><?php echo number_format($producto['PRODUCTO_PROFUNDO'],2); ?> <small>cm</small> </td>
                            </tr>
                            <tr>
                              <td>Peso</td>
                              <td><?php echo number_format($producto['PRODUCTO_PESO'],2); ?> <small>Kg</small> </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="preguntas" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="p-3">
                    <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                    <form class="" action="<?php echo base_url('producto/contacto'); ?>" method="post">
                      <input type="hidden" name="IdReceptor" value="<?php echo $producto['ID_USUARIO']; ?>">
                      <input type="hidden" name="IdRemitente" value="<?php echo $_SESSION['usuario']['id']; ?>">
                      <input type="hidden" name="ProductoNombre" value="<?php echo $producto['PRODUCTO_NOMBRE']; ?>">
                      <input type="hidden" name="IdProducto" value="<?php echo $producto['ID_PRODUCTO']; ?>">
                      <div class="row">
                        <table class="table">
                          <tr>
                            <td><strong>Remitente:</strong></td>
                            <td><?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']?></td>
                          </tr>
                        </table>
                      </div>
                      <p> <i class="fa fa-info-circle"></i> Tienes dudas sobre el producto?</p>
                      <div class="form-group">
                        <label for="MensajeTexto">Mensaje</label>
                        <textarea class="form-control" name="MensajeTexto" rows="8" required></textarea>
                      </div>
                      <button class="btn <?php echo 'btn'.$primary; ?> float-right"> <span class="fa fa-envelope"></span> Contactar</button>
                    </form>
                    <span class="clearfix"> </span>
                  <?php }else{ ?>
                    <div class="card">
                      <div class="card-body">
                        <p>Para preguntar debes Iniciar Sesión.</p>
                        <a href="<?php echo base_url('login?url_redirect='.base_url('producto/?id='.$producto['ID_PRODUCTO'])); ?>" class="btn <?php echo 'btn-outline'.$primary; ?> btn-block"> <i class="fa fa-sign-in-alt"></i> Inicia Sesión</a>
                      </div>
                    </div>
                  <?php } ?>
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
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Slider productos relacionados -->
          <div class="row">
            <div class="fila">
              <div class="container-fluid">
                <div class="row">
                  <div class="col">
                    <h2 class="h3 text-center border-bottom pb-3 mb-3">Productos Relacionados</h2>
                    <section class="slider">
                    <div class="flexslider carousel">
                      <ul class="slides">
                        <?php $productos_relacionados = $this->ProductosModel->lista(['ID_USUARIO'=>$producto['ID_USUARIO']],'','','10'); ?>
                        <?php foreach($productos_relacionados as $producto_rel){ ?>
                        <li>
                          <div class="cuadricula-productos">
                            <?php $galeria = $this->GaleriasModel->galeria_portada($producto_rel->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                            <a href="<?php echo base_url('producto?id='.$producto_rel->ID_PRODUCTO); ?>" class="enlace-principal">
                              <div class="imagen-producto">
                                <div class="contenedor-etiquetas">
                                  <?php if($producto_rel->PRODUCTO_ORIGEN=='México'){ ?>
                                    <span class="etiqueta-1">Mex</span>
                                  <?php } ?>
                                  <?php if(strtotime($producto_rel->PRODUCTO_FECHA_PUBLICACION) > strtotime('-'.$op['dias_productos_nuevos'].' Days')){ ?>
                                    <span class="etiqueta-2">Nuevo</span>
                                  <?php } ?>
                                  <?php if(!empty($producto_rel->PRODUCTO_PRECIO_LISTA)&&$producto_rel->PRODUCTO_PRECIO<$producto_rel->PRODUCTO_PRECIO_LISTA){ ?>
                                    <span class="etiqueta-3">Oferta</span>
                                  <?php } ?>
                                </div>
                                  <span  style="background-image:url(<?php echo base_url($ruta_portada); ?>)"></span>
                                  <div class="overlay-producto <?php echo 'bg'.$primary; ?>"></div>
                                  <div class="boton-ver">
                                    <a href="<?php echo base_url('producto?id='.$producto_rel->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Ver Producto"> <span class="fa fa-eye"></span> </a>
                                  <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                                    <a href="<?php echo base_url('producto/favorito?id='.$producto_rel->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                                  <?php }else{ ?>
                                    <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$producto_rel->ID_PRODUCTO)); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                                  <?php } ?>
                                  </div>
                              </div>
                              </a>
                              <div class="product-content text-center">
                                <?php
                                $promedio = $this->CalificacionesModel->promedio_calificaciones_producto($producto_rel->ID_PRODUCTO);
                                $cantidad = $this->CalificacionesModel->conteo_calificaciones_producto($producto_rel->ID_PRODUCTO);
                                ?>
                                  <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $producto_rel->PRODUCTO_NOMBRE; ?></h3>
                                  <?php if(!empty($producto_rel->PRODUCTO_PRECIO_LISTA)&&$producto_rel->PRODUCTO_PRECIO<$producto_rel->PRODUCTO_PRECIO_LISTA){ ?>
                                    <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto_rel->PRODUCTO_PRECIO_LISTA,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
                                  <?php } ?>
                                  <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto_rel->PRODUCTO_PRECIO,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>
                                  <ul class="rating">
                                    <?php $estrellas = round($promedio['CALIFICACION_ESTRELLAS']); $estrellas_restan= 5-$estrellas; ?>
                                    <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                                      <li class="fa fa-star <?php echo 'text'.$primary; ?>"></li>
                                    <?php } ?>
                                    <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                                      <li class="far fa-star <?php echo 'text'.$primary; ?>"></li>
                                    <?php } ?>
                                    <li class="fa text-dark">(<?php echo $cantidad; ?>)</li>
                                  </ul>
                              </div>
                          </div>
                        </li>
                        <?php } ?>
                      </ul>
                    </div>
                  </section>
                  </div>
                </div>
                </div>
              </div>
            </div>

          <div class="row mb-5">
              <div class="col-5">
              <!--
                <div class="accordion" id="accordionPreguntas">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="">Featured</h5>
                    </div>
                    <div class="" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          ¿Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid?
                        </button>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="" id="headingTwo">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Collapsible Group Item #2
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="" id="headingThree">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Collapsible Group Item #3
                        </button>
                      </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                </div>
              -->
              </div>
          </div>
        </div>
      </div>
  </div> <!-- /container -->
</div>
<?php /*
<!-- ANTERIOR -->
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
                      $ruta_galeria = $op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO;
                      ?>
                    <li><img src="<?php echo base_url($ruta_galeria) ?>" alt=""></li>
                  <?php } ?>
                  </ol>
                </div>
                <div class="product-gallery-featured d-flex align-items-center w-75 h-100">
                  <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
                  <img src="<?php echo base_url($ruta_portada) ?>" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="col">
              <div class="product-payment-details">
                <p class="last-sold text-muted"><small><?php echo $producto['PRODUCTO_CANTIDAD']; ?> Disponibles</small></p>
                <h4 class="product-title mb-2"><?php echo $producto['PRODUCTO_NOMBRE']; ?></h4>
                <hr>

                <hr>

              </div>
            </div>
            <div class="col-3">
              <div class="fila fila-gris">

              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-8">
                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detalles</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Características</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="preguntas-tab" data-toggle="tab" href="#preguntas" role="tab" aria-controls="preguntas" aria-selected="false">Preguntas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Acerca del Vendedor</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="p-3">
                      <?php echo $producto['PRODUCTO_DETALLES']; ?>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="preguntas" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="p-3">

                    </div>
                  </div>
                  <div class="tab-pane fade p-3" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                  </div>
                </div>
            </div>
              <div class="col-4">
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
*/ ?>
