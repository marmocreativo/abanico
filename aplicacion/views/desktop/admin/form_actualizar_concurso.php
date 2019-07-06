<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
  <div class="kt-container kt-body kt-grid kt-grid--ver" id="kt_body">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

      <!-- begin:: Subheader -->
      <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
        </div>
        <div class="kt-subheader__toolbar">
        </div>
      </div>

      <!-- end:: Subheader -->

      <!-- begin:: Content -->
      <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--Begin::Dashboard 8-->

        <!--Begin::Section-->
        <div class="row mb-3">
          <div class="col-xl-12">

            <!--begin:: Widgets/Trends-->
            <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
              <div class="kt-portlet__body">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-globe-americas"></span> Nuevo Concurso</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/concursos/actualizar'); ?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $concurso['ID']; ?>">
            <div class="form-group">
              <label for="Frase">Frase</label>
              <input type="text" class="form-control" name="Frase" id="Frase" placeholder="" required value="<?php echo $concurso['FRASE']; ?>">
            </div>
            <div class="form-group">
              <label for="Productos">Productos</label>
              <input type="text" class="form-control" name="Productos" id="Productos" placeholder="" required value="<?php echo $concurso['PRODUCTOS']; ?>">
              <small class="text-info"> <span class="fa fa-info-circle"></span> Números de ID separados por espacios</small>
            </div>
            <div class="form-group">
              <label for="FechaInicio">Inicio</label>
              <input type="datetime-local" class="form-control" name="FechaInicio" id="FechaInicio" placeholder="" required value="<?php echo date('c', strtotime($concurso['FECHA_INICIO'])); ?>">
            </div>
            <div class="form-group">
              <label for="FechaFin">Fin</label>
              <input type="datetime-local" class="form-control" name="FechaFin" id="FechaFin" placeholder="" required value="<?php echo date('c', strtotime($concurso['FECHA_FIN'])); ?>">
            </div>
            <div class="form-group">
              <label for="MostrarFrase">Mostrar Frase</label>
              <input type="text" class="form-control" name="MostrarFrase" id="MostrarFrase" placeholder="" required value="<?php echo $concurso['MOSTRAR_FRASE']; ?>">
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

<!--end:: Widgets/Trends-->
</div>
</div>
<!--End::Section-->

<!--End::Dashboard 8-->
</div>

<!-- end:: Content -->
</div>
</div>
</div>
