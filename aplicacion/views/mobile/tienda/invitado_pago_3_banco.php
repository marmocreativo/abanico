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

          <h6 class="text-center mb-4"><i class="far fa-credit-card"></i> Pago</h6>
          <hr>

          <div class="card-body py-4">
            <div class="row">
              <div class="col-12">
                <img class="img-fluid mx-auto d-block mb-4" style="width:50%" src="http://localhost/abanico-master/assets/global/img/banco.png" alt="Banco">
                <h4 class="h5">Depósito/Transferencia Bancaria</h4>
                <p>Scotiabank </p>
                <p>No. Cuenta: 00106083517</p>
              </div>
            </div>
          </div>

          <hr>

          <div class="card-body">
            <h5>Monto a Pagar</h5>
            <h4>$822.00 <small>MXN</small> </h4>
          </div>

          <hr>

          <div class="card-body">
            <h5>Referencia</h5>
            <h4>H8TD6L</h4>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col">
                <button type="button" name="button" class="btn btn-sm btn-outline-success" onclick="window.print();"><i class="fa fa-print"></i> Imprimir</button>
              </div>
              <div class="col">
                <form class="d-flex justify-content-end" action="http://localhost/abanico-master/proceso_pago_4" method="post">
                  <button type="submit" class="btn btn-sm btn-success"> Terminar <i class="fa fa-chevron-right"></i></button>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- termina proceso de pago3 responsivo -->
<hr><hr><hr>

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
                  <a href="#step-3" class="btn btn-primary btn-circle">3</a>
                  <p>Pago</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                  <p>Confirmación</p>
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
                        <h4>Depósito/Transferencia Bancaria</h4>
                        <p>Scotiabank</p>
                        <p>No. Cuenta: 00106083517</p>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" class="p-0">
                        <table class="table">
                          <tr>
                            <td style="width:50%">
                              <h5>Monto a Pagar</h5>
                              <h4>$<?php echo $_SESSION['pedido']['ImporteTotal']; ?> <small><?php echo $_SESSION['pedido']['Divisa']; ?></small> </h4>
                            </td>
                            <td style="width:50%">
                              <h5>Referencia</h5>
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
                    <button type="button" name="button" class="btn btn-outline-success" onclick="window.print();"><i class="fa fa-print"></i> Imprimir</button>
                  </div>
                  <div class="col">
                    <?php
                    $_SESSION['pedido']['FormaPago'] = 'Transferencia Bancaria';
                    $_SESSION['pedido']['EstadoPago'] = 'Pendiente';
                    $_SESSION['pedido']['EstadoPedido'] = 'Espera Pago';
                    ?>
                    <form class="d-flex justify-content-end" action="<?php echo base_url('invitado_pago_4'); ?>" method="post">
                      <button type="submit" class="btn btn-success"> Terminar <i class="fa fa-chevron-right"></i></button>
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
