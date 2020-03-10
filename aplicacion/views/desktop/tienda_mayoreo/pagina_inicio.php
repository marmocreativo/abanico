
<!-- Slider -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php $i = 0; foreach($slides as $slide){ ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0){ echo 'active'; } ?>"></li>
    <?php ++$i; }  ?>
    </ol>
    <div class="carousel-inner">
      <?php $i = 0; foreach($slides as $slide){ ?>
      <div class="carousel-item <?php if($i==0){ echo 'active'; } ?>">
        <div class="contenedor-texto-slide align-middle">
          <div class="texto-slide row align-items-center mx-0">
            <?php if(!empty($slide->SLIDE_TITULO)){ ?>
              <div class="col-12">

              <h2><?php echo $slide->SLIDE_TITULO; ?></h2>
              </div>
          <?php } ?>
            <?php if(!empty($slide->SLIDE_SUBTITULO)){ ?>
              <div class="col-12">

              <h2><?php echo $slide->SLIDE_SUBTITULO; ?></h2>
              </div>
          <?php } ?>
          <?php if(!empty($slide->SLIDE_ENLACE)){ ?>
            <div class="col-12">
              <a href="<?php echo $slide->SLIDE_ENLACE; ?>" class="btn btn-outline-dark"> <?php echo $slide->SLIDE_BOTON; ?></a>
            </div>
        <?php } ?>
          </div>
        </div>
        <img class="d-block w-100" src="<?php echo base_url('contenido/img/slider/'.$slide->SLIDE_IMAGEN); ?>">
      </div>
    <?php ++$i; }  ?>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Siguiente</span>
    </a>
  </div>
</div>
<div class="row fila-gris">
<div class="post-menu col-9 py-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col border-right">
        <a href="<?php echo base_url('categoria/servicios'); ?>" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text<?php echo $primary ?>"> <span class="fa fa-tools"></span> </div>
          <div class="car-titulo text<?php echo $primary ?>"><?php echo $this->lang->line('inicio_menu_destacados_servicios'); ?></div>
        </a>
      </div>
      <div class="col">
        <a href="<?php echo base_url('categoria'); ?>"  class="d-flex justify-content-center align-items-center">
          <div class="car-icono text<?php echo $primary ?>"> <span class="fa fa-box"></span> </div>
          <div class="car-titulo text<?php echo $primary ?>"><?php echo $this->lang->line('inicio_menu_destacados_productos'); ?></div>
        </a>
      </div>
      <div class="col border-left">
        <a href="<?php echo base_url('usuario/registrar'); ?>" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text<?php echo $primary ?>"> <span class="fa fa-handshake"></span> </div>
          <div class="car-titulo text<?php echo $primary ?>"><?php echo $this->lang->line('inicio_menu_destacados_unete'); ?></div>
        </a>
      </div>
      <div class="col border-left">
        <a href="#Concursos" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text<?php echo $primary ?>"> <span class="fa fa-gift"></span> </div>
          <div class="car-titulo text<?php echo $primary ?>">Concurso</div>
        </a>
      </div>
    </div>
  </div>
</div>
</div>
<?php
  $cuadricula = $this->SlidersModel->slide_nombre_lenguaje('fijas',$_SESSION['lenguaje']['iso']);
  $cuadritos = $this->SlidesModel->lista_activos(['ID_SLIDER'=>$cuadricula['ID_SLIDER']],'ORDEN ASC','');
