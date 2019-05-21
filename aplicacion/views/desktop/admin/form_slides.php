
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
		<div class="kt-container kt-body kt-grid kt-grid--ver" id="kt_body">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

				<!-- begin:: Subheader -->
				<div class="kt-subheader   kt-grid__item" id="kt_subheader">
					<div class="kt-subheader__main">
					</div>
					<div class="kt-subheader__toolbar">
					</div>
				</div>

				<!-- end:: Subheader -->

				<!-- begin:: Content -->
				<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

					<!--Begin::Dashboard 8-->

					<!--Begin::Section-->
					<div class="row mb-3">
						<div class="col-xl-12">

							<!--begin:: Widgets/Trends-->
							<div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
								<div class="kt-portlet__body">
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
                <div class="row">
                  <div class="col-8">
                    <img src="<?php echo base_url('contenido/img/slider/default.jpg') ?>" id="PrevisualizarImagen" alt="" class="img-fluid img-thumbnail">
                    <hr>
                    <div class="form-group">
                      <label for="ImagenSlide"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                      <input type="file" class="form-control" id="ImagenSlide" name="ImagenSlide">
                    </div>
                  </div>
                  <div class="col-4">
                    <img src="<?php echo base_url('contenido/img/slider/default_movil.jpg') ?>" id="PrevisualizarImagenMovil" alt="" class="img-fluid img-thumbnail">
                    <hr>
                    <div class="form-group">
                      <label for="ImagenSlideMovil"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                      <input type="file" class="form-control" id="ImagenSlideMovil" name="ImagenSlideMovil">
                    </div>
                  </div>
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
</div>
</div>

<!--end:: Widgets/Trends-->
</div>
</div>
<!--End::Section-->

<!--End::Dashboard 8-->
</div>

<!-- end:: Content -->
</div>
</div>
</div>
