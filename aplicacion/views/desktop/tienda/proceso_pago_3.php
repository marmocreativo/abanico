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
              <div class="col">
                <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong><?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'] ?></strong>
                        <br>
                        <?php echo $_SESSION['usuario']['correo']; ?>
                        <br>
                        <?php echo $direccion; ?>
                        <br>
                        <?php echo $usuario['USUARIO_TELEFONO']; ?>
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Fecha: <?php echo date('d / m / Y'); ?></em>
                    </p>
                    <p>
                        <em>Folio #: 34522677W</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h5>Pedido</h5>
                </div>
                </span>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $suma_productos = 0;?>
                    <?php $envio = 100.00;?>
                    <?php if(!empty($_SESSION['carrito']['productos'] )){ ?>
                    <?php foreach($_SESSION['carrito']['productos'] as $producto){ ?>
                    <tr>
                      <td style="vertical-align:middle">
                        <div class="d-flex">
                          <div class="w-25">
                            <img src="<?php echo $producto['imagen_producto'];  ?>" class="img-thumbnail" width="70" alt="">
                          </div>
                          <div class="w-75 p-1">
                            <a href="#" class="h6"><?php echo $producto['nombre_producto'];  ?></a>
                            <p style="font-size:0.8em;" class="mb-1">Vendido por: <a href="#"><?php echo $producto['nombre_tienda'];  ?></a></p>
                            <p style="font-size:0.8em;" class="mb-1"><?php echo $producto['detalles_producto'];  ?></p>
                            <p style="font-size:0.8em;" class="mb-1"><?php echo $producto['peso_producto'];  ?>kg</p>
                          </div>
                        </div>
                      </td>
                      <td style="vertical-align:middle; text-align:center;">
                        <?php echo $producto['cantidad_producto'];  ?>
                      </td>
                      <td style="vertical-align:middle"><small>$</small><?php echo $producto['precio_producto'];  ?></td>
                      <td style="vertical-align:middle"><strong><small>$</small><?php $suma = $producto['cantidad_producto']*$producto['precio_producto']; echo $suma;  ?></strong></td>
                    </tr>
                    <?php $suma_productos +=  $suma; ?>
                  <?php } ?>
                  <?php }else{ ?>
                    <tr>
                      <td colspan="4" class="text-center">Aún no tienes productos en tu carrito</td>
                    </tr>
                  <?php } ?>

                    <!-- Suma -->
                    <tr>
                      <td colspan="3" class="text-right">Subtotal</td>
                      <td><h5 class="display-5"><small>$</small><strong><?php echo number_format($suma_productos,2); ?></strong></h5></td>
                    </tr>
                    <tr>
                      <td colspan="3" class="text-right">Envío</td>
                      <td><h5 class="display-5"><small>$</small><strong><?php echo number_format( $envio,2); ?></strong></h5></td>
                    </tr>
                    <tr>
                      <td colspan="3" class="text-right">Total</td>
                      <td><h5 class="display-5"><small>$</small><strong><?php echo number_format($suma_productos+$envio,2); ?></strong></h5></td>
                    </tr>
                  </tbody>
                </table>
                <a href="<?php echo base_url('pago_paso_4'); ?>" class="btn btn-success btn-lg btn-block">
                    Pagar Ahora   <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