?>
  <div class="row justify-content-center fila bg-light">
    <div class="col-10">
      <div class="row">
        <?php $i=0; foreach($cuadritos as $cuadrito){ ?>
          <div class="col-4 mb-2 animated fadeInUp" style="animation-delay:<?php echo $i; ?>00ms">
            <a href="<?php echo $cuadrito->SLIDE_ENLACE; ?>">
            <div class="card bg-primary-<?php echo rand(1, 15); ?> text-white" style="box-shadow: 0px 3px 16px #00000045;">
              <div class="card-body p-1">
                <div class="row">
                  <div class="col-5">
                    <img src="<?php echo base_url('contenido/img/slider/'.$cuadrito->SLIDE_IMAGEN); ?>" class="img-fluid" style="box-shadow: 0px 3px 16px #00000045;">
                  </div>
                  <div class="col-7 my-auto">
                      <?php if(!empty($cuadrito->SLIDE_TITULO)){ ?>
                        <h6 ><?php echo $cuadrito->SLIDE_TITULO; ?></h6>
                      <?php } ?>
                      <?php if(!empty($cuadrito->SLIDE_SUBTITULO)){ ?>
                      <h6 ><?php echo $cuadrito->SLIDE_SUBTITULO; ?></h6>
                      <?php } ?>
                      <?php if(!empty($cuadrito->SLIDE_BOTON)){ ?>
                      <p ><?php echo $cuadrito->SLIDE_BOTON; ?></p>
                      <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
        <?php $i++; } ?>
      </div>
    </div>
  </div>

<?php $no_carrusel = 0; $carruseles = $this->CarruselesModel->lista(['ESTADO'=>'activo'],'ORDEN ASC',''); ?>

<?php foreach($carruseles as $carrusel){ ?>
  <!-- Inicia el cuerpo del texto -->
  <?php
    $categorias = explode(',',$carrusel->CATEGORIAS);
    $id_categorias = array();
    foreach($categorias as $slug){
      $detalles = $this->CategoriasModel->detalles_slug($slug);
      $id_categorias[] = $detalles['ID_CATEGORIA'];
    }
    $parametros_or = array();
    $parametros_and = array();
    $parametros_or_servicios = array();
    $parametros_and_servicios = array();
    if($carrusel->ORIGEN!=''){
      $parametros_and['PRODUCTO_ORIGEN'] = $carrusel->ORIGEN;
    }
    if($carrusel->ARTESANAL!=''){
      $parametros_and['PRODUCTO_ARTESANAL'] = $carrusel->ARTESANAL;
    }

   ?>

  <div class="fila py-2 <?php if($no_carrusel % 2 == 0){ echo "fila-gris";  }else{ echo 'bg-light'; }  ?>">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <h2 class="car-titulo text-center text-primary pb-1 mb-0"><img alt="" src="<?php echo base_url(); ?>assets/global/img/decor_izq.png" width="25px"><?php echo $carrusel->TITULO ?><img alt="" src="<?php echo base_url(); ?>assets/global/img/decor_der.png" width="25px"></h2>
          <h5 class="text-center border-top py-3 mb-3"><?php echo $carrusel->DESCRIPCION ?></h5>
          <section class="slider">
          <div class="flexslider carousel">
            <ul class="slides">
                <?php
                switch ($carrusel->TIPO) {
                  case 'todos':
                    $productos = $this->ProductosModel->lista_activos($parametros_or,$parametros_and,'',$carrusel->ORDEN_PRODUCTOS,$carrusel->LIMITE);
                    $servicios =  $this->ServiciosModel->lista_activos($parametros_or,$parametros_and,'',$carrusel->ORDEN_PRODUCTOS,$carrusel->LIMITE);

                    break;
                  case 'incluyente':
                    $productos = $this->ProductosModel->lista_categoria_activos($parametros_or,$parametros_and,$id_categorias,$carrusel->ORDEN_PRODUCTOS,$carrusel->LIMITE);
                    $servicios =  $this->ServiciosModel->lista_categoria_activos($parametros_or_servicios,$parametros_and_servicios,$id_categorias,$carrusel->ORDEN_PRODUCTOS,$carrusel->LIMITE);

                    break;
                  case 'excluyente':
                    $productos = $this->ProductosModel->lista_no_categoria_activos($parametros_or,$parametros_and,$id_categorias,$carrusel->ORDEN_PRODUCTOS,$carrusel->LIMITE);
                    $servicios =  $this->ServiciosModel->lista_no_categoria_activos($parametros_or_servicios,$parametros_and_servicios,$id_categorias,$carrusel->ORDEN_PRODUCTOS,$carrusel->LIMITE);

                    break;
                }
                ?>
              <?php foreach($productos as $producto){ ?>
                <?php
                // Variables de Traducción
                if($_SESSION['lenguaje']['iso']==$producto->LENGUAJE){
                  $titulo = $producto->PRODUCTO_NOMBRE;
                }else{
                  $traduccion = $this->TraduccionesModel->lista($producto->ID_PRODUCTO,'producto',$_SESSION['lenguaje']['iso']);
                  if(!empty($traduccion)){
                    $titulo = $traduccion['TITULO'];
                  }else{
                    $titulo = $producto->PRODUCTO_NOMBRE;
                  }
                }
                // Variables de Paquete
                $paquete = $this->PlanesModel->plan_activo_usuario($producto->ID_USUARIO,'productos');
                if($paquete==null){
                  $visible = 'd-none';
                }else{
                  $visible = '';
                }
                ?>
              <li class="<?php echo $visible; ?>">
                <div class="cuadricula-productos">
                  <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                  <a href="<?php echo base_url('producto/'.$producto->PRODUCTO_URL.'/'.$producto->ID_PRODUCTO); ?>" class="enlace-principal">
                    <div class="imagen-producto">
                      <div class="contenedor-etiquetas">

                        <?php if($producto->PRODUCTO_CANTIDAD<='0'){ ?>
                          <span class="etiqueta-agotado">Agotado</span>
                        <?php } ?>
                        <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                          <span class="etiqueta-1"><?php echo $this->lang->line('etiquetas_productos_mexico'); ?></span>
                        <?php } ?>
                        <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                          <span class="etiqueta-3"><?php echo $this->lang->line('etiquetas_productos_oferta'); ?></span>
                        <?php } ?>
                        <?php if($producto->PRODUCTO_ARTESANAL=='si'){ ?>
                          <span class="etiqueta-artesanal"><img src="<?php echo base_url('assets/global/img/artesanal.png'); ?>"></span>
                        <?php } ?>
                      </div>
                        <span  style="background-image:url(<?php echo base_url($ruta_portada); ?>)"></span>

                        <div class="overlay-producto <?php echo 'bg'.$primary; ?>"></div>
                        <div class="boton-ver">
                          <a href="<?php echo base_url('producto/'.$producto->PRODUCTO_URL.'/'.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Ver Producto"> <span class="fa fa-eye"></span> </a>
                        <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                          <a href="<?php echo base_url('producto/favorito?id_producto='.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                        <?php }else{ ?>
                          <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id_producto='.$producto->ID_PRODUCTO)); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                        <?php } ?>
                        </div>
                    </div>
                    </a>
                    <div class="product-content text-center">
                      <?php
                      $promedio = $this->CalificacionesModel->promedio_calificaciones_producto($producto->ID_PRODUCTO);
                      $cantidad = $this->CalificacionesModel->conteo_calificaciones_producto($producto->ID_PRODUCTO);
                      // variables de precio
                      if($producto->PRODUCTO_DIVISA_DEFAULT!=$_SESSION['divisa']['iso']){
                        $cambio_divisa_default = $this->DivisasModel->detalles_iso($producto->PRODUCTO_DIVISA_DEFAULT);
                        if($producto->PRODUCTO_DIVISA_DEFAULT!='MXN'){
                          $precio_lista = $producto->PRODUCTO_PRECIO_LISTA/$cambio_divisa_default['DIVISA_CONVERSION'];
                          $precio_venta = $producto->PRODUCTO_PRECIO/$cambio_divisa_default['DIVISA_CONVERSION'];
                          $precio_display = $producto->PRODUCTO_PRECIO;
                        }else{
                          $precio_lista = $_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO_LISTA;
                          $precio_venta = $_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO;
                          $precio_display = $producto->PRODUCTO_PRECIO;
                        }
                      }else{
                        $precio_lista = $producto->PRODUCTO_PRECIO_LISTA;
                        $precio_venta = $producto->PRODUCTO_PRECIO;
                        $precio_display = $producto->PRODUCTO_PRECIO;
                      }
                      ?>
                        <ul class="rating">
                          <?php $estrellas = round($promedio['CALIFICACION_ESTRELLAS']); $estrellas_restan= 5-$estrellas; ?>
                          <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                            <li class="fa fa-star"></li>
                          <?php } ?>
                          <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                            <li class="far fa-star"></li>
                          <?php } ?>
                          <li class="text-dark">(<?php echo $cantidad; ?> calif)</li>
                        </ul>
                        <h3 class="title <?php echo 'text'.$primary; ?>" title="<?php echo $titulo; ?>"><?php echo word_limiter($titulo,10); ?></h3>
                        <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                          <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($producto->PRODUCTO_PRECIO_LISTA,2); ?> <small><?php echo $producto->PRODUCTO_DIVISA_DEFAULT; ?> </small> </div>
                        <?php } ?>
                        <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_display,2); ?> <small><?php echo $producto->PRODUCTO_DIVISA_DEFAULT; ?> </small></div>
                        <?php if($producto->PRODUCTO_ENVIO_GRATUITO!='no'){ ?>
                        <div class="p-1 border border-success rounded" style="border-style:dashed !important">
                          <span style="font-size:12px;" class="text-success"> Envío gratis <i class="fa fa-truck"></i></span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
    	    		</li>
              <?php } ?>
              <?php foreach($servicios as $servicio){ ?>
                <?php
                // Variables de Traducción
                if($_SESSION['lenguaje']['iso']==$servicio->LENGUAJE){
                  $titulo = $servicio->SERVICIO_NOMBRE;
                }else{
                  $traduccion = $this->TraduccionesModel->lista($servicio->ID_SERVICIO,'servicio',$_SESSION['lenguaje']['iso']);
                  if(!empty($traduccion)){
                    $titulo = $traduccion['TITULO'];
                  }else{
                    $titulo = $servicio->SERVICIO_NOMBRE;
                  }
                }
                // Variables de Paquete
                $paquete = $this->PlanesModel->plan_activo_usuario($servicio->ID_USUARIO,'servicios');
                if($paquete==null){
                  $visible = 'd-none';
                }else{
                  $visible = '';
                }
                ?>
              <li class="<?php echo $visible; ?>">
                <div class="cuadricula-productos">
                  <?php $galeria = $this->GaleriasModel->galeria_portada($servicio->ID_SERVICIO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                  <a href="<?php echo base_url('servicio?id='.$servicio->ID_SERVICIO); ?>" class="enlace-principal">
                    <div class="imagen-producto">
                        <span  style="background-image:url(<?php echo base_url($ruta_portada); ?>)"></span>
                        <div class="overlay-producto <?php echo 'bg'.$primary; ?>"></div>
                    </div>
                  </a>
                    <div class="product-content text-center">
                      <?php
                      $promedio = $this->CalificacionesServiciosModel->promedio_calificaciones_producto($servicio->ID_SERVICIO);
                      $cantidad = $this->CalificacionesServiciosModel->conteo_calificaciones_producto($servicio->ID_SERVICIO);
                      ?>
                        <ul class="rating">
                          <?php $estrellas = round($promedio['CALIFICACION_ESTRELLAS']); $estrellas_restan= 5-$estrellas; ?>
                          <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                            <li class="fa fa-star"></li>
                          <?php } ?>
                          <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                            <li class="far fa-star"></li>
                          <?php } ?>
                          <li class="text-dark">(<?php echo $cantidad; ?> calif)</li>
                        </ul>
                        <h3 class="title <?php echo 'text'.$primary; ?>" title="<?php echo $titulo; ?>"><?php echo word_limiter($titulo,10); ?></h3>
                    </div>
                </div>
    	    		</li>
              <?php } ?>
            </ul>
          </div>
        </section>
        <?php if($carrusel->ENLACE!=''){ ?>
        <div class="text-center">
          <a href="<?php echo $carrusel->ENLACE; ?>" class="btn btn-primary">Ver más</a>
        </div>
      <?php } ?>
        </div>
      </div>
    </div>
  </div>
