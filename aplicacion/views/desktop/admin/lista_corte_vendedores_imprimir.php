
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
		<div class="kt-container kt-body kt-grid kt-grid--ver" id="kt_body">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

				<!-- begin:: Subheader -->
				<div class="kt-subheader   kt-grid__item" id="kt_subheader">
					<div class="kt-subheader__main">
					</div>
					<div class="kt-subheader__toolbar">
					</div>
				</div>

				<!-- end:: Subheader -->

				<!-- begin:: Content -->
				<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

					<!--Begin::Dashboard 8-->

					<!--Begin::Section-->
					<div class="row mb-3">
						<div class="col-xl-12">

							<!--begin:: Widgets/Trends-->
							<div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
								<div class="kt-portlet__body">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
            <?php
              // Variables generales (Fechas)
                if(isset($_GET['MesCorte'])&&!empty($_GET['MesCorte'])&&isset($_GET['AnioCorte'])&&!empty($_GET['AnioCorte'])){
                  $inicio = date($_GET['AnioCorte'].'-'.$_GET['MesCorte'].'-01 00:00:00');
                  $fin = date('Y-m-d H:i:s',strtotime('+1 month'.$inicio));
                }else{
                  $inicio = date('Y-m-01 H:i:s');
                  $fin = date('Y-m-d H:i:s',strtotime('+1 month'.$inicio));
                }
                $suma_divisa = array();
                foreach($divisas_activas as $divisa){
                  $suma_divisa[$divisa->DIVISA_ISO] = 0;
                }
            ?>
            <?php foreach($tiendas as $tienda){ ?>
              <?php
                $visible = ''; //
                $lista_pedidos = $this->PedidosTiendasModel->lista_pedidos_pagos_tienda($tienda->ID_TIENDA,$inicio,$fin);
                if(empty($lista_pedidos)){ $visible = 'd-none'; }
                ?>
              <div class="border border-primary p-4 mb-4 <?php echo $visible; ?>">
                <h4 class="mb-2"> <i class="fa fa-store"></i> <?php echo $tienda->TIENDA_NOMBRE; ?></h4>
                <?php foreach($lista_pedidos as $pedido){ if($pedido->PEDIDO_TIENDA_LIQUIDADO=='si'){ $bg_liquidado = 'bg-success';  }else{ $bg_liquidado = 'bg-primary'; } ?>
                  <table class="table table-bordered table-sm">
                    <tr>
                      <td class="<?php echo $bg_liquidado; ?> text-white">Folio: <b><?php echo $pedido->PEDIDO_FOLIO; ?></b></td>
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
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#productos_<?php echo $pedido->ID_PEDIDO; ?>" aria-expanded="false" aria-controls="collapseExample">
                          + Mostrar Productos
                        </button>
                        <div class="collapse" id="productos_<?php echo $pedido->ID_PEDIDO; ?>">
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
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#detalles_<?php echo $pedido->ID_PEDIDO; ?>" aria-expanded="false" aria-controls="collapseExample">
                          + Mostrar Detalles
                        </button>
                          <div class="collapse" id="detalles_<?php echo $pedido->ID_PEDIDO; ?>">
                            <table class="table table-bordered table-sm">
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
                            <?php
                              // Suma de Importes
                              $suma_divisa[$pedido->PEDIDO_DIVISA] += $pedido->IMPORTE_A_LIQUIDAR;
                            ?>
                          </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" style="text-align:right">A Depositar:</td>
                      <td>$<b><?php echo $pedido->IMPORTE_A_LIQUIDAR; ?></b></td>
                    </tr>
                    <tr>
                      <td colspan="3" style="text-align:right">Folio Pago:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" name="FolioLiquidacion[<?php echo $pedido->ID_PEDIDO_TIENDA; ?>]" value="<?php echo $pedido->FOLIO_LIQUIDAR; ?>">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3"></td>
                      <td>
                      </td>
                    </tr>
                  </table>
                  <hr>
                <?php } ?>
                <div class="">
                  Corte al mes para: <b><?php echo $tienda->TIENDA_NOMBRE; ?></b><br>
                  <table class="table table-sm table-bordered w-25 mt-2">
                    <?php foreach($suma_divisa as $key => $suma){ if($suma>0){ ?>
                    <tr>
                      <td>
                        <div class="mt-2">
                          <label>$<?php echo $suma; ?> <?php echo $key; ?></label>
                        </div>
                      </td>
                    </tr>
                    <?php
                  }// Condicional la suma no debe ser cero
                }// Bucle de divisas
                     //Reinicio las variables de sumas
                     $suma_divisa = array();
                     foreach($divisas_activas as $divisa){
                       $suma_divisa[$divisa->DIVISA_ISO] = 0;
                     }
                    ?>
                  </table>
                </div>
              </div>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!--end:: Widgets/Trends-->
</div>
</div>
<!--End::Section-->

<!--End::Dashboard 8-->
</div>

<!-- end:: Content -->
</div>
</div>
</div>
