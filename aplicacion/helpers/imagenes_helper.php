<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  /*
  Función que crea una imagen y la ajusta al tamaño usada normalmente para productos
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
        ->autoOrient()
        ->bestFit($ancho, $alto)
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
  /*
  Función que crea una imagen y la recorta al tamaño
  */
  function subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino)
  {
    if(!empty($archivo)){
      $CI =& get_instance();
      $CI->load->library('SimpleImage');
      $caught = false;
      $imagen = $nombre.'.jpg';
      try {
        $CI->simpleimage->fromFile($archivo)
        ->autoOrient()
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
