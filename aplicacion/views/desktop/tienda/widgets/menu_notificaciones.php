<?php
if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
  $notificaciones = $this->NotificacionesModel->lista($_SESSION['usuario']['id'],10);
  $notificaciones_no_leidas = $this->NotificacionesModel->conteo_no_leidas($_SESSION['usuario']['id']);
?>
<div class="btn-group" role="group">
  <button id="btnNotificaciones" type="button" class="btn btn-link btn-sm dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-bell"></i> <?php if($notificaciones_no_leidas>0){ echo '<span class="badge badge-danger">'.$notificaciones_no_leidas.'</span>'; } ?>
  </button>
  <div class="dropdown-menu dropdown-menu-right cont-notif" aria-labelledby="btnNotificaciones">
    <h3>NOTIFICACIONES</h3>

    <?php foreach($notificaciones as $notificacion){ ?>
      <?php
      switch ($notificacion->NOTIFICACION_TIPO) {
        case 'venta':
          $clase_notificacion = 'venta-notif';
          $icono_notificacion = 'fas fa-shopping-cart';
          $enlace = base_url('usuario/ventas');
          break;
        case 'general':
          $clase_notificacion = 'general-notif';
          $icono_notificacion = 'fas fa-bell';
          $enlace = base_url('usuario');
        break;
        case 'compra':
          $clase_notificacion = 'compra-notif';
          $icono_notificacion = 'fas fa-box-open';
          $enlace = base_url('usuario/pedidos');
        break;
        case 'mensaje':
          $clase_notificacion = 'mensaje-notif';
          $icono_notificacion = 'far fa-envelope';
          $enlace = base_url('usuario/mensajes');
        break;

        default:
          $clase_notificacion = 'general-notif';
          $icono_notificacion = 'fas fa-bell';
          $enlace = base_url('usuario');
          break;
      }
      if($notificacion->NOTIFICACION_ESTADO=='no leido'){
          $notificacion_leida = 'no-leida';
      }else{
        $notificacion_leida = '';
      }
      ?>
      <a class="dropdown-item notif text-primary <?php echo $notificacion_leida; ?>" href="<?php echo $enlace; ?>" id="<?php echo $clase_notificacion; ?>"><i class="<?php echo $icono_notificacion; ?>"></i><?php echo $notificacion->NOTIFICACION_CONTENIDO ?></a>
    <?php } ?>
  </div>
</div>
<?php } ?>
