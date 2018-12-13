<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-user"></span> Nuevo Usuario</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/usuarios/crear'); ?>" method="post">
            <input type="hidden" name="TipoUsuario" value="<?php echo $_GET['tipo_usuario']; ?>">
              <h3>Datos Requeridos</h3>
               <div class="form-group">
                 <label for="NombreUsuario">Nombre</label>
                 <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" value="<?=!form_error('NombreUsuario')?set_value('NombreUsuario'):''?>">
               </div>
               <div class="form-group">
                 <label for="ApellidosUsuario">Apellidos</label>
                 <input type="text" class="form-control" id="ApellidosUsuario" name="ApellidosUsuario" placeholder="" value="<?=!form_error('ApellidosUsuario')?set_value('ApellidosUsuario'):''?>">
               </div>
               <div class="form-group">
                 <label for="CorreoUsuario">Correo Electrónico</label>
                 <input type="email" class="form-control" id="CorreoUsuario" name="CorreoUsuario" placeholder="" value="<?=!form_error('CorreoUsuario')?set_value('CorreoUsuario'):''?>">
               </div>
               <div class="form-group">
                 <label for="PassUsuario">Contraseña</label>
                 <input type="password" class="form-control" id="PassUsuario" name="PassUsuario" placeholder="">
               </div>
               <div class="form-group">
                 <label for="PassUsuario">Confirmar Contraseña</label>
                 <input type="password" class="form-control" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="">
               </div>
               <hr>
               <h4>Datos Opcionales</h4>
               <div class="form-group">
                 <label for="TelefonoUsuario">Teléfono</label>
                 <input type="text" class="form-control" id="TelefonoUsuario" name="TelefonoUsuario" placeholder="" value="<?=!form_error('TelefonoUsuario')?set_value('TelefonoUsuario'):''?>">
               </div>
               <hr>
               <button type="submit" class="btn btn-primary float-right">Registrar</button>
             </form>
        </div>
      </div>
    </div>
  </div>
</div>
