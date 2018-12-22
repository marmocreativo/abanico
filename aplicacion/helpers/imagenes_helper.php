<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  /*
  Función que revisa si existe una sesión de usuario creada
  */
  function subir_imagen_abanico($archivo,$ancho,$alto,$calidad,$nombre,$destino)
  {
    if(!empty($archivo)){
      $CI =& get_instance();
      $CI->load->library('SimpleImage');
      $caught = false;
      $imagen = $nombre.'.jpg';
      try {
        $CI->simpleimage->fromFile($archivo)
        ->thumbnail($ancho, $alto)
        ->toFile($destino.$nombre.'.jpg', 'image/jpeg', $calidad);
      } catch(Exception $err) {
        // Handle errors
        echo $err->getMessage();
      }
      if($caught){
        $imagen = 'default.jpg';
      }
    }else{
      $imagen = 'default.jpg';
    }
    return $imagen;
  }
