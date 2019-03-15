  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5> <i class="fa fa-file"></i> Actualizar Slider</h5>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/sliders/actualizar');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Identificador" value="<?php echo $slider['ID_SLIDER']; ?>">
            <div class="row">
              <div class="col-9">
                <div class="form-group">
                  <label for="NombreSlider">Nombre </label>
                  <input type="text" name="NombreSlider" class="form-control" value="<?php echo $slider['SLIDER_NOMBRE']; ?>">
                </div>
                <div class="form-group">
                  <label for="AnchoSlider">Ancho </label>
                  <input type="text" name="AnchoSlider" class="form-control" value="<?php echo $slider['SLIDER_ANCHO']; ?>">
                </div>
                <div class="form-group">
                  <label for="AltoSlider">Alto </label>
                  <input type="text" name="AltoSlider" class="form-control" value="<?php echo $slider['SLIDER_ALTO']; ?>">
                </div>
                <div class="form-group">
                  <label for="AnchoMovilSlider">Ancho Movil </label>
                  <input type="text" name="AnchoMovilSlider" class="form-control" value="<?php echo $slider['SLIDER_ANCHO_MOVIL']; ?>">
                </div>
                <div class="form-group">
                  <label for="AltoMovilSlider">Alto Movil </label>
                  <input type="text" name="AltoMovilSlider" class="form-control" value="<?php echo $slider['SLIDER_ALTO_MOVIL']; ?>">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="LenguajeSlider">Lenguajes</label>
                  <select class="form-control" id="LenguajeSlider" name="LenguajeSlider" placeholder="">
                    <?php foreach ($lenguajes as $lenguaje) { ?>
                      <option value="<?php echo $lenguaje->LENGUAJE_ISO; ?>" <?php if($slider['SLIDER_LENGUAJE']==$lenguaje->LENGUAJE_ISO){ echo 'selected'; } ?>><?php echo $lenguaje->LENGUAJE_NOMBRE; ?></option>
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
