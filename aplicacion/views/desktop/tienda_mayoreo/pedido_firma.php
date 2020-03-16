<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h3>Pedido folio: <b><?php echo $pedido['PEDIDO_FOLIO']; ?></b></h3>
      </div>
    </div>
    <form class="" action="<?php echo base_url('tienda-mayoreo/firmar_pedido'); ?>" method="post">
    <input type="hidden" name="Identificador" value="<?php echo $pedido['ID_PEDIDO']; ?>">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label for="TipoPedido">Este pedido será:</label>
          <select class="form-control" name="TipoPedido">
            <option value="contra_entrega">Pago contra entrega</option>
            <option value="pago_inmediato">Pago inmediato</option>
            <option value="comision">Productos a comision</option>
          </select>
        </div>
        <label for="">Firma de confirmación:</label>
        <canvas style="border: solid 1px #000; min-width:300px; max-width:1600px;"></canvas>
        <button type="submit" class="btn btn-primary-17 btn-block btn-lg"> <i class="fa fa-check"></i> Aceptar</button>
      </div>
    </div>
    </form>
  </div>
</div>
