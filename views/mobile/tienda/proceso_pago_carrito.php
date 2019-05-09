<!-- proceso pago responsivo -->

<div class="container">
  <div class="row">
    <div class="col-12">
      <h4 class="h5 py-3 pt-4 text-center"><i class="fa fa-shopping-cart mr-2"></i><?php echo $this->lang->line('proceso_pago_carrito_titulo'); ?> </h4>

      <div class="card mb-3">
        <div class="card-body p-0 pt-3">
          <div class="CargarCarrito">

          </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
          <a href="<?php echo base_url(); ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-chevron-left"></i>  <?php echo $this->lang->line('proceso_pago_2_volver_a_tienda'); ?></a>
          <a href="<?php echo base_url('proceso_pago_1'); ?>" class="btn btn-sm btn-success"><?php echo $this->lang->line('proceso_pago_2_continuar'); ?> <i class="fa fa-chevron-right"></i></a>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- termina proceso pago responsivo -->
