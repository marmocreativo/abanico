<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <div class="row">
            <div class="col-8">
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
                            <th style="width:20%" class="text-right"><?php echo $this->lang->line('usuario_lista_pedidos_precio'); ?></th>
                            <th style="width:20%" class="text-right"><?php echo $this->lang->line('usuario_lista_pedidos_total'); ?></th>
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
                            <td class="text-right" style="width:75%"><b><?php echo $this->lang->line('usuario_detalles_pedido_importe_producto'); ?>:</b></td>
                            <td>
                              <h5>
                              <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                              <?php  echo number_format($pedido['PEDIDO_IMPORTE_PRODUCTOS_TOTAL'],2); ?>
                              <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                              </h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-right" style="width:75%"><b><?php echo $this->lang->line('usuario_detalles_pedido_envio_abanico'); ?>:</b><br> <span class="text-muted"><?php echo $this->lang->line('usuario_detalles_pedido_envio_abanico_instrucciones'); ?></span> </td>
                            <td>
                              <h5>
                              <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                              <?php  echo number_format($pedido['PEDIDO_IMPORTE_ENVIO_PARCIAL'],2); ?>
                              <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                              </h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-right" style="width:75%"><b><?php echo $this->lang->line('usuario_detalles_pedido_envio_otras_tiendas'); ?>:</b><br> <span class="text-muted"><?php echo $this->lang->line('usuario_detalles_pedido_envio_otras_tiendas_instrucciones'); ?></span> </td>
                            <td>
                              <h5>
                              <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                              <?php  echo number_format($pedido['PEDIDO_IMPORTE_ENVIO_TOTAL']-$pedido['PEDIDO_IMPORTE_ENVIO_PARCIAL'],2); ?>
                              <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                              </h5>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-right" style="width:75%"><b><?php echo $this->lang->line('usuario_detalles_pedido_total'); ?>:</b></td>
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
              <h6><?php echo $this->lang->line('usuario_detalles_estado_pedido'); ?>:<b> <?php echo $pedido['PEDIDO_ESTADO_PEDIDO']; ?></b></h6>
              <hr>
              <div class="card">
                <div class="card-header">
                  <h6><i class="fa fa-money-bill"></i> <?php echo $this->lang->line('usuario_detalles_forma_pago'); ?>: <?php echo $pedido['PEDIDO_FORMA_PAGO']; ?> <b><?php echo $pedido['PEDIDO_ESTADO_PAGO']; ?></b></h6>
                </div>
                <div class="card-body">
                  <!--Permisos cancelados si el estado está Cancelado-->
                  <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='Cancelado' || $pedido['PEDIDO_ESTADO_PEDIDO']=='Solicitud Devolucion' || $pedido['PEDIDO_ESTADO_PEDIDO']=='Devolucion'){ ?>
                    <div class="row">
                      <div class="col">
                        <h6><?php echo $this->lang->line('usuario_detalles_estado_pedido_instrucciones'); ?> <?php echo $pedido['PEDIDO_ESTADO_PEDIDO'] ?></h6>
                        <p><?php echo $this->lang->line('usuario_detalles_estado_pedido_desactivado'); ?>.</p>
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
                          <label for="FolioPago"><?php echo $this->lang->line('usuario_detalles_pago_folio'); ?></label>
                          <input type="text" class="form-control" name="FolioPago" value="">
                        </div>
                        <div class="form-group">
                          <label for="ArchivoPago"><?php echo $this->lang->line('usuario_detalles_pago_archivo'); ?></label>
                          <input type="file" class="form-control" name="ArchivoPago" value="" required>
                        </div>
                        <button type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-upload"></i> <?php echo $this->lang->line('usuario_detalles_pago_subir'); ?></button>
                      </form>
                    </div>
                    <div class="col-12 mt-3">
                      <div class="card border-danger">
                        <div class="card-body">
                          <h6><?php echo $this->lang->line('usuario_detalles_cancelar'); ?></h6>
                          <button data-enlace='<?php echo base_url('usuario/pedidos/cambiar_estado?id='.$pedido['ID_PEDIDO'].'&estado=Cancelado'); ?>' class="btn btn-danger btn-block borrar_entrada" title="Cancelar Pedido">
                            <?php echo $this->lang->line('usuario_detalles_cancelar_boton'); ?>
                          </button>
                        </div>
                      </div>
                    </div>
                  <?php }// Si el Pago está pendientes y es por transferencia Bancaria ?>
                  <?php foreach($pagos as $pago){ ?>
                    <div class="col-4">
                      <img src="<?php echo base_url('contenido/adjuntos/pedidos/').$pago->PAGO_ARCHIVO; ?>" alt="" class="img-fluid">
                      <hr>
                      <a href="<?php echo base_url('contenido/adjuntos/pedidos/').$pago->PAGO_ARCHIVO; ?>" target="_blank" class="btn btn-outline-success btn-sm"><?php echo $this->lang->line('usuario_lista_pago_descarga'); ?></a>
                    </div>
                    <div class="col-4">
                      <p><?php echo $this->lang->line('usuario_lista_pago_folio'); ?>:<br>
                        <b><?php echo $pago->PAGO_FOLIO; ?></b>
                      </p>
                    </div>
                    <div class="col-4">
                      <p><?php echo $this->lang->line('usuario_lista_pago_fecha'); ?>:
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
              <h6> <i class="fa fa-truck"></i> <?php echo $this->lang->line('usuario_detalles_envio_titulo'); ?>: </h6>
              <p><b><?php echo $this->lang->line('usuario_detalles_envio_abanico'); ?></b></p>
              <?php foreach($guias_abanico as $guia){ ?>
              <table class="table table-sm">
                <tr>
                  <td><?php echo $this->lang->line('usuario_detalles_envio_guia'); ?>:<br><b><?php echo $guia->GUIA_CODIGO; ?></b></td>
                  <td>
                    <a href="<?php echo base_url('guia?guia='.$guia->GUIA_CODIGO); ?>" class="btn btn-outline-primary btn-sm btn-block"> <?php echo $this->lang->line('usuario_detalles_envio_rastrear'); ?></a>
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
                    <td><?php echo $this->lang->line('usuario_detalles_envio_no_hay_guia'); ?></td>
                  </tr>
                <?php }else{ // Condicional Guia ?>
                    <tr>
                      <td><?php echo $this->lang->line('usuario_detalles_envio_guia'); ?>:<br><b><?php echo $tienda->GUIA_PAQUETERIA; ?></b></td>
                      <td><a href="<?php echo $tienda->URL_RASTREO; ?>" target="_blank" class="btn btn-outline-primary btn-sm btn-block"> <?php echo $this->lang->line('usuario_detalles_envio_rastrear'); ?></a></td>
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
                    <h6> <i class="fa fa-exclamation"></i> <?php echo $this->lang->line('usuario_detalles_devolucion_solicitar'); ?></h6>
                    <p><?php echo $this->lang->line('usuario_detalles_devolucion_instrucciones'); ?></p>
                    <form class="" action="<?php echo base_url('usuario/pedidos/devolucion') ?>" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="IdPedido" value="<?php echo $pedido['ID_PEDIDO']; ?>">
                      <div class="form-group">
                        <label for="ComentarioDevolucion"><?php echo $this->lang->line('usuario_detalles_devolucion_razon'); ?></label>
                        <textarea name="ComentarioDevolucion" class="form-control" rows="8"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="ArchivoDevolucion"><?php echo $this->lang->line('usuario_detalles_devolucion_imagen'); ?></label>
                        <input type="file" class="form-control" name="ArchivoDevolucion" value="">
                      </div>
                      <button type="submit" class="btn btn-primary float-right" name="button"><?php echo $this->lang->line('usuario_detalles_devolucion_enviar'); ?></button>
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
                    <h6><?php echo $this->lang->line('usuario_detalles_devolucion_solicitud'); ?></h6>
                    <p> <b><?php echo $this->lang->line('usuario_detalles_devolucion_mensaje'); ?>:</b> <?php echo $devolucion['DEVOLUCION_COMENTARIO'] ?></p>
                    <a href="<?php echo base_url('contenido/adjuntos/pedidos/').$devolucion['DEVOLUCION_ARCHIVO']; ?>" class="btn btn-outline-primary" target="_blank"> <i class="fa fa-download"></i> <?php echo $this->lang->line('usuario_detalles_devolucion_descargar_adjuntos'); ?></a>
                    <hr>
                    <h6><?php echo $this->lang->line('usuario_detalles_devolucion_respuesta'); ?></h6>
                    <p><?php echo $devolucion['DEVOLUCION_RESPUESTA'] ?></p>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
