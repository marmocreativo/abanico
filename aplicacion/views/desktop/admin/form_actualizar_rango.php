
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-truck"></span> Actualizar Rango</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/rangos/actualizar'); ?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $rango['ID']; ?>">
            <input type="hidden" name="IdTransportista" value="<?php echo $rango['ID_TRANSPORTISTA']; ?>">
            <div class="row">
              <div class="col-8">
                <div class="form-group">
                  <label for="PesoMax">Peso Máximo</label>
                  <input type="number" step="0.01" class="form-control" name="PesoMax" id="PesoMax" placeholder="" required value="<?php echo $rango['PESO_MAX'] ?>">
                </div>

                <div class="form-group">
                  <label for="ImporteMin">Importe Mínimo <small>(Importe de productos que debe comprar el usuario)</small></label>
                  <input type="number" step="0.01" class="form-control" name="ImporteMin" id="ImporteMin" placeholder="" required value="<?php echo $rango['IMPORTE_MIN'] ?>">
                </div>
                <div class="form-group">
                  <label for="Importe">Importe <small>(Costo del envio)</small></label>
                  <input type="number" step="0.01" class="form-control" name="Importe" id="Importe" placeholder="" required value="<?php echo $rango['IMPORTE'] ?>">
                </div>
              </div>
            </div>
            <hr>
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
