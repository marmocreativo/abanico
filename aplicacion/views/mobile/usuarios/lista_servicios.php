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

      <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <h2 class="h5 mb-0 pt-1"> <span class="fa fa-box"></span> <?php echo $this->lang->line('usuario_lista_servicios_titulo'); ?></h2>
            <a href="<?php echo base_url('usuario/servicios/crear'); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span></a>
        </div>
        <div class="card-body">
          <?php foreach($servicios as $servicio){ ?>
          <div class="card mb-2">
            <div class="card-body">
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
