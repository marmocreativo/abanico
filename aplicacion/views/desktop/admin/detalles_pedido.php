  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <b>Fecha:</b> <?php echo $pedido['PEDIDO_FECHA_REGISTRO']; ?>
                  </div>
                  <div class="col-sm-3">
                    <b>Importe:</b> <?php echo $pedido['PEDIDO_IMPORTE_TOTAL']; ?>
                  </div>
                  <div class="col-sm-3">
                    <b>Mensajes:</b> 0
                  </div>
                  <div class="col-sm-3">
                    <b>Productos:</b> 0
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-8">
            <div class="card">
              <div class="card-header">
                <h6> <i class="fa fa-file"></i> Folio: <b><?php echo $pedido['PEDIDO_FOLIO']; ?></b></h6>
              </div>
              <div class="card-body">
                <div class="border p-3">
                  <form class="form-inline" action="<?php echo base_url('admin/pedidos/actualizar'); ?>" method="post">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Estado del pedido</label>
                      <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                        <option selected>Choose...</option>
                      </select>
                       <button type="submit" class="btn btn-primary my-1">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-body">

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">

              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
