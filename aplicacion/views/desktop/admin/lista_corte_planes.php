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
        <div class="card-header d-flex justify-content-between">
          <form class="" action="<?php echo base_url('admin/corte_planes'); ?>" method="get">
            <div class="titulo">
              <h1 class="h6"> <span class="fa fa-box"></span> Corte Planes</h1>
            </div>
            <div class="formulario form-inline">
              <div class="form-group mx-2">
                <label for="MesCorte"> Mes </label>
                <select class="form-control" name="MesCorte">
                  <?php if(isset($_GET['MesCorte'])&&!empty($_GET['MesCorte'])){ $mes = $_GET['MesCorte']; }else{ $mes = date('m');}?>
                  <option value="01" <?php if($mes=='01'){ echo 'selected'; } ?>>Enero</option>
                  <option value="02" <?php if($mes=='02'){ echo 'selected'; } ?>>Febrero</option>
                  <option value="03" <?php if($mes=='03'){ echo 'selected'; } ?>>Marzo</option>
                  <option value="04" <?php if($mes=='04'){ echo 'selected'; } ?>>Abril</option>
                  <option value="05" <?php if($mes=='05'){ echo 'selected'; } ?>>Mayo</option>
                  <option value="06" <?php if($mes=='06'){ echo 'selected'; } ?>>Junio</option>
                  <option value="07" <?php if($mes=='07'){ echo 'selected'; } ?>>Julio</option>
                  <option value="08" <?php if($mes=='08'){ echo 'selected'; } ?>>Agosto</option>
                  <option value="09" <?php if($mes=='09'){ echo 'selected'; } ?>>Septiembre</option>
                  <option value="10" <?php if($mes=='10'){ echo 'selected'; } ?>>Octubre</option>
                  <option value="11" <?php if($mes=='11'){ echo 'selected'; } ?>>Noviembre</option>
                  <option value="12" <?php if($mes=='12'){ echo 'selected'; } ?>>Diciembre</option>
                </select>
              </div>
              <div class="form-group mx-2">
                <label for="AnioCorte"> Año </label>
                <select class="form-control" name="AnioCorte">
                  <?php if(isset($_GET['AnioCorte'])&&!empty($_GET['AnioCorte'])){ $anio = $_GET['AnioCorte']; }else{ $anio = date('Y');}?>
                  <option value="2019" <?php if($anio=='2019'){ echo 'selected'; } ?>>2019</option>
                  <option value="2020" <?php if($anio=='2020'){ echo 'selected'; } ?>>2020</option>
                  <option value="2021" <?php if($anio=='2021'){ echo 'selected'; } ?>>2021</option>
                  <option value="2022" <?php if($anio=='2022'){ echo 'selected'; } ?>>2022</option>
                  <option value="2023" <?php if($anio=='2023'){ echo 'selected'; } ?>>2023</option>
                </select>
              </div>
                <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-search"></i> Buscar</button>
            </div>
          </form>
        </div>
        <div class="card-body">

            <input type="hidden" name="MesCorte" value="<?php echo $mes; ?>">
            <input type="hidden" name="AnioCorte" value="<?php echo $anio; ?>">
            <div class="card">
              <div class="card-body">
                <div class="btn-group pull-right" role="group" aria-label="Basic example">
                  <!--<a href="<?php echo base_url('admin/corte_vendedores/imprimir?MesCorte='.$mes.'&AnioCorte='.$anio) ?>" target="_blank" class="btn btn-info"> <i class="fa fa-print"></i> Imprimir</a>-->

                </div>
              </div>
            </div>
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
                    </tr>
                  </table>
                  <hr>
              </div>
            <?php } ?>
            <div class="card">
              <div class="card-body">
                <div class="btn-group pull-right" role="group" aria-label="Basic example">
                  <!--<a href="<?php echo base_url('admin/corte_vendedores/imprimir?MesCorte='.$mes.'&AnioCorte='.$anio) ?>" target="_blank" class="btn btn-info"> <i class="fa fa-print"></i> Imprimir</a>-->
                </div>
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
