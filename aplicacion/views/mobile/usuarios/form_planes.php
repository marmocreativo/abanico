<!-- empieza panel usuario resposivo -->

<div class="fila-gris">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('mobile/usuarios/widgets/menu_control_usuario'); ?>
      </div>
    </div>
  </div>
</div>

<div class="container py-3 mb-3">
  <div class="row">
    <div class="col-sm-3 col-md-2 fila">
      <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
    </div>
    <div class="col">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <div class="row justify-content-center no-gutters">
            <?php foreach($planes as $plan){ ?>
              <div class="col tabla-planes" id="<?php echo $plan->PLAN_TIPO.'_plan_'.$plan->PLAN_NIVEL; ?>">
                <div class="card mb-3 rounded-0">
                  <div class="card-header text-left">
                    <img src="<?php echo base_url('assets/global/img/'.$plan->PLAN_TIPO.'_plan_'.$plan->PLAN_NIVEL.'_mono.png'); ?>" alt="">
                    <h4 class="card-title"> <?php echo $plan->PLAN_NOMBRE; ?></h4>
                    <p class="card-text text-primary">$<?php echo $plan->PLAN_MENSUALIDAD; ?> / Al mes</p>
                  </div>
                    <div class="card-body p-0">
                      <table class="table m-0">
                        <tr>
                          <td>Mensualidad</td>
                          <td>$<?php echo $plan->PLAN_MENSUALIDAD; ?></td>
                        </tr>
                        <tr>
                          <td>Comisión por venta</td>
                          <td><?php echo $plan->PLAN_COMISION; ?>%</td>
                        </tr>
                        <?php if($plan->PLAN_NIVEL>=4){ ?>
                          <tr>
                            <td>Costo de Almacenamiento</td>
                            <td>$<?php echo $plan->PLAN_ALMACENAMIENTO; ?> x M<sup>3</sup></td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td>Envios Administrados por</td>
                          <td><?php echo $plan->PLAN_ENVIO; ?></td>
                        </tr>
                        <?php if($plan->PLAN_TIPO=='productos'){ ?>
                        <tr>
                          <td>Productos Activos</td>
                          <td>
                            <?php if($plan->PLAN_LIMITE_PRODUCTOS!=0){ ?>
                              <?php echo $plan->PLAN_LIMITE_PRODUCTOS; ?>
                            <?php }else{ ?>
                              <span>&#8734;</span>
                            <?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>Fotografías por producto</td>
                          <td>
                            <?php if($plan->PLAN_FOTOS_PRODUCTOS!=0){ ?>
                              <?php echo $plan->PLAN_FOTOS_PRODUCTOS; ?>
                            <?php }else{ ?>
                              <span>&#8734;</span>
                            <?php } ?>
                          </td>
                        </tr>
                        <?php } ?>
                        <?php if($plan->PLAN_TIPO=='servicios'){ ?>
                        <tr>
                          <td>Límite de Servicios Activos</td>
                          <td>
                            <?php if($plan->PLAN_LIMITE_SERVICIOS!=0){ ?>
                              <?php echo $plan->PLAN_LIMITE_SERVICIOS; ?>
                            <?php }else{ ?>
                              <span>&#8734;</span>
                            <?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>Límite de fotografías por servicio</td>
                          <td>
                            <?php if($plan->PLAN_FOTOS_SERVICIOS!=0){ ?>
                              <?php echo $plan->PLAN_FOTOS_SERVICIOS; ?>
                            <?php }else{ ?>
                              <span>&#8734;</span>
                            <?php } ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </table>
                    </div>
                    <div class="card-body p-0">
                      <?php if($plan->PLAN_TIPO == 'productos'){ ?>
                      <?php if($plan->PLAN_NIVEL>=4){ ?>
                        <p class="text-center">Comunícate con nosotros para activar este plan</p>
                      <?php }else{ ?>
                        <a href="<?php echo base_url('usuario/planes/activar?id='.$plan->ID_PLAN); ?>" class="btn btn-primary btn-block rounded-0">Activar Plan</a>
                      <?php } // Termina condicional Nivel ?>
                    <?php }else{// Termina condicional tipo ?>
                      <a href="<?php echo base_url('usuario/planes/activar?id='.$plan->ID_PLAN); ?>" class="btn btn-primary btn-block rounded-0">Activar Plan</a>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
  </div>
</div>
