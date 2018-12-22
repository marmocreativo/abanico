<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h5> <i class="fa fa-store"></i> Tu tienda</h5>
            </div>
            <div class="card-body">
              <div class="card card-info mb-3">
                <div class="card-body">
                  <h5>Hola, Bienvenido al creador de tiendas, al crear tu tienda tendrás la facultad de.</h5>
                  <ul>
                    <li>Crear Productos y ofrecerlos a la venta</li>
                    <li>Crear Productos Mayoristas y presentar tus datos de contacto</li>
                    <li>Crear Servicios y mostrar tus datos para que te contacten</li>
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
                       <input type="text" class="form-control" id="RazonSocialTienda" name="RazonSocialTienda" placeholder="" value="<?php echo set_value('RazonSocialTienda'); ?>">
                     </div>
                     <div class="form-group">
                       <label for="RfcTienda">R.F.C.</label>
                       <input type="text" class="form-control" id="RfcTienda" name="RfcTienda" placeholder="" value="<?php echo set_value('RfcTienda'); ?>">
                     </div>
                     <div class="form-group">
                       <label for="TelefonoTienda">Teléfono</label>
                       <input type="text" class="form-control" id="TelefonoTienda" name="TelefonoTienda" placeholder="" value="<?php echo set_value('TelefonoTienda'); ?>">
                     </div>
                     <h6> <span class="fa fa-building"></span> Dirección Fiscal</h6>
                     <input type="hidden" name="TipoDireccion" value="fiscal">
                     <input type="hidden" name="AliasDireccion" value="Direccion Tienda">
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
                     </div>
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="CiudadDireccion">Ciudad</label>
                           <input type="text" name="CiudadDireccion" class="form-control" required>
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
