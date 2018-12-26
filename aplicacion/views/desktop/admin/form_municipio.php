<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-globe-americas"></span> Nuevo Municipio</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/estados/crear').'?pais='.$_GET['pais']; ?>" method="post">
            <input type="hidden" name="IdPais" value="<?php echo $_GET['pais']; ?>">
            <input type="hidden" name="NombreEstado" value="<?php echo $_GET['estado']; ?>">
            <div class="form-group">
              <label for="NombreEstado">Nombre</label>
              <input type="text" class="form-control" name="NombreEstado" id="NombreEstado" placeholder="" required value="<?=!form_error('NombreEstado')?set_value('NombreEstado'):''?>">
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="MunicipioEstado" id="MunicipioEstado" checked>
              <label class="custom-control-label" for="MunicipioEstado">Activar</label>
              <small class="text-info"> <span class="fa fa-info-circle"></span> Si se activa el Municipio estará disponible en todo el sistema</small>
            </div>
            <hr>
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
