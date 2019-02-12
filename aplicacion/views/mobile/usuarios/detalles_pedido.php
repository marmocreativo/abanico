<div class="fila-gris">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('mobile/usuarios/widgets/menu_control_usuario'); ?>
      </div>
    </div>
  </div>
  <?php retro_alimentacion(); ?>
</div>

    <div class="container py-3 mb-3">
      <div class="row">
        <div class="col">
          <div class="row">
            <div class="col">
              <?php retro_alimentacion(); ?>
              <div class="card">
                <div class="card-header d-flex justify-content-between">
                  <div class="titulo">
                    <h2 class="h5 mb-0"> <span class="fa fa-shoppping-bag"></span> <?php echo $this->lang->line('usuario_lista_pedidos_folio'); ?>: <?php echo $pedido['PEDIDO_FOLIO'] ?></h2>
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
                          <em><?php echo $this->lang->line('usuario_lista_pedidos_fecha'); ?>: <?php echo $pedido['PEDIDO_FECHA_REGISTRO']; ?></em>
                        </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th style="width:50%"><?php echo $this->lang->line('usuario_lista_pedidos_producto'); ?></th>
                            <th style="width:10%" class="text-center"><?php echo $this->lang->line('usuario_lista_pedidos_cantidad'); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php /* BUCLE DE PRODUCTOS*/ foreach($productos as $producto){ ?>
                              <tr>
                                <td style="vertical-align:middle">
                                      <img src="<?php echo $producto->PRODUCTO_IMAGEN;  ?>" class="img-thumbnail" width="70" alt="">
                                      <p class="h6"><?php echo $producto->PRODUCTO_NOMBRE;  ?></p>
                                      <p style="font-size:0.8em;" class="mb-1"><?php echo $producto->PRODUCTO_DETALLES;  ?></p>
                                </td>
                                <td style="vertical-align:middle; text-align:center;">
                                  x<?php echo $producto->CANTIDAD;  ?>
                                  <br>

                                    <small>$</small>
                                    <?php echo number_format($producto->IMPORTE,2);  ?>
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
            <div class="col mt-3">
              <h6>Estado del pedido:<b> <?php echo $pedido['PEDIDO_ESTADO_PEDIDO']; ?></b></h6>
              <hr>
              <div class="card">
                <div class="card-header">
                  <h6><i class="fa fa-money-bill"></i> Pago: <?php echo $pedido['PEDIDO_FORMA_PAGO']; ?> <b><?php echo $pedido['PEDIDO_ESTADO_PAGO']; ?></b></h6>
                </div>
                <div class="card-body">
                  <!--Permisos cancelados si el estado está Cancelado-->
                  <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='Cancelado' || $pedido['PEDIDO_ESTADO_PEDIDO']=='Solicitud Devolucion' || $pedido['PEDIDO_ESTADO_PEDIDO']=='Devolucion'){ ?>
                    <div class="row">
                      <div class="col">
                        <h6>Tu pedido se encuentra en estado de <?php echo $pedido['PEDIDO_ESTADO_PEDIDO'] ?></h6>
                        <p>Las funciones de control y datos de guías no son visibles, si crees que esto es un error por favor comunicate con nosotros.</p>
                      </div>
                    </div>
                  <?php }else{ ?>
                  <div class="row">
                    <!--Permisos para pagar y cancelar -->
                  <?php if($pedido['PEDIDO_ESTADO_PAGO']=='Pendiente' && $pedido['PEDIDO_FORMA_PAGO']=='Transferencia Bancaria'){ ?>
                    <div class="col-12">
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
                    <div class="col-12 mt-3">
                      <div class="card border-danger">
                        <div class="card-body">
                          <h6>Cancelar Pedido</h6>
                          <button data-enlace='<?php echo base_url('usuario/pedidos/cambiar_estado?id='.$pedido['ID_PEDIDO'].'&estado=Cancelado'); ?>' class="btn btn-danger btn-block borrar_entrada" title="Cancelar Pedido">
                            Cancelar Pedido
                          </button>
                        </div>
                      </div>
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
                  <!--/Permisos para pagar y cancelar -->
                  </div>
                <?php } ?>
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
          <!--Permisos cancelados si el estado está Pagado-->
          <?php if($pedido['PEDIDO_ESTADO_PAGO']=='Pagado' && $pedido['PEDIDO_ESTADO_PEDIDO']=='Entregado'){ ?>
          <div class="row mt-3">
            <div class="col">
              <div class="card border-warning">
                <div class="card-body">
                    <h6> <i class="fa fa-exclamation"></i> Solicitar Devolución</h6>
                    <p>Si ha ocurrido un problema con tu pedido, puedes solicitar la devolución por favor consulta nuestros terminos y condiciones para estar confirmar que seas candidato a una devolución</p>
                    <form class="" action="<?php echo base_url('usuario/pedidos/devolucion') ?>" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="IdPedido" value="<?php echo $pedido['ID_PEDIDO']; ?>">
                      <div class="form-group">
                        <label for="ComentarioDevolucion">Razón de la Solicitud</label>
                        <textarea name="ComentarioDevolucion" class="form-control" rows="8"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="ArchivoDevolucion">Adjuntar Imagen</label>
                        <input type="file" class="form-control" name="ArchivoDevolucion" value="">
                      </div>
                      <button type="submit" class="btn btn-primary float-right" name="button">Enviar Solicitud</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <!--Permisos cancelados si el estado está Pagado-->
          <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='Solicitud Devolucion' || $pedido['PEDIDO_ESTADO_PEDIDO']=='Devolucion' || $pedido['PEDIDO_ESTADO_PEDIDO']=='Devolucion Denegada'){ ?>
          <?php $devolucion = $this->DevolucionesModel->detalles($pedido['ID_PEDIDO']); ?>
          <div class="row mt-3">
            <div class="col">
              <div class="card border-warning">
                <div class="card-body">
                    <h6>Solicitud de devolución</h6>
                    <p> <b>Mensaje:</b> <?php echo $devolucion['DEVOLUCION_COMENTARIO'] ?></p>
                    <a href="<?php echo base_url('contenido/adjuntos/pedidos/').$devolucion['DEVOLUCION_ARCHIVO']; ?>" class="btn btn-outline-primary" target="_blank"> <i class="fa fa-download"></i> Descargar Adjunto</a>
                    <hr>
                    <h6>Respuesta</h6>
                    <p><?php echo $devolucion['DEVOLUCION_RESPUESTA'] ?></p>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
