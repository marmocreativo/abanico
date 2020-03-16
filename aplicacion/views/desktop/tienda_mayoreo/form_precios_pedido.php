<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h3>Pedido folio: <b><?php echo $pedido['PEDIDO_FOLIO']; ?></b></h3>
      </div>
    </div>
    <?php foreach($productos_pedido as $producto){ ?>
    <form class="" action="<?php echo base_url('tienda-mayoreo/pedido_precios'); ?>" method="post">
    <input type="hidden" name="Identificador" value="<?php echo $pedido['ID_PEDIDO']; ?>">
    <input type="hidden" name="IdProducto" value="<?php echo $producto->ID; ?>">
    <input type="hidden" name="ImporteImpuestosPedido" value="<?php echo $pedido['PEDIDO_IMPORTE_IMPUESTOS']; ?>">
    <input type="hidden" name="ImporteEnvioTotalPedido" value="<?php echo $pedido['PEDIDO_IMPORTE_ENVIO_TOTAL']; ?>">
    <div class="row">
      <div class="col-12 bg-light py-3 mb-4 border">
        <h5><?php echo $producto->PRODUCTO_NOMBRE; ?><br>
        <small>
          <?php echo $producto->PRODUCTO_DETALLES; ?>
        </small></h5>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="Cantidad">Cantidad</label>
              <input type="text" class="form-control" name="Cantidad" value="<?php echo $producto->CANTIDAD; ?>" required>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="Importe">Importe</label>
              <input type="text" class="form-control" name="Importe" value="<?php echo $producto->IMPORTE; ?>" required>
            </div>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary-17 btn-block"> <i class="fa fa-sync-alt"></i></button>
          </div>
        </div>
      </div>
    </div>
    </form>
    <?php } ?>
  </div>
</div>
