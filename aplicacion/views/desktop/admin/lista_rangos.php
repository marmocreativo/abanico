  <div class="row">
    <div class="col mt-3">
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h6"> <span class="fa fa-truck"></span> Rangos de Precios para <?php echo $transportista['TRANSPORTISTA_NOMBRE'] ?></h1>
          </div>
          <div class="formulario">
            <form class="form-inline" action="<?php echo base_url('admin/transportistas/busqueda');?>" method="get">
              <div class="form-group">
                <label for="Busqueda" class="sr-only">Busqueda</label>
                <input type="text" class="form-control" id="Busqueda" name="Busqueda" placeholder="Buscar">
              </div>
              <button type="submit" class="btn btn<?php echo $primary ?>"> <span class="fa fa-search"></span> </button>
            </form>
          </div>
          <div class="opciones d-flex">
            <div class="btn-group btn-sm">
              <a href="<?php echo base_url('admin/rangos/crear?id_transportista='.$_GET['id_transportista']); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nuevo Rango </a>
            </div>

          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-hover table-striped">
            <thead class="text-light bg<?php echo $primary; ?>">
              <tr>
                <th>Logo</th>
                <th class="text-center">Peso Máximo</th>
                <th class="text-center">Importe Minimo</th>
                <th class="text-center">Importe (Costo)</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($rangos as $rango){ ?>
              <tr>
                <td class="text-center"> <img src="<?php echo base_url($op['ruta_imagenes_transportistas'].$transportista['TRANSPORTISTA_LOGO']); ?>" class="img-thumbnail" width="50" alt=""> </td>
                <td class="text-center"><?php echo $rango->PESO_MAX; ?>Kg</td>
                <td class="text-center">$<?php echo $rango->IMPORTE_MIN; ?></td>
                <td class="text-center">$<?php echo $rango->IMPORTE; ?></td>
                <td class="text-right">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('admin/rangos/actualizar')."?id=".$rango->ID.'&id_transportista='.$transportista['ID_TRANSPORTISTA']; ?>" class="btn btn-sm btn-warning" title="Editar Transportista"> <span class="fa fa-pencil-alt"></span> </a>
                    <button data-enlace='<?php echo base_url('admin/rangos/borrar')."?id=".$rango->ID.'&id_transportista='.$transportista['ID_TRANSPORTISTA']; ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Transportista"> <span class="fa fa-trash"></span> </button>
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
