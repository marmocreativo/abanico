<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-10">
        <div class="card mb-3 fila-gris">
          <div class="card-body p-0">
            <div class="container container-stepwizard">
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
            </div>
            <div class="row">
              <div class="col">
                <div class="container mt-3">
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
              </div>
                  <?php
                  // Variables globales
                    $envio_posible = true;
                    $suma_productos=0;
                    $suma_tienda=0;
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
                    $solo_productos_contra_entrega = true;
                    $solo_productos_envio_gratuito = true;
                    $transportista_gratuito = 3;
                    $pedidos_tienda = array();
                  ?>
                  <div class="col-12">
                    <!-- Pedidos Abanico-->
                    <?php /* BUCLE DE TIENDAS*/ $conteo_tiendas_abanico = 0; foreach($_SESSION['carrito']['tiendas'] as $id_tienda => $tienda){ ?>
                    <?php
                      $datos_tienda = $this->TiendasModel->detalles($id_tienda);
                      $paquete_tienda = $this->PlanesModel->plan_activo_usuario($datos_tienda['ID_USUARIO'],'productos');
                      // creo el key del array de pedidos tienda;
                    ?>
                    <?php if($paquete_tienda['PLAN_ENVIO']=='abanico'){ ?>
                    <div class="container-fluid tienda-proceso-pago py-3 mt-3">
                    <h5> <i class="fa fa-store"></i> <?php echo $datos_tienda['TIENDA_NOMBRE'];?> (A)</h5>
                    <table class="table">
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
                                  //verifico que solo sea un producto a contra ContraEntrega
                                  if($producto['contra_entrega']!='si'){
                                    $solo_productos_contra_entrega = false;
                                  }
                                  if($producto['envio_gratuito']=='no'){
                                    $solo_productos_envio_gratuito = false;
                                  }
                                ?>
                            <tr>
                              <td class="align-middle">
                                <div class="d-flex align-middle">
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
                                        <label class="form-check-label text-danger" for="selector-contra-entrega-<?php echo $producto['id_producto']; ?>">
                                          <input type="checkbox" class="form-check-input selector-contra-entrega" id="selector-contra-entrega-<?php echo $producto['id_producto']; ?>"
                                          data-id-producto='<?php echo $producto['id_producto']; ?>'
                                          data-importe-producto='<?php echo $suma; ?>'
                                          data-id-tienda='<?php echo $id_tienda; ?>'
                                          checked>
                                          Pagar este artículo contra entrega</label>
                                      </div>
                                    <?php } ?>
                                  </div>
                                </div>
                              </td>
                              <td class="text-center align-middle"><?php echo $producto['cantidad_producto'];  ?></td>
                              <td class="text-right align-middle">
                                <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                                <?php echo number_format($precio_venta,2);  ?>
                                <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                              </td>
                              <td class="text-right suma-producto align-middle" id="suma-producto-<?php echo $producto['id_producto']; ?>" data-id-tienda='<?php echo $id_tienda; ?>'
                              <?php if($producto['contra_entrega']=='si' && $detalles_direccion['DIRECCION_PAIS']=='Estados Unidos'){ ?>
                                data-importe-producto='0'
                              <?php }else{ ?>
                                data-importe-producto='<?php echo $suma; ?>'
                              <?php } ?>
                              >
                                <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                                  <?php echo number_format($suma,2);  ?>
                                <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                              </td>
                            </tr>
                            <?php
                              // Cálculos por producto
                              // Sumas de bucle
                                if($detalles_direccion['DIRECCION_PAIS']!='Estados Unidos'){
                                  $suma_peso += $peso;
                                  $suma_productos +=  $suma;
                                  $suma_tienda += $suma;
                                }else{
                                  if($producto['contra_entrega']=='no'){
                                    $suma_peso += $peso;
                                    $suma_productos +=  $suma;
                                    $suma_tienda += $suma;
                                  }
                                }

                            ?>
                            <?php }// Termina la condición que revisa si un producto es de la tienda ?>
                          <?php } // Termina el bucle de productos ?>
                      </tbody>
                    </table>
                    <span class="datos_tienda datos_tienda_abanico" id="tienda-<?php echo $datos_tienda['ID_TIENDA'];?>"
                    data-id-tienda='<?php echo $datos_tienda['ID_TIENDA'];?>'
                    data-nombre-tienda='<?php echo $datos_tienda['TIENDA_NOMBRE'];?>'
                    data-importe-productos ='<?php echo $suma_tienda; ?>'
                    data-id-transportista ='<?php echo $mejor_envio_abanico['ID_TRANSPORTISTA']; ?>'
                    data-nombre-transportista ='<?php echo $mejor_envio_abanico['TRANSPORTISTA_NOMBRE']; ?>'
                    data-importe-transportista ='<?php echo $mejor_envio_abanico['IMPORTE']; ?>'
                    data-comision-venta ='<?php echo $paquete_tienda['PLAN_COMISION']; ?>'
                    data-comision-manejo ='<?php echo $paquete_tienda['PLAN_MANEJO_PRODUCTOS']; ?>'
                    >
                  </span>
                  </div>
                    <?php
                    $pedido_tienda[$id_tienda]['id_tienda'] = $id_tienda;
                    $pedido_tienda[$id_tienda]['id_transportista'] = "0";
                    $pedido_tienda[$id_tienda]['importe_transportista'] = "0";
                    ?>
                    <?php $conteo_tiendas_abanico ++; } // Condicion Tiendas Abanico ?>
                  <?php $suma_tienda = 0; } // Termina el bucle de tiendas ?>
                  <?php if($conteo_tiendas_abanico>0){ ?>
                  <div class="bg-light cont-envio-pago">
                    <?php
                    // Cálculos Finales
                      $peso_pedido_abanico += $suma_peso;
                      $importe_pedido_abanico += $suma_productos;
                      if($solo_productos_contra_entrega&&$detalles_direccion['DIRECCION_PAIS']=='Estados Unidos'){
                        $envio_abanico = null;
                        $mejor_envio_abanico = null;
                      }else{
                        $envio_abanico = $this->TransportistasRangosModel->lista_mejor_precio($peso_pedido_abanico,$importe_pedido_abanico,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO'],5);
                        $mejor_envio_abanico = $this->TransportistasRangosModel->mejor_precio($peso_pedido_abanico,$importe_pedido_abanico,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO'],5);
                      }
                      if($solo_productos_envio_gratuito&&$transportista_gratuito==$mejor_envio_abanico['ID_TRANSPORTISTA']){
                        $envio_pedido_abanico += 0.00;
                       }else{
                         $envio_pedido_abanico += $_SESSION['divisa']['conversion']*$mejor_envio_abanico['IMPORTE'];
                       }
                      $primer_radio_abanico = 0;
                    ?>
                    <?php if($solo_productos_contra_entrega&&$detalles_direccion['DIRECCION_PAIS']=='Estados Unidos'){ ?>
                      <p> All this products are installed at home and shipping is not charged</p>
                    <?php }else{ ?>
                      <?php if(!empty($envio_abanico)){ ?>
                        <h5 class="p-3 text-muted"><i class="fas fa-truck"></i> Enviar con:</h5>
                        <?php foreach ($envio_abanico as $rangos) { ?>
                          <div class="form-check">
                            <label>
                              <input type="radio" class="form-check-input selector-transportista-abanico" name="selector-transportista-abanico"
                                data-id-tienda='0'
                                data-id-transportista-abanico='<?php echo $rangos->ID_TRANSPORTISTA ?>'
                                data-nombre-transportista-abanico='<?php echo $rangos->TRANSPORTISTA_NOMBRE ?>'
                                data-importe-envio-parcial='<?php if($solo_productos_envio_gratuito&&$transportista_gratuito==$rangos->ID_TRANSPORTISTA){ echo '0.00'; }else{ echo ($_SESSION['divisa']['conversion']*$rangos->IMPORTE); } ?>'
                                 <?php if($primer_radio_abanico==0){ echo 'checked'; } ?>>
                            <?php echo $rangos->TRANSPORTISTA_NOMBRE;  ?> | <?php echo $rangos->TRANSPORTISTA_TIEMPO_ENTREGA;  ?> |  $<?php if($solo_productos_envio_gratuito&&$transportista_gratuito==$rangos->ID_TRANSPORTISTA){ echo '0.00 <small>Promoción Envío gratuito</small>'; }else{ echo ($_SESSION['divisa']['conversion']*$rangos->IMPORTE); }  ?> </label>
                          </div>
                        <?php $primer_radio_abanico++; } ?>
                      <?php }else{ ?>
                        <p> <?php echo $this->lang->line('proceso_pago_3_exeden_peso'); ?></p>
                      <?php }// Condicional si no hay transportistas disponibles ?>
                    <?php } ?>
                  </div>
                <?php } ?>
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
                        $suma_tienda = 0;
                      ?>
                    <?php
                      $datos_tienda = $this->TiendasModel->detalles($id_tienda);
                      $paquete_tienda = $this->PlanesModel->plan_activo_usuario($datos_tienda['ID_USUARIO'],'productos');
                      // creo el key del array de pedidos tienda;
                    ?>
                    <?php if($paquete_tienda['PLAN_ENVIO']=='tienda'){ ?>
                    <div class="container-fluid tienda-proceso-pago py-3 mt-3">
                    <h5> <i class="fa fa-store"></i> <?php echo $datos_tienda['TIENDA_NOMBRE'];?></h5>
                    <table class="table tienda"  data-id-tienda='<?php echo $datos_tienda['ID_TIENDA'];?>' data-nombre-tienda='<?php echo $datos_tienda['TIENDA_NOMBRE'];?>'>
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
                              <td class="text-right suma-producto" data-id-tienda='<?php echo $id_tienda; ?>' data-importe-producto='<?php echo $suma; ?>'>
                                <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                                  <?php echo number_format($suma,2);  ?>
                                <small><?php echo $_SESSION['divisa']['iso']; ?></small>
                              </td>
                            </tr>
                            <?php
                              // Cálculos por producto
                              // Sumas de bucle
                                $suma_productos +=  $suma;
                                $suma_tienda +=  $suma;
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
                            <div class="bg-light cont-envio-pago">
                              <?php
                              // Cálculos por tienda
                                $envio_tiendas = $this->TransportistasRangosModel->lista_mejor_precio($suma_peso,$suma_productos,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO'],2);
                                $mejor_envio_tiendas = $this->TransportistasRangosModel->mejor_precio($suma_peso,$suma_productos,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO'],2);
                                $primer_radio_tienda = 0;
                                $pedido_tienda[$id_tienda]['id_tienda'] = $id_tienda;
                                $pedido_tienda[$id_tienda]['id_transportista'] = $mejor_envio_tiendas['ID_TRANSPORTISTA'];
                                $pedido_tienda[$id_tienda]['nombre_transportista'] = $mejor_envio_tiendas['TRANSPORTISTA_NOMBRE'];
                                $pedido_tienda[$id_tienda]['importe_transportista'] = $mejor_envio_tiendas['IMPORTE'];
                                $pedido_tienda[$id_tienda]['importe_productos'] = $suma_productos;
                                $pedido_tienda[$id_tienda]['importe_transportista'] = $mejor_envio_tiendas['IMPORTE'];

                                $envio_pedido_tiendas += $_SESSION['divisa']['conversion']*$mejor_envio_tiendas['IMPORTE'];
                              ?>
                              <?php if(!empty($envio_tiendas)){ ?>

                              <h5 class="p-3 mb-3 text-muted"><i class="fas fa-truck"></i> Mensajerías para <?php echo $datos_tienda['TIENDA_NOMBRE'];?></h5>
                              <?php foreach ($envio_tiendas as $rangos) { ?>
                                <div class="form-check">
                                  <label>
                                    <input type="radio" class="form-check-input selector-transportista-tienda" name="selector-transportista-<?php echo $id_tienda; ?>"
                                      data-id-tienda='<?php echo $id_tienda; ?>'
                                      data-id-transportista-tienda='<?php echo $rangos->ID_TRANSPORTISTA ?>'
                                      data-nombre-transportista-tienda='<?php echo $rangos->TRANSPORTISTA_NOMBRE ?>'
                                      data-importe-envio-tienda='<?php echo $_SESSION['divisa']['conversion']*$rangos->IMPORTE ?>'
                                    <?php if($primer_radio_tienda==0){ echo 'checked'; } ?>>
                                  <?php echo $rangos->TRANSPORTISTA_NOMBRE;  ?> | <?php echo $rangos->TRANSPORTISTA_TIEMPO_ENTREGA;  ?> | $<?php echo $_SESSION['divisa']['conversion']*$rangos->IMPORTE;  ?> </label>
                                </div>
                              <?php $primer_radio_tienda++; } ?>
                            <?php }else{ ?>
                              <p> <?php echo $this->lang->line('proceso_pago_3_exeden_peso'); ?></p>
                            <?php } ?>
                            </div>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                    <span class="datos_tienda" id="tienda-<?php echo $datos_tienda['ID_TIENDA'];?>"
                    data-id-tienda='<?php echo $datos_tienda['ID_TIENDA'];?>'
                    data-nombre-tienda='<?php echo $datos_tienda['TIENDA_NOMBRE'];?>'
                    data-importe-productos ='<?php echo $suma_tienda; ?>'
                    data-id-transportista ='<?php echo $mejor_envio_tiendas['ID_TRANSPORTISTA']; ?>'
                    data-nombre-transportista ='<?php echo $mejor_envio_tiendas['TRANSPORTISTA_NOMBRE']; ?>'
                    data-importe-transportista ='<?php echo $mejor_envio_tiendas['IMPORTE']; ?>'
                    data-comision-venta ='<?php echo $paquete_tienda['PLAN_COMISION']; ?>'
                    data-comision-manejo ='<?php echo $paquete_tienda['PLAN_MANEJO_PRODUCTOS']; ?>'
                    >
                  </span>
                    <?php } // Condicion Tiendas Abanico ?>
                    <?php
                      // Calculos finales por tienda
                      $suma_tienda = 0;
                      $importe_pedido_tiendas += $suma_productos;
                      $peso_pedido_tiendas += $suma_peso;
                    ?>
                  <?php } // Termina el bucle de tiendas ?>
                  </div>
                </div>
                </div>
              </div>
            </div><!-- Card Body -->
          </div> <!-- Card -->
        </div>

        <?php
        // Cálculos Finales
        $peso_pedido_total = $peso_pedido_abanico+$peso_pedido_tiendas;
        $importe_pedido_total = $importe_pedido_abanico+$importe_pedido_tiendas;
        $envio_pedido_total = $envio_pedido_abanico+$envio_pedido_tiendas;
        $importe_total = $importe_pedido_total+$envio_pedido_total;
        if(!empty($mejor_envio_abanico)){
          $id_transportista_abanico = $mejor_envio_abanico['ID_TRANSPORTISTA'];
          $nombre_transportista_abanico = $mejor_envio_abanico['TRANSPORTISTA_NOMBRE'];
        }else{
          $id_transportista_abanico = 0;
          $nombre_transportista_abanico = '';
        }
        ?>

      </div>
      <div class="row justify-content-center">
        <div class="col-10 mb-3 p-3 bg-primary-6" id="PedidoAjax"
          data-id-direccion='<?php echo $detalles_direccion['ID_DIRECCION']; ?>'
          data-importe-pedido-parcial='<?php echo $importe_pedido_abanico; ?>'
          data-importe-pedido-total='<?php echo $importe_pedido_total; ?>'
          data-importe-envio-parcial='<?php echo $envio_pedido_abanico; ?>'
          data-importe-envio-tiendas='<?php echo $envio_pedido_tiendas; ?>'
          data-importe-envio-total='<?php echo $envio_pedido_total; ?>'
          data-pedido-tienda = ''
          data-importe-total = '<?php echo $importe_total; ?>'
          data-id-transportista = '<?php echo $id_transportista_abanico; ?>'
          data-nombre-transportista = '<?php echo $nombre_transportista_abanico; ?>'
        >
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal de flujos -->

<!-- Modal -->
<div class="modal fade" id="ModalAyuda" tabindex="-1" role="dialog" aria-labelledby="ModalAyuda" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-question-circle"></i> Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">

          <div class="linea-colores-delgada">
            <div class="barra-color barra-azul"></div>
            <div class="barra-color barra-rosa"></div>
            <div class="barra-color barra-amarillo"></div>
            <div class="barra-color barra-verde"></div>
            <div class="barra-color barra-morado"></div>
          </div>
        <!-- Slider Ayuda-->
        <div id="carouselAyuda" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselAyuda" data-slide-to="0" class="active"></li>
            <li data-target="#carouselAyuda" data-slide-to="1"></li>
            <li data-target="#carouselAyuda" data-slide-to="2"></li>
            <li data-target="#carouselAyuda" data-slide-to="3"></li>
            <li data-target="#carouselAyuda" data-slide-to="4"></li>
            <li data-target="#carouselAyuda" data-slide-to="5"></li>
            <li data-target="#carouselAyuda" data-slide-to="6"></li>
            <li data-target="#carouselAyuda" data-slide-to="7"></li>
            <li data-target="#carouselAyuda" data-slide-to="8"></li>
            <li data-target="#carouselAyuda" data-slide-to="9"></li>
            <li data-target="#carouselAyuda" data-slide-to="10"></li>
            <li data-target="#carouselAyuda" data-slide-to="11"></li>
            <li data-target="#carouselAyuda" data-slide-to="12"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.1.png'); ?>" alt="Registro paso 1">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.2.png'); ?>" alt="Registro paso 2">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.3.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.4.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.5.png'); ?>" alt="Registro paso 5">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.6.png'); ?>" alt="Registro paso 6">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.7.png'); ?>" alt="Registro paso 7">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.8.png'); ?>" alt="Registro paso 8">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.9.png'); ?>" alt="Registro paso 9">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.10.png'); ?>" alt="Registro paso 10">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.11.png'); ?>" alt="Registro paso 11">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.12.png'); ?>" alt="Registro paso 12">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselAyuda" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselAyuda" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
