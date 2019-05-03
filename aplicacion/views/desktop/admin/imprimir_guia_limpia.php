<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style media="print">
      h2{
        font-size: 12px;
      }
      h4{
        font-size: 11px;
      }
      p{
        font-size: 9px;
      }
    </style>
    <title>Guia</title>
  </head>
  <body style="width:500px;">
    <div class="container-fluid">
      <div class="row mt-3">
        <div class="col-12 p-0">
          <table class="table table-bordered">
            <tr>
              <td>
                <h2>Abanico<br> <small>Siempre lo mejor</small></h2>
                <h4>Copia para Remitente</h4>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Destinatario</h4>
                <p> <b>Nombre:</b> <br><?php echo $pedido['PEDIDO_NOMBRE']; ?></p>
                <p> <b>Dirección:</b> <br><?php echo $pedido['PEDIDO_DIRECCION'] ?></p>
                <p> <b>Teléfono:</b> <br><?php echo $pedido['PEDIDO_TELEFONO'] ?></p>
                <p> <b>Correo:</b> <br><?php echo $pedido['PEDIDO_CORREO'] ?></p><h4>Remitente</h4>
                <p> <b>Nombre:</b> <br>ABANICO SIEMPRE LO MEJOR </p>
                <p> <b>Dirección:</b> <br>GREGORIO V GELATI 14 DEPTO.  5, COLONIA SAN MIGUEL CHAPULTEPEC, DELEGACIÓN MIGUEL HIDALGO, CP 11850, CIUDAD DE MÉXICO</p>              </td>
            </tr>
            <tr>
              <td>
              <h4><b>No.</b> <?php echo $pedido_tienda['GUIA_PAQUETERIA']; ?></h4>
            </td>
            </tr>
          </table>
        </div>
        <div class="col-12 p-0">
          <table class="table table-bordered">
            <tr>
              <td>
                <h2>Abanico<br> <small>Siempre lo mejor</small></h2>
                <h4>Copia para Envio</h4>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Destinatario</h4>
                <p> <b>Nombre:</b> <br><?php echo $pedido['PEDIDO_NOMBRE']; ?></p>
                <p> <b>Dirección:</b> <br><?php echo $pedido['PEDIDO_DIRECCION'] ?></p>
                <p> <b>Teléfono:</b> <br><?php echo $pedido['PEDIDO_TELEFONO'] ?></p>
                <p> <b>Correo:</b> <br><?php echo $pedido['PEDIDO_CORREO'] ?></p>
                <h4>Remitente</h4>
                <p> <b>Nombre:</b> <br>ABANICO SIEMPRE LO MEJOR </p>
                <p> <b>Dirección:</b> <br>GREGORIO V GELATI 14 DEPTO.  5, COLONIA SAN MIGUEL CHAPULTEPEC, DELEGACIÓN MIGUEL HIDALGO, CP 11850, CIUDAD DE MÉXICO</p>
              </td>
            </tr>
            <tr>
              <td>
              <h4><b>No.</b> <?php echo $pedido_tienda['GUIA_PAQUETERIA']; ?></h4>
            </td>
            </tr>
          </table>
        </div>
        <div class="col-12 p-0">
          <table class="table table-bordered">
            <tr>
              <td>
                <h2>Abanico<br> <small>Siempre lo mejor</small></h2>
                <h4>Copia para Vendedor</h4>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Destinatario</h4>
                <p> <b>Nombre:</b> <br><?php echo $pedido['PEDIDO_NOMBRE']; ?></p>
                <p> <b>Dirección:</b> <br><?php echo $pedido['PEDIDO_DIRECCION'] ?></p>
                <p> <b>Teléfono:</b> <br><?php echo $pedido['PEDIDO_TELEFONO'] ?></p>
                <p> <b>Correo:</b> <br><?php echo $pedido['PEDIDO_CORREO'] ?></p>
                <h4>Remitente</h4>
                <p> <b>Nombre:</b> <br>ABANICO SIEMPRE LO MEJOR </p>
                <p> <b>Dirección:</b> <br>GREGORIO V GELATI 14 DEPTO.  5, COLONIA SAN MIGUEL CHAPULTEPEC, DELEGACIÓN MIGUEL HIDALGO, CP 11850, CIUDAD DE MÉXICO</p>
              </td>
            </tr>
            <tr>
              <td>
              <h4><b>No.</b> <?php echo $pedido_tienda['GUIA_PAQUETERIA']; ?></h4>
            </td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script type="text/javascript">
      window.onload = function() { window.print(); window.close();}
    </script>
  </body>
</html>
