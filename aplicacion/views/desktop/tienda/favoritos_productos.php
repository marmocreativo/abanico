<?php

    $titulo_categoria = 'Mis Favoritos';

?>
<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row">
      <div class="fila">
        <h1 class="h3 border-bottom pb-3"> <i class="fa fa-heart"></i> <?php echo $titulo_categoria; ?></h1>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="card-deck">
          <?php foreach($productos as $producto){ ?>
            <div class="col-xl- col-md-3 col-6 mb-3">
              <div class="cuadricula-productos">
                <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="enlace-principal">
                  <div class="imagen-producto">
                    <div class="contenedor-etiquetas">
                      <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                        <span class="etiqueta-1">Mex</span>
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
                      <ul class="rating">
                          <li class="fa fa-star"></li>
                          <li class="fa fa-star"></li>
                          <li class="fa fa-star"></li>
                          <li class="far fa-star"></li>
                          <li class="far fa-star"></li>
                      </ul>
                      <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $producto->PRODUCTO_NOMBRE; ?></h3>
                      <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)){ ?>
                        <div class="price-list"> $<?php echo $producto->PRODUCTO_PRECIO_LISTA; ?></div>
                      <?php } ?>
                      <div class="price"> $<?php echo $producto->PRODUCTO_PRECIO; ?></div>
                  </div>
              </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
