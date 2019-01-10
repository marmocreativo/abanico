  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col">
                    <b>Fecha:</b> <?php echo $pedido['PEDIDO_FECHA_REGISTRO']; ?>
                  </div>
                  <div class="col">
                    <b>Importe:</b> <?php echo $pedido['PEDIDO_IMPORTE_TOTAL']; ?>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-8">
            <div class="card">
              <div class="card-header">
                <h6> <i class="fa fa-file"></i> Folio: <b><?php echo $pedido['PEDIDO_FOLIO']; ?></b></h6>
              </div>
              <div class="card-body">
                <div class="border border-info p-3">
                  <form class="" action="<?php echo base_url('admin/pedidos/actualizar_estado'); ?>" method="post">
                    <input type="hidden" name="IdPedido" value="<?php echo $pedido['ID_PEDIDO']; ?>">
                    <div class="row">
                      <div class="col-3">
                        <label class="my-1 mr-2" for="EstadoPedido">Estado del pedido:</label>
                      </div>
                      <div class="col-6">
                          <select class="form-control" name="EstadoPedido">
                            <option value="Espera Pago" <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='Espera Pago'){ echo 'selected';} ?>>Espera Pago</option>
                            <option value="Pagado" <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='Pagado'){ echo 'selected';} ?>>Pagado</option>
                            <option value="Error Pago" <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='Error Pago'){ echo 'selected';} ?>>Error Pago</option>
                            <option value="Pago Aceptado" <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='Pago Aceptado'){ echo 'selected';} ?>>Pago Aceptado</option>
                            <option value="Preparacion" <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='Preparacion'){ echo 'selected';} ?>>Preparacion</option>
                            <option value="Envio Parcial" <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='Envio Parcial'){ echo 'selected';} ?>>Envio Parcial</option>
                            <option value="Enviado" <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='Enviado'){ echo 'selected';} ?>>Enviado</option>
                            <option value="Entregado" <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='Entregado'){ echo 'selected';} ?>>Entregado</option>
                          </select>
                      </div>
                      <div class="col-3">
                           <button type="submit" class="btn btn-info btn-block">Actualizar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h6><i class="fa fa-money-bill"></i>Pagos:</h6>
              </div>
              <div class="card-body">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Método de Pago</th>
                      <th>ID Transacción</th>
                      <th>Cantidad</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="4">
                        <div class="alert alert-info">
                          <p>Sección en desarrollo</p>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!--
                <form class="" action="<?php echo base_url('admin/pedidos/pagar'); ?>" method="post">
                <table class="table table-sm">
                  <thead>
                  <tbody>
                    <tr>
                      <td>
                        <input type="datetime-local" class="form-control" name="FechaPago" value="<?php echo date('Y-m-d H:i:s'); ?>">
                      </td>
                      <td>
                        <select class="form-control" name="EstadoPedido">
                          <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                        </select>
                      </td>
                      <td><input type="text" class="form-control" name="FolioPago" value=""></td>
                      <td>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input type="number" step="0.01" class="form-control" name="FolioPago" value="0.00">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                </form>
              -->
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-header">
                <h6> <i class="fa fa-user-tag"></i> Cliente</h6>
              </div>
              <div class="card-body">
                <p><b>Nombre:</b><br>
                  <?php echo $pedido['PEDIDO_NOMBRE']; ?>
                </p>
                <p><b>Teléfono:</b><br>
                  <?php echo $pedido['PEDIDO_TELEFONO']; ?>
                </p>
                <p><b>Correo:</b><br>
                  <?php echo $pedido['PEDIDO_CORREO']; ?>
                </p>
                <p><b>Dirección de entrega:</b><br>
                  <?php echo $pedido['PEDIDO_DIRECCION']; ?>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <?php foreach($tiendas as $tienda){ ?>
            <div class="card">
              <div class="card-header">
                <h6> <i class="fa fa-store"></i> Tienda: <b><?php echo $tienda->TIENDA_NOMBRE; ?></b></h6>
              </div>
              <div class="card-body">

                  <table class="table">
                    <thead>
                      <th style="width:50%">Producto</th>
                      <th style="width:10%" class="text-center">Cantidad</th>
                      <th style="width:20%" class="text-right">Precio</th>
                      <th style="width:20%" class="text-right">Total</th>
                    </thead>
                    <tbody
                        <?php foreach ($productos as $producto){ ?>
                          <?php if($producto->ID_TIENDA==$tienda->ID_TIENDA){ ?>
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
                        <?php }// Termina Foreach de Productos ?>
                    </tbody>
                  </table>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-3">
                    <p>Importe Productos: <b>$<?php echo $tienda->PEDIDO_TIENDA_IMPORTE_PRODUCTOS; ?></b></p>
                  </div>
                  <div class="col-3">
                    <p>Importe Envío: <b>$<?php echo $tienda->PEDIDO_TIENDA_IMPORTE_ENVIO; ?></b><br><small>Envios Por: <b><?php echo $tienda->TIENDA_ADMINISTRACION_PEDIDOS; ?></b></small></p>
                  </div>
                  <div class="col-3">
                      <p>Transportista: <b><?php if(empty($tienda->TRANSPORTISTA_NOMBRE)) { echo'Envio Completo con Abanico'; }else{ echo $tienda->TRANSPORTISTA_NOMBRE; } ?></b></p>
                  </div>
                  <div class="col-3">
                    <p>Guía: <b><?php echo $tienda->GUIA_PAQUETERIA; ?></b></p>
                    <?php //if(empty($tienda->GUIA_PAQUETERIA)){ echo '<a href="'.base_url('admin/pedidos/guia?id_pedido='.$pedido['ID_PEDIDO'].'&id_tienda'.$tienda->ID_TIENDA).'">Crear Guía de envío</a>'; } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php } // Termina Foreach de Tiendas ?>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h6> <i class="fa fa-truck"></i> Envio por Abanico</h6>
              </div>
              <div class="card-body">

                <table class="table">
                  <thead>
                    <tr>
                      <th style="width:20%">Guía</th>
                      <th style="width:60%">Destinatario</th>
                      <th style="width:10%">Estado</th>
                      <th style="width:10%">Actualizado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($guias as $guia){ ?>
                    <tr>
                      <td>
                        <a href="<?php echo base_url('admin/guias/detalles?guia='.$guia->GUIA_CODIGO);  ?>">
                          <?php echo $guia->GUIA_CODIGO; ?>
                        </a>
                      </td>
                      <td>
                        <p><?php echo $guia->GUIA_NOMBRE; ?><br>
                        <i class="fa fa-home"></i> <?php echo $guia->GUIA_DIRECCION; ?><br>
                        <i class="fa fa-phone"></i> <?php echo $guia->GUIA_TELEFONO; ?><br>
                        <i class="fa fa-envelope"></i> <?php echo $guia->GUIA_CORREO; ?></p>
                      </td>
                      <td><?php echo $guia->GUIA_ESTADO; ?></td>
                      <td><?php echo $guia->GUIA_FECHA_ACTUALIZACION; ?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
                <form class="" action="<?php echo base_url('admin/pedidos/guia'); ?>" method="post">
                  <input type="hidden" name="IdPedido" value="<?php echo $pedido['ID_PEDIDO']; ?>">
                  <input type="hidden" name="NombreGuia" value="<?php echo $pedido['PEDIDO_NOMBRE']; ?>">
                  <input type="hidden" name="DireccionGuia" value="<?php echo $pedido['PEDIDO_DIRECCION']; ?>">
                  <input type="hidden" name="TelefonoGuia" value="<?php echo $pedido['PEDIDO_TELEFONO']; ?>">
                  <input type="hidden" name="CorreoGuia" value="<?php echo $pedido['PEDIDO_CORREO']; ?>">
                  <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-receipt"></i> Nueva Guía</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
