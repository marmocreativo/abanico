<table class="table table-striped">
  <thead>
    <tr>
      <th>Producto</th>
      <th>Cantidad</th>
      <th>Precio</th>
      <th>Total</th>
      <th></th>
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
            <button class="btn btn-outline-primary boton-disminuir-carrito" type="button" data-id-producto = <?php echo $producto['id_producto']; ?>>-</button>
          </div>
            <input type="text" class="form-control form-cantidad-carrito" data-id-producto = <?php echo $producto['id_producto']; ?> value="<?php echo $producto['cantidad_producto'];  ?>">
          <div class="input-group-append">
            <button class="btn btn-outline-primary boton-incrementar-carrito" type="button" data-id-producto = <?php echo $producto['id_producto']; ?>>+</button>
          </div>
        </div>
      </td>
      <td style="vertical-align:middle"><small>$</small><?php echo $producto['precio_producto'];  ?></td>
      <td style="vertical-align:middle"><strong><small>$</small><?php $suma = $producto['cantidad_producto']*$producto['precio_producto']; echo $suma;  ?></strong></td>
      <td style="vertical-align:middle"> <button type="button" class="btn btn-danger btn-sm boton-eliminar-carrito" data-id-producto = <?php echo $producto['id_producto']; ?>> <i class="fa fa-trash"></i> </button> </td>
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
      <td colspan="4" class="text-right">Subtotal</td>
      <td><h5 class="display-5"><small>$</small><strong><?php echo $suma_productos; ?></strong></h5></td>
    </tr>
  </tbody>
</table>
