  <div class="pre-footer">
    <div class="barra-color barra-azul"></div>
    <div class="barra-color barra-rosa"></div>
    <div class="barra-color barra-amarillo"></div>
    <div class="barra-color barra-verde"></div>
    <div class="barra-color barra-morado"></div>
  </div>
  <div class="footer">
    <div class="container-fluid">
    </div>
  </div>
  <div class="creditos">

  </div>
  <!-- MODAL CARRITO -->
  <!-- Modal -->
<div class="modal fade" id="ModalCarritoMayoreo" tabindex="-1" role="dialog" aria-labelledby="ModalCarritoMayoreo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title"><span class="fa fa-shopping-cart"></span> <?php echo $this->lang->line('carrito_titulo'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="CargarCarritoMayoreo">

        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal" aria-label="Close">
              Seguir comprando
            </button>
            <button type="button" id="BotonVaciar" class="btn btn-link btn-sm"><i class="fas fa-trash text-primary-17"></i> Vaciar carrito</button>
            <a href="<?php echo base_url('tienda-mayoreo/pedido_confirmacion'); ?>" id="BotonComprarAhora" class="btn btn-primary-17 text-white btn-sm" aria-disabled="false">Confirmar Pedido</a>
        </div>
        <div class="btn-group">
        </div>
      </div>
    </div>
  </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/metronic/'); ?>vendors/custom/jquery-ui/jquery-ui.bundle.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/localization/messages_es.js"></script>
    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
    <script defer src="<?php echo base_url(); ?>assets/tienda/js/flexslider/jquery.flexslider.js"></script>
    <script defer src="<?php echo base_url(); ?>assets/tienda/js/slider-pro-master/js/jquery.sliderPro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

    <?php $this->load->view('scripts/scripts_tienda_mayoreo');  ?>
    <?php $this->load->view('scripts/formularios_usuario');  ?>

  </body>
</html>
