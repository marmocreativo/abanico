<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <?php retro_alimentacion(); ?>
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="titulo">
                <h2 class="h5 mb-0"> <span class="fa fa-box"></span> Tus Productos</h2>
              </div>
              <div class="formulario">
                <form class="form-inline" action="<?php echo base_url('usuario/productos/busqueda');?>" method="get">
                  <div class="input-group">
                    <input type="text" class="form-control" id="Busqueda" name="Busqueda" placeholder="Buscar">
                      <div class="input-group-append">
                        <button class="btn btn-outline<?php echo $primary ?>" type="submit"><span class="fa fa-search"></span></button>
                      </div>
                    </div>
                </form>
              </div>
              <div class="opciones">
                  <a href="<?php echo base_url('usuario/productos/crear'); ?>" class="btn btn-success"> <span class="fa fa-plus"></span> Nuevo Producto </a>
              </div>
            </div>
            <div class="card-body py-0">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>SKU</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th class="text-right">Controles</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($productos as $producto){ ?>
                  <tr>
                    <td><?php echo $producto->PRODUCTO_NOMBRE; ?></td>
                    <td><?php echo $producto->PRODUCTO_SKU; ?></td>
                    <td><?php echo $producto->PRODUCTO_CANTIDAD; ?></td>
                    <td>$<?php echo $producto->PRODUCTO_PRECIO; ?></td>
                    <td>
                      <div class="btn-group float-right">
                        <a href="<?php echo base_url('usuario/productos/actualizar?id='.$producto->ID_PRODUCTO); ?>" class="btn btn-sm btn-warning" title="Editar Producto"> <span class="fa fa-pencil-alt"></span> </a>
                        <button data-enlace='<?php echo base_url('usuario/productos/borrar?id='.$producto->ID_PRODUCTO); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Producto"> <span class="fa fa-trash"></span> </button>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
