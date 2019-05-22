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
        <div class="col-3">
          <h5>Acerca de Abanico</h5>
          <?php $publicaciones_acerca = $this->PublicacionesModel->lista(['PUBLICACION_TIPO'=>'acerca'],'','');?>
          <ul class="list-unstyled">
              <li> <a href="<?php echo base_url('planes'); ?>">Planes Vendedores</a> </li>
                <li> <a href="<?php echo base_url('planes?tipo=servicios'); ?>">Planes Servicios</a> </li>
          <?php foreach($publicaciones_acerca as $publicacion){ ?>
            <li> <a href="<?php echo base_url('publicacion/'.$publicacion->PUBLICACION_URL); ?>"><?php echo $publicacion->PUBLICACION_TITULO; ?></a> </li>
          <?php } ?>
          </ul>
        </div>
        <div class="col-3">
          <h5>Legales</h5>
          <?php $publicaciones_acerca = $this->PublicacionesModel->lista(['PUBLICACION_TIPO'=>'legales'],'','');?>
          <ul class="list-unstyled">
          <?php foreach($publicaciones_acerca as $publicacion){ ?>
            <li> <a href="<?php echo base_url('publicacion/'.$publicacion->PUBLICACION_URL); ?>"><?php echo $publicacion->PUBLICACION_TITULO; ?></a> </li>
          <?php } ?>
          </ul>
        </div>
        <div class="col-3">
          <h5>Concursos</h5>
          <?php $publicaciones_acerca = $this->PublicacionesModel->lista(['PUBLICACION_TIPO'=>'concursos'],'','');?>
          <ul class="list-unstyled">
          <?php foreach($publicaciones_acerca as $publicacion){ ?>
            <li> <a href="<?php echo base_url('publicacion/'.$publicacion->PUBLICACION_URL); ?>"><?php echo $publicacion->PUBLICACION_TITULO; ?></a> </li>
          <?php } ?>
          </ul>
        </div>
        <div class="col-3">
          <h5>Ayuda</h5>
          <?php $publicaciones_acerca = $this->PublicacionesModel->lista(['PUBLICACION_TIPO'=>'ayuda'],'','');?>
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
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title"><span class="fa fa-shopping-cart"></span> <?php echo $this->lang->line('carrito_titulo'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0 CargarCarrito">

      </div>
      <div class="modal-footer">
        <button type="button" id="BotonVaciar" class="btn btn-link float-left"><i class="fas fa-trash text-primary-17"></i> <?php echo $this->lang->line('carrito_vaciar'); ?></button>
        <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close"><i class="fas fa-check-circle text-primary-17"></i> <?php echo $this->lang->line('carrito_seguir_compranod'); ?></button>
        <a href="<?php echo base_url('carrito'); ?>" id="BotonComprarAhora" class="btn btn-primary-17 text-white" aria-disabled="false"><?php echo $this->lang->line('carrito_comprar_ahora'); ?></a>
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
    <script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/metronic/'); ?>vendors/general/summernote/lang/summernote-es-ES.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/tienda/js/starrr/starrr.js"></script>
    <script defer src="<?php echo base_url(); ?>assets/tienda/js/flexslider/jquery.flexslider.js"></script>
    <script defer src="<?php echo base_url(); ?>assets/tienda/js/slider-pro-master/js/jquery.sliderPro.js"></script>
    <script type="text/javascript">
       $(window).on('load',function(){
         $('.flexslider').flexslider({
           animation: "slide",
           animationLoop: true,
           itemWidth: 300,
           itemMargin: 20,
           pausePlay: false,
           start: function(slider){
             $('body').removeClass('loading');
           }
         });
         $( "#sortable" ).sortable();
         var intervalID = window.setInterval(miFuncion, 1000);
         function miFuncion() {
           var d = new Date();
            $('#verificacion').html(d.getSeconds());
            if(d.getSeconds()==25){
              $('#juego').html('Ganaste!!!');
            }
          }
       });
     </script>
    <?php $this->load->view('scripts/scripts_tienda');  ?>
    <?php $this->load->view('scripts/formularios_usuario');  ?>

  </body>
</html>
