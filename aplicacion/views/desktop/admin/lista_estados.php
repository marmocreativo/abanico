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
            <form class="form-inline" action="<?php echo base_url('admin/estados/busqueda');?>" method="get">
              <input type="hidden" name="pais" value="<?php echo $_GET['pais']; ?>">
              <div class="form-group">
                <label for="Busqueda" class="sr-only">Busqueda</label>
                <input type="text" class="form-control form-control-sm" id="Busqueda" name="Busqueda" placeholder="Buscar">
              </div>
              <button type="submit" class="btn btn-sm btn<?php echo $primary ?>"> <span class="fa fa-search"></span> </button>
            </form>
          </div>
          <div class="opciones d-flex">
            <div class="btn-group btn-sm">
              <a href="<?php echo base_url('admin/paises'); ?>" class="btn btn-outline-default btn-sm"> <span class="fa fa-chevron-left"></span> volver a paises </a>
              <a href="<?php echo base_url('admin/estados/crear').'?pais='.$_GET['pais']; ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nuevo Estado </a>
            </div>

          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm table-hover table-striped">
            <thead class="text-light bg<?php echo $primary; ?>">
              <tr>
                <th class="text-left">Nombre</th>
                <th class="text-center">Iso</th>
                <th class="text-center">Estado</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($estados as $estado){ ?>
              <tr>
                <td class="text-left"><?php echo $estado->ESTADO_NOMBRE; ?></td>
                <td class="text-center"><?php echo $estado->ESTADO_ISO; ?></td>
                <td class="text-center">
                  <?php if($estado->ESTADO_ESTADO=='activo'){ ?>
                    <a href="<?php echo base_url('admin/estados/activar')."?id=".$estado->ID_ESTADO."&pais=".$estado->ID_PAIS."&estado=".$estado->ESTADO_ESTADO; ?>" class="btn btn-sm btn-outline-success" title="Desactivar Estado"> <span class="fa fa-check-circle"></span> </a>
                  <?php }else{ ?>
                    <a href="<?php echo base_url('admin/estados/activar')."?id=".$estado->ID_ESTADO."&pais=".$estado->ID_PAIS."&estado=".$estado->ESTADO_ESTADO; ?>" class="btn btn-sm btn-outline-danger" title="Activar Estado"> <span class="fa fa-times-circle"></span> </a>
                  <?php } ?>
                </td>
                <td class="text-right">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('admin/municipios')."?pais=".$estado->ID_PAIS.'&estado='.$estado->ESTADO_NOMBRE; ?>" class="btn btn-sm btn-success" title="Ver Municipios"> <span class="fa fa-globe-americas"></span> Municipios</a>
                    <a href="<?php echo base_url('admin/estados/actualizar')."?id=".$estado->ID_ESTADO."&pais=".$estado->ID_PAIS; ?>" class="btn btn-sm btn-warning" title="Editar Estado"> <span class="fa fa-pencil-alt"></span> </a>
                    <!--
                    <a href="<?php echo base_url('admin/estados/borrar')."?id=".$estado->ID_ESTADO."&pais=".$estado->ID_PAIS; ?>" class="btn btn-sm btn-danger" title="Borrar Estado"><span class="fa fa-trash-alt"></span></a>
                  -->
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
