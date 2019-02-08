<!-- empieza panel usuario resposivo -->

<div class="fila-gris">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('mobile/usuarios/widgets/menu_control_usuario'); ?>
      </div>
    </div>
  </div>
</div>

<div class="container py-3 mb-3">
  <?php if($tienda['TIENDA_ESTADO']=='activo'){ ?>
  <div class="row">
    <div class="col-12">
      <?php retro_alimentacion(); ?>
      <div class="card mb-3">
        <div class="card-header">
          <?php switch ($tienda['TIENDA_TIPO']) {
            case 'tienda':
               $texto_tipo_tienda = 'Mi Tienda';
              break;
            case 'vendedor':
               $texto_tipo_tienda = 'Perfil Vendedor';
              break;
          } ?>
          <h5 class="pt-2"><i class="fa fa-store"></i> <?php echo $texto_tipo_tienda; ?></h5>
        </div>
        <div class="card-body">
          <img class="img-fluid d-block mx-auto mb-3 img-thumbnail rounded-circle" style="width:150px" src="<?php echo base_url('contenido/img/tiendas/completo/'.$tienda['TIENDA_IMAGEN']) ?>" alt="">
          <h6><strong>Nombre público</strong></h6>
          <p><?php echo $tienda['TIENDA_NOMBRE']; ?></p>
          <h6><strong>Razón Social</strong></h6>
          <p><?php echo $tienda['TIENDA_RAZON_SOCIAL']; ?></p>
          <h6><strong>R.F.C.</strong></h6>
          <p><?php echo $tienda['TIENDA_RFC']; ?></p>
          <h6><strong>Teléfono</strong></h6>
          <p><?php echo $tienda['TIENDA_TELEFONO']; ?></p>
          <h6><strong>Registro</strong></h6>
          <p><?php echo $tienda['TIENDA_FECHA_REGISTRO']; ?></p>
          <h6><strong>Actualización</strong></h6>
          <p><?php echo $tienda['TIENDA_FECHA_ACTUALIZACION']; ?></p>
          <hr>
          <h6><strong>Dirección</strong></h6>
          <p><?php echo $direccion_formateada; ?></p>
        </div>
        <div class="card-footer">
          <a href="<?php echo base_url('usuario/tienda/actualizar'); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> Editar</a>
        </div>
      </div>

    </div>

    <div class="col-12 mb-3">
      <div class="card">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h4 class="h5"> <span class="fa fa-box"></span> Productos</h4>
        </div>
        <div class="card-footer text-center">
          <a href="<?php echo base_url('usuario/productos');?>">Mi Catálogo de Productos</a>
        </div>
      </div>
    </div>

    <div class="col-12 mb-3">
      <div class="card">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h4 class="h5"> <span class="fa fa-file-invoice-dollar"></span> Ventas</h4>
        </div>
        <div class="card-footer text-center">
          <a href="<?php echo base_url('usuario/ventas');?>">Mis Ventas</a>
        </div>
      </div>
    </div>
  </div>
<?php }else{ ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-danger">
        <h6>Tu tienda se encuentra inactiva, por favor comunícate con nosotros para conocer la razón.</h6>
      </div>
    </div>
  </div>
<?php } ?>
</div>
