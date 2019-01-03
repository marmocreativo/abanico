<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-user-tie"></span> Actualizar <?php echo $perfil['PERFIL_NOMBRE']; ?></h1>
          </div>
        </div>
        <div class="card-body">
          <?php retro_alimentacion(); ?>
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/perfiles_servicios/actualizar');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Identificador" value="<?php echo $perfil['ID_PERFIL']; ?>">
            <input type="hidden" name="IdUsuario" value="<?php echo $usuario['ID_USUARIO']; ?>">
            <input type="hidden" name="ImagenAnteriorPerfil" value="<?php echo $perfil['PERFIL_IMAGEN']; ?>">
            <div class="row">
              <div class="col-12 col-sm-3">
                <img src="<?php echo base_url('contenido/img/perfiles/completo/'.$perfil['PERFIL_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                <hr>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="ImagenPerfil" name="ImagenPerfil" placeholder="" value="">
                  <label class="custom-file-label" for="ImagenPerfil">Logotipo de tu Perfil</label>
                </div>
              </div>
              <div class="col-12 col-sm-9">
                 <div class="form-group">
                   <label for="NombrePerfil">Nombre Público</label>
                   <input type="text" class="form-control" id="NombrePerfil" name="NombrePerfil" placeholder="" value="<?php echo $perfil['PERFIL_NOMBRE']; ?>">
                 </div>
                 <hr>
                 <h5 class="mb-3"><span class="fa fa-file-invoice"></span> Datos Fiscales (Opcionales)</h5>
                 <div class="form-group">
                   <label for="RazonSocialPerfil">Razón Social</label>
                   <input type="text" class="form-control" id="RazonSocialPerfil" name="RazonSocialPerfil" placeholder="" value="<?php echo $perfil['PERFIL_RAZON_SOCIAL']; ?>">
                 </div>
                 <div class="form-group">
                   <label for="RfcPerfil">R.F.C.</label>
                   <input type="text" class="form-control" id="RfcPerfil" name="RfcPerfil" placeholder="" value="<?php echo $perfil['PERFIL_RFC']; ?>">
                 </div>
                 <h6 class="mb-3"><span class="fa fa-file-invoice"></span> Datos de Contacto (Obligatorios)</h6>
                 <div class="form-group">
                   <label for="TelefonoPerfil">Teléfono</label>
                   <input type="text" class="form-control" id="TelefonoPerfil" name="TelefonoPerfil" placeholder="" value="<?php echo $perfil['PERFIL_TELEFONO']; ?>">
                 </div>
                 <hr>
                 <h6 class="mb-3"> <span class="fa fa-building"></span> Dirección</h6>
                 <input type="hidden" name="IdentificadorDireccion" value="<?php echo $direccion_perfil_servicios['ID_DIRECCION'] ?>">
                 <input type="hidden" name="TipoDireccion" value="perfil">
                 <input type="hidden" name="AliasDireccion" value="Direccion Perfil">
                  <input type="hidden" name="ReferenciasDireccion" value="-">
                 <div class="row">
                   <div class="col">
                     <div class="form-group">
                       <label for="PaisDireccion">País </label>
                       <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo $direccion_perfil_servicios['DIRECCION_PAIS']; ?>" required>
                         <option value="">Selecciona un País</option>
                       </select>
                     </div>
                   </div>
                   <div class="col">
                     <div class="form-group">
                       <label for="EstadoDireccion">Estado </label>
                       <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo $direccion_perfil_servicios['DIRECCION_ESTADO']; ?>" required>
                         <option value="">Selecciona tu estado</option>
                       </select>
                     </div>
                   </div>
                   <div class="col">
                     <div class="form-group">
                       <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                       <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo $direccion_perfil_servicios['DIRECCION_MUNICIPIO']; ?>" required>
                         <option value="">Selecciona tu Municipio / Alcaldía</option>
                       </select>
                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col">
                     <div class="form-group">
                       <label for="CiudadPerfil">Ciudad (Opcional)</label>
                       <input type="text" name="CiudadDireccion" class="form-control" value="<?php echo $direccion_perfil_servicios['DIRECCION_CIUDAD']; ?>">
                     </div>
                   </div>
                     <div class="col">
                       <div class="form-group">
                         <label for="CodigoPostalDireccion">Código Postal</label>
                         <input type="text" name="CodigoPostalDireccion" class="form-control" value="<?php echo $direccion_perfil_servicios['DIRECCION_CODIGO_POSTAL']; ?>">
                       </div>
                     </div>
                 </div>
                 <div class="form-group">
                   <label for="BarrioDireccion">Barrio / Colonia</label>
                   <input type="text" name="BarrioDireccion" class="form-control" value="<?php echo $direccion_perfil_servicios['DIRECCION_BARRIO']; ?>">
                 </div>
                 <div class="form-group">
                   <label for="CalleDireccion">Calle y Número</label>
                   <textarea name="CalleDireccion" class="form-control" rows="3"><?php echo $direccion_perfil_servicios['DIRECCION_CALLE_Y_NUMERO']; ?></textarea>
                 </div>
                 <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Actualizar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>