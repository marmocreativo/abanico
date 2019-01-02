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
              <h5> <i class="fa fa-map-marker-alt"></i> Nueva Dirección</h5>
            </div>
            <div class="card-body">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <form class="" action="<?php echo base_url('usuario/direcciones/crear');?>" method="post">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
                <div class="row">
                  <div class="col">
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="AliasDireccion">Nombre <small>Para identificar tu dirección</small> </label>
                            <input type="text" name="AliasDireccion" class="form-control" placeholder="Ej. Mi casa, Trabajo">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="TipoDireccion">Tipo de Dirección </label>
                            <select class="form-control" name="TipoDireccion" id="TipoDireccion" required>
                              <option value="envio">Para envío</option>
                              <option value="facturacion">Para Facturación</option>
                            </select>
                          </div>
                        </div>
                      </div>
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
                       <div class="col">
                         <div class="form-group">
                           <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                           <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" required>
                             <option value="">Selecciona tu Municipio / Alcaldía</option>
                           </select>
                         </div>
                       </div>
                     </div>
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="CiudadDireccion">Ciudad (Opcional)</label>
                           <input type="text" name="CiudadDireccion" class="form-control">
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
                     <div class="form-group">
                       <label for="ReferenciasDireccion">Referencias</label>
                       <textarea name="ReferenciasDireccion" class="form-control" rows="3"></textarea>
                     </div>
                     <hr>
                     <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Registrar Direeción</button>
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
