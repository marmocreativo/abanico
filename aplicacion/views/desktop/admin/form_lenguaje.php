<div class="container">
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-globe-americas"></span> Nuevo Lenguaje</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/lenguajes/crear'); ?>" method="post">
            <div class="form-group">
              <label for="IsoLenguaje">Código ISO</label>
              <input type="text" class="form-control" name="IsoLenguaje" id="IsoLenguaje" placeholder="" required value="<?=!form_error('IsoLenguaje')?set_value('IsoLenguaje'):''?>">
              <small class="text-info"> <span class="fa fa-info-circle"></span> Código internacional del lenguaje 2 letras Ej. es</small>
            </div>
            <div class="form-group">
              <label for="NombreLenguaje">Nombre</label>
              <input type="text" class="form-control" name="NombreLenguaje" id="NombreLenguaje" placeholder="" required value="<?=!form_error('NombreLenguaje')?set_value('NombreLenguaje'):''?>">
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="EstadoLenguaje" id="EstadoLenguaje" checked>
              <label class="custom-control-label" for="EstadoLenguaje">Activar</label>
              <small class="text-info"> <span class="fa fa-info-circle"></span> Si se activa la Lenguaje estará disponible en todo el sistema</small>
            </div>
            <hr>
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
