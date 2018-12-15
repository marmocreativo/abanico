<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  /*
  Función que revisa si existe una sesión de usuario creada
  */
  function verificar_sesion()
  {
    if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){
      return TRUE;
    }else{
      return FALSE;
    }
  }
  function verificar_permiso($permisos)
  {
    // creo una llave y la coloco en 0
    $llave = 0;
    // recorro el array de los permisos
    foreach($permisos as $permiso){
      //Si alguno de los permisos es igual al tipo de usuario de mi sesión le sumo 1 a mi llave
      if($permiso == $_SESSION['usuario']['tipo_usuario']) { $llave ++; }
    }
    // Si la llave es mayor que cero retorno TRUE
    if($llave > 0){ return TRUE; }else{ return FALSE; }
  }
  /*
  Función para iniciar sesion
  */
  function iniciar_sesion($parametros){
     $CI =& get_instance();
    $datos_del_usuario = array(
      'usuario'=> array(
        'id'  => $parametros['ID_USUARIO'],
        'nombre'  => $parametros['USUARIO_NOMBRE'],
        'apellidos'  => $parametros['USUARIO_APELLIDOS'],
        'correo'  => $parametros['USUARIO_CORREO'],
        'tipo_usuario'  => $parametros['USUARIO_TIPO']
      )
    );
    $CI->session->set_userdata($datos_del_usuario);
  }
