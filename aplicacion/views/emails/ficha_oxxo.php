<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Abanico | Contraseña Olvidada</title>
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
                        <table role="presentation" border="0" cellpadding="20" cellspacing="0" >
                          <tbody>
                            <tr>
                              <td style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px; text-align: center;">
                                <img src="<?php echo base_url('assets/global/img/logo_correo.png'); ?>" alt="" width="200px">
                              </td>
                            </tr>
                            <tr>
                              <td class="head2" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-weight: 600; text-align: center; border-top: 1px solid lightgray;background-image: url('<?php echo base_url('assets/global/img/pleca_mail.png'); ?>')">
                                <h2 style="margin:0;color:#495057;"><strong>Ficha de pago OXXOPay.</strong></h2>
                                <h3 style="margin:0;color:#495057;">Ficha digital. No es necesario imprimir.</h3>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <table style="width:96%; margin:2%; color: #495057;">
                      <tr>
                        <td style="text-align:right; width:50%">
                            <img src="<?php echo base_url('assets/global/img/oxxopay_brand.png'); ?>" alt="OXXOPay" style="margin: 0;padding: 0;max-width: 150px;margin-top: 2px;margin-right:10px;">
                        </td>
                        <td>
                          <h3 style="margin: 0;padding: 0;margin-bottom: 10px;font-size: 15px;font-weight: 600;text-transform: uppercase;">Monto a pagar</h3>
                          <h2 style="margin: 0;padding: 0;font-size: 36px;color: #000000;line-height: 24px;margin-bottom: 15px;">$<?php echo $info['Monto'] ?> <sup style="margin: 0;padding: 0;font-size: 16px;position: relative;top: -2px;">MXN</sup></h2>
                          <p style="margin: 0;padding: 0;font-size: 10px;line-height: 14px;">OXXO cobrará una comisión adicional al momento de realizar el pago.</p>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <h3 style="margin: 0;padding: 0;margin-bottom: 10px;font-size: 15px;font-weight: 600;">Referencia</h3>
                          <h1 style="margin: 0 0 20px 0;padding: 6px 0 7px;font-size: 27px;margin-top: -1px;border: 1px solid #b0afb5;border-radius: 4px;background: #f8f9fa;"><?php echo $info['Referencia'] ?></h1>

                          <h3 style="margin: 0;padding: 0;margin-bottom: 10px;font-size: 15px;font-weight: 600;">Instrucciones</h3>
                          <ol style="margin: 17px 0 0 16px;padding: 0;">
                            <li style="margin: 0;padding: 0;">Acude a la tienda OXXO más cercana. <a href="https://www.google.com.mx/maps/search/oxxo/" target="_blank" style="margin: 0;padding: 0;color: #1155cc;">Encuéntrala aquí</a>.</li>
                            <li style="margin: 0;padding: 0;margin-top: 10px;">Indica en caja que quieres realizar un pago de <strong style="margin: 0;padding: 0;">OXXOPay</strong>.</li>
                            <li style="margin: 0;padding: 0;margin-top: 10px;">Dicta al cajero el número de referencia en esta ficha para que tecleé directamete en la pantalla de venta.</li>
                            <li style="margin: 0;padding: 0;margin-top: 10px;">Realiza el pago correspondiente con dinero en efectivo.</li>
                            <li style="margin: 0;padding: 0;margin-top: 10px;">Al confirmar tu pago, el cajero te entregará un comprobante impreso.<strong style="margin: 0;padding: 0;">En el podrás verificar que se haya realizado correctamente.</strong> Conserva este comprobante de pago.</li>
                          </ol>
                        </td>
                      </tr>
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
