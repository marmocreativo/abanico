<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h3>Pedido folio: <b><?php echo $pedido['PEDIDO_FOLIO']; ?></b></h3>
      </div>
    </div>
    <form class="" action="<?php echo base_url('tienda-mayoreo/pedido_impuestos'); ?>" method="post">
    <input type="hidden" name="Identificador" value="<?php echo $pedido['ID_PEDIDO']; ?>">
    <input type="hidden" name="ImporteProductosParcialPedido" value="<?php echo $pedido['PEDIDO_IMPORTE_PRODUCTOS_PARCIAL']; ?>">
    <input type="hidden" name="ImporteEnvioTotalPedido" value="<?php echo $pedido['PEDIDO_IMPORTE_ENVIO_TOTAL']; ?>">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label for="ImpuestoDetallesPedido">Descripcion de los impuestos </label>
          <input type="text" class="form-control" name="ImpuestoDetallesPedido" value="<?php if(!empty($pedido['PEDIDO_IMPUESTO_DETALLES'])){ echo $pedido['PEDIDO_IMPUESTO_DETALLES']; } else { echo 'IVA 16%'; } ?>" required>
        </div>
        <div class="form-group">
          <label for="ImporteImpuestosPedido">Porcentaje Impuestos</label>
          <input type="text" class="form-control" name="ImporteImpuestosPedido" value=" <?php if(!empty($pedido['PEDIDO_IMPORTE_IMPUESTOS'])){ echo $pedido['PEDIDO_IMPUESTO_PORCENTAJE']; } else { echo '16'; } ?>" required>
        </div>
        <button type="submit" class="btn btn-primary-17 btn-lg btn-block"> <i class="fa fa-save"></i> Confirmar impuestos </button>
      </div>
    </div>
    </form>
  </div>
</div>
