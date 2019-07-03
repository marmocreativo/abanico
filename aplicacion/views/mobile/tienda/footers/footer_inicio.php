<div class="pre-footer">
  <div class="barra-color barra-azul"></div>
  <div class="barra-color barra-rosa"></div>
  <div class="barra-color barra-amarillo"></div>
  <div class="barra-color barra-verde"></div>
  <div class="barra-color barra-morado"></div>
</div>
<div class="footer">
  <div class="container-fluid">
    <div class="row p-3">
      <div class="col-12">
        <h5>Acerca de Abanico</h5>
        <?php $publicaciones_acerca = $this->PublicacionesModel->lista(['PUBLICACION_TIPO'=>'acerca'],'','');?>
        <ul class="list-unstyled">
          <li> <a href="<?php echo base_url('publicacion/quienes-somos'); ?>">Quienes somos</a> </li>
          <li> <a href="<?php echo base_url('planes'); ?>">Planes Vendedores</a> </li>
          <li> <a href="<?php echo base_url('planes?tipo=servicios'); ?>">Planes Servicios</a> </li>
          <li> <a href="<?php echo base_url('publicacion/contacto'); ?>">Contacto</a> </li>
          <li> <a href="<?php echo base_url('publicacion/metodos-de-pago'); ?>">Métodos de pago</a> </li>
        </ul>
      </div>
      <div class="col-12 mt-3 bordered-top">
        <h5>Concursos</h5>
        <?php $publicaciones_acerca = $this->PublicacionesModel->lista(['PUBLICACION_TIPO'=>'concursos'],'','');?>
        <ul class="list-unstyled">
        <?php foreach($publicaciones_acerca as $publicacion){ ?>
          <li> <a href="<?php echo base_url('publicacion/'.$publicacion->PUBLICACION_URL); ?>"><?php echo $publicacion->PUBLICACION_TITULO; ?></a> </li>
        <?php } ?>
        </ul>
      </div>
      <div class="col-12 mt-3 bordered-top">
        <h5>Ayuda</h5>
        <?php $publicaciones_acerca = $this->PublicacionesModel->lista(['PUBLICACION_TIPO'=>'ayuda'],'','');?>
        <ul class="list-unstyled">
          <li> <a href="<?php echo base_url('publicacion/como-registrarme'); ?>">Como registrarme</a> </li>
          <li> <a href="<?php echo base_url('publicacion/como-comprar'); ?>">Como comprar</a> </li>
          <li> <a href="<?php echo base_url('publicacion/vender-en-abanico'); ?>">Vender en Abanico</a> </li>
          <li> <a href="<?php echo base_url('publicacion/publicar-un-producto'); ?>">Publicar un producto</a> </li>
          <li> <a href="<?php echo base_url('publicacion/ofrecer-servicios-en-abanico'); ?>">Ofrecer servicios en Abanico</a> </li>
          <li> <a href="<?php echo base_url('publicacion/ofrecer-servicios'); ?>">Publicar un servicio</a> </li>
        </ul>
      </div>
      <div class="col-12 mt-3 bordered-top">
        <h5>Legales</h5>
        <?php $publicaciones_acerca = $this->PublicacionesModel->lista(['PUBLICACION_TIPO'=>'legales'],'','');?>
        <ul class="list-unstyled">
        <?php foreach($publicaciones_acerca as $publicacion){ ?>
          <li> <a href="<?php echo base_url('publicacion/'.$publicacion->PUBLICACION_URL); ?>"><?php echo $publicacion->PUBLICACION_TITULO; ?></a> </li>
        <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="creditos">

</div>
<!-- MODAL CARRITO -->
<!-- Modal -->
<div class="modal fade" id="ModalCarrito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-shopping-cart mr-2"></i> <?php echo $this->lang->line('carrito_titulo'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0 CargarCarrito">

      </div>
      <div class="modal-footer">
        <div class="container-fluid">
          <div class="row">
          <button type="button" id="BotonVaciar" class="btn btn-sm btn-outline-danger float-left"> <i class="fa fa-trash"></i> <?php echo $this->lang->line('carrito_vaciar'); ?></button>
          <button type="button" class="btn btn-sm btn-outline-primary ml-2" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> <?php echo $this->lang->line('carrito_seguir_compranod'); ?></button>
          <?php if($op['permitir_compra']=='si'){ ?>
            <a href="<?php echo base_url('carrito'); ?>" id="BotonComprarAhora" class="btn btn-block btn-sm btn-primary mt-3" disabled><i class="fa fa-money-bill"></i> <?php echo $this->lang->line('carrito_comprar_ahora'); ?></a>
          <?php }else{ ?>
            <button type="button" class="btn btn-outline-primary-17" name="button" disabled>Compra próximamente</button>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="<?php echo base_url(); ?>assets/global/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/localization/messages_es.js"></script>
  <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
  <script src="<?php echo base_url(); ?>assets/global/js/trumbowyg/plugins/cleanpaste/trumbowyg.cleanpaste.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/global/js/trumbowyg/plugins/table/trumbowyg.table.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/tienda/js/starrr/starrr.js"></script>
  <script defer src="<?php echo base_url(); ?>assets/tienda/js/flexslider/jquery.flexslider.js"></script>
  <script defer src="<?php echo base_url(); ?>assets/global/js/jquery.sliderPro.min.js"></script>
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

       $('.slideBxProducto').flexslider({
         animation: "slide",
         animationLoop: false,
         directionNav: false,
         controlNav: true,
         pausePlay: false,
       });
     });

     $('.CombinacionProducto').on('change',function(e){
        var imagen = $('.CombinacionProducto').find(':selected').attr('data-imagen-producto');
        var index = $('.slides li').index($('.slides li[data-imagen="'+imagen+'"]'));
        $('.slideBxProducto').flexslider(index);
     });

   </script>

   <script>
      $(".btnFunction").click(function() {
        // $(".btnFunction").toggleClass('collaps');
        // $("#menu-categorias").toggleClass('collaps');

        $("#menu-productos").removeClass('show');
        $("#menu-servicios").removeClass('show');
      });

      $(".btnFunction2").click(function() {
        // $("#menu-productos").toggleClass('show');

        $("#menu-categorias").removeClass('show');
        $("#menu-servicios").removeClass('show');
      });

      $(".btnFunction3").click(function() {
        // $("#menu-servicios").toggleClass('show');

        $("#menu-productos").removeClass('show');
        $("#menu-categorias").removeClass('show');
      });
   </script>

  <?php $this->load->view('scripts/scripts_tienda');  ?>
  <?php $this->load->view('scripts/formularios_usuario');  ?>

</body>
</html>
