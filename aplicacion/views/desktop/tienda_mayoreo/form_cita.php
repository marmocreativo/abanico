<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h1>Agendar cita</h1>
      </div>
    </div>

  <form class="" action="<?php echo base_url('tienda-mayoreo/crear_cita'); ?>" method="post">
    <div class="row">
      <div class="col-12">
            <div class="form-group">
              <label for="FechaCita">Dia</label>
              <input type="date" name="FechaCita" class="form-control" value="" required>
            </div>
            <div class="row">
              <div class="col-12">
                <p>Hora</p>
              </div>
              <div class="col pr-1">
                <div class="form-group">
                  <select class="form-control" name="Hora">
                    <?php for($i=1; $i<=12; $i++){?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col p-1">
                <div class="form-group">
                  <select class="form-control" name="Minutos">
                    <?php for($i=0; $i<=59; $i+=5){?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col pl-1">
                <div class="form-group">
                  <select class="form-control" name="AmPm">
                    <option value="am">AM</option>
                    <option value="pm">PM</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="Comprador">¿Con quien es la cita?</label>
              <select class="form-control Comprador" name="Comprador">
                <option value="nueva">Nueva empresa</option>
                <?php foreach($empresas as $empresa){ ?>
                  <option value="<?php echo $empresa->ID; ?>"><?php echo $empresa->EMPRESA_NOMBRE.' '.$empresa->RFC; ?></option>
                <?php } ?>
              </select>
            </div>
          <div id="colapsar_form_empresa">
            <div class="form-group">
              <label for="NombreEmpresa">Nombre de la empresa</label>
              <input type="text" class="form-control" name="NombreEmpresa" value="" required>
            </div>
            <div class="form-group">
              <label for="NombreContacto">Nombre <small> Persona de contacto </small></label>
              <input type="text" class="form-control" name="NombreContacto" value="">
            </div>
            <div class="form-group">
              <label for="ApellidosContacto">Apellidos <small> Persona de contacto </small></label>
              <input type="text" class="form-control" name="ApellidosContacto" value="">
            </div>
            <div class="form-group">
              <label for="CorreoContacto">Correo <small> Persona de contacto </small></label>
              <input type="text" class="form-control" name="CorreoContacto" value="">
            </div>
            <div class="form-group">
              <label for="TelefonoContacto">Teléfono <small> Persona de contacto </small></label>
              <input type="text" class="form-control" name="TelefonoContacto" value="">
            </div>
            <hr>
            <div class="form-group">
              <label for="DireccionEmpresa">Direccion <small>(Para facturación)</small></label>
              <textarea name="DireccionEmpresa" class="form-control" rows="5"></textarea>
            </div>
          </div>

          <button type="submit" class="btn btn-primary-17 btn-lg btn-block text-white"> <i class="fa fa-check"></i> Confirmar </button>
      </div>

    </div>
  </form>

  </div>
</div>
