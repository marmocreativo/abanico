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

        <?php for($i=0; $i<=1; $i++){ ?>
        <div class="servicios">
          <a class="portada" href="http://localhost/abanico-master/servicio?id=10" class="enlace-principal-servicio">
            <div class="rounded-circle" style="background-image:url()"> </div>
          </a>
          <div class="product-content text-center">
            <ul class="rating">
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
              <li class="far fa-star"></li>
              <li class="far fa-star"></li>
              <li class="text-dark">(1 calif)</li>
            </ul>
            <h3 class="title text-primary">Redaccion y correccion de textos </h3>
            <div class="border-top mt-3 pt-3">
              <p>Redacto, reviso y corrijo textos científicos y filosóficos</p>
            </div>
            <div class="">
                <a href="#" class="btn btn-outline-primary" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
            </div>
          </div>
        </div>
        <?php } ?>

       </div>

    </div>
  </div>
</div>
