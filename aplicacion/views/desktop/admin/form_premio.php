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
          <form class="" action="<?php echo base_url('admin/premios/crear');?>" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-9">
                <div class="form-group">
                  <label for="TituloPremio">Título </label>
                  <input type="text" name="TituloPremio" class="form-control" value="<?=!form_error('TituloPremio')?set_value('TituloPremio'):''?>">
                </div>
                <div class="form-group">
                  <label for="FechaDisponiblePremio">Fecha Disponibilidad </label>
                  <input type="date" name="FechaDisponiblePremio" class="form-control" value="<?=!form_error('FechaDisponiblePremio')?set_value('FechaDisponiblePremio'):''?>">
                </div>
              </div>
              <div class="col-3">
                <img src="<?php echo base_url('contenido/img/publicaciones/default.jpg') ?>" id="PrevisualizarImagen" alt="" class="img-fluid img-thumbnail rounded">
                <hr>
                <div class="form-group">
                  <label for="ImagenPremio"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                  <input type="file" class="form-control" id="ImagenPremio" name="ImagenPremio">
                </div>
                <div class="form-group">
                  <label for="EstadoPremio">Estado de la publicacion</label>
                  <select class="form-control" id="EstadoPremio" name="EstadoPremio" placeholder="">
                    <option value="pendiente" >Pendiente</option>
                    <option value="entregado">Entregado</option>
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
