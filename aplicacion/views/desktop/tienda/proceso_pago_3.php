<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10">
        <div class="card mb-3">
          <div class="card-body">
            <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" class="btn btn-default btn-circle" disabled="disabled">1</a>
                  <p>Identificación</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-default btn-circle"  disabled="disabled" >2</a>
                  <p>Dirección</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-primary btn-circle">3</a>
                  <p>Pago</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                  <p>Confirmación</p>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                      <address>
                          <strong><?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'] ?></strong>
                          <br>
                          <?php echo $_SESSION['usuario']['correo']; ?>
                          <br>
                          <?php echo $direccion; ?>
                          <br>
                          <?php echo $usuario['USUARIO_TELEFONO']; ?>
                      </address>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                      <p>
                          <em>Fecha: <?php echo date('d / m / Y'); ?></em>
                      </p>
                  </div>
                </div>
                  <?php
                  // Variables globales
                    $envio_posible = true;
                    $suma_productos=0;
                    $suma_peso=0;
                    $envio_default = 100;
                    //----
                    $peso_pedido_abanico = 0;
                    $importe_pedido_abanico = 0;
                    $envio_pedido_abanico = 0;
                    //---
                    $peso_pedido_tiendas = 0;
                    $importe_pedido_tiendas = 0;
                    $envio_pedido_tiendas = 0;
                    //---
                    $peso_pedido_total = 0;
                    $importe_pedido_total = 0;
                    $envio_pedido_total = 0;
                    // Inicio el array de tiendas de pedidos
                    $pedidos_tienda = array();
                  ?>
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
                        <?php /* BUCLE DE TIENDAS*/ foreach($_SESSION['carrito']['tiendas'] as $id_tienda => $tienda){ ?>
                          <?php
                            $datos_tienda = $this->TiendasModel->detalles($id_tienda);
                            // creo el key del array de pedidos tienda;
                            $pedido_tienda[$id_tienda]=array();
                          ?>
                          <?php /* BUCLE DE PRODUCTOS*/ foreach($_SESSION['carrito']['productos'] as $producto){ ?>
                            <?php if($producto['id_tienda']==$id_tienda){ ?>
                            <tr>
                              <td style="vertical-align:middle">
                                <div class="d-flex">
                                  <div class="w-25">
                                    <img src="<?php echo $producto['imagen_producto'];  ?>" class="img-thumbnail" width="70" alt="">
                                  </div>
                                  <div class="w-75 p-1">
                                    <a href="#" class="h6"><?php echo $producto['nombre_producto'];  ?></a>
                                    <p style="font-size:0.8em;" class="mb-1">Vendido por: <a href="#"><?php echo $producto['nombre_tienda'];  ?></a></p>
                                    <p style="font-size:0.8em;" class="mb-1"><?php echo $producto['detalles_producto'];  ?></p>
                                    <p style="font-size:0.8em;" class="mb-1"><?php $peso = $producto['cantidad_producto']*$producto['peso_producto']; echo $producto['peso_producto'];  ?>kg</p>
                                  </div>
                                </div>
                              </td>
                              <td style="vertical-align:middle; text-align:center;">
                                <?php echo $producto['cantidad_producto'];  ?>
                              </td>
                              <td style="vertical-align:middle" class="text-right">
                                <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                                <?php echo number_format($_SESSION['divisa']['conversion']*$producto['precio_producto'],2);  ?>
                                <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                              </td>
                              <td style="vertical-align:middle" class="text-right">
                                <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                                  <?php $suma = $producto['cantidad_producto']*$producto['precio_producto']; echo number_format($_SESSION['divisa']['conversion']*$suma,2);  ?>
                                <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                              </td>
                            </tr>
                            <?php
                              // Sumas de bucle
                              $suma_productos +=  $suma;
                              $suma_peso += $peso;
                              $pedido_tienda[$id_tienda]['ImporteProductos']=$suma_productos;
                            ?>
                          <?php }// Termina la condición que revisa si un producto es de una tienda o de otra ?>
                        <?php } // Termina el bucle de productos ?>
                        <?php /* SI LA TIENDA NO LA ADMINISTRA ABANICO*/ if($datos_tienda['TIENDA_ADMINISTRACION_PEDIDOS']!='abanico'){

                            $envio_tienda = $this->TransportistasRangosModel->mejor_precio($suma_peso,$suma_productos,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO']);
                            //var_dump($envio_tienda);
                            $pedido_tienda[$id_tienda]['ImporteEnvio']=number_format($_SESSION['divisa']['conversion']*$envio_tienda['IMPORTE'],2,'.','');
                            $pedido_tienda[$id_tienda]['IdTransportista']=$envio_tienda['ID_TRANSPORTISTA'];
                            $pedido_tienda[$id_tienda]['NombreTransportista']=$envio_tienda['TRANSPORTISTA_NOMBRE'];
                            $envio_pedido_tiendas +=$envio_tienda['IMPORTE'];
                            $envio_pedido_total +=$envio_tienda['IMPORTE'];

                            if(empty($envio_tienda)){ ?>
                              <td colspan="4" class="table-warning text-right">
                                <p> Los productos Exceden el peso máximo o tu dirección no está disponible para envíos. Por favor contacta con nosotros para ofrecerte opciones.</p>
                              </td>
                            <?php }else{ ?>
                              <tr>
                                <td colspan="3" class="text-right">
                                  <p>Envio de productos de <?php echo $tienda; ?></p>
                                </td>
                                <td class="text-right">
                                  <h6>
                                    <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                                    <strong><?php echo number_format( $envio_tienda['IMPORTE'],2); ?></strong>
                                    <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                                  </h6>
                                </td>
                              </tr>
                            <?php } ?>
                        <?php }else{   ?>
                          <tr>
                            <td colspan="4" class="table-info text-right">
                              <p> Productos enviados por Abanico, el costo de Envío aparecerá en la parte inferior.</p>
                            </td>
                            <?php
                              $pedido_tienda[$id_tienda]['ImporteEnvio']='0';
                              $pedido_tienda[$id_tienda]['IdTransportista']='0';
                              $pedido_tienda[$id_tienda]['NombreTransportista']='';
                              $importe_pedido_abanico += $suma_productos;
                              $peso_pedido_abanico +=$suma_peso;
                              ?>
                          </tr>
                        <?php  } ?>
                      <?php
                        $importe_pedido_total += $suma_productos;
                        $peso_pedido_total +=$suma_peso;
                        $suma_peso = 0;
                        $suma_productos = 0;
                      }// Termina el bucle de tiendas

                      // Al terminar las tiendas calculo el envío de abanico completo
                      $envio_abanico = $this->TransportistasRangosModel->mejor_precio($peso_pedido_abanico,$importe_pedido_abanico,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO']);
                      $envio_pedido_abanico +=$envio_abanico['IMPORTE'];
                      $envio_pedido_total +=$envio_pedido_abanico;
                      ?>
                      </tbody>
                    </table>
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td class="text-right" style="width:75%"><b>Importe Productos:</b></td>
                          <td>
                            <h5>
                            <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                            <?php  echo number_format($_SESSION['divisa']['conversion']*$importe_pedido_total,2); ?>
                            <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                            </h5>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-right" style="width:75%"><b>Envio Abanico:</b><br> <span class="text-muted">Los envios de productos de tiendas afiliadas a Abanico se calculan en un solo paquete</span> </td>
                          <td>
                            <h5>
                            <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                            <?php  echo number_format($_SESSION['divisa']['conversion']*$envio_pedido_abanico,2); ?>
                            <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                            </h5>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-right" style="width:75%"><b>Envio otras Tiendas:</b><br> <span class="text-muted">Los envios de productos de tiendas externas a Abanico se calculan por separado</span> </td>
                          <td>
                            <h5>
                            <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                            <?php  echo number_format($_SESSION['divisa']['conversion']*$envio_pedido_tiendas,2); ?>
                            <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                            </h5>
                          </td>
                        </tr>
                        <tr>
                          <?php $importe_total = $importe_pedido_total+$envio_pedido_total; ?>
                          <td class="text-right" style="width:75%"><b>Total:</b></td>
                          <td>
                            <h5>
                            <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                            <?php  echo number_format($_SESSION['divisa']['conversion']*$importe_total,2); ?>
                            <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                            </h5>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div><!-- Card Body -->
            <?php
            // Session del Pedido
            // Creo el pedido en la sesión para no perderlo
            $_SESSION['pedido']['Folio'] = folio_pedido();
      			$_SESSION['pedido']['IdUsuario'] = $_SESSION['usuario']['id'];
      			$_SESSION['pedido']['PedidoNombre'] = $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];
      			$_SESSION['pedido']['PedidoCorreo'] = $_SESSION['usuario']['correo'];
      			$_SESSION['pedido']['PedidoTelefono'] = $usuario['USUARIO_TELEFONO'];
      			$_SESSION['pedido']['IdDireccion'] = $detalles_direccion['ID_DIRECCION'];
      			$_SESSION['pedido']['Direccion'] = $direccion;
      			$_SESSION['pedido']['Divisa'] = $_SESSION['divisa']['iso'];
      			$_SESSION['pedido']['Conversion'] = $_SESSION['divisa']['conversion'];
      			$_SESSION['pedido']['ImporteProductosParcial'] = number_format($_SESSION['divisa']['conversion']*$importe_pedido_abanico,2,'.', '');
      			$_SESSION['pedido']['ImporteProductosTotal'] = number_format($_SESSION['divisa']['conversion']*$importe_pedido_total,2,'.', '');
      			$_SESSION['pedido']['ImporteEnvioParcial'] = number_format($_SESSION['divisa']['conversion']*$envio_pedido_abanico,2,'.', '');
      			$_SESSION['pedido']['ImporteEnvioTotal'] = number_format($_SESSION['divisa']['conversion']*$envio_pedido_total,2,'.', '');
      			$_SESSION['pedido']['PedidosTiendas'] = serialize($pedido_tienda);
            $_SESSION['pedido']['ImporteTotal'] = number_format($_SESSION['divisa']['conversion']*$importe_total,2,'.', '');
            $_SESSION['pedido']['IdTransportista'] = $envio_abanico['ID_TRANSPORTISTA'];
            $_SESSION['pedido']['NombreTransportista'] = $envio_abanico['TRANSPORTISTA_NOMBRE'];
            $_SESSION['pedido']['FormaPago'] = 'PayPal';
            $_SESSION['pedido']['EstadoPago'] = 'Pagado';
            $_SESSION['pedido']['EstadoPedido'] = 'Pagado';
            ?>
            <div class="card-footer">
              <div class="d-flex justify-content-end">
                <a href="<?php echo base_url('proceso_pago_3_banco'); ?>" class="btn btn-success btn-lg"> Transferencia Bancaria <i class="fas fa-money-bill-alt"></i></a>
              </div>
              <hr>
              <div class="alert-info">
                <p>Nota del Desarrollador: El boton de PAYPAL <b>está funcionando</b> cuidado al probar</p>
              </div>
              <form class="d-flex justify-content-end" id="paypalForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                  <input type="hidden" name="cmd" value="_xclick">
                  <input type="hidden" name="business" value="marmocreativo@gmail.com">
                  <input type="hidden" name="item_name" value="Pedido <?php echo $_SESSION['pedido']['Folio'];?>">
                  <input type="hidden" name="item_number" value="<?php echo $_SESSION['pedido']['Folio'];?>">
                  <input type="hidden" name="amount" value="<?php echo $_SESSION['pedido']['ImporteTotal']; ?>">
                  <input type="hidden" name="currency_code" value="<?php echo $_SESSION['pedido']['Divisa']; ?>">
                  <input type="hidden" name="return" value="<?php echo base_url('proceso_pago_4?pago=paypal'); ?>">
                  <button type="submit" class="btn btn-primary btn-lg">Pagar con PayPal <span class="fab fa-paypal"></span></button>
              </form>
            </div>
          </div> <!-- Card -->
        </div>
      </div>
    </div>
  </div>
</div>
