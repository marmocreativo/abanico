
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
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-globe-americas"></span> Actualizar <?php echo $lenguaje['LENGUAJE_NOMBRE']; ?></h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/lenguajes/actualizar'); ?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $lenguaje['ID_LENGUAJE']; ?>">
            <div class="form-group">
              <label for="IsoLenguaje">Código ISO</label>
              <input type="text" class="form-control" name="IsoLenguaje" id="IsoLenguaje" placeholder="" required value="<?php if(empty(form_error('IsoLenguaje'))){ echo $lenguaje['LENGUAJE_ISO']; } else { set_value('IsoLenguaje'); } ?>">
              <small class="text-info"> <span class="fa fa-info-circle"></span> Código internacional del pais 2 letras Ej. MXN</small>
            </div>
            <div class="form-group">
              <label for="NombreLenguaje">Nombre</label>
              <input type="text" class="form-control" name="NombreLenguaje" id="NombreLenguaje" placeholder="" required value="<?php if(empty(form_error('NombreLenguaje'))){ echo $lenguaje['LENGUAJE_NOMBRE']; } else { set_value('NombreLenguaje'); } ?>">
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="EstadoLenguaje" id="EstadoLenguaje" <?php if($lenguaje['LENGUAJE_ESTADO']){ echo "checked"; } ?>>
              <label class="custom-control-label" for="EstadoLenguaje">Activar</label>
              <small class="text-info"> <span class="fa fa-info-circle"></span> Si se activa la divisa estará disponible en todo el sistema</small>
            </div>
            <hr>
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
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
