<div class="contenido_principal">
  <div class="fila">
    <div class="container">
      <div class="row">
        <div class="col">
          <?php echo retro_alimentacion(); ?>
          <!-- Fila de Galer+ia y Datos principales -->
          <div class="row">
            <div class="col-3">
              <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
              <img src="<?php echo base_url($ruta_portada) ?>" alt="" class="img-fluid">
            </div>
            <div class="col">
              <div class="product-payment-details">
                <h4>Solicitar Servicio</h4>
                <h6 class="mb-2"><?php echo $servicio['SERVICIO_NOMBRE']; ?></h6>
                <hr>
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
                            <td><strong>Remitente:</strong></td>
                            <td><?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']?></td>
                          </tr>
                          <tr>
                            <td><strong>Receptor:</strong></td>
                            <td><?php echo $servicio['USUARIO_NOMBRE']; ?></td>
                          </tr>
                        </table>
                      </div>
                      <p> <i class="fa fa-info-circle"></i> Ofrece la información necesaria para que se te pueda presentar una cotización completa</p>
                      <div class="form-group">
                        <label for="MensajeTexto">Mensaje</label>
                        <textarea class="form-control" name="MensajeTexto" rows="8" required></textarea>
                      </div>
                      <button class="btn <?php echo 'btn'.$primary; ?> float-right"> <span class="fa fa-envelope"></span> Contactar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
