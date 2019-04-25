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
            <div class="col-4">
              <div class="row">
                <div class="col">
                  <div class="card">
                    <div class="card-header">
                      <h5> <i class="fa fa-user-tie"></i> <?php echo $this->lang->line('usuario_vista_perfil_servicios'); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                          <div class="col-6 mb-3">
                              <img src="<?php echo base_url('contenido/img/perfiles/completo/'.$perfil['PERFIL_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                          </div>
                          <div class="col-12">
                            <table class="table table-sm table">
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_nombre'); ?></b></td>
                                <td><?php echo $perfil['PERFIL_NOMBRE']; ?></td>
                              </tr>
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
                    <!--
                    <div class="card-footer">
                      <a href="<?php echo base_url('usuario/perfil_servicios/actualizar'); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> <?php echo $this->lang->line('usuario_listas_generales_editar'); ?></a>
                    </div>
                  -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card <?php echo 'border'.$primary; ?> text-center  mb-4">
                <div class="card-body">
                  <a href="<?php echo base_url('usuario/servicios');?>"><span class="fa fa-tools"></span> <?php echo $this->lang->line('usuario_vista_perfil_servicios_catalogo_boton'); ?></a>
                </div>
              </div>
              <?php if(!empty($plan)){ ?>
                <div class="card <?php echo 'border'.$primary; ?>">
                  <div class="card-body">
                    <h4 class="h5"> <span class="fa fa-file-signature"></span> Plan activo | <b><?php echo $plan['PLAN_NOMBRE']; ?></b></h4>
                    <hr>
                    <table class="table table-sm table-striped">
                      <tr>
                        <td>Mensualidad</td>
                        <td>$<?php echo $plan['PLAN_MENSUALIDAD']; ?></td>
                      </tr>
                      <tr>
                        <td>Comisión por venta</td>
                        <td><?php echo $plan['PLAN_COMISION']; ?>%</td>
                      </tr>
                      <tr>
                        <td>Espacio de Almacenamiento</td>
                        <td><?php echo $plan['PLAN_ESPACIO_ALMACENAMIENTO']; ?> M<sup>3</sup></td>
                      </tr>
                      <tr>
                        <td>Costo de Almacenamiento</td>
                        <td>$<?php echo $plan['PLAN_COSTO_ALMACENAMIENTO']; ?> x M<sup>3</sup></td>
                      </tr>
                      <tr>
                        <td>Costo Manejo de producto</td>
                        <td><?php echo $plan['PLAN_MANEJO_PRODUCTOS']; ?>%</td>
                      </tr>
                      <tr>
                        <td>Envios Administrados por</td>
                        <td><?php echo $plan['PLAN_ENVIO']; ?></td>
                      </tr>
                      <tr>
                        <td>Servicios Financieros</td>
                        <td><?php echo $plan['PLAN_SERVICIOS_FINANCIEROS']; ?>% + $<?php echo $plan['PLAN_SERVICIOS_FINANCIEROS_FIJO']; ?></td>
                      </tr>
                      <?php if($plan['PLAN_TIPO']=='productos'){ ?>
                      <tr>
                        <td>Límite de Productos Activos</td>
                        <td><?php echo $plan['PLAN_LIMITE_PRODUCTOS']; ?></td>
                      </tr>
                      <tr>
                        <td>Límite fotografías por producto</td>
                        <td><?php echo $plan['PLAN_FOTOS_PRODUCTOS']; ?></td>
                      </tr>
                      <?php } ?>
                      <?php if($plan['PLAN_TIPO']=='servicios'){ ?>
                      <tr>
                        <td>Límite de Servicios Activos</td>
                        <td><?php echo $plan['PLAN_LIMITE_SERVICIOS']; ?></td>
                      </tr>
                      <tr>
                        <td>Límite de fotografías por servicio</td>
                        <td><?php echo $plan['PLAN_FOTOS_SERVICIOS']; ?></td>
                      </tr>
                      <?php } ?>
                    </table>
                    <div class="row">
                      <div class="col">
                        <div class="card border-primary">
                          <div class="card-body p-2">
                            <p class="mb-1"> <b>Registro:</b> <?php echo $plan['FECHA_INICIO']; ?></p>
                            <p class="mb-1"> <b>Vigencia:</b> <?php echo $plan['FECHA_TERMINO']; ?></p>
                          </div>
                        </div>
                      </div>
                      <div class="col">
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
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col">
                        <p>Estado del Pago: <b><?php echo $plan['PLAN_ESTADO']; ?></b></p>
                      </div>
                      <div class="col d-flex justify-content-end">
                        <p>Fecha Límite de Pago: <b><?php echo date('Y-m-d',strtotime("+10 days",strtotime($plan['FECHA_INICIO']))); ?></b></p>
                      </div>
                    </div>
                  </div>
                </div>
              <?php }else{?>
                <div class="card <?php echo 'border'.$primary; ?>">
                  <div class="card-body">
                    <h4 class="h5"> <span class="fa fa-file-signature"></span> Plan activo | <b>Ninguno</b></h4>
                    <hr>
                    <a href="<?php echo base_url('usuario/planes/lista_planes?tipo=servicios'); ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Activar Plan</a>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php }else{ ?>
          <div class="row">
            <div class="col">
              <div class="alert alert-danger">
                <h6><?php echo $this->lang->line('usuario_vista_perfil_servicios_suspendido'); ?></h6>
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
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo3.1.png'); ?>" alt="Registro paso 1">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo3.2.png'); ?>" alt="Registro paso 2">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo3.3.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo3.4.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo3.5.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo3.6.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo3.7.png'); ?>" alt="Registro paso 4">
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
