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
          <a href="" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span></a>
        </div>
        <div class="card-body pb-1">
          <form class="form-inline" action="http://localhost/abanico-master/usuario/productos/busqueda" method="get">
            <div class="input-group">
              <input type="text" class="form-control" id="Busqueda" name="Busqueda" placeholder="Buscar">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" type="submit"><span class="fa fa-search"></span></button>
                </div>
              </div>
          </form>
        </div>
        <hr>
        <div class="card-body">
          <h3 class="h6"><strong>Nombre:</strong> Lorem ipsum dolor</h3>
          <!-- <p>Lorem ipsum dolor</p> -->
          <h3 class="h6"><strong>SKU:</strong> Lorem ipsum</h3>
          <!-- <p>Lorem ipsum</p> -->
          <h3 class="h6"><strong>Cantidad:</strong> 1</h3>
          <!-- <p>1</p> -->
          <h3 class="h6"><strong>Precio:</strong> $123.00</h3>
          <!-- <p>$123.00</p> -->
          <div class="btn-group float-right">
            <a href="" class="btn btn-sm btn-warning" title="Editar Dirección"> <span class="fa fa-pencil-alt"></span> </a>
            <button data-enlace="" class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Dirección"> <span class="fa fa-trash"></span> </button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<hr><hr><hr>

<!-- termina panel usuario resposivo -->

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
