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
          <h2 class="h5 mt-2"><span class="fa fa-id-card"></span> <?php echo $this->lang->line('usuario_form_usuario_titulo'); ?></h2>
        </div>
        <div class="card-body">
          <?php retro_alimentacion();?>

          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
          <form class="" action="<?php echo base_url('usuario/pass');?>" method="post">
            <div class="form-group">
              <label for="PassActualUsuario"><?php echo $this->lang->line('usuario_formulario_registro_nuevo_pass'); ?></label>
              <input type="password" class="form-control" id="PassActualUsuario" name="PassActualUsuario" placeholder="Contraseña Actual">
            </div>
             <div class="form-group">
               <label for="PassUsuario"><?php echo $this->lang->line('usuario_formulario_registro_pass_actual'); ?></label>
               <input type="password" class="form-control" id="PassUsuario" name="PassUsuario" placeholder="Nueva Contraseña">
             </div>
             <div class="form-group">
               <label for="PassUsuario"><?php echo $this->lang->line('usuario_formulario_registro_nuevo_pass_confirmar'); ?></label>
               <input type="password" class="form-control" id="PassUsuarioConf" name="PassUsuarioConf" placeholder="Confirmar contraseña">
             </div>
             <hr>
             <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> <?php echo $this->lang->line('usuario_formulario_registro_cambiar'); ?></button>
           </form>
        </div>
      </div>

    </div>

    <div class="col-12">

      <div class="card border<?php echo $primary; ?> text-center mb-4">
        <div class="card-header bg<?php echo $primary; ?> text-white">
          <h4 class="h5"> <span class="fa fa-map-marker-alt"></span> <?php echo $this->lang->line('usuario_form_usuario_direcciones_titulo'); ?></h4>
        </div>
        <div class="card-body">
          <a href="<?php echo base_url('usuario/direcciones');?>"><?php echo $this->lang->line('usuario_form_usuario_direcciones_boton'); ?></a>
        </div>
      </div>
      <div class="card border-danger text-center  mb-4">
        <div class="card-header bg-danger text-white">
          <h4 class="h5"> <span class="fa fa-trash"></span><?php echo $this->lang->line('usuario_form_usuario_borrar_cuenta'); ?></h4>
        </div>
        <div class="card-body">
          <button type="button" id="borrar_perfil" class="btn btn-link borrar_entrada" data-enlace="<?php echo base_url('usuario/borrar');?>"><?php echo $this->lang->line('usuario_form_usuario_borrar_cuenta_boton'); ?></button>
        </div>
      </div>

    </div>

  </div>
</div>
