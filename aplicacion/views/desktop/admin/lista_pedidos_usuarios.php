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
            <form class="form-inline" action="<?php echo base_url('admin/pedidos/busqueda'); ?>" method="get">
              <div class="form-group">
                <label for="Busqueda" class="sr-only">Busqueda</label>
                <input type="text" class="form-control form-control-sm" id="Busqueda" name="Busqueda" placeholder="Buscar">
              </div>
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
                <th>orden</th>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Importe</th>
                <th>Fecha</th>
                <th>Estado del pedido</th>
                <th>Estado del pago</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($planes as $planes){ ?>
              <tr>
                <td><?php echo $pedido->ID_PEDIDO; ?></td>
                <td><?php echo $pedido->PEDIDO_FOLIO; ?></td>
                <td><?php echo $pedido->PEDIDO_NOMBRE; ?></td>
                <td>$<?php echo $pedido->PEDIDO_IMPORTE_TOTAL; ?></td>
                <td><?php echo $pedido->PEDIDO_FECHA_REGISTRO; ?></td>
                <td>
                  <?php
                    switch ($pedido->PEDIDO_ESTADO_PEDIDO) {
                      case 'Espera Pago':
                      case 'Envio Parcial':
                      case 'Pagado':
                        $color = 'warning';
                        break;
                      case 'Enviado':
                      case 'Envio Parcial':
                      case 'Pagado':
                        $color = 'success';
                        break;
                      case 'Error Pago':
                      case 'Cancelado':
                        $color = 'danger';
                        break;
                      case 'Entregado':
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
