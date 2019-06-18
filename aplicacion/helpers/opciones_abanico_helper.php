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

// Alerta Plan
if ( ! function_exists('alerta_plan'))
{
    function alerta_plan()
    {
      $CI =& get_instance();
      $CI->load->model('PlanesModel');
      $CI->load->model('TiendasModel');
      $CI->load->model('PerfilServiciosModel');
      switch ($_SESSION['usuario']['tipo_usuario']) {
        case 'vnd-2':
          // Busco un plan activo de vendedor
          $plan_vendedor = $CI->PlanesModel->plan_activo_usuario($_SESSION['usuario']['id'],'productos');
          // Si no hay un plan activo Busco un plan pendiente
          if(empty($plan_vendedor)){
            $plan_vendedor = $CI->PlanesModel->plan_pendiente_usuario($_SESSION['usuario']['id'],'productos');
            // Si hay un plan pendiente mando una alerta amarilla
            if(!empty($plan_vendedor)){
              echo '<div class="alert alert-warning alert-dismissible fade show">';
              echo '<h5 class="alert-heading"><i class="fa fa-check"></i>';
              echo ' <small>Tu <b>plan de vendedor</b> está en proceso de activación. Pronto nos comunicaremos contigo, puedes consultar el estado en <a class="text-warning" href="'.base_url('usuario/tienda').'">tu panel de vendedor</a></small></h5>';
              echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>';
              echo '</div>';
            }else{
              // Si tampoco hay un plan pendiente mando alerta roja
              echo '<div class="alert alert-danger alert-dismissible fade show">';
              echo '<h5 class="alert-heading"><i class="fa fa-exclamation-circle"></i>';
              echo ' <small>No olvides <a class="text-danger" href="'.base_url('usuario/planes/lista_planes?tipo=productos').'">solicitar la activación de tu plan de vendedor</a></small></h5>';
              echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>';
              echo '</div>';
            }
          }else{
            // Mando un mensaje verde
            echo '<div class="alert alert-success alert-dismissible fade show">';
            echo '<h5 class="alert-heading"><i class="fa fa-check-circle"></i>';
            echo ' <small>Tu <b>plan de vendedor</b> está activo. Puedes consultar la vigencia en <a class="text-primary" href="'.base_url('usuario/tienda').'">tu panel de vendedor</a></small></h5>';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '</div>';
          }
          // Termina la verificación

          break;
        case 'ser-3':
            // Busco un plan activo de vendedor
            $plan_servicios = $CI->PlanesModel->plan_activo_usuario($_SESSION['usuario']['id'],'servicios');
            // Si no hay un plan activo Busco un plan pendiente
            if(empty($plan_servicios)){
              $plan_servicios = $CI->PlanesModel->plan_pendiente_usuario($_SESSION['usuario']['id'],'servicios');
              // Si hay un plan pendiente mando una alerta amarilla
              if(!empty($plan_servicios)){
                echo '<div class="alert alert-warning alert-dismissible fade show">';
                echo '<h5 class="alert-heading"><i class="fa fa-check"></i>';
                echo ' <small>Tu <b>plan de servicios</b> está en proceso de activación. Pronto nos comunicaremos contigo, puedes consultar el estado en <a class="text-warning" href="'.base_url('usuario/perfil_servicios').'">tu panel de servicios</a></small></h5>';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>';
                echo '</div>';
              }else{
                // Si tampoco hay un plan pendiente mando alerta roja
                echo '<div class="alert alert-danger alert-dismissible fade show">';
                echo '<h5 class="alert-heading"><i class="fa fa-exclamation-circle"></i>';
                echo ' <small>No olvides <a class="text-danger" href="'.base_url('usuario/planes/lista_planes?tipo=servicios').'">solicitar la activación de tu plan de servicios</a></small></h5>';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>';
                echo '</div>';
              }
            }else{
              // Mando un mensaje verde
              echo '<div class="alert alert-success alert-dismissible fade show">';
              echo '<h5 class="alert-heading"><i class="fa fa-check-circle"></i>';
              echo ' <small>Tu <b>plan de servicios</b> está activo. Puedes consultar la vigencia en <a class="text-success" href="'.base_url('usuario/tienda').'">tu panel de servicios</a></small></h5>';
              echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>';
              echo '</div>';
            }
        // Termina la verificación
          break;
        case 'vens-4':
        // Busco un plan activo de vendedor
        $plan_vendedor = $CI->PlanesModel->plan_activo_usuario($_SESSION['usuario']['id'],'productos');
        // Si no hay un plan activo Busco un plan pendiente
        if(empty($plan_vendedor)){
          $plan_vendedor = $CI->PlanesModel->plan_pendiente_usuario($_SESSION['usuario']['id'],'productos');
          // Si hay un plan pendiente mando una alerta amarilla
          if(!empty($plan_vendedor)){
            echo '<div class="alert alert-warning alert-dismissible fade show">';
            echo '<h5 class="alert-heading"><i class="fa fa-check"></i>';
            echo ' <small>Tu <b>plan de vendedor</b> está en proceso de activación. Pronto nos comunicaremos contigo, puedes consultar el estado en <a class="text-warning" href="'.base_url('usuario/tienda').'">tu panel de vendedor</a></small></h5>';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '</div>';
          }else{
            // Si tampoco hay un plan pendiente mando alerta roja
            echo '<div class="alert alert-danger alert-dismissible fade show">';
            echo '<h5 class="alert-heading"><i class="fa fa-exclamation-circle"></i>';
            echo ' <small>No olvides <a class="text-danger" href="'.base_url('usuario/planes/lista_planes?tipo=productos').'">solicitar la activación de tu plan de vendedor</a></small></h5>';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '</div>';
          }
        }else{
          // Mando un mensaje verde
          echo '<div class="alert alert-success alert-dismissible fade show">';
          echo '<h5 class="alert-heading"><i class="fa fa-check-circle"></i>';
          echo ' <small>Tu <b>plan de vendedor</b> está activo. Puedes consultar la vigencia en <a class="text-success" href="'.base_url('usuario/tienda').'">tu panel de vendedor</a></small></h5>';
          echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>';
          echo '</div>';
        }
        // Servicios
        // Busco un plan activo de vendedor
        $plan_servicios = $CI->PlanesModel->plan_activo_usuario($_SESSION['usuario']['id'],'servicios');
        // Si no hay un plan activo Busco un plan pendiente
        if(empty($plan_servicios)){
          $plan_servicios = $CI->PlanesModel->plan_pendiente_usuario($_SESSION['usuario']['id'],'servicios');
          // Si hay un plan pendiente mando una alerta amarilla
          if(!empty($plan_servicios)){
            echo '<div class="alert alert-warning alert-dismissible fade show">';
            echo '<h5 class="alert-heading"><i class="fa fa-check"></i>';
            echo ' <small>Tu <b>plan de servicios</b> está en proceso de activación. Pronto nos comunicaremos contigo, puedes consultar el estado en <a class="text-warning" href="'.base_url('usuario/perfil_servicios').'">tu panel de servicios</a></small></h5>';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '</div>';
          }else{
            // Si tampoco hay un plan pendiente mando alerta roja
            echo '<div class="alert alert-danger alert-dismissible fade show">';
            echo '<h5 class="alert-heading"><i class="fa fa-exclamation-circle"></i>';
            echo ' <small>No olvides <a class="text-danger" href="'.base_url('usuario/planes/lista_planes?tipo=servicios').'">solicitar la activación de tu plan de servicios</a></small></h5>';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '</div>';
          }
        }else{
            // Mando un mensaje verde
            echo '<div class="alert alert-success alert-dismissible fade show">';
            echo '<h5 class="alert-heading"><i class="fa fa-check-circle"></i>';
            echo ' <small>Tu <b>plan de servicios</b> está activo. Puedes consultar la vigencia en <a class="text-success" href="'.base_url('usuario/tienda').'">tu panel de servicios</a></small></h5>';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '</div>';
          }
          break;
          default:
          $tienda = $CI->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
          if(!empty($tienda)){

            // Busco un plan activo de vendedor
            $plan_vendedor = $CI->PlanesModel->plan_activo_usuario($_SESSION['usuario']['id'],'productos');
            // Si no hay un plan activo Busco un plan pendiente
            if(empty($plan_vendedor)){
              $plan_vendedor = $CI->PlanesModel->plan_pendiente_usuario($_SESSION['usuario']['id'],'productos');
              // Si hay un plan pendiente mando una alerta amarilla
              if(!empty($plan_vendedor)){
                echo '<div class="alert alert-warning alert-dismissible fade show">';
                echo '<h5 class="alert-heading"><i class="fa fa-check"></i>';
                echo ' <small>Tu <b>plan de vendedor</b> está en proceso de activación. Pronto nos comunicaremos contigo, puedes consultar el estado en <a class="text-warning" href="'.base_url('usuario/tienda').'">tu panel de vendedor</a></small></h5>';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>';
                echo '</div>';
              }else{
                // Si tampoco hay un plan pendiente mando alerta roja
                echo '<div class="alert alert-danger alert-dismissible fade show">';
                echo '<h5 class="alert-heading"><i class="fa fa-exclamation-circle"></i>';
                echo ' <small>No olvides <a class="text-danger" href="'.base_url('usuario/planes/lista_planes?tipo=productos').'">solicitar la activación de tu plan de vendedor</a></small></h5>';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>';
                echo '</div>';
              }
            }else{
              // Mando un mensaje verde
              echo '<div class="alert alert-success alert-dismissible fade show">';
              echo '<h5 class="alert-heading"><i class="fa fa-check-circle"></i>';
              echo ' <small>Tu <b>plan de vendedor</b> está activo. Puedes consultar la vigencia en <a class="text-success" href="'.base_url('usuario/tienda').'">tu panel de vendedor</a></small></h5>';
              echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>';
              echo '</div>';
            }
          }
          $perfil = $CI->PerfilServiciosModel->perfil_usuario($_SESSION['usuario']['id']);;
          if(!empty($perfil)){
            // Servicios
            // Busco un plan activo de vendedor
            $plan_servicios = $CI->PlanesModel->plan_activo_usuario($_SESSION['usuario']['id'],'servicios');
            // Si no hay un plan activo Busco un plan pendiente
            if(empty($plan_servicios)){
              $plan_servicios = $CI->PlanesModel->plan_pendiente_usuario($_SESSION['usuario']['id'],'servicios');
              // Si hay un plan pendiente mando una alerta amarilla
              if(!empty($plan_servicios)){
                echo '<div class="alert alert-warning alert-dismissible fade show">';
                echo '<h5 class="alert-heading"><i class="fa fa-check"></i>';
                echo ' <small>Tu <b>plan de servicios</b> está en proceso de activación. Pronto nos comunicaremos contigo, puedes consultar el estado en <a class="text-warning" href="'.base_url('usuario/perfil_servicios').'">tu panel de servicios</a></small></h5>';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>';
                echo '</div>';
              }else{
                // Si tampoco hay un plan pendiente mando alerta roja
                echo '<div class="alert alert-danger alert-dismissible fade show">';
                echo '<h5 class="alert-heading"><i class="fa fa-exclamation-circle"></i>';
                echo ' <small>No olvides <a class="text-danger" href="'.base_url('usuario/planes/lista_planes?tipo=servicios').'">solicitar la activación de tu plan de servicios</a></small></h5>';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>';
                echo '</div>';
              }
            }else{
                // Mando un mensaje verde
                echo '<div class="alert alert-success alert-dismissible fade show">';
                echo '<h5 class="alert-heading"><i class="fa fa-check-circle"></i>';
                echo ' <small>Tu <b>plan de servicios</b> está activo. Puedes consultar la vigencia en <a class="text-success" href="'.base_url('usuario/tienda').'">tu panel de servicios</a></small></h5>';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>';
                echo '</div>';
              }
          }
          break;
      }
    }
}
