<div class="fila p-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-2">
        <img class="card-img-top" src="assets/frontend/img/default.jpg" class="img-fluid" alt="Card image cap">
        <div class="col">
          <h4>$200.00</h4>
        </div>
        <div class="col">
          <div class="form-group">
            <input type="number" class="form-control" name="" value="1">
          </div>
        </div>
        <div class="col">
          <button type="button" class="btn btn-block btn-primary" name="button">Añadir al Carrito <span class="fa fa-shopping-cart"></span> </button>
        </div>
      </div>
      <div class="col-12 col-md-8">
        <h2>Nombre del producto</h2>
        <p>Espacio para una descripción corta</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas elit lectus, sollicitudin ac laoreet at, mattis sit amet sapien. Morbi fermentum felis sem, eu hendrerit magna scelerisque eget. Quisque tempor gravida libero, eu faucibus leo porta sit amet. Suspendisse vel massa porta, blandit diam nec, eleifend mi. Ut tincidunt in diam eu cursus. Curabitur dictum efficitur ultrices. Nam accumsan a lectus quis elementum. Proin vitae lorem ipsum. Nam elementum dui mi, non imperdiet ante efficitur eu. Quisque gravida, metus id vulputate ullamcorper, justo lorem semper ante, vel dictum massa tortor a nisl.</p>

      </div>
      <div class="col-12 col-md-2">
        <h4>Productos Relacionados</h4>
        <hr>
        <?php for($i=0; $i<=5; $i++){ ?>
        <div class="col-12">
          <a href="producto">
          <div class="card mx-1">
            <img class="card-img-top" src="assets/frontend/img/default.jpg" class="img-fluid" alt="Card image cap">
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
