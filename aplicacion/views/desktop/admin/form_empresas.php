
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
			<?php retro_alimentacion(); ?>
			<div class="row">
	      <div class="col text-center py-4">
	        <h1>Nueva empresa</h1>

	      </div>
	    </div>
			<div class="row">
	      <div class="col-12 col-md-4 mb-3">
	        <form class="" action="<?php echo base_url('admin/pedidos/crear_empresa'); ?>" method="post">
	          <div class="form-group">
	            <label for="NombreEmpresa">Nombre de la empresa</label>
	            <input type="text" class="form-control" name="NombreEmpresa" value="" required>
	          </div>
	          <div class="form-group">
	            <label for="NombreContacto">Nombre <small> Persona de contacto </small></label>
	            <input type="text" class="form-control" name="NombreContacto" value="">
	          </div>
	          <div class="form-group">
	            <label for="ApellidosContacto">Apellidos <small> Persona de contacto </small></label>
	            <input type="text" class="form-control" name="ApellidosContacto" value="">
	          </div>
	          <div class="form-group">
	            <label for="CorreoContacto">Correo <small> Persona de contacto </small></label>
	            <input type="text" class="form-control" name="CorreoContacto" value="">
	          </div>
	          <div class="form-group">
	            <label for="TelefonoContacto">Teléfono <small> Persona de contacto </small></label>
	            <input type="text" class="form-control" name="TelefonoContacto" value="">
	          </div>
	          <hr>
	          <div class="form-group">
	            <label for="RazonSocialEmpresa">Razón Social <small>(Para facturación)</small></label>
	            <input type="text" class="form-control" name="RazonSocialEmpresa" value="">
	          </div>
	          <div class="form-group">
	            <label for="RfcEmpresa">RFC <small>(Para facturación)</small></label>
	            <input type="text" class="form-control" name="RfcEmpresa" value="">
	          </div>
	          <div class="form-group">
	            <label for="DireccionEmpresa">Direccion <small>(Para facturación)</small></label>
	            <textarea name="DireccionEmpresa" class="form-control" rows="5"></textarea>
	          </div>
	          <button type="submit" class="btn btn-success btn-block"> <i class="fa fa-save"></i> Guardar</button>
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
