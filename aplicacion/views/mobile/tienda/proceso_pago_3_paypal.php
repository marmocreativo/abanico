<style>
  /* -------------------------------------
      GLOBAL RESETS
  ------------------------------------- */

  /*All the styling goes here*/

  img {
    border: none;
    -ms-interpolation-mode: bicubic;
    max-width: 100%;
  }
  body {
    background-color: #f6f6f6;
    font-family: sans-serif;
    -webkit-font-smoothing: antialiased;
    font-size: 14px;
    line-height: 1.4;
    margin: 0;
    padding: 0;
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
  }
  table {
    border-collapse: separate;
    mso-table-lspace: 0pt;
    mso-table-rspace: 0pt;
    width: 100%; }
    table td {
      font-family: sans-serif;
      font-size: 14px;
      vertical-align: top;
  }
  /* -------------------------------------
      BODY & CONTAINER
  ------------------------------------- */
  .body {
    background-color: #f6f6f6;
    width: 100%;
  }
  /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
  .container {
    display: block;
    Margin: 0 auto !important;
    /* makes it centered */
    max-width: 960px;
    padding: 10px;
    min-width: 320px;
  }
  /* This should also be a block element, so that it will fill 100% of the .container */
  .content {
    box-sizing: border-box;
    display: block;
    Margin: 0 auto;
    max-width: 960px;
    padding: 10px;
  }
  tbody {
  }
  /* -------------------------------------
      HEADER, FOOTER, MAIN
  ------------------------------------- */
  .main {
    background-color: rgb(236, 236, 239);
    border-radius: 3px;
    width: 100%;
  }
  .wrapper {
    box-sizing: border-box;
    /* padding: 20px; */
  }
  .head2 {
    padding: 40px;
  }
  .articulos {
    border-bottom:1px solid lightgray;
  }
  .content-block {
    padding-bottom: 10px;
    padding-top: 10px;
  }
  .footer {
    clear: both;
    Margin-top: 10px;
    text-align: center;
    width: 100%;
  }
    .footer td,
    .footer p,
    .footer span,
    .footer a {
      color: #999999;
      font-size: 12px;
      text-align: center;
  }
  /* -------------------------------------
      TYPOGRAPHY
  ------------------------------------- */
  h1,
  h2,
  h3,
  h4 {
    color: #000000;
    font-family: sans-serif;
    font-weight: 400;
    line-height: 1.4;
    margin: 0;
    margin-bottom: 30px;
  }
  h1 {
    font-size: 35px;
    font-weight: 300;
    text-align: center;
    text-transform: capitalize;
  }
  h5 {
    font-size: 12px;
    margin: 0
  }
  p,
  ul,
  ol {
    font-family: sans-serif;
    font-size: 14px;
    font-weight: normal;
    margin: 0;
    /* margin-bottom: 15px; */
  }
    p li,
    ul li,
    ol li {
      list-style-position: inside;
      margin-left: 5px;
  }
  a {
    color: #3498db;
    text-decoration: underline;
  }
  /* -------------------------------------
      BUTTONS
  ------------------------------------- */
  .btn {
    box-sizing: border-box;
    width: 100%; }
    .btn > tbody > tr > td {
      padding-bottom: 15px; }
    .btn table {
      width: auto;
  }
    .btn table td {
      background-color: #ffffff;
      border-radius: 5px;
      text-align: center;
  }
    .btn a {
      background-color: #ffffff;
      border: solid 1px #3498db;
      border-radius: 5px;
      box-sizing: border-box;
      color: #3498db;
      cursor: pointer;
      display: inline-block;
      font-size: 14px;
      font-weight: bold;
      margin: 0;
      padding: 12px 25px;
      text-decoration: none;
      text-transform: capitalize;
  }
  .btn-primary table td {
    background-color: #3498db;
  }
  .btn-primary a {
    background-color: #3498db;
    border-color: #3498db;
    color: #ffffff;
  }
  /* -------------------------------------
      OTHER STYLES THAT MIGHT BE USEFUL
  ------------------------------------- */
  .last {
    margin-bottom: 0;
  }
  .first {
    margin-top: 0;
  }
  .align-center {
    text-align: center;
  }
  .align-right {
    text-align: right;
  }
  .align-left {
    text-align: left;
  }
  .clear {
    clear: both;
  }
  .mt0 {
    margin-top: 0;
  }
  .mb0 {
    margin-bottom: 0;
  }
  .preheader {
    color: transparent;
    display: none;
    height: 0;
    max-height: 0;
    max-width: 0;
    opacity: 0;
    overflow: hidden;
    mso-hide: all;
    visibility: hidden;
    width: 0;
  }
  .powered-by a {
    text-decoration: none;
  }
  hr {
    border: 0;
    border-bottom: 1px solid #f6f6f6;
    Margin: 20px 0;
  }
  .head2{
    background-repeat: no-repeat;
    background-position: top center;
  }
  /* -------------------------------------
      RESPONSIVE AND MOBILE FRIENDLY STYLES
  ------------------------------------- */
  @media only screen and (max-width: 620px) {
    table[class=body] h1 {
      font-size: 28px !important;
      margin-bottom: 10px !important;
    }
    table[class=body] p,
    table[class=body] ul,
    table[class=body] ol,
    table[class=body] td,
    table[class=body] span,
    table[class=body] a {
      font-size: 16px !important;
    }
    table[class=body] .wrapper,
    table[class=body] .article {
      padding: 10px !important;
    }
    table[class=body] .content {
      padding: 0 !important;
    }
    table[class=body] .container {
      padding: 0 !important;
      width: 100% !important;
    }
    table[class=body] .main {
      border-left-width: 0 !important;
      border-radius: 0 !important;
      border-right-width: 0 !important;
    }
    table[class=body] .btn table {
      width: 100% !important;
    }
    table[class=body] .btn a {
      width: 100% !important;
    }
    table[class=body] .img-responsive {
      height: auto !important;
      max-width: 100% !important;
      width: auto !important;
    }
    .head2{
      background-size: contain;
    }
  }
  /* -------------------------------------
      PRESERVE THESE STYLES IN THE HEAD
  ------------------------------------- */
  @media all {
    .ExternalClass {
      width: 100%;
    }
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
      line-height: 100%;
    }
    .apple-link a {
      color: inherit !important;
      font-family: inherit !important;
      font-size: inherit !important;
      font-weight: inherit !important;
      line-height: inherit !important;
      text-decoration: none !important;
    }
    .btn-primary table td:hover {
      background-color: #34495e !important;
    }
    .btn-primary a:hover {
      background-color: #34495e !important;
      border-color: #34495e !important;
    }
  }
