<!-- empieza panel usuario resposivo -->

<div class="fila-gris">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('mobile/usuarios/widgets/menu_control_usuario'); ?>
      </div>
    </div>
  </div>
  <?php retro_alimentacion(); ?>
</div>

<div class="container py-3 mb-3">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h2 class="h4"><i class="fa fa-shopping-bag mr-2"></i><?php echo $conteo_pedidos; ?> <small>Compras</small></h2>
        </div>
        <div class="card-footer text-center">
          <a href="<?php echo base_url('usuario/pedidos'); ?>" class="text-dark">Historial de pedidos <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card mb-4">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h2 class="h4"><i class="fa fa-envelope mr-2"></i><?php echo $conteo_mensajes; ?> <small>Mensajes <strong class="border-warning"><?php echo $no_leidos; ?> Nuevos</strong></small> </h2>
        </div>
        <div class="card-footer text-center">
          <a href="<?php echo base_url('usuario/mensajes'); ?>" class="text-dark">Bandeja de entrada <i class="fa fa-arrow-right float"></i></a>
        </div>
      </div>
    </div>
    <?php if(!empty($tienda)){ ?>
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h2 class="h4"><i class="fa fa-box mr-2"></i><?php echo $conteo_productos; ?> <small>Productos</small></h2>
        </div>
        <div class="card-footer text-center">
          <a href="<?php echo base_url('usuario/productos'); ?>" class="text-dark">Lista de productos <i class="fa fa-arrow-right float" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  <?php }else{ ?>
    <div class="col-12 mb-3">
      <div class="col text-center">
        <i class="fa fa-store text-primary fa-2x mt-3 mb-2"></i>
        <p class="text-dark"><strong>Registrate como Vendedor o como tienda y empieza a vender.</p>
        <a href="<?php echo base_url('usuario/tienda'); ?>" class="btn btn-sm btn-outline-primary btn-block"> <i class="fa fa-pencil-alt"></i> Registrar tienda</a>
      </div>
    </div>
  <?php } ?>
  <?php if(!empty($perfil)){ ?>
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h2 class="h4"><i class="fa fa-tools mr-2"></i><?php echo $conteo_servicios; ?> <small>Servicios</small></h2>
        </div>
        <div class="card-footer text-center">
          <a href="<?php echo base_url('usuario/servicios'); ?>" class="text-dark">Lista de servicios <i class="fa fa-arrow-right float" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
<?php }else{ ?>


    <div class="col-12 mb-4">
      <div class="col text-center">
        <i class="fa fa-user-tie text-primary fa-2x mt-3 mb-2"></i>
        <p class="text-dark"><strong>¿Deseas ofrecer un Servicio?</strong><br>Crea un perfil y empieza a ofrecer tus trabajos.</p>
        <a href="<?php echo base_url('usuario/perfil_servicios'); ?>" class="btn btn-sm btn-outline-primary btn-block"> <i class="fa fa-pencil-alt"></i> Crear perfil</a>
      </div>
    </div>
<?php } ?>
  </div>
</div>
