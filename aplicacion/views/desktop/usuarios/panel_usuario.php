<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid MT-3">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <?php retro_alimentacion(); ?>
          <div class="row no-gutters" id="dash-1">
              <div class="col-12 justify-content-left cont-perfil">
                  <img src="<?php echo base_url('assets/global/img/usuario_default.png') ?>" class="img-thumbnail rounded-circle foto-perfil-usuario ml-2" alt="">
                  <h3><?php  echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?></h3>
              </div>
            <div class="col-6">
              <a href="<?php echo base_url('usuario/pedidos'); ?>" class="text-dark">
              <div class="card">
                <div class="card-body text-primary">
                  <div class="row">
                    <div class="col">
                      <h6><i class="fa fa-shopping-bag text-primary-7" aria-hidden="true"></i> Historial de pedido </h6>
                      <strong class="border-primary-7"><?php echo $conteo_pedidos; ?> Compras</strong>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="col-6">
              <a href="<?php echo base_url('usuario/mensajes'); ?>" class="text-dark">
              <div class="card">
                <div class="card-body text-primary">
                  <div class="row">
                    <div class="col">
                      <h6><i class="fa fa-envelope" aria-hidden="true"></i> Bandeja de entrada</h6>
                      <strong class="border-primary"><?php echo $conteo_mensajes; ?> Conversaciones</strong>
                      <strong class="border-warning"><?php echo $no_leidos; ?> Pendientes</strong>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div>
          <div class="row mt-3" id="dash-2">
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

                <a href="<?php echo base_url('usuario/tienda'); ?>" class="">
                  <div class="card border border-primary-11 card-p-usuario">
                    <div class="card-body">
                      <div class="row mb-2 no-gutters">
                      <div class="col-4 text-center">
                        <div class="text-primary d-inline-block">
                          <i class="fa fa-store fa-4x mt-3 mb-3 ml-3 mr-3 text-primary-11" aria-hidden="true"></i>
                        </div>
                      </div>
                      <div class="col-8 text-center text-primary">
                        <h5>¿Deseas Vender?</h5>
                        <p>Registrate como Vendedor o como tienda y empieza a vender.</p>
                        <button type="button" class="btn btn-primary btn-block"> Registrarte para vender</button>
                      </div>
                    </div>
                    </div>
                  </div>
                </a>
                <!-- End Blurb -->
              </div>
            <?php } ?>
            <?php if(!empty($perfil)){ ?>
              <div class="col-6">
                <div class="card ">
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
                <a href="<?php echo base_url('usuario/perfil_servicios'); ?>">
                <div class="card border border-primary-3 card-p-usuario">
                  <div class="card-body">
                    <div class="row mb-2 no-gutters">
                      <div class="col-4 text-center">
                        <div class="text-primary d-inline-block">
                          <i class="fa fa-user-tie fa-4x mt-3 mb-3 ml-3 mr-3 text-primary-3" aria-hidden="true"></i>
                        </div>
                      </div>
                      <div class="col-8 text-center text-primary">
                        <h5>¿Deseas ofrecer un Servicio?</h5>
                        <p>Crea un perfil y empieza a ofrecer tus trabajos.</p>
                        <button type="button" class="btn btn-primary btn-block"> Crear perfil </button>
                      </div>
                    </div>
                  </div>
                </div>
                </a>
                <!-- End Blurb -->
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
