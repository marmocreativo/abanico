<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-globe-americas"></span> Actualizar <?php echo $municipio['MUNICIPIO_NOMBRE']; ?></h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/estados/actualizar').'?pais='.$_GET['pais']; ?>" method="post">
            <input type="hidden" name="IdPais" value="<?php echo $_GET['pais']; ?>">
            <input type="hidden" name="NombreEstado" value="<?php echo $municipio['ESTADO_NOMBRE']; ?>">
            <input type="hidden" name="Identificador" value="<?php echo $municipio['ID_MUNICIPIO']; ?>">
            <div class="form-group">
              <label for="NombreEstado">Nombre</label>
              <input type="text" class="form-control" name="NombreEstado" id="NombreEstado" placeholder="" required value="<?php if(empty(form_error('NombreMunicipio'))){ echo $municipio['MUNICIPIO_NOMBRE']; } else { set_value('NombreMunicipio'); } ?>">
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="EstadoMunicipio" id="EstadoMunicipio" <?php if($municipio['MUNICIPIO_ESTADO']){ echo "checked"; } ?>>
              <label class="custom-control-label" for="EstadoMunicipio">Activar</label>
              <small class="text-info"> <span class="fa fa-info-circle"></span> Si se activa la divisa estará disponible en todo el sistema</small>
            </div>
            <hr>
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
