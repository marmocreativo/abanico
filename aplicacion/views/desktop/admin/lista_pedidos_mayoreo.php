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
            <form class="form-inline" action="<?php echo base_url('admin/pedidos/lista_pedidos_mayoreo'); ?>" method="get">
              <div class="form-group mx-2">
                <label for="Fecha"> Fecha </label>
                <input type="date" class="form-control" name="Fecha" value="<?php if(isset($_GET['Fecha'])){ echo $_GET['Fecha'];}else{ echo date('Y-m-d'); } ?>">
              </div>
              <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-search"></i> Buscar</button>
            </form>
          </div>
          <div class="opciones d-flex">
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table">
            <thead>
              <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Productos</th>
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
                <td><?php echo $pedido->PEDIDO_FOLIO; ?></td>
                <td>
                  <b><?php echo $pedido->PEDIDO_NOMBRE_EMPRESA; ?></b><br>
                  <?php echo $pedido->PEDIDO_NOMBRE; ?>
                </td>
                <td>
                  <?php $productos = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$pedido->ID_PEDIDO],'','',''); ?>
                  <table class="table table-striped table-bordered table-sm">
                    <tr>
                    <?php foreach($productos as $producto){ ?>
                        <td class="text-center">
                          <img src="<?php echo $producto->PRODUCTO_IMAGEN;  ?>" width="30px;"><br><b>X<?php echo $producto->CANTIDAD; ?></b>
                        </td>
                    <?php }?>
                    </tr>
                  </table>
                </td>
                <td>$<?php echo $pedido->PEDIDO_IMPORTE_TOTAL; ?></td>
                <td><?php echo date('d / M / Y', strtotime($pedido->PEDIDO_FECHA_REGISTRO)); ?></td>
                <td>
                  <?php
                    switch ($pedido->PEDIDO_ESTADO_PEDIDO) {
                      case 'confirmado':
                      case 'pendiente':
                        $color = 'warning';
                        break;
                      case 'pagado':
                        $color = 'success';
                        break;
                      default:
                        $color = 'default';
                        break;
                    }
                  ?>
                  <span class="badge badge-<?php echo $color; ?>"><?php echo $pedido->PEDIDO_ESTADO_PEDIDO; ?></span>
                </td>
                <td>
                  <?php
                    switch ($pedido->PEDIDO_ESTADO_PAGO) {
                      case 'Pendiente':
                      case 'Comprobante':
                        $color = 'warning';
                        break;
                      case 'Pagado':
                        $color = 'success';
                        break;
                      case 'Error Pago':
                      case 'Cancelado':
                        $color = 'danger';
                        break;
                    }
                  ?>
                  <span class="badge badge-<?php echo $color; ?>"><?php echo $pedido->PEDIDO_ESTADO_PAGO; ?></span>
                </td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo base_url('admin/pedidos/detalles_pedido_mayoreo?id_pedido='.$pedido->ID_PEDIDO); ?>" class="btn btn-sm btn-outline-success" title="Detalles del pedido"> <span class="fa fa-eye"></span> Detalles</a>
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
