
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
    <div class="col mt-4">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-users"></span> Actualizar <?php echo $usuario['USUARIO_NOMBRE']; ?></h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
            <form class="" action="<?php echo base_url('admin/usuarios/actualizar'); ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="Identificador" value="<?php echo $usuario['ID_USUARIO']; ?>">
              <input type="hidden" name="TipoUsuario" value="<?php echo $usuario['USUARIO_TIPO']; ?>">
              <div class="row">
                <div class="col">
                  <h3 class="h5">Datos Requeridos</h3>
                   <div class="form-group">
                     <label for="NombreUsuario">Nombre</label>
                     <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" value="<?php if(empty(form_error('NombreUsuario'))){ echo $usuario['USUARIO_NOMBRE']; } else { set_value('NombreUsuario'); } ?>">
                   </div>
                   <div class="form-group">
                     <label for="ApellidosUsuario">Apellidos</label>
                     <input type="text" class="form-control" id="ApellidosUsuario" name="ApellidosUsuario" placeholder="" value="<?php if(empty(form_error('ApellidosUsuario'))){ echo $usuario['USUARIO_APELLIDOS']; } else { set_value('ApellidosUsuario'); } ?>">
                   </div>
                   <div class="form-group">
                     <label for="CorreoUsuario">Correo electrónico</label>
                     <input type="email" class="form-control" id="CorreoUsuario" name="CorreoUsuario" placeholder="" value="<?php if(empty(form_error('CorreoUsuario'))){ echo $usuario['USUARIO_CORREO']; } else { set_value('CorreoUsuario'); } ?>">
                     <small class="form-text text-muted">Este correo es el que usarás para iniciar sesión. y nuestro medio principal para contactarte</small>
                   </div>
                </div>
                <div class="col">
                  <div class="border p-2">
                    <h4 class="h5">Datos Opcionales</h4>
										<input type="hidden" name="ImagenUsuarioAnterior" value="<?php echo $usuario['USUARIO_IMAGEN']; ?>">
										<div class="form-group">
											<label for="ImagenUsuario">Añadir Foto</label>
											<input type="file" class="form-control" id="ImagenUsuario" name="ImagenUsuario">
										</div>
                    <div class="form-group">
                      <label for="TelefonoUsuario">Teléfono</label>
                      <input type="text" class="form-control" id="TelefonoUsuario" name="TelefonoUsuario" placeholder="" value="<?php if(empty(form_error('TelefonoUsuario'))){ echo $usuario['USUARIO_TELEFONO']; } else { set_value('TelefonoUsuario'); } ?> ">
                      <small class="form-text text-muted">Ayúdanos a contactarte rápidamente proporcionando un número de teléfono fijo o celular</small>
                    </div>
                    <div class="form-group">
                      <label for="FechaNacimientoUsuario">Fecha Nacimiento</label>
                      <input type="date" class="form-control" id="FechaNacimientoUsuario" name="FechaNacimientoUsuario" placeholder="" value="<?php echo $usuario['USUARIO_FECHA_NACIMIENTO']; ?>">
                    </div>
                    <hr>
                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                      <input type="checkbox" class="custom-control-input" id="ListaDeCorreoUsuario" name="ListaDeCorreoUsuario" <?php if($usuario['USUARIO_LISTA_DE_CORREO']=='si'){ echo 'checked'; } ?>>
                      <label class="custom-control-label" for="ListaDeCorreoUsuario">Deseo Recibir ofertas por correo electrónico</label>
                    </div>
                  </div>
                </div>
              </div>
            <hr>
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
          </form>
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
