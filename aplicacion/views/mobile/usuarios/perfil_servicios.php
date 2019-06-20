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
  <?php if($perfil['PERFIL_ESTADO']=='activo'){ ?>
  <div class="row">
    <div class="col-12">
      <?php retro_alimentacion(); ?>
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="pt-2"> <i class="fa fa-user-tie"></i> <?php echo $this->lang->line('usuario_vista_perfil_servicios'); ?></h5>
        </div>
        <div class="card-body">
          <img class="img-fluid d-block mx-auto mb-3 img-thumbnail rounded-circle" style="width:150px" src="<?php echo base_url('contenido/img/perfiles/completo/'.$perfil['PERFIL_IMAGEN']) ?>" alt="">
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_nombre'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_NOMBRE']; ?></p>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_razon'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_RAZON_SOCIAL']; ?></p>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_rfc'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_RFC']; ?></p>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_telefono'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_TELEFONO']; ?></p>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_registro'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_FECHA_REGISTRO']; ?></p>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_actualizacion'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_FECHA_ACTUALIZACION']; ?></p>
          <hr>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_direccion_fiscal'); ?></strong></h6>
          <p><?php echo $direccion_formateada; ?></p>
        </div>
        <!--
        <div class="card-footer">
          <a href="<?php echo base_url('usuario/perfil_servicios/actualizar'); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> <?php echo $this->lang->line('usuario_listas_generales_editar'); ?></a>
        </div>
      -->
      </div>

    </div>
    <div class="col">
      <?php if(!empty($plan)){ ?>
        <div class="col" id="<?php echo $plan['PLAN_TIPO'].'_plan_'.$plan['PLAN_NIVEL']; ?>">
          <div class="card mb-3 rounded-0">
            <div class="card-header text-center">
              <img src="<?php echo base_url('assets/global/img/'.$plan['PLAN_TIPO'].'_plan_'.$plan['PLAN_NIVEL'].'_mono.png'); ?>" alt="">
              <h5 class="card-title"> <?php echo $plan['PLAN_NOMBRE']; ?></h5>
              <p>Estado: <b><?php echo $plan['PLAN_ESTADO']; ?></b></p>
            </div>
              <div class="card-body p-0">
                <table class="table m-0">
                  <tr>
                    <td>Mensualidad</td>
                    <td>$<?php echo $plan['PLAN_MENSUALIDAD']; ?></td>
                  </tr>
                  <tr>
                    <td>Límite de servicios activos</td>
                    <td><?php echo $plan['PLAN_LIMITE_SERVICIOS']; ?></td>
                  </tr>
                  <tr>
                    <td>Límite de fotografías por servicio</td>
                    <td><?php echo $plan['PLAN_FOTOS_SERVICIOS']; ?></td>
                  </tr>
                </table>
                <div class="row p-3">
                  <div class="col-12 p-3">
                    <div class="card border-primary">
                      <div class="card-body p-2">
                        <p class="mb-1"> <b>Registro:</b> <?php echo $plan['FECHA_INICIO']; ?></p>
                        <p class="mb-1"> <b>Vigencia:</b> <?php echo $plan['FECHA_TERMINO']; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="card border-primary">
                      <div class="card-body p-2">
                        <?php if($plan['AUTO_RENOVAR']=='si'){ ?>
                        <p class="mb-1"> <b>Auto renovar:</b> <?php echo $plan['FECHA_TERMINO']; ?></p>
                          <a href="<?php echo base_url('usuario/planes/auto_renovar?id='.$plan['ID_PLAN_USUARIO'].'&estado=no'); ?>" class="btn btn-sm btn-block btn-outline-primary"> <i class="fa fa-ban"></i> Cancelar Auto Renovación </a>
                        <?php }else{ ?>
                          <a href="<?php echo base_url('usuario/planes/auto_renovar?id='.$plan['ID_PLAN_USUARIO'].'&estado=si'); ?>" class="btn btn-sm btn-block btn-primary"> <i class="fa fa-check"></i> Activar Auto Renovación </a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="row p-3">
                <div class="col-12">
                  <hr>
                  <h4 class="h5"> <span class="fa fa-money-bill"></span> Pago del plan</b></h4>
                </div>
            <!--Permisos para pagar y cancelar -->
            <?php $pagos = $this->PlanesModel->lista_pagos($plan['ID_PLAN_USUARIO']); ?>
            <?php foreach($pagos as $pago){ ?>
              <?php if($pago->PAGO_ESTADO=='pendiente'){ ?>
                <div class="col-12">
                  <form class="" action="<?php echo base_url('usuario/planes/subir_comprobante'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="IdPago" value="<?php echo $pago->ID_PAGO; ?>">
                    <input type="hidden" name="Origen" value="usuario/tienda">
                    <div class="form-group">
                      <label for="ArchivoPago"><?php echo $this->lang->line('usuario_detalles_pago_archivo'); ?></label>
                      <input type="file" class="form-control" name="ArchivoPago" value="" required>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-upload"></i> <?php echo $this->lang->line('usuario_detalles_pago_subir'); ?></button>
                  </form>
                </div>
              <?php }// Si el Pago está pendientes y es por transferencia Bancaria ?>
              <?php if($pago->PAGO_ESTADO=='comprobante'){ ?>
                <div class="col-12">
                  <div class="alert alert-success">
                    <h6>Tu comprobante ha sido recibido, tu plan estará activo pronto.</h6>
                  </div>
                </div>
              <?php }// Si se subió comprobante ?>
              <?php if($pago->PAGO_ESTADO=='pagado'){ ?>
                <div class="col-12">
                  <div class="alert alert-success">
                    <h6>Tu plan se encuentra <?php echo $pago->PAGO_ESTADO; ?></h6>
                  </div>
                </div>
              <?php }// Si se subió comprobante ?>
            <?php }// Bucle de pagos ?>
              </div>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col">
                <p>Estado del Pago: <b><?php echo $plan['PLAN_ESTADO']; ?></b></p>
              </div>
              <div class="col d-flex justify-content-end">
                <p>Fecha Límite de Pago: <b><?php echo date('d-m-Y',strtotime("+5 days",strtotime($plan['FECHA_INICIO']))); ?></b></p>
              </div>
            </div>
          </div>
      </div>
      <?php }else{?>
        <div class="card <?php echo 'border'.$primary; ?>">
          <div class="card-body">
            <h4 class="h5"> <span class="fa fa-file-signature"></span> No has solicitado ningún plan</b></h4>
            <hr>
            <a href="<?php echo base_url('usuario/planes/lista_planes?tipo=servicios'); ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Solicitar activación de plan</a>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
</div>
<?php }else{ ?>
<div class="row">
<div class="col">
  <div class="alert alert-danger">
    <h6><?php echo $this->lang->line('usuario_vista_tienda_suspendida'); ?>.</h6>
  </div>
</div>
</div>
<?php } ?>
</div>

<!-- Modal de flujos -->

<!-- Modal -->
<div class="modal fade" id="ModalAyuda" tabindex="-1" role="dialog" aria-labelledby="ModalAyuda" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-question-circle"></i> Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">

          <div class="linea-colores-delgada">
            <div class="barra-color barra-azul"></div>
            <div class="barra-color barra-rosa"></div>
            <div class="barra-color barra-amarillo"></div>
            <div class="barra-color barra-verde"></div>
            <div class="barra-color barra-morado"></div>
          </div>
        <!-- Slider Ayuda-->
        <div id="carouselAyuda" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselAyuda" data-slide-to="0" class="active"></li>
            <li data-target="#carouselAyuda" data-slide-to="1"></li>
            <li data-target="#carouselAyuda" data-slide-to="2"></li>
            <li data-target="#carouselAyuda" data-slide-to="3"></li>
            <li data-target="#carouselAyuda" data-slide-to="4"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.1.png'); ?>" alt="Registro paso 1">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.2.png'); ?>" alt="Registro paso 2">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.3.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.4.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.5.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.6.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.7.png'); ?>" alt="Registro paso 4">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselAyuda" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselAyuda" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
