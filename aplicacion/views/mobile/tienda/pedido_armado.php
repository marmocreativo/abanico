<table class="table table-bordered">
  <tbody>
    <tr>
      <td class="text-right" style="width:75%"><b><?php echo $this->lang->line('proceso_pago_3_importe_productos'); ?>:</b></td>
      <td>
        <h5>
        <small><?php echo $_SESSION['divisa']['signo']; ?></small>
        <?php echo number_format($importe_productos_total,2); ?>
        <small><?php echo $_SESSION['divisa']['iso']; ?></small>
        </h5>
      </td>
    </tr>
    <tr>
      <td class="text-right">
        <b>Envio Total:</b><br> <span class="text-muted"></span>
      </td>
      <td>
        <h5>
        <small><?php echo $_SESSION['divisa']['signo']; ?></small>
        <?php echo number_format($envio_pedido_total,2); ?>
        <small><?php echo $_SESSION['divisa']['iso']; ?></small>
        </h5>
      </td>
    </tr>
    <tr>
      <td class="text-right" style="width:75%"><b><?php echo $this->lang->line('proceso_pago_3_total'); ?>:</b></td>
      <td>
        <h5>
        <small><?php echo $_SESSION['divisa']['signo']; ?></small>
       <?php echo number_format($importe_total,2); ?>
       <small><?php echo $_SESSION['divisa']['iso']; ?></small>
        </h5>
      </td>
    </tr>
  </tbody>
</table>
<?php $folio = folio_pedido();?>
<div class="row">
  <?php if($detalles_direccion['DIRECCION_PAIS']=='México'){ ?>
<div class="col-12 mb-3">
  <form class="d-flex justify-content-end" id="banco_form" action="<?php echo base_url('proceso_pago_3_banco'); ?>" method="post" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="Folio" value="<?php echo $folio ; ?>">
    <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
    <input type="hidden" name="PedidoNombre" value="<?php echo  $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?>">
    <input type="hidden" name="PedidoCorreo" value="<?php echo $_SESSION['usuario']['correo']; ?>">
    <input type="hidden" name="PedidoTelefono" value="<?php echo $usuario['USUARIO_TELEFONO']; ?>">
    <input type="hidden" name="IdDireccion" value="<?php echo $detalles_direccion['ID_DIRECCION'] ; ?>">
    <input type="hidden" name="Direccion" value="<?php echo $direccion ; ?>">
    <input type="hidden" name="Divisa" value="<?php echo $_SESSION['divisa']['iso']; ?>">
    <input type="hidden" name="Conversion" value="<?php echo $_SESSION['divisa']['conversion']; ; ?>">
    <input type="hidden" name="ImporteProductosParcial" value="<?php echo $importe_productos_abanico ; ?>">
    <input type="hidden" name="ImporteProductosTotal" value="<?php echo $importe_productos_total ; ?>">
    <input type="hidden" name="ImporteEnvioParcial" value="<?php echo $envio_pedido_abanico ; ?>">
    <input type="hidden" name="ImporteEnvioTotal" value="<?php echo $envio_pedido_total ; ?>">
    <input type="hidden" name="PedidosTiendas" value="<?php echo $pedido_tienda ; ?>">
    <input type="hidden" name="ImporteTotal" value="<?php echo $importe_total ; ?>">
    <input type="hidden" name="IdTransportista" value="<?php echo $id_transportista_abanico ; ?>">
    <input type="hidden" name="NombreTransportista" value="<?php echo $nombre_transportista_abanico ; ?>">
      <button type="submit" class="btn btn-success btn-sm btn-block"><?php echo $this->lang->line('proceso_pago_3_transferencia'); ?> <span class="fas fa-money-bill-alt"></span></button>
  </form>
</div>
<?php } ?>
<div class="col">
  <form class="d-flex justify-content-end" id="banco_form" action="<?php echo base_url('proceso_pago_3_oxxo'); ?>" method="post" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="Folio" value="<?php echo $folio ; ?>">
    <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
    <input type="hidden" name="PedidoNombre" value="<?php echo  $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?>">
    <input type="hidden" name="PedidoCorreo" value="<?php echo $_SESSION['usuario']['correo']; ?>">
    <input type="hidden" name="PedidoTelefono" value="<?php echo $usuario['USUARIO_TELEFONO']; ?>">
    <input type="hidden" name="IdDireccion" value="<?php echo $detalles_direccion['ID_DIRECCION'] ; ?>">
    <input type="hidden" name="Direccion" value="<?php echo $direccion ; ?>">
    <input type="hidden" name="Divisa" value="<?php echo $_SESSION['divisa']['iso']; ?>">
    <input type="hidden" name="Conversion" value="<?php echo $_SESSION['divisa']['conversion']; ; ?>">
    <input type="hidden" name="ImporteProductosParcial" value="<?php echo $importe_productos_abanico ; ?>">
    <input type="hidden" name="ImporteProductosTotal" value="<?php echo $importe_productos_total ; ?>">
    <input type="hidden" name="ImporteEnvioParcial" value="<?php echo $envio_pedido_abanico ; ?>">
    <input type="hidden" name="ImporteEnvioTotal" value="<?php echo $envio_pedido_total ; ?>">
    <input type="hidden" name="PedidosTiendas" value="<?php echo $pedido_tienda ; ?>">
    <input type="hidden" name="ImporteTotal" value="<?php echo $importe_total ; ?>">
    <input type="hidden" name="IdTransportista" value="<?php echo $id_transportista_abanico ; ?>">
    <input type="hidden" name="NombreTransportista" value="<?php echo $nombre_transportista_abanico ; ?>">
      <button type="submit" class="btn btn-danger btn-sm btn-block btn-transfer"><?php echo $this->lang->line('proceso_pago_3_oxxo'); ?> <span class="fas fa-cash-register"></span></button>
  </form>
