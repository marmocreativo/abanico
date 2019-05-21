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
            <div class="titulo d-flex align-items-center">
              <h1 class="h6"> <span class="fa fa-user"></span> Sliders</h1>
            </div>
            <div class="formulario d-flex align-items-center">
              <form class="form-inline" action="<?php echo base_url('admin/sliders/busqueda');?>" method="get">
                <div class="form-group">
                  <label for="Busqueda" class="sr-only">Busqueda</label>
                  <input type="text" class="form-control form-control-sm" id="Busqueda" name="Busqueda" placeholder="Buscar">
                </div>
                <button type="submit" class="btn btn<?php echo $primary ?> btn-sm"> <span class="fa fa-search"></span> </button>
              </form>
            </div>
            <div class="opciones d-flex align-items-center">
              <div class="btn-group btn-sm">
                <a href="<?php echo base_url('admin/sliders/crear'); ?>" class="btn btn-success btn-sm"> <span class="fa fa-plus"></span> Nuevo Slide </a>
              </div>

            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover table-striped">
              <thead class="text-light bg<?php echo $primary; ?>">
                <tr>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Ancho</th>
                  <th class="text-center">Alto</th>
                  <th class="text-center">Ancho Movil</th>
                  <th class="text-center">Alto Movil</th>
                  <th class="text-center">Lenguaje</th>
                  <th class="text-center">Estado</th>
                  <th class="text-right">Controles</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($sliders as $slider){ ?>
                <tr>
                  <td class="text-center"><?php echo $slider->SLIDER_NOMBRE; ?></td>
                  <td class="text-center"><?php echo $slider->SLIDER_ANCHO; ?>px</td>
                  <td class="text-center"><?php echo $slider->SLIDER_ALTO; ?>px</td>
                  <td class="text-center"><?php echo $slider->SLIDER_ANCHO_MOVIL; ?>px</td>
                  <td class="text-center"><?php echo $slider->SLIDER_ALTO_MOVIL; ?>px</td>
                  <td class="text-center"><?php echo $slider->SLIDER_LENGUAJE; ?></td>
                  <td class="text-center">
                      <?php if($slider->SLIDER_ESTADO=='activo'){ ?>
                        <a href="<?php echo base_url('admin/sliders/activar')."?id=".$slider->ID_SLIDER."&estado=".$slider->SLIDER_ESTADO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url('admin/sliders/activar')."?id=".$slider->ID_SLIDER."&estado=".$slider->SLIDER_ESTADO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                      <?php } ?>
                  </td>
                  <td class="text-right">
                    <div class="btn-group" role="group">
                      <a href="<?php echo base_url('admin/slides')."?slider=".$slider->ID_SLIDER; ?>" class="btn btn-sm btn-success" title="Ver Slides"> <span class="fa fa-images"></span> Imágenes</a>
                      <a href="<?php echo base_url('admin/sliders/actualizar?id='.$slider->ID_SLIDER); ?>" class="btn btn-sm btn-warning" title="Editar Publicación"> <span class="fa fa-pencil-alt"></span> </a>
                      <button data-enlace='<?php echo base_url('admin/sliders/borrar?id='.$slider->ID_SLIDER); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Publicación"> <span class="fa fa-trash"></span> </button>
                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
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
