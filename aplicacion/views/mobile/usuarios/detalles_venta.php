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
            <div class="col mt-3">
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
                        <input type="hidden" name="PedidoImporte" value="<?php echo $pedido['PEDIDO_IMPORTE_TOTAL']; ?>">
                        <input type="hidden" name="FormaPago" value="Transferencia Bancaria">
                        <input type="hidden" name="DescripcionPago" value="Comprobante de cliente">
                        <input type="hidden" name="EstadoPago" value="Comprobante">
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
                      <a href="<?php echo base_url('contenido/adjuntos/pedidos/').$pago->PAGO_ARCHIVO; ?>" target="_blank" class="btn btn-outline-success btn-sm">Descargar</a>
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
              <p> <i class="fa fa-store"></i> <b><?php echo $tienda['TIENDA_NOMBRE']; ?></b></p>
              <table class="table table-sm">
                <tr>
                  <td><?php echo $this->lang->line('usuario_detalles_envio_guia'); ?>:<br><b><?php echo $pedido_tienda['GUIA_PAQUETERIA']; ?></b></td>
                  <td>
                      <a href="<?php echo $pedido_tienda['URL_RASTREO']; ?>" target="_blank" class="btn btn-outline-primary btn-sm btn-block"> <?php echo $this->lang->line('usuario_detalles_envio_rastrear'); ?></a>
                      <a href="<?php echo base_url('admin/guias/imprimir_limpia?id_pedido='.$pedido_tienda['ID_PEDIDO'].'&id_tienda='.$pedido_tienda['ID_TIENDA']); ?>" class="btn btn-sm btn-block btn-success" target="_blank"> <i class="fa fa-print"></i> Imprimir</a>
                      <?php if (!empty($pedido_tienda['GUIA_PAQUETERIA'])){ ?>
                      <a href="<?php echo base_url('usuario/ventas/enviar_correo?id_pedido='.$pedido_tienda['ID_PEDIDO'].'&id_tienda='.$pedido_tienda['ID_TIENDA'].'&tipo_mensaje=guia'); ?>" class="btn btn-sm btn-block btn-info"> <i class="fa fa-envelope"></i> Enviar guía por correo</a>
                      <?php } ?>
                  </td>
                </tr>
              </table>
                <?php if (empty($pedido_tienda['GUIA_PAQUETERIA'])){ ?>
                    <div class="card border">
                      <div class="card-body">
                        <h6> <i class="fa fa-receipt"></i> <?php echo $this->lang->line('usuario_detalles_crear_guia'); ?></h6>
                        <form class="" action="<?php echo base_url('usuario/ventas/guia'); ?>" method="post">
                          <input type="hidden" name="IdPedido" value="<?php echo $pedido['ID_PEDIDO'] ?>">
                          <input type="hidden" name="IdPedidoTienda" value="<?php echo $pedido_tienda['ID'] ?>">
                          <input type="hidden" name="IdTienda" value="<?php echo $tienda['ID_TIENDA'] ?>">
                          <div class="form-group">
                            <label for="GuiaPaqueteria"><?php echo $this->lang->line('usuario_detalles_numero_guia'); ?></label>
                            <input type="text" class="form-control" name="GuiaPaqueteria" value="">
                          </div>
                          <div class="form-group">
                            <label for="UrlRastreo"><?php echo $this->lang->line('usuario_detalles_url_rastreo'); ?></label>
                            <input type="text" class="form-control" name="UrlRastreo" value="">
                          </div>
                          <button type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-receipt"></i> <?php echo $this->lang->line('usuario_detalles_cargar_numero_guia'); ?></button>
                        </form>
                      </div>
                    </div>
                <?php } // Si no hay Guía ?>
            </div>
          </div>
        </div>
      </div>
    </div>
