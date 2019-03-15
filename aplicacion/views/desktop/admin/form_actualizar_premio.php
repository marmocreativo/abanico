  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5> <i class="fa fa-file"></i> Nueva Publicación</h5>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/premios/actualizar');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Identificador" value="<?php echo $premio['ID_PREMIO'] ?>">
            <input type="hidden" name="ImagenPremioAnterior" value="<?php echo $premio['PREMIO_IMAGEN'] ?>">
            <div class="row">
              <div class="col-9">
                <div class="form-group">
                  <label for="TituloPremio">Título </label>
                  <input type="text" name="TituloPremio" class="form-control" value="<?php echo $premio['PREMIO_TITULO'] ?>">
                </div>
                <div class="form-group">
                  <label for="FechaDisponiblePremio">Fecha Disponibilidad </label>
                  <input type="date" name="FechaDisponiblePremio" class="form-control" value="<?php echo $premio['PREMIO_FECHA_DISPONIBLE'] ?>">
                </div>
              </div>
              <div class="col-3">
                <img src="<?php echo base_url('contenido/img/publicaciones/'.$premio['PREMIO_IMAGEN']) ?>" id="PrevisualizarImagen" alt="" class="img-fluid img-thumbnail rounded">
                <hr>
                <div class="form-group">
                  <label for="ImagenPremio"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                  <input type="file" class="form-control" id="ImagenPremio" name="ImagenPremio">
                </div>
                <div class="form-group">
                  <label for="EstadoPremio">Estado de la publicacion</label>
                  <select class="form-control" id="EstadoPremio" name="EstadoPremio" placeholder="">
                    <option value="pendiente" <?php if($premio['PREMIO_ESTADO']=='pendiente'){ echo 'selected';} ?>>Pendiente</option>
                    <option value="entregado" <?php if($premio['PREMIO_ESTADO']=='entregado'){ echo 'selected';} ?>>Entregado</option>
                  </select>
                </div>
              </div>
              <div class="col">
                 <hr>
                 <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Guardar Premio</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
