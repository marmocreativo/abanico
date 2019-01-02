<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="titulo">
                <h2 class="h5 mb-0"> <span class="fa fa-box"></span> Tus Servicios</h2>
              </div>
              <div class="opciones">
                  <a href="<?php echo base_url('usuario/servicios/crear'); ?>" class="btn btn-success"> <span class="fa fa-plus"></span> Nuevo Servicio </a>
              </div>
            </div>
            <div class="card-body py-0">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Servicio</th>
                    <th>Estado</th>
                    <th class="text-right">Controles</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($servicios as $servicio){ ?>
                  <tr>
                    <td><?php echo $servicio->SERVICIO_NOMBRE; ?></td>
                    <td><?php echo $servicio->SERVICIO_ESTADO; ?></td>
                    <td>
                      <div class="btn-group float-right">
                        <a href="<?php echo base_url('usuario/servicios/actualizar?id='.$servicio->ID_SERVICIO); ?>" class="btn btn-sm btn-warning" title="Editar Servicio"> <span class="fa fa-pencil-alt"></span> </a>
                        <button data-enlace='<?php echo base_url('usuario/servicios/borrar?id='.$servicio->ID_SERVICIO); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Servicio"> <span class="fa fa-trash"></span> </button>
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
