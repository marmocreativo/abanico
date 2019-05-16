<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
  <div class="kt-container kt-body kt-grid kt-grid--ver" id="kt_body">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

      <!-- begin:: Subheader -->
      <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
        </div>
        <div class="kt-subheader__toolbar">
        </div>
      </div>

      <!-- end:: Subheader -->

      <!-- begin:: Content -->
      <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--Begin::Dashboard 8-->

        <!--Begin::Section-->
        <div class="row mb-3">
          <div class="col-xl-12">

            <!--begin:: Widgets/Trends-->
            <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
              <div class="kt-portlet__body">
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
          <div class="row">
            <?php foreach($planes as $plan){ ?>
              <div class="col tabla-planes" id="<?php echo $plan->PLAN_TIPO.'_plan_'.$plan->PLAN_NIVEL; ?>">
                <div class="card mb-3 rounded-0">
                  <div class="card-header text-left">
                    <img src="<?php echo base_url('assets/global/img/'.$plan->PLAN_TIPO.'_plan_'.$plan->PLAN_NIVEL.'_mono.png'); ?>" alt="">
                    <h5 class="card-title"> <?php echo $plan->PLAN_NOMBRE; ?></h5>
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
                            <td colspan="2">
                              <div class="row">
                                <div class="col">
                                  Costo de almacenamiento<br>
                                </div>
                                <div class="col text-right">
                                  $<?php echo $plan->PLAN_ALMACENAMIENTO; ?> x m<sup>3</sup><br>
                                </div>
                              </div>
                              <small>Renta mínima 0.25 m<sup>3</sup></small>
                            </td>
                          </tr>
                        <?php } ?>
                        <?php if($plan->PLAN_NIVEL>=4){ ?>
                        <tr>
                          <td>Manejo del producto</td>
                          <td><?php echo $plan->PLAN_MANEJO_PRODUCTOS; ?>%</td>
                        </tr>
                      <?php } ?>
                        <?php if($plan->PLAN_TIPO=='productos'){ ?>
                        <tr>
                          <td>Productos activos</td>
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
                          <td>Límite de servicios activos</td>
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
                      <a href="<?php echo base_url('admin/planes/activar?id='.$plan->ID_PLAN.'&id_usuario='.$_GET['id_usuario']); ?>" class="btn btn-primary btn-block rounded-0">Activar plan</a>
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
</div>

<!--end:: Widgets/Trends-->
</div>
</div>
<!--End::Section-->

<!--End::Dashboard 8-->
</div>

<!-- end:: Content -->
</div>
</div>
</div>
