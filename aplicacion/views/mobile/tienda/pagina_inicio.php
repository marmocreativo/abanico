<!-- Slider -->
<div class="slideInicio">
  <ul class="slides">
    <?php $i = 0; foreach($slides as $slide){ ?>
    <li>
      <img src="contenido/img/slider/<?php echo $slide->SLIDE_IMAGEN_MOVIL; ?>">
    </li>
    <?php ++$i; }  ?>
  </ul>
</div>

<div class="post-menu py-4">
  <div class="container">
    <div class="row">
      <div class="col-4">
        <a href="<?php echo base_url('categoria/servicios'); ?>" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary mr-2"> <span class="fa fa-tools"></span> </div>
          <div class="car-titulo"><?php echo $this->lang->line('inicio_menu_destacados_servicios'); ?></div>
        </a>
      </div>
      <div class="col-4">
        <a href="<?php echo base_url('categoria'); ?>"  class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary mr-2"> <span class="fa fa-box"></span> </div>
          <div class="car-titulo"><?php echo $this->lang->line('inicio_menu_destacados_productos'); ?></div>
        </a>
      </div>
      <div class="col-4">
        <a href="<?php echo base_url('usuario/registrar'); ?>" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary mr-2"> <span class="fa fa-handshake"></span> </div>
          <div class="car-titulo"><?php echo $this->lang->line('inicio_menu_destacados_unete'); ?></div>
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
                 <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO_LISTA,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
               <?php } ?>
               <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>
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

<div class="fila py-4">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <h4 class="pb-3">Datos Curiosos</h4>
          </div>
          <div class="col-2">
            <img src="assets/global/img/curioso.jpg" class="imagen-curioso mt-4" alt="">
          </div>
          <div class="col-10">
            <div class="dato-curioso dato-ganador mb-3">
              <h5>Autor</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tinci dunt ut laoreet dolore magna aliquam erat</p>
            </div>
          </div>
          <div class="col-12">
            <?php for($i=0; $i<=2; $i++){ ?>
              <div class="dato-curioso">
                <h5>Autor</h5>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tinci dunt ut laoreet dolore magna aliquam erat</p>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="row">
          <div class="col-6">
            <div class="bxImg">
              <img src="assets/global/img/ganador.jpg" class="img-fluid" alt="">
            </div>
          </div>
          <div class="col-6">
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
