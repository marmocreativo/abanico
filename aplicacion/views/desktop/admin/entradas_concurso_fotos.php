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
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h2 class="h6 mb-0"> <span class="fa fa-images"></span> Entradas</h2>
          </div>
          <div class="opciones">
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <?php   foreach($entradas_concurso as $entrada){ ?>
            <div class="col-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <img src="<?php echo base_url('contenido/img/publicaciones/'.$entrada->ARCHIVO); ?>" class="img-fluid" alt="">
                </div>
                <div class="card-footer">
                  <p>Marcar como:</p>
                  <div class="btn-group">
                    <?php if($entrada->VALIDO=='si'){ ?>
                    <a href="<?php echo base_url('admin/concursos_foto/validar'); ?>" class="btn btn-sm btn-danger"> NO VALIDO</a>
                    <?php } ?>
                    <?php if($entrada->VALIDO=='no'){ ?>
                    <a href="<?php echo base_url('admin/concursos_foto/validar'); ?>" class="btn btn-sm btn-primary"> VALIDO</a>
                    <?php } ?>
                    <?php if($entrada->VALIDO=='si'){ ?>
                      <?php if($entrada->GANADOR=='no'){ ?>
                      <a href="<?php echo base_url('admin/concursos_foto/ganador'); ?>" class="btn btn-sm btn-success"> GANADOR</a>
                      <?php } ?>
                      <?php if($entrada->GANADOR=='si'){ ?>
                      <a href="<?php echo base_url('admin/concursos_foto/ganador'); ?>" class="btn btn-sm btn-warning"> NO GANADOR</a>
                      <?php } ?>
                  <?php } // Si valido ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          </div>
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
