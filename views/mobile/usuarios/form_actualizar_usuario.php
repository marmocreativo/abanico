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
          <h2 class="h5 pt-2"><span class="fa fa-id-card"></span> <?php echo $this->lang->line('usuario_form_usuario_titulo'); ?></h2>
        </div>

        <div class="card-body">
          <?php retro_alimentacion(); ?>
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
            <form class="" action="<?php echo base_url('usuario/actualizar'); ?>" method="post">
              <input type="hidden" name="TipoUsuario" value="<?php echo $usuario['USUARIO_TIPO']; ?>">
              <div class="row">
                <div class="col">
                  <h3 class="h5"><?php echo $this->lang->line('usuario_form_usuario_datos_requeridos'); ?></h3>
                   <div class="form-group">
                     <label for="NombreUsuario"><?php echo $this->lang->line('usuario_form_usuario_nombre'); ?></label>
                     <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" value="<?php if(empty(form_error('NombreUsuario'))){ echo $usuario['USUARIO_NOMBRE']; } else { set_value('NombreUsuario'); } ?>">
                   </div>
                   <div class="form-group">
                     <label for="ApellidosUsuario"><?php echo $this->lang->line('usuario_form_usuario_apellidos'); ?></label>
                     <input type="text" class="form-control" id="ApellidosUsuario" name="ApellidosUsuario" placeholder="" value="<?php if(empty(form_error('ApellidosUsuario'))){ echo $usuario['USUARIO_APELLIDOS']; } else { set_value('ApellidosUsuario'); } ?>">
                   </div>
                   <div class="form-group">
                     <label for="CorreoUsuario"><?php echo $this->lang->line('usuario_form_usuario_correo'); ?></label>
                     <input type="email" class="form-control" id="CorreoUsuario" name="CorreoUsuario" placeholder="" value="<?php if(empty(form_error('CorreoUsuario'))){ echo $usuario['USUARIO_CORREO']; } else { set_value('CorreoUsuario'); } ?>">
                     <small class="form-text text-muted"><?php echo $this->lang->line('usuario_form_usuario_correo_instrucciones'); ?></small>
                   </div>
                </div>
                <div class="col">
                  <div class="border p-2">
                    <h4 class="h5"><?php echo $this->lang->line('usuario_form_usuario_datos_opcionales'); ?></h4>
                    <div class="form-group">
                      <label for="TelefonoUsuario"><?php echo $this->lang->line('usuario_form_usuario_telefono'); ?></label>
                      <input type="text" class="form-control" id="TelefonoUsuario" name="TelefonoUsuario" placeholder="" value="<?php if(empty(form_error('TelefonoUsuario'))){ echo $usuario['USUARIO_TELEFONO']; } else { set_value('TelefonoUsuario'); } ?> ">
                      <small class="form-text text-muted"><?php echo $this->lang->line('usuario_form_usuario_telefono_instrucciones'); ?></small>
                    </div>
                    <div class="form-group">
                      <label for="FechaNacimientoUsuario"><?php echo $this->lang->line('usuario_form_usuario_fecha_nacimiento'); ?></label>
                      <input type="date" class="form-control" id="FechaNacimientoUsuario" name="FechaNacimientoUsuario" placeholder="" value="<?php echo $usuario['USUARIO_FECHA_NACIMIENTO']; ?>">
                    </div>
                    <hr>
                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                      <input type="checkbox" class="custom-control-input" id="ListaDeCorreoUsuario" name="ListaDeCorreoUsuario" <?php if($usuario['USUARIO_LISTA_DE_CORREO']=='si'){ echo 'checked'; } ?>>
                      <label class="custom-control-label" for="ListaDeCorreoUsuario"><?php echo $this->lang->line('usuario_form_usuario_recibir_ofertas'); ?></label>
                    </div>
                  </div>
                </div>
              </div>
            <hr>
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> <?php echo $this->lang->line('usuario_form_usuario_guardar'); ?></button>
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

      <div class="card border-warning text-center  mb-3">
        <div class="card-header bg-warning text-white">
          <h4 class="h5 pt-2"> <span class="fa fa-user-lock"></span> Mi Contraseña</h4>
        </div>
        <div class="card-body">
          <a href="<?php echo base_url('usuario/pass');?>">Cambiar mi contraseña</a>
        </div>
      </div>

      <div class="card border-danger text-center  mb-3">
        <div class="card-header bg-danger text-white">
          <h4 class="h5 pt-2"> <span class="fa fa-trash"></span> Borrar mi cuenta</h4>
        </div>
        <div class="card-body">
          <button type="button" id="borrar_perfil" class="btn btn-link borrar_entrada" data-enlace="<?php echo base_url('usuario/borrar');?>">Borrar tu cuenta</button>
        </div>
      </div>

    </div>
  </div>
</div>
