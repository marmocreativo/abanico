<div class="container">
  <div class="row">
    <div class="col mt-4">
      <div class="card">
        <div class="card-header">
          <h2 class="h5"> <span class="fa fa-id-card"></span> Perfil y datos personales</h2>
        </div>
        <div class="card-body">
          <?php retro_alimentacion(); ?>
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/usuarios/pass');?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $_GET['id_usuario']; ?>">
             <div class="form-group">
               <label for="PassUsuario">Nueva Contraseña</label>
               <input type="password" class="form-control" id="PassUsuario" name="PassUsuario" placeholder="Nueva Contraseña">
             </div>
             <div class="form-group">
               <label for="PassUsuario">Confirmar Nueva Contraseña</label>
               <input type="password" class="form-control" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="Confirmar Contraseña">
             </div>
             <hr>
             <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Cambiar Contraseña</button>
           </form>
        </div>
      </div>
    </div>
  </div>
</div>
