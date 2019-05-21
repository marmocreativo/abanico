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
            <h1 class="h5"> <span class="fa fa-truck"></span> Nuevo Transportista</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/transportistas/crear'); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-8">
                <div class="form-group">
                  <label for="NombreTransportista">Nombre</label>
                  <input type="text" class="form-control" name="NombreTransportista" id="NombreTransportista" placeholder="" required value="<?=!form_error('NombreTransportista')?set_value('NombreTransportista'):''?>">
                </div>
                <div class="form-group">
                  <label for="DescripcionTransportista">Descripción</label>
                  <textarea class="form-control" name="DescripcionTransportista" rows="4" cols="80"><?=!form_error('DescripcionTransportista')?set_value('DescripcionTransportista'):''?></textarea>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="ImagenTransportista" name="ImagenTransportista" placeholder="" value="">
                  <label class="custom-file-label" for="ImagenTransportista">Logo</label>
                </div>
                <div class="form-group">
                  <label for="TiempoEntregaTransportista">Tiempo de entrega <small>Solo como nota de texto</small></label>
                  <input type="text" class="form-control" name="TiempoEntregaTransportista" id="TiempoEntregaTransportista" placeholder="" required value="<?=!form_error('TiempoEntregaTransportista')?set_value('TiempoEntregaTransportista'):''?>">
                </div>
                <div class="form-group">
                  <label for="UrlRastreoTransportista">URL de rastreo</label>
                  <input type="text" class="form-control" name="UrlRastreoTransportista" id="UrlRastreoTransportista" placeholder="" value="<?=!form_error('UrlRastreoTransportista')?set_value('UrlRastreoTransportista'):''?>">
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="EstadoTransportista" id="EstadoTransportista" checked>
                  <label class="custom-control-label" for="EstadoTransportista">Activar</label>
                  <small class="text-info"> <span class="fa fa-info-circle"></span> Si se activa el transportista estará disponible en todo el sistema</small>
                </div>
              </div>
              <div class="col-4">
                <h6> <i class="fa fa-globe-americas mb-2"></i> Disponible en:</h6>
                <div id="accordion">
                    <?php foreach($paises as $pais){ ?>
                  <div class="card">
                    <div class="card-header" id="pais-<?php echo $pais->ID_PAIS ?>">
                      <h5 class="mb-0">
                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?php echo $pais->ID_PAIS ?>" aria-expanded="true" aria-controls="collapse-<?php echo $pais->ID_PAIS ?>">
                          <?php echo $pais->PAIS_NOMBRE; ?> <i class="fa fa-caret-down"></i>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse-<?php echo $pais->ID_PAIS ?>" class="collapse" aria-labelledby="collapse-<?php echo $pais->ID_PAIS ?>" data-parent="#accordion">
                      <div class="card-body">
                        <?php
                          // Obtengo los Estados
                          $estados = $this->EstadosModel->estados_del_pais($pais->ID_PAIS);
                        ?>
                        <div class="form-check border-bottom mb-2 pb-2">
                          <input class="form-check-input control" type="checkbox" name="ControlPais-<?php echo $pais->ID_PAIS; ?>" id="ControlPais-<?php echo $pais->ID_PAIS; ?>" data-controla="estado-<?php echo $pais->ID_PAIS; ?>" indeterminated>
                          <label class="form-check-label" for="ControlPais-<?php echo $pais->ID_PAIS; ?>">
                            Todos
                          </label>
                        </div>
                        <ul class="list-unstyled">
                          <?php foreach($estados as $estado){ ?>
                          <li>
                            <div class="form-check">
                              <input class="form-check-input hijo estado-<?php echo $pais->ID_PAIS; ?>" type="checkbox" data-padre="ControlPais-<?php echo $pais->ID_PAIS; ?>"
                              value="<?php echo $estado->ESTADO_NOMBRE; ?>" name="EstadosDisponible[]" id="estado<?php echo $estado->ID_ESTADO; ?>">
                              <label class="form-check-label" for="estado<?php echo $estado->ID_ESTADO; ?>">
                                <?php echo $estado->ESTADO_NOMBRE; ?>
                              </label>
                            </div>
                          </li>
                        <?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <?php } ?>
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
