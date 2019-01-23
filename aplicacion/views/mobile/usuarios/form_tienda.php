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
          <h5> <i class="fa fa-store"></i> Crea tu tienda</h5>
        </div>
        <div class="card-body">
          <h5>Hola, Bienvenido al creador de tiendas.</h5>
          <p>Debes registrar una tienda para tener la facultad de:</p>
          <ul class="pl-3">
            <li>Crear Productos y ofrecerlos a la venta</li>
            <li>Recibir comentarios</li>
            <li>Recibir calificaciones en tus productos</li>
          </ul>
          <form class="" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="IdUsuario" value="">
            <img class="img-fluid img-thumbnail rounded-circle d-block mx-auto mb-3" style="width:150px" src="http://localhost/abanico-master/contenido/img/tiendas/completo/default.jpg" alt="" >
            <div class="custom-file file-sm mb-3">
              <input type="file" class="custom-file-input" id="ImagenTienda" name="ImagenTienda" placeholder="" value="">
              <label class="custom-file-label" for="ImagenTienda">Logotipo de tu Tienda</label>
            </div>
            <!-- <h6><span class="fa fa-store"></span> Datos de tu tienda</h5> -->
             <div class="form-group">
               <label for="NombreTienda">Nombre Público</label>
               <input type="text" class="form-control form-control-sm" id="NombreTienda" name="NombreTienda" placeholder="" value="">
             </div>
             <hr>
             <h6><span class="fa fa-file-invoice"></span> Datos Fiscales</h6>
             <div class="form-group">
               <label for="RazonSocialTienda">Razón Social</label>
               <input type="text" class="form-control form-control-sm" id="RazonSocialTienda" name="RazonSocialTienda" required="" placeholder="" value="">
             </div>
             <div class="form-group">
               <label for="RfcTienda">R.F.C.</label>
               <input type="text" class="form-control form-control-sm" id="RfcTienda" name="RfcTienda" required="" placeholder="" value="">
             </div>
             <div class="form-group">
               <label for="TelefonoTienda">Teléfono</label>
               <input type="text" class="form-control form-control-sm" id="TelefonoTienda" name="TelefonoTienda" required="" placeholder="" value="">
             </div>
             <h6> <span class="fa fa-building"></span> Dirección Fiscal</h6>
             <input type="hidden" name="TipoDireccion" value="fiscal">
             <input type="hidden" name="AliasDireccion" value="Direccion Tienda">
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
               <label for="CiudadDireccion">Ciudad <small>(Opcional)</small> </label>
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
             <hr>
             <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="" name="" required="">
                <label class="custom-control-label" for="TerminosyCondiciones">Acepto los Términos y Condiciones de Vendedores</label>
              </div>
             <hr>
             <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-save"></i> Registrar Tienda</button>
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
            <div class="card-header">
              <h5> <i class="fa fa-store"></i> Crea tu tienda</h5>
            </div>
            <div class="card-body">
              <div class="card card-info mb-3">
                <div class="card-body">
                  <h5>Hola, Bienvenido al creador de tiendas.</h5>
                  <p>Debes registrar una tienda para tener la facultad de:</p>
                  <ul>
                    <li>Crear Productos y ofrecerlos a la venta</li>
                    <li>Recibir comentarios</li>
                    <li>Recibir calificaciones en tus productos</li>
                  </ul>
                </div>
              </div>
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <form class="" action="<?php echo base_url('usuario/tienda/crear');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
                <div class="row">
                  <div class="col-12 col-sm-3">
                    <img src="<?php echo base_url('contenido/img/tiendas/completo/default.jpg') ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                    <hr>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="ImagenTienda" name="ImagenTienda" placeholder="" value="">
                      <label class="custom-file-label" for="ImagenTienda">Logotipo de tu Tienda</label>
                    </div>
                  </div>
                  <div class="col-12 col-sm-9">
                    <h5> <span class="fa fa-store"></span> Datos de tu tienda</h5>
                     <div class="form-group">
                       <label for="NombreTienda">Nombre Público</label>
                       <input type="text" class="form-control" id="NombreTienda" name="NombreTienda" placeholder="" value="<?php echo set_value('NombreTienda'); ?>">
                     </div>
                     <hr>
                     <h6><span class="fa fa-file-invoice"></span> Datos Fiscales</h6>
                     <div class="form-group">
                       <label for="RazonSocialTienda">Razón Social</label>
                       <input type="text" class="form-control" id="RazonSocialTienda" name="RazonSocialTienda" required placeholder="" value="<?php echo set_value('RazonSocialTienda'); ?>">
                     </div>
                     <div class="form-group">
                       <label for="RfcTienda">R.F.C.</label>
                       <input type="text" class="form-control" id="RfcTienda" name="RfcTienda" required placeholder="" value="<?php echo set_value('RfcTienda'); ?>">
                     </div>
                     <div class="form-group">
                       <label for="TelefonoTienda">Teléfono</label>
                       <input type="text" class="form-control" id="TelefonoTienda" name="TelefonoTienda" required placeholder="" value="<?php echo set_value('TelefonoTienda'); ?>">
                     </div>
                     <h6> <span class="fa fa-building"></span> Dirección Fiscal</h6>
                     <input type="hidden" name="TipoDireccion" value="fiscal">
                     <input type="hidden" name="AliasDireccion" value="Direccion Tienda">
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
                           <label for="CiudadDireccion">Ciudad <small>(Opcional)</small> </label>
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
                        <label class="custom-control-label" for="TerminosyCondiciones">Acepto los Términos y Condiciones de Vendedores</label>
                      </div>
                     <hr>
                     <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Registrar Tienda</button>
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
