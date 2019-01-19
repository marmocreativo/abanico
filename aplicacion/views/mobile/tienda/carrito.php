<!-- proceso pago responsivo -->

<div class="container">
  <div class="row">
    <div class="col-12">
      <h4 class="h5 py-3 pt-4 text-center"><i class="fa fa-shopping-cart mr-2"></i>Carrito de comprás </h4>

      <div class="card mb-3">
        <div class="card-footer p-3 py-4">
          <p class="text-center mb-1">Aún no tienes productos en tu carrito</p>
        </div>
      </div>

      <?php for($i=0; $i<=1; $i++){ ?>
      <div class="card p-3 py-4 mb-3 carritoCompras">
        <div class="row">
           <div class="col-5">
             <div class="bxImg mb-2">
               <a href="#">
                 <img class="spanImg" src="https://picsum.photos/100/100/?random=<?php echo $i ?>"></img>
               </a>
             </div>
             <p><strong>Cantidad</strong></p>
             <div class="input-group input-group-sm">
               <div class="input-group-prepend">
                 <button class="btn btn-outline-primary boton-disminuir-carrito" type="button" data-id-producto="14" data-detalles-producto="">-</button>
               </div>
               <input type="text" class="form-control form-cantidad-carrito" data-id-producto="14" data-detalles-producto="" value="1">
               <div class="input-group-append">
                 <button class="btn btn-outline-primary boton-incrementar-carrito" type="button" data-id-producto="14" data-detalles-producto="">+</button>
               </div>
             </div>
           </div>
           <div class="col">
             <div class="mb-3">
               <p><strong>Producto</strong></p>
               <p>Libro lorem ipsum</p>
               <p>Vendido por:<br><a href="" class="text-primary">TIENDA DE MARTHA</a></p>
               <p><small>1.00kg</small></p>
             </div>
             <div class="row">
               <div class="col">
                 <p><strong>Precio</strong></p>
                 <small>$</small>500.00 <small>MXN</small>
                 <p><strong>Total</strong></p>
                 <small>$</small>500.00 <small>MXN</small>
               </div>
             </div>
           </div>
        </div>

        <button type="button" class="btn mt-2 mr-2 btnEliminar btn-danger btn-sm boton-eliminar-carrito"> <i class="fa fa-trash"></i> </button>
      </div>
      <?php } ?>

      <div class="card mb-3">
        <div class="card-body p-2 pt-3">
          <div class="row">
            <div class="col-5">
              <h5>Subtotal</h5>
            </div>
            <div class="col text-right">
              <h5><small>$</small>1000.00 <small>MXN</small></h5>
            </div>
          </div>
        </div>
        <div class="card-footer px-1 text-center">
          <a href="" class="btn btn-sm btn-outline-primary"><i class="fa fa-chevron-left"></i> Volver a la tienda</a>
          <a href="" class="btn btn-sm btn-success">Continuar <i class="fa fa-chevron-right"></i></a>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- termina proceso pago responsivo -->
<hr><hr><hr>

<?php
  //echo '<pre>';
  //var_dump($_SESSION['carrito']['tiendas']);
  //echo '</pre>';
?>
<table class="table table-striped">
  <thead>
    <tr>
      <th style="width:45%">Producto</th>
      <th style="width:20%">Cantidad</th>
      <th style="width:15%">Precio</th>
      <th style="width:15%">Total</th>
      <th style="width:5%"></th>
    </tr>
  </thead>
  <tbody>
    <?php $suma_productos = 0;?>
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
      <td style="vertical-align:middle">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <button class="btn btn-outline-primary boton-disminuir-carrito" type="button" data-id-producto = '<?php echo $producto['id_producto']; ?>' data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>'>-</button>
          </div>
            <input type="text" class="form-control form-cantidad-carrito" data-id-producto = '<?php echo $producto['id_producto']; ?>' data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>' value="<?php echo $producto['cantidad_producto'];  ?>">
          <div class="input-group-append">
            <button class="btn btn-outline-primary boton-incrementar-carrito" type="button" data-id-producto = '<?php echo $producto['id_producto']; ?>' data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>'>+</button>
          </div>
        </div>
      </td>
      <td style="vertical-align:middle">
        <small><?php echo $_SESSION['divisa']['signo']; ?></small>
        <?php echo number_format($_SESSION['divisa']['conversion']*$producto['precio_producto'],2);  ?><br>
        <small><?php echo $_SESSION['divisa']['iso']; ?></small>
      </td>
      <td style="vertical-align:middle">
        <small><?php echo $_SESSION['divisa']['signo']; ?></small>
          <?php $suma = $producto['cantidad_producto']*$producto['precio_producto']; echo number_format($_SESSION['divisa']['conversion']*$suma,2);  ?><br>
        <small><?php echo $_SESSION['divisa']['iso']; ?></small>
      </td>
      <td style="vertical-align:middle;"> <button type="button" class="btn btn-danger btn-sm boton-eliminar-carrito" data-id-producto = '<?php echo $producto['id_producto']; ?>' data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>' title="Eliminar del carrito"> <i class="fa fa-trash"></i> </button> </td>
    </tr>
    <?php $suma_productos +=  $suma; ?>
  <?php } ?>
  <?php }else{ ?>
    <tr>
      <td colspan="5" class="text-center">Aún no tienes productos en tu carrito</td>
    </tr>
  <?php } ?>

    <!-- Suma -->
    <tr>
      <td colspan="3" class="text-right">Subtotal</td>
      <td colspan="2" style="text-align:right"><h5 class="display-5">
        <small><?php echo $_SESSION['divisa']['signo']; ?></small>
        <strong><?php echo number_format($_SESSION['divisa']['conversion']*$suma_productos,2); ?></strong>
        <small><?php echo $_SESSION['divisa']['iso']; ?></small>
      </h5></td>
    </tr>
  </tbody>
</table>
