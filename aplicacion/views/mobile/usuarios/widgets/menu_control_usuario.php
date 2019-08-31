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
        <a href="<?php echo base_url('usuario/');?>" class="list-group-item list-group-item-action text-primary-12"> <span class="fa fa-tachometer-alt"></span> <?php echo $this->lang->line('usuario_menu_escritorio'); ?></a>
        <a href="<?php echo base_url('usuario/pedidos');?>" class="list-group-item list-group-item-action text-primary-7"> <span class="fa fa-shopping-bag"></span> <?php echo $this->lang->line('usuario_menu_pedidos'); ?></a>
        <a href="<?php echo base_url('usuario/actualizar');?>" class="list-group-item list-group-item-action text-primary-8"> <span class="fa fa-id-card"></span> <?php echo $this->lang->line('usuario_menu_perfil'); ?></a>
        <a href="<?php echo base_url('usuario/tienda');?>" class="list-group-item list-group-item-action text-primary-11"> <span class="fa fa-store"></span> <?php echo $this->lang->line('usuario_menu_vendedor'); ?></a>
        <a href="<?php echo base_url('usuario/perfil_servicios');?>" class="list-group-item list-group-item-action text-primary-3"> <span class="fa fa-user-tie"></span> <?php echo $this->lang->line('usuario_menu_servicios'); ?></a>
      </div>
    </div>
  </div>
</div>
