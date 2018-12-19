
<div class="fila p-5">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card-body store-body">
            <div class="product-info">
              <div class="product-gallery">
                <div class="product-gallery-thumbnails">
                  <ol class="thumbnails-list list-unstyled">
                    <?php foreach($galerias as $galeria){
                      $ruta_galeria = 'assets/tienda/img/productos/completo/'.$galeria->GALERIA_ARCHIVO;
                      ?>
                    <li><img src="<?php echo base_url($ruta_galeria) ?>" alt=""></li>
                  <?php } ?>
                  </ol>
                </div>
                <div class="product-gallery-featured">
                  <?php if(empty($portada)){ $ruta_portada = 'assets/global/img/default.jpg'; }else{ $ruta_portada = 'assets/tienda/img/productos/completo/'.$portada['GALERIA_ARCHIVO']; } ?>
                  <img src="<?php echo base_url($ruta_portada) ?>" alt="" class="img-fluid">
                </div>
              </div>
              <div class="product-seller-recommended">
                <!-- /.recommended-items-->
                <div class="product-description mb-5">
                  <h2 class="mb-5">Description</h2>
                  <?php echo $producto['PRODUCTO_DETALLES']; ?>
                </div>
                <div class="product-faq mb-5">
                  <h2 class="mb-3">Preguntas y Comentarios</h2>
                  <p class="text-muted">¿Tienes alguna duda?</p>
                </div>
                <div class="product-comments">
                  <h5 class="mb-2">Pregunta directamente al vendedor</h5>
                  <form action="" class="form-inline mb-5">
                    <textarea name="" id="" cols="50" rows="2" class="form-control mr-4" placeholder="write a question"></textarea><button class="btn btn-lg btn-primary">Preguntar</button>
                  </form>
                  <h5 class="mb-5">Últimas Preguntas</h5>
                  <ol class="list-unstyled last-questions-list">
                    <li><i class="fa fa-comment"></i> <span>Se puede pagar con tarjeta de Crédito?</span></li>
                    <li><i class="fa fa-comment"></i> <span>¿Me lo pueden mandar a otro estado?</span></li>
                  </ol>
                </div>
              </div>
            </div>
            <div class="product-payment-details">
              <p class="last-sold text-muted"><small><?php echo $producto['PRODUCTO_CANTIDAD']; ?> Disponibles</small></p>
              <h4 class="product-title mb-2"><?php echo $producto['PRODUCTO_NOMBRE']; ?></h4>
              <?php echo $producto['PRODUCTO_DESCRIPCION']; ?>
              <h2 class="product-price display-4">$ <?php echo $producto['PRODUCTO_PRECIO']; ?></h2>
              <p class="text-success"><i class="fa fa-credit-card"></i> Pago con tarjeta Crédito o Débito</p>
              <p class="mb-0"><i class="fa fa-truck"></i> Entregamos en todo México</p>
              <label for="quant">Cantidad</label>
              <input type="number" name="quantity" min="1" id="quant" class="form-control mb-5 input-lg" placeholder="Cantidad" value="<?php echo $producto['PRODUCTO_CANTIDAD_MINIMA']; ?>">
              <button class="btn btn-primary btn-lg btn-block">Añadir al Carrito</button>

            </div>
          </div>
      </div>
    </div>
    <!--
    <div class="row">
      <div class="col-12 col-md-2">
        <img class="card-img-top" src="assets/global/img/default.jpg" class="img-fluid" alt="Card image cap">
        <div class="col">
          <h4>$<?php echo $prod->PRODUCTO_PRECIO; ?></h4>
        </div>
        <div class="col">
          <div class="form-group">
            <input type="number" class="form-control" name="" value="1">
          </div>
        </div>
        <div class="col">
          <button type="button" class="btn btn-block btn-primary" name="button">Añadir <span class="fa fa-shopping-cart"></span> </button>
        </div>
      </div>
      <div class="col-12 col-md-8">
        <h2><?php echo $prod->PRODUCTO_NOMBRE; ?></h2>
        <p><?php echo $prod->PRODUCTO_DESCRIPCION; ?></p>
        <div class="producto_detalles">
          <?php echo $prod->PRODUCTO_DETALLES; ?>
        </div>

      </div>
    </div>
  -->
  </div>
</div>
