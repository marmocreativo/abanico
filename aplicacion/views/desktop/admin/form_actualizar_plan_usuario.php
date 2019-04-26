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
          <?php retro_alimentacion(); ?>

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
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12 my-3">
              <h4> <i class="fa fa-money-bill"></i> Corte y Pagos</h4>
            </div>
            <div class="col-12">
              <?php $pagos = $this->PlanesModel->lista_pagos($plan['ID_PLAN_USUARIO']); ?>
              <?php if(empty($pagos)){ ?>
              <table class="table table-sm table-bordered">
                <tbody>
                  <tr>
                    <td colspan="2"><b>Fecha de Inicio:</b> <?php echo date('d-m-Y', strtotime($plan['FECHA_INICIO'])); ?></td>
                    <td ><b>Fecha de Término:</b> <?php echo date('d-m-Y', strtotime($plan['FECHA_TERMINO'])); ?></td>
                    <td ><b>Fecha Límite de Pag:</b> <?php echo date('d-m-Y',strtotime("+10 days",strtotime($plan['FECHA_INICIO']))); ?></td>
                  </tr>
                  <tr>
                    <td><b>Mensualidad:</b> $<?php echo $plan['PLAN_MENSUALIDAD']; ?> MXN</td>
                    <td><b>Espacio Almacenamiento:</b> <?php echo $plan['PLAN_ESPACIO_ALMACENAMIENTO']; ?> m<sup>3</sup></td>
                    <td><b>Costo X m<sup>3</sup>:</b> $<?php echo $plan['PLAN_COSTO_ALMACENAMIENTO']; ?> MXN</td>
                    <td><b>Costo Almacentamiento:</b> $<?php $costo_almacenamiento = $plan['PLAN_ESPACIO_ALMACENAMIENTO']*$plan['PLAN_COSTO_ALMACENAMIENTO']; echo number_format($costo_almacenamiento ,2); ?> MXN</td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <b>Importe Mensual:</b> $<?php $total = $costo_almacenamiento + $plan['PLAN_MENSUALIDAD']; echo number_format($total ,2); ?> MXN
                    </td>
                      <td colspan="2"><b>Costo por día:</b> $<?php $costo_por_dia = $total/30; echo number_format($costo_por_dia ,2); ?><br></td>
                  </tr>
                </tbody>
              </table>
              <form class="" action="<?php echo base_url('admin/planes/enviar_ficha_plan'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="IdUsuario" value="<?php echo $plan['ID_USUARIO'] ?>">
                <input type="hidden" name="IdPlanUsuario" value="<?php echo $plan['ID_PLAN_USUARIO'] ?>">
                <input type="hidden" name="PagoConcepto" value="<?php echo $plan['PLAN_NOMBRE'] ?>">
                <input type="hidden" name="Mensualidad" value="<?php echo $plan['PLAN_MENSUALIDAD'] ?>">
                <input type="hidden" name="EspacioAlmacenamiento" value="<?php echo $plan['PLAN_ESPACIO_ALMACENAMIENTO'] ?>">
                <input type="hidden" name="CostoAlmacenamiento" value="<?php echo $plan['PLAN_COSTO_ALMACENAMIENTO'] ?>">
                <input type="hidden" name="CostoAlmacenamientoTotal" value="<?php echo number_format($costo_almacenamiento ,2) ?>">
                <input type="hidden" name="PagoImporte" value="<?php echo number_format($total ,2) ?>">
                <input type="hidden" name="PagoDivisa" value="MXN">
                <input type="hidden" name="PagoConversion" value="1.00">
                <input type="hidden" name="FechaLimite" value="<?php echo date('Y-m-d',strtotime("+10 days",strtotime($plan['FECHA_INICIO']))); ?>">
                <input type="hidden" name="CostoPorDia" value="<?php echo number_format($costo_por_dia ,2) ?>">
                <input type="hidden" name="PagoForma" value="Transferencia Bancaria">
                <input type="hidden" name="EstadoPago" value="pendiente">
                <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-envelope"></span> Enviar Ficha</button>
              </form>
            <?php }else{ ?>
              <table class="table table-sm table-bordered">
                <thead>
                  <tr>
                    <th>Fecha Límite</th>
                    <th>Fecha Pago</th>
                    <th>Método de Pago</th>
                    <th>Folio</th>
                    <th>Documento</th>
                    <th>Importe</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($pagos as $pago){ ?>
                  <tr>
                    <td><?php echo $pago->FECHA_LIMITE; ?> </td>
                    <td><?php echo $pago->FECHA_PAGO; ?> </td>
                    <td><?php echo $pago->PAGO_FORMA; ?> </td>
                    <td><?php echo $pago->PAGO_FOLIO; ?> </td>
                    <td>
                      <img src="<?php echo base_url('contenido/adjuntos/pedidos/').$pago->PAGO_ARCHIVO; ?>" alt="" width="100">
                    <hr>
                    <?php if(!empty($pago->PAGO_ARCHIVO)){ ?>
                    <a href="<?php echo base_url('contenido/adjuntos/pedidos/').$pago->PAGO_ARCHIVO; ?>" target="_blank" class="btn btn-outline-success btn-sm">Descargar</a>
                  <?php } ?>
                  </td>
                    <td>$<?php echo number_format($pago->PAGO_IMPORTE,2,'.',','); ?>MXN
                    </td>
                    <td><?php echo $pago->PAGO_ESTADO; ?> </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
