<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Tu Pedido Abanico</title>
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
        width: 960px;
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
        padding: 40px 0;
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
        margin-bottom: 15px;
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
        font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-weight: 600;
        text-align: center;
        border-top: 1px solid lightgray;
        background-image: url('<?php echo base_url('assets/global/img/pleca_mail_2.png'); ?>');
        background-size:cover;
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
          background-size:contain;
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
  </head>
  <body class="">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader">Abanico siempre lo mejor</span>
            <table role="presentation" class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <table role="presentation" border="0" cellpadding="20" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px; text-align: center;">
                                    <img src="<?php echo base_url('assets/global/img/logo_correo.png'); ?>" alt="" width="200px">
                                </td>
                            </tr>
                            <tr>
                                <td class="head2" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-weight: 600; text-align: center; border-top: 1px solid lightgray;background-image: url('<?php echo base_url('assets/global/img/pleca_mail.png'); ?>')">
                                  <h2 style="margin:0;color:#495057;"><strong>Hay un nuevo pedido en Abanico</strong></h2>
                                  <h3 style="margin:0;color:#495057;">Este es el folio: #<strong><?php echo $pedido['PEDIDO_FOLIO']; ?></strong></h3>
                                </td>
                            </tr>
                          </tbody>
                        </table>
                        <table role="presentation" border="0" cellpadding="5" cellspacing="15" style="margin:20px 20px;color:#495057;">
                        <tbody>
                            <tr>
                                <td style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px;">
                                    <span style="color:rgb(49, 52, 55);"><b><?php echo $pedido['PEDIDO_NOMBRE']; ?></b></span>
                                </td>
                                <td style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px;">
                                    <span style="color:rgb(49, 52, 55);"><b>Fecha:</b><?php echo $pedido['PEDIDO_FECHA_REGISTRO']; ?></span>
                                </td>
                            </tr>
                            <tr>
                              <td style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px;">
                                  <span style="color:rgb(49, 52, 55);"><b>E-mail:</b> <?php echo $pedido['PEDIDO_CORREO']; ?></span>
                              </td>
                              <td style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px;">
                                <span style="color:rgb(49, 52, 55);"><b>Tel:</b> <?php echo $pedido['PEDIDO_TELEFONO']; ?></span>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px;;">
                                    <span style="color:rgb(49, 52, 55);"><b>Dir.:</b> <br><?php echo $pedido['PEDIDO_DIRECCION']; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px;;">
                                </td>
                            </tr>
                      </tbody>
                      </table>
                      <table cellpadding="2" cellspacing="0" style="width:96%; margin:2%;">
                        <thead>
                          <tr style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px; color: #495057;">
                            <th style="width:10%; border-bottom: 1px solid lightgrey; padding:5px 0;"></th>
                            <th style="width:40%; border-bottom: 1px solid lightgrey; padding:5px 0;">Producto</th>
                            <th style="width:10%; border-bottom: 1px solid lightgrey; padding:5px 0; vertical-align:middle; text-align:center;">Cantidad</th>
                            <th style="width:20%; border-bottom: 1px solid lightgrey; padding:5px 0; vertical-align:middle; text-align:center;">Precio Unit.</th>
                            <th style="width:20%; border-bottom: 1px solid lightgrey; padding:5px 0; vertical-align:middle; text-align:center;">Importe</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($productos_tienda as $producto){ ?>
                            <tr>
                              <td style="vertical-align:middle; font-size:16px;">
                                  <img src="<?php echo $producto->PRODUCTO_IMAGEN; ?>" style="float:left; margin-right:15px;" width="70" alt="">
                              </td>
                              <td style="vertical-align:middle; font-size:16px;">
                                <h5><?php echo $producto->PRODUCTO_NOMBRE; ?></h5>
                                <p><?php echo $producto->PRODUCTO_DETALLES; ?></p>
                              </td>
                              <td style="vertical-align:middle; text-align:center; font-size:16px;">
                                <?php echo $producto->CANTIDAD; ?>
                              </td>
                              <td style="vertical-align:middle; text-align:center; font-size:16px;">
                                <small>$</small>
                                <?php echo $producto->IMPORTE; ?>
                                <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                              </td>
                              <td style="vertical-align:middle; text-align:center; font-size:16px;">
                                <small>$</small>
                                  <?php echo $producto->IMPORTE_TOTAL; ?>
                                <small><?php echo $pedido['PEDIDO_DIVISA']; ?></small>
                              </td>
                            </tr>
                          <?php } ?>
                          <tr>
                            <td colspan="5">
                            <table border="0" cellpadding="2" cellspacing="0" align="right" style="width:96%; margin:2%; border-top: 1px solid lightgray;margin-top: 20px;color: #495057;">
                                  <tr>
                                    <td style="width:20%; text-align:right;"></td>
                                    <td style="width:20%; text-align:right;"></td>
                                    <td style="width:20%; text-align:right;"></td>
                                      <td style="width:20%; text-align:right;"><h5>Importe Productos:</h5></td>
                                      <td style="width:20%; text-align:right;"><h5>$<strong><?php echo number_format($pedido_tienda ['PEDIDO_TIENDA_IMPORTE_PRODUCTOS'],2); ?></strong><?php echo $pedido['PEDIDO_DIVISA']; ?></h5></td>
                                  </tr>
                                  <tr>
                                    <td style="width:20%; text-align:right;"></td>
                                    <td style="width:20%; text-align:right;"></td>
                                    <td style="width:20%; text-align:right;"></td>
                                    <td style="width:20%; text-align:right;"><h5>Envio:</h5></td>
                                    <td style="width:20%; text-align:right;"><h5>$<strong><?php echo number_format($pedido_tienda ['PEDIDO_TIENDA_IMPORTE_ENVIO'],2); ?></strong><?php echo $pedido['PEDIDO_DIVISA']; ?></h5></td>
                                  </tr>

                                  <tr>
                                    <td colspan="5" style="text-align:right;">
                                      <p><?php echo $pedido_tienda['TRANSPORTISTA_NOMBRE']; ?></p>
                                    </td>
                                  </tr>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      </td>
                    </tr>
                    <tr>
                      <td style="background:#d0d6d8; border:none;text-align:center;">
                        <img src="<?php echo base_url('assets/global/img/camion_envio.png'); ?>" alt="" width="120px">
                        <h2 style="text-align:center; color:#495057;">¡Tu pedido estará pronto en camino!</h2>
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

            <!-- START FOOTER -->
            <!--
            <div class="footer">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
                    <br> Don't like these emails? <a href="http://i.imgur.com/CScmqnj.gif">Unsubscribe</a>.
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
                    Powered by <a href="http://htmlemail.io">HTMLemail</a>.
                  </td>
                </tr>
              </table>
            </div>
          -->
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
