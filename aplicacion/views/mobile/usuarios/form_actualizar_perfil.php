<!-- empieza panel usuario resposivo -->

<div class="fila-gris">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('mobile/usuarios/widgets/menu_control_usuario'); ?>
      </div>
    </div>
  </div>
</div>

<div class="container py-3 mb-3">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header">
          <div class="titulo">
            <h1 class="h5 pt-2 text-center"><span class="fa fa-user-tie"></span> Actualizar<br> <?php echo $perfil['PERFIL_NOMBRE']; ?></h1>
          </div>
        </div>
        <div class="card-body">
          <form class="" action="http://localhost/abanico-master/usuario/perfil_servicios/crear" method="post" enctype="multipart/form-data">
             <input type="hidden" name="IdUsuario" value="">
             <img src="http://localhost/abanico-master/contenido/img/tiendas/completo/default.jpg" alt="" style="width:150px" class="img-fluid d-block mx-auto mb-3 img-thumbnail rounded-circle">
             <div class="custom-file file-sm mb-3">
               <input type="file" class="custom-file-input" id="ImagenPerfil" name="ImagenPerfil" placeholder="" value="">
               <label class="custom-file-label" for="ImagenPerfil">Fotografía Personal</label>
             </div>
             <div class="form-group">
               <label for="NombrePerfil">Nombre público</label>
               <input type="text" class="form-control form-control-sm" id="NombrePerfil" name="NombrePerfil" placeholder="" autocomplete="nope" value="fernando gutierrez">
             </div>

             <hr>

             <h6 class="mb-3"><span class="fa fa-file-invoice"></span> Datos Fiscales (Opcionales)</h6>
             <div class="form-group">
               <label for="RazonSocialPerfil">Razón social</label>
               <input type="text" class="form-control form-control-sm" id="RazonSocialPerfil" name="RazonSocialPerfil" placeholder="" value="">
             </div>
             <div class="form-group">
               <label for="RfcPerfil">R.F.C.</label>
               <input type="text" class="form-control form-control-sm" id="RfcPerfil" name="RfcPerfil" placeholder="" value="">
             </div>

             <hr>

             <h6 class="mb-3"><span class="fa fa-file-invoice"></span> Datos de Contacto (Obligatorios)</h6>
             <div class="form-group">
               <label for="TelefonoPerfil">Teléfono</label>
               <input type="text" class="form-control form-control-sm" id="TelefonoPerfil" name="TelefonoPerfil" placeholder="" value="">
             </div>

             <hr>

             <h6 class="mb-3"> <span class="fa fa-building"></span> Dirección</h6>
             <input type="hidden" name="TipoDireccion" value="perfil">
             <input type="hidden" name="AliasDireccion" value="Direccion Perfil">
             <input type="hidden" name="ReferenciasDireccion" value="-">

             <div class="form-group">
               <label for="PaisDireccion">País </label>
               <select class="form-control form-control-sm" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="" required="">
                 <option value="">Selecciona un País</option>
               <option value="México" data-id="1">México</option><option value="Estados Unidos" data-id="2">Estados Unidos</option></select>
             </div>
             <div class="form-group">
               <label for="EstadoDireccion">Estado </label>
               <select class="form-control form-control-sm" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="" required="">
                 <option value="">Selecciona tu estado</option>
               </select>
             </div>
             <div class="form-group">
               <label for="MunicipioDireccion">Municipio / Alcaldía</label>
               <select class="form-control form-control-sm" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="" required="">
                 <option value="">Selecciona tu Municipio / Alcaldía</option>
               </select>
             </div>
             <div class="form-group">
               <label for="CiudadDireccion">Ciudad (Opcional)</label>
               <input type="text" name="CiudadDireccion" class="form-control form-control-sm" value="">
             </div>
             <div class="form-group">
               <label for="CodigoPostalDireccion">Código Postal</label>
               <input type="text" name="CodigoPostalDireccion" class="form-control form-control-sm" required="" value="">
             </div>
             <div class="form-group">
               <label for="BarrioDireccion">Barrio / Colonia</label>
               <input type="text" name="BarrioDireccion" class="form-control form-control-sm" required="" value="">
             </div>
             <div class="form-group">
               <label for="CalleDireccion">Calle y Número</label>
               <textarea name="CalleDireccion" class="form-control form-control-sm" rows="3" required=""></textarea>
             </div>
             <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required="">
                <label class="custom-control-label" for="TerminosyCondiciones">Acepto los términos y condiciones de Servicio</label>
             </div>
             <hr>
             <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-save"></i> Actualizar</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

<hr><hr><hr>

<!-- termina panel usuario resposivo -->

<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
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
              <form class="" action="<?php echo base_url('usuario/perfil_servicios/actualizar');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="Identificador" value="<?php echo $perfil['ID_PERFIL']; ?>">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
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
                       <label for="NombrePerfil">Nombre público</label>
                       <input type="text" class="form-control" id="NombrePerfil" name="NombrePerfil" placeholder="" value="<?php echo $perfil['PERFIL_NOMBRE']; ?>">
                     </div>
                     <hr>
                     <h5 class="mb-3"><span class="fa fa-file-invoice"></span> Datos Fiscales (Opcionales)</h5>
                     <div class="form-group">
                       <label for="RazonSocialPerfil">Razón social</label>
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
  </div>
</div>
