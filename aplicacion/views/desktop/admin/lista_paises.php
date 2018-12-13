<div class="contenido_principal">
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 fila fila-gris p-0">
      <?php $this->load->view('desktop/admin/widgets/menu_control_administrador'); ?>
    </div>
    <div class="col">
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
              <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="fa fa-cogs"></span>
              </button>
              <div class="dropdown-menu">
                <!--
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
              -->
              </div>
            </div>

          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm table-hover table-striped">
            <thead class="text-light bg<?php echo $primary; ?>">
              <tr>
                <th class="text-center">id</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Iso</th>
                <th class="text-center">Estado</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($paises as $pais){ ?>
              <tr>
                <td class="text-center"><?php echo $pais->ID_PAIS; ?></td>
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
</div>
</div>
