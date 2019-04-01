<!-- proceso de pago3 responsivo -->

<div class="procesoPago3">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card my-3">

          <div class="card-body">
            <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" class="btn btn-default btn-circle" disabled="disabled">1</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-default btn-circle" disabled="disabled">2</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-primary btn-circle">3</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                </div>
              </div>
            </div>
          </div>

          <h6 class="text-center mb-4"><i class="far fa-credit-card"></i> <?php echo $this->lang->line('proceso_pago_1_pago'); ?></h6>
          <hr>

          <div class="card-body py-4">
            <div class="row">
              <div class="col-12">
                <img class="img-fluid mx-auto d-block mb-4" style="width:50%" src="<?php echo base_url('assets/global/img/oxxo.png') ?>" alt="Banco">
                <h4 class="h5">Paga en cualquier tienda OXXO</h4>
                <p>Solicita en cualquier tienda OXXO de México, hacer el pago de tu compra a la siguiente tarjeta  </p>
                <p>No. Tarjeta: 00106083517</p>
              </div>
            </div>
          </div>

          <hr>

          <div class="card-body">
            <h5><?php echo $this->lang->line('proceso_pago_3_monto_a_pagar'); ?></h5>
            <h4>$<?php echo $_SESSION['pedido']['ImporteTotal']; ?> <small><?php echo $_SESSION['pedido']['Divisa']; ?></small> </h4>
          </div>

          <hr>

          <div class="card-body">
            <h5><?php echo $this->lang->line('proceso_pago_3_referencia'); ?></h5>
            <h4><?php echo $_SESSION['pedido']['Folio']; ?></h4>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col">
                <button type="button" name="button" class="btn btn-sm btn-outline-success" onclick="window.print();"><i class="fa fa-print"></i> <?php echo $this->lang->line('proceso_pago_3_imprimir'); ?></button>
              </div>
              <div class="col">
                <?php
                $_SESSION['pedido']['FormaPago'] = 'Transferencia Bancaria';
                $_SESSION['pedido']['EstadoPago'] = 'Pendiente';
                $_SESSION['pedido']['EstadoPedido'] = 'Espera Pago';
                ?>
                <form class="d-flex justify-content-end" action="<?php echo base_url('proceso_pago_4'); ?>" method="post">
                  <button type="submit" class="btn btn-sm btn-success"> <?php echo $this->lang->line('proceso_pago_3_terminar'); ?> <i class="fa fa-chevron-right"></i></button>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>