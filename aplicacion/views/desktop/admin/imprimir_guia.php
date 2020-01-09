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
        font-size: 30px;
      }
      h4{
        font-size: 30px;
      }
      p{
        font-size: 24px;
      }
      .parrafo-peque{
        font-size: 12px;
      }
    </style>
    <title>Guia</title>
  </head>
  <body>
    <div class="container-fluid">
      <?php if(isset($_GET['copias'])&&!empty($_GET['copias'])){ $copias = $_GET['copias']; }else{ $copias = 2;} ?>
      <div class="row mt-3">
        <?php for($i=1; $i<=$copias; $i++){ ?>
        <div class="col-6 p-0">
          <table class="table table-bordered">
            <tr>
              <td>
                <h2>Abanico <small>Siempre lo mejor</small></h2>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Destinatario</h4>
                <p> <?php echo $guia['GUIA_NOMBRE'] ?></p>
                <p> <?php echo $guia['GUIA_DIRECCION'] ?></p>
                <p> <?php echo $guia['GUIA_TELEFONO'] ?></p>
                <p> <?php echo $guia['GUIA_CORREO'] ?></p>
                <h4>Remitente</h4>
                <p class="parrafo-peque"> ABANICO SIEMPRE LO MEJOR </p>
                <p class="parrafo-peque"> GREGORIO V GELATI 14 DEPTO.  5, COLONIA SAN MIGUEL CHAPULTEPEC, DELEGACIÓN MIGUEL HIDALGO, CP 11850, CIUDAD DE MÉXICO</p>
              </td>
            </tr>
            <tr>
              <td>
              <h4><b>No.</b> <?php echo $guia['GUIA_CODIGO']; ?></h4>
              <?php
              require_once(APPPATH.'libraries/barcode/BarcodeGenerator.php');
          		require_once(APPPATH.'libraries/barcode/BarcodeGeneratorHTML.php');
          		$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
          		echo $generator->getBarcode($guia['GUIA_CODIGO'], $generator::TYPE_CODE_128);
              ?>
            </td>
            </tr>
          </table>
        </div>
      <?php } ?>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
