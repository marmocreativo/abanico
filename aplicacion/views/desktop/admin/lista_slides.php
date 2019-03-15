  <div class="row">
    <div class="col">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="titulo d-flex align-items-center">
              <h1 class="h6"> <span class="fa fa-image"></span> Slides</h1>
            </div>
            <div class="opciones d-flex align-items-center">
              <div class="btn-group btn-sm">
                <a href="<?php echo base_url('admin/slides/crear?id_slider='.$_GET['slider']); ?>" class="btn btn-success btn-sm"> <span class="fa fa-plus"></span> Nuevo Slide </a>
              </div>

            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover table-striped">
              <thead class="text-light bg<?php echo $primary; ?>">
                <tr>
                  <th class="text-center">Imagen</th>
                  <th class="text-center">Imagen Movil</th>
                  <th class="text-center">Titulo</th>
                  <th class="text-center">Enlace</th>
                  <th class="text-center">Estado</th>
                  <th class="text-right">Controles</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($slides as $slide){ ?>
                <tr>
                  <td class="text-center">
                    <img src="<?php echo base_url($op['ruta_imagenes_slider'].'/'.$slide->SLIDE_IMAGEN); ?>" alt="" width="300">
                  </td>
                  <td class="text-center">
                    <img src="<?php echo base_url($op['ruta_imagenes_slider'].'/'.$slide->SLIDE_IMAGEN_MOVIL); ?>" alt="" width="100">
                  </td>
                  <td class="text-center"><?php echo $slide->SLIDE_TITULO; ?></td>
                  <td class="text-center"><?php echo $slide->SLIDE_ENLACE; ?></td>
                  <td class="text-center">
                      <?php if($slide->SLIDE_ESTADO=='activo'){ ?>
                        <a href="<?php echo base_url('admin/slides/activar')."?id=".$slide->ID_SLIDE."&estado=".$slide->SLIDE_ESTADO."&id_slider=".$_GET['slider']; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url('admin/slides/activar')."?id=".$slide->ID_SLIDE."&estado=".$slide->SLIDE_ESTADO."&id_slider=".$_GET['slider']; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                      <?php } ?>
                  </td>
                  <td class="text-right">
                    <div class="btn-group" role="group">
                      <a href="<?php echo base_url('admin/slides/actualizar?id='.$slide->ID_SLIDE); ?>" class="btn btn-sm btn-warning" title="Editar Publicación"> <span class="fa fa-pencil-alt"></span> </a>
                      <button data-enlace='<?php echo base_url('admin/slides/borrar?id='.$slide->ID_SLIDE); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Publicación"> <span class="fa fa-trash"></span> </button>
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
