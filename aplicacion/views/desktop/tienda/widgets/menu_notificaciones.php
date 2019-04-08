<?php
if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
  $notificaciones = $this->NotificacionesModel->lista($_SESSION['usuario']['id'],10);
  $notificaciones_no_leidas = $this->NotificacionesModel->conteo_no_leidas($_SESSION['usuario']['id']);
?>
<div class="btn-group" role="group">
  <button id="btnNotificaciones" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-bell"></i> <?php if($notificaciones_no_leidas>0){ echo '<span class="badge badge-danger">'.$notificaciones_no_leidas.'</span>'; } ?>
  </button>
  <div class="dropdown-menu dropdown-menu-right cont-notif" aria-labelledby="btnNotificaciones">
    <h3>NOTIFICACIONES</h3>
    <a class="dropdown-item notif text-primary no-leida" href="" id="venta-notif"><i class="fas fa-shopping-cart"></i>Tienes una nueva venta</a>
    <a class="dropdown-item notif text-primary" href="" id="general-notif"><i class="fas fa-bell"></i>Notificación genérica</a>
    <a class="dropdown-item notif text-primary" href="" id="compra-notif"><i class="fas fa-box-open"></i>Compraste un producto</a>
    <a class="dropdown-item notif text-primary" href="" id="mensaje-notif"><i class="far fa-envelope"></i>Tienes un nuevo mensaje</a>
    <?php foreach($notificaciones as $notificación){ ?>
      <a class="dropdown-item notif text-primary" href="<?php echo base_url('usuario'); ?>"><?php echo $notificación->NOTIFICACION_CONTENIDO; ?></a>
    <?php } ?>
  </div>
</div>
<?php } ?>
