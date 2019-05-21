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
        <div class="card-header">
          <h5> <i class="fa fa-file"></i> Nueva Publicación</h5>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/premios/crear');?>" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-9">
                <div class="form-group">
                  <label for="TituloPremio">Título </label>
                  <input type="text" name="TituloPremio" class="form-control" value="<?=!form_error('TituloPremio')?set_value('TituloPremio'):''?>">
                </div>
                <div class="form-group">
                  <label for="FechaDisponiblePremio">Fecha Disponibilidad </label>
                  <input type="date" name="FechaDisponiblePremio" class="form-control" value="<?=!form_error('FechaDisponiblePremio')?set_value('FechaDisponiblePremio'):''?>">
                </div>
              </div>
              <div class="col-3">
                <img src="<?php echo base_url('contenido/img/publicaciones/default.jpg') ?>" id="PrevisualizarImagen" alt="" class="img-fluid img-thumbnail rounded">
                <hr>
                <div class="form-group">
                  <label for="ImagenPremio"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                  <input type="file" class="form-control" id="ImagenPremio" name="ImagenPremio">
                </div>
                <div class="form-group">
                  <label for="EstadoPremio">Estado de la publicacion</label>
                  <select class="form-control" id="EstadoPremio" name="EstadoPremio" placeholder="">
                    <option value="pendiente" >Pendiente</option>
                    <option value="entregado">Entregado</option>
                  </select>
                </div>
              </div>
              <div class="col">
                 <hr>
                 <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Guardar Premio</button>
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
