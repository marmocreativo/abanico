<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h1>Nueva Empresa</h1>
      </div>
    </div>
    <div class="row">
      <div class="col mb-3">
        <form class="" action="<?php echo base_url('tienda-mayoreo/actualizar_empresa'); ?>" method="post">
          <input type="hidden" name="Identificador" value="<?php echo $empresa['ID'] ?>">
          <div class="form-group">
            <label for="NombreEmpresa">Nombre de la empresa</label>
            <input type="text" class="form-control" name="NombreEmpresa" value="<?php echo $empresa['EMPRESA_NOMBRE'] ?>" required>
          </div>
          <div class="form-group">
            <label for="NombreContacto">Nombre <small> Persona de contacto </small></label>
            <input type="text" class="form-control" name="NombreContacto" value="<?php echo $empresa['CONTACTO_NOMBRE'] ?>">
          </div>
          <div class="form-group">
            <label for="ApellidosContacto">Apellidos <small> Persona de contacto </small></label>
            <input type="text" class="form-control" name="ApellidosContacto" value="<?php echo $empresa['CONTACTO_APELLIDOS'] ?>">
          </div>
          <div class="form-group">
            <label for="CorreoContacto">Correo <small> Persona de contacto </small></label>
            <input type="text" class="form-control" name="CorreoContacto" value="<?php echo $empresa['CONTACTO_CORREO'] ?>">
          </div>
          <div class="form-group">
            <label for="TelefonoContacto">Teléfono <small> Persona de contacto </small></label>
            <input type="text" class="form-control" name="TelefonoContacto" value="<?php echo $empresa['TELEFONO'] ?>">
          </div>
          <hr>
          <div class="form-group">
            <label for="RazonSocialEmpresa">Razón Social <small>(Para facturación)</small></label>
            <input type="text" class="form-control" name="RazonSocialEmpresa" value="<?php echo $empresa['RAZON_SOCIAL'] ?>">
          </div>
          <div class="form-group">
            <label for="RfcEmpresa">RFC <small>(Para facturación)</small></label>
            <input type="text" class="form-control" name="RfcEmpresa" value="<?php echo $empresa['RFC'] ?>">
          </div>
          <div class="form-group">
            <label for="DireccionEmpresa">Direccion <small>(Para facturación)</small></label>
            <textarea name="DireccionEmpresa" class="form-control" rows="5"><?php echo $empresa['DOMICILIO'] ?></textarea>
          </div>
          <button type="submit" class="btn btn-success btn-block"> <i class="fa fa-save"></i> Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
