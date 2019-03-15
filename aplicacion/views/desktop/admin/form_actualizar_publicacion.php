  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5> <i class="fa fa-file"></i> Actualizar Publicación</h5>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/publicaciones/actualizar');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="TipoPublicacion" value="<?php echo $publicacion['PUBLICACION_TIPO']; ?>">
            <input type="hidden" name="Identificador" value="<?php echo $publicacion['ID_PUBLICACION']; ?>">
            <input type="hidden" name="UrlPublicacion" value="<?php echo $publicacion['PUBLICACION_URL']; ?>">
            <input type="hidden" name="ImagenPublicacionAnterior" value="<?php echo $publicacion['PUBLICACION_IMAGEN']; ?>">
            <div class="row">
              <div class="col-9">
                <div class="form-group">
                  <label for="TituloPublicacion">Título </label>
                  <input type="text" name="TituloPublicacion" class="form-control" value="<?php echo $publicacion['PUBLICACION_TITULO']; ?>">
                </div>
                <div class="form-group">
                  <label for="ResumenPublicacion">Resumen de la publicación</label>
                  <textarea id="ResumenPublicacion" name="ResumenPublicacion" class="form-control" rows="5"><?php echo $publicacion['PUBLICACION_RESUMEN']; ?> </textarea>
                </div>
                <div class="form-group">
                  <label for="ContenidoPublicacion">Contenido de la publicación</label>
                  <textarea id="ContenidoPublicacion" name="ContenidoPublicacion" class="form-control Editor" rows="5"><?php echo $publicacion['PUBLICACION_CONTENIDO']; ?></textarea>
                </div>
              </div>
              <div class="col-3">
                <img src="<?php echo base_url('contenido/img/publicaciones/'.$publicacion['PUBLICACION_IMAGEN']) ?>" id="PrevisualizarImagen" alt="" class="img-fluid img-thumbnail rounded">
                <hr>
                <div class="form-group">
                  <label for="ImagenPublicacion"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                  <input type="file" class="form-control" id="ImagenPublicacion" name="ImagenPublicacion">
                </div>
                <div class="form-group">
                  <label for="EstadoPublicacion">Estado de la publicacion</label>
                  <select class="form-control" id="EstadoPublicacion" name="EstadoPublicacion" placeholder="">
                    <option value="activo" <?php if($publicacion['PUBLICACION_ESTADO']=='activo'){ echo 'selected'; } ?>>Publicado</option>
                    <option value="inactivo" <?php if($publicacion['PUBLICACION_ESTADO']=='inactivo'){ echo 'selected'; } ?>>Borrador</option>
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
