<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <div class="row justify-content-center" >
                <div class="col-8 text-center">
                  <h1>Planes de <?php if(!empty($_GET['tipo'])&&$_GET['tipo']=='servicios'){ echo 'servicios'; }else{ echo 'vendedores'; } ?></h1>
                  <p>Tenemos un plan para cada necesidad. Si no estás seguro de cual elegir, solicita el creas se ajusta mejor a tus necesidades y cuando nos comuniquemos contigo podrás cambiarlo si otro plan te conviene mas.</p>
                </div>
              </div>
              <div class="row justify-content-center no-gutters">
                <?php foreach($planes as $plan){ ?>
                  <div class="col tabla-planes" id="<?php echo $plan->PLAN_TIPO.'_plan_'.$plan->PLAN_NIVEL; ?>">
                    <div class="card mb-3 rounded-0">
                      <div class="card-header text-left">
                        <img src="<?php echo base_url('assets/global/img/'.$plan->PLAN_TIPO.'_plan_'.$plan->PLAN_NIVEL.'_mono.png'); ?>" alt="">
                        <h5 class="card-title"> <?php echo $plan->PLAN_NOMBRE; ?></h5>
                      </div>
                        <div class="card-body p-3">
                          <?php echo $plan->PLAN_DESCRIPCION; ?>
                        </div>
                        <?php if(isset($_SESSION['usuario']['id'])&&!empty($_SESSION['usuario']['id'])){ ?>
                        <div class="card-footer">
                          <?php if(!empty($_GET['tipo'])&&$_GET['tipo']=='servicios'){ ?>
                            <a href="<?php echo base_url('usuario/perfil_servicios?plan='.$plan->ID_PLAN); ?>" class="btn btn-success btn-block">Solicitar este plan</a>
                          <?php }else{ ?>
                            <a href="<?php echo base_url('usuario/tienda?plan='.$plan->ID_PLAN); ?>" class="btn btn-success btn-block">Solicitar este plan</a>
                          <?php } ?>
                        </div>
                      <?php }else{ ?>
                        <div class="card-footer">
                          <?php if(!empty($_GET['tipo'])&&$_GET['tipo']=='servicios'){ ?>
                            <a href="<?php echo base_url('usuario/registro_rapido/registro_perfil?plan='.$plan->ID_PLAN); ?>" class="btn btn-success btn-block">Solicitar este plan</a>
                          <?php }else{ ?>
                            <a href="<?php echo base_url('usuario/registro_rapido/registro_tienda?plan='.$plan->ID_PLAN); ?>" class="btn btn-success btn-block">Solicitar este plan</a>
                          <?php } ?>
                        </div>
                      <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="row">
              <div class="col">
                <p class="p-3 border border-warning"> <i class=" fa fa-exclamation"></i> Para anunciar vehículos o bienes raíces por favor comunícate con nosotros</p>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
