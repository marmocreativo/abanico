<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-user"></span> Nueva Tienda</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/tiendas/crear');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="IdUsuario" value="<?php echo $usuario['ID_USUARIO'] ?>">
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
