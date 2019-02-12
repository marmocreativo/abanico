
<!-- Slider -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="contenido/img/slider/sli-1.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="contenido/img/slider/sli-2.jpg" alt="Second slide">
      </div>
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
<div class="post-menu col-8 py-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col border-right">
        <a href="<?php echo base_url('categoria/servicios'); ?>" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary"> <span class="fa fa-tools"></span> </div>
          <div class="car-titulo"><?php echo $this->lang->line('inicio_menu_destacados_servicios'); ?></div>
        </a>
      </div>
      <div class="col">
        <a href="<?php echo base_url('categoria'); ?>"  class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary"> <span class="fa fa-box"></span> </div>
          <div class="car-titulo"><?php echo $this->lang->line('inicio_menu_destacados_productos'); ?></div>
        </a>
      </div>
      <div class="col border-left">
        <a href="<?php echo base_url('usuario/registrar'); ?>" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary"> <span class="fa fa-handshake"></span> </div>
          <div class="car-titulo"><?php echo $this->lang->line('inicio_menu_destacados_unete'); ?></div>
        </a>
      </div>
    </div>
  </div>
</div>


<!-- Inicia el cuerpo del texto -->

<<<<<<< HEAD
<div class="container-fluid py-4 d-none">
  <div class="row">
    <div class="col-3">
      <div class="contenedor-servicios">
        <div class="contenedor-servicios-titulo">
          <h4>Servicios</h4>
        </div>
        <a href="<?php echo base_url('categoria/servicios'); ?>" class="btn btnblock btn-primary btn-lg">Ver Servicios</a>
      </div>
    </div>
    <div class="col-9">
      <div class="row">
        <div class="col-9">
          <div class="row">
            <div class="col-8">
              <div class="contenedor-destacado">
                <img src="assets/global/img/destacado-2.jpg" class="img-fluid" alt="">
              </div>
            </div>
            <div class="col-4">
              <div class="contenedor-destacado">
                <img src="assets/global/img/destacado-1.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="contenedor-destacado">
                <img src="assets/global/img/destacado-4.jpg" class="img-fluid" alt="">
              </div>
            </div>
            <div class="col-8">
              <div class="contenedor-destacado">
                <img src="assets/global/img/destacado-3.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="contenedor-destacado">
            <img src="assets/global/img/destacado-5.jpg" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- inician sliders -->
  <div class="row">
    <div class="col-2"></div>
    <div class="col-3">
      <div class="slider-pro" id="my-slider">
        <div class="sp-slides">
          <!-- Slide 1 -->
          <div class="sp-slide">
            <img class="sp-image" src="path/to/image1.jpg"/>
          </div>

          <!-- Slide 2 -->
          <div class="sp-slide">
            <p>Lorem ipsum dolor sit amet</p>
          </div>

          <!-- Slide 3 -->
          <div class="sp-slide">
            <h3 class="sp-layer">Lorem ipsum dolor sit amet</h3>
            <p class="sp-layer">consectetur adipisicing elit</p>
          </div>
        </div>
</div>
    </div>
    <div class="col-2"></div>
    <div class="col-3"></div>
    <div class="col-2"></div>
  </div>
</div>

=======
>>>>>>> 2a52a00aade94e55ba2549d8ae684f3b64790334
<div class="fila fila-gris">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <h2 class="h3 text-center border-bottom pb-3 mb-3"><?php echo $this->lang->line('inicio_productos_destacados_titulo'); ?></h2>
        <section class="slider">
        <div class="flexslider carousel">
          <ul class="slides">
            <?php foreach($productos as $producto){ ?>
            <li>
              <div class="cuadricula-productos">
                <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="enlace-principal">
                  <div class="imagen-producto">
                    <div class="contenedor-etiquetas">
                      <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                        <span class="etiqueta-1"><?php echo $this->lang->line('etiquetas_productos_mexico'); ?></span>
                      <?php } ?>
                      <?php if(strtotime($producto->PRODUCTO_FECHA_PUBLICACION) > strtotime('-'.$op['dias_productos_nuevos'].' Days')){ ?>
                        <span class="etiqueta-2 <?php echo 'bg'.$primary; ?>"><?php echo $this->lang->line('etiquetas_productos_nuevo'); ?></span>
                      <?php } ?>
                      <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                        <span class="etiqueta-3"><?php echo $this->lang->line('etiquetas_productos_oferta'); ?></span>
                      <?php } ?>
                    </div>
                      <span  style="background-image:url(<?php echo base_url($ruta_portada); ?>)"></span>
                      <div class="overlay-producto <?php echo 'bg'.$primary; ?>"></div>
                      <div class="boton-ver">
                        <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Ver Producto"> <span class="fa fa-eye"></span> </a>
                      <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                        <a href="<?php echo base_url('producto/favorito?id='.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$producto->ID_PRODUCTO)); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                      <?php } ?>
                      </div>
                  </div>
                  </a>
                  <div class="product-content text-center">
                    <?php
                    $promedio = $this->CalificacionesModel->promedio_calificaciones_producto($producto->ID_PRODUCTO);
                    $cantidad = $this->CalificacionesModel->conteo_calificaciones_producto($producto->ID_PRODUCTO);
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
                      <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $producto->PRODUCTO_NOMBRE; ?></h3>
                      <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                        <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO_LISTA,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
                      <?php } ?>
                      <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>
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

<div class="fila">
  <div class="container-fluid px-5">
    <div class="row">
      <div class="col">
        <div class="row">
          <div class="col-4">
            <h4>Datos Curiosos</h4>
            <img src="assets/global/img/curioso.jpg" class="img-fluid imagen-curioso" alt="">
          </div>
          <div class="col-8">
            <div class="dato-curioso dato-ganador">
              <h5>Autor</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tinci dunt ut laoreet dolore magna aliquam erat</p>
            </div>
            <?php for($i=0; $i<=2; $i++){ ?>
              <div class="dato-curioso">
                <h5>Autor</h5>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tinci dunt ut laoreet dolore magna aliquam erat</p>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="row">
          <div class="col">
            <img src="assets/global/img/ganador.jpg" class="img-fluid" alt="">
          </div>
          <div class="col">
            <div class="contenedor-ganador">

              <div class="fecha-ganador">
                <span>18</span> Noviembre 2018
              </div>
              <div class="titulo-ganador">
                Nuestro Ganador Mensual
              </div>
              <div class="nombre-ganador">
                Felicidades Penélope Carrasco
              </div>
              <div class="premio-ganador">
                Ganador de un Refractario
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
