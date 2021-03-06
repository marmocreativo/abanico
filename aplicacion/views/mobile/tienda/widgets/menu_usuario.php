<?php

if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
  <div class="btn-group" role="group">
    <button id="btnMenuUsuario" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-user"></span>  <?php echo $this->lang->line('header_menu_usuario_saludo'); ?> <?php echo $_SESSION['usuario']['nombre']; ?>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuUsuario">
      <a class="dropdown-item" href="<?php echo base_url('usuario');?>"><?php echo $this->lang->line('header_menu_usuario_boton_perfil'); ?></a>
      <a class="dropdown-item" href="<?php echo base_url('login/cerrar');?>"><?php echo $this->lang->line('header_menu_usuario_boton_cerrar_sesion'); ?></a>
    </div>
  </div>
<?php }else{ ?>
  <div class="btn-group" role="group">
    <button id="btnMenuUsuario" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-user"></span> <?php echo $this->lang->line('header_menu_usuario_boton'); ?>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuUsuario">
      <a class="dropdown-item" href="<?php echo base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING']));?>"><?php echo $this->lang->line('header_menu_usuario_boton_iniciar_sesion'); ?></a>
      <a class="dropdown-item" href="<?php echo base_url('usuario/registrar');?>"><?php echo $this->lang->line('header_menu_usuario_boton_registro'); ?></a>
    </div>
  </div>
<?php } ?>
