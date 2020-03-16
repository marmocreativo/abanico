<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h1>Tienda mayoreo</h1>
        <p>Sistema de administración de pedidos</p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-6 col-md-3 mb-3">
        <a href="<?php echo base_url('tienda-mayoreo/productos'); ?>">
          <div class="sistema_mayoreo bg-primary text-white text-center  py-4">
            <i class="fas fa-shopping-cart fa-3x"></i>
            <h2 class="h4 mt-3">Hacer un pedido nuevo</h2>
          </div>
        </a>
      </div>
      <div class="col-6 col-md-3 mb-3">
        <a href="<?php echo base_url('tienda-mayoreo/lista_pedidos'); ?>">
          <div class="sistema_mayoreo bg-primary text-white text-center  py-4">
            <i class="fas fa-list fa-3x"></i>
            <h2 class="h4 mt-3">Historial de pedidos</h2>
          </div>
        </a>
      </div>
      <div class="col-6 col-md-3 mb-3">
        <a href="<?php echo base_url('tienda-mayoreo/lista_empresas'); ?>">
        <div class="sistema_mayoreo bg-primary text-white text-center  py-4">
          <i class="fas fa-building fa-3x"></i>
          <h2 class="h4 mt-3">Empresas y contactos</h2>
        </div>
        </a>
      </div>
    </div>
  </div>
</div>
