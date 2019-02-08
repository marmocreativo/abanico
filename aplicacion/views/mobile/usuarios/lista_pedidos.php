<div class="fila-gris">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('mobile/usuarios/widgets/menu_control_usuario'); ?>
      </div>
    </div>
  </div>
  <?php retro_alimentacion(); ?>
</div>

    <div class="container py-3 mb-3">
      <div class="row">
        <div class="col">
          <?php retro_alimentacion(); ?>
          <div class="card my-3">
            <div class="card-header d-flex justify-content-between">
              <div class="titulo">
                <h2 class="h5 mb-0"> <span class="fa fa-shopping-bag"></span> Tus Pedidos</h2>
              </div>
            </div>
            <div class="card-body p-2">
              <?php foreach($pedidos as $pedido){ ?>
              <div class="card border border-dark mb-3">
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
                      <a href="<?php echo base_url('usuario/pedidos/detalles?id_pedido='.$pedido->ID_PEDIDO); ?>" class="btn btn-sm btn-block btn-outline-success" title="Detalles del pedido"> <span class="fa fa-eye"></span> Detalles</a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-0">
                  <table class="table table-striped table-responsive">
                    <thead>
                      <tr>
                        <th style="width:50%">Producto</th>
                        <th style="width:10%" class="text-center">Cantidad</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $productos = $this->PedidosProductosModel->lista(['ID_PEDIDO'=>$pedido->ID_PEDIDO],'','');
                      foreach($productos as $producto){
                      ?>
                      <tr>
                        <td style="vertical-align:middle">
                              <img src="<?php echo $producto->PRODUCTO_IMAGEN;  ?>" class="img-thumbnail" width="70" alt="">
                              <p class="h6"><?php echo $producto->PRODUCTO_NOMBRE;  ?></p>
                              <p style="font-size:0.8em;" class="mb-1"><?php echo $producto->PRODUCTO_DETALLES;  ?></p>
                        </td>
                        <td style="vertical-align:middle; text-align:center;">
                          x<?php echo $producto->CANTIDAD;  ?>
                          <br>

                            <small>$</small>
                            <?php echo number_format($producto->IMPORTE,2);  ?>
                            <small><?php echo $pedido->PEDIDO_DIVISA; ?></small>
                        </td>
                      </tr>
                    <?php } // Termina Bucle de productos ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  <div class="row">

                    <div class="col">
                      <p>Fecha de Compra<br>
                      <b><?php echo $pedido->PEDIDO_FECHA_REGISTRO; ?></b></p>
                    </div>
                    <div class="col">
                      <p>Estado del Pedido<br>
                      <b><?php echo $pedido->PEDIDO_ESTADO_PEDIDO; ?></b></p>
                    </div>
                    <div class="col-12 text-center">
                      <p>Importe Total<br>
                      <b>$<?php echo $pedido->PEDIDO_IMPORTE_TOTAL.' '.$pedido->PEDIDO_DIVISA; ?></b></p>
                    </div>
                  </div>
                </div>
              </div>
            <?php }// Termina Bucle de Pedidos ?>
            </div>
          </div>
        </div>
      </div>
    </div>
