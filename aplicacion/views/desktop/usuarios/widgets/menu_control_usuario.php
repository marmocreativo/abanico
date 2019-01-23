<div class="row justify-content-center">
  <div class="col-8 col-md-6">
      <img src="<?php echo base_url('assets/global/img/usuario_default.png') ?>" class="img-fluid img-thumbnail rounded-circle mx-auto" alt="">
  </div>
</div>
<div class="row">
  <div class="col text-center">
    <h2 class="h6"><?php  echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?></h2>
  </div>
</div>
<div class="list-group">
  <a href="<?php echo base_url('usuario/');?>" class="list-group-item list-group-item-action"> <span class="fa fa-tachometer-alt"></span> Escritorio</a>
  <a href="<?php echo base_url('usuario/pedidos');?>" class="list-group-item list-group-item-action"> <span class="fa fa-shopping-bag"></span> Mis Pedidos</a>
  <a href="<?php echo base_url('usuario/actualizar');?>" class="list-group-item list-group-item-action"> <span class="fa fa-id-card"></span> Mi Perfil</a>
  <a href="<?php echo base_url('usuario/tienda');?>" class="list-group-item list-group-item-action"> <span class="fa fa-store"></span> Vendedor</a>
  <a href="<?php echo base_url('usuario/perfil_servicios');?>" class="list-group-item list-group-item-action"> <span class="fa fa-user-tie"></span> Mis Servicios</a>
</div>
