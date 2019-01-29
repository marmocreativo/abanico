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
          <h5 class="pt-2"> <i class="fa fa-map-marker-alt"></i> Actualizar Dirección</h5>
        </div>
        <div class="card-body">
           <form class="" action="http://localhost/abanico-master/usuario/direcciones/actualizar" method="post">
             <input type="hidden" name="IdUsuario" value="5c4123cf5ec3e1.37253227">
             <input type="hidden" name="Identificador" value="18">
             <div class="form-group">
               <label for="AliasDireccion">Nombre <small>Para identificar tu dirección</small> </label>
               <input type="text" name="AliasDireccion" class="form-control form-control-sm" value="asdfa">
             </div>
             <div class="form-group">
               <label for="TipoDireccion">Tipo de Dirección </label>
               <select class="form-control form-control-sm" name="TipoDireccion" id="TipoDireccion" required="">
                 <option value="envio" selected="">Para envío</option>
                 <option value="facturacion">Para Facturación</option>
               </select>
             </div>
             <div class="form-group">
               <label for="PaisDireccion">País </label>
               <select class="form-control form-control-sm" name="PaisDireccion" id="PaisDireccio" data-valor-anterior="México" required="">
                 <option value="">Selecciona un País</option>
               <option value="México" data-id="1">México</option><option value="Estados Unidos" data-id="2">Estados Unidos</option></select>
             </div>
             <div class="form-group">
               <label for="EstadoDireccion">Estado </label>
               <select class="form-control form-control-sm" name="EstadoDireccion" id="EstadoDireccio" data-valor-anterior="Aguascalientes" required=""><option value="-">Selecciona un Estado</option><option value="Aguascalientes">Aguascalientes</option><option value="Baja California">Baja California</option><option value="Baja California Sur">Baja California Sur</option><option value="Campeche">Campeche</option><option value="Chiapas">Chiapas</option><option value="Chihuahua">Chihuahua</option><option value="Ciudad de México">Ciudad de México</option><option value="Coahuila">Coahuila</option><option value="Colima">Colima</option><option value="Durango">Durango</option><option value="Estado de México">Estado de México</option><option value="Guanajuato">Guanajuato</option><option value="Guerrero">Guerrero</option><option value="Hidalgo">Hidalgo</option><option value="Jalisco">Jalisco</option><option value="Michoacán">Michoacán</option><option value="Morelos">Morelos</option><option value="Nayarit">Nayarit</option><option value="Nuevo León">Nuevo León</option><option value="Oaxaca">Oaxaca</option><option value="Puebla">Puebla</option><option value="Querétaro">Querétaro</option><option value="Quintana Roo">Quintana Roo</option><option value="San Luis Potosí">San Luis Potosí</option><option value="Sinaloa">Sinaloa</option><option value="Sonora">Sonora</option><option value="Tabasco">Tabasco</option><option value="Tamaulipas">Tamaulipas</option><option value="Tlaxcala">Tlaxcala</option><option value="Veracruz">Veracruz</option><option value="Yucatán">Yucatán</option><option value="Zacatecas">Zacatecas</option></select>
             </div>
             <div class="form-group">
               <label for="MunicipioDireccion">Municipio / Alcaldía</label>
               <select class="form-control form-control-sm" name="MunicipioDireccion" id="MunicipioDireccio" data-valor-anterior="Aguascalientes" required=""><option value="-">Selecciona tu Municipio / Alcaldía</option><option value="Aguascalientes">Aguascalientes</option><option value="Asientos">Asientos</option><option value="Calvillo">Calvillo</option><option value="Cosío">Cosío</option><option value="El Llano">El Llano</option><option value="Jesús María">Jesús María</option><option value="Pabellón de Arteaga">Pabellón de Arteaga</option><option value="Rincón de Romos">Rincón de Romos</option><option value="San Francisco de los Romo">San Francisco de los Romo</option><option value="San José de Gracia">San José de Gracia</option><option value="Tepezalá">Tepezalá</option></select>
             </div>
             <div class="form-group">
               <label for="CiudadDireccion">Ciudad (Opcional)</label>
               <input type="text" name="CiudadDireccion" class="form-control form-control-sm" value="">
             </div>
             <div class="form-group">
               <label for="CodigoPostalDireccion">Código Postal</label>
               <input type="text" name="CodigoPostalDireccion" class="form-control form-control-sm" value="09808" required="">
             </div>
             <div class="form-group">
               <label for="BarrioDireccion">Barrio / Colonia</label>
               <input type="text" name="BarrioDireccion" class="form-control form-control-sm" value="asdf" required="">
             </div>
             <div class="form-group">
               <label for="CalleDireccion">Calle y Número</label>
               <textarea name="CalleDireccion" class="form-control form-control-sm" rows="3" required="">asdf</textarea>
             </div>
             <div class="form-group">
               <label for="ReferenciasDireccion">Referencias</label>
               <textarea name="ReferenciasDireccion" class="form-control form-control-sm" rows="3">asdf</textarea>
             </div>
             <hr>
             <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-save"></i> Actualizar Direeción</button>
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
        <div class="col-12 col-md-6">
          <div class="card">
            <div class="card-header">
              <h5> <i class="fa fa-map-marker-alt"></i> Actualizar Dirección</h5>
            </div>
            <div class="card-body">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <form class="" action="<?php echo base_url('usuario/direcciones/actualizar');?>" method="post">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
                <input type="hidden" name="Identificador" value="<?php echo $direccion['ID_DIRECCION']; ?>">
                <div class="row">
                  <div class="col">
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="AliasDireccion">Nombre <small>Para identificar tu dirección</small> </label>
                            <input type="text" name="AliasDireccion" class="form-control" value="<?php echo $direccion['DIRECCION_ALIAS']; ?>">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="TipoDireccion">Tipo de Dirección </label>
                            <select class="form-control" name="TipoDireccion" id="TipoDireccion" required>
                              <option value="envio" <?php if($direccion['DIRECCION_TIPO']=='envio'){ echo 'selected'; } ?>>Para envío</option>
                              <option value="facturacion" <?php if($direccion['DIRECCION_TIPO']=='facturacion'){ echo 'selected'; } ?>>Para Facturación</option>
                            </select>
                          </div>
                        </div>
                      </div>
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="PaisDireccion">País </label>
                           <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo $direccion['DIRECCION_PAIS']; ?>"  required>
                             <option value="">Selecciona un País</option>
                           </select>
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="EstadoDireccion">Estado </label>
                           <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo $direccion['DIRECCION_ESTADO']; ?>" required>
                             <option value="">Selecciona tu estado</option>
                           </select>
                         </div>
                       </div>

                       <div class="col">
                         <div class="form-group">
                           <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                           <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo $direccion['DIRECCION_MUNICIPIO']; ?>" required>
                             <option value="">Selecciona tu Municipio / Alcaldía</option>
                           </select>
                         </div>
                       </div>
                     </div>
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="CiudadDireccion">Ciudad (Opcional)</label>
                           <input type="text" name="CiudadDireccion" class="form-control"  value="<?php echo $direccion['DIRECCION_CIUDAD']; ?>">
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="CodigoPostalDireccion">Código Postal</label>
                           <input type="text" name="CodigoPostalDireccion" class="form-control"  value="<?php echo $direccion['DIRECCION_CODIGO_POSTAL']; ?>" required>
                         </div>
                       </div>
                     </div>
                     <div class="form-group">
                       <label for="BarrioDireccion">Barrio / Colonia</label>
                       <input type="text" name="BarrioDireccion" class="form-control" value="<?php echo $direccion['DIRECCION_BARRIO']; ?>" required>
                     </div>
                     <div class="form-group">
                       <label for="CalleDireccion">Calle y Número</label>
                       <textarea name="CalleDireccion" class="form-control" rows="3" required><?php echo $direccion['DIRECCION_CALLE_Y_NUMERO']; ?></textarea>
                     </div>
                     <div class="form-group">
                       <label for="ReferenciasDireccion">Referencias</label>
                       <textarea name="ReferenciasDireccion" class="form-control" rows="3"><?php echo $direccion['DIRECCION_REFERENCIAS']; ?></textarea>
                     </div>
                     <hr>
                     <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Actualizar Direeción</button>
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
