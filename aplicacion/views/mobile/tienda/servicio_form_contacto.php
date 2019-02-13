<div class="bxInfoContent bxDetalle pb-4">
  <div class="container">
    <?php echo retro_alimentacion(); ?>
    <div class="row mt-3">
      <div class="col-4 mb-4">
        <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
        <img src="<?php echo base_url($ruta_portada) ?>" class="img-thumbnail img-fluid" alt="Profile image example">
      </div>
      <div class="col-8 mb-4">
        <h4 class="h4 product-title mb-2"><?php echo $servicio['SERVICIO_NOMBRE']; ?> </h4>
        <?php echo $servicio['USUARIO_NOMBRE']; ?>
        <p><?php echo $servicio['SERVICIO_DESCRIPCION']; ?></p>
      </div>

      <div class="col-12 mb-4">
        <div class="row">
          <div class="col">
            <form class="" action="<?php echo base_url('servicio/contacto'); ?>" method="post">
              <input type="hidden" name="IdReceptor" value="<?php echo $servicio['ID_USUARIO']; ?>">
              <input type="hidden" name="IdRemitente" value="<?php echo $_SESSION['usuario']['id']; ?>">
              <input type="hidden" name="ServicioNombre" value="<?php echo $servicio['SERVICIO_NOMBRE']; ?>">
              <input type="hidden" name="IdServicio" value="<?php echo $servicio['ID_SERVICIO']; ?>">
              <div class="row">
                <table class="table">
                  <tr>
                    <td><strong><?php echo $this->lang->line('pagina_servicio_formulario_contacto_remitente'); ?>:</strong></td>
                    <td><?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']?></td>
                  </tr>
                  <tr>
                    <td><strong><?php echo $this->lang->line('pagina_servicio_formulario_contacto_receptor'); ?>:</strong></td>
                    <td><?php echo $servicio['USUARIO_NOMBRE']; ?></td>
                  </tr>
                </table>
              </div>
              <p> <i class="fa fa-info-circle"></i> <?php echo $this->lang->line('pagina_servicio_formulario_contacto_descripcion'); ?></p>
              <div class="form-group">
                <label for="MensajeTexto"><?php echo $this->lang->line('pagina_servicio_formulario_contacto_mensaje'); ?></label>
                <textarea class="form-control" name="MensajeTexto" rows="8" required></textarea>
              </div>
              <button class="btn <?php echo 'btn'.$primary; ?> float-right"> <span class="fa fa-envelope"></span> <?php echo $this->lang->line('pagina_servicio_formulario_contacto_contactar'); ?></button>
            </form>
          </div>
        </div>
      </div>

      </div>

      </div>

    </div>
  </div>
</div>
