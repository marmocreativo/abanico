
  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h2 class="h6 mb-0"> <span class="fa fa-map-marker-alt"></span> Puntos de Registro Abanico</h2>
          </div>
          <div class="opciones">
              <a href="<?php echo base_url('admin/puntos_registro/crear'); ?>" class="btn btn-success btn-sm"> <span class="fa fa-plus"></span> Nuevo Punto de Registro </a>
          </div>
        </div>
        <div class="card-body py-0">
          <table class="table ">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Direccion</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($puntos_registro as $punto_registro){ ?>
              <tr>
                <td><?php echo $punto_registro->PUNTO_ALIAS; ?></td>
                <td><?php echo $this->PuntosRegistroModel->direccion_formateada($punto_registro->ID_PUNTO); ?></td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo base_url('admin/puntos_registro/actualizar?id='.$punto_registro->ID_PUNTO); ?>" class="btn btn-sm btn-warning" title="Editar Dirección"> <span class="fa fa-pencil-alt"></span> </a>
                    <button data-enlace='<?php echo base_url('admin/puntos_registro/borrar?id='.$punto_registro->ID_PUNTO); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Dirección"> <span class="fa fa-trash"></span> </button>
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
