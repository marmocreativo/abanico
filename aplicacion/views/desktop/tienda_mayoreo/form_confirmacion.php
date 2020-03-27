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
            <label for="Comprador">¿Quién compra?</label>
            <select class="form-control Comprador" name="Comprador">
              <option value="nueva">Nuevo Cliente</option>
              <optgroup label="Negocios registrados">
              <?php foreach($empresas as $empresa){ ?>
                <option value="<?php echo $empresa->ID; ?>"><?php echo $empresa->EMPRESA_NOMBRE.' '.$empresa->RFC; ?></option>
              <?php } ?>
              </optgroup>
            </select>
          </div>
          <div id="colapsar_form_empresa">
            <div class="form-group">
              <label for="NombreEmpresa">Nombre del negocio</label>
              <input type="text" class="form-control" name="NombreEmpresa" value="" required>
            </div>
            <div class="form-group">
              <label for="NombreContacto">Nombre del cliente<small> Persona de contacto </small></label>
              <input type="text" class="form-control" name="NombreContacto" value="">
            </div>
            <div class="form-group">
              <label for="CorreoContacto">Correo <small> Persona de contacto </small></label>
              <input type="text" class="form-control" name="CorreoContacto" value="">
            </div>
            <div class="form-group">
              <label for="TelefonoContacto">Teléfono <small> Persona de contacto </small></label>
              <input type="text" class="form-control" name="TelefonoContacto" value="">
            </div>
            <div class="form-group">
              <label for="DireccionPedido">Dirección donde se deja el producto</label>
              <textarea name="DireccionPedido" class="form-control" rows="5"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="Factura">¿Va a requerir factura?</label>
            <select class="form-control" name="Factura">
              <option value="no">No requiere factura</option>
              <option value="si">Si requiere factura</option>
            </select>
          </div>
      </div>
      <div class="col-12">
        <div class="CargarCarritoMayoreo">

        </div>
      </div>
      <div class="col-12 mb-3">
        <div class="form-group">
          <label for="DejasProducto">¿Dejas los producto en este momento?</label>
          <select class="form-control" id="DejasProducto" name="DejasProducto">
            <option value="si">Si</option>
            <option value="no">No, Se entregará después</option>
          </select>
        </div>
        <!-- Espacio para fecha -->
        <div id="fecha_entrega" class="collapse">
          <div class="form-group">
            <label for="FechaEntrega">Dia</label>
            <input type="date" name="FechaEntrega" class="form-control" value="">
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
        </div>
        <!-- Espacio para fecha -->
        <div class="form-group">
          <label for="PagarAhora">¿Te pagarán en este momento?</label>
          <select class="form-control" name="PagarAhora">
            <option value="si_efectivo">Si, en efectivo</option>
            <option value="no_contra_entrega">No, pagarán al recibir los productos</option>
            <option value="no_comision">No, se quedan a comisión</option>
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
