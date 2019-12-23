<div class="contenido_principal fila py-4 pb-5">
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <h2><?php echo $concurso_activo['TITULO']; ?></h2>
        <p><?php echo $concurso_activo['DESCRIPCION']; ?> </p>
        <hr>
        <div class="row justify-content-center">
          <div class="col-9">
            <?php retro_alimentacion(); ?>
            <form class="" action="<?php echo base_url('concursos_foto/subir'); ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="IdConcurso" value="<?php echo $concurso_activo['ID']; ?>">
              <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
              <div class="form-group">
                <label for="Entrada">Selecciona tu foto</label>
                <input type="file" class="form-control mb-2" name="Entrada" accept="image/x-png,image/gif,image/jpeg" value="" required>
              </div>

              <div class="form-group">
                <label for="Descripcion">¿Deseas añadir una descripción de la foto?</label>
                <textarea name="Descripcion" rows="5" class="form-control mb-2"></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-block" name="button">Subir foto</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