</div>
<div class="col">
  <form class="d-flex justify-content-end" id="banco_form" action="<?php echo base_url('proceso_pago_3_paypal'); ?>" method="post" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="Folio" value="<?php echo $folio ; ?>">
    <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
    <input type="hidden" name="PedidoNombre" value="<?php echo  $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?>">
    <input type="hidden" name="PedidoCorreo" value="<?php echo $_SESSION['usuario']['correo']; ?>">
    <input type="hidden" name="PedidoTelefono" value="<?php echo $usuario['USUARIO_TELEFONO']; ?>">
    <input type="hidden" name="IdDireccion" value="<?php echo $detalles_direccion['ID_DIRECCION'] ; ?>">
    <input type="hidden" name="Direccion" value="<?php echo $direccion ; ?>">
    <input type="hidden" name="Divisa" value="<?php echo $_SESSION['divisa']['iso']; ?>">
    <input type="hidden" name="Conversion" value="<?php echo $_SESSION['divisa']['conversion']; ; ?>">
    <input type="hidden" name="ImporteProductosParcial" value="<?php echo $importe_productos_abanico ; ?>">
    <input type="hidden" name="ImporteProductosTotal" value="<?php echo $importe_productos_total ; ?>">
    <input type="hidden" name="ImporteEnvioParcial" value="<?php echo $envio_pedido_abanico ; ?>">
    <input type="hidden" name="ImporteEnvioTotal" value="<?php echo $envio_pedido_total ; ?>">
    <input type="hidden" name="PedidosTiendas" value="<?php echo $pedido_tienda ; ?>">
    <input type="hidden" name="ImporteTotal" value="<?php echo $importe_total ; ?>">
    <input type="hidden" name="IdTransportista" value="<?php echo $id_transportista_abanico ; ?>">
    <input type="hidden" name="NombreTransportista" value="<?php echo $nombre_transportista_abanico ; ?>">
      <button type="submit" class="btn btn-primary btn-sm btn-block"><?php echo $this->lang->line('proceso_pago_3_paypal'); ?> <span class="fab fa-paypal"></span></button>
  </form>
</div>
</div>
