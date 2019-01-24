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
          <div class="titulo">
            <h1 class="h6"> <span class="fa fa-box"></span> Pedidos</h1>
          </div>
          <div class="formulario">
          </div>
          <div class="opciones d-flex">
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table">
            <thead>
              <tr>
                <th>orden</th>
                <th>Folio</th>
                <th>Registro</th>
                <th>Cliente</th>
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
                <td><?php echo $pedido->PEDIDO_FOLIO; ?></td>
                <td>
                  <?php
                  if($pedido->ID_USUARIO==0){
                    echo 'Inv';
                  }else{
                    echo 'Reg';
                  }
                  ?>
                </td>
                <td><?php echo $pedido->PEDIDO_NOMBRE; ?></td>
                <td>$<?php echo $pedido->PEDIDO_IMPORTE_TOTAL; ?></td>
                <td>$<?php echo $pedido->PEDIDO_FECHA_REGISTRO; ?></td>
                <td><?php echo $pedido->PEDIDO_ESTADO_PEDIDO; ?></td>
                <td><?php echo $pedido->PEDIDO_ESTADO_PAGO; ?></td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo base_url('admin/pedidos/detalles?id_pedido='.$pedido->ID_PEDIDO); ?>" class="btn btn-sm btn-outline-success" title="Detalles del pedido"> <span class="fa fa-eye"></span> Detalles</a>
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
