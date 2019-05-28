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
<?php if(isset($_GET['id_usuario'])){ ?>
  <div class="row">
    <div class="col-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-four">
              <div class="stat-icon dib">
                  <i class="fa fa-user-tag text-muted"></i>
              </div>
              <div class="stat-content">
                  <div class="text-left dib">
                      <div class="stat-heading">Usuario</div>
                      <div class="stat-text"><?php echo $usuario['USUARIO_NOMBRE'].' '.$usuario['USUARIO_APELLIDOS']; ?></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-body">

            <?php
              // Variables generales (Fechas)
                if(isset($_GET['MesCorte'])&&!empty($_GET['MesCorte'])&&isset($_GET['AnioCorte'])&&!empty($_GET['AnioCorte'])){
                  $inicio = date($_GET['AnioCorte'].'-'.$_GET['MesCorte'].'-01 00:00:00');
                  $fin = date('Y-m-d H:i:s',strtotime('+1 month'.$inicio));
                }else{
                  $inicio = date('Y-m-01 H:i:s');
                  $fin = date('Y-m-d H:i:s',strtotime('+1 month'.$inicio));
                }
                $suma_divisa = array();
                foreach($divisas_activas as $divisa){
                  $suma_divisa[$divisa->DIVISA_ISO] = 0;
                }
            ?>
              <?php
                $visible = ''; //
                $lisa_pagos = $this->PlanesModel->lista_pagos_mes('',$inicio,$fin);
                if(empty($lisa_pagos)){ $visible = 'd-none'; }
                $suma = 0;
                ?>
                <?php foreach($lisa_pagos as $pago){ ?>
              <div class="border border-primary p-4 mb-4 <?php echo $visible; ?>">
                <h4 class="mb-2"> <i class="fa fa-store"></i> <?php echo $pago->PLAN_NOMBRE; ?></h4>
                  <table class="table table-bordered table-sm">
                    <tr>
                        <td style="text-align:right">Usuario:</td>
                        <td><b><?php echo $pago->USUARIO_NOMBRE.' '.$pago->USUARIO_APELLIDOS; ?></b></td>
                      <?php if($pago->PLAN_TIPO=='productos'){ ?>
                        <?php $tienda = $this->TiendasModel->tienda_usuario($pago->ID_USUARIO); ?>
                        <td style="text-align:right">Tienda:</td>
                        <td><b><?php echo $tienda['TIENDA_NOMBRE']; ?></b></td>
                      <?php } ?>
                      <?php if($pago->PLAN_TIPO=='servicios'){ ?>
                        <?php $perfil = $this->PerfilServiciosModel->perfil_usuario($pago->ID_USUARIO); ?>
                        <td style="text-align:right">Tienda:</td>
                        <td><b><?php echo $perfil['PERFIL_NOMBRE']; ?></b></td>
                      <?php } ?>
                        <td >Fecha Pago: <b><?php echo $pago->FECHA_PAGO; ?></b></td>
                    </tr>
                    <tr>
                      <td colspan="4" style="text-align:right">Forma de Pago:</td>
                      <td ><b><?php echo $pago->PAGO_FORMA; ?></b></td>
                    </tr>
                    <tr>
                      <td colspan="4" style="text-align:right">Depositado:</td>
                      <td >$<b><?php echo $pago->PAGO_IMPORTE; ?></b></td>
                      <?php $suma +=$pago->PAGO_IMPORTE; ?>
                    </tr>
                  </table>
                  <hr>
              </div>
            <?php } ?>
            <div class="card">
              <div class="card-body">
                <h4>Depósitos totales: <b>$<?php echo $suma; ?></b></h4>
              </div>
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
