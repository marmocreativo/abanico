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
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th style="width:50%"><?php echo $this->lang->line('carrito_producto'); ?></th>
                          <th style="width:10%" class="text-center"><?php echo $this->lang->line('carrito_cantidad'); ?></th>
                          <th style="width:20%" class="text-right"><?php echo $this->lang->line('carrito_precio'); ?></th>
                          <th style="width:20%" class="text-right"><?php echo $this->lang->line('carrito_total'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php /* BUCLE DE TIENDAS*/ foreach($_SESSION['carrito']['tiendas'] as $id_tienda => $tienda){ ?>
                        <?php
                          $datos_tienda = $this->TiendasModel->detalles($id_tienda);
                          $paquete_tienda = $this->PlanesModel->plan_activo_usuario($datos_tienda['ID_USUARIO'],'productos');
                          // creo el key del array de pedidos tienda;
                          $pedido_tienda[$id_tienda]=array();
                        ?>
                        <?php if($paquete_tienda['PLAN_ENVIO']=='abanico'){ ?>
                        <tr>
                          <td><?php echo $datos_tienda['TIENDA_NOMBRE'];?></td>
                          <td colspan="3">
                          <?php /* BUCLE DE PRODUCTOS*/ foreach($_SESSION['carrito']['productos'] as $producto){ ?>
                            <?php if($producto['id_tienda']==$id_tienda){ ?>
                                <b><?php echo $producto['nombre_producto'] ?></b><hr>
                            <?php }// Termina la condición que revisa si un producto es de la tienda ?>
                          <?php } // Termina el bucle de productos ?>
                          <p>Mensajerías</p>
                          <?php
                            $envio_abanico = $this->TransportistasRangosModel->lista_mejor_precio($peso_pedido_abanico,$importe_pedido_abanico,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO'],$paquete_tienda['PLAN_NIVEL']);
                          ?>
                        </td>
                      </tr>
                        <?php } // Condicion Tiendas Abanico ?>
                      <?php } // Termina el bucle de tiendas ?>
                      </tbody>
                    </table>
                    <!-- Pedidos Otras Tiendas -->
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th style="width:50%"><?php echo $this->lang->line('carrito_producto'); ?></th>
                          <th style="width:10%" class="text-center"><?php echo $this->lang->line('carrito_cantidad'); ?></th>
                          <th style="width:20%" class="text-right"><?php echo $this->lang->line('carrito_precio'); ?></th>
                          <th style="width:20%" class="text-right"><?php echo $this->lang->line('carrito_total'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php /* BUCLE DE TIENDAS*/ foreach($_SESSION['carrito']['tiendas'] as $id_tienda => $tienda){ ?>
                        <?php
                          $datos_tienda = $this->TiendasModel->detalles($id_tienda);
                          $paquete_tienda = $this->PlanesModel->plan_activo_usuario($datos_tienda['ID_USUARIO'],'productos');
                          // creo el key del array de pedidos tienda;
                          $pedido_tienda[$id_tienda]=array();
                        ?>
                        <?php if($paquete_tienda['PLAN_ENVIO']=='tienda'){ ?>
                        <tr>
                          <td><?php echo $datos_tienda['TIENDA_NOMBRE'];?></td>
                          <td colspan="3">
                          <?php /* BUCLE DE PRODUCTOS*/ foreach($_SESSION['carrito']['productos'] as $producto){ ?>
                            <?php if($producto['id_tienda']==$id_tienda){ ?>
                                <b><?php echo $producto['nombre_producto'] ?></b><hr>
                            <?php }// Termina la condición que revisa si un producto es de la tienda ?>
                          <?php } // Termina el bucle de productos ?>
                          <p>Mensajerías</p>
                          <?php
                            $envio_abanico = $this->TransportistasRangosModel->lista_mejor_precio($peso_pedido_abanico,$importe_pedido_abanico,$detalles_direccion['DIRECCION_PAIS'],$detalles_direccion['DIRECCION_ESTADO'],$paquete_tienda['PLAN_NIVEL']);
                          ?>
                        </td>
                      </tr>
                        <?php } // Condicion Tiendas Abanico ?>
                      <?php } // Termina el bucle de tiendas ?>
                      </tbody>
                    </table>

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
