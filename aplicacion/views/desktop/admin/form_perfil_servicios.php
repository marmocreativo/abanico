<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-user-tie"></span> Nuevo Perfil</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/perfiles_servicios/crear');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="IdUsuario" value="<?php echo $usuario['ID_USUARIO'] ?>">
            <div class="row">
              <div class="col-12 col-sm-3">
                <img src="<?php echo base_url('contenido/img/tiendas/completo/default.jpg') ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                <hr>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="ImagenPerfil" name="ImagenPerfil" placeholder="" value="">
                  <label class="custom-file-label" for="ImagenPerfil">Fotografía Personal</label>
                </div>
              </div>
              <div class="col-12 col-sm-9">
                 <div class="form-group">
                   <label for="NombrePerfil">Nombre Público</label>
                   <input type="text" class="form-control" id="NombrePerfil" name="NombrePerfil" placeholder="" value="<?php if(form_error('NombrePerfil') != NULL){echo set_value('NombrePerfil');}else{ echo $usuario['USUARIO_NOMBRE'].' '.$usuario['USUARIO_APELLIDOS']; }?>">
                 </div>
                 <hr>
                 <h6 class="mb-3"><span class="fa fa-file-invoice"></span> Datos Fiscales (Opcionales)</h6>
                 <div class="form-group">
                   <label for="RazonSocialPerfil">Razón Social</label>
                   <input type="text" class="form-control" id="RazonSocialPerfil" name="RazonSocialPerfil" placeholder="" value="<?php echo set_value('RazonSocialPerfil'); ?>">
                 </div>
                 <div class="form-group">
                   <label for="RfcPerfil">R.F.C.</label>
                   <input type="text" class="form-control" id="RfcPerfil" name="RfcPerfil" placeholder="" value="<?php echo set_value('RfcPerfil'); ?>">
                 </div>
                 <h6 class="mb-3"><span class="fa fa-file-invoice"></span> Datos de Contacto (Obligatorios)</h6>
                 <div class="form-group">
                   <label for="TelefonoPerfil">Teléfono</label>
                   <input type="text" class="form-control" id="TelefonoPerfil" name="TelefonoPerfil" placeholder="" value="<?php echo set_value('TelefonoPerfil'); ?>">
                 </div>
                 <h6 class="mb-3"> <span class="fa fa-building"></span> Dirección</h6>
                 <input type="hidden" name="TipoDireccion" value="perfil">
                 <input type="hidden" name="AliasDireccion" value="Direccion Perfil">
                  <input type="hidden" name="ReferenciasDireccion" value="-">
                 <div class="row">
                   <div class="col">
                     <div class="form-group">
                       <label for="PaisDireccion">País </label>
                       <select class="form-control" name="PaisDireccion" id="PaisDireccion" required>
                         <option value="">Selecciona un País</option>
                       </select>
                     </div>
                   </div>
                   <div class="col">
                     <div class="form-group">
                       <label for="EstadoDireccion">Estado </label>
                       <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" required>
                         <option value="">Selecciona tu estado</option>
                       </select>
                     </div>
                   </div>
                   <div class="col">
                     <div class="form-group">
                       <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                       <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" required>
                         <option value="">Selecciona tu Municipio / Alcaldía</option>
                       </select>
                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col">
                     <div class="form-group">
                       <label for="CiudadDireccion">Ciudad (Opcional)</label>
                       <input type="text" name="CiudadDireccion" class="form-control">
                     </div>
                   </div>
                   <div class="col">
                     <div class="form-group">
                       <label for="CodigoPostalDireccion">Código Postal</label>
                       <input type="text" name="CodigoPostalDireccion" class="form-control" required>
                     </div>
                   </div>
                 </div>
                 <div class="form-group">
                   <label for="BarrioDireccion">Barrio / Colonia</label>
                   <input type="text" name="BarrioDireccion" class="form-control" required>
                 </div>
                 <div class="form-group">
                   <label for="CalleDireccion">Calle y Número</label>
                   <textarea name="CalleDireccion" class="form-control" rows="3" required></textarea>
                 </div>
                 <hr>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                    <label class="custom-control-label" for="TerminosyCondiciones">Acepto los Términos y Condiciones de Servicio</label>
                  </div>
                 <hr>
                 <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Registrar Perfil</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
