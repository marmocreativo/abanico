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

      <div class="card mb-3">
        <div class="card-header">
          <h5 class="pt-2"><i class="fa fa-store"></i> Mi Tienda</h5>
        </div>
        <div class="card-body">
          <img class="img-fluid d-block mx-auto mb-3 img-thumbnail rounded-circle" style="width:150px" src="http://localhost/abanico-master/contenido/img/perfiles/completo/default.jpg" alt="">
          <h6><strong>Nombre público</strong></h6>
          <p>tienda abc</p>
          <h6><strong>Razón Social</strong></h6>
          <p>adsfafdasf</p>
          <h6><strong>R.F.C.</strong></h6>
          <p>asdfasdf</p>
          <h6><strong>Teléfono</strong></h6>
          <p>32141</p>
          <h6><strong>Registro</strong></h6>
          <p>2019-01-23 21:50:24</p>
          <h6><strong>Actualización</strong></h6>
          <p>2019-01-23 15:50:24</p>
          <hr>
          <h6><strong>Dirección</strong></h6>
          <p>asdf, adsf, Aguascalientes, , Aguascalientes, 1234, México</p>
        </div>
        <div class="card-footer">
          <a href="http://localhost/abanico-master/usuario/tienda/actualizar" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> Editar</a>
        </div>
      </div>

    </div>

    <div class="col-12 mb-3">
      <div class="card">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h4 class="h5"> <span class="fa fa-box"></span> Productos Minoristas</h4>
        </div>
        <div class="card-footer text-center">
          <a href="http://localhost/abanico-master/usuario/productos">Mi Catálogo de Productos</a>
        </div>
      </div>
    </div>

    <div class="col-12 mb-3">
      <div class="card">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h4 class="h5"> <span class="fa fa-file-invoice-dollar"></span> Ventas</h4>
        </div>
        <div class="card-footer text-center">
          <a href="http://localhost/abanico-master/usuario/ventas">Mis Ventas</a>
        </div>
      </div>
    </div>

  </div>
</div>

<hr><hr><hr>

<!-- termina panel usuario resposivo -->

  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <div class="row">
            <div class="col-8">
              <div class="row">
                <div class="col">
                  <?php retro_alimentacion(); ?>
                  <div class="card">
                    <div class="card-header">
                      <h5> <i class="fa fa-store"></i> Mi Tienda</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="col-3">
                              <img src="<?php echo base_url('contenido/img/tiendas/completo/'.$tienda['TIENDA_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                          </div>
                          <div class="col-9">
                            <table class="table table-sm table-borderless">
                              <tr>
                                <td><b>Nombre Público</b></td>
                                <td><?php echo $tienda['TIENDA_NOMBRE']; ?></td>
                              </tr>
                              <tr>
                                <td><b>Razón Social</b></td>
                                <td><?php echo $tienda['TIENDA_RAZON_SOCIAL']; ?></td>
                              </tr>
                              <tr>
                                <td><b>R.F.C.</b></td>
                                <td><?php echo $tienda['TIENDA_RFC']; ?></td>
                              </tr>
                              <tr>
                                <td><b>Teléfono</b></td>
                                <td><?php echo $tienda['TIENDA_TELEFONO']; ?></td>
                              </tr>
                              <tr>
                                <td><b>Registro</b><br><?php echo $tienda['TIENDA_FECHA_REGISTRO']; ?></td>
                                <td><b>Actualización</b><br><?php echo $tienda['TIENDA_FECHA_ACTUALIZACION']; ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row border-top pt-3">
                          <div class="col">
                            <h6>Dirección Fiscal</h6>
                            <p><?php echo $direccion_formateada; ?></p>
                          </div>
                        </div>
                    </div>
                    <div class="card-footer">
                      <a href="<?php echo base_url('usuario/tienda/actualizar'); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> Editar</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card <?php echo 'border'.$primary; ?> text-center  mb-4">
                <div class="card-header <?php echo 'bg'.$primary; ?> text-white">
                  <h4 class="h5"> <span class="fa fa-box"></span> Productos Minoristas</h4>
                </div>
                <div class="card-body">
                  <a href="<?php echo base_url('usuario/productos');?>">Mi Catálogo de Productos</a>
                </div>
              </div>
              <div class="card <?php echo 'border'.$primary; ?> text-center  mb-4">
                <div class="card-header <?php echo 'bg'.$primary; ?> text-white">
                  <h4 class="h5"> <span class="fa fa-file-invoice-dollar"></span> Ventas</h4>
                </div>
                <div class="card-body">
                  <a href="<?php echo base_url('usuario/ventas');?>">Mis Ventas</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>