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
                  <p><?php echo $this->lang->line('proceso_pago_1_identificacion'); ?></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-default btn-circle"  disabled="disabled" >2</a>
                  <p><?php echo $this->lang->line('proceso_pago_1_direccion'); ?></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-primary btn-circle">3</a>
                  <p><?php echo $this->lang->line('proceso_pago_1_pago'); ?></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                  <p><?php echo $this->lang->line('proceso_pago_1_confirmacion'); ?></p>
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
                          <br>
                          <a href="<?php echo base_url('proceso_pago_2'); ?>"> <i class="fa fa-sync-alt"></i> <?php echo $this->lang->line('proceso_pago_3_cambiar_direccion'); ?></a>
                      </address>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                      <p>
                          <em><?php echo $this->lang->line('proceso_pago_3_fecha'); ?>: <?php echo date('d / m / Y'); ?></em>
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
                    <!-- Pedidos Abanico-->
                    <?php /* BUCLE DE TIENDAS*/ foreach($_SESSION['carrito']['tiendas'] as $id_tienda => $tienda){ ?>
                    <?php
                      $datos_tienda = $this->TiendasModel->detalles($id_tienda);
                      $paquete_tienda = $this->PlanesModel->plan_activo_usuario($datos_tienda['ID_USUARIO'],'productos');
                      // creo el key del array de pedidos tienda;
                    ?>
                    <?php if($paquete_tienda['PLAN_ENVIO']=='abanico'){ ?>
                    <h5> <i class="fa fa-store"></i> <?php echo $datos_tienda['TIENDA_NOMBRE'];?></h5>
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="width:50%"><?php echo $this->lang->line('carrito_producto'); ?></th>
                          <th style="width:10%" class="text-center"><?php echo $this->lang->line('carrito_cantidad'); ?></th>
                          <th style="width:20%" class="text-right"><?php echo $this->lang->line('carrito_precio'); ?></th>
                          <th style="width:20%" class="text-right"><?php echo $this->lang->line('carrito_total'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php /* BUCLE DE PRODUCTOS*/ foreach($_SESSION['carrito']['productos'] as $producto){ ?>
                            <?php if($producto['id_tienda']==$id_tienda){ ?>
                            <tr>
                              <td>
                                <div class="d-flex">
                                  <div class="w-25">
                                    <img src="<?php echo $producto['imagen_producto'];  ?>" class="img-thumbnail" width="70" alt="">
                                  </div>
                                  <div class="w-75 p-1">
                                    <a href="#" class="h6"><?php echo $producto['nombre_producto'];  ?></a>
                                    <p style="font-size:0.8em;" class="mb-1">Vendido por: <a href="#"><?php echo $producto['nombre_tienda'];  ?></a></p>
                                    <p style="font-size:0.8em;" class="mb-1"><?php echo $producto['detalles_producto'];  ?></p>
                                    <p style="font-size:0.8em;" class="mb-1"><?php $peso = $producto['cantidad_producto']*$producto['peso_producto']; echo $producto['peso_producto'];  ?>kg</p>
                                    <?php if($producto['contra_entrega']=='si' && $detalles_direccion['DIRECCION_PAIS']=='Estados Unidos'){ ?>
                                      <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                        <label class="form-check-label text-danger" for="exampleCheck1">Pagar este artículo contra entrega</label>
                                      </div>
                                    <?php } ?>
                                  </div>
                                </div>
                              </td>
                              <td class="text-center"><?php echo $producto['cantidad_producto'];  ?></td>
                                <?php
                                  // variables de precio
                                  if($producto['divisa_default']!=$_SESSION['divisa']['iso']){
                                    $cambio_divisa_default = $this->DivisasModel->detalles_iso($producto['divisa_default']);
                                    if($producto['divisa_default']!='MXN'){
                                      $precio_venta = $producto['precio_producto']/$cambio_divisa_default['DIVISA_CONVERSION'];
                                      $suma = ($producto['cantidad_producto']*$producto['precio_producto'])/$cambio_divisa_default['DIVISA_CONVERSION'];
                                    }else{
                                      $precio_venta = $_SESSION['divisa']['conversion']*$producto['precio_producto'];
                                      $suma = $_SESSION['divisa']['conversion']*($producto['cantidad_producto']*$producto['precio_producto']);
                                    }
                                  }else{

                                    $precio_venta = $producto['precio_producto'];
                                    $suma = $producto['cantidad_producto']*$producto['precio_producto'];
                                  }
                                ?>
                              <td class="text-right">
                                <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                                <?php echo number_format($precio_venta,2);  ?>
                                <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                              </td>
                              <td class="text-right">
                                <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                                  <?php echo number_format($suma,2);  ?>
                                <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                              </td>
                            </tr>
                            <?php
                              // Cálculos por producto
                              // Sumas de bucle
                                $suma_productos +=  $suma;
                                if($detalles_direccion['DIRECCION_PAIS']!='Estados Unidos'){
                                  $suma_peso += $peso;
                                }else{
                                  if($producto['contra_entrega']=='no'){
                                    $suma_peso += $peso;
                                  }
                                }
                            ?>
                            <?php }// Termina la condición que revisa si un producto es de la tienda ?>
                          <?php } // Termina el bucle de productos ?>
                      </tbody>
                    </table>
                    <?php
                    echo $id_tienda;
                    $pedido_tienda[$id_tienda]['id_tienda'] = $id_tienda;
                    $pedido_tienda[$id_tienda]['id_transportista'] = "0";
                    $pedido_tienda[$id_tienda]['importe_transportista'] = "0";
                    ?>
                    <?php } // Condicion Tiendas Abanico ?>
                  <?php } // Termina el bucle de tiendas ?>
                  <div class="border p-3">
                    <p>Enviar con:</p>
                    <?php
                    // Cálculos Finales
                      $peso_pedido_abanico += $suma_peso;
                      $importe_pedido_abanico += $suma_productos;
                      $envio_abanico = $this->TransportistasRangosModel->lista_mejor_precio($peso_pedido_abanico,$importe_pedido_abanico,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO'],5);
                      $mejor_envio_abanico = $this->TransportistasRangosModel->mejor_precio($peso_pedido_abanico,$importe_pedido_abanico,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO'],5);

                      $envio_pedido_abanico += $mejor_envio_abanico['IMPORTE'];
                      $primer_radio_abanico = 0;
                    ?>
                    <?php foreach ($envio_abanico as $rangos) { ?>
                      <div class="form-check">
                        <label>
                          <input type="radio" class="form-check-input" name="transportista_abanico" value="<?php echo $rangos->RANGO;  ?>" <?php if($primer_radio_abanico==0){ echo 'checked'; } ?>>
                        <?php echo $rangos->TRANSPORTISTA_NOMBRE;  ?> | <?php echo $rangos->TRANSPORTISTA_TIEMPO_ENTREGA;  ?> | $<?php echo $rangos->IMPORTE;  ?> </label>
                      </div>
                    <?php $primer_radio_abanico++; } ?>
                  </div>
                  <hr>
                    <!-- ***** -->
                    <!-- ***** -->
                    <!-- ***** -->
                    <!-- ***** -->
                    <!-- ***** -->
                    <!-- Pedidos Otras Tiendas -->
                    <!-- ***** -->
                    <!-- ***** -->
                    <!-- ***** -->
                    <!-- ***** -->
                    <!-- ***** -->
                    <?php /* BUCLE DE TIENDAS*/ foreach($_SESSION['carrito']['tiendas'] as $id_tienda => $tienda){ ?>
                      <?php
                        // reinicio variables
                        $suma = 0;
                        $suma_peso = 0;
                        $suma_productos = 0;
                      ?>
                    <?php
                      $datos_tienda = $this->TiendasModel->detalles($id_tienda);
                      $paquete_tienda = $this->PlanesModel->plan_activo_usuario($datos_tienda['ID_USUARIO'],'productos');
                      // creo el key del array de pedidos tienda;
                    ?>
                    <?php if($paquete_tienda['PLAN_ENVIO']=='tienda'){ ?>
                    <h5> <i class="fa fa-store"></i> <?php echo $datos_tienda['TIENDA_NOMBRE'];?></h5>
                    <table class="table table-bordered  table-striped">
                      <thead>
                        <tr>
                          <th style="width:50%"><?php echo $this->lang->line('carrito_producto'); ?></th>
                          <th style="width:10%" class="text-center"><?php echo $this->lang->line('carrito_cantidad'); ?></th>
                          <th style="width:20%" class="text-right"><?php echo $this->lang->line('carrito_precio'); ?></th>
                          <th style="width:20%" class="text-right"><?php echo $this->lang->line('carrito_total'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php /* BUCLE DE PRODUCTOS*/ foreach($_SESSION['carrito']['productos'] as $producto){ ?>
                            <?php if($producto['id_tienda']==$id_tienda){ ?>
                            <tr>
                              <td>
                                <div class="d-flex">
                                  <div class="w-25">
                                    <img src="<?php echo $producto['imagen_producto'];  ?>" class="img-thumbnail" width="70" alt="">
                                  </div>
                                  <div class="w-75 p-1">
                                    <a href="#" class="h6"><?php echo $producto['nombre_producto'];  ?></a>
                                    <p style="font-size:0.8em;" class="mb-1">Vendido por: <a href="#"><?php echo $producto['nombre_tienda'];  ?></a></p>
                                    <p style="font-size:0.8em;" class="mb-1"><?php echo $producto['detalles_producto'];  ?></p>
                                    <p style="font-size:0.8em;" class="mb-1"><?php $peso = $producto['cantidad_producto']*$producto['peso_producto']; echo $producto['peso_producto'];  ?>kg</p>
                                    <?php if($producto['contra_entrega']=='si' && $detalles_direccion['DIRECCION_PAIS']=='Estados Unidos'){ ?>
                                      <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                        <label class="form-check-label text-danger" for="exampleCheck1">Pagar este artículo contra entrega</label>
                                      </div>
                                    <?php } ?>
                                  </div>
                                </div>
                              </td>
                              <td class="text-center"><?php echo $producto['cantidad_producto'];  ?></td>
                                <?php
                                  // variables de precio
                                  if($producto['divisa_default']!=$_SESSION['divisa']['iso']){
                                    $cambio_divisa_default = $this->DivisasModel->detalles_iso($producto['divisa_default']);
                                    if($producto['divisa_default']!='MXN'){
                                      $precio_venta = $producto['precio_producto']/$cambio_divisa_default['DIVISA_CONVERSION'];
                                      $suma = ($producto['cantidad_producto']*$producto['precio_producto'])/$cambio_divisa_default['DIVISA_CONVERSION'];
                                    }else{
                                      $precio_venta = $_SESSION['divisa']['conversion']*$producto['precio_producto'];
                                      $suma = $_SESSION['divisa']['conversion']*($producto['cantidad_producto']*$producto['precio_producto']);
                                    }
                                  }else{

                                    $precio_venta = $producto['precio_producto'];
                                    $suma = $producto['cantidad_producto']*$producto['precio_producto'];
                                  }
                                ?>
                              <td class="text-right">
                                <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                                <?php echo number_format($precio_venta,2);  ?>
                                <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                              </td>
                              <td class="text-right">
                                <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                                  <?php echo number_format($suma,2);  ?>
                                <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                              </td>
                            </tr>
                            <?php
                              // Cálculos por producto
                              // Sumas de bucle
                                $suma_productos +=  $suma;
                                if($detalles_direccion['DIRECCION_PAIS']!='Estados Unidos'){
                                  $suma_peso += $peso;
                                }else{
                                  if($producto['contra_entrega']=='no'){
                                    $suma_peso += $peso;
                                  }
                                }
                            ?>
                            <?php }// Termina la condición que revisa si un producto es de la tienda ?>
                          <?php } // Termina el bucle de productos ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="4">
                            <div class="border p-3">
                              <p>Mensajerías Tienda</p>
                              <?php
                              // Cálculos por tienda
                                $envio_abanico = $this->TransportistasRangosModel->lista_mejor_precio($suma_peso,$suma_productos,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO'],2);
                                $mejor_envio_tiendas = $this->TransportistasRangosModel->mejor_precio($suma_peso,$suma_productos,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO'],2);
                                $primer_radio_tienda = 0;
                                $pedido_tienda[$id_tienda]['id_tienda'] = $id_tienda;
                                $pedido_tienda[$id_tienda]['id_transportista'] = $mejor_envio_tiendas['ID_TRANSPORTISTA'];
                                $pedido_tienda[$id_tienda]['importe_transportista'] = $mejor_envio_tiendas['IMPORTE'];

                                $envio_pedido_total += $mejor_envio_tiendas['IMPORTE'];
                              ?>
                              <?php foreach ($envio_abanico as $rangos) { ?>
                                <div class="form-check">
                                  <label>
                                    <input type="radio" class="form-check-input" name="transportista_<?php echo $id_tienda;  ?>" value="<?php echo $rangos->RANGO;  ?>" <?php if($primer_radio_tienda==0){ echo 'checked'; } ?>>
                                  <?php echo $rangos->TRANSPORTISTA_NOMBRE;  ?> | <?php echo $rangos->TRANSPORTISTA_TIEMPO_ENTREGA;  ?> | $<?php echo $rangos->IMPORTE;  ?> </label>
                                </div>
                              <?php $primer_radio_tienda++; } ?>
                            </div>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                    <?php } // Condicion Tiendas Abanico ?>
                    <?php
                      // Calculos finales por tienda
                      $importe_pedido_tiendas += $suma_productos;
                      $peso_pedido_tiendas += $suma_peso;
                    ?>
                  <?php } // Termina el bucle de tiendas ?>
                  </div>
                  <?php
                  // Cálculos Finales
                  $peso_pedido_total = $peso_pedido_abanico+$peso_pedido_tiendas;
                  $importe_pedido_total = $importe_pedido_abanico+$importe_pedido_tiendas;
                  $envio_pedido_total = $envio_pedido_abanico+$envio_pedido_total;
                  echo '<pre>';
                  var_dump($pedido_tienda);
                  echo '</pre>';
                  ?>

                  <div class="p-3 border border-danger" id="PedidoAjax"
                    data-id-direccion='<?php echo $detalles_direccion['ID_DIRECCION']; ?>'
                    data-importe-pedido-parcial='<?php echo $importe_pedido_abanico; ?>'
                    data-importe-pedido-total='<?php echo $importe_pedido_total; ?>'
                    data-importe-envio-parcial='<?php echo $envio_pedido_abanico; ?>'
                    data-importe-envio-total='<?php echo $envio_pedido_total; ?>'
                    data-pedido-tienda = '<?php echo serialize($pedido_tienda); ?>'
                    data-importe-total = '<?php echo $importe_pedido_total; ?>'
                    data-id-transportista = '<?php echo $mejor_envio_abanico['ID_TRANSPORTISTA']; ?>'
                    data-nombre-transportista = '<?php echo $mejor_envio_abanico['TRANSPORTISTA_NOMBRE']; ?>'
                  >
                  </div>
                </div>
              </div>
            </div><!-- Card Body -->
          </div> <!-- Card -->
        </div>
      </div>
    </div>
  </div>
</div>
