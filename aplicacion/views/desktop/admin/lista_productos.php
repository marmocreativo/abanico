<?php if(isset($_GET['id_usuario'])){ ?>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-four">
              <div class="stat-icon dib">
                  <i class="fa fa-user-tag text-muted"></i>
              </div>
              <div class="stat-content">
                  <div class="text-left dib">
                      <div class="stat-heading">Usuario</div>
                      <div class="stat-text"><?php echo $usuario['USUARIO_NOMBRE'].' '.$usuario['USUARIO_APELLIDOS']; ?></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-four">
              <div class="stat-icon dib">
                  <i class="fa fa-store text-muted"></i>
              </div>
              <div class="stat-content">
                  <div class="text-left dib">
                      <div class="stat-heading">Tienda</div>
                      <div class="stat-text"><?php echo $tienda['TIENDA_NOMBRE']; ?></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h6"> <span class="fa fa-box"></span> Productos</h1>
          </div>
          <div class="formulario">
            <form class="form-inline" action="<?php echo base_url('admin/productos/busqueda');?>" method="get">
              <?php if(isset($_GET['id_usuario'])){ ?>
                <input type="hidden" name="id_usuario" value="<?php echo $_GET['id_usuario']; ?>">
              <?php } ?>
              <div class="form-group">
                <label for="Busqueda" class="sr-only">Busqueda</label>
                <input type="text" class="form-control form-control-sm" id="Busqueda" name="Busqueda" placeholder="Buscar">
              </div>
              <button type="submit" class="btn btn-sm btn<?php echo $primary ?>"> <span class="fa fa-search"></span> </button>
            </form>
          </div>
          <div class="opciones d-flex">
            <div class="btn-group btn-sm">
              <?php if(isset($_GET['id_usuario'])){ ?>
              <a href="<?php echo base_url('admin/productos/crear?id_usuario='.$_GET['id_usuario']); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nuevo Producto </a>
              <?php } ?>
            </div>

          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-hover table-striped">
            <thead class="text-light bg<?php echo $primary; ?>">
              <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Modelo</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Estado</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($productos as $producto){ ?>
              <tr>
                <td class="text-center"><?php echo $producto->PRODUCTO_NOMBRE; ?></td>
                <td class="text-center"><?php echo $producto->PRODUCTO_MODELO; ?></td>
                <td class="text-center">$<?php echo $producto->PRODUCTO_PRECIO; ?> <small>MXN</small></td>
                <td class="text-center">
                  <?php if($producto->PRODUCTO_ESTADO=='activo'){ ?>
                    <a href="<?php echo base_url('admin/productos/activar')."?id=".$producto->ID_PRODUCTO."&estado=".$producto->PRODUCTO_ESTADO."&id_usuario=".$producto->ID_USUARIO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                  <?php }else{ ?>
                    <a href="<?php echo base_url('admin/productos/activar')."?id=".$producto->ID_PRODUCTO."&estado=".$producto->PRODUCTO_ESTADO."&id_usuario=".$producto->ID_USUARIO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('admin/productos/actualizar'."?id=".$producto->ID_PRODUCTO."&tipo_producto=".$tipo_producto); ?>" class="btn btn-sm btn-warning"> <span class="fa fa-pencil-alt"></span> </a>
                    <button data-enlace='<?php echo base_url('admin/productos/borrar')."?id=".$producto->ID_PRODUCTO."&id_usuario=".$producto->ID_USUARIO; ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Producto"> <span class="fa fa-trash"></span> </button>
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
