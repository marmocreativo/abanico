<div class="contenido_principal">
  <div class="container-fluid">
    <?php retro_alimentacion(); ?>
    <div class="row">
      <div class="col text-center py-4">
        <h3>Pedido folio: <b><?php echo $pedido['PEDIDO_FOLIO']; ?></b></h3>
      </div>
    </div>
      <div class="row">
        <div class="col-6">
          <form class="" action="<?php echo base_url('tienda-mayoreo/pedido_pago'); ?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $pedido['ID_PEDIDO']; ?>">
            <input type="hidden" name="FormaPagoPedido" value="Pago en Efectivo">
            <input type="hidden" name="EstadoPagoPedido" value="Pagado">
            <button type="submit" class="btn btn-success btn-block"> Pago en Efectivo</button>
          </form>
        </div>
        <div class="col-6">
          <form class="" action="<?php echo base_url('tienda-mayoreo/pedido_pago'); ?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $pedido['ID_PEDIDO']; ?>">
            <input type="hidden" name="FormaPagoPedido" value="Pendiente">
            <button type="submit" class="btn btn-success btn-block"> Depósito o Transferencia</button>
          </form>
        </div>
      </div>
  </div>
</div>
