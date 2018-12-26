<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('opciones_default'))
{
    function opciones_default()
    {
      $CI =& get_instance();
      $opciones_raw = $CI->opciones->get_opciones();
      $opciones = array();

      foreach($opciones_raw as $op_raw){
        if(!isset($opciones[$op_raw->OPCION_NOMBRE])){
          $opciones[$op_raw->OPCION_NOMBRE] = $op_raw->OPCION_VALOR;
        }else{
          $opciones[$op_raw->OPCION_NOMBRE] = $_SESSION[$op_raw->OPCION_NOMBRE];
        }
      }
      return $opciones;
    }
}
if ( ! function_exists('sesion_default'))
{
    function sesion_default($op)
    {
      $CI =& get_instance();
      $datos_divisa = json_decode(json_encode($CI->divisas_activas->get_divisa($op['divisa_predeterminada'])), True);
      $datos_lenguaje = json_decode(json_encode($CI->lenguajes_activos->get_lenguaje($op['lenguaje_predeterminado'])), True);

      if(!isset($_SESSION['divisa'])||empty($_SESSION['divisa'])){
        $default_sesion = array(
          'divisa'=> array(
            'id'  => $datos_divisa[0]['ID_DIVISA'],
            'conversion'  => $datos_divisa[0]['DIVISA_CONVERSION'],
            'signo'  => $datos_divisa[0]['DIVISA_SIGNO'],
            'iso'  => $datos_divisa[0]['DIVISA_ISO']
          )
        );

        $CI->session->set_userdata($default_sesion);
      }
      if(!isset($_SESSION['lenguaje'])||empty($_SESSION['lenguaje'])){
        $default_sesion = array(
          'lenguaje'=> array(
            'id'  => $datos_lenguaje[0]['ID_LENGUAJE'],
            'iso'  => $datos_lenguaje[0]['LENGUAJE_ISO'],
            'nombre'  => $datos_lenguaje[0]['LENGUAJE_NOMBRE'],
          )
        );

        $CI->session->set_userdata($default_sesion);
      }
      // Cargo las sesiones

    }
}
if ( ! function_exists('uniq_slug'))
{
    function uniq_slug($length)
    {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }
}
