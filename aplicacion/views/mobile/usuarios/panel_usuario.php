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
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h2 class="h4"><i class="fa fa-shopping-bag mr-2"></i>12 <small>Compras</small></h2>
        </div>
        <div class="card-footer text-center">
          <a href="http://localhost/abanico-master/usuario/pedidos" class="text-dark">Historial de pedidos <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card mb-4">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h2 class="h4"><i class="fa fa-envelope mr-2"></i>1 <small>Mensajes</small></h2>
        </div>
        <div class="card-footer text-center">
          <a href="http://localhost/abanico-master/usuario/mensajes" class="text-dark">Bandeja de entrada <i class="fa fa-arrow-right float"></i></a>
        </div>
      </div>
    </div>

    <div class="col-12 mb-3">
      <div class="col text-center">
        <i class="fa fa-store text-primary fa-2x mt-3 mb-2"></i>
        <p class="text-dark"><strong>¿Deseas Vender?</strong><br>Registra una tienda y empieza a vender.</p>
        <a href="http://localhost/abanico-master/usuario/tienda" class="btn btn-sm btn-outline-primary btn-block"> <i class="fa fa-pencil-alt"></i> Registrar tienda</a>
      </div>
    </div>

    <div class="col-12 mb-4">
      <div class="col text-center">
        <i class="fa fa-user-tie text-primary fa-2x mt-3 mb-2"></i>
        <p class="text-dark"><strong>¿Deseas ofrecer un Servicio?</strong><br>Crea un perfil y empieza a ofrecer tus trabajos.</p>
        <a href="http://localhost/abanico-master/usuario/perfil_servicios" class="btn btn-sm btn-outline-primary btn-block"> <i class="fa fa-pencil-alt"></i> Crear perfil</a>
      </div>
    </div>

  </div>
</div>

<hr><hr><hr>

<!-- termina panel usuario resposivo -->

<div class="contenido_principal">
  <div class="">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col-12 py-3">
          <?php retro_alimentacion(); ?>
          <div class="row">
            <div class="col-6">

              <div class="card mb-4">
                <div class="card-body bg-primary text-white text-center">
                  <div class="row">
                    <div class="col">
                      <i class="fa fa-shopping-bag fa-3x mb-3" aria-hidden="true"></i>
                    </div>
                    <div class="col">
                      <h2 class="card-title"><?php echo $conteo_pedidos; ?></h2>
                        <h5>Compras</h5>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="<?php echo base_url('usuario/pedidos'); ?>" class="text-dark">Historial de pedidos <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="card mb-4">
                <div class="card-body bg-primary text-white text-center">
                  <div class="row">
                    <div class="col">
                      <i class="fa fa-envelope fa-3x mb-3" aria-hidden="true"></i>
                    </div>
                    <div class="col">
                      <h2 class="card-title"><?php echo $conteo_mensajes; ?></h2>
                        <h5>Mensajes</h5>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="<?php echo base_url('usuario/mensajes'); ?>" class="text-dark">Bandeja de entrada <i class="fa fa-arrow-right float" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
            <?php if(!empty($tienda)){ ?>
              <div class="col-12 mb-4">
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
              <div class="col-12 mb-4">
                <!-- Start Blurb -->
                <div class="row mb-2">
                    <div class="col text-center">
                        <div class="text-primary d-inline-block">
                            <i class="fa fa-store fa-4x mt-3 mb-3 ml-3 mr-3" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <strong>¿Deseas Vender?</strong><br>
                        <p>Registra una tienda y empieza a vender.</p>
                        <a href="<?php echo base_url('usuario/tienda'); ?>" class="btn btn-outline-primary btn-block"> <i class="fa fa-pencil-alt"></i> Registrar tienda</a>
                    </div>
                </div>
                <!-- End Blurb -->
              </div>
            <?php } ?>
            <?php if(!empty($perfil)){ ?>
              <div class="col-12 mb-4">
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
              <div class="col-12 mb-4">
                <!-- Start Blurb -->
                <div class="row mb-2">
                    <div class="col text-center">
                        <div class="text-primary d-inline-block">
                            <i class="fa fa-user-tie fa-4x mt-3 mb-3 ml-3 mr-3" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <strong>¿Deseas ofrecer un Servicio?</strong><br>
                        <p>Crea un perfil y empieza a ofrecer tus trabajos.</p>
                        <a href="<?php echo base_url('usuario/perfil_servicios'); ?>" class="btn btn-outline-primary btn-block"> <i class="fa fa-pencil-alt"></i> Crear perfil</a>
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