<?php $no_carrusel++; } ?>
<div class="fila bg-light py-3 mb-3">
  <div class="row justify-content-center">
    <div class="col-9">
      <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-3">
            <!-- Start Blurb -->
            <div class="row mb-2">
                <div class="col text-center">
                    <div class="rounded-circle text-info d-inline-block">
                        <i class="fa fa-truck fa-2x m-3 p-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <strong>Envío gratis</strong><br>
                    en productos seleccionados
                </div>
            </div>
            <!-- End Blurb -->
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3">
            <!-- Start Blurb -->
            <div class="row mb-2">
                <div class="col text-center">
                    <div class="rounded-circle text-info d-inline-block">
                        <i class="fa fa-money-bill-wave fa-2x m-3 p-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <strong>Métodos de pago</strong><br>
                    Efectivo, depósitos bancarios, PayPal
                </div>
            </div>
            <!-- End Blurb -->
        </div>

        <div class="col-md-3 col-lg-3 col-xl-3">
            <!-- Start Blurb -->
            <div class="row mb-2">
                <div class="col text-center">
                    <div class="rounded-circle text-info d-inline-block">
                        <i class="fab fa-paypal fa-2x m-3 p-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <strong>Meses sin intereses</strong><br>
                    Hasta 6 meses pagando con PayPal
                </div>
            </div>
            <!-- End Blurb -->
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3">
            <!-- Start Blurb -->
            <div class="row mb-2">
                <div class="col text-center">
                    <div class="rounded-circle text-info d-inline-block">
                        <i class="fa fa-shield-alt fa-2x m-3 p-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <strong>Compra segura</strong><br>
                    Garantia de compra y envio
                </div>
            </div>
            <!-- End Blurb -->
        </div>
      </div>
    </div>
  </div>
