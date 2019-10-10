<div class="container-fluid p-0 cont-resumen">
  <h4><b>Resumen de tu órden</b></h4>
  <p><?php echo $this->lang->line('proceso_pago_3_importe_productos'); ?>:</p>
  <h5><b>
    <?php echo $_SESSION['divisa']['signo']; ?>
    <?php echo number_format($importe_productos_total,2); ?>
    <small><?php echo $_SESSION['divisa']['iso']; ?></small>
  </b></h5>
  <hr>
  <p>Envio Total:</b><br> <span class="text-muted"></span></p>
  <h5><b>
    <?php echo $_SESSION['divisa']['signo']; ?>
    <?php echo number_format($envio_pedido_total,2); ?>
    <small><?php echo $_SESSION['divisa']['iso']; ?></small>
  </b></h5>
  <hr>
  <p class="text-primary-5"><?php echo $this->lang->line('proceso_pago_3_total'); ?>:</p>
  <h5 class="text-primary-5"><b>
    <?php echo $_SESSION['divisa']['signo']; ?>
    <?php echo number_format($importe_total,2); ?>
    <small><?php echo $_SESSION['divisa']['iso']; ?></small>
  </b></h5>
<hr>
<?php $folio = folio_pedido();?>
<div class="row">
  <?php if($detalles_direccion['DIRECCION_PAIS']=='México'){ ?>
<div class="col">
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
    <input type="hidden" name="ComisionServicioFinancieroPorcentaje" value="0">
    <input type="hidden" name="ComisionServicioFinancieroFijo" value="0">
    <input type="hidden" name="ImporteDescuento" value="<?php echo $importe_descuento ; ?>">
    <input type="hidden" name="DescripcionDescuento" value="<?php echo $descripcion_descuento ; ?>">
    <input type="hidden" name="ImporteTotal" value="<?php echo $importe_total ; ?>">
    <input type="hidden" name="IdTransportista" value="<?php echo $id_transportista_abanico ; ?>">
    <input type="hidden" name="NombreTransportista" value="<?php echo $nombre_transportista_abanico ; ?>">
      <button type="submit" class="btn btn-dark btn-lg btn-block btn-transfer"><?php echo $this->lang->line('proceso_pago_3_transferencia'); ?> <span class="fas fa-money-bill-alt"></span></button>
  </form>
</div>
<?php } ?>
<?php if($detalles_direccion['DIRECCION_PAIS']=='México'){ ?>
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

    <?php
      $porcentaje_servicio_financiero = 4.6;
      $fijo_servicio_financiero = 0;
    ?>
    <input type="hidden" name="ComisionServicioFinancieroPorcentaje" value="<?php echo $porcentaje_servicio_financiero; ?>">
    <input type="hidden" name="ComisionServicioFinancieroFijo" value="<?php echo $fijo_servicio_financiero; ?>">
    <input type="hidden" name="ImporteDescuento" value="<?php echo $importe_descuento ; ?>">
    <input type="hidden" name="DescripcionDescuento" value="<?php echo $descripcion_descuento ; ?>">
    <input type="hidden" name="ImporteTotal" value="<?php echo $importe_total ; ?>">
    <input type="hidden" name="IdTransportista" value="<?php echo $id_transportista_abanico ; ?>">
    <input type="hidden" name="NombreTransportista" value="<?php echo $nombre_transportista_abanico ; ?>">
      <button type="submit" class="btn btn-danger btn-lg btn-block btn-transfer"><?php echo $this->lang->line('proceso_pago_3_oxxo'); ?> <span class="fas fa-cash-register"></span></button>
  </form>
</div>
<?php } ?>
<?php if($_SESSION['divisa']['iso']=='MXN'){ ?>
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
    <?php
      $porcentaje_servicio_financiero = 4.6;
      $fijo_servicio_financiero = 4;
    ?>
    <input type="hidden" name="ComisionServicioFinancieroPorcentaje" value="<?php echo $porcentaje_servicio_financiero; ?>">
    <input type="hidden" name="ComisionServicioFinancieroFijo" value="<?php echo $fijo_servicio_financiero; ?>">
    <input type="hidden" name="ImporteDescuento" value="<?php echo $importe_descuento ; ?>">
    <input type="hidden" name="DescripcionDescuento" value="<?php echo $descripcion_descuento ; ?>">
    <input type="hidden" name="ImporteTotal" value="<?php echo $importe_total ; ?>">
    <input type="hidden" name="IdTransportista" value="<?php echo $id_transportista_abanico ; ?>">
    <input type="hidden" name="NombreTransportista" value="<?php echo $nombre_transportista_abanico ; ?>">
      <button type="submit" class="btn btn-light btn-lg btn-block btn-paypal text-primary-18"><?php echo $this->lang->line('proceso_pago_3_paypal'); ?> <span class="fab fa-paypal"></span></button>
  </form>
</div>
<?php } ?>
</div>
</div>
