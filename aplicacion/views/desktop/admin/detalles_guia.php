<div class="row justify-content-center">
  <div class="col-12">
    <?php retro_alimentacion(); ?>
    <div class="card">
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th style="width:20%">Guía</th>
              <th style="width:60%">Destinatario</th>
              <th style="width:10%">Estado</th>
              <th style="width:10%">Imprimir</th>
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
              <td>
                <a href="<?php echo base_url('admin/guias/imprimir?guia='.$guia['GUIA_CODIGO']); ?>" class="btn btn-success" target="_blank"> <i class="fa fa-print"></i> Imprimir</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col">
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
  </div>
  <div class="col-12">
    <div class="row">
      <div class="col">
          <div class="card">
            <div class="card-body">
              <h6 class="pb-3 border-bottom mb-3">Marcar Punto Preestablecido</h6>
              <form class="" action="<?php echo base_url('admin/guias/ruta_auto'); ?>" method="post">
                <input type="hidden" name="Guia" value="<?php echo $guia['GUIA_CODIGO']; ?>">
                <input type="hidden" name="Estado" value="En ruta">
                <div class="form-group">
                  <label for="IdPunto">Puntos Preestablecidos</label>
                  <select class="form-control" name="IdPunto">
                    <?php foreach($puntos_registro as $punto){ ?>
                      <option value="<?php echo $punto->ID_PUNTO; ?>"><?php echo $punto->PUNTO_ALIAS; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-truck"></i> Marcar En Ruta</button>
              </form>
            </div>
          </div>
      </div>
      <div class="col">
          <div class="card">
            <div class="card-body">
              <h6 class="pb-3 border-bottom mb-3">Marcar un Punto Nuevo</h6>
              <form class="" action="<?php echo base_url('admin/guias/ruta'); ?>" method="post">
                <input type="hidden" name="Guia" value="<?php echo $guia['GUIA_CODIGO']; ?>">
                <input type="hidden" name="Estado" value="En ruta">
                <input type="hidden" name="IdPunto" value="0">
                <div class="form-group">
                  <label for="IdPunto">Ubicación</label>
                  <input type="text" class="form-control" name="PuntoAlias">
                </div>
                <div class="form-group">
                  <label for="PuntoDirección">Dirección Descripción de la Ubicación</label>
                  <textarea name="PuntoDirección" class="form-control" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-truck"></i> Marcar en Ruta</button>
              </form>
            </div>
          </div>
      </div>
      <div class="col">
          <div class="card">
            <div class="card-body">
              <h6 class="pb-3 border-bottom mb-3">Marcar como entregado</h6>
              <form class="" action="<?php echo base_url('admin/guias/ruta'); ?>" method="post">
                <input type="hidden" name="Guia" value="<?php echo $guia['GUIA_CODIGO']; ?>">
                <input type="hidden" name="Estado" value="Entregado">
                <input type="hidden" name="IdPunto" value="0">
                <input type="hidden" name="PuntoAlias" value="Entregado">
                <input type="hidden" name="PuntoDirección" value="<?php echo $guia['GUIA_DIRECCION'] ?>">
                <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-gift"></i> Entregado</button>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
