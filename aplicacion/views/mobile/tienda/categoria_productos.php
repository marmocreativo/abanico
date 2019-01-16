<?php
  if(isset($categoria['CATEGORIA_NOMBRE'])){
    $titulo_categoria = $categoria['CATEGORIA_NOMBRE'];
  }else{
    $titulo_categoria = 'Todos los productos';
  }
  if(isset($_GET['Busqueda'])){
    $titulo_categoria = 'Resultados para tu Busqueda';
  }

?>
<div class="fila fila-gris py-4 pb-5">
  <div class="container">
    <div class="row">

      <div class="col-12">
        <ol class="breadcrumb vistaMovil">
          <li class="breadcrumb-item"><a href="http://localhost/abanico-master/">Inicio</a></li>
          <li class="breadcrumb-item active text-primary " aria-current="page">Todos los productos</li>
        </ol>
      </div>

      <div class="col-12 mb-4">
        <!-- <div class="card p-3 mb-4"> -->
          <select class="custom-select filtro-sel">
            <option selected="">Ordenar por</option>
            <option value="1">Más caro primero</option>
            <option value="2">Más barato primero</option>
            <option value="3">Alfabético A-Z</option>
            <option value="4">Alfabético Z-A</option>
            <option value="5">Más nuevos</option>
          </select>
          <hr>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">Mexicano</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck2">
            <label class="custom-control-label" for="customCheck2">Nuevo</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck3">
            <label class="custom-control-label" for="customCheck3">Oferta</label>
          </div>
          <hr>
          <label for="customRange1">Rango de Precio</label>
          <input type="range" class="custom-range" min="0" max="5" id="customRange1">
        <!-- </div> -->
      </div>

      <div class="col-12 mb-4">

        <?php for($i=0; $i<=3; $i++){ ?>
        <div class="card mb-2 vistaProductos">
            <div class="bx">
              <div class="imagen-producto">
                <a href="http://localhost/abanico-master/producto?id=8" class="spanImg m-1" style="background-image:"></a>
                <div class="contenedorEtiquetas">
                  <span class="etiqueta-1">Mex</span>
                  <span class="etiqueta-2">Nuevo</span>
                  <span class="etiqueta-3">Oferta</span>
                </div>
              </div>
              <div class="product-content text-left p-3">
                <a href="#" class="btnFavorito" title="Añadir a Favoritos"> <span class="far fa-heart text-primary-6"></span> </a>
                <ul class="rating mb-1">
                  <li class="far fa-star"></li>
                  <li class="far fa-star"></li>
                  <li class="far fa-star"></li>
                  <li class="far fa-star"></li>
                  <li class="far fa-star"></li>
                  <!-- <li class="text-dark">(1 calif)</li> -->
                </ul>
                <h4 class="title text-primary">Nombre producto</h4>
                <div class="price-list"><small>$</small> 150.00 <small>MXN </small> </div>
                <div class="price"><small>$</small> 120.00 <small>MXN </small></div>
              </div>
            </div>
        </div>
        <?php } ?>

      </div>
    </div>

    <div class="col-12 mb-4">
      <nav aria-label="Page navigation example">
        <ul class="pagination pagination-sm justify-content-center">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>

  </div>

  <!-- slider productos relacionados -->

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
        <div class="bx">
          <div class="imagen-producto">
            <a href="#" class="spanImg" style="background-image: "></a>
            <div class="contenedorEtiquetas">
              <span class="etiqueta-1">Mex</span>
              <span class="etiqueta-2">Nuevo</span>
              <span class="etiqueta-3">Oferta</span>
            </div>
            <a href="#" class="btnFavorito" title="Añadir a Favoritos"> <span class="far fa-heart text-primary-6"></span> </a>
          </div>
          <div class="product-content text-center py-3">
            <ul class="rating">
              <li class="far fa-star"></li>
              <li class="far fa-star"></li>
              <li class="far fa-star"></li>
              <li class="far fa-star"></li>
              <li class="far fa-star"></li>
              <li class="text-dark">(1 calif)</li>
            </ul>
            <h4 class="title text-primary">Nombre producto</h4>
            <div class="price"><small>$</small> 120.00 <small>MXN </small></div>
          </div>
        </div>
      </li>
      <?php } ?>

    </ul>
  </div>

</div>
