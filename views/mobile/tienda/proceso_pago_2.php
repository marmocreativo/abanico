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
                <h6><i class="fa fa-map-marker my-3"></i> <?php echo $this->lang->line('proceso_pago_2_donde_enviaremos'); ?></h6>
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
                                <label for="AliasDireccion"><?php echo $this->lang->line('usuario_form_direcciones_nombre'); ?> <small><?php echo $this->lang->line('usuario_form_direcciones_nombre_instrucciones'); ?></small> </label>
                                <input type="text" name="AliasDireccion" class="form-control" placeholder="Ej. Mi casa, Trabajo">
                              </div>
                            </div>
                          </div>
                         <div class="row">
                           <div class="col">
                             <div class="form-group">
                               <label for="PaisDireccion"><?php echo $this->lang->line('usuario_form_direcciones_pais'); ?> </label>
                               <select class="form-control" name="PaisDireccion" id="PaisDireccion">
                                 <option value=""><?php echo $this->lang->line('usuario_form_direcciones_pais_selecciona'); ?></option>
                               </select>
                             </div>
                           </div>
                           <div class="col">
                             <div class="form-group">
                               <label for="EstadoDireccion"><?php echo $this->lang->line('usuario_form_direcciones_estado'); ?> </label>
                               <select class="form-control" name="EstadoDireccion" id="EstadoDireccion">
                                 <option value=""><?php echo $this->lang->line('usuario_form_direcciones_estado_selecciona'); ?></option>
                               </select>
                             </div>
                           </div>
                           <div class="col">
                             <div class="form-group">
                               <label for="MunicipioDireccion"><?php echo $this->lang->line('usuario_form_direcciones_municipio'); ?></label>
                               <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion">
                                 <option value=""><?php echo $this->lang->line('usuario_form_direcciones_municipio_selecciona'); ?></option>
                               </select>
                             </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col">
                             <div class="form-group">
                               <label for="CiudadDireccion"><?php echo $this->lang->line('usuario_form_direcciones_ciudad'); ?> <?php echo $this->lang->line('usuario_form_direcciones_ciudad_instrucciones'); ?></label>
                               <input type="text" name="CiudadDireccion" class="form-control">
                             </div>
                           </div>
                           <div class="col">
                             <div class="form-group">
                               <label for="CodigoPostalDireccion"><?php echo $this->lang->line('usuario_form_direcciones_codigo_postal'); ?></label>
                               <input type="text" name="CodigoPostalDireccion" class="form-control">
                             </div>
                           </div>
                         </div>
                         <div class="form-group">
                           <label for="BarrioDireccion"><?php echo $this->lang->line('usuario_form_direcciones_barrio_colonia'); ?></label>
                           <input type="text" name="BarrioDireccion" class="form-control">
                         </div>
                         <div class="form-group">
                           <label for="CalleDireccion"><?php echo $this->lang->line('usuario_form_direcciones_calle_numero'); ?></label>
                           <textarea name="CalleDireccion" class="form-control" rows="3"></textarea>
                         </div>
                         <div class="form-group">
                           <label for="ReferenciasDireccion"><?php echo $this->lang->line('usuario_form_direcciones_referencias'); ?></label>
                           <textarea name="ReferenciasDireccion" class="form-control" rows="3"></textarea>
                         </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer d-flex justify-content-between">
              <a href="<?php echo base_url(); ?>" class="btn btn-sm btn-outline-primary"> <i class="fa fa-chevron-left"></i> <?php echo $this->lang->line('proceso_pago_2_volver_a_tienda'); ?></a>
              <button type="submit" class="btn btn-sm btn-success"> <?php echo $this->lang->line('proceso_pago_2_continuar'); ?> <i class="fa fa-chevron-right"></i></button>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
