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
        <div class="card-header d-flex justify-content-between">
          <h2 class="h5 mb-0 pt-1"> <span class="fa fa-box"></span> Tus Productos</h2>
          <a href="<?php echo base_url('usuario/productos/crear'); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span></a>
        </div>
        <div class="card-body pb-1">
          <form class="form-inline" action="<?php echo base_url('usuario/productos/busqueda');?>" method="get">
            <div class="input-group">
              <input type="text" class="form-control" id="Busqueda" name="Busqueda" placeholder="Buscar">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" type="submit"><span class="fa fa-search"></span></button>
                </div>
              </div>
          </form>
        </div>
        <hr>
        <?php foreach($productos as $producto){ ?>
        <div class="card">
          <div class="card-body">
            <h3 class="h6"><strong>Nombre:</strong> <?php echo $producto->PRODUCTO_NOMBRE; ?></h3>
            <h3 class="h6"><strong>SKU:</strong> <?php echo $producto->PRODUCTO_SKU; ?></h3>
            <h3 class="h6"><strong>Cantidad:</strong> <?php echo $producto->PRODUCTO_CANTIDAD; ?></h3>
            <h3 class="h6"><strong>Precio:</strong> $<?php echo $producto->PRODUCTO_PRECIO; ?></h3>
            <?php
              switch ($producto->PRODUCTO_ESTADO) {
                case 'activo':
                  echo '<p class="text-success">Publicado</p>';
                  break;
                case 'inactivo':
                  echo '<p class="text-danger">Borrador</p>';
                  break;
              }
            ?>
            <div class="btn-group float-right">
              <a href="<?php echo base_url('usuario/productos/actualizar?id='.$producto->ID_PRODUCTO); ?>" class="btn btn-sm btn-warning" title="Editar Producto"> <span class="fa fa-pencil-alt"></span> </a>
              <button data-enlace='<?php echo base_url('usuario/productos/borrar?id='.$producto->ID_PRODUCTO); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Dirección"> <span class="fa fa-trash"></span> </button>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>

    </div>
  </div>
</div>
