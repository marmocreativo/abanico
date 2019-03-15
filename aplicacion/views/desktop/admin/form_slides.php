  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5> <i class="fa fa-file"></i> Nuevo Slide</h5>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/slides/crear');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="IdSlider" value="<?php echo $slider['ID_SLIDER'] ?>">
            <input type="hidden" name="AnchoSlider" value="<?php echo $slider['SLIDER_ANCHO'] ?>">
            <input type="hidden" name="AltoSlider" value="<?php echo $slider['SLIDER_ALTO'] ?>">
            <input type="hidden" name="AnchoMovilSlider" value="<?php echo $slider['SLIDER_ANCHO_MOVIL'] ?>">
            <input type="hidden" name="AltoMovilSlider" value="<?php echo $slider['SLIDER_ALTO_MOVIL'] ?>">
            <div class="row">
              <div class="col-9">
                <img src="<?php echo base_url('contenido/img/slider/default.jpg') ?>" id="PrevisualizarImagen" alt="" class="img-fluid img-thumbnail">
                <hr>
                <div class="form-group">
                  <label for="ImagenSlide"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                  <input type="file" class="form-control" id="ImagenSlide" name="ImagenSlide">
                </div>
                <img src="<?php echo base_url('contenido/img/slider/default_movil.jpg') ?>" id="PrevisualizarImagenMovil" alt="" class="img-fluid img-thumbnail">
                <hr>
                <div class="form-group">
                  <label for="ImagenSlideMovil"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                  <input type="file" class="form-control" id="ImagenSlideMovil" name="ImagenSlideMovil">
                </div>
                <div class="form-group">
                  <label for="TituloSlide">Titulo </label>
                  <input type="text" name="TituloSlide" class="form-control" value="">
                </div>
                <div class="form-group">
                  <label for="SubtituloSlide">Subtitulo </label>
                  <input type="text" name="SubtituloSlide" class="form-control" value="">
                </div>
                <div class="form-group">
                  <label for="EnlaceSlide">Texto Boton </label>
                  <input type="text" name="EnlaceSlide" class="form-control" value="">
                </div>
                <div class="form-group">
                  <label for="EnlaceSlide">Enlace </label>
                  <input type="text" name="EnlaceSlide" class="form-control" value="#">
                </div>
              </div>
              <div class="col-3">
                  <div class="form-group">
                    <label for="EstadoSlide">Estado de la publicacion</label>
                    <select class="form-control" id="EstadoSlide" name="EstadoSlide" placeholder="">
                      <option value="activo" >Publicado</option>
                      <option value="inactivo">Borrador</option>
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
