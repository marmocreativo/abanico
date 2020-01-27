<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <div class="row">
            <div class="col-12">
              <?php retro_alimentacion(); ?>
              <form class="" action="<?php echo base_url('usuario/pedidos/calificar?id='.$_GET['id_pedido']); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="Identificador" value="<?php echo $_GET['id_pedido']; ?>">
                <input type="hidden" name="IdCalificador" value="<?php echo $_SESSION['usuario']['id'] ?>">
              <div class="card">
                <div class="card-header d-flex justify-content-between">
                  <div class="titulo">
                    <h2 class="h3 mb-0"> <b><?php echo $pedido['PEDIDO_NOMBRE'] ?></b> Gracias por comprar con nosotros ! </h2>
                  </div>
                </div>
                  <div class="row m-0">
                    <div class="col-12 text-center p-3">
                      <?php if(!empty($pedido['PEDIDO_COMENTARIOS'])){ ?>
                        <h5>Gracias por compartir tu opinión</h5>
                      <?php }else{ ?>
                        <h5>Nos gustaría conocer tu opinión sobre los productos que compraste y sobre nuestro servicio en general</h5>
                      <?php } ?>
                    </div>
                    <?php /* BUCLE DE PRODUCTOS*/ foreach($productos as $producto){ ?>
                    <div class="col-4">
                      <div class="card">
                        <div class="card-body text-center">
                          <div class="row">
                            <div class="col-4 p-0">
                              <img src="<?php echo $producto->PRODUCTO_IMAGEN;  ?>" class="img-fluid" alt="">
                            </div>
                            <div class="col-8 p-3">
                              <h6><?php echo $producto->PRODUCTO_NOMBRE;  ?></h6>
                              <p style="font-size:0.8em;" class="mb-1"><?php echo $producto->PRODUCTO_DETALLES;  ?></p>
                              <?php if(!empty($pedido['PEDIDO_COMENTARIOS'])){ ?>
                                <?php $mi_calificacion= $this->CalificacionesModel->ya_calificado($producto->ID_PRODUCTO,$_SESSION['usuario']['id']); ?>
                                <?php if(!empty($mi_calificacion)){ ?>
                                <h6 class="mt-0 mb-1"><?php echo $mi_calificacion['USUARIO_NOMBRE'].' '.$mi_calificacion['USUARIO_APELLIDOS']; ?></h6>
                                <div class="d-flex border-top border-bottom py-3">
                                  <?php $estrellas = $mi_calificacion['CALIFICACION_ESTRELLAS']; $estrellas_restan= 5-$estrellas; ?>
                                  <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                                    <i class="fa fa-star"></i>
                                  <?php } ?>
                                  <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                                    <i class="far fa-star"></i>
                                  <?php } ?>
                                </div>
                                <p><?php echo $mi_calificacion['CALIFICACION_COMENTARIO']; ?></p>
                                <?php }?>
                              <?php }else{ ?>
                                <label for=""><b>Califica este producto</b></label>
                                <div class="multi_estrellas" >
                                <input type="hidden" name="EstrellasCalificacion[<?php echo $producto->ID_PRODUCTO; ?>]" value="1">
                                </div>
                              <?php } ?>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="row m-0 mt-4 border-top pt-4">
                    <?php if(!empty($pedido['PEDIDO_COMENTARIOS'])){ ?>
                      <div class="col-12 text-center">
                        <h4> <i class="fa fa-comment"></i> <?php echo $pedido['PEDIDO_COMENTARIOS']; ?></h4>
                      </div>
                    <?php }else{ ?>
                      <div class="col-9">
                        <div class="form-group">
                          <textarea name="Comentario" rows="8" class="form-control" placeholder="Comentarios"></textarea>
                        </div>
                      </div>
                      <div class="col-3">
                        <button type="submit" class="btn btn-block btn-success" name="button">Calificar <i class="fa fa-check"></i> </button>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
