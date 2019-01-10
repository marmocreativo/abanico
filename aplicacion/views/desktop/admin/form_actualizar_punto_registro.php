  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5> <i class="fa fa-map-marker-alt"></i> Actualizar Punto de Registro</h5>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/puntos_registro/actualizar');?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $punto_registro['ID_PUNTO'] ?>">
            <div class="row">
              <div class="col">
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="AliasDireccion">Nombre <small>Para identificar la dirección</small> </label>
                        <input type="text" name="AliasDireccion" class="form-control" placeholder="Ej. Oficina" value="<?php echo $punto_registro['PUNTO_ALIAS'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="PaisDireccion">País </label>
                        <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo $punto_registro['PUNTO_PAIS']; ?>"  required>
                          <option value="">Selecciona un País</option>
                        </select>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="EstadoDireccion">Estado </label>
                        <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo $punto_registro['PUNTO_ESTADO']; ?>" required>
                          <option value="">Selecciona tu estado</option>
                        </select>
                      </div>
                    </div>

                    <div class="col">
                      <div class="form-group">
                        <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                        <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo $punto_registro['PUNTO_MUNICIPIO']; ?>" required>
                          <option value="">Selecciona tu Municipio / Alcaldía</option>
                        </select>
                      </div>
                    </div>
                  </div>
                 <div class="row">
                   <div class="col">
                     <div class="form-group">
                       <label for="CiudadDireccion">Ciudad (Opcional)</label>
                       <input type="text" name="CiudadDireccion" class="form-control" value="<?php echo $punto_registro['PUNTO_CIUDAD'] ?>">
                     </div>
                   </div>
                   <div class="col">
                     <div class="form-group">
                       <label for="CodigoPostalDireccion">Código Postal</label>
                       <input type="text" name="CodigoPostalDireccion" class="form-control" required value="<?php echo $punto_registro['PUNTO_CODIGO_POSTAL'] ?>">
                     </div>
                   </div>
                 </div>
                 <div class="form-group">
                   <label for="BarrioDireccion">Barrio / Colonia</label>
                   <input type="text" name="BarrioDireccion" class="form-control" required value="<?php echo $punto_registro['PUNTO_BARRIO'] ?>">
                 </div>
                 <div class="form-group">
                   <label for="CalleDireccion">Calle y Número</label>
                   <textarea name="CalleDireccion" class="form-control" rows="3" required><?php echo $punto_registro['PUNTO_CALLE_Y_NUMERO'] ?></textarea>
                 </div>
                 <div class="form-group">
                   <label for="ReferenciasDireccion">Referencias</label>
                   <textarea name="ReferenciasDireccion" class="form-control" rows="3"><?php echo $punto_registro['PUNTO_REFERENCIAS'] ?></textarea>
                 </div>
                 <hr>
                 <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Actualizar Punto</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
