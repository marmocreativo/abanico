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
      if(!isset($_SESSION['carrito'])||empty($_SESSION['carrito'])){
        $default_sesion = array(
          'carrito'=> array(
            'tiendas'=>array(),
            'productos'=>array(),
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

if ( ! function_exists('retro_alimentacion'))
{
    function retro_alimentacion()
    {
      $CI =& get_instance();
      /*
      Ejemplos de Mensajes de retroalimentación
      $this->session->set_flashdata('alerta', 'Algo salio mal');
      $this->session->set_flashdata('advertencia', 'Algo salio mal');
      $this->session->set_flashdata('exito', 'Algo salio mal');
      $this->session->set_flashdata('mensaje', 'Algo salio mal');
      */
      if(!null==$CI->session->flashdata()){
        if(isset($_SESSION['alerta'])){
            echo '<div class="alert alert-danger alert-dismissible fade show">';
            echo '<h5 class="alert-heading"><i class="fa fa-exclamation-triangle"></i>';
            echo ' <small>'.$_SESSION['alerta'].'</small></h5>';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '</div>';
        }
        if(isset($_SESSION['advertencia'])){
            echo '<div class="alert alert-warning alert-dismissible fade show">';
            echo '<h5 class="alert-heading"><i class="fa fa-exclamation-circle"></i>';
            echo ' <small>'.$_SESSION['advertencia'].'</small></h5>';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '</div>';
        }
        if(isset($_SESSION['exito'])){
            echo '<div class="alert alert-success alert-dismissible fade show">';
            echo '<h5 class="alert-heading"><i class="fa fa-check-circle"></i>';
            echo ' <small>'.$_SESSION['exito'].'</small></h5>';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '</div>';
        }
        if(isset($_SESSION['mensaje'])){
            echo '<div class="alert alert-secondary alert-dismissible fade show">';
            echo '<h5 class="alert-heading"><i class="fa fa-info-circle"></i>';
            echo ' <small>'.$_SESSION['mensaje'].'</small></h5>';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '</div>';
        }
      }
    }
}
if ( ! function_exists('folio_pedido'))
{
    function folio_pedido()
    {
      $CI =& get_instance();
      $length = 6;
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }
}
