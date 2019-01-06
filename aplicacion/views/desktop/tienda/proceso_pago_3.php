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
                              <td colspan="4" class="table-danger text-right">
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
            <div class="card-footer">
              <form class="d-flex justify-content-between" action="<?php echo base_url('proceso_pago_4'); ?>" method="post">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
                <input type="hidden" name="PedidoNombre" value="<?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?>">
                <input type="hidden" name="PedidoCorreo" value="<?php echo $_SESSION['usuario']['correo']; ?>">
                <input type="hidden" name="PedidoTelefono" value="<?php echo $usuario['USUARIO_TELEFONO']; ?>">
                <input type="hidden" name="IdDireccion" value="<?php echo $detalles_direccion['ID_DIRECCION']; ?>">
                <input type="hidden" name="Direccion" value="<?php echo $direccion; ?>">
                <input type="hidden" name="Divisa" value="<?php echo $_SESSION['divisa']['iso']; ?>">
                <input type="hidden" name="Conversion" value="<?php echo $_SESSION['divisa']['conversion']; ?>">
                <input type="hidden" name="ImporteProductosParcial" value="<?php echo  number_format($_SESSION['divisa']['conversion']*$importe_pedido_abanico,2,'.', ''); ?>">
                <input type="hidden" name="ImporteProductosTotal" value="<?php echo  number_format($_SESSION['divisa']['conversion']*$importe_pedido_total,2,'.', ''); ?>">
                <input type="hidden" name="ImporteEnvioParcial" value="<?php echo  number_format($_SESSION['divisa']['conversion']*$envio_pedido_abanico,2,'.', ''); ?>">
                <input type="hidden" name="ImporteEnvioTotal" value="<?php echo  number_format($_SESSION['divisa']['conversion']*$envio_pedido_total,2,'.', ''); ?>">
                <input type="hidden" name="IdTransportista" value="<?php echo $envio_abanico['ID_TRANSPORTISTA']; ?>">
                <input type="hidden" name="NombreTransportista" value="<?php echo $envio_abanico['TRANSPORTISTA_NOMBRE']; ?>">
                <input type="hidden" name="ImporteTotal" value="<?php echo  number_format($_SESSION['divisa']['conversion']*$importe_total,2,'.', ''); ?>">
                <input type="hidden" name="FormaPago" value="Transferencia Bancaria">
                <input type="hidden" name="EstadoPago" value="Pendiente">
                <input type="hidden" name="EstadoPedido" value="Espera Pago">
                <input type="hidden" name="PedidosTiendas" value='<?php echo serialize($pedido_tienda); ?>'>
                <a href="<?php echo base_url(); ?>" class="btn btn-outline-primary"> <i class="fa fa-chevron-left"></i> Volver a la tienda</a>
                <button type="submit" class="btn btn-success"> Continuar <i class="fa fa-chevron-right"></i></button>
              </form>
            </div>
          </div> <!-- Card -->
        </div>
      </div>
    </div>
  </div>
</div>
