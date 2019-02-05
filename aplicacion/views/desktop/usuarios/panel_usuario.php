<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid MT-3">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <?php retro_alimentacion(); ?>
          <div class="row">
              <div class="col-12 justify-content-left cont-perfil ml-3">
                  <img src="<?php echo base_url('assets/global/img/usuario_default.png') ?>" class="img-thumbnail rounded-circle foto-perfil-usuario" alt="">
                  <h3><?php  echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?></h3>
              </div>
            <div class="col-6">
              <a href="<?php echo base_url('usuario/pedidos'); ?>" class="text-dark">
              <div class="card">
                <div class="card-body bg-primary text-white">
                  <div class="row">
                    <div class="col">
                      <h4><i class="fa fa-shopping-bag" aria-hidden="true"></i> Historial de pedido </4>
                      <h5 class="card-title"><?php echo $conteo_pedidos; ?> Compras</h5>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="col-6">
              <a href="<?php echo base_url('usuario/mensajes'); ?>" class="text-dark">
              <div class="card">
                <div class="card-body bg-primary text-white">
                  <div class="row">
                    <div class="col">
                      <h4><i class="fa fa-envelope" aria-hidden="true"></i> Bandeja de entrada</h4>
                      <h5 class="card-title"><?php echo $conteo_mensajes; ?> Mensajes</h5>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div>
          <div class="row">
            <?php if(!empty($tienda)){ ?>
              <div class="col-6">
                <div class="card">
                  <div class="card-body bg-primary text-white">
                    <div class="row">
                      <div class="col">
                        <i class="fa fa-box fa-3x" aria-hidden="true"></i>
                      </div>
                      <div class="col">
                        <h2 class="card-title"><?php echo $conteo_productos; ?></h2>
                          <h5>Productos</h5>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <a href="<?php echo base_url('usuario/productos'); ?>" class="text-dark">Lista de productos <i class="fa fa-arrow-right float" aria-hidden="true"></i></a>
                  </div>
                </div>
              </div>
            <?php }else{ ?>
              <div class="col-6">
                <!-- Start Blurb -->
                <div class="row mb-2">
                    <div class="col text-center">
                        <div class="text-primary d-inline-block">
                            <i class="fa fa-store fa-4x mt-3 mb-3 ml-3 mr-3 text-primary-11" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center text-primary">
                        <strong>¿Deseas Vender?</strong><br>
                        <p>Registrate como Vendedor o como tienda y empieza a vender.</p>
                        <a href="<?php echo base_url('usuario/tienda'); ?>" class="btn btn-lg btn-outline-primary-11 btn-block"> <i class="fa fa-pencil-alt"></i> Registrarte para vender</a>
                    </div>
                </div>
                <!-- End Blurb -->
              </div>
            <?php } ?>
            <?php if(!empty($perfil)){ ?>
              <div class="col-6">
                <div class="card">
                  <div class="card-body bg-primary text-white">
                    <div class="row">
                      <div class="col">
                        <i class="fa fa-tools fa-3x" aria-hidden="true"></i>
                      </div>
                      <div class="col">
                        <h2 class="card-title"><?php echo $conteo_servicios; ?></h2>
                          <h5>Servicios</h5>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <a href="<?php echo base_url('usuario/servicios'); ?>" class="text-dark">Lista de servicios <i class="fa fa-arrow-right float" aria-hidden="true"></i></a>
                  </div>
                </div>
              </div>
            <?php }else{ ?>
              <div class="col-6">
                <!-- Start Blurb -->
                <div class="row mb-2">
                    <div class="col text-center">
                        <div class="text-primary d-inline-block">
                            <i class="fa fa-user-tie fa-4x mt-3 mb-3 ml-3 mr-3 text-primary-3" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center text-primary">
                        <strong>¿Deseas ofrecer un Servicio?</strong><br>
                        <p>Crea un perfil y empieza a ofrecer tus trabajos.</p>
                        <a href="<?php echo base_url('usuario/perfil_servicios'); ?>" class="btn btn-lg btn-outline-primary-3 btn-block"> <i class="fa fa-pencil-alt"></i> Crear perfil</a>
                    </div>
                </div>
                <!-- End Blurb -->
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
