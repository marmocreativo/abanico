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
            <?php $i=0;  foreach($entradas_concurso as $entrada){  if($entrada->GANADOR=='si'){ $i++; } ?>
            <div class="col-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <img src="<?php echo base_url('contenido/img/publicaciones/'.$entrada->ARCHIVO); ?>" class="img-fluid" <?php if($entrada->VALIDO=='no'){ ?> style="-webkit-filter: grayscale(100%) blur(10px); filter: grayscale(100%) blur(10px);" <?php } ?> alt="">
                </div>
                <div class="card-footer">
                  <p>Marcar como:</p>
                  <div class="btn-group d-flex justify-content-between">
                    <?php if($entrada->GANADOR=='no'){ ?>
                    <?php if($entrada->VALIDO=='si'){ ?>
                    <a href="<?php echo base_url('admin/concursos_foto/validar?id='.$entrada->ID.'&id_concurso='.$entrada->ID_CONCURSO.'&valido='.$entrada->VALIDO); ?>" class="btn btn-sm btn-danger"> NO VALIDO</a>
                    <?php } ?>
                    <?php if($entrada->VALIDO=='no'){ ?>
                    <a href="<?php echo base_url('admin/concursos_foto/validar?id='.$entrada->ID.'&id_concurso='.$entrada->ID_CONCURSO.'&valido='.$entrada->VALIDO); ?>" class="btn btn-sm btn-primary"> VALIDO</a>
                    <?php } ?>
                  <?php } // No ganador ?>
                    <?php if($entrada->VALIDO=='si'){?>
                      <?php if($entrada->GANADOR=='no'&&$concurso['CANTIDAD_GANADORES']>$i){ ?>
                      <a href="<?php echo base_url('admin/concursos_foto/ganador?id='.$entrada->ID.'&id_concurso='.$entrada->ID_CONCURSO.'&ganador='.$entrada->GANADOR); ?>" class="btn btn-sm btn-success"> GANADOR</a>
                      <?php } ?>
                      <?php if($entrada->GANADOR=='si'){ ?>
                      <a href="<?php echo base_url('admin/concursos_foto/ganador?id='.$entrada->ID.'&id_concurso='.$entrada->ID_CONCURSO.'&ganador='.$entrada->GANADOR); ?>" class="btn btn-sm btn-warning"> NO GANADOR</a>
                      <?php } ?>
                  <?php } // Si valido ?>
                  </div>
                </div>
                <?php if($entrada->GANADOR=='si'){ ?>
                  <div style="display:block; position:absolute; top:0; right:0;" class="p-3"> <span class="fas fa-award text-warning" style="font-size:50px;"></span> </div>
                <?php } ?>
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
