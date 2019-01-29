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
            <h1 class="h5 pt-2"><span class="fa fa-user-tie"></span> Nuevo Perfil</h1>
          </div>
        </div>
        <div class="card-body">
          <h5>Hola, Bienvenido al creador de perfil</h5>
          <p>Debes registrar un Perfil de servicios para:</p>
          <ul>
            <li>Ofrecer Servicios</li>
            <li>Recibir Mensajes y Ofertas de trabajo</li>
          </ul>
          <form class="" action="http://localhost/abanico-master/usuario/perfil_servicios/crear" method="post" enctype="multipart/form-data">
             <input type="hidden" name="IdUsuario" value="">
             <img src="http://localhost/abanico-master/contenido/img/tiendas/completo/default.jpg" alt="" style="width:150px" class="img-fluid d-block mx-auto mb-3 img-thumbnail rounded-circle">
             <div class="custom-file file-sm mb-3">
               <input type="file" class="custom-file-input" id="ImagenPerfil" name="ImagenPerfil" placeholder="" value="">
               <label class="custom-file-label" for="ImagenPerfil">Fotografía Personal</label>
             </div>
             <div class="form-group">
               <label for="NombrePerfil">Nombre Público</label>
               <input type="text" class="form-control form-control-sm" id="NombrePerfil" name="NombrePerfil" placeholder="" autocomplete="nope" value="fernando gutierrez">
             </div>

             <hr>

             <h6 class="mb-3"><span class="fa fa-file-invoice"></span> Datos Fiscales (Opcionales)</h6>
             <div class="form-group">
               <label for="RazonSocialPerfil">Razón Social</label>
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
                <label class="custom-control-label" for="TerminosyCondiciones">Acepto los Términos y Condiciones de Servicio</label>
             </div>
             <hr>
             <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-save"></i> Registrar Perfil</button>
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
          <?php retro_alimentacion(); ?>
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="titulo">
                <h1 class="h5"> <span class="fa fa-user-tie"></span> Nuevo Perfil</h1>
              </div>
            </div>
            <div class="card-body">
              <div class="card card-info mb-3">
                <div class="card-body">
                  <h5>Hola, Bienvenido al creador de perfil</h5>
                  <p>Debes registrar un Perfil de servicios para:</p>
                  <ul>
                    <li>Ofrecer Servicios</li>
                    <li>Recibir Mensajes y Ofertas de trabajo</li>
                  </ul>
                </div>
              </div>
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <form class="" action="<?php echo base_url('usuario/perfil_servicios/crear');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
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
                       <input type="text" class="form-control" id="NombrePerfil" name="NombrePerfil" placeholder="" autocomplete="nope" value="<?php if(form_error('NombrePerfil') != NULL){echo set_value('NombrePerfil');}else{ echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; }?>">
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
                           <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo set_value('PaisDireccion'); ?>" required>
                             <option value="">Selecciona un País</option>
                           </select>
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="EstadoDireccion">Estado </label>
                           <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo set_value('EstadoDireccion'); ?>" required>
                             <option value="">Selecciona tu estado</option>
                           </select>
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                           <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo set_value('MunicipioDireccion'); ?>" required>
                             <option value="">Selecciona tu Municipio / Alcaldía</option>
                           </select>
                         </div>
                       </div>
                     </div>
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="CiudadDireccion">Ciudad (Opcional)</label>
                           <input type="text" name="CiudadDireccion" class="form-control" value="<?php echo set_value('CiudadDireccion'); ?>">
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="CodigoPostalDireccion">Código Postal</label>
                           <input type="text" name="CodigoPostalDireccion" class="form-control" required value="<?php echo set_value('CodigoPostalDireccion'); ?>">
                         </div>
                       </div>
                     </div>
                     <div class="form-group">
                       <label for="BarrioDireccion">Barrio / Colonia</label>
                       <input type="text" name="BarrioDireccion" class="form-control" required value="<?php echo set_value('BarrioDireccion'); ?>">
                     </div>
                     <div class="form-group">
                       <label for="CalleDireccion">Calle y Número</label>
                       <textarea name="CalleDireccion" class="form-control" rows="3" required><?php echo set_value('CalleDireccion'); ?></textarea>
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
  </div>
</div>
