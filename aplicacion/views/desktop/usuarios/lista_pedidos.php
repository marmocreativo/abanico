<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
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
            <div class="card-body py-0">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>orden</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Estado del pedido</th>
                    <th>Estado del pago</th>
                    <th class="text-right">Controles</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($pedidos as $pedido){ ?>
                  <tr>
                    <td><?php echo $pedido->ID_PEDIDO; ?></td>
                    <td>$<?php echo $pedido->PEDIDO_IMPORTE_TOTAL; ?></td>
                    <td>$<?php echo $pedido->PEDIDO_FECHA_REGISTRO; ?></td>
                    <td><?php echo $pedido->PEDIDO_ESTADO_PEDIDO; ?></td>
                    <td><?php echo $pedido->PEDIDO_ESTADO_PAGO; ?></td>
                    <td>
                      <div class="btn-group float-right">
                        <a href="<?php echo base_url('usuario/pedidos/detalles?id_pedido='.$pedido->ID_PEDIDO); ?>" class="btn btn-sm btn-outline-success" title="Detalles del pedido"> <span class="fa fa-eye"></span> Detalles</a>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
