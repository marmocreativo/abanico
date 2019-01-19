<!-- Slider -->
<div class="slideInicio">
  <ul class="slides">
    <?php for($i=0; $i<=2; $i++){ ?>
    <li>
      <img src="https://picsum.photos/320/220/?random=<?php echo $i; ?>" alt="">
    </li>
    <?php } ?>
  </ul>
</div>

<div class="post-menu py-4">
  <div class="container">
    <div class="row">
      <div class="col-4">
        <a href="<?php echo base_url('categoria/servicios'); ?>" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary mr-2"> <span class="fa fa-tools"></span> </div>
          <div class="car-titulo">Servicios</div>
        </a>
      </div>
      <div class="col-4">
        <a href="<?php echo base_url('categoria'); ?>"  class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary mr-2"> <span class="fa fa-box"></span> </div>
          <div class="car-titulo">Productos</div>
        </a>
      </div>
      <div class="col-4">
        <a href="<?php echo base_url('usuario/registrar'); ?>" class="d-flex justify-content-center align-items-center">
          <div class="car-icono text-primary mr-2"> <span class="fa fa-handshake"></span> </div>
          <div class="car-titulo">Únete</div>
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
        <h2 class="h4 text-center pb-3">Productos destacados</h2>
      </div>
    </div>
  </div>

   <div class="sliderProductos">
     <ul class="slides">

       <?php for($i=0; $i<=5; $i++){ ?>
       <li>
         <div class="card">
           <a href="#producto">
             <div class="imagen-producto">
               <img class="spanImg" src="https://picsum.photos/300/300/?random=<?php echo $i; ?>"></img>
               <div class="contenedorEtiquetas">
                 <span class="etiqueta-1">Mex</span>
                 <span class="etiqueta-2">Nuevo</span>
                 <span class="etiqueta-3">Oferta</span>
               </div>
             </div>
             <div class="product-content text-center py-3">
               <ul class="rating">
                 <li class="far fa-star"></li>
                 <li class="far fa-star"></li>
                 <li class="far fa-star"></li>
                 <li class="far fa-star"></li>
                 <li class="far fa-star"></li>
                 <br>
                 <li class="text-dark">(1 calif)</li>
               </ul>
               <h4 class="title text-primary">Nombre producto</h4>
               <div class="price"><small>$</small> 120.00 <small>MXN </small></div>
             </div>
           </a>
           <a href="#favorito" class="btnFavorito" title="Añadir a Favoritos"> <span class="far fa-heart text-primary-6"></span> </a>
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
