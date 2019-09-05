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
        <div class="contenedor-texto-slide">
            <a href="<?php echo $slide->SLIDE_ENLACE; ?>">
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
              <a href="<?php echo $slide->SLIDE_ENLACE; ?>" class="btn btn-outline-dark btn-sm"> <?php echo $slide->SLIDE_BOTON; ?></a>
            </div>
        <?php } ?>
          </div>
          </a>
        </div>
        <img class="d-block w-100" src="contenido/img/slider/<?php echo $slide->SLIDE_IMAGEN_MOVIL; ?>">
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

<div class="post-menu py-4">
  <div class="container">
    <div class="row">
      <div class="col-6">
        <a href="<?php echo base_url('categoria/servicios'); ?>" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary mr-2"> <span class="fa fa-tools"></span> </div>
          <div class="car-titulo"><?php echo $this->lang->line('inicio_menu_destacados_servicios'); ?></div>
        </a>
      </div>
      <div class="col-6">
        <a href="<?php echo base_url('categoria'); ?>"  class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary mr-2"> <span class="fa fa-box"></span> </div>
          <div class="car-titulo"><?php echo $this->lang->line('inicio_menu_destacados_productos'); ?></div>
        </a>
      </div>
      <div class="col-6 mt-3">
        <a href="<?php echo base_url('usuario/registrar'); ?>" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary mr-2"> <span class="fa fa-handshake"></span> </div>
          <div class="car-titulo"><?php echo $this->lang->line('inicio_menu_destacados_unete'); ?></div>
        </a>
      </div>
      <div class="col-6 mt-3">
        <a href="#Concursos" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary"> <span class="fa fa-gift"></span> </div>
          <div class="car-titulo">Concurso</div>
        </a>
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

   <div class="fila fila-gris py-4 pb-5">
     <div class="container">
       <div class="row">
         <div class="col-12">
           <h2 class="h4 text-center pb-3"><?php echo $carrusel->TITULO; ?></h2>
           <h4 class="text-center border-top py-3 mb-3"><?php echo $carrusel->DESCRIPCION ?></h4>
         </div>
       </div>
     </div>
      <div class="sliderProductos">
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
          <li>
            <div class="card <?php echo $visible; ?>">
              <a href="<?php echo base_url('producto/'.$producto->PRODUCTO_URL); ?>">
                <div class="imagen-producto">
                  <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                  <img class="spanImg" src="<?php echo base_url($ruta_portada); ?>"></img>
                  <div class="contenedor-etiquetas">
                    <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                      <span class="etiqueta-1">Méx</span>
                    <?php } ?>
                    <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                      <span class="etiqueta-3">Oferta</span>
                    <?php } ?>
                  </div>
                </div>
                <div class="product-content text-center py-3">
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
                  <h4 class="title <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h4>
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
              </a>
              <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
              <a href="<?php echo base_url('producto/favorito?id='.$producto->ID_PRODUCTO); ?>" class="btnFavorito" title="Añadir a Favoritos"> <span class="far fa-heart text-primary-6"></span> </a>
              <?php }else{ ?>
                <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$producto->ID_PRODUCTO)); ?>" class="btnFavorito" title="Añadir a Favoritos"> <span class="far fa-heart text-primary-6"></span> </a>
              <?php } ?>
            </div>
          </li>
          <?php } ?>
        </ul>
      </div>
   </div>


 <?php $no_carrusel++; } ?>

<!--datos Curiosos-->

