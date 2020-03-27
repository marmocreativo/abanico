<div class="contenido_principal">
  <div class="container-fluid">
    <?php retro_alimentacion(); ?>
    <div class="row">
      <div class="col text-center py-4">
        <h3>Pedido folio: <b><?php echo $pedido['PEDIDO_FOLIO']; ?></b></h3>
        <h4>Finalizar comisión</h4>
      </div>
    </div>
    <form class="" action="<?php echo base_url('tienda-mayoreo/pedido_finalizar_comision'); ?>" method="post">
      <input type="hidden" name="id_pedido" value="<?php echo $pedido['ID_PEDIDO']; ?>">
      <input type="hidden" name="importe_productos" value="<?php echo $pedido['PEDIDO_IMPORTE_PRODUCTOS_PARCIAL']; ?>">
      <input type="hidden" name="importe_envio" value="<?php echo $pedido['PEDIDO_IMPORTE_ENVIO_TOTAL']; ?>">
      <input type="hidden" name="porcentaje_impuestos" value="<?php echo $pedido['PEDIDO_IMPUESTO_PORCENTAJE']; ?>">
    <div class="row">
      <div class="col-12">
          <table class="table table-striped table-bordered table-sm">
            <tr>
              <th style="width:20%">Producto</th>
              <th class="text-center">Dejáste</th>
              <th>Se vendieron</th>
            </tr>
            <?php foreach($productos_pedido as $producto){ ?>
              <tr>
                <td>
                  <img src="<?php echo $producto->PRODUCTO_IMAGEN;  ?>" width="30px;">
                  <p>
                    <?php echo $producto->PRODUCTO_NOMBRE; ?><br>
                    <small>
                      <?php echo $producto->PRODUCTO_DETALLES; ?>
                    </small>
                  </p>
                </td>
                <td class="text-center">
                  <h5><?php echo $producto->CANTIDAD; ?></h5>
                </td>
                <td>
                  <div class="form-group">
                    <input type="number" class="form-control cantidad_producto" name="Producto[<?php echo $producto->ID; ?>]" min="0" max="<?php echo $producto->CANTIDAD; ?>" value="<?php echo $producto->CANTIDAD; ?>">
                  </div>
                </td>
              </tr>
            <?php }?>
          </table>
      </div>
      <div class="col-12">
        <div class="form-group">
          <label for="PagarAhora">¿Te pagarán en este momento?</label>
          <select class="form-control" name="PagarAhora">
            <option value="si_efectivo">Si, en efectivo</option>
            <option value="no_transferencia">No, transferencia</option>
          </select>
        </div>
        <div class="form-group">
          <label for="Resurtir">¿Se va a resurtir?</label>
          <select class="form-control" name="Resurtir">
            <option value="no">No</option>
            <option value="si">Si</option>
          </select>
        </div>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-block btn-info" name="button">Finalizar</button>
      </div>
    </div>
    </form>
  </div>
</div>
