<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8">
        <div class="card mb-3">
          <form class="" action="<?php echo base_url('proceso_pago_3');?>" method="post">
          <div class="card-body">
            <div class="stepwizard mb-3">
              <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" class="btn btn-default btn-circle" disabled="disabled">1</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-primary btn-circle" >2</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-default btn-circle" disabled="disabled">3</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                </div>
              </div>
            </div>
            <!-- <hr> -->
            <div class="row">
              <div class="col text-center">
                <?php retro_alimentacion(); ?>
                <h6><i class="fa fa-map-marker my-3"></i> ¿Dónde enviaremos tu pedido?</h6>
                <?php foreach($direcciones as $direccion){ ?>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="Direccion-<?php echo $direccion->ID_DIRECCION; ?>" name="IdDireccion" class="custom-control-input" value="<?php echo $direccion->ID_DIRECCION; ?>">
                    <label class="custom-control-label" for="Direccion-<?php echo $direccion->ID_DIRECCION; ?>"><strong><?php echo $direccion->DIRECCION_ALIAS; ?></strong> | <?php echo $this->DireccionesModel->direccion_formateada($direccion->ID_DIRECCION); ?> </label>
                  </div>
                <?php } ?>
                <hr>
                <button type="button" class="btn btn-link btn-link btn-block" name="button" href="#NuevaDireccion" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="NuevaDireccion"> <i class="fa fa-plus"></i> Nueva Dirección</button>
                <div class="collapse text-left border-top mt-3 pt-3" id="NuevaDireccion">
                    <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
                    <input type="hidden" name="TipoDireccion" value="envio">
                    <div class="row">
                      <div class="col">
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label for="AliasDireccion">Nombre <small>Para identificar tu dirección</small> </label>
                                <input type="text" name="AliasDireccion" class="form-control form-control-sm" placeholder="Ej. Mi casa, Trabajo">
                              </div>
                            </div>
                          </div>

                         <div class="row">
                           <div class="col-12">
                             <div class="form-group">
                               <label for="PaisDireccion">País </label>
                               <select class="form-control form-control-sm" name="PaisDireccion" id="PaisDireccion">
                                 <option value="">Selecciona un País</option>
                               </select>
                             </div>
                           </div>
                           <div class="col-12">
                             <div class="form-group">
                               <label for="EstadoDireccion">Estado </label>
                               <select class="form-control form-control-sm" name="EstadoDireccion" id="EstadoDireccion">
                                 <option value="">Selecciona tu estado</option>
                               </select>
                             </div>
                           </div>
                           <div class="col-12">
                             <div class="form-group">
                               <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                               <select class="form-control form-control-sm" name="MunicipioDireccion" id="MunicipioDireccion">
                                 <option value="">Selecciona tu Municipio / Alcaldía</option>
                               </select>
                             </div>
                           </div>
                         </div>

                         <div class="row">
                           <div class="col-12">
                             <div class="form-group">
                               <label for="CiudadDireccion">Ciudad (Opcional)</label>
                               <input type="text" name="CiudadDireccion" class="form-control form-control-sm">
                             </div>
                           </div>
                           <div class="col-12">
                             <div class="form-group">
                               <label for="CodigoPostalDireccion">Código Postal</label>
                               <input type="text" name="CodigoPostalDireccion" class="form-control form-control-sm">
                             </div>
                           </div>
                         </div>

                         <div class="form-group">
                           <label for="BarrioDireccion">Barrio / Colonia</label>
                           <input type="text" name="BarrioDireccion" class="form-control form-control-sm">
                         </div>
                         <div class="form-group">
                           <label for="CalleDireccion">Calle y Número</label>
                           <textarea name="CalleDireccion" class="form-control form-control-sm" rows="3"></textarea>
                         </div>
                         <div class="form-group">
                           <label for="ReferenciasDireccion">Referencias</label>
                           <textarea name="ReferenciasDireccion" class="form-control form-control-sm" rows="3"></textarea>
                         </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer d-flex justify-content-between">
              <a href="<?php echo base_url(); ?>" class="btn btn-sm btn-outline-primary"> <i class="fa fa-chevron-left"></i> Volver a la tienda</a>
              <button type="submit" class="btn btn-sm btn-success"> Continuar <i class="fa fa-chevron-right"></i></button>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
