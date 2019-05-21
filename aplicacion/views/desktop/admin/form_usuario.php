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
              <h1 class="h5"> <span class="fa fa-user"></span> Nuevo Usuario</h1>
            </div>
          </div>
          <div class="card-body">

            <?php if(isset($_GET['mensaje'])){
              switch($_GET['mensaje']){
                case 'actualizacion_correcta':
                  $alerta = 'alert-success';
                  $mensaje = 'Tu información se actualizó correctamente';
                break;
              }
              ?>

              <div class="alert <?php echo  $alerta; ?>">
                <p><?php echo  $mensaje; ?></p>
              </div>
            <?php }// Termina la condicionante ?>

            <?php if(!empty(validation_errors())){ ?>
              <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
              </div>
              <hr>
            <?php } ?>
              <form class="" action="<?php echo base_url('admin/usuarios/crear'); ?>" method="post">
                <input type="hidden" name="TipoUsuario" value="<?php echo $tipo_usuario; ?>">
                <div class="row">
                  <div class="col">
                    <h3 class="h5">Datos Requeridos</h3>
                     <div class="form-group">
                       <label for="NombreUsuario">Nombre</label>
                       <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" value="<?=!form_error('NombreUsuario')?set_value('NombreUsuario'):''?>">
                     </div>
                     <div class="form-group">
                       <label for="ApellidosUsuario">Apellidos</label>
                       <input type="text" class="form-control" id="ApellidosUsuario" name="ApellidosUsuario" placeholder="" value="<?=!form_error('ApellidosUsuario')?set_value('ApellidosUsuario'):''?>">
                     </div>
                     <div class="form-group">
                       <label for="CorreoUsuario">Correo electrónico</label>
                       <input type="email" class="form-control" id="CorreoUsuario" name="CorreoUsuario" placeholder="" value="<?=!form_error('CorreoUsuario')?set_value('CorreoUsuario'):''?>">
                       <small class="form-text text-muted">Este correo es el que usarás para iniciar sesión. y nuestro medio principal para contactarte</small>
                     </div>
                     <div class="form-group">
                       <label for="PassUsuario">Contraseña</label>
                       <input type="password" class="form-control" id="PassUsuario" name="PassUsuario" placeholder="">
                     </div>
                     <div class="form-group">
                       <label for="PassUsuario">Confirmar contraseña</label>
                       <input type="password" class="form-control" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="">
                     </div>
                  </div>
                  <div class="col">
                    <div class="border p-2 mb-4">
                      <h4 class="h5">Estado del Usuario</h4>
                      <div class="form-group">
                        <label for="EstadoUsuario">Estado Usuario</label>
                        <select class="form-control" id="EstadoUsuario" name="EstadoUsuario" placeholder="">
                          <option value="activo" <?php if(set_value('EstadoUsuario')=='activo'){ echo 'selected'; } ?> >Activo</option>
                          <option value="pendiente" <?php if(set_value('EstadoUsuario')=='pendiente'){ echo 'selected'; } ?> >Pendiente de verificación</option>
                          <option value="inactivo" <?php if(set_value('EstadoUsuario')=='inactivo'){ echo 'selected'; } ?> >Inactivo</option>
                        </select>
                      </div>
                    </div>
                    <div class="border p-2">
                      <h4 class="h5">Datos Opcionales</h4>
                      <div class="form-group">
                        <label for="TelefonoUsuario">Teléfono</label>
                        <input type="text" class="form-control" id="TelefonoUsuario" name="TelefonoUsuario" placeholder="" value="<?=!form_error('TelefonoUsuario')?set_value('TelefonoUsuario'):''?>">
                      </div>
                      <div class="form-group">
                        <label for="FechaNacimientoUsuario">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="FechaNacimientoUsuario" name="FechaNacimientoUsuario" placeholder="" value="<?=!form_error('FechaNacimientoUsuario')?set_value('FechaNacimientoUsuario'):''?>">

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
