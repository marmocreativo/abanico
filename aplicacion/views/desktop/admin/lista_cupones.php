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
            <h2 class="h6 mb-0"> <span class="fa fa-ticket-alt"></span> Cupones</h2>
          </div>
          <div class="opciones">
              <a href="<?php echo base_url('admin/cupones/crear'); ?>" class="btn btn-success btn-sm"> <span class="fa fa-plus"></span> Nuevo Cupon </a>
          </div>
        </div>
        <div class="card-body py-0">
          <table class="table ">
            <thead>
              <tr>
                <th>CODIGO</th>
                <th>DESCUENTO</th>
                <th>Importe Mínimo</th>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
                <th class="text-right">Controles</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($cupones as $cupon){ ?>
              <tr>
                <td><?php echo $cupon->CODIGO; ?></td>
                <?php

                $descuento = $cupon->DESCUENTO.'%';
                if($cupon->TIPO_DESCUENTO!='porcentaje'){
                  $descuento = '$'.$cupon->DESCUENTO;
                }
                ?>
                <td><?php echo $descuento; ?></td>
                <td><?php echo '$'.$cupon->IMPORTE_MINIMO; ?></td>
                <td><?php echo $cupon->FECHA_INICIO; ?></td>
                <td><?php echo $cupon->FECHA_FINAL; ?></td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo base_url('admin/cupones/actualizar?id='.$cupon->ID); ?>" class="btn btn-sm btn-warning" title="Editar Cupon"> <span class="fa fa-pencil-alt"></span> </a>
                    <button data-enlace='<?php echo base_url('admin/cupones/borrar?id='.$cupon->ID); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Cupon"> <span class="fa fa-trash"></span> </button>
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
