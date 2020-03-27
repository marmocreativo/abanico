<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h3>Pedido folio: <b><?php echo $pedido['PEDIDO_FOLIO']; ?></b></h3>
        <h4>Confirmas que vas a entregar los productos completos</h4>
      </div>
    </div>
    <form class="" action="<?php echo base_url('tienda-mayoreo/form_entregar_pedido'); ?>" method="post">
    <input type="hidden" name="Identificador" value="<?php echo $pedido['ID_PEDIDO']; ?>">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <div class="form-group">
            <label for="PagarAhora">¿Te pagarán en este momento?</label>
            <select class="form-control" name="PagarAhora">
              <option value="si_efectivo">Si, en efectivo</option>
              <option value="no_comision">No, se quedan a comisión</option>
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary-17 btn-lg btn-block"> <i class="fa fa-save"></i> Confirmar entrega</button>
      </div>
    </div>
    </form>
  </div>
</div>
