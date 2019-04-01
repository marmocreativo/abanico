  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5> <i class="fa fa-file"></i> Actualizar Slide</h5>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/slides/actualizar');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Identificador" value="<?php echo $slide['ID_SLIDE'] ?>">
            <input type="hidden" name="IdSlider" value="<?php echo $slider['ID_SLIDER'] ?>">
            <input type="hidden" name="AnchoSlider" value="<?php echo $slider['SLIDER_ANCHO'] ?>">
            <input type="hidden" name="AltoSlider" value="<?php echo $slider['SLIDER_ALTO'] ?>">
            <input type="hidden" name="AnchoMovilSlider" value="<?php echo $slider['SLIDER_ANCHO_MOVIL'] ?>">
            <input type="hidden" name="AltoMovilSlider" value="<?php echo $slider['SLIDER_ALTO_MOVIL'] ?>">
            <input type="hidden" name="ImagenSlideAnterior" value="<?php echo $slide['SLIDE_IMAGEN'] ?>">
            <input type="hidden" name="ImagenSlideMovilAnterior" value="<?php echo $slide['SLIDE_IMAGEN_MOVIL'] ?>">
            <div class="row">
              <div class="col-9">
                <div class="row">
                  <div class="col-8">
                    <img src="<?php echo base_url('contenido/img/slider/'.$slide['SLIDE_IMAGEN']) ?>" id="PrevisualizarImagen" alt="" class="img-fluid img-thumbnail">
                    <hr>
                    <div class="form-group">
                      <label for="ImagenSlide">Imagen vista de escritorio</label>
                      <input type="file" class="form-control" id="ImagenSlide" name="ImagenSlide">
                    </div>
                  </div>
                  <div class="col-4">
                    <img src="<?php echo base_url('contenido/img/slider/'.$slide['SLIDE_IMAGEN_MOVIL']) ?>" id="PrevisualizarImagenMovil" alt="" class="img-fluid img-thumbnail">
                    <hr>
                    <div class="form-group">
                      <label for="ImagenSlideMovil">Imagen vista de celular</label>
                      <input type="file" class="form-control" id="ImagenSlideMovil" name="ImagenSlideMovil">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="TituloSlide">Titulo </label>
                  <input type="text" name="TituloSlide" class="form-control" value="<?php echo $slide['SLIDE_TITULO'] ?>">
                </div>
                <div class="form-group">
                  <label for="SubtituloSlide">Subtitulo </label>
                  <input type="text" name="SubtituloSlide" class="form-control" value="<?php echo $slide['SLIDE_SUBTITULO'] ?>">
                </div>
                <div class="form-group">
                  <label for="BotonSlide">Texto Boton </label>
                  <input type="text" name="BotonSlide" class="form-control" value="<?php echo $slide['SLIDE_BOTON'] ?>">
                </div>
                <div class="form-group">
                  <label for="EnlaceSlide">Enlace </label>
                  <input type="text" name="EnlaceSlide" class="form-control" value="<?php echo $slide['SLIDE_ENLACE'] ?>">
                </div>
              </div>
              <div class="col-3">
                  <div class="form-group">
                    <label for="EstadoSlide">Estado de la publicacion</label>
                    <select class="form-control" id="EstadoSlide" name="EstadoSlide" placeholder="">
                      <option value="activo" <?php if($slide['SLIDE_ESTADO']=='activo'){ echo 'selected'; } ?>>Publicado</option>
                      <option value="inactivo" <?php if($slide['SLIDE_ESTADO']=='inactivo'){ echo 'selected'; } ?>>Borrador</option>
                    </select>
                  </div>
              </div>
              <div class="col">
                 <hr>
                 <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Guardar Slide</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
