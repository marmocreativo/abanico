<?php

if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
  <div class="btn-group" role="group">
    <button id="btnMenuUsuario" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-user"></span> Hola <?php echo $_SESSION['usuario']['nombre']; ?>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuUsuario">
      <a class="dropdown-item" href="<?php echo base_url('usuario');?>">Perfil</a>
      <a class="dropdown-item" href="<?php echo base_url('login/cerrar');?>">Cerrar Sesión</a>
    </div>
  </div>
<?php }else{ ?>
  <div class="btn-group" role="group">
    <button id="btnMenuUsuario" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-user"></span> Usuarios
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuUsuario">
      <a class="dropdown-item" href="<?php echo base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING']));?>">Inicio de sesión</a>
      <a class="dropdown-item" href="<?php echo base_url('usuario/registrar');?>">Registro</a>
    </div>
  </div>
<?php } ?>
