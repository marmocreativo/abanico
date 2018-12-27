<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" class="btn btn-default btn-circle" disabled="disabled">1</a>
                  <p>Identificación</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-default btn-circle"  disabled="disabled" >2</a>
                  <p>Dirección</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-default btn-circle"  disabled="disabled">3</a>
                  <p>Pago</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-primary btn-circle" disabled="disabled">4</a>
                  <p>Confirmación</p>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col text-center">
                <h5>Simulación de Pedido Completo</h5>
                <h5>El carrito se ha vaciado</h5>
                <div class="alert alert-info">
                  <p> <strong>Notas del desarrollo: </strong> Antes de llegar a esta pantalla se hará la comprobación de pago con Paypal o algún otro servicio, en caso de que el pago no se confirme se regresará al paso anterior.</p>
                  <p>Les llegarán avisos por correo electrónico de los pedidos. a las "Tiendas" involucradas en la venta</p>
                </div>
                <a href="<?php echo base_url('usuario'); ?>" class="btn btn-outline-info btn-block">Regresar a tu perfil</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
