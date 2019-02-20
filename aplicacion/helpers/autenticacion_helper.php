<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  /*
  Función que revisa si existe una sesión de usuario creada
  */
  function verificar_sesion($tiempo)
  {
    $CI =& get_instance();
    // Reviso que exista la función del usuario
    if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){
      // verifico el tiempo de sesión
      if(strtotime($_SESSION['usuario']['ultima_actividad']) <= strtotime('-'.$tiempo.' Minutes')){
        // si ha pasado mucho tiempo:
        // Madno un mensaje, destruyo la sesión y retorno falso
        $CI->session->set_flashdata('mensaje', 'Tu sesión se ha cerrado por falta de actividad');
        if(!empty($_SESSION)){ session_destroy(); }
        return FALSE;
      }else{
        // de lo contrario
        // Actualizo el tiempo de actividad retorno true
        $_SESSION['usuario']['ultima_actividad'] = date('Y-m-d H:i:s');
        return TRUE;
      }
    }else{
      // No hay sesión de usuario retorno false
      return FALSE;
    }
  }
  /*
    Verifico si el tipo de usuario está permitido en un controlador
  */
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
        'tipo_usuario'  => $parametros['USUARIO_TIPO'],
        'ultima_actividad'  => date('Y-m-d H:i:s'),
      )
    );
    $CI->session->set_userdata($datos_del_usuario);
  }
