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

        <?php
        if(!empty($_GET['Tipo'])){
          $tipo = $_GET['Tipo'];
        }else{
          $tipo = 'productos';
        }
        ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h6"> <span class="fa fa-file-signature"></span> Planes de <?php if($tipo=='productos'){ echo 'Vendedores'; }else{ echo 'Servicios'; } ?></h1>
          </div>
          <div class="formulario">
            <form class="form-inline" action="<?php echo base_url('admin/planes/lista_planes_usuarios'); ?>" method="get">
              <div class="form-group mx-2">
                <label for="Tipo"> Tipo de Plan </label>
                <select class="form-control" name="Tipo">
                  <option value="productos" <?php if($tipo=='productos'){ echo 'selected'; } ?>>Vendedores</option>
                  <option value="servicios" <?php if($tipo=='servicios'){ echo 'selected'; } ?>>Servicios</option>
                </select>
              </div>
              <div class="form-group mx-2">
                <label for="Estado"> Estado </label>
                <select class="form-control" name="Estado">
                  <option value="">Estado</option>
                  <option value="pendiente" <?php if(isset($_GET['Estado'])&&$_GET['Estado']=='pendiente'){ echo 'selected'; } ?>>Pendiente</option>
                  <option value="espera pago" <?php if(isset($_GET['Estado'])&&$_GET['Estado']=='espera pago'){ echo 'selected'; } ?>>Espera de pago</option>
                  <option value="pagado" <?php if(isset($_GET['Estado'])&&$_GET['Estado']=='pagado'){ echo 'selected'; } ?>>Pagado</option>
                  <option value="cancelado" <?php if(isset($_GET['Estado'])&&$_GET['Estado']=='cancelado'){ echo 'selected'; } ?>>Cancelado</option>
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
                <th>Plan</th>
                <th>Tienda/Perfil</th>
                <th>Vigencia</th>
                <th>Estado del plan</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($planes as $plan){ ?>
              <tr>
                <td><?php echo $plan->ID_PLAN_USUARIO; ?></td>
                <td><?php echo $plan->PLAN_NOMBRE; ?></td>
                <td>
                  <?php
                  if($plan->PLAN_TIPO=='productos'){
                    $datos = $this->TiendasModel->tienda_usuario($plan->ID_USUARIO);
                    $nombre = $datos['TIENDA_NOMBRE'];
                    $enlace = base_url('admin/tiendas/actualizar?id_tienda='.$datos['ID_TIENDA']);
                  }else{
                    $datos = $this->PerfilServiciosModel->perfil_usuario($plan->ID_USUARIO);
                    $nombre = $datos['PERFIL_NOMBRE'];
                    $enlace = base_url('admin/perfiles_servicios/actualizar?id_usuario='.$datos['ID_USUARIO'].'&id_perfil='.$datos['ID_PERFIL']);
                  }
                  //echo $plan->ID_USUARIO;
                  ?>
                  <a href="<?php echo $enlace; ?>"><?php echo $nombre; ?></a>
                </td>
                <td><?php echo $plan->FECHA_TERMINO; ?></td>
                <td>
                  <?php
                    switch ($plan->PLAN_ESTADO) {
                      case 'pendiente':
                      case 'espera pago':
                        $color = 'warning';
                        break;

                      case 'pagado':
                        $color = 'success';
                        break;

                      case 'cancelado':
                        $color = 'danger';
                        break;
                    }
                  ?>
                  <span class="badge badge-<?php echo $color; ?>"><?php echo $plan->PLAN_ESTADO; ?></span>
                </td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo base_url('admin/planes/actualizar_plan_usuario?id='.$plan->ID_PLAN_USUARIO); ?>" class="btn btn-sm btn-outline-primary" title="Detalles del plan"> Activar / Editar</a>
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
