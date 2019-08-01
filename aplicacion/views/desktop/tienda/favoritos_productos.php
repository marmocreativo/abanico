<?php

    $titulo_categoria = 'Mis Favoritos';

?>
<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row">
      <div class="col">
        <h5> <i class="fa fa-heart"></i> Servicios Favoritos</h5>
        <div class="card-deck">
          <?php foreach($servicios as $servicio){ ?>
            <?php
              // Variables de Traducción
              if($_SESSION['lenguaje']['iso']==$servicio->LENGUAJE){
                $titulo = $servicio->SERVICIO_NOMBRE;
                $descripcion_corta = $servicio->SERVICIO_DESCRIPCION;
              }else{
                $traduccion = $this->TraduccionesModel->lista($servicio->ID_SERVICIO,'servicio',$_SESSION['lenguaje']['iso']);
                if(!empty($traduccion)){
                  $titulo = $traduccion['TITULO'];
                  $descripcion_corta = $traduccion['DESCRIPCION_CORTA'];
                }else{
                  $titulo = $servicio->SERVICIO_NOMBRE;
                  $descripcion_corta = $servicio->SERVICIO_DESCRIPCION;
                }
              }
            ?>
            <div class="col-xl-3 col-md-3 col-6 mb-3">
              <div class="cuadricula-productos">
                <?php $galeria = $this->GaleriasServiciosModel->galeria_portada($servicio->ID_SERVICIO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                <a href="<?php echo base_url('servicio?id='.$servicio->ID_SERVICIO); ?>" class="enlace-principal-servicio">
                  <div class="portada-servicios img-thumbnail rounded-circle" style="background-image:url(<?php echo base_url($ruta_portada); ?>)"> </div>
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
                      <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h3>
                      <div class="border-top mt-3 pt-3">
                        <?php echo $descripcion_corta; ?>
                      </div>
                      <div class="">
                          <a href="<?php echo base_url('servicio/quitar_favorito?id='.$servicio->ID_SERVICIO); ?>" class="btn btn-outline-primary" title="Quitar de Favoritos"> <span class="fa fa-heart-broken"></span> </a>
                      </div>
                  </div>
              </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
    <div class="row border-top pt-3">
      <div class="col">
        <h5> <i class="fa fa-heart"></i> Productos Favoritos</h5>
        <div class="card-deck">
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
            <div class="col-xl- col-md-3 col-6 mb-3">
              <div class="cuadricula-productos">
                <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="enlace-principal">
                  <div class="imagen-producto">
                    <div class="contenedor-etiquetas">
                      <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                        <span class="etiqueta-1">Méx</span>
                      <?php } ?>
                      <?php if(strtotime($producto->PRODUCTO_FECHA_PUBLICACION) > strtotime('-'.$op['dias_productos_nuevos'].' Days')){ ?>
                        <span class="etiqueta-2">Nuevo</span>
                      <?php } ?>
                      <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO_LISTA<$producto->PRODUCTO_PRECIO){ ?>
                        <span class="etiqueta-3">Oferta</span>
                      <?php } ?>
                    </div>
                      <span  style="background-image:url(<?php echo base_url($ruta_portada); ?>)"></span>
                      <div class="overlay-producto <?php echo 'bg'.$primary; ?>"></div>
                      <div class="boton-ver">
                        <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Ver Producto"> <span class="fa fa-eye"></span> </a>
                        <a href="<?php echo base_url('producto/quitar_favorito?id='.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Quitar de Favoritos"> <span class="fa fa-heart-broken"></span> </a>
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
                      <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h3>
                      <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)){ ?>
                        <div class="price-list"> $<?php echo $producto->PRODUCTO_PRECIO_LISTA; ?> <small><?php echo $producto->PRODUCTO_DIVISA_DEFAULT; ?> </small></div>
                      <?php } ?>
                      <div class="price"> $<?php echo $producto->PRODUCTO_PRECIO; ?> <small><?php echo $producto->PRODUCTO_DIVISA_DEFAULT; ?> </small></div>
                  </div>
              </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
