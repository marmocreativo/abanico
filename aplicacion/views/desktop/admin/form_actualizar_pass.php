
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
    <div class="col mt-4">
      <div class="card">
        <div class="card-header">
          <h2 class="h5"> <span class="fa fa-id-card"></span> Perfil y datos personales</h2>
        </div>
        <div class="card-body">
          <?php retro_alimentacion(); ?>
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/usuarios/pass');?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $_GET['id_usuario']; ?>">
             <div class="form-group">
               <label for="PassUsuario">Nueva Contraseña</label>
               <input type="password" class="form-control" id="PassUsuario" name="PassUsuario" placeholder="Nueva Contraseña">
             </div>
             <div class="form-group">
               <label for="PassUsuario">Confirmar Nueva Contraseña</label>
               <input type="password" class="form-control" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="Confirmar contraseña">
             </div>
             <hr>
             <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Cambiar Contraseña</button>
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