<div class="fila py-4" id="Concursos">
  <div class="container">
    <div class="row">
      <div class="col-12 cont-ganador">
        <?php if($this->PremiosModel->verificar_ganador()){ $premio = $this->PremiosModel->ultimo_ganador(); ?>
        <div class="row">
          <div class="col-12 d-flex align-items-center">
            <div class="contenedor-ganador text-center">
              <div class="container-fluid head-ganador">
                <div class="titulo-ganador">
                  Gran concurso por inauguración
                </div>
              </div>
              <div class="nombre-ganador" style="font-size:1em; line-height:1.5em;">
                <a href="https://abanicoytu.com/publicacion/bases-concurso-inaugural">
                <img cl src="<?php echo base_url(); ?>assets/global/img/abanico_flor_arriba.png" alt="Logo" width="50px"><br>
                <div style="text-align:left; line-height:2.5em;">
                <i class="fa fa-check"> </i> Regístrate del 8 de julio al 23 de septiembre de 2019.<br>
                <i class="fa fa-check"> </i> El 24 de septiembre inicia sesión. <br>
                <i class="fa fa-check"> </i> Encuentra las palabras escondidas dentro de la descripción de los productos.<br>
                <i class="fa fa-check"> </i> Da doble click en las palabras y júntalas en la parte superior de la pantalla<br>
                <i class="fa fa-check"> </i> Ordena las palabras que encontraste hasta formar la frase correcta<br>
                <i class="fa fa-check"> </i> ¡ LISTO ! TU puedes ser el ganador de los $10,000.00 MN<br>
              </div>
              <h4>UNO NUNCA SABE</h4>

                <!--
                <?php $ganador = $this->UsuariosModel->detalles($premio['PREMIO_GANADOR']); ?>
                Felicidades<br><b><?php echo $ganador['USUARIO_NOMBRE'].' '.$ganador['USUARIO_APELLIDOS']; ?></b><br>
                <-->
                <img src="<?php echo base_url(); ?>assets/global/img/abanico_flor_abajo.png" alt="Logo" width="50px">
                </a>
              </div>
              <div class="premio-ganador text-primary">
                <!--
                Ganador de un <?php echo $premio['PREMIO_TITULO']; ?>
              -->
              </div>
            </div>
          </div>

            <div class="col">
              <div class="img-ganador">
                <img src="contenido/img/publicaciones/<?php echo $premio['PREMIO_IMAGEN']; ?>" class="img-fluid" alt="">
              </div>
            </div>
        </div>
      <?php }else{ ?>
        <?php
          $pedido_ganador = $this->PedidosModel->pedido_ganador(date('Y-m-d'));
          if(!empty($pedido_ganador)){
            $premios = $this->PremiosModel->lista(['PREMIO_GANADOR'=>0],'PREMIO_FECHA_DISPONIBLE DESC',1);
            foreach($premios as $premio){
               $this->PremiosModel->guardar_ganador($premio->ID_PREMIO,$pedido_ganador['ID_USUARIO']);
            }
          ?>
          <?php $premio = $this->PremiosModel->ultimo_ganador(); ?>
            <div class="row">
              <div class="col-12">
                <div class="contenedor-ganador">

                  <div class="fecha-ganador">
                    <span><?php echo date('d', strtotime($premio['PREMIO_FECHA_DISPONIBLE'])); ?></span> <?php echo date('M', strtotime($premio['PREMIO_FECHA_DISPONIBLE'])); ?> <?php echo date('Y', strtotime($premio['PREMIO_FECHA_DISPONIBLE'])); ?>
                  </div>
                  <div class="titulo-ganador">
                    Nuestro Ganador Mensual
                  </div>
                  <div class="nombre-ganador">
                    <?php $ganador = $this->UsuariosModel->detalles($premio['PREMIO_GANADOR']); ?>
                    Felicidades<br><b><?php echo $ganador['USUARIO_NOMBRE'].' '.$ganador['USUARIO_APELLIDOS']; ?></b>
                  </div>
                  <div class="premio-ganador">
                    Ganador de un <?php echo $premio['PREMIO_TITULO']; ?>
                  </div>
                </div>
              </div>

                <div class="col">
                  <img src="contenido/img/publicaciones/<?php echo $premio['PREMIO_IMAGEN']; ?>" class="img-fluid" alt="">
                </div>
            </div>
          <?php }else{ $premios = $this->PremiosModel->lista(['PREMIO_GANADOR'=>0],'PREMIO_FECHA_DISPONIBLE DESC',1);
          foreach($premios as $premio){
          ?>
            <div class="row">
              <div class="col">
                <div class="contenedor-ganador">
                  <p> <small>Aún no Hay Ganador: Próximo concurso</small> </p>
                  <div class="fecha-ganador">
                    <span><?php echo date('d', strtotime($premio->PREMIO_FECHA_DISPONIBLE)); ?></span> <?php echo date('M', strtotime($premio->PREMIO_FECHA_DISPONIBLE)); ?> <?php echo date('Y', strtotime($premio->PREMIO_FECHA_DISPONIBLE)); ?>
                  </div>
                  <div class="titulo-ganador">
                    Compra y Gana un  <?php echo $premio->PREMIO_TITULO; ?>
                  </div>
                </div>
              </div>

                <div class="col-12">
                  <img src="contenido/img/publicaciones/<?php echo $premio->PREMIO_IMAGEN; ?>" class="img-fluid" alt="">
                </div>
            </div>
          <?php } ?>
        <?php  } // termina condicional de pedido ganador  ?>
      <?php } ?>
      </div>

      <div class="col-12 mt-3 pt-3 border-top">
        <div class="col d-flex align-items-center">
          <div class="contenedor-ganador text-center">
            <img src="<?php echo base_url('assets/global/img/borrego_03.jpg'); ?>" class="img-fluid" alt="">
          </div>
          <!--
        <div class="contenedor-ganador text-center">
          <div class="container-fluid head-ganador">
            <div class="titulo-ganador">
              Próximamente
            </div>
          </div>
          <div class="nombre-ganador">
            <img cl src="<?php echo base_url(); ?>assets/global/img/abanico_flor_arriba.png" alt="Logo" width="50px"><br>
            Concursos en redes sociales<br>
            <!- -
            <?php $ganador = $this->UsuariosModel->detalles($premio['PREMIO_GANADOR']); ?>
            Felicidades<br><b><?php echo $ganador['USUARIO_NOMBRE'].' '.$ganador['USUARIO_APELLIDOS']; ?></b><br>
            <- ->
            <img src="<?php echo base_url(); ?>assets/global/img/abanico_flor_abajo.png" alt="Logo" width="50px">
          </div>
          <div class="premio-ganador text-primary">

            <!- -
            Ganador de un <?php echo $premio['PREMIO_TITULO']; ?>
          - ->
          </div>
        </div>
      </div>
      </div>
    -->

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
