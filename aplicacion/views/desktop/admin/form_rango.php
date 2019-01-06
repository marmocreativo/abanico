
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-truck"></span> Nuevo Rango</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/rangos/crear'); ?>" method="post">
            <input type="hidden" name="IdTransportista" value="<?php echo $_GET['id_transportista']; ?>">
            <div class="row">
              <div class="col-8">
                <div class="form-group">
                  <label for="PesoMax">Peso Máximo</label>
                  <input type="number" step="0.01" class="form-control" name="PesoMax" id="PesoMax" placeholder="" required value="<?=!form_error('PesoMax')?set_value('PesoMax'):''?>">
                </div>

                <div class="form-group">
                  <label for="ImporteMin">Importe Mínimo <small>(Importe de productos que debe comprar el usuario)</small></label>
                  <input type="number" step="0.01" class="form-control" name="ImporteMin" id="ImporteMin" placeholder="" required value="<?=!form_error('ImporteMin')?set_value('ImporteMin'):''?>">
                </div>
                <div class="form-group">
                  <label for="Importe">Importe <small>(Costo del envio)</small></label>
                  <input type="number" step="0.01" class="form-control" name="Importe" id="Importe" placeholder="" required value="<?=!form_error('Importe')?set_value('Importe'):''?>">
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
