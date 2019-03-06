<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-file-signature"></span> Planes</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/planes/actualizar_plan_usuario'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Identificador" value="<?php echo $plan['ID_PLAN_USUARIO'] ?>">
            <input type="hidden" name="IdUsuario" value="<?php echo $plan['ID_USUARIO'] ?>">
            <div class="form-group">
              <label for="NombrePlan">Nombre del Plan</label>
              <input type="text" class="form-control" name="NombrePlan" id="NombrePlan" placeholder=""  value="<?php echo $plan['PLAN_NOMBRE'] ?>">
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="MensualidadPlan">Costo Mensualidad</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                    <input type="number" class="form-control" name="MensualidadPlan" id="MensualidadPlan" placeholder="" value="<?php echo $plan['PLAN_MENSUALIDAD'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="ComisionPlan">Comisión</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="ComisionPlan" id="ComisionPlan" placeholder="" value="<?php echo $plan['PLAN_COMISION'] ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="EspacioAlmacenamientoPlan">Espacio Almacenamiento</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="EspacioAlmacenamientoPlan" id="EspacioAlmacenamientoPlan" placeholder="" value="<?php echo $plan['PLAN_COSTO_ALMACENAMIENTO'] ?>">
                    <div class="input-group-append">
                        <span class="input-group-text">x M<sup>3</sup></span>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="CostoAlmacenamientoPlan">Costo Almacenamiento</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                    <input type="number" class="form-control" name="CostoAlmacenamientoPlan" id="CostoAlmacenamientoPlan" placeholder="" value="<?php echo $plan['PLAN_COSTO_ALMACENAMIENTO'] ?>">
                    <div class="input-group-append">
                        <span class="input-group-text">x M<sup>3</sup></span>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="MensualidadPlan">Costo Manejo de Producto</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="ManejoProductosPlan" id="ManejoProductosPlan" placeholder="" value="<?php echo $plan['PLAN_MANEJO_PRODUCTOS'] ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label for="EnvioPlan">Envios administrados por</label>
                  <select class="form-control" name="EnvioPlan">
                    <option value="abanico" <?php if($plan['PLAN_ENVIO']=='abanico'){ echo 'selected'; } ?>>Abanico</option>
                    <option value="tienda" <?php if($plan['PLAN_ENVIO']=='tienda'){ echo 'selected'; } ?>>Tienda o Vendedor</option>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="ServiciosFinancierosPlan">Servicios Financieros %</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="ServiciosFinancierosPlan" id="ServiciosFinancierosPlan" placeholder="" value="<?php echo $plan['PLAN_SERVICIOS_FINANCIEROS'] ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="ServiciosFinancierosFijoPlan">Servicios Financieros $</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">$</span>
                    </div>
                    <input type="number" class="form-control" name="ServiciosFinancierosFijoPlan" id="ServiciosFinancierosFijoPlan" placeholder="" value="<?php echo $plan['PLAN_SERVICIOS_FINANCIEROS_FIJO'] ?>">
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-12 my-3">
                <h4> <i class="fa fa-ban"></i> Limites por plan</h4>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="NivelPlan">Nivel del Plan (Limita las funcionalidades de los servicios)</label>
                  <select class="form-control" name="NivelPlan">
                    <option value="1" <?php if($plan['PLAN_NIVEL']=='1'){ echo 'selected'; } ?> >1</option>
                    <option value="2" <?php if($plan['PLAN_NIVEL']=='2'){ echo 'selected'; } ?> >2</option>
                    <option value="3" <?php if($plan['PLAN_NIVEL']=='3'){ echo 'selected'; } ?> >3</option>
                    <option value="4" <?php if($plan['PLAN_NIVEL']=='4'){ echo 'selected'; } ?> >4</option>
                    <option value="5" <?php if($plan['PLAN_NIVEL']=='5'){ echo 'selected'; } ?> >5</option>
                    <option value="6" <?php if($plan['PLAN_NIVEL']=='6'){ echo 'selected'; } ?> >6</option>
                    <option value="7" <?php if($plan['PLAN_NIVEL']=='7'){ echo 'selected'; } ?> >7</option>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="LimiteProductosPlan">Productos activos a la ves</label>
                  <select class="form-control" name="LimiteProductosPlan">
                    <option value="0" <?php if($plan['PLAN_LIMITE_PRODUCTOS']=='0'){ echo 'selected'; } ?>>Sin Límite</option>
                    <option value="1" <?php if($plan['PLAN_LIMITE_PRODUCTOS']=='1'){ echo 'selected'; } ?>>1</option>
                    <option value="2" <?php if($plan['PLAN_LIMITE_PRODUCTOS']=='2'){ echo 'selected'; } ?>>2</option>
                    <option value="3" <?php if($plan['PLAN_LIMITE_PRODUCTOS']=='3'){ echo 'selected'; } ?>>3</option>
                    <option value="4" <?php if($plan['PLAN_LIMITE_PRODUCTOS']=='4'){ echo 'selected'; } ?>>4</option>
                    <option value="5" <?php if($plan['PLAN_LIMITE_PRODUCTOS']=='5'){ echo 'selected'; } ?>>5</option>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="FotosProductosPlan">Fotografías por producto</label>
                  <select class="form-control" name="FotosProductosPlan">
                    <option value="0" <?php if($plan['PLAN_FOTOS_PRODUCTOS']=='0'){ echo 'selected'; } ?>>Sin Límite</option>
                    <option value="1" <?php if($plan['PLAN_FOTOS_PRODUCTOS']=='1'){ echo 'selected'; } ?>>1</option>
                    <option value="2" <?php if($plan['PLAN_FOTOS_PRODUCTOS']=='2'){ echo 'selected'; } ?>>2</option>
                    <option value="3" <?php if($plan['PLAN_FOTOS_PRODUCTOS']=='3'){ echo 'selected'; } ?>>3</option>
                    <option value="4" <?php if($plan['PLAN_FOTOS_PRODUCTOS']=='4'){ echo 'selected'; } ?>>4</option>
                    <option value="5" <?php if($plan['PLAN_FOTOS_PRODUCTOS']=='5'){ echo 'selected'; } ?>>5</option>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="LimiteServiciosPlan">Servicios activos a la ves</label>
                  <select class="form-control" name="LimiteServiciosPlan">
                    <option value="0" <?php if($plan['PLAN_LIMITE_SERVICIOS']=='0'){ echo 'selected'; } ?>>Sin Límite</option>
                    <option value="1" <?php if($plan['PLAN_LIMITE_SERVICIOS']=='1'){ echo 'selected'; } ?>>1</option>
                    <option value="2" <?php if($plan['PLAN_LIMITE_SERVICIOS']=='2'){ echo 'selected'; } ?>>2</option>
                    <option value="3" <?php if($plan['PLAN_LIMITE_SERVICIOS']=='3'){ echo 'selected'; } ?>>3</option>
                    <option value="4" <?php if($plan['PLAN_LIMITE_SERVICIOS']=='4'){ echo 'selected'; } ?>>4</option>
                    <option value="5" <?php if($plan['PLAN_LIMITE_SERVICIOS']=='5'){ echo 'selected'; } ?>>5</option>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="FotosServiciosPlan">Fotografías y anexos por servicio</label>
                  <select class="form-control" name="FotosServiciosPlan">
                    <option value="0" <?php if($plan['PLAN_FOTOS_SERVICIOS']=='0'){ echo 'selected'; } ?> >Sin Límite</option>
                    <option value="1" <?php if($plan['PLAN_FOTOS_SERVICIOS']=='1'){ echo 'selected'; } ?> >1</option>
                    <option value="2" <?php if($plan['PLAN_FOTOS_SERVICIOS']=='2'){ echo 'selected'; } ?> >2</option>
                    <option value="3" <?php if($plan['PLAN_FOTOS_SERVICIOS']=='3'){ echo 'selected'; } ?> >3</option>
                    <option value="4" <?php if($plan['PLAN_FOTOS_SERVICIOS']=='4'){ echo 'selected'; } ?> >4</option>
                    <option value="5" <?php if($plan['PLAN_FOTOS_SERVICIOS']=='5'){ echo 'selected'; } ?> >5</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="EstadoPlan">Estado del Pago</label>
                  <select class="form-control" name="EstadoPlan">
                    <option value="pendiente" <?php if($plan['PLAN_ESTADO']=='pendiente'){ echo 'selected'; } ?> >Pendiente</option>
                    <option value="pagado" <?php if($plan['PLAN_ESTADO']=='pagado'){ echo 'selected'; } ?> >Pagado</option>
                    <option value="cancelado" <?php if($plan['PLAN_ESTADO']=='cancelado'){ echo 'selected'; } ?> >Cancelado</option>
                  </select>
                </div>
              </div>
            </div>
            <hr>
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
