<div class="container">
  <div class="row">
    <div class="col">
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
          <form class="" action="<?php echo base_url('admin/direcciones/actualizar');?>" method="post">
            <input type="hidden" name="IdUsuario" value="<?php echo $direccion['ID_USUARIO']; ?>">
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
