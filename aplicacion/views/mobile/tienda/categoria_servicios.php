<?php
  if(isset($categoria['CATEGORIA_NOMBRE'])){
    $titulo_categoria = $categoria['CATEGORIA_NOMBRE'];
  }else{
    $titulo_categoria = 'TODOS LOS SERVICIOS';
  }
  if(isset($_GET['Busqueda'])){
    $titulo_categoria = 'Resultados para tu Busqueda';
  }
?>

<div class="bxInfoContent clr1 py-4">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <!-- <h1 class="h4 text-center pb-3"> <i class="fa fa-tools mr-2"></i> <?php echo $titulo_categoria; ?></h1> -->
        <div class="col-12">
          <ol class="breadcrumb vistaMovil">
            <li class="breadcrumb-item"><a href="http://localhost/abanico-master/">Inicio</a></li>
            <li class="breadcrumb-item active text-primary " aria-current="page">Todos los servicios</li>
          </ol>
        </div>
      </div>
      <div class="col-12">

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
        <div class="servicios">
          <?php $galeria = $this->GaleriasServiciosModel->galeria_portada($servicio->ID_SERVICIO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
          <a class="portada" href="<?php echo base_url('servicio?id='.$servicio->ID_SERVICIO); ?>" class="enlace-principal-servicio">
            <div class="rounded-circle" style="background-image:url(<?php echo base_url($ruta_portada); ?>)"> </div>
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
              <li class="fa fa-star"></li>
            <?php } ?>
              <li class="text-dark">(<?php echo $cantidad; ?> calif)</li>
            </ul>
            <h3 class="title text-primary"><?php echo $titulo; ?> </h3>
            <div class="border-top mt-3 pt-3">
              <p><?php echo $descripcion_corta; ?></p>
            </div>
            <div class="">
              <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                <a href="<?php echo base_url('servicio/favorito?id='.$servicio->ID_SERVICIO); ?>" class="btn btn-outline-primary" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
              <?php }else{ ?>
                <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$servicio->ID_SERVICIO)); ?>" class="btn btn-outline-primary" title="Quitar de Favoritos"> <span class="fa fa-heart"></span> </a>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php } ?>

       </div>

    </div>
  </div>
</div>
