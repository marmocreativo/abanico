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
              <a href="<?php echo base_url('admin/concursos_foto/crear'); ?>" class="btn btn-success btn-sm"> <span class="fa fa-plus"></span> Nuevo Concurso de Fotos</a>
          </div>
        </div>
        <div class="card-body py-0">
          <table class="table ">
            <thead>
              <tr>
                <th>Titulo</th>
                <th>Descripción</th>
                <th>Cantidad de Ganadores</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($concursos as $concurso){ ?>
              <tr>
                <td><?php echo $concurso->TITULO; ?></td>
                <td><?php echo $concurso->DESCRIPCION; ?> </td>
                <td><?php echo $concurso->CANTIDAD_GANADORES; ?></td>
                <td><?php echo $concurso->FECHA_INICIO; ?></td>
                <td><?php echo $concurso->FECHA_FIN; ?></td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo base_url('admin/concursos_foto/entradas?id='.$concurso->ID); ?>" class="btn btn-sm btn-info" title="Entradas Concurso"> <span class="fa fa-images"></span> </a>
                    <a href="<?php echo base_url('admin/concursos_foto/actualizar?id='.$concurso->ID); ?>" class="btn btn-sm btn-warning" title="Editar Concurso"> <span class="fa fa-pencil-alt"></span> </a>
                    <button data-enlace='<?php echo base_url('admin/concursos_foto/borrar?id='.$concurso->ID); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Concurso"> <span class="fa fa-trash"></span> </button>
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