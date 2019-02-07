<?php

    $titulo_categoria = 'Mis Favoritos';

?>

<!-- termina favoritos responsivo -->

<div class="container ">
  <div class="row">

    <div class="col-12 mb-3">
     <h2 class="h5 text-center py-3 pt-4">Servicios favoritos</h2>
     <?php foreach($servicios as $servicio){ ?>
      <div class="card datosFavoritos p-2 mb-2">
        <a href="<?php echo base_url('servicio?id='.$servicio->ID_SERVICIO); ?>">
          <div class="row">
            <div class="col-3">
              <div class="bxImg">
                <?php $galeria = $this->GaleriasServiciosModel->galeria_portada($servicio->ID_SERVICIO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                <img class="spanImg" src="<?php echo base_url($ruta_portada); ?>"></img>
              </div>
            </div>
            <div class="col-7">
              <h4 class="h6 itle text-primary"><?php echo $servicio->SERVICIO_NOMBRE; ?></h4>
              <p class="price"><?php echo $servicio->SERVICIO_DESCRIPCION; ?></p>
            </div>
          </div>
        </a>
        <a href="<?php echo base_url('servicio/quitar_favorito?id='.$servicio->ID_SERVICIO); ?>" class="btnFavorito mt-4 mr-3" title="Eliminar de Favoritos"> <span class="fa fa-heart-broken text-primary-6"></span> </a>
      </div>
      <?php } ?>
    </div>

    <div class="col-12 mb-3">
     <h2 class="h5 text-center p-2 pb-3">Productos favoritos</h2>
     <?php foreach($productos as $producto){ ?>
      <div class="card datosFavoritos p-2 mb-2">
        <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>">
          <div class="row">
            <div class="col-3">
              <div class="bxImg">
                <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                <img class="spanImg" src="<?php echo base_url($ruta_portada); ?>"></img>
              </div>
            </div>
            <div class="col-7">
              <h4 class="h6 itle text-primary"><?php echo $producto->PRODUCTO_NOMBRE; ?></h4>
              <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO_LISTA,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
              <?php } ?>
              <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>
            </div>
          </div>
        </a>
        <a href="<?php echo base_url('producto/quitar_favorito?id='.$producto->ID_PRODUCTO); ?>" class="btnFavorito mt-4 mr-3" title="Quitar de Favoritos"> <span class="fa fa-heart-broken text-primary-6"></span> </a>
      </div>
      <?php } ?>
    </div>

  </div>
</div>

<!-- termina favoritos responsivo -->
