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
              <h1 class="h6"> <span class="fa fa-user"></span> Carruseles</h1>
            </div>
            <div class="formulario d-flex align-items-center">
            </div>
            <div class="opciones d-flex align-items-center">
              <div class="btn-group btn-sm">
                <a href="<?php echo base_url('admin/carruseles/crear'); ?>" class="btn btn-success btn-sm"> <span class="fa fa-plus"></span> Nuevo Carrusel Productos </a>
                <a href="<?php echo base_url('admin/carruseles/crear?tabla=servicios'); ?>" class="btn btn-info btn-sm"> <span class="fa fa-plus"></span> Nuevo Carrusel Servicios</a>
              </div>

            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover table-striped">
              <thead class="text-light bg<?php echo $primary; ?>">
                <tr>
                  <th class="text-left">Titulo</th>
                  <th class="text-left">Descripción</th>
                  <th class="text-left">Tipo</th>
                  <th class="text-left">Categorias</th>
                  <th class="text-left">Origen</th>
                  <th class="text-left">Artesanal</th>
                  <th class="text-left">Ordenar por:</th>
                  <th class="text-left">Limite</th>
                  <th class="text-left">Estado</th>
                  <th class="text-right">Controles</th>
                </tr>
              </thead>
              <tbody class="ui-sortable" data-tabla="carruseles" data-columna="ID">
                <?php foreach($carruseles as $carrusel){ ?>
                <tr id="item-<?php echo $carrusel->ID; ?>">
                  <td class="text-left"><b><?php echo $carrusel->TITULO; ?></b></td>
                  <td class="text-left"><?php echo word_limiter($carrusel->DESCRIPCION,5); ?>...</td>
                  <td class="text-left"><?php echo $carrusel->TIPO; ?></td>
                  <td class="text-left"><?php echo $carrusel->CATEGORIAS; ?></td>
                  <td class="text-left"><?php echo $carrusel->ORIGEN; ?></td>
                  <td class="text-left"><?php echo $carrusel->ARTESANAL; ?></td>
                  <td class="text-left"><?php echo $carrusel->ORDEN_PRODUCTOS; ?></td>
                  <td class="text-left"><?php echo $carrusel->LIMITE; ?></td>
                  <td class="text-left">
                    <?php if($carrusel->ESTADO=='activo'){ ?>
                      <a href="<?php echo base_url('admin/carruseles/activar')."?id=".$carrusel->ID."&estado=".$carrusel->ESTADO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                    <?php }else{ ?>
                      <a href="<?php echo base_url('admin/carruseles/activar')."?id=".$carrusel->ID."&estado=".$carrusel->ESTADO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                    <?php } ?>
                  </td>
                  <td class="text-right">
                    <div class="btn-group" role="group">
                      <a href="<?php echo base_url('admin/carruseles/actualizar?id='.$carrusel->ID); ?>" class="btn btn-sm btn-warning" title="Editar Publicación"> <span class="fa fa-pencil-alt"></span> </a>
                      <button data-enlace='<?php echo base_url('admin/carruseles/borrar?id='.$carrusel->ID); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>
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
