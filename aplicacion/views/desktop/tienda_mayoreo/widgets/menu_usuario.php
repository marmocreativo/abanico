<?php

if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
  <div class="btn-group" role="group">
    <button id="btnMenuUsuario" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-user"></span>  <?php echo $this->lang->line('header_menu_usuario_saludo'); ?> <?php echo $_SESSION['usuario']['nombre']; ?>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuUsuario">
      <a class="dropdown-item" href="<?php echo base_url('usuario');?>"><span class="fa fa-user"></span> <?php echo $this->lang->line('header_menu_usuario_boton_perfil'); ?></a>
      <?php if(isset($_SESSION['usuario'])&&verificar_permiso(['tec-5','adm-6'])){ ?>
        <a class="dropdown-item" href="<?php echo base_url('admin');?>"><span class="fa fa-tachometer-alt"></span> Administrador</a>
      <?php } ?>
      <a class="dropdown-item" href="<?php echo base_url('login/cerrar');?>"><span class="fas fa-sign-out-alt"></span> <?php echo $this->lang->line('header_menu_usuario_boton_cerrar_sesion'); ?></a>
    </div>
  </div>
<?php }else{ ?>
  <div class="btn-group" role="group">
    <button id="btnMenuUsuario" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-user"></span> <?php echo $this->lang->line('header_menu_usuario_boton'); ?>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuUsuario">
      <a class="dropdown-item" href="<?php echo base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING']));?>"><span class="fas fa-sign-in-alt"></span> <?php echo $this->lang->line('header_menu_usuario_boton_iniciar_sesion'); ?></a>
      <a class="dropdown-item" href="<?php echo base_url('usuario/registrar');?>"><span class="fa fa-pencil-alt"></span> <?php echo $this->lang->line('header_menu_usuario_boton_registro'); ?></a>
    </div>
  </div>
<?php } ?>
