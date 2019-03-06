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

          <form class="" action="<?php echo base_url('admin/planes/crear'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="TipoPlan">Plan para: </label>
              <select class="form-control" name="TipoPlan">
                <option value="productos">Vendedores (Productos)</option>
                <option value="servicios">Prestadores de Servicios</option>
                <option value="automoviles">Automóviles y Bienes Raíces</option>
              </select>
            </div>
            <div class="form-group">
              <label for="NombrePlan">Nombre del Plan</label>
              <input type="text" class="form-control" name="NombrePlan" id="NombrePlan" placeholder=""  value="<?=!form_error('NombrePlan')?set_value('NombrePlan'):''?>">
            </div>
            <div class="form-group">
              <label for="DescripcionPlan">Descripción</label>
              <textarea name="DescripcionPlan" class="form-control Editor" rows="8"><?=!form_error('DescripcionPlan')?set_value('DescripcionPlan'):''?></textarea>
            </div>
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label for="MensualidadPlan">Costo Mensualidad</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                    <input type="number" class="form-control" name="MensualidadPlan" id="MensualidadPlan" placeholder="" value="<?=!form_error('MensualidadPlan')?set_value('MensualidadPlan'):''?>">
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="ComisionPlan">Comisión</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="ComisionPlan" id="ComisionPlan" placeholder="" value="<?=!form_error('ComisionPlan')?set_value('ComisionPlan'):''?>">
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="MensualidadPlan">Costo Almacenamiento</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                    <input type="number" class="form-control" name="AlmacenamientoPlan" id="AlmacenamientoPlan" placeholder="" value="<?=!form_error('AlmacenamientoPlan')?set_value('AlmacenamientoPlan'):''?>">
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
                    <input type="number" class="form-control" name="ManejoProductosPlan" id="ManejoProductosPlan" placeholder="" value="<?=!form_error('ManejoProductosPlan')?set_value('ManejoProductosPlan'):''?>">
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
                    <option value="abanico">Abanico</option>
                    <option value="tienda">Tienda o Vendedor</option>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="ServiciosFinancierosPlan">Servicios Financieros %</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="ServiciosFinancierosPlan" id="ServiciosFinancierosPlan" placeholder="" value="<?=!form_error('ServiciosFinancierosPlan')?set_value('ServiciosFinancierosPlan'):''?>">
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
                    <input type="number" class="form-control" name="ServiciosFinancierosFijoPlan" id="ServiciosFinancierosFijoPlan" placeholder="" value="<?=!form_error('ServiciosFinancierosFijoPlan')?set_value('ServiciosFinancierosFijoPlan'):''?>">
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
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="LimiteProductosPlan">Productos activos a la ves</label>
                  <select class="form-control" name="LimiteProductosPlan">
                    <option value="0">Sin Límite</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="FotosProductosPlan">Fotografías por producto</label>
                  <select class="form-control" name="FotosProductosPlan">
                    <option value="0">Sin Límite</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="LimiteServiciosPlan">Servicios activos a la ves</label>
                  <select class="form-control" name="LimiteServiciosPlan">
                    <option value="0">Sin Límite</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="FotosServiciosPlan">Fotografías y anexos por servicio</label>
                  <select class="form-control" name="FotosServiciosPlan">
                    <option value="0">Sin Límite</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
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
