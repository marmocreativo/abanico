<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
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
              <div class="row justify-content-center">
                <?php foreach($planes as $plan){ ?>
                  <div class="col">
                    <div class="card mb-3">
                      <div class="card-header text-center">
                        <img src="<?php echo base_url('assets/global/img/logo.png'); ?>" alt="">
                        <h5 class="card-title"> <?php echo $plan->PLAN_NOMBRE; ?></h5>
                        <p class="card-text">$<?php echo $plan->PLAN_MENSUALIDAD; ?> / Al mes</p>
                      </div>
                        <div class="card-body p-1">
                          <table class="table table-striped table-bordered">
                            <tr>
                              <td>Mensualidad</td>
                              <td>$<?php echo $plan->PLAN_MENSUALIDAD; ?></td>
                            </tr>
                            <tr>
                              <td>Comisión por venta</td>
                              <td><?php echo $plan->PLAN_COMISION; ?>%</td>
                            </tr>
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
                        <div class="card-body">
                            <a href="<?php echo base_url('usuario/planes/activar?id='.$plan->ID_PLAN); ?>" class="btn btn-primary btn-block">Activar Plan</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
