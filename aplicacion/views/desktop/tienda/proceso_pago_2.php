<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8">
        <div class="card">
          <div class="card-body">
            <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" class="btn btn-default btn-circle" disabled="disabled">1</a>
                  <p>Identificación</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-primary btn-circle" >2</a>
                  <p>Dirección</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-default btn-circle" disabled="disabled">3</a>
                  <p>Pago</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                  <p>Confirmación</p>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col text-center">
                <h6> <i class="fa fa-map-marker"></i> Dirección de Envío</h6>
                <form class="" action="<?php echo base_url('pago_paso_3');?>" method="post">
                <?php foreach($direcciones as $direccion){ ?>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="Direccion-<?php echo $direccion->ID_DIRECCION; ?>" name="IdDireccion" class="custom-control-input" value="<?php echo $direccion->ID_DIRECCION; ?>">
                    <label class="custom-control-label" for="Direccion-<?php echo $direccion->ID_DIRECCION; ?>"><strong><?php echo $direccion->DIRECCION_ALIAS; ?></strong> | <?php echo $this->DireccionesModel->direccion_formateada($direccion->ID_DIRECCION); ?> </label>
                  </div>
                <?php } ?>
                <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-save"></i> Continuar</button>
                </form>
                <hr>
                <button type="button" class="btn btn-link btn-link btn-block" name="button" href="#NuevaDireccion" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="NuevaDireccion"> <i class="fa fa-plus"></i> Nueva Dirección</button>
                <div class="collapse" id="NuevaDireccion">
                  <div class="card card-body">
                    <form class="" action="<?php echo base_url('pago_paso_3');?>" method="post">
                      <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
                      <input type="hidden" name="TipoDireccion" value="envio">
                      <div class="row">
                        <div class="col">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label for="AliasDireccion">Alias</label>
                                  <input type="text" name="AliasDireccion" class="form-control">
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
                           <div class="form-group">
                             <label for="ReferenciasDireccion">Referencias</label>
                             <textarea name="ReferenciasDireccion" class="form-control" rows="3"></textarea>
                           </div>
                           <hr>
                           <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Continuar</button>
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
    </div>
  </div>
</div>