</style>
<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card mb-3">
          <div class="card-body">
            <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" class="btn btn-default btn-circle" disabled="disabled">1</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-default btn-circle"  disabled="disabled" >2</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-primary btn-circle">3</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col text-left">
                <span class="preheader">Abanico siempre lo mejor</span>
                <table role="presentation" class="main">

                  <!-- START MAIN CONTENT AREA -->
                  <tr>
                    <td class="wrapper">
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>
                            <table class="table" role="presentation" border="0" cellpadding="20" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px; text-align: center;">
                                        <img src="<?php echo base_url('assets/global/img/logo.png'); ?>" alt="" width="100px">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="head2" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-weight: 600; text-align: center; border-top: 1px solid lightgray;background-image: url('<?php echo base_url('assets/global/img/pleca_mail_2.png'); ?>'); backgroun-repeat:no-repeat;">
                                      <h4 style="margin:0;color:#495057;"><strong>Serás redireccionado a la pasarela de pago de PayPal</strong></h4>
                                    </td>
                                </tr>
                              </tbody>
                            </table>
                          <table class="table" cellpadding="20" cellspacing="0" style="width:96%; margin:2%; color: #495057;">
                            <tbody>
                              <tr>
                                <td colspan="1" style="vertical-align:middle; font-size:16px;">
                                  <img src="<?php echo base_url('assets/global/img/paypal.png'); ?>" style="float:left; margin-right:15px;" width="100%" alt="">
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3" style="vertical-align:middle; font-size:16px; border-left:solid 1px lightgrey">

                                  <h4 style="margin:0;color:#495057;border-bottom:solid 1px lightgrey"><strong>Referencia:</strong>Abanico <?php echo $_POST['Folio']; ?></h5>
                                  <h3 style="margin:0;color:#af3193;"><strong>Monto a pagar</strong><br />$<?php echo number_format($_POST['ImporteTotal'],2); ?> <?php echo $_POST['Divisa']; ?></h4>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" style="vertical-align:middle; font-size:16px; border-left:solid 1px lightgrey">
                                  <form class="d-flex justify-content-end" id="paypalForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                      <input type="hidden" name="cmd" value="_xclick">
                                      <!--
                                        <input type="hidden" name="business" value="marmocreativo@gmail.com">
                                      -->

                                      <input type="hidden" name="business" value="abanico0918@aol.com">
                                      <input type="hidden" name="item_name" value="Abanico <?php echo $_POST['Folio']; ?>">
                                      <input type="hidden" name="item_number" value="<?php echo $_POST['Folio']; ?>">
                                      <input type="hidden" name="amount" value="<?php echo $_POST['ImporteTotal']; ?>">
                                      <input type="hidden" name="currency_code" value="<?php echo $_POST['Divisa']; ?>">
                                      <input type="hidden" name="return" value="<?php echo base_url('proceso_pago_4?pago=paypal'); ?>">
                                      <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo $this->lang->line('proceso_pago_3_paypal'); ?> <span class="fab fa-paypal"></span></button>
                                  </form>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          </td>
                        </tr>
                      </table>
                      <table border="0" cellpadding="5" cellspacing="0">
                        <tbody>
                          <tr>
                            <td style="background:#73C8C8;"></td>
                            <td style="background:#AD3692;"></td>
                            <td style="background:#EEC830;"></td>
                            <td style="background:#A5C845;"></td>
                            <td style="background:#AD36F7;"></td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>

                <!-- END MAIN CONTENT AREA -->
                </table>
              </div>
              <?php
              if(isset($_SESSION['pedido'])&&!empty($_SESSION['pedido'])){
                  unset($_SESSION['pedido']);
              }
              $_SESSION['pedido'] = array();
                //CREO LA SESIÖN CON LOS DATOS DEL PEDIDO

                $_SESSION['pedido']['Folio'] = $_POST['Folio'];
                $_SESSION['pedido']['IdUsuario'] = $_POST['IdUsuario'];
                $_SESSION['pedido']['PedidoNombre'] = $_POST['PedidoNombre'];
                $_SESSION['pedido']['PedidoCorreo'] = $_POST['PedidoCorreo'];
                $_SESSION['pedido']['PedidoTelefono'] = $_POST['PedidoTelefono'];
                $_SESSION['pedido']['IdDireccion'] = $_POST['IdDireccion'];
                $_SESSION['pedido']['Direccion'] = $_POST['Direccion'];
                $_SESSION['pedido']['Divisa'] = $_POST['Divisa'];
                $_SESSION['pedido']['Conversion'] = $_POST['Conversion'];
                $_SESSION['pedido']['ImporteProductosParcial'] = $_POST['ImporteProductosParcial'];
                $_SESSION['pedido']['ImporteProductosTotal'] = $_POST['ImporteProductosTotal'];
                $_SESSION['pedido']['ImporteEnvioParcial'] = $_POST['ImporteEnvioParcial'];
                $_SESSION['pedido']['ImporteEnvioTotal'] = $_POST['ImporteEnvioTotal'];
                $_SESSION['pedido']['PedidosTiendas'] = $_POST['PedidosTiendas'];
                $_SESSION['pedido']['ComisionServicioFinancieroPorcentaje'] = $_POST['ComisionServicioFinancieroPorcentaje'];
                $_SESSION['pedido']['ComisionServicioFinancieroFijo'] = $_POST['ComisionServicioFinancieroFijo'];
                $_SESSION['pedido']['ImporteTotal'] = $_POST['ImporteTotal'];
                $_SESSION['pedido']['IdTransportista'] = $_POST['IdTransportista'];
                $_SESSION['pedido']['NombreTransportista'] = $_POST['NombreTransportista'];
                $_SESSION['pedido']['FormaPago'] = 'PayPal';
                $_SESSION['pedido']['EstadoPago'] = 'Pagado';
                $_SESSION['pedido']['EstadoPedido'] = 'Pagado';
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
