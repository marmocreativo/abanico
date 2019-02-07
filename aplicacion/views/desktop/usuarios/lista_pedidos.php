<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <?php retro_alimentacion(); ?>
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="titulo">
                <h2 class="h5 mb-0"> <span class="fa fa-shopping-bag"></span> Tus Pedidos</h2>
              </div>
            </div>
            <div class="card-body">
              <?php foreach($pedidos as $pedido){ ?>
              <div class="card mb-3">
                <div class="card-header">
                  <div class="row">
                    <div class="col">
                      <p># Orden<br>
                      <b><?php echo $pedido->ID_PEDIDO; ?></b></p>
                    </div>
                    <div class="col">
                      <p>Folio<br>
                      <b><?php echo $pedido->PEDIDO_FOLIO; ?></b></p>
                    </div>
                    <div class="col">
                      <p>Fecha de Compra<br>
                      <b><?php echo $pedido->PEDIDO_FECHA_REGISTRO; ?></b></p>
                    </div>
                    <div class="col">
                      <p>Estado del Pedido<br>
                      <b><?php echo $pedido->PEDIDO_ESTADO_PEDIDO; ?></b></p>
                    </div>
                    <div class="col">
                      <p>Importe Total<br>
                      <b>$<?php echo $pedido->PEDIDO_IMPORTE_TOTAL.' '.$pedido->PEDIDO_DIVISA; ?></b></p>
                    </div>
                    <div class="col">
                      <a href="<?php echo base_url('usuario/pedidos/detalles?id_pedido='.$pedido->ID_PEDIDO); ?>" class="btn btn-sm btn-block btn-outline-success" title="Detalles del pedido"> <span class="fa fa-eye"></span> Detalles</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
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
                      <?php
                      $productos = $this->PedidosProductosModel->lista(['ID_PEDIDO'=>$pedido->ID_PEDIDO],'','');
                      foreach($productos as $producto){
                      ?>
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
                    <?php } // Termina Bucle de productos ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php }// Termina Bucle de Pedidos ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
