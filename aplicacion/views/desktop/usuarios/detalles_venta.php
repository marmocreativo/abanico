<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <div class="row">
            <div class="col-8">
              <?php retro_alimentacion(); ?>
              <div class="card">
                <div class="card-header d-flex justify-content-between">
                  <div class="titulo">
                    <h2 class="h5 mb-0"> <span class="fa fa-shoppping-bag"></span> Folio: <?php echo $pedido['PEDIDO_FOLIO'] ?></h2>
                  </div>
                </div>
                <div class="card-body py-2">
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <address>
                            <strong><?php echo $pedido['PEDIDO_NOMBRE'] ?></strong>
                            <br>
                            <?php echo $pedido['PEDIDO_CORREO']; ?>
                            <br>
                            <?php echo $pedido['PEDIDO_DIRECCION']; ?>
                            <br>
                            <?php echo $pedido['PEDIDO_TELEFONO']; ?>
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
                              <?php  echo number_format($pedido_tienda['PEDIDO_TIENDA_IMPORTE_PRODUCTOS'],2); ?>
                              <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                              </h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-right" style="width:75%"><b>Envio:</b></td>
                            <td>
                              <h5>
                              <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                              <?php  echo number_format($pedido_tienda['PEDIDO_TIENDA_IMPORTE_ENVIO'],2); ?>
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
            <div class="col-4">
              <h6>Estado del pedido:<b> <?php echo $pedido['PEDIDO_ESTADO_PEDIDO']; ?></b></h6>
              <hr>
              <div class="card">
                <div class="card-header">
                  <h6><i class="fa fa-money-bill"></i> Pago: <?php echo $pedido['PEDIDO_FORMA_PAGO']; ?> <b><?php echo $pedido['PEDIDO_ESTADO_PAGO']; ?></b></h6>
                </div>
                <div class="card-body">
                  <div class="row">
                  <?php foreach($pagos as $pago){ ?>
                    <div class="col-4">
                      <img src="<?php echo base_url('contenido/adjuntos/pedidos/').$pago->PAGO_ARCHIVO; ?>" alt="" class="img-fluid">
                      <hr>
                      <a href="<?php echo base_url('contenido/adjuntos/pedidos/').$pago->PAGO_ARCHIVO; ?>" target="_blank" class="btn btn-outline-success btn-sm">Descargar</a>
                    </div>
                    <div class="col-4">
                      <p>Folio:<br>
                        <b><?php echo $pago->PAGO_FOLIO; ?></b>
                      </p>
                    </div>
                    <div class="col-4">
                      <p>Fecha:
                      <b><?php echo $pago->PAGO_FECHA_REGISTRO; ?></b>
                      </p>
                    </div>
                  <?php } ?>
                  </div>
                </div>
              </div>
              <hr>
              <h6> <i class="fa fa-truck"></i> Envio y Rastreo: </h6>
              <p> <i class="fa fa-store"></i> <b><?php echo $tienda['TIENDA_NOMBRE']; ?></b></p>
              <table class="table table-sm">
                <tr>
                  <td>Guía:<br><b><?php echo $pedido_tienda['GUIA_PAQUETERIA']; ?></b></td>
                  <td><a href="<?php echo $pedido_tienda['URL_RASTREO']; ?>" target="_blank" class="btn btn-outline-primary btn-sm btn-block"> Rastrear</a></td>
                </tr>
              </table>
                <?php if (empty($pedido_tienda['GUIA_PAQUETERIA'])){ ?>
                    <div class="card border">
                      <div class="card-body">
                        <h6> <i class="fa fa-receipt"></i> Cargar Número de Guía</h6>
                        <form class="" action="<?php echo base_url('usuario/ventas/guia'); ?>" method="post">
                          <input type="hidden" name="IdPedido" value="<?php echo $pedido['ID_PEDIDO'] ?>">
                          <input type="hidden" name="IdPedidoTienda" value="<?php echo $pedido_tienda['ID'] ?>">
                          <input type="hidden" name="IdTienda" value="<?php echo $tienda['ID_TIENDA'] ?>">
                          <div class="form-group">
                            <label for="GuiaPaqueteria">Número de Guía</label>
                            <input type="text" class="form-control" name="GuiaPaqueteria" value="">
                          </div>
                          <div class="form-group">
                            <label for="UrlRastreo">Url de Rastreo</label>
                            <input type="text" class="form-control" name="UrlRastreo" value="">
                          </div>
                          <button type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-receipt"></i> Cargar Número de Guía</button>
                        </form>
                      </div>
                    </div>
                <?php } // Si no hay Guía ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
