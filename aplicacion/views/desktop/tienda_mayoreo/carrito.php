<!-- proceso pago responsivo -->

<div class="container">
  <div class="row">
    <div class="col-12">
      <?php $suma_productos = 0;?>
      <?php if(!empty($_SESSION['carrito']['productos'] )){ ?>
        <?php foreach($_SESSION['carrito']['productos'] as $producto){ ?>
          <div class="card p-3 py-4 mb-3 carritoCompras">
            <div class="row">
               <div class="col-5">
                 <div class="bxImg mb-2">
                   <a href="#">
                     <img class="img-fluid" src="<?php echo $producto['imagen_producto'];  ?>">
                   </a>
                 </div>
                 <p><strong><?php echo $this->lang->line('carrito_cantidad'); ?></strong></p>
               </div>
               <div class="col">
                 <div class="mb-3">
                   <p><strong><?php echo $producto['nombre_producto'];  ?></strong></p>
                   <p><?php echo $producto['detalles_producto'];  ?></p>
                   <p><small><?php echo $producto['peso_producto'];  ?>kg</small></p>
                 </div>
               </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-primary boton-disminuir-carrito" type="button" data-id-producto = '<?php echo $producto['id_producto']; ?>' data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>'>-</button>
                  </div>
                    <input type="number" max="<?php echo $producto['cantidad_max']; ?>"
                    class="form-control form-cantidad-carrito"
                    data-id-producto = '<?php echo $producto['id_producto']; ?>'
                    data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>'
                    data-cantidad-max='<?php echo $producto['cantidad_max']; ?>'
                    value="<?php echo $producto['cantidad_producto'];  ?>"
                    >
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary boton-incrementar-carrito" type="button" data-id-producto = '<?php echo $producto['id_producto']; ?>' data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>' data-cantidad-max='<?php echo $producto['cantidad_max']; ?>'>+</button>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <button type="button" class="btn btnEliminar btn-outline-danger btn-sm btn-block boton-eliminar-carrito" data-id-producto = '<?php echo $producto['id_producto']; ?>' data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>'
                  title="<?php echo $this->lang->line('usuario_listas_generales_eliminar'); ?> <?php echo $this->lang->line('usuario_lista_productos_singular'); ?> "> <i class="fa fa-trash"></i> <?php echo $this->lang->line('usuario_listas_generales_eliminar'); ?> </button>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php }else{ ?>
        <div class="card mb-3">
          <div class="card-footer p-3 py-4">
            <p class="text-center mb-1"><?php echo $this->lang->line('carrito_sin_productos'); ?>.</p>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>
</div>

<!-- termina proceso pago responsivo -->
