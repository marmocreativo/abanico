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

          <form class="" action="<?php echo base_url('admin/concursos_foto/crear'); ?>" method="post">
            <div class="form-group">
              <label for="Titulo">Titulo</label>
              <input type="text" class="form-control" name="Titulo" id="Titulo" placeholder="" required value="<?=!form_error('Titulo')?set_value('Titulo'):''?>">
            </div>
            <div class="form-group">
              <label for="Descripcion">Descripción / Instrucciones</label>
              <textarea class="form-control" name="Descripcion"  id="Descripcion" rows="8"><?=!form_error('Descripcion')?set_value('Descripcion'):''?></textarea>
            </div>
            <div class="form-group">
              <label for="CantidadGanadores">Cantidad de Ganadores</label>
              <input type="number" class="form-control" name="CantidadGanadores" id="CantidadGanadores" min="1" placeholder="" required value="<?=!form_error('CantidadGanadores')?set_value('CantidadGanadores'):''?>">
            </div>
            <div class="form-group">
              <label for="FechaInicio">Inicio</label>
              <input type="datetime-local" class="form-control" name="FechaInicio" id="FechaInicio" placeholder="" required value="<?=!form_error('FechaInicio')?set_value('FechaInicio'):''?>">
            </div>
            <div class="form-group">
              <label for="FechaFin">Fin</label>
              <input type="datetime-local" class="form-control" name="FechaFin" id="FechaFin" placeholder="" required value="<?=!form_error('FechaFin')?set_value('FechaFin'):''?>">
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
