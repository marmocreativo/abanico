<?php if(isset($_GET['id_usuario'])){ ?>
  <div class="row">
    <div class="col-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-four">
              <div class="stat-icon dib">
                  <i class="fa fa-user-tag text-muted"></i>
              </div>
              <div class="stat-content">
                  <div class="text-left dib">
                      <div class="stat-heading">Usuario</div>
                      <div class="stat-text"><?php echo $usuario['USUARIO_NOMBRE'].' '.$usuario['USUARIO_APELLIDOS']; ?></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <form class="" action="<?php echo base_url('admin/corte_vendedores'); ?>" method="get">
            <div class="titulo">
              <h1 class="h6"> <span class="fa fa-box"></span> Corte Vendedores</h1>
            </div>
            <div class="formulario form-inline">
              <div class="form-group mx-2">
                <label for="MesCorte"> Mes </label>
                <select class="form-control" name="MesCorte">
                  <?php if(isset($_GET['MesCorte'])&&!empty($_GET['MesCorte'])){ $mes = $_GET['MesCorte']; }else{ $mes = date('m');}?>
                  <option value="01" <?php if($mes=='01'){ echo 'selected'; } ?>>Enero</option>
                  <option value="02" <?php if($mes=='02'){ echo 'selected'; } ?>>Febrero</option>
                  <option value="03" <?php if($mes=='03'){ echo 'selected'; } ?>>Marzo</option>
                  <option value="04" <?php if($mes=='04'){ echo 'selected'; } ?>>Abril</option>
                  <option value="05" <?php if($mes=='05'){ echo 'selected'; } ?>>Mayo</option>
                  <option value="06" <?php if($mes=='06'){ echo 'selected'; } ?>>Junio</option>
                  <option value="07" <?php if($mes=='07'){ echo 'selected'; } ?>>Julio</option>
                  <option value="08" <?php if($mes=='08'){ echo 'selected'; } ?>>Agosto</option>
                  <option value="09" <?php if($mes=='09'){ echo 'selected'; } ?>>Septiembre</option>
                  <option value="10" <?php if($mes=='10'){ echo 'selected'; } ?>>Octubre</option>
                  <option value="11" <?php if($mes=='11'){ echo 'selected'; } ?>>Noviembre</option>
                  <option value="12" <?php if($mes=='12'){ echo 'selected'; } ?>>Diciembre</option>
                </select>
              </div>
              <div class="form-group mx-2">
                <label for="AnioCorte"> Año </label>
                <select class="form-control" name="AnioCorte">
                  <?php if(isset($_GET['AnioCorte'])&&!empty($_GET['AnioCorte'])){ $anio = $_GET['AnioCorte']; }else{ $anio = date('Y');}?>
                  <option value="2019" <?php if($anio=='2019'){ echo 'selected'; } ?>>2019</option>
                  <option value="2020" <?php if($anio=='2020'){ echo 'selected'; } ?>>2020</option>
                  <option value="2021" <?php if($anio=='2021'){ echo 'selected'; } ?>>2021</option>
                  <option value="2022" <?php if($anio=='2022'){ echo 'selected'; } ?>>2022</option>
                  <option value="2023" <?php if($anio=='2023'){ echo 'selected'; } ?>>2023</option>
                </select>
              </div>
                <button type="submit" class="btn btn-primary btn-sm" name="button"> <i class="fa fa-search"></i> Buscar</button>
            </div>
          </form>
        </div>
        <div class="card-body">
          <?php
            // Variables generales (Fechas)
              if(isset($_GET['MesCorte'])&&!empty($_GET['MesCorte'])&&isset($_GET['AnioCorte'])&&!empty($_GET['AnioCorte'])){
                $inicio = date($_GET['AnioCorte'].'-'.$_GET['MesCorte'].'-01 00:00:00');
                $fin = date('Y-m-d H:i:s',strtotime('+1 month'.$inicio));
              }else{
                $inicio = date('Y-m-d H:i:s');
                $fin = date('Y-m-d H:i:s',strtotime('+1 month'.$inicio));
              }
          ?>
          <?php foreach($tiendas as $tienda){ ?>
            <?php
              $visible = ''; //
              $lista_pedidos = $this->PedidosTiendasModel->lista_pedidos_pagos_tienda($tienda->ID_TIENDA,$inicio,$fin);
              if(empty($lista_pedidos)){ $visible = 'd-none'; }
              ?>
            <div class="border border-primary p-4 mb-2 <?php echo $visible; ?>">
              <h4 class="mb-2"> <i class="fa fa-store"></i> <?php echo $tienda->TIENDA_NOMBRE; ?></h4>
              <?php foreach($lista_pedidos as $pedido){ ?>
                <table class="table table-bordered table-sm">
                  <tr>
                    <td>Folio: <b><?php echo $pedido->PEDIDO_FOLIO; ?></b></td>
                    <td>Fecha Pedido: <b><?php echo $pedido->PEDIDO_FECHA_REGISTRO; ?></b></td>
                    <td>Estado Pedido: <b> <?php echo $pedido->PEDIDO_ESTADO_PEDIDO; ?></b></td>
                    <td>Fecha Pago: <b><?php echo $pedido->PAGO_FECHA_REGISTRO; ?></b></td>
                  </tr>
                  <tr>
                    <td colspan="2">Forma de Pago: <b><?php echo $pedido->PAGO_FORMA; ?></b></td>
                    <td colspan="2">Divisa: <b><?php echo $pedido->PEDIDO_DIVISA; ?></b></td>
                  </tr>
                  <tr>
                    <td colspan="4">
                      <?php
                      // Consulta de productos
                      $productos = $this->PedidosProductosModel->lista_tienda(['ID_PEDIDO'=>$pedido->ID_PEDIDO],$tienda->ID_TIENDA,'','');
                      ?>
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
                                  <small><?php echo $pedido->PEDIDO_DIVISA; ?></small>
                                </td>
                                <td style="vertical-align:middle" class="text-right">
                                  <small>$</small>
                                    <?php echo number_format($producto->IMPORTE_TOTAL,2);  ?>
                                  <small><?php echo $pedido->PEDIDO_DIVISA; ?></small>
                                </td>
                              </tr>
                            <?php } ?>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" style="text-align:right">Importe Tienda:</td>
                    <td>$<b><?php echo $pedido->PEDIDO_TIENDA_IMPORTE_PRODUCTOS; ?></b></td>
                  </tr>
                  <tr>
                    <td colspan="3" style="text-align:right">Envio:</td>
                    <td>$<b><?php echo $pedido->PEDIDO_TIENDA_IMPORTE_ENVIO; ?></b></td>
                  </tr>
                  <tr>
                    <td colspan="3" style="text-align:right">Comisión Venta (<b><?php echo $pedido->PORCENTAJE_COMISION_VENTA; ?></b>%):</td>
                    <td>-$<b><?php echo $pedido->COMISION_VENTA; ?></b></td>
                  </tr>
                  <tr>
                    <td colspan="3" style="text-align:right">Manejo de Producto (<b><?php echo $pedido->PORCENTAJE_COMISION_MANEJO; ?></b>%):</td>
                    <td>-$<b><?php echo $pedido->COMISION_MANEJO; ?></b></td>
                  </tr>
                  <tr>
                    <td colspan="3" style="text-align:right">Comisión <?php echo $pedido->PAGO_FORMA ?> (<b><?php echo $pedido->	PORCENTAJE_SERVICIOS_FINANCIEROS; ?></b>%):</td>
                    <td>-$<b><?php echo $pedido->COMISION_SERVICIOS_FINANCIEROS; ?></b></td>
                  </tr>
                  <tr>
                    <td colspan="3" style="text-align:right"><?php echo $pedido->PAGO_FORMA ?> +:</td>
                    <td>-$<b><?php echo $pedido->COMISION_FIJA_SERVICIOS_FINANCIEROS; ?></b></td>
                  </tr>
                  <tr>
                    <td colspan="3" style="text-align:right">A Depositar:</td>
                    <td>$<b><?php echo $pedido->IMPORTE_A_LIQUIDAR; ?></b></td>
                  </tr>
                </table>
                <hr>
              <?php } ?>
              <div class="text-right">
                <form class="" action="<?php echo base_url('admin/corte_vendedores/liquidar'); ?>" method="post">
                  Corte al mes para: <b><?php echo $tienda->TIENDA_NOMBRE; ?></b><br>
                  $2500.00 MXN<br>
                  $60.00 USD
                </form>
              </div>

            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
