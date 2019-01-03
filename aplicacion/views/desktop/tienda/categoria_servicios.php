<?php
  if(isset($categoria['CATEGORIA_NOMBRE'])){
    $titulo_categoria = $categoria['CATEGORIA_NOMBRE'];
  }else{
    $titulo_categoria = 'Todos los Servicios';
  }
  if(isset($_GET['Busqueda'])){
    $titulo_categoria = 'Resultados para tu Busqueda';
  }

?>
<div class="fila p-3" style="background:#eee;">
  <div class="container">
    <div class="row">
      <div class="fila">
        <h1 class="h3 border-bottom pb-3"> <i class="fa fa-tools"></i> <?php echo $titulo_categoria; ?></h1>
      </div>
    </div>
    <div class="row">
    <div class="col-2 d-none d-sm-block fila fila-gris">
        <div class="contenedor-filtros">

        </div>
      </div>
      <div class="col">
        <div class="card-deck">
          <?php foreach($servicios as $servicio){ ?>
            <div class="col-xl-4 col-md-3 col-6 mb-3">
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
                      <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $servicio->SERVICIO_NOMBRE; ?></h3>
                      <div class="border-top mt-3 pt-3">
                        <?php echo $servicio->SERVICIO_DESCRIPCION; ?>
                      </div>
                      <div class="">
                        <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                          <a href="<?php echo base_url('servicio/favorito?id='.$servicio->ID_SERVICIO); ?>" class="btn btn-outline-primary" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                        <?php }else{ ?>
                          <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$servicio->ID_SERVICIO)); ?>" class="btn btn-outline-primary" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                        <?php } ?>
                      </div>
                  </div>
              </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
