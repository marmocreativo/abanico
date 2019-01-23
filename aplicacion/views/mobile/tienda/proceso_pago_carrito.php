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
        <div class="card-footer d-flex justify-content-between">
          <a href="" class="btn btn-sm btn-outline-primary"><i class="fa fa-chevron-left"></i> Volver a la tienda</a>
          <a href="" class="btn btn-sm btn-success">Continuar <i class="fa fa-chevron-right"></i></a>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- termina proceso pago responsivo -->
<hr><hr><hr>

<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8">
        <div class="card">
          <div class="card-body">
            <div class="border p-3 pt-4 text-center">
              <h6> <i class="fa fa-shopping-cart mr-2"></i>Revisa los productos que comprarás </h6>
            </div>
            <div class="CargarCarrito">

            </div>
          </div>
          <div class="card-footer d-flex justify-content-between">
            <a href="<?php echo base_url(); ?>" class="btn btn-outline-primary"> <i class="fa fa-chevron-left"></i> Volver a la tienda</a>
            <a href="<?php echo base_url('proceso_pago_1'); ?>" class="btn btn-success"> Continuar <i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
