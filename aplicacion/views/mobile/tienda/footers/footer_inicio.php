<div class="pre-footer">
  <div class="barra-color barra-azul"></div>
  <div class="barra-color barra-rosa"></div>
  <div class="barra-color barra-amarillo"></div>
  <div class="barra-color barra-verde"></div>
  <div class="barra-color barra-morado"></div>
</div>
<div class="footer">

</div>
<div class="creditos">

</div>
<!-- MODAL CARRITO -->
<!-- Modal -->
<div class="modal fade" id="ModalCarrito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Carrito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0 CargarCarrito">

      </div>
      <div class="modal-footer">
        <button type="button" id="BotonVaciar" class="btn btn-outline-danger float-left">Vaciar Carrito</button>
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" aria-label="Close">Seguir Comprando</button>
        <a href="<?php echo base_url('carrito'); ?>" class="btn btn-primary">Comprar Ahora</a>
      </div>
    </div>
  </div>
</div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="<?php echo base_url(); ?>assets/global/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/tienda/js/starrr/starrr.js"></script>
  <script defer src="<?php echo base_url(); ?>assets/tienda/js/flexslider/jquery.flexslider.js"></script>
  <script type="text/javascript">
     $(window).on('load',function(){
      $('.slideInicio').flexslider({
         animation: "slide",
         animationLoop: true,
         directionNav: false,
         controlNav: true,
         pausePlay: false,
       });

       $('.sliderProductos').flexslider({
         animation: "slide",
         animationLoop: false,
         itemWidth: 270,
         itemMargin: 0,
         pausePlay: false,
         controlNav: false,
         directionNav: false,
       });

     });

   </script>
   <script type="text/javascript">
   </script>
  <?php $this->load->view('scripts/scripts_tienda');  ?>

</body>
</html>
