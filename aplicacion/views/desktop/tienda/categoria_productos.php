<div class="fila p-5">
  <div class="container-fluid">
    <div class="row">
    <!--  <div class="col-12 col-md-2">
        <div class="contenedor-filtros">
          <h4>Marca</h4>
          <hr>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
              Apple
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option1" checked>
            <label class="form-check-label" for="exampleRadios2">
              Samsung
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option1" >
            <label class="form-check-label" for="exampleRadios3">
              LG
            </label>
          </div>
          <h4>Capacidad</h4>
          <hr>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios4" id="exampleRadios4" value="option1" >
            <label class="form-check-label" for="exampleRadios4">
              32Gb
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios5" id="exampleRadios5" value="option1" >
            <label class="form-check-label" for="exampleRadios5">
              64Gb
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios6" id="exampleRadios6" value="option1" >
            <label class="form-check-label" for="exampleRadios6">
              128Gb
            </label>
          </div>
          <h4>Precio</h4>
          <hr>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios7" id="exampleRadios7" value="option1" checked>
            <label class="form-check-label" for="exampleRadios7">
              $200-$500
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios8" id="exampleRadios8" value="option1" >
            <label class="form-check-label" for="exampleRadios8">
              $600-$800
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios9" id="exampleRadios9" value="option1">
            <label class="form-check-label" for="exampleRadios9">
              $900-$1000
            </label>
          </div>
        </div>
      </div>
    -->
      <div class="col-12">
        <div class="card-deck">
          <?php foreach($productos as $producto){ ?>
          <div class="col-6 col-sm-4 col-md-2 mb-3 px-0">
            <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>">
            <div class="card mx-1">
              <img class="card-img-top" src="<?php echo base_url(); ?>assets/global/img/default.jpg" class="img-fluid" alt="Card image cap">
              <div class="card-body text-center">
                <h5 class="card-title text<?php echo $primary; ?>"><?php echo $producto->PRODUCTO_NOMBRE; ?></h5>
                <h3 class="card-text">$<?php echo $producto->PRODUCTO_PRECIO; ?></h3>
                <p class="text<?php echo $primary; ?>">
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
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
