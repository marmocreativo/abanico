<!-- empieza panel usuario resposivo -->

<div class="fila-gris">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('mobile/usuarios/widgets/menu_control_usuario'); ?>
      </div>
    </div>
  </div>
</div>

<div class="container py-3 mb-3">
  <div class="row">
    <div class="col-12">
      <?php alerta_plan(); ?>
      <?php retro_alimentacion(); ?>
      <?php
        $productos_activo = null;
        $fotografias_producto = null;
        $servicios_activos = null;
        $fotografias_servicios = null;
        $anexos = false;
        $plan = $this->PlanesModel->plan_pendiente_usuario($_SESSION['usuario']['id'],'servicios');
        if(!empty($plan)){
          $productos_activo = $plan['PLAN_LIMITE_PRODUCTOS'];
          $fotografias_producto = $plan['PLAN_FOTOS_PRODUCTOS'];
          $servicios_activos = $plan['PLAN_LIMITE_SERVICIOS'];
          $fotografias_servicios = $plan['PLAN_FOTOS_SERVICIOS'];
          if($plan['PLAN_NIVEL']>1){
            $anexos = true;
          }
        }
        $cantidad_servicios = count($servicios);
      ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h2 class="h5 mb-0 pt-1"> <span class="fa fa-box"></span> <?php echo $this->lang->line('usuario_lista_servicios_titulo'); ?></h2>
            <?php if($servicios_activos!=null&&($servicios_activos>$cantidad_servicios||$servicios_activos==0)){ ?>
            <a href="<?php echo base_url('usuario/servicios/crear'); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span></a>
          <?php }else{ ?>
            <p class="text-danger">Límite de servicios alcanzado</p>
          <?php } ?>
        </div>
        <div class="card-body p-0">
          <?php foreach($servicios as $servicio){ ?>
          <div class="card mb-0 border-0">
            <div class="card-body border-bottom">
              <h3 class="h6"><strong><?php echo $servicio->SERVICIO_NOMBRE; ?></strong></h3>
              <p><?php echo $servicio->SERVICIO_ESTADO; ?></p>
              <div class="btn-group float-right">
                <a href="<?php echo base_url('usuario/servicios/actualizar?id='.$servicio->ID_SERVICIO); ?>" class="btn btn-sm btn-warning" title="Editar Servicio"> <span class="fa fa-pencil-alt"></span> </a>
                <button data-enlace="<?php echo base_url('usuario/servicios/borrar?id='.$servicio->ID_SERVICIO); ?>" class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Dirección"> <span class="fa fa-trash"></span> </button>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>

    </div>
  </div>
</div>
