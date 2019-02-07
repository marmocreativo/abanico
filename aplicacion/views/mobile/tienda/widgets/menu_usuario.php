<?php

if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
  <a class="nav-link" href="javascript:void(0);"<span class="fa fa-user"></span> Hola <?php echo $_SESSION['usuario']['nombre']; ?></a>
  <a class="nav-link" href="<?php echo base_url('usuario');?>"><i class="fas fa-user"></i>Perfil</a>
  <a class="nav-link" href="<?php echo base_url('login/cerrar');?>"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>
<?php }else{ ?>
  <a class="nav-link" href="<?php echo base_url('usuario/registrar'); ?>"> <i class="fas fa-user-plus"></i> Registrarse</a>
  <a class="nav-link" href="<?php echo base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING']));?>"> <i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
<?php } ?>
