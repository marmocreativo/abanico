<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
            <?php retro_alimentacion(); ?>
          <?php if($perfil['PERFIL_ESTADO']=='activo'){ ?>
          <div class="row">
            <div class="col-5">
              <div class="row">
                <div class="col">
                  <div class="card">
                    <div class="card-header text-center text-white bg-primary-3">
                      <h5> <i class="fa fa-user-tie"></i> <?php echo $perfil['PERFIL_NOMBRE']; ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                          <div class="col-6 mb-3">
                              <img src="<?php echo base_url('contenido/img/perfiles/completo/'.$perfil['PERFIL_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                          </div>
                          <div class="col-12">
                            <table class="table table-sm table">
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_razon'); ?></b></td>
                                <td><?php echo $perfil['PERFIL_RAZON_SOCIAL']; ?></td>
                              </tr>
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_rfc'); ?></b></td>
                                <td><?php echo $perfil['PERFIL_RFC']; ?></td>
                              </tr>
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_telefono'); ?></b></td>
                                <td><?php echo $perfil['PERFIL_TELEFONO']; ?></td>
                              </tr>
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_registro'); ?></b><br><?php echo $perfil['PERFIL_FECHA_REGISTRO']; ?></td>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_actualizacion'); ?></b><br><?php echo $perfil['PERFIL_FECHA_ACTUALIZACION']; ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row border-top pt-3">
                          <div class="col">
                            <h6><?php echo $this->lang->line('usuario_vista_tienda_direccion_fiscal'); ?></h6>
                            <p><?php echo $direccion_formateada; ?></p>
                          </div>
                        </div>
                    </div>

                    <div class="card-footer">
                      <a href="<?php echo base_url('usuario/perfil_servicios/actualizar'); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> <?php echo $this->lang->line('usuario_listas_generales_editar'); ?></a>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="row">
                <div class="col">
                  <a href="<?php echo base_url('usuario/servicios');?>">
                  <div class="card <?php echo 'border-primary-3'; ?> text-center  mb-4">
                    <div class="card-body text-center text-primary-3">
                      <h2><i class="fa fa-tools fa-2x"></i></h2>
                      <?php echo $this->lang->line('usuario_vista_perfil_servicios_catalogo_boton'); ?>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col">
                  <a href="<?php echo base_url('usuario/mensajes?tipo=mensaje%20servicio');?>">
                  <div class="card <?php echo 'border-primary-3'; ?> text-center  mb-4">
                    <div class="card-body text-center text-primary-3">
                      <h2><i class="fa fa-envelope fa-2x"></i></h2>
                        Mensajes de Servicios
                    </div>
                  </div>
                  </a>
                </div>
              </div>
              <?php if(!empty($plan)){ ?>
                <div class="col" id="<?php echo $plan['PLAN_TIPO'].'_plan_'.$plan['PLAN_NIVEL']; ?>">
                  <div class="card mb-3 rounded-0">
                    <div class="card-header text-center">
                      <img src="<?php echo base_url('assets/global/img/'.$plan['PLAN_TIPO'].'_plan_'.$plan['PLAN_NIVEL'].'_mono.png'); ?>" alt="">
                      <h5 class="card-title">Tu plan vigente</h5>
                      <h4> <?php echo $plan['PLAN_NOMBRE']; ?></h4>
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
                          <div class="col-6 p-3">
                            <div class="card border-primary">
                              <div class="card-body p-1">
                                <div class="row">
                                  <div class="col-3 text-center text-primary">
                                    <p class="pt-1"><i class="fa fa-calendar-alt fa-2x"></i></p>
                                  </div>
                                  <div class="col">
                                    <p class="mb-1"> <b>Registro:</b><br> <?php echo date('d-M-Y', strtotime($plan['FECHA_INICIO'])); ?></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-6 p-3">
                            <div class="card border-primary">
                              <div class="card-body p-1">
                                <div class="row">
                                  <div class="col-3 text-center text-primary">
                                    <p class="pt-1"><i class="fa fa-calendar-times fa-2x"></i></p>
                                  </div>
                                  <div class="col">
                                    <p class="mb-1"> <b>Vigencia:</b><br> <?php echo date('d-M-Y', strtotime($plan['FECHA_TERMINO'])); ?></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="row p-3 text-center">
                        <div class="col-12">
                          <h4 class="h5"> <i class="fa fa-file-signature"></i> Estado de tu plan</b></h4>
                        </div>
                        <?php if($plan['PLAN_ESTADO']=='pendiente'){ ?>
                        <div class="col-12">
                          <h4><span class="badge badge-pill badge-warning py-2"><i class="fa fa-pause-circle fa-lg"></i></span> Pendiente</h4>
                          <p>Nos comunicaremos contigo via telefónica para confirmar tu información y ajustar tu plan en caso necesario.</p>
                        </div>
                        <?php } ?>
                        <?php if($plan['PLAN_ESTADO']=='espera pago'){ ?>
                        <div class="col-12">
                          <h4><span class="badge badge-pill badge-warning py-2"><i class="fas fa-search-dollar fa-lg"></i></span> En espera de Pago</h4>
                          <p>Te hemos enviado una ficha de pago a tu correo electrónico, en cuanto hagas el depósito por favor sube tu comprobante o comunícate con nosotros.</p>
                        </div>
                        <?php } ?>
                        <?php if($plan['PLAN_ESTADO']=='pagado'){ ?>
                        <div class="col-12">
                          <h4><span class="badge badge-pill badge-success py-2"><i class="fa fa-check-circle fa-lg"></i></span> Pagado y Activo</h4>
                          <p>¡Tu plan está activo y funcionando por completo!</p>
                        </div>
                        <?php } ?>
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
                          <div class="alert alert-warnign">
                            <h6>Estamos confirmado que el depósito se haya efectuado correctamente, dentro de poco tu plan estará activo</h6>
                          </div>
                        </div>
                      <?php }// Si se subió comprobante ?>
                      <?php if($pago->PAGO_ESTADO=='pagado'){ ?>
                        <div class="col-12">
                          <div class="alert alert-success">
                            <h6>Tu pago ha sido confirmado!</h6>
                          </div>
                        </div>
                      <?php }// Si se subió comprobante ?>
                    <?php }// Bucle de pagos ?>
                      </div>
                  </div>
                  <div class="card-footer">
                    <div class="card border-primary">
                      <div class="card-body p-2">
                        <?php if($plan['AUTO_RENOVAR']=='si'){ ?>
                        <p class="mb-1"> <b>Fecha auto renovación:</b> <?php echo date('d-M-Y', strtotime($plan['FECHA_TERMINO'])); ?></p>
                          <a href="<?php echo base_url('usuario/planes/auto_renovar?id='.$plan['ID_PLAN_USUARIO'].'&estado=no'); ?>" class="btn btn-sm btn-block btn-outline-danger"> <i class="fa fa-ban"></i> Cancelar Auto Renovación </a>
                        <?php }else{ ?>
                          <a href="<?php echo base_url('usuario/planes/auto_renovar?id='.$plan['ID_PLAN_USUARIO'].'&estado=si'); ?>" class="btn btn-sm btn-block btn-outline-danger"> <i class="fa fa-check"></i> Activar Auto Renovación </a>
                        <?php } ?>
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
      </div>
    </div>
  </div>
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
            <li data-target="#carouselAyuda" data-slide-to="5"></li>
            <li data-target="#carouselAyuda" data-slide-to="6"></li>
            <li data-target="#carouselAyuda" data-slide-to="7"></li>
            <li data-target="#carouselAyuda" data-slide-to="8"></li>
            <li data-target="#carouselAyuda" data-slide-to="9"></li>
            <li data-target="#carouselAyuda" data-slide-to="10"></li>
            <li data-target="#carouselAyuda" data-slide-to="11"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo31.png'); ?>" alt="Registro paso 1">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo32.png'); ?>" alt="Registro paso 2">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo33.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo34.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo35.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo36.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo37.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo38.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo39.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo310.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo311.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo312.png'); ?>" alt="Registro paso 4">
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
