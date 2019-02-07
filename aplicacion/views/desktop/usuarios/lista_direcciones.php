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
                <h2 class="h5 mb-0"> <span class="fa fa-map-marker-alt"></span> Tus Direcciones</h2>
              </div>
              <div class="opciones">
                  <a href="<?php echo base_url('usuario/direcciones/crear'); ?>" class="btn btn-success"> <span class="fa fa-plus"></span> Nueva Dirección </a>
              </div>
            </div>
            <div class="card-body py-0">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Alias</th>
                    <th>Direccion</th>
                    <th>Tipo Dirección</th>
                    <th class="text-right">Controles</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($direcciones as $direccion){ ?>
                  <tr>
                    <td><?php echo $direccion->DIRECCION_ALIAS; ?></td>
                    <td><?php echo $this->DireccionesModel->direccion_formateada($direccion->ID_DIRECCION); ?></td>
                    <td><?php echo $direccion->DIRECCION_TIPO; ?></td>
                    <td>
                      <div class="btn-group float-right">
                        <a href="<?php echo base_url('usuario/direcciones/actualizar?id='.$direccion->ID_DIRECCION); ?>" class="btn btn-sm btn-warning" title="Editar Dirección"> <span class="fa fa-pencil-alt"></span> </a>
                        <button data-enlace='<?php echo base_url('usuario/direcciones/borrar?id='.$direccion->ID_DIRECCION); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Dirección"> <span class="fa fa-trash"></span> </button>
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
