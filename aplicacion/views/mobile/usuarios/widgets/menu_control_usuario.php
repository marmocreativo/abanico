<div class="fila">
  <div class="pt-3 pb-2 text-center">
    <img class="img-fluid img-thumbnail rounded-circle" style="width:50px" src="http://localhost/abanico-master/assets/global/img/usuario_default.png" alt="">
    <h2 class="h6 my-1 text-capitalize"><?php  echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?></h2>
  </div>
  <div class="card mb-2">
    <button class="btn btnFiltros btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      <i class="fas fa-sliders-h mr-2"></i>Panel de administración
    </button>
    <div class="collapse" id="collapseExample">
      <div class="list-group">
        <a href="<?php echo base_url('usuario/');?>" class="list-group-item list-group-item-action"> <span class="fa fa-tachometer-alt"></span> Escritorio</a>
        <a href="<?php echo base_url('usuario/pedidos');?>" class="list-group-item list-group-item-action"> <span class="fa fa-shopping-bag"></span> Mis Pedidos</a>
        <a href="<?php echo base_url('usuario/actualizar');?>" class="list-group-item list-group-item-action"> <span class="fa fa-id-card"></span> Mi Perfil</a>
        <a href="<?php echo base_url('usuario/perfil_servicios');?>" class="list-group-item list-group-item-action"> <span class="fa fa-user-tie"></span> Mis Servicios</a>
        <a href="<?php echo base_url('usuario/tienda');?>" class="list-group-item list-group-item-action"> <span class="fa fa-store"></span> Mi Tienda</a>
      </div>
    </div>
  </div>
</div>
