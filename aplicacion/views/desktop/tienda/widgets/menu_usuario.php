<?php
if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){ ?>
  <div class="btn-group" role="group">
    <button id="btnMenuUsuario" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-user"></span> Hola <?php echo $_SESSION['usuario']['nombre']; ?>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuUsuario">
      <a class="dropdown-item" href="<?php echo base_url('usuario/index');?>">Perfil</a>
      <a class="dropdown-item" href="<?php echo base_url('usuario/cerrar_sesion');?>">Cerrar Sesión</a>
    </div>
  </div>
<?php }else{ ?>
  <div class="btn-group" role="group">
    <button id="btnMenuUsuario" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-user"></span> Usuarios
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuUsuario">
      <a class="dropdown-item" href="<?php echo base_url('usuario/login_form');?>">Inicio Sesion</a>
      <a class="dropdown-item" href="<?php echo base_url('usuario/registro_form');?>">Registro</a>
    </div>
  </div>
<?php } ?>
