
  <div class="row">
    <div class="col mt-3">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-globe-americas"></span> Países</h1>
          </div>
          <div class="formulario">
            <form class="form-inline" action="<?php echo base_url('admin/paises/busqueda');?>" method="get">
              <div class="form-group">
                <label for="Busqueda" class="sr-only">Busqueda</label>
                <input type="text" class="form-control" id="Busqueda" name="Busqueda" placeholder="Buscar">
              </div>
              <button type="submit" class="btn btn<?php echo $primary ?>"> <span class="fa fa-search"></span> </button>
            </form>
          </div>
          <div class="opciones d-flex">
            <div class="btn-group btn-sm">
              <a href="<?php echo base_url('admin/paises/crear'); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nuevo Pais </a>
            </div>

          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-hover table-striped">
            <thead class="text-light bg<?php echo $primary; ?>">
              <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Iso</th>
                <th class="text-center">Estado</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($paises as $pais){ ?>
              <tr>
                <td class="text-center"><?php echo $pais->PAIS_NOMBRE; ?></td>
                <td class="text-center"><?php echo $pais->PAIS_ISO; ?></td>
                <td class="text-center">
                  <?php if($pais->PAIS_ESTADO=='activo'){ ?>
                    <a href="<?php echo base_url('admin/paises/activar')."?id=".$pais->ID_PAIS."&estado=".$pais->PAIS_ESTADO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                  <?php }else{ ?>
                    <a href="<?php echo base_url('admin/paises/activar')."?id=".$pais->ID_PAIS."&estado=".$pais->PAIS_ESTADO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('admin/estados')."?pais=".$pais->ID_PAIS; ?>" class="btn btn-sm btn-success"> <span class="fa fa-globe-americas"></span> Estados</a>
                    <a href="<?php echo base_url('admin/paises/actualizar')."?id=".$pais->ID_PAIS; ?>" class="btn btn-sm btn-warning"> <span class="fa fa-pencil-alt"></span> </a>
                    <a href="<?php echo base_url('admin/paises/borrar')."?id=".$pais->ID_PAIS; ?>" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></a>
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
