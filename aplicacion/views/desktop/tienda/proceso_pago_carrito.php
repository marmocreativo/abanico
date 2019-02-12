<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8">
        <div class="card">
          <div class="card-body">
            <div class="border p-3 text-center">
              <h6> <i class="fa fa-shopping-cart"></i> <?php echo $this->lang->line('proceso_pago_carrito_titulo'); ?> </h6>
            </div>
            <div class="CargarCarrito">

            </div>
          </div>
          <div class="card-footer d-flex justify-content-between">
            <a href="<?php echo base_url(); ?>" class="btn btn-outline-primary"> <i class="fa fa-chevron-left"></i> <?php echo $this->lang->line('proceso_pago_2_volver_a_tienda'); ?></a>
            <a href="<?php echo base_url('proceso_pago_1'); ?>" class="btn btn-success"> <?php echo $this->lang->line('proceso_pago_2_continuar'); ?> <i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
