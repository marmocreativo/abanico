  <div class="row">
    <div class="col">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="titulo d-flex align-items-center">
              <h1 class="h6"> <span class="fa fa-user"></span> Publicaciones</h1>
            </div>
            <div class="opciones d-flex align-items-center">
              <div class="btn-group btn-sm">
                <a href="<?php echo base_url('admin/premios/crear'); ?>" class="btn btn-success btn-sm"> <span class="fa fa-plus"></span> Nuevo Premio </a>
              </div>

            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover table-striped">
              <thead class="text-light bg<?php echo $primary; ?>">
                <tr>
                  <th class="text-center" width="5%">Imagen</th>
                  <th class="text-center">Titulo</th>
                  <th class="text-center">Ganador</th>
                  <th class="text-center">Fecha</th>
                  <th class="text-center">Entregado</th>
                  <th class="text-right">Controles</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($premios as $premio){ ?>
                <tr>
                  <td class="text-center">
                    <img src="<?php echo base_url($op['ruta_imagenes_publicaciones'].$premio->PREMIO_IMAGEN); ?>" alt="" width="100">

                  </td>
                  <td class="text-center"><?php echo $premio->PREMIO_TITULO; ?></td>
                  <?php $ganador = $this->UsuariosModel->detalles($premio->PREMIO_GANADOR); ?>
                  <td class="text-center"><?php echo $ganador['USUARIO_NOMBRE'].' '.$ganador['USUARIO_APELLIDOS']; ?></td>
                  <td class="text-center"><?php echo $premio->PREMIO_FECHA_DISPONIBLE; ?></td>
                  <td class="text-center">
                      <?php if($premio->PREMIO_ESTADO=='entregado'){ ?>
                        <a href="<?php echo base_url('admin/premios/activar')."?id=".$premio->ID_PREMIO."&estado=".$premio->PREMIO_ESTADO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url('admin/premios/activar')."?id=".$premio->ID_PREMIO."&estado=".$premio->PREMIO_ESTADO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                      <?php } ?>
                  </td>
                  <td class="text-right">
                    <div class="btn-group" role="group">
                      <a href="<?php echo base_url('admin/premios/actualizar?id='.$premio->ID_PREMIO); ?>" class="btn btn-sm btn-warning" title="Editar Premio"> <span class="fa fa-pencil-alt"></span> </a>
                      <button data-enlace='<?php echo base_url('admin/premios/borrar?id='.$premio->ID_PREMIO); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Premio"> <span class="fa fa-trash"></span> </button>
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
