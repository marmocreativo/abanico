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
  <?php if($perfil['PERFIL_ESTADO']=='activo'){ ?>
  <div class="row">
    <div class="col-12">
      <?php retro_alimentacion(); ?>
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="pt-2"> <i class="fa fa-user-tie"></i> Mi Perfil de Servicios</h5>
        </div>
        <div class="card-body">
          <img class="img-fluid d-block mx-auto mb-3 img-thumbnail rounded-circle" style="width:150px" src="<?php echo base_url('contenido/img/perfiles/completo/'.$perfil['PERFIL_IMAGEN']) ?>" alt="">
          <h6><strong>Nombre</strong></h6>
          <p><?php echo $perfil['PERFIL_NOMBRE']; ?></p>
          <h6><strong>Razón social</strong></h6>
          <p><?php echo $perfil['PERFIL_RAZON_SOCIAL']; ?></p>
          <h6><strong>R.F.C.</strong></h6>
          <p><?php echo $perfil['PERFIL_RFC']; ?></p>
          <h6><strong>Teléfono</strong></h6>
          <p><?php echo $perfil['PERFIL_TELEFONO']; ?></p>
          <h6><strong>Registro</strong></h6>
          <p><?php echo $perfil['PERFIL_FECHA_REGISTRO']; ?></p>
          <h6><strong>Actualización</strong></h6>
          <p><?php echo $perfil['PERFIL_FECHA_ACTUALIZACION']; ?></p>
          <hr>
          <h6><strong>Dirección</strong></h6>
          <p><?php echo $direccion_formateada; ?></p>
        </div>
        <div class="card-footer">
          <a href="<?php echo base_url('usuario/perfil_servicios/actualizar'); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> Editar</a>
        </div>
      </div>

    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h4 class="h5"><i class="fa fa-tools"></i> Servicios</h4>
        </div>
        <div class="card-footer text-center">
          <a href="<?php echo base_url('usuario/servicios');?>">Mi Catálogo de Servicios</a>
        </div>
      </div>
    </div>

  </div>
<?php }else{ ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-danger">
        <h6>Tu perfil de servicios se encuentra inactivo, por favor comunícate con nosotros para conocer la razón.</h6>
      </div>
    </div>
  </div>
<?php } ?>
</div>
