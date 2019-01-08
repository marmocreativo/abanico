  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <address>
                    <strong><?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'] ?></strong>
                    <br>
                    <?php echo $_SESSION['usuario']['correo']; ?>
                    <br>
                    <?php echo $pedido['PEDIDO_DIRECCION']; ?>
                    <br>
                    <?php echo $usuario['USUARIO_TELEFONO']; ?>
                </address>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                <p>
                  <em>Fecha: <?php echo $pedido['PEDIDO_FECHA_REGISTRO']; ?></em>
                </p>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width:50%">Producto</th>
                    <th style="width:10%" class="text-center">Cantidad</th>
                    <th style="width:20%" class="text-right">Precio</th>
                    <th style="width:20%" class="text-right">Total</th>
                  </tr>
                </thead>
                <tbody>
                    <?php /* BUCLE DE PRODUCTOS*/ foreach($productos as $producto){ ?>
                      <tr>
                        <td style="vertical-align:middle">
                          <div class="d-flex">
                            <div class="w-25">
                              <img src="<?php echo $producto->PRODUCTO_IMAGEN;  ?>" class="img-thumbnail" width="70" alt="">
                            </div>
                            <div class="w-75 p-1">
                              <p class="h6"><?php echo $producto->PRODUCTO_NOMBRE;  ?></p>
                              <p style="font-size:0.8em;" class="mb-1"><?php echo $producto->PRODUCTO_DETALLES;  ?></p>
                            </div>
                          </div>
                        </td>
                        <td style="vertical-align:middle; text-align:center;">
                          <?php echo $producto->CANTIDAD;  ?>
                        </td>
                        <td style="vertical-align:middle" class="text-right">
                          <small>$</small>
                          <?php echo number_format($producto->IMPORTE,2);  ?>
                          <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                        </td>
                        <td style="vertical-align:middle" class="text-right">
                          <small>$</small>
                            <?php echo number_format($producto->IMPORTE_TOTAL,2);  ?>
                          <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                        </td>
                      </tr>
                    <?php } ?>
                </tbody>
              </table>
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td class="text-right" style="width:75%"><b>Importe Productos:</b></td>
                    <td>
                      <h5>
                      <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                      <?php  echo number_format($pedido['PEDIDO_IMPORTE_PRODUCTOS_TOTAL'],2); ?>
                      <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                      </h5>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-right" style="width:75%"><b>Envio Abanico:</b><br> <span class="text-muted">Los envios de productos de tiendas afiliadas a Abanico se calculan en un solo paquete</span> </td>
                    <td>
                      <h5>
                      <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                      <?php  echo number_format($pedido['PEDIDO_IMPORTE_ENVIO_PARCIAL'],2); ?>
                      <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                      </h5>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-right" style="width:75%"><b>Envio otras Tiendas:</b><br> <span class="text-muted">Los envios de productos de tiendas externas a Abanico se calculan por separado</span> </td>
                    <td>
                      <h5>
                      <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                      <?php  echo number_format($pedido['PEDIDO_IMPORTE_ENVIO_TOTAL']-$pedido['PEDIDO_IMPORTE_ENVIO_PARCIAL'],2); ?>
                      <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                      </h5>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-right" style="width:75%"><b>Total:</b></td>
                    <td>
                      <h5>
                      <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                      <?php  echo number_format($pedido['PEDIDO_IMPORTE_TOTAL'],2); ?>
                      <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                      </h5>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
