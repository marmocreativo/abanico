<div class="contenido_principal">
  <div class="container-fluid">
    <?php retro_alimentacion(); ?>
    <div class="row">
      <div class="col text-center py-4">
        <h3>Pedido folio: <b><?php echo $pedido['PEDIDO_FOLIO']; ?></b></h3>
      </div>
    </div>
      <div class="row">
        <div class="col-12 mb-3">
          <form class="" action="<?php echo base_url('tienda-mayoreo/pedido_pago'); ?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $pedido['ID_PEDIDO']; ?>">
            <input type="hidden" name="FormaPagoPedido" value="transferencia">
            <input type="hidden" name="EstadoPagoPedido" value="pagado">
            <button type="submit" class="btn btn-success btn-block"> Confirmar Depósito o Transferencia</button>
          </form>
        </div>
        <div class="col-12 mb-3">
          <form class="" action="<?php echo base_url('tienda-mayoreo/pedido_pago'); ?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $pedido['ID_PEDIDO']; ?>">
            <input type="hidden" name="FormaPagoPedido" value="efectivo">
            <input type="hidden" name="EstadoPagoPedido" value="pagado">
            <button type="submit" class="btn btn-success btn-block"> Se pagó en Efectivo</button>
          </form>
        </div>
      </div>
  </div>
</div>
