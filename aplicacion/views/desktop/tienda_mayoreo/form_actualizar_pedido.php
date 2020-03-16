<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h3>Pedido folio: <b><?php echo $pedido['PEDIDO_FOLIO']; ?></b></h3>
      </div>
    </div>
    <form class="" action="<?php echo base_url('tienda-mayoreo/pedido_actualizar'); ?>" method="post">
    <input type="hidden" name="Identificador" value="<?php echo $pedido['ID_PEDIDO']; ?>">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label for="NombrePedido">Nombre </label>
          <input type="text" class="form-control" name="NombrePedido" value="<?php echo $pedido['PEDIDO_NOMBRE'] ?>" required>
        </div>
        <div class="form-group">
          <label for="CorreoPedido">Correo</label>
          <input type="text" class="form-control" name="CorreoPedido" value="<?php echo $pedido['PEDIDO_CORREO'] ?>" required>
        </div>
        <div class="form-group">
          <label for="TelefonoPedido">Teléfono</label>
          <input type="text" class="form-control" name="TelefonoPedido" value="<?php echo $pedido['PEDIDO_TELEFONO'] ?>">
        </div>
        <div class="form-group">
          <label for="DireccionPedido">Dirección</label>
          <textarea name="DireccionPedido" class="form-control" rows="5"><?php echo $pedido['PEDIDO_DIRECCION'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary-17 btn-lg btn-block"> <i class="fa fa-save"></i> Actualizar </button>
      </div>
    </div>
    </form>
  </div>
</div>
