
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
            <h1 class="h5"> <span class="fa fa-money-bill"></span> Divisas</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/divisas/actualizar'); ?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $divisa['ID_DIVISA']; ?>">
            <div class="form-group">
              <label for="IsoDivisa">Código ISO</label>
              <input type="text" class="form-control" name="IsoDivisa" id="IsoDivisa" placeholder="" required value="<?php if(empty(form_error('IsoDivisa'))){ echo $divisa['DIVISA_ISO']; } else { set_value('IsoDivisa'); } ?>">
              <small class="text-info"> <span class="fa fa-info-circle"></span> Código internacional de la moneda 3 letras Ej. MXN</small>
            </div>
            <div class="form-group">
              <label for="NombreDivisa">Nombre</label>
              <input type="text" class="form-control" name="NombreDivisa" id="NombreDivisa" placeholder="" required value="<?php if(empty(form_error('NombreDivisa'))){ echo $divisa['DIVISA_NOMBRE']; } else { set_value('NombreDivisa'); } ?>">
            </div>
            <div class="form-group">
              <label for="SignoDivisa">Signo</label>
              <input type="text" class="form-control" name="SignoDivisa" id="SignoDivisa" placeholder="" required value="<?php if(empty(form_error('SignoDivisa'))){ echo $divisa['DIVISA_SIGNO']; } else { set_value('SignoDivisa'); } ?>">
              <small class="text-info"> <span class="fa fa-info-circle"></span> Signo de la moneda</small>
            </div>
            <div class="form-group">
              <label for="ConversionDivisa">Conversión</label>
              <input type="number" step="0.001" min="0" class="form-control" name="ConversionDivisa" id="ConversionDivisa" placeholder="0.0000" required value="<?php if(empty(form_error('ConversionDivisa'))){ echo $divisa['DIVISA_CONVERSION']; } else { set_value('ConversionDivisa'); } ?>">
              <small class="text-info"> <span class="fa fa-info-circle"></span> Permitidos hasta 3 decimales</small>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="EstadoDivisa" id="EstadoDivisa" <?php if($divisa['DIVISA_ESTADO']){ echo "checked"; } ?>>
              <label class="custom-control-label" for="EstadoDivisa">Activar</label>
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
