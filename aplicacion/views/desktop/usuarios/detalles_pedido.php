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
            <div class="col-4">
              <h6>Estado del pedido:<b> <?php echo $pedido['PEDIDO_ESTADO_PEDIDO']; ?></b></h6>
              <hr>
              <div class="card">
                <div class="card-header">
                  <h6><i class="fa fa-money-bill"></i> Pago: <?php echo $pedido['PEDIDO_FORMA_PAGO']; ?> <b><?php echo $pedido['PEDIDO_ESTADO_PAGO']; ?></b></h6>
                </div>
                <div class="card-body">
                  <div class="row">
                  <?php if($pedido['PEDIDO_ESTADO_PAGO']=='Pendiente' && $pedido['PEDIDO_FORMA_PAGO']=='Transferencia Bancaria'){ ?>
                    <div class="col">
                      <form class="" action="<?php echo base_url('usuario/pedidos/subir_comprobante'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="IdPedido" value="<?php echo $pedido['ID_PEDIDO']; ?>">
                        <input type="hidden" name="FormaPago" value="Transferencia Bancaria">
                        <input type="hidden" name="DescripcionPago" value="Comprobante de cliente">
                        <input type="hidden" name="EstadoPago" value="Verificando">
                        <div class="form-group">
                          <label for="FolioPago">Folio o Número de transacción</label>
                          <input type="text" class="form-control" name="FolioPago" value="">
                        </div>
                        <div class="form-group">
                          <label for="ArchivoPago">Subir Archivo Comprobante</label>
                          <input type="file" class="form-control" name="ArchivoPago" value="" required>
                        </div>
                        <button type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-upload"></i> Subir Comprobante</button>
                      </form>
                    </div>
                  <?php }// Si el Pago está pendientes y es por transferencia Bancaria ?>
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
              <p><b>Abanico</b></p>
              <?php foreach($guias_abanico as $guia){ ?>
              <table class="table table-sm">
                <tr>
                  <td>Guía:<br><b><?php echo $guia->GUIA_CODIGO; ?></b></td>
                  <td>
                    <a href="<?php echo base_url('guia?guia='.$guia->GUIA_CODIGO); ?>" class="btn btn-outline-primary btn-sm btn-block"> Rastrear</a>
                  </td>
                </tr>
              </table>
            <?php }// Bucle guias Abanico ?>
              <?php foreach($tiendas as $tienda){ ?>
                <?php if($tienda->PEDIDO_TIENDA_IMPORTE_ENVIO>0){ ?>
              <p> <i class="fa fa-store"></i> <b><?php echo $tienda->TIENDA_NOMBRE; ?></b></p>
              <table class="table table-sm">
                <?php if (empty($tienda->GUIA_PAQUETERIA)){ ?>
                  <tr>
                    <td>Aún no hay un número de Guía asignado</td>
                  </tr>
                <?php }else{ // Condicional Guia ?>
                    <tr>
                      <td>Guía:<br><b><?php echo $tienda->GUIA_PAQUETERIA; ?></b></td>
                      <td><a href="<?php echo $tienda->URL_RASTREO; ?>" target="_blank" class="btn btn-outline-primary btn-sm btn-block"> Rastrear</a></td>
                    </tr>
                <?php } ?>
              </table>
            <?php }// Condicional del importe del envio ?>
          <?php } // Bucle de tiendas ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
