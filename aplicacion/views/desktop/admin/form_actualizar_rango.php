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
            <h1 class="h5"> <span class="fa fa-truck"></span> Actualizar Rango</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/rangos/actualizar'); ?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $rango['ID']; ?>">
            <input type="hidden" name="IdTransportista" value="<?php echo $rango['ID_TRANSPORTISTA']; ?>">
            <div class="row">
              <div class="col-8">
                <div class="form-group">
                  <label for="PesoMax">Peso Máximo</label>
                  <input type="number" step="0.01" class="form-control" name="PesoMax" id="PesoMax" placeholder="" required value="<?php echo $rango['PESO_MAX'] ?>">
                </div>

                <div class="form-group">
                  <label for="ImporteMin">Importe Mínimo <small>(Importe de productos que debe comprar el usuario)</small></label>
                  <input type="number" step="0.01" class="form-control" name="ImporteMin" id="ImporteMin" placeholder="" required value="<?php echo $rango['IMPORTE_MIN'] ?>">
                </div>
                <div class="form-group">
                  <label for="Importe">Importe <small>(Costo del envio)</small></label>
                  <input type="number" step="0.01" class="form-control" name="Importe" id="Importe" placeholder="" required value="<?php echo $rango['IMPORTE'] ?>">
                </div>
              </div>
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
