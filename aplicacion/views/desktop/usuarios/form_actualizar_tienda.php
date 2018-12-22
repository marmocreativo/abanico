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
              <h5> <i class="fa fa-store"></i> Actualizar <?php echo $tienda['TIENDA_NOMBRE']; ?></h5>
            </div>
            <div class="card-body">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <form class="" action="<?php echo base_url('usuario/tienda/actualizar');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="Identificador" value="<?php echo $tienda['ID_TIENDA']; ?>">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
                <input type="hidden" name="ImagenAnteriorTienda" value="<?php echo $tienda['TIENDA_IMAGEN']; ?>">
                <div class="row">
                  <div class="col-12 col-sm-3">
                    <img src="<?php echo base_url('contenido/img/tiendas/completo/'.$tienda['TIENDA_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
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
                       <input type="text" class="form-control" id="NombreTienda" name="NombreTienda" placeholder="" value="<?php echo $tienda['TIENDA_NOMBRE']; ?>">
                     </div>
                     <hr>
                     <h5><span class="fa fa-file-invoice"></span> Datos Fiscales</h5>
                     <div class="form-group">
                       <label for="RazonSocialTienda">Razón Social</label>
                       <input type="text" class="form-control" id="RazonSocialTienda" name="RazonSocialTienda" placeholder="" value="<?php echo $tienda['TIENDA_RAZON_SOCIAL']; ?>">
                     </div>
                     <div class="form-group">
                       <label for="RfcTienda">R.F.C.</label>
                       <input type="text" class="form-control" id="RfcTienda" name="RfcTienda" placeholder="" value="<?php echo $tienda['TIENDA_RFC']; ?>">
                     </div>
                     <div class="form-group">
                       <label for="TelefonoTienda">Teléfono</label>
                       <input type="text" class="form-control" id="TelefonoTienda" name="TelefonoTienda" placeholder="" value="<?php echo $tienda['TIENDA_TELEFONO']; ?>">
                     </div>
                     <hr>
                     <h6> <span class="fa fa-building"></span> Dirección Fiscal</h6>
                     <input type="hidden" name="IdentificadorDireccion" value="<?php echo $direccion_tienda['ID_DIRECCION'] ?>">
                     <input type="hidden" name="TipoDireccion" value="fiscal">
                     <input type="hidden" name="AliasDireccion" value="Direccion Tienda">
                      <input type="hidden" name="ReferenciasDireccion" value="-">
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="PaisDireccion">País </label>
                           <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo $direccion_tienda['DIRECCION_PAIS']; ?>" required>
                             <option value="">Selecciona un País</option>
                           </select>
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="EstadoDireccion">Estado </label>
                           <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo $direccion_tienda['DIRECCION_ESTADO']; ?>" required>
                             <option value="">Selecciona tu estado</option>
                           </select>
                         </div>
                       </div>
                     </div>
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="CiudadTienda">Ciudad</label>
                           <input type="text" name="CiudadDireccion" class="form-control" value="<?php echo $direccion_tienda['DIRECCION_CIUDAD']; ?>">
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                           <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo $direccion_tienda['DIRECCION_MUNICIPIO']; ?>" required>
                             <option value="">Selecciona tu Municipio / Alcaldía</option>
                           </select>
                         </div>
                       </div>
                         <div class="col">
                           <div class="form-group">
                             <label for="CodigoPostalDireccion">Código Postal</label>
                             <input type="text" name="CodigoPostalDireccion" class="form-control" value="<?php echo $direccion_tienda['DIRECCION_CODIGO_POSTAL']; ?>">
                           </div>
                         </div>
                     </div>
                     <div class="form-group">
                       <label for="BarrioDireccion">Barrio / Colonia</label>
                       <input type="text" name="BarrioDireccion" class="form-control" value="<?php echo $direccion_tienda['DIRECCION_BARRIO']; ?>">
                     </div>
                     <div class="form-group">
                       <label for="CalleDireccion">Calle y Número</label>
                       <textarea name="CalleDireccion" class="form-control" rows="3"><?php echo $direccion_tienda['DIRECCION_CALLE_Y_NUMERO']; ?></textarea>
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
