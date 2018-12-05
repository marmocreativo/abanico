<?php foreach($producto as $prod){ ?>
<div class="fila p-5">
  <div class="container">
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
  </div>
</div>
<?php } ?>
