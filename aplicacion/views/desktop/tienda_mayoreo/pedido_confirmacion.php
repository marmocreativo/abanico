<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h1>Confirmacion</h1>
      </div>
    </div>

  <form class="" action="<?php echo base_url('tienda-mayoreo/crear_pedido'); ?>" method="post">
    <div class="row">
      <div class="col-12">
          <div class="form-group">
            <label for="Comprador">¿Quién está haciendo la compra?</label>
            <select class="form-control Comprador" name="Comprador">
              <option value="nueva">Nueva empresa</option>
              <option value="auto">Venta directa</option>
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
          </div>
      </div>
      <div class="col-12">
        <div class="CargarCarritoMayoreo">

        </div>
      </div>
      <div class="col-12 mb-3">
        <div class="form-group">
          <label for="TipoPedido">Cuando se pagará este pedido?:</label>
          <select class="form-control" name="TipoPedido">
            <option value="pago_inmediato">Pago inmediato</option>
            <option value="contra_entrega">Pago contra entrega</option>
            <option value="comision">Productos a comision</option>
          </select>
        </div>
        <label for="">Firma de confirmación:</label>
        <canvas style="border: solid 1px #000; min-width:300px; max-width:1600px;"></canvas>
        <button type="submit" class="btn btn-primary-17 btn-lg btn-block text-white"> <i class="fa fa-check"></i> Confirmar </button>
      </div>
    </div>
  </form>

  </div>
</div>
