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
      <?php retro_alimentacion(); ?>
      <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h2 class="h5 mb-0 pt-1"> <span class="fa fa-map-marker-alt"></span> <?php echo $this->lang->line('usuario_lista_direcciones_titulo'); ?></h2>
          </div>
          <div class="opciones">
                <a href="<?php echo base_url('usuario/direcciones/crear'); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span></a>
          </div>
        </div>
        <?php foreach($direcciones as $direccion){ ?>
        <div class="card-body">
          <h3 class="h6"><strong><?php echo $this->lang->line('usuario_lista_direcciones_alias'); ?></strong></h3>
          <p><?php echo $direccion->DIRECCION_ALIAS; ?></p>
          <h3 class="h6"><strong><?php echo $this->lang->line('usuario_lista_direcciones_direccion'); ?></strong></h3>
          <p><?php echo $this->DireccionesModel->direccion_formateada($direccion->ID_DIRECCION); ?></p>
          <h3 class="h6"><strong><?php echo $this->lang->line('usuario_lista_direcciones_tipo_direccion'); ?></strong></h3>
          <p><?php echo $direccion->DIRECCION_TIPO; ?></p>
          <div class="btn-group float-right">
            <a href="<?php echo base_url('usuario/direcciones/actualizar?id='.$direccion->ID_DIRECCION); ?>" class="btn btn-sm btn-warning" title="<?php echo $this->lang->line('usuario_listas_generales_editar'); ?> <?php echo $this->lang->line('usuario_lista_direcciones_singular'); ?>"> <span class="fa fa-pencil-alt"></span> </a>
            <button data-enlace="<?php echo base_url('usuario/direcciones/borrar?id='.$direccion->ID_DIRECCION); ?>" class="btn btn-sm btn-danger borrar_entrada" title="<?php echo $this->lang->line('usuario_listas_generales_eliminar'); ?> <?php echo $this->lang->line('usuario_lista_direcciones_singular'); ?>"> <span class="fa fa-trash"></span> </button>
          </div>
        </div>
        <hr>
      <?php } ?>
      </div>



    </div>
  </div>
</div>
