<?php
if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
  $notificaciones = $this->NotificacionesModel->lista($_SESSION['usuario']['id'],10);
  $notificaciones_no_leidas = $this->NotificacionesModel->conteo_no_leidas($_SESSION['usuario']['id']);
?>
<div class="btn-group" role="group">
  <button id="btnNotificaciones" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-bell"></i> <?php if($notificaciones_no_leidas>0){ echo '<span class="badge badge-danger">'.$notificaciones_no_leidas.'</span>'; } ?>
  </button>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnNotificaciones">
    <?php foreach($notificaciones as $notificación){ ?>
      <a class="dropdown-item" href="<?php echo base_url('usuario'); ?>"><?php echo $notificación->NOTIFICACION_CONTENIDO; ?></a>
    <?php } ?>
  </div>
</div>
<?php } ?>
