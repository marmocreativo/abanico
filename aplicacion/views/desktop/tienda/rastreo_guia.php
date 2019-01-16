<div class="contenido_principal">
  <div class="fila">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8">
          <?php if(!empty($guia)){ ?>
            <div class="card">
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width:20%">Guía</th>
                      <th style="width:60%">Destinatario</th>
                      <th style="width:10%">Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <a href="<?php echo base_url('admin/guias/detalles?guia='.$guia['GUIA_CODIGO']);  ?>">
                          <?php echo $guia['GUIA_CODIGO']; ?>
                        </a>
                      </td>
                      <td>
                        <p><?php echo $guia['GUIA_NOMBRE']; ?><br>
                        <i class="fa fa-home"></i> <?php echo $guia['GUIA_DIRECCION']; ?><br>
                        <i class="fa fa-phone"></i> <?php echo $guia['GUIA_TELEFONO']; ?><br>
                        <i class="fa fa-envelope"></i> <?php echo $guia['GUIA_CORREO']; ?></p>
                      </td>
                      <td><?php echo $guia['GUIA_ESTADO']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h6> <i class="fa fa-recipt"></i> Rastreo de Guía <b><?php echo $guia['GUIA_CODIGO'] ?></b></h6>
              </div>
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th >Ubicación</th>
                      <th >Dirección</th>
                      <th >Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($ubicaciones as $ubicacion){ ?>
                    <tr>
                      <td><?php echo $ubicacion->PUNTO_ALIAS; ?></td>
                      <td><?php echo $ubicacion->PUNTO_DIRECCION; ?></td>
                      <td><?php echo $ubicacion->RUTA_FECHA_REGISTRO; ?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>