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
                    <input type="number" class="form-control" name="EspacioAlmacenamientoPlan" id="EspacioAlmacenamientoPlan" placeholder="" value="<?php echo $plan['PLAN_ESPACIO_ALMACENAMIENTO'] ?>">
                    <div class="input-group-append">
                        <span class="input-group-text">M<sup>3</sup></span>
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
                  <label for="EstadoPlan">Estado del Plan</label>
                  <select class="form-control" name="EstadoPlan">
                    <option value="pendiente" <?php if($plan['PLAN_ESTADO']=='pendiente'){ echo 'selected'; } ?> >Pendiente</option>
                    <option value="espera pago" <?php if($plan['PLAN_ESTADO']=='espera pago'){ echo 'selected'; } ?> >Espera de Pago</option>
                    <option value="pagado" <?php if($plan['PLAN_ESTADO']=='pagado'){ echo 'selected'; } ?> >Pagado</option>
                    <option value="cancelado" <?php if($plan['PLAN_ESTADO']=='cancelado'){ echo 'selected'; } ?> >Cancelado</option>
                  </select>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-12 my-3">
                <h4> <i class="fa fa-money-bill"></i> Corte y Pagos</h4>
              </div>
              <div class="col-12">
                Fecha de Inicio:  <?php $fecha_inicio = $plan['FECHA_INICIO']; echo $fecha_inicio; ?><br>
                Fecha de Término:  <?php $fecha_termino = $plan['FECHA_TERMINO']; echo $fecha_termino; ?><br>
                <?php
                  $hoy = date('d');
                  $dia_de_corte = 27;
                  if($hoy<$dia_de_corte){
                    $primer_corte = date($dia_de_corte.'-m-Y');
                    $segundo_corte = date('d-m-Y', strtotime(date("d-m-Y", strtotime(date($dia_de_corte.'-m-Y'))) . "+30 days"));
                  }else{
                    $primer_corte = date($dia_de_corte.'-m-Y');
                  }
                  echo $primer_corte.'<br>';
                  if(isset($segundo_corte)){
                    echo $segundo_corte.'<br>';
                  }
                  // convierto las fechas a objetos
                  $fecha_inicio = new DateTime($fecha_inicio);
                  $fecha_termino = new DateTime($fecha_termino);
                  // Calculo el primer corte
                  $primer_corte = new DateTime($primer_corte);
                  $dias_para_primer_corte = $fecha_inicio->diff($primer_corte);
                  $dias_para_primer_corte = number_format($dias_para_primer_corte->d);

                  if(isset($segundo_corte)){
                    $segundo_corte = new DateTime($segundo_corte);
                    $dias_para_segundo_corte = $primer_corte->diff($fecha_termino);
                    $dias_para_segundo_corte = number_format($dias_para_segundo_corte->d);
                  }
                ?>


                Mensualidad : $<?php echo $plan['PLAN_MENSUALIDAD']; ?><br>
                Espacio Almacenamiento : $<?php echo $plan['PLAN_ESPACIO_ALMACENAMIENTO']; ?> m<sup>3</sup><br>
                Costo X m<sup>3</sup> : <?php echo $plan['PLAN_COSTO_ALMACENAMIENTO']; ?><br>
                Costo Total por Almacenamiento: $<?php $costo_almacenamiento = $plan['PLAN_ESPACIO_ALMACENAMIENTO']*$plan['PLAN_COSTO_ALMACENAMIENTO']; echo $costo_almacenamiento; ?><br>
                Importe Mensual Total: $<?php $total = $costo_almacenamiento + $plan['PLAN_MENSUALIDAD'];  echo $total; ?><br>
                Costo por día: $<?php $costo_por_dia = $total/30; echo $costo_por_dia; ?><br>
                Días para el primer Corte: <?php echo $dias_para_primer_corte; ?><br>
                Por pagar Primer Corte: $<?php $por_pagar = $costo_por_dia*$dias_para_primer_corte; echo $por_pagar;  ?><br>
                <?php if(isset($segundo_corte)){ ?>
                  Días para el segundo Corte: <?php echo $dias_para_segundo_corte; ?><br>
                  Por pagar Segundo Corte: $<?php $por_pagar = $costo_por_dia*$dias_para_segundo_corte; echo $por_pagar;  ?><br>
                <?php } ?>

              </div>
            </div>
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
