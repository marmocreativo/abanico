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
          <div class="texto-slide">
            <h1><?php echo $slide->SLIDE_TITULO; ?></h1>
            <h2><?php echo $slide->SLIDE_SUBTITULO; ?></h2>
            <h3><?php echo $slide->SLIDE_BOTON; ?></h3>
          </div>
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

<!-- Inicia el cuerpo del texto -->

<div class="fila fila-gris py-4 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="h4 text-center pb-3"><?php echo $this->lang->line('inicio_productos_destacados_titulo'); ?></h2>
      </div>
    </div>
  </div>

   <div class="sliderProductos">
     <ul class="slides">

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
         <div class="card">
           <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>">
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
                 }else{
                   $precio_lista = $_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO_LISTA;
                   $precio_venta = $_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO;
                 }
               }else{
                 $precio_lista = $producto->PRODUCTO_PRECIO_LISTA;
                 $precio_venta = $producto->PRODUCTO_PRECIO;
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
                 <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_lista,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
               <?php } ?>
               <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_venta,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>
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
   <div class="container">
     <div class="row">
       <div class="col-12">
         <h2 class="h4 text-center pb-3"><?php echo $this->lang->line('inicio_productos_recientes_titulo'); ?></h2>
       </div>
     </div>
   </div>
   <div class="sliderProductos">
     <ul class="slides">

       <?php foreach($productos_recientes as $producto){ ?>
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
         <div class="card">
           <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>">
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
                 }else{
                   $precio_lista = $_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO_LISTA;
                   $precio_venta = $_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO;
                 }
               }else{
                 $precio_lista = $producto->PRODUCTO_PRECIO_LISTA;
                 $precio_venta = $producto->PRODUCTO_PRECIO;
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
                 <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_lista,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
               <?php } ?>
               <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_venta,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>
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

<!--datos Curiosos-->

<div class="fila py-4" id="Concursos">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col">
            <h3>Sorteo Mensual</h3>
            <?php if($this->PremiosModel->verificar_ganador()){ $premio = $this->PremiosModel->ultimo_ganador(); ?>
            <div class="row">
              <div class="col">
                <img src="contenido/img/publicaciones/<?php echo $premio['PREMIO_IMAGEN']; ?>" class="img-fluid" alt="">
              </div>
              <div class="col">
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
                  <div class="col">
                    <img src="contenido/img/publicaciones/<?php echo $premio['PREMIO_IMAGEN']; ?>" class="img-fluid" alt="">
                  </div>
                  <div class="col">
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
                </div>
              <?php }else{ $premios = $this->PremiosModel->lista(['PREMIO_GANADOR'=>0],'PREMIO_FECHA_DISPONIBLE DESC',1);
              foreach($premios as $premio){
              ?>
                <div class="row">
                  <div class="col">
                    <img src="contenido/img/publicaciones/<?php echo $premio->PREMIO_IMAGEN; ?>" class="img-fluid" alt="">
                  </div>
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
                </div>
              <?php } ?>
            <?php  } // termina condicional de pedido ganador  ?>
          <?php } ?>
          </div>
        </div>
      </div>

      <div class="col-12 mt-3 pt-3 border-top">
        <h3>Datos Curiosos</h3>
        <a href="https://twitter.com/intent/tweet?button_hashtag=AbanicoSiempreLoMejor&ref_src=twsrc%5Etfw" class="twitter-hashtag-button" data-show-count="false">Tweet #AbanicoSiempreLoMejor</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <a class="twitter-timeline" href="https://twitter.com/stMaRmO/timelines/1106610018290417664?ref_src=twsrc%5Etfw">AbanicoDatosCuriosos - Curated tweets by stMaRmO</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      </div>

    </div>
  </div>
</div>
