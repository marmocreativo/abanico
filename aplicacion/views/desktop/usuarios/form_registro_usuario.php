<div class="contenido_principal">
  <div class="fila fila-titulo">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <h1 class="h3">Registro de Usuarios</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="fila">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-8">
          <div class="card">
            <div class="card-header">
              <h4>Llena los siguientes datos</h4>
            </div>
            <div class="card-body">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
                <hr>
              <?php } ?>
                <form class="" action="<?php echo base_url('usuario/registrar');?>" method="post">
                  <div class="row">
                    <div class="col">
                       <div class="form-group">
                         <label for="NombreUsuario">Nombre</label>
                         <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" value="<?=!form_error('NombreUsuario')?set_value('NombreUsuario'):''?>">
                       </div>
                    </div>
                    <div class="col">
                       <div class="form-group">
                         <label for="ApellidosUsuario">Apellidos</label>
                         <input type="text" class="form-control" id="ApellidosUsuario" name="ApellidosUsuario" placeholder="" value="<?=!form_error('ApellidosUsuario')?set_value('ApellidosUsuario'):''?>">
                       </div>
                    </div>
                  </div>
                   <div class="form-group">
                     <label for="CorreoUsuario">Correo Electrónico</label>
                     <input type="email" class="form-control" id="CorreoUsuario" name="CorreoUsuario" placeholder="" value="<?=!form_error('CorreoUsuario')?set_value('CorreoUsuario'):''?>">
                   </div>
                   <div class="row">
                     <div class="col">
                       <div class="form-group">
                         <label for="PassUsuario">Contraseña</label>
                         <input type="password" class="form-control" id="PassUsuario" name="PassUsuario" placeholder="">
                       </div>
                     </div>
                     <div class="col">
                       <div class="form-group">
                         <label for="PassUsuario">Confirmar Contraseña</label>
                         <input type="password" class="form-control" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="">
                       </div>
                     </div>
                   </div>
                   <div class="form-check">
                     <input type="checkbox" class="form-check-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                     <label class="form-check-label" for="TerminosyCondiciones">Acepto los Términos y Condiciones</label>
                   </div>
                   <hr>
                   <button type="submit" class="btn btn-primary btn-block">Registrarme</button>
                 </form>
            </div>
            <div class="card-footer">
              <nav class="nav justify-content-center nav-fill">
                <a class="nav-link" href="<?php echo base_url('login');?>"> <span class="fa fa-pen-square"></span> Iniciar Sesión</a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
