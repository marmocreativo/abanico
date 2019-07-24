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
            <li> <a href="<?php echo base_url('publicacion/quienes-somos'); ?>">Quienes somos</a> </li>
            <li> <a href="<?php echo base_url('planes'); ?>">Planes Vendedores</a> </li>
            <li> <a href="<?php echo base_url('planes?tipo=servicios'); ?>">Planes Servicios</a> </li>
            <li> <a href="<?php echo base_url('publicacion/contacto'); ?>">Contacto</a> </li>
            <li> <a href="<?php echo base_url('publicacion/metodos-de-pago'); ?>">Métodos de pago</a> </li>
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
            <li> <a href="<?php echo base_url('publicacion/como-registrarme'); ?>">Como registrarme</a> </li>
            <li> <a href="<?php echo base_url('publicacion/como-comprar'); ?>">Como comprar</a> </li>
            <li> <a href="<?php echo base_url('publicacion/vender-en-abanico'); ?>">Vender en Abanico</a> </li>
            <li> <a href="<?php echo base_url('publicacion/publicar-un-producto'); ?>">Publicar un producto</a> </li>
            <li> <a href="<?php echo base_url('publicacion/ofrecer-servicios-en-abanico'); ?>">Ofrecer servicios en Abanico</a> </li>
            <li> <a href="<?php echo base_url('publicacion/ofrecer-servicios'); ?>">Publicar un servicio</a> </li>
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
      <div class="modal-body p-0">
        <div class="CargarCarrito">

        </div>
        <div class="float-right">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-link" name="button">¿Pagar en dolares o en pesos?</button>
            <button id="btnMenuDivisa" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION['divisa']['iso']; ?>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuDivisa">
              <?php foreach($divisas_activas as $divisas){ ?>
                <a class="dropdown-item" href="<?php echo base_url('divisas?iso='.$divisas->DIVISA_ISO.'&url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])); ?>"><?php echo $divisas->DIVISA_ISO; ?></a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="BotonVaciar" class="btn btn-link float-left"><i class="fas fa-trash text-primary-17"></i> <?php echo $this->lang->line('carrito_vaciar'); ?></button>
        <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close"><i class="fas fa-check-circle text-primary-17"></i> <?php echo $this->lang->line('carrito_seguir_compranod'); ?></button>
        <?php if($op['permitir_compra']=='si'){ ?>
        <a href="<?php echo base_url('carrito'); ?>" id="BotonComprarAhora" class="btn btn-primary-17 text-white" aria-disabled="false"><?php echo $this->lang->line('carrito_comprar_ahora'); ?></a>
        <?php }else{ ?>
          <button type="button" class="btn btn-outline-primary-17" name="button" disabled>Compra próximamente</button>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<!-- MODAL PROMOCIONES -->
<div class="modal fade" id="ModalPromociones" tabindex="-1" role="dialog" aria-labelledby="ModalPromociones" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $CI =& get_instance();
        $CI->load->model('SlidersModel');
        $CI->load->model('SlidesModel');
        $slider_promo = $CI->SlidersModel->slide_nombre_lenguaje('promociones',$_SESSION['lenguaje']['iso']);
        $promos = $CI->SlidesModel->lista(['ID_SLIDER'=>$slider_promo['ID_SLIDER']],'','');
        ?>
        <div id="carouselPromos" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <?php $i = 0; foreach($promos as $slide){ ?>
              <li data-target="#carouselPromos" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0){ echo 'active'; } ?>"></li>
            <?php ++$i; }  ?>
            </ol>
            <div class="carousel-inner">
              <?php $i = 0; foreach($promos as $slide){ ?>
              <div class="carousel-item <?php if($i==0){ echo 'active'; } ?>">
                <div class="row">
                  <div class="col">
                      <img class="d-block w-100" src="<?php echo base_url('contenido/img/slider/'.$slide->SLIDE_IMAGEN); ?>">
                  </div>
                  <div class="col">
                    <div class="row align-items-center mx-0">
                      <?php if(!empty($slide->SLIDE_TITULO)){ ?>
                        <div class="col-12">

                        <h2><?php echo $slide->SLIDE_TITULO; ?></h2>
                        </div>
                    <?php } ?>
                      <?php if(!empty($slide->SLIDE_SUBTITULO)){ ?>
                        <div class="col-12">

                        <h2><?php echo $slide->SLIDE_SUBTITULO; ?></h2>
                        </div>
                    <?php } ?>
                    <?php if(!empty($slide->SLIDE_ENLACE)){ ?>
                      <div class="col-12">
                        <a href="<?php echo $slide->SLIDE_ENLACE; ?>" class="btn btn-outline-dark"> <?php echo $slide->SLIDE_BOTON; ?></a>
                      </div>
                  <?php } ?>
                    </div>
                  </div>

              </div>

              </div>
            <?php ++$i; }  ?>
            <a class="carousel-control-prev" href="#carouselPromos" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselPromos" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Siguiente</span>
            </a>
          </div>
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
         <?php if($op['mostrar_promociones_siempre']=='no'){ ?>
           <?php if(!isset($_SESSION['promocion'])){   $_SESSION['promocion']=true; ?> $('#ModalPromociones').modal(); <?php } ?>
         <?php }else{ ?>
           $('#ModalPromociones').modal();
         <?php } ?>
       });
     </script>
     <?php $this->load->view('scripts/scripts_concurso');  ?>
    <?php $this->load->view('scripts/scripts_tienda');  ?>
    <?php $this->load->view('scripts/formularios_usuario');  ?>

  </body>
</html>
