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
  <div class="row">
    <div class="col-12">

      <div class="card mb-3">
        <div class="card-header">
          <h2 class="h5 mt-2"><span class="fa fa-id-card"></span> Perfil y datos personales</h2>
        </div>
        <div class="card-body">
          <?php if(isset($_GET['mensaje'])){
            switch($_GET['mensaje']){
              case 'actualizacion_correcta':
                $alerta = 'alert-success';
                $mensaje = 'Tu información se actualizó correctamente';
              break;
              case 'pass_incorrecto':
                $alerta = 'alert-danger';
                $mensaje = 'Has escrito mal la contraseña Actual, por favor verifícala.';
              break;
              case 'pass_actualizado':
                $alerta = 'alert-success';
                $mensaje = 'Tu contraseña se ha actualizado con éxito';
              break;
            }
            ?>

            <div class="alert <?php echo  $alerta; ?>">
              <p><?php echo  $mensaje; ?></p>
            </div>
          <?php }// Termina la condicionante ?>
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('usuario/pass');?>" method="post">
            <div class="form-group">
              <label for="PassActualUsuario">Contraseña Actual</label>
              <input type="password" class="form-control form-control-sm" id="PassActualUsuario" name="PassActualUsuario" placeholder="Contraseña Actual">
            </div>
             <div class="form-group">
               <label for="PassUsuario">Nueva Contraseña</label>
               <input type="password" class="form-control form-control-sm" id="PassUsuario" name="PassUsuario" placeholder="Nueva Contraseña">
             </div>
             <div class="form-group">
               <label for="PassUsuario">Confirmar Nueva Contraseña</label>
               <input type="password" class="form-control form-control-sm" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="Confirmar contraseña">
             </div>
             <hr>
             <button type="submit" class="btn btn-sm btn-primary float-right"> <span class="fa fa-save"></span> Cambiar Contraseña</button>
           </form>
        </div>
      </div>

    </div>

    <div class="col-12">

      <div class="card border-primary text-center mb-3">
        <div class="card-header bg-primary text-white">
          <h4 class="h5 pt-2"> <span class="fa fa-map-marker-alt"></span> Direcciones</h4>
        </div>
        <div class="card-body">
          <a href="<?php echo base_url('usuario/direcciones');?>" class="disabled">Ver mis direcciones registradas</a>
        </div>
      </div>

      <div class="card border-danger text-center  mb-3">
        <div class="card-header bg-danger text-white">
          <h4 class="h5 pt-2"> <span class="fa fa-trash"></span> Borrar mi cuenta</h4>
        </div>
        <div class="card-body">
          <button type="button" id="borrar_perfil" class="btn btn-sm btn-link borrar_entrada" data-enlace="<?php echo base_url('usuario/borrar');?>">Borrar tu cuenta</button>
        </div>
      </div>

    </div>

  </div>
</div>
