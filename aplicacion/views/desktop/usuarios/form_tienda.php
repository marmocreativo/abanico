<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 filas">
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
                  <h5>Hola, Bienvenido al creador de perfil de ventas</h5>
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
                    <h5> <span class="fa fa-store"></span> Datos de Vendedor</h5>
                    <div class="form-group">
                      <label for="TipoTienda">Tipo de Vendedor </label>
                      <select class="form-control" name="TipoTienda">
                        <option value="tienda">Tienda (Vendes una gran cantidad de Productos)</option>
                        <option value="vendedor">Vendedor (Solo ofrecerás un par de productos a la ves) </option>
                      </select>
                    </div>
                     <div class="form-group">
                       <label for="NombreTienda">Nombre público <small>El nombre que verán los compradores</small> </label>
                       <input type="text" class="form-control" id="NombreTienda" name="NombreTienda" placeholder="" value="<?php echo set_value('NombreTienda'); ?>">
                     </div>
                     <hr>
                     <h6><span class="fa fa-file-invoice"></span> Datos Fiscales (En caso de requerir Factura)</h6>
                     <div class="form-group">
                       <label for="RazonSocialTienda">Razón social</label>
                       <input type="text" class="form-control" id="RazonSocialTienda" name="RazonSocialTienda" placeholder="" value="<?php echo set_value('RazonSocialTienda'); ?>">
                     </div>
                     <div class="form-group">
                       <label for="RfcTienda">R.F.C.</label>
                       <input type="text" class="form-control" id="RfcTienda" name="RfcTienda" placeholder="" value="<?php echo set_value('RfcTienda'); ?>">
                     </div>
                     <div class="form-group">
                       <label for="TelefonoTienda">Teléfono</label>
                       <input type="text" class="form-control" id="TelefonoTienda" name="TelefonoTienda" required placeholder="" value="<?php echo set_value('TelefonoTienda'); ?>">
                     </div>
                     <h6> <span class="fa fa-building"></span> Dirección de Contacto</h6>
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
                        <label class="custom-control-label" for="TerminosyCondiciones">Acepto los términos y condiciones de Vendedores</label>
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
