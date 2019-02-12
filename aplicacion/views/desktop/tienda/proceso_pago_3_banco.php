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
                  <p><?php echo $this->lang->line('proceso_pago_1_identificacion'); ?></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-default btn-circle"  disabled="disabled" >2</a>
                  <p><?php echo $this->lang->line('proceso_pago_1_direccion'); ?></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-primary btn-circle">3</a>
                  <p><?php echo $this->lang->line('proceso_pago_1_pago'); ?></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                  <p><?php echo $this->lang->line('proceso_pago_1_confirmacion'); ?></p>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col text-left">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td style="width:20%">
                        <img src="<?php echo base_url('assets/global/img/banco.png') ?>" alt="Banco" class="img-fluid">
                      </td>
                      <td style="width:80%">
                        <h4><?php echo $this->lang->line('proceso_pago_3_transferencia_instrucciones'); ?></h4>
                        <p>Scotiabank </p>
                        <p><?php echo $this->lang->line('proceso_pago_3_numero_cuenta'); ?>: 00106083517</p>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" class="p-0">
                        <table class="table">
                          <tr>
                            <td style="width:50%">
                              <h5><?php echo $this->lang->line('proceso_pago_3_monto_a_pagar'); ?></h5>
                              <h4>$<?php echo $_SESSION['pedido']['ImporteTotal']; ?> <small><?php echo $_SESSION['pedido']['Divisa']; ?></small> </h4>
                            </td>
                            <td style="width:50%">
                              <h5><?php echo $this->lang->line('proceso_pago_3_referencia'); ?></h5>
                              <h4><?php echo $_SESSION['pedido']['Folio']; ?></h4>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-12">
                <div class="row">
                  <div class="col">
                    <button type="button" name="button" class="btn btn-outline-success" onclick="window.print();"><i class="fa fa-print"></i> <?php echo $this->lang->line('proceso_pago_3_imprimir'); ?></button>
                  </div>
                  <div class="col">
                    <?php
                    $_SESSION['pedido']['FormaPago'] = 'Transferencia Bancaria';
                    $_SESSION['pedido']['EstadoPago'] = 'Pendiente';
                    $_SESSION['pedido']['EstadoPedido'] = 'Espera Pago';
                    ?>
                    <form class="d-flex justify-content-end" action="<?php echo base_url('proceso_pago_4'); ?>" method="post">
                      <button type="submit" class="btn btn-success"> <?php echo $this->lang->line('proceso_pago_3_terminar'); ?> <i class="fa fa-chevron-right"></i></button>
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
