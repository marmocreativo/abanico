<!-- proceso de pago3 responsivo -->

<div class="procesoPago3">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card my-3">

          <div class="card-body">
            <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" class="btn btn-default btn-circle" disabled="disabled">1</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-default btn-circle" disabled="disabled">2</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-primary btn-circle">3</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                </div>
              </div>
            </div>
          </div>

          <h6 class="text-center mb-4"><i class="far fa-credit-card"></i> Pago</h6>
          <hr>

          <div class="card-body py-4">
            <div class="row">
              <div class="col-12">
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
              <div class="col-12">
                <p class="mb-0"><em><?php echo $this->lang->line('proceso_pago_3_fecha'); ?>: <?php echo date('d / m / Y'); ?></em></p>
              </div>
            </div>
          </div>
          <hr>
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
          <?php /* BUCLE DE TIENDAS*/ foreach($_SESSION['carrito']['tiendas'] as $id_tienda => $tienda){ ?>
            <?php
              $datos_tienda = $this->TiendasModel->detalles($id_tienda);
              // creo el key del array de pedidos tienda;
              $pedido_tienda[$id_tienda]=array();
            ?>

          <?php /* BUCLE DE PRODUCTOS*/ foreach($_SESSION['carrito']['productos'] as $producto){ ?>
          <?php if($producto['id_tienda']==$id_tienda){ ?>
          <div class="bg-gradient-primary">
            <div class="card-body bxCompra p-3 py-4 carritoCompras">
              <div class="row">
                <div class="col-5">
                  <div class="bxImg mb-2">
                    <a href="#">
                      <img class="spanImg" src="<?php echo $producto['imagen_producto'];  ?>"></img>
                    </a>
                  </div>
                  <p><strong><?php echo $this->lang->line('carrito_cantidad'); ?></strong></p>
                  <p>1</p>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <p><strong><?php echo $producto['nombre_producto'];  ?></strong></p>
                    <p><?php echo $producto['detalles_producto'];  ?></p>
                    <p>Vendido por:<br><a href="" class="text-primary"><?php echo $producto['nombre_tienda'];  ?></a></p>
                    <p><small><?php $peso = $producto['cantidad_producto']*$producto['peso_producto']; echo $producto['peso_producto'];  ?>kg</small></p>
                  </div>
                  <div class="row">
                    <div class="col">
                      <p><strong><?php echo $this->lang->line('carrito_precio'); ?></strong></p>
                      <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                      <?php echo number_format($_SESSION['divisa']['conversion']*$producto['precio_producto'],2);  ?>
                      <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                      <p><strong><?php echo $this->lang->line('carrito_total'); ?></strong></p>
                      <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                        <?php $suma = $producto['cantidad_producto']*$producto['precio_producto']; echo number_format($_SESSION['divisa']['conversion']*$suma,2);  ?>
                      <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <?php
            // Sumas de bucle
            $suma_productos +=  $suma;
            $suma_peso += $peso;
            $pedido_tienda[$id_tienda]['ImporteProductos']=$suma_productos;
          ?>
          <?php }// Termina la condición que revisa si un producto es de una tienda o de otra ?>
          <?php }// Termina el bucle de productos  ?>
          <?php /* SI LA TIENDA NO LA ADMINISTRA ABANICO*/ if($datos_tienda['TIENDA_ADMINISTRACION_PEDIDOS']!='abanico'){

              $envio_tienda = $this->TransportistasRangosModel->mejor_precio($suma_peso,$suma_productos,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO']);
              //var_dump($envio_tienda);
              $pedido_tienda[$id_tienda]['ImporteEnvio']=number_format($_SESSION['divisa']['conversion']*$envio_tienda['IMPORTE'],2,'.','');
              $pedido_tienda[$id_tienda]['IdTransportista']=$envio_tienda['ID_TRANSPORTISTA'];
              $pedido_tienda[$id_tienda]['NombreTransportista']=$envio_tienda['TRANSPORTISTA_NOMBRE'];
              $envio_pedido_tiendas +=$envio_tienda['IMPORTE'];
              $envio_pedido_total +=$envio_tienda['IMPORTE'];

              if(empty($envio_tienda)){ ?>
                <div class="alert alert-warning">
                    <p>  <?php echo $this->lang->line('proceso_pago_3_exeden_peso'); ?></p>
                </div>
              <?php }else{ ?>
                <div class="card-body text-center">
                  <p><?php echo $this->lang->line('proceso_pago_3_envio_de_productos_otro'); ?> <?php echo $tienda; ?></p>
                  <h6>
                    <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                    <strong><?php echo number_format( $envio_tienda['IMPORTE'],2); ?></strong>
                    <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                  </h6>
                </div>
              <?php  } ?>

          <?php }else{   ?>
            <div class="card-body text-center">
              <p> <?php echo $this->lang->line('proceso_pago_3_envio_de_abanico'); ?></p>
            </div>
            <?php
              $pedido_tienda[$id_tienda]['ImporteEnvio']='0';
              $pedido_tienda[$id_tienda]['IdTransportista']='0';
              $pedido_tienda[$id_tienda]['NombreTransportista']='';
              $importe_pedido_abanico += $suma_productos;
              $peso_pedido_abanico +=$suma_peso;
              ?>
          <?php  } // Termina condición de administración de abanico?>
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
        </div>

        <div class="card">

          <div class="card-body bxImporte">
             <div class="row">
               <div class="col-12">
                 <div class="py-3">
                   <h5 class="h6 font-weight-bold"><?php echo $this->lang->line('proceso_pago_3_importe_productos'); ?>:</h5>
                   <h5 class="h6 text-right mt-3">
                     <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                     <?php  echo number_format($_SESSION['divisa']['conversion']*$importe_pedido_total,2); ?>
                     <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                   </h5>
                 </div>
                 <hr>
                 <div class="py-3">
                   <h5 class="h6 font-weight-bold"><?php echo $this->lang->line('proceso_pago_3_envio_abanico'); ?>:</h5>
                   <span class="text-muted"><?php echo $this->lang->line('proceso_pago_3_envio_abanico_instrucciones'); ?></span>
                   <h5 class="h6 text-right mt-3">
                     <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                     <?php  echo number_format($_SESSION['divisa']['conversion']*$envio_pedido_abanico,2); ?>
                     <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                   </h5>
                 </div>
                 <hr>
                 <div class="py-3">
                   <h5 class="h6 font-weight-bold"><?php echo $this->lang->line('proceso_pago_3_envio_otras_tiendas'); ?>:</h5>
                   <span class="text-muted"><?php echo $this->lang->line('proceso_pago_3_envio_otras_tiendas_instrucciones'); ?></span>
                   <h5 class="h6 text-right mt-3">
                     <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                     <?php  echo number_format($_SESSION['divisa']['conversion']*$envio_pedido_tiendas,2); ?>
                     <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                   </h5>
                 </div>
                 <hr>
                 <div class="py-3">
                   <?php $importe_total = $importe_pedido_total+$envio_pedido_total; ?>
                   <h5 class="h6 font-weight-bold"><?php echo $this->lang->line('proceso_pago_3_total'); ?>:</h5>
                   <h5 class="h6 text-right mt-3">
                     <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                     <?php  echo number_format($_SESSION['divisa']['conversion']*$importe_total,2); ?>
                     <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                   </h5>
                 </div>
               </div>
             </div>
          </div>
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
          <div class="card-footer text-right px-1">
              <a href="<?php echo base_url('proceso_pago_3_banco'); ?>" class="btn btn-success btn-sm"> <?php echo $this->lang->line('proceso_pago_3_transferencia'); ?> <i class="fas fa-money-bill-alt"></i></a>
            <div class="alert alert-info mt-2">
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
                <button type="submit" class="btn btn-primary btn-sm"><?php echo $this->lang->line('proceso_pago_3_paypal'); ?> <span class="fab fa-paypal"></span></button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- termina proceso de pago3 responsivo -->
