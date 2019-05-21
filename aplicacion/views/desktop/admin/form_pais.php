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
            <h1 class="h5"> <span class="fa fa-globe-americas"></span> Nuevo País</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/paises/crear'); ?>" method="post">
            <div class="form-group">
              <label for="IsoPais">Código ISO</label>
              <input type="text" class="form-control" name="IsoPais" id="IsoPais" placeholder="" required value="<?=!form_error('IsoPais')?set_value('IsoPais'):''?>">
              <small class="text-info"> <span class="fa fa-info-circle"></span> Código internacional del país 2 letras Ej. MX</small>
            </div>
            <div class="form-group">
              <label for="NombrePais">Nombre</label>
              <input type="text" class="form-control" name="NombrePais" id="NombrePais" placeholder="" required value="<?=!form_error('NombrePais')?set_value('NombrePais'):''?>">
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="EstadoPais" id="EstadoPais" checked>
              <label class="custom-control-label" for="EstadoPais">Activar</label>
              <small class="text-info"> <span class="fa fa-info-circle"></span> Si se activa la Pais estará disponible en todo el sistema</small>
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
