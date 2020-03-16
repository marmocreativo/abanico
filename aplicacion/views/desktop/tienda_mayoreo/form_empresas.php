<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h1>Nueva Empresa</h1>
      </div>
    </div>
    <div class="row">
      <div class="col mb-3">
        <form class="" action="<?php echo base_url('tienda-mayoreo/crear_empresa'); ?>" method="post">
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
            <input type="text" class="form-control" name="CorreoContacto" value="" required>
          </div>
          <div class="form-group">
            <label for="TelefonoContacto">Teléfono <small> Persona de contacto </small></label>
            <input type="text" class="form-control" name="TelefonoContacto" value="">
          </div>
          <hr>
          <div class="form-group">
            <label for="RazonSocialEmpresa">Razón Social <small>(Para facturación)</small></label>
            <input type="text" class="form-control" name="RazonSocialEmpresa" value="">
          </div>
          <div class="form-group">
            <label for="RfcEmpresa">RFC <small>(Para facturación)</small></label>
            <input type="text" class="form-control" name="RfcEmpresa" value="">
          </div>
          <div class="form-group">
            <label for="DireccionEmpresa">Direccion <small>(Para facturación)</small></label>
            <textarea name="DireccionEmpresa" class="form-control" rows="5"></textarea>
          </div>
          <button type="submit" class="btn btn-success btn-block"> <i class="fa fa-save"></i> Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
