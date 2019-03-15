  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5> <i class="fa fa-file"></i> Nueva Publicación</h5>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/publicaciones/crear');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="TipoPublicacion" value="<?php echo $_GET['tipo_publicacion']; ?>">
            <div class="row">
              <div class="col-9">
                <div class="form-group">
                  <label for="TituloPublicacion">Título </label>
                  <input type="text" name="TituloPublicacion" class="form-control" value="<?=!form_error('TituloPublicacion')?set_value('TituloPublicacion'):''?>">
                </div>
                <div class="form-group">
                  <label for="ResumenPublicacion">Resumen de la publicación</label>
                  <textarea id="ResumenPublicacion" name="ResumenPublicacion" class="form-control" rows="5"><?=!form_error('ResumenPublicacion')?set_value('ResumenPublicacion'):''?> </textarea>
                </div>
                <div class="form-group">
                  <label for="ContenidoPublicacion">Contenido de la publicación</label>
                  <textarea id="ContenidoPublicacion" name="ContenidoPublicacion" class="form-control Editor" rows="5"><?=!form_error('ContenidoPublicacion')?set_value('ContenidoPublicacion'):''?> </textarea>
                </div>
              </div>
              <div class="col-3">
                <img src="<?php echo base_url('contenido/img/productos/completo/default.jpg') ?>" id="PrevisualizarImagen" alt="" class="img-fluid img-thumbnail rounded">
                <hr>
                <div class="form-group">
                  <label for="ImagenPublicacion"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                  <input type="file" class="form-control" id="ImagenPublicacion" name="ImagenPublicacion">
                </div>
                <div class="form-group">
                  <label for="EstadoPublicacion">Estado de la publicacion</label>
                  <select class="form-control" id="EstadoPublicacion" name="EstadoPublicacion" placeholder="">
                    <option value="activo" >Publicado</option>
                    <option value="inactivo">Borrador</option>
                  </select>
                </div>
              </div>
              <div class="col">
                 <hr>
                 <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Guardar Publicación</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