</div>
<!--
<div class="fila py-3 mb-3" id="Concursos">
  <div class="row">
    <div class="col text-center">
      <a href="https://www.abanicoytu.com/publicacion/bases-concurso-por-un-planeta-limpio">
      <img src="<?php echo base_url('assets/global/img/registro_concurso_tortuga_2.jpg'); ?>" width="900" alt="">
      </a>
    </div>
  </div>
</div>
-->
<!--
<div class="icono-flotante" style="left: <?php echo random_int(0, 90) ?>%">
<img src="<?php echo base_url('assets/global/img/corazon.png'); ?>" width="100px" alt="">
</div>
-->

<!-- Modal de flujos -->

<!-- Modal -->
<div class="modal fade" id="ModalAyuda" tabindex="-1" role="dialog" aria-labelledby="ModalAyuda" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-question-circle"></i> Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">

          <div class="linea-colores-delgada">
            <div class="barra-color barra-azul"></div>
            <div class="barra-color barra-rosa"></div>
            <div class="barra-color barra-amarillo"></div>
            <div class="barra-color barra-verde"></div>
            <div class="barra-color barra-morado"></div>
          </div>
        <!-- Slider Ayuda-->
        <div id="carouselAyuda" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselAyuda" data-slide-to="0" class="active"></li>
            <li data-target="#carouselAyuda" data-slide-to="1"></li>
            <li data-target="#carouselAyuda" data-slide-to="2"></li>
            <li data-target="#carouselAyuda" data-slide-to="3"></li>
            <li data-target="#carouselAyuda" data-slide-to="4"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo1.1.png'); ?>" alt="Registro paso 1">
              <div class="carousel-caption d-none d-md-block">
                <h5>Paso 1</h5>
                <p>En la barra de navegación superior da click en el menú "Usuarios".</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo1.2.png'); ?>" alt="Registro paso 2">
              <div class="carousel-caption d-none d-md-block">
                <h5>Paso 2</h5>
                <p>Haz clic en la opción, Registro.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo1.3.png'); ?>" alt="Registro paso 3">
              <div class="carousel-caption d-none d-md-block">
                <h5>Paso 3</h5>
                <p>Llena el formulario de registro con todos tus datos.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo1.4.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo1.5.png'); ?>" alt="Registro paso 5">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselAyuda" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselAyuda" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
