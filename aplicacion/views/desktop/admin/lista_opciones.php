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
            <h1 class="h5"> <span class="fa fa-globe-americas"></span> Estados</h1>
          </div>
          <div class="formulario">
          </div>
          <div class="opciones d-flex">
            <div class="btn-group btn-sm">
              <!--<a href="<?php echo base_url('admin/nueva_opcion'); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nueva Opción </a>-->
            </div>

          </div>
        </div>
        <div class="card-body">
          <?php echo retro_alimentacion(); ?>
        <form class="" action="<?php echo base_url('admin/opciones'); ?>" method="post">
          <div class="row">
              <div class="col-12 col-md-10">
                <?php foreach($lista_opciones as $opcion){ ?>
                  <div class="form-group">
                    <label for="Opciones['<?php echo $opcion->OPCION_NOMBRE ?>']"><?php echo $opcion->OPCION_NOMBRE ?></label>
                    <textarea name="Opciones[<?php echo $opcion->OPCION_NOMBRE ?>]" class="form-control" rows="5" required><?php echo $opcion->OPCION_VALOR ?></textarea>
                  </div>
                <?php } ?>
              </div>
              <div class="col-12 col-md-2">
                <button type="submit" class="btn btn-primary btn-block" name="button"> <i class="fa fa-save"></i> Guardar</button>
              </div>
          </div>
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
