<!-- Slider -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="contenido/img/sliders/sli-1.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="contenido/img/sliders/sli-2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="contenido/img/sliders/sli-3.jpg" alt="Thirth slide">
      </div>
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
<div class="post-menu">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <a href="#" class="caracteristica">
          <div class="car-icono"> <span class="fa fa-paint-roller"></span> </div>
          <div class="car-contenido">
            <div class="car-titulo">Servicios</div>
            <div class="car-subtitulo">Profesionales en todo el país</div>
          </div>
        </a>
      </div>

      <div class="col">
        <a href="#" class="caracteristica">
          <div class="car-icono"> <span class="fa fa-boxes"></span> </div>
          <div class="car-contenido">
            <div class="car-titulo">Mayoristas</div>
            <div class="car-subtitulo">Venta a Mayoristas</div>
          </div>
        </a>
      </div>
      <div class="col">
        <a href="#" class="caracteristica">
          <div class="car-icono"> <span class="fa fa-handshake"></span> </div>
          <div class="car-contenido">
            <div class="car-titulo">Únete</div>
            <div class="car-subtitulo">Ofrece tus servicios con nosotros</div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>


<!-- Inicia el cuerpo del texto -->

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-3">
      <div class="contenedor-servicios">
        <div class="contenedor-servicios-titulo">

          <h4>Servicios</h4>
        </div>
        <div class="categorias-servicios">
          <div class="servicio-circulo">
            <span class="fa fa-paint-roller"></span>
          </div>
          <div class="servicio-circulo">
            <span class="fa fa-paint-roller"></span>
          </div>
          <div class="servicio-circulo">
            <span class="fa fa-paint-roller"></span>
          </div>
          <div class="servicio-circulo">
            <span class="fa fa-paint-roller"></span>
          </div>
          <div class="servicio-circulo">
            <span class="fa fa-paint-roller"></span>
          </div>
          <div class="servicio-circulo">
            <span class="fa fa-paint-roller"></span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-9">
      <div class="row">
        <div class="col-9">
          <div class="row">
            <div class="col-8">
              <div class="contenedor-destacado">
                <img src="assets/global/img/destacado-2.jpg" class="img-fluid" alt="">
              </div>
            </div>
            <div class="col-4">
              <div class="contenedor-destacado">
                <img src="assets/global/img/destacado-1.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="contenedor-destacado">
                <img src="assets/global/img/destacado-4.jpg" class="img-fluid" alt="">
              </div>
            </div>
            <div class="col-8">
              <div class="contenedor-destacado">
                <img src="assets/global/img/destacado-3.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="contenedor-destacado">
            <img src="assets/global/img/destacado-5.jpg" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="fila fila-gris">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card-deck">
          <?php for($i=0; $i<=5; $i++){ ?>
            <div class="col-6 col-sm-3 col-md-2 mb-3 px-0">
              <a href="producto">
              <div class="card mx-1">
                <img class="card-img-top" src="assets/global/img/default.jpg" class="img-fluid" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Nombre del Producto</h5>
                  <p class="card-text">$100.00</p>
                </div>
              </div>
              </a>
            </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="fila">
  <div class="container-fluid px-5">
    <div class="row">
      <div class="col">
        <div class="row">
          <div class="col-4">
            <h4>Datos Curiosos</h4>
            <img src="assets/global/img/curioso.jpg" class="img-fluid imagen-curioso" alt="">
          </div>
          <div class="col-8">
            <div class="dato-curioso dato-ganador">
              <h5>Autor</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tinci dunt ut laoreet dolore magna aliquam erat</p>
            </div>
            <?php for($i=0; $i<=2; $i++){ ?>
              <div class="dato-curioso">
                <h5>Autor</h5>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tinci dunt ut laoreet dolore magna aliquam erat</p>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="row">
          <div class="col">
            <img src="assets/global/img/ganador.jpg" class="img-fluid" alt="">
          </div>
          <div class="col">
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
