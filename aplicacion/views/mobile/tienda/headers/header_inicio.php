<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/global/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/frontend/css/estilos_abanico.css">
    <title>Abanico | Siempre lo Mejor</title>
  </head>
  <body>
<!--Iniciamos el Header-->
<div class="top-menu">
  <div class="container-fluid">
    <div class="row">
      <div class="col h-100">
        <p class="my-auto"> <span class="fa fa-phone"></span> Atención a clientes: 0102 4444 34</p>
      </div>
      <div class="col h-100">
        <div class="btn-group my-auto float-right" role="group" aria-label="Menú de Usuarios">
          <button type="button" class="btn btn-light btn-sm"><span class="fa fa-question-circle"></span> Ayuda</button>
          <button type="button" class="btn btn-light btn-sm"><span class="fa fa-headset"></span> Soporte Técnico</button>

          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="fa fa-user"></span> Usuarios
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <a class="dropdown-item" href="#">Iniciar Sesión</a>
              <a class="dropdown-item" href="#">Registrarse</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="main-menu">
  <div class="container-fluid">
    <div class="row">
      <div class="col-3">
        <div class="dropdown">
          <button class="btn btn-secondary btn-block dropdown-toggle" type="button" id="menuCategorias" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categorías
          </button>
          <div class="dropdown-menu" aria-labelledby="menuCategorias">
            <a class="dropdown-item" href="categoria">Tecnologia, Computación y Gadgets</a>
            <a class="dropdown-item" href="categoria">Belleza y Cuidado Personal</a>
            <a class="dropdown-item" href="categoria">Deportes</a>
            <a class="dropdown-item" href="categoria">Hogar y Electrodomésticos</a>
            <a class="dropdown-item" href="categoria">Herramientas e Industrias</a>
            <a class="dropdown-item" href="categoria">Juguetes y Bebés</a>
            <a class="dropdown-item" href="categoria">Libros</a>
            <a class="dropdown-item" href="categoria">Moda, Joyas y Relojes</a>
            <a class="dropdown-item" href="categoria">Inmuebles</a>
            <a class="dropdown-item" href="categoria">Vehículos y Accesorios</a>
            <a class="dropdown-item" href="categoria">Manualidades y Artesanías</a>
            <a class="dropdown-item" href="categoria">Alimentos</a>
          </div>
        </div>
      </div>
      <div class="col-4">
        <a href="index.php"><img src="assets/frontend/img/logo.png" class="img-fluid" alt="Abanico Siempre lo Mejor"></a>
      </div>
      <div class="col-5">
        <div class="btn-group my-auto float-right" role="group" aria-label="Menú de Usuarios">
          <button type="button" class="btn btn-secondary btn-lg"><span class="fa fa-heart"></span> Lista de Deseos</button>
          <button type="button" class="btn btn-secondary btn-lg"><span class="fa fa-shopping-cart"></span> Carrito</button>

        </div>
      </div>
    </div>
  </div>
</div>
<div class="bottom-menu">
  <div class="container-fluid">
    <div class="row">
      <div class="col-3">
        <div class="slider">
          <div id="Slider-Principal" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="assets/frontend/img/sli-1.jpg" alt="Slider-1">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="assets/frontend/img/sli-2.jpg" alt="Slider-1">
              </div>
            </div>
            <a class="carousel-control-prev" href="#Slider-Principal" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#Slider-Principal" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-9 text-center h-100">
        <div class="buscador py-5">
          <h3>Abanico Siempre lo Mejor</h3>
          <form class="" action="categoria" method="post">
            <div class="row">
              <div class="col-10 px-0">
                <div class="form-group">
                  <input class="form-control form-control-lg" type="text" placeholder="Busqueda">
                </div>
              </div>
              <div class="col-2 px-0">
                <button type="submit" class="btn btn-dark btn-lg btn-block"> <span class="fa fa-search"></span> </button>
              </div>
            </div>
          </form>
          <p>Busquedas populares</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Terminamos el Header-->
