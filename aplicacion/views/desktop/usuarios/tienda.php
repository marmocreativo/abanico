<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
            <?php retro_alimentacion(); ?>
          <?php if($tienda['TIENDA_ESTADO']=='activo'){ ?>
          <div class="row">
            <div class="col-4">
              <div class="row">
                <div class="col">
                  <div class="card">
                    <div class="card-header">
                      <?php switch ($tienda['TIENDA_TIPO']) {
                        case 'tienda':
                           $texto_tipo_tienda = $this->lang->line('usuario_vista_tienda_tipo_tienda');
                          break;
                        case 'vendedor':
                           $texto_tipo_tienda = $this->lang->line('usuario_vista_tienda_tipo_vendedor');
                          break;
                      } ?>
                      <h5> <i class="fa fa-store"></i> <?php echo $texto_tipo_tienda; ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                          <div class="col-6 mb-3">
                              <img src="<?php echo base_url('contenido/img/tiendas/completo/'.$tienda['TIENDA_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                          </div>
                          <div class="col-12">
                            <table class="table table-sm table">
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_nombre'); ?></b></td>
                                <td><?php echo $tienda['TIENDA_NOMBRE']; ?></td>
                              </tr>
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_razon'); ?></b></td>
                                <td><?php echo $tienda['TIENDA_RAZON_SOCIAL']; ?></td>
                              </tr>
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_rfc'); ?></b></td>
                                <td><?php echo $tienda['TIENDA_RFC']; ?></td>
                              </tr>
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_telefono'); ?></b></td>
                                <td><?php echo $tienda['TIENDA_TELEFONO']; ?></td>
                              </tr>
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_registro'); ?></b><br><?php echo $tienda['TIENDA_FECHA_REGISTRO']; ?></td>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_actualizacion'); ?></b><br><?php echo $tienda['TIENDA_FECHA_ACTUALIZACION']; ?></td>
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
                      <a href="<?php echo base_url('usuario/tienda/actualizar'); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> <?php echo $this->lang->line('usuario_listas_generales_editar'); ?></a>
                    </div>
                  -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-8">
              <div class="row">
                <div class="col">
                  <div class="card <?php echo 'border'.$primary; ?> text-center  mb-4">
                    <div class="card-body">
                      <a href="<?php echo base_url('usuario/productos');?>"><i class="fa fa-box"></i> <?php echo $this->lang->line('usuario_vista_tienda_productos_catalogo_boton'); ?></a>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card <?php echo 'border'.$primary; ?> text-center  mb-4">
                    <div class="card-body">
                      <a href="<?php echo base_url('usuario/ventas');?>"><i class="fa fa-file-invoice-dollar"></i> <?php echo $this->lang->line('usuario_vista_tienda_ventas_boton'); ?></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <?php if(!empty($plan)){ ?>
                    <div class="card <?php echo 'border'.$primary; ?>">
                      <div class="card-body">
                        <h4 class="h5"> <span class="fa fa-file-signature"></span> Plan activo | <b><?php echo $plan['PLAN_NOMBRE']; ?></b></h4>
                        <hr>
                        <table class="table table-sm">
                          <tr>
                            <td>Mensualidad</td>
                            <td>$<?php echo $plan['PLAN_MENSUALIDAD']; ?></td>
                          </tr>
                          <tr>
                            <td>Comisión por venta</td>
                            <td><?php echo $plan['PLAN_COMISION']; ?>%</td>
                          </tr>
                          <tr>
                            <td>Espacio de almacenamiento</td>
                            <td><?php echo $plan['PLAN_ESPACIO_ALMACENAMIENTO']; ?> m<sup>3</sup></td>
                          </tr>
                          <tr>
                            <td>Costo de almacenamiento</td>
                            <td>$<?php echo $plan['PLAN_COSTO_ALMACENAMIENTO']; ?> x m<sup>3</sup></td>
                          </tr>
                          <tr>
                            <td>Costo manejo de producto</td>
                            <td><?php echo $plan['PLAN_MANEJO_PRODUCTOS']; ?>%</td>
                          </tr>
                          <tr>
                            <td>Apoyo para envío</td>
                            <td><?php if($plan['PLAN_ENVIO']=='abanico'){ echo 'Guías disponibles'; } ; ?></td>
                          </tr>
                          <tr>
                            <td>Servicios financieros</td>
                            <td><?php echo $plan['PLAN_SERVICIOS_FINANCIEROS']; ?>% + $<?php echo $plan['PLAN_SERVICIOS_FINANCIEROS_FIJO']; ?></td>
                          </tr>
                          <?php if($plan['PLAN_TIPO']=='productos'){ ?>
                          <tr>
                            <td>Límite de productos activos</td>
                            <?php if($plan['PLAN_LIMITE_PRODUCTOS']==0){ ?>
                              <td>Ilimitados</td>
                            <?php }else{ ?>
                              <td><?php echo $plan['PLAN_LIMITE_PRODUCTOS']; ?></td>
                            <?php } ?>
                          </tr>
                          <tr>
                            <td>Límite fotografías por producto</td>
                            <td><?php echo $plan['PLAN_FOTOS_PRODUCTOS']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php if($plan['PLAN_TIPO']=='servicios'){ ?>
                          <tr>
                            <td>Límite de servicios activos</td>
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
                        <div class="row">
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
                              <input type="hidden" name="IdPedido" value="<?php echo $pago->ID_PLAN_USUARIO; ?>">
                              <input type="hidden" name="FormaPago" value="Transferencia Bancaria">
                              <input type="hidden" name="DescripcionPago" value="Comprobante de cliente">
                              <input type="hidden" name="EstadoPago" value="Verificando">
                              <div class="form-group">
                                <label for="FolioPago"><?php echo $this->lang->line('usuario_detalles_pago_folio'); ?></label>
                                <input type="text" class="form-control" name="FolioPago" value="">
                              </div>
                              <div class="form-group">
                                <label for="ArchivoPago"><?php echo $this->lang->line('usuario_detalles_pago_archivo'); ?></label>
                                <input type="file" class="form-control" name="ArchivoPago" value="" required>
                              </div>
                              <button type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-upload"></i> <?php echo $this->lang->line('usuario_detalles_pago_subir'); ?></button>
                            </form>
                          </div>
                        <?php }// Si el Pago está pendientes y es por transferencia Bancaria ?>
                      <?php }// Bucle de pagos ?>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col">
                            <p>Estado del Pago: <b><?php echo $plan['PLAN_ESTADO']; ?></b></p>
                          </div>
                          <div class="col d-flex justify-content-end">
                            <p>Fecha Límite de Pago: <b><?php echo date('d-m-Y',strtotime("+10 days",strtotime($plan['FECHA_INICIO']))); ?></b></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php }else{?>
                    <div class="card <?php echo 'border'.$primary; ?>">
                      <div class="card-body">
                        <h4 class="h5"> <span class="fa fa-file-signature"></span> Plan activo | <b>Ninguno</b></h4>
                        <hr>
                        <a href="<?php echo base_url('usuario/planes/lista_planes?tipo=productos'); ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Activar Plan</a>
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
