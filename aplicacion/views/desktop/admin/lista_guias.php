  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h6"> <span class="fa fa-recipt"></span> Guías</h1>
          </div>
          <div class="formulario">
          </div>
          <div class="opciones d-flex">
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table">
            <thead>
              <tr>
                <th style="width:20%">Guía</th>
                <th style="width:60%">Destinatario</th>
                <th style="width:10%">Estado</th>
                <th style="width:10%">Actualizado</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($guias as $guia){ ?>
              <tr>
                <td>
                  <a href="<?php echo base_url('admin/guias/detalles?guia='.$guia->GUIA_CODIGO);  ?>">
                    <?php echo $guia->GUIA_CODIGO; ?>
                  </a>
                </td>
                <td>
                  <p><?php echo $guia->GUIA_NOMBRE; ?><br>
                  <i class="fa fa-home"></i> <?php echo $guia->GUIA_DIRECCION; ?><br>
                  <i class="fa fa-phone"></i> <?php echo $guia->GUIA_TELEFONO; ?><br>
                  <i class="fa fa-envelope"></i> <?php echo $guia->GUIA_CORREO; ?></p>
                </td>
                <td><?php echo $guia->GUIA_ESTADO; ?></td>
                <td><?php echo $guia->GUIA_FECHA_ACTUALIZACION; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
