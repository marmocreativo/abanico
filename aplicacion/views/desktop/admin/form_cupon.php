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
            <h1 class="h5"> <span class="fa fa-ticket-alt"></span> Nuevo Cupón</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/cupones/crear'); ?>" method="post">
            <div class="form-group">
              <label for="Codigo">Código</label>
              <input type="text" class="form-control" name="Codigo" id="Codigo" placeholder="" required value="<?=!form_error('Codigo')?set_value('Codigo'):''?>">
            </div>
            <div class="form-group">
              <label for="Productos">Productos</label>
              <select class="form-control" name="Productos" id="Productos">
                <option value="todos">Todos los productos</option>
                <option value="abanico">Solo Abanico</option>
              </select>
            </div>
            <div class="form-group">
              <label for="TipoDescuento">Tipo Descuento</label>
              <select class="form-control" name="TipoDescuento" id="TipoDescuento">
                <option value="porcentaje">Porcentaje</option>
                <option value="importe">Importe (En pesos)</option>
              </select>
            </div>
            <div class="form-group">
              <label for="Descuento">Descuento</label>
              <input type="text" class="form-control" name="Descuento" id="Descuento" placeholder="" required value="<?=!form_error('Descuento')?set_value('Descuento'):''?>">
            </div>
            <div class="form-group">
              <label for="ImporteMinimo">Importe Mínimo</label>
              <input type="text" class="form-control" name="ImporteMinimo" id="ImporteMinimo" placeholder="" required value="<?=!form_error('ImporteMinimo')?set_value('ImporteMinimo'):''?>">
            </div>
            <div class="form-group">
              <label for="FechaInicio">Fecha de Inicio</label>
              <input type="datetime-local" class="form-control" name="FechaInicio" id="FechaInicio" placeholder="" required value="<?=!form_error('FechaInicio')?set_value('FechaInicio'):''?>">
            </div>
            <div class="form-group">
              <label for="FechaFinal">Fecha Final</label>
              <input type="datetime-local" class="form-control" name="FechaFinal" id="FechaFinal" placeholder="" required value="<?=!form_error('FechaFinal')?set_value('FechaFinal'):''?>">
            </div>
            <div class="form-group">
              <label for="LimitePorUsuario">Limite por usuario</label>
              <input type="text" class="form-control" name="LimitePorUsuario" id="LimitePorUsuario" placeholder="" required value="<?=!form_error('LimitePorUsuario')?set_value('LimitePorUsuario'):''?>">
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
