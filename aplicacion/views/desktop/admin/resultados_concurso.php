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
            <h2 class="h6 mb-0"> <span class="fa fa-map-marker-alt"></span> Concursos</h2>
          </div>
          <div class="opciones">
              <a href="<?php echo base_url('admin/concursos'); ?>" class="btn btn-success btn-sm"> <span class="fa fa-chevron-left"></span> Volver a la lista de concursos</a>
          </div>
        </div>
        <div class="card-body py-0">
          <div class="row py-3">
            <?php foreach($concursantes as $concursante){ ?>
              <div class="col-12 col-md-6">
                <div class="p-2 border border-primary mb-3">
                  <?php $datos_concursante = $this->UsuariosModel->detalles($concursante->ID_USUARIO); ?>
                  <h5><?php echo $datos_concursante['USUARIO_NOMBRE'].' '.$datos_concursante['USUARIO_APELLIDOS']; ?></h5>
                  <p>Correo: <a href="mailto:<?php echo $datos_concursante['USUARIO_CORREO']; ?>"><?php echo $datos_concursante['USUARIO_CORREO']; ?></a> </p>
                  <p>Teléfono: <a href="tel:<?php echo $datos_concursante['USUARIO_TELEFONO']; ?>"><?php echo $datos_concursante['USUARIO_TELEFONO']; ?></a> </p>
                  <?php $historial = $this->ConcursosModel->historial($_GET['id'],$concursante->ID_USUARIO); ?>
                  <h5>Historial de movimientos</h5>
                  <ul class="list">
                    <?php foreach($historial as $movimiento){ ?>
                    <li><b><?php echo $movimiento->MOVIMIENTO; ?></b> | <?php echo date('h:i:s', strtotime($movimiento->FECHA_REGISTRO)); ?></li>
                  <?php } ?>
                  </ul>
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
