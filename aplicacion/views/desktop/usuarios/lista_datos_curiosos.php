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
                <h2 class="h5 mb-0"> <span class="fa fa-question"></span> Datos Curiosos</h2>
              </div>
              <div class="opciones">
                  <a href="<?php echo base_url('usuario/datos_curiosos/crear'); ?>" class="btn btn-success"> <span class="fa fa-plus"></span> <?php echo $this->lang->line('usuario_listas_generales_nuevo'); ?> Dato Curioso </a>
              </div>
            </div>
            <div class="card-body py-0">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Dato Curioso</th>
                    <th>Votaciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($datos_curiosos as $datos){ ?>
                  <tr>
                    <td><?php echo $datos->FECHA_REGISTRO; ?></td>
                    <td><?php echo $datos->TEXTO; ?></td>
                    <td><?php echo $datos->VOTACIONES; ?></td>
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
