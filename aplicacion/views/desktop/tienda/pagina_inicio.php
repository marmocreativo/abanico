
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
      <div class="col border-left">
        <a href="#Concursos" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary"> <span class="fa fa-gift"></span> </div>
          <div class="car-titulo">Concurso</div>
        </a>
      </div>
    </div>
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
    if($carrusel->ORIGEN!=''){
      $parametros_and['PRODUCTO_ORIGEN'] = $carrusel->ORIGEN;
    }
    if($carrusel->ARTESANAL!=''){
      $parametros_and['PRODUCTO_ARTESANAL'] = $carrusel->ARTESANAL;
    }

   ?>

  <div class="fila py-5 <?php if($no_carrusel % 2 == 0){ echo "fila-gris";  }else{ echo 'bg-light'; }  ?>">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <h2 class="car-titulo text-center text-primary pb-3 mb-3"><img alt="" src="<?php echo base_url(); ?>assets/global/img/decor_izq.png" width="25px"><?php echo $carrusel->TITULO ?><img alt="" src="<?php echo base_url(); ?>assets/global/img/decor_der.png" width="25px"></h2>
          <h4 class="text-center border-top py-3 mb-3"><?php echo $carrusel->DESCRIPCION ?></h4>
          <section class="slider">
          <div class="flexslider carousel">
            <ul class="slides">
                <?php
                switch ($carrusel->TIPO) {
                  case 'todos':
                    $productos = $this->ProductosModel->lista_activos($parametros_or,$parametros_and,'',$carrusel->ORDEN_PRODUCTOS,$carrusel->LIMITE);

                    break;
                  case 'incluyente':
                    $productos = $this->ProductosModel->lista_categoria_activos($parametros_or,$parametros_and,$id_categorias,$carrusel->ORDEN_PRODUCTOS,$carrusel->LIMITE);

                    break;
                  case 'excluyente':
                    $productos = $this->ProductosModel->lista_no_categoria_activos($parametros_or,$parametros_and,$id_categorias,$carrusel->ORDEN_PRODUCTOS,$carrusel->LIMITE);

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
            </ul>
          </div>
        </section>
        <?php if($carrusel->ENLACE!=''){ ?>
        <div class="text-center">
          <a href="<?php echo $carrusel->ENLACE; ?>" class="btn btn-primary btn-lg">Ver más</a>
        </div>
      <?php } ?>
        </div>
      </div>
    </div>
  </div>
<?php $no_carrusel++; } ?>


<div class="fila fila-gris p-0" id="Concursos" style="min-height:400px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8 cont-ganador">
            <div class="contenedor-ganador text-center" style="padding-top:10%; padding-bottom:10%">
              <div class="" style="font-size:1em; line-height:1.5em;">
                <img cl src="<?php echo base_url(); ?>assets/global/img/abanico_flor_arriba.png" alt="Logo" width="50px"><br>
                <div style="text-align:center; line-height:2.5em;">
                  <h1>Gracias por participar en nuestro concurso inaugural</h1>
                  <h5 class="my-4">La frase completa fue:</h5>
                  <h3>"El dinosaurio se cubría del sol con una sombrilla y su novia la tortuga se refrescaba con su abanico mientras sorprendidos observaban al pungüino tomando su café."</h3>
                </div>
                <img src="<?php echo base_url(); ?>assets/global/img/abanico_flor_abajo.png" alt="Logo" width="50px">
              </div>
            </div>
          </div>
      <div class="col-4 py-5 border border-primary-6 my-4 text-center" style="border-style:dashed !important">
        <h4>Muchas Felicidades a Alejandro Marquina.</h4>
        <h5 class="my-4">Quien encontró y ordenó la frase a las 5:30:48 pm.</h5>
      </div>
    </div>
  </div>
</div>

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
