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
          <form class="" action="<?php echo base_url('admin/sliders/crear');?>" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-9">
                <div class="form-group">
                  <label for="NombreSlider">Nombre </label>
                  <input type="text" name="NombreSlider" class="form-control" value="<?=!form_error('NombreSlider')?set_value('NombreSlider'):''?>">
                </div>
                <div class="form-group">
                  <label for="AnchoSlider">Ancho </label>
                  <input type="text" name="AnchoSlider" class="form-control" value="<?=!form_error('AnchoSlider')?set_value('AnchoSlider'):''?>">
                </div>
                <div class="form-group">
                  <label for="AltoSlider">Alto </label>
                  <input type="text" name="AltoSlider" class="form-control" value="<?=!form_error('AltoSlider')?set_value('AltoSlider'):''?>">
                </div>
                <div class="form-group">
                  <label for="AnchoMovilSlider">Ancho Movil </label>
                  <input type="text" name="AnchoMovilSlider" class="form-control" value="<?=!form_error('AnchoMovilSlider')?set_value('AnchoMovilSlider'):''?>">
                </div>
                <div class="form-group">
                  <label for="AltoMovilSlider">Alto Movil </label>
                  <input type="text" name="AltoMovilSlider" class="form-control" value="<?=!form_error('AltoMovilSlider')?set_value('AltoMovilSlider'):''?>">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="LenguajeSlider">Lenguajes</label>
                  <select class="form-control" id="LenguajeSlider" name="LenguajeSlider" placeholder="">
                    <?php foreach ($lenguajes as $lenguaje) { ?>
                      <option value="<?php echo $lenguaje->LENGUAJE_ISO; ?>" ><?php echo $lenguaje->LENGUAJE_NOMBRE; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <hr>
                  <div class="form-group">
                    <label for="EstadoSlider">Estado de la publicacion</label>
                    <select class="form-control" id="EstadoSlider" name="EstadoSlider" placeholder="">
                      <option value="activo" >Publicado</option>
                      <option value="inactivo">Borrador</option>
                    </select>
                  </div>
              </div>
              <div class="col">
                 <hr>
                 <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Guardar Publicación</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
