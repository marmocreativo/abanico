<div class="contenedor_concurso" >
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6 col-md-2">
        <div class="imagen_concurso">
          <img src="<?php echo base_url('assets/global/img/concurso/busca.png'); ?>" class="img-fluid" alt="">
        </div>
      </div>
      <div class="col-12 col-md-8 text-center">
        <div class="row align-items-center h-75">
          <div class="col-12">
            <h1 class="titulo-concurso"><?php echo $concurso['TITULO']; ?></h1>
          </div>
          <div class="col-12">
            <h2 class="subtitulo-concurso"><i>Paso 1 de 2 </i> Busca las <span class="animated tada infinite" style="display:inline-block"><?php echo count($palabras); ?> palabras</span>  escondidas  en las descripciones de algunos de nuestros productos y toca o da click en ellas.</h2>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-2">
        <div class="contador_palabras text-center">
          <?php
            $palabras = count($_SESSION['concurso']['palabras']);
            $palabras_encontradas = 0;
            foreach($_SESSION['concurso']['palabras'] as $palabra_sesion){
              if($palabra_sesion['ENCONTRADA']=='si'){ $palabras_encontradas++; }
            }
          ?>
          <h3>Palabras encontradas</h3>
          <h3 class="display-3"><?php echo $palabras_encontradas; ?>/<?php echo $palabras; ?></h3>
          <button type="button" class="btn btn-primary-6 btn-block" name="button" data-toggle="modal" data-target="#como_participar"> <i class="fa fa-question-circle"></i> ¿Como participar?</button>
        </div>
      </div>
    </div>
    <div class="row py-4" style="min-height:50px" id="" data-numero-palabras="<?php echo count($_SESSION['concurso']['palabras']); ?>">
      <?php if(isset($_SESSION['concurso']['palabras'])&&!empty($_SESSION['concurso']['palabras'])){ shuffle($_SESSION['concurso']['palabras']); ?>
        <?php $i=0;  foreach($_SESSION['concurso']['palabras'] as $key => $palabra){ ?>
          <?php if($palabra['ENCONTRADA']=='si'){ ?>
            <?php
              if($key==$palabra['ORDEN']){
                $clase_visible= 'border border-info text-info incorrecto';
              }else{
                $clase_visible= 'border border-info text-info incorrecto';
              }
            ?>
          <div class="col palabra_concurso p-2 text-center m-2 animated fadeInUp <?php echo $clase_visible; ?>"
          style="border-style:dashed !important; cursor:pointer; background-color:rgba(230,230,230,1); animation-delay:<?php echo $i; ?>00ms"
          data-key="<?php echo $key; ?>"
          data-orden="<?php echo $palabra['ORDEN']; ?>"
          data-id="<?php echo $palabra['ID']; ?>"
          data-palabra="<?php echo $palabra['PALABRA']; ?>"
          >
          <?php echo $palabra['PALABRA']; ?>
          </div>
        <?php  $i++; } ?>
        <?php } ?>

    <?php } ?>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="como_participar" tabindex="-1" role="dialog" aria-labelledby="como_participar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div id="como_participar_slides" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="<?php echo base_url('assets/global/img/concurso/concurso_1.jpg'); ?>" alt="Paso 1">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo base_url('assets/global/img/concurso/concurso_2.jpg'); ?>" alt="Paso 2">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo base_url('assets/global/img/concurso/concurso_3.jpg'); ?>" alt="Paso 3">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo base_url('assets/global/img/concurso/concurso_4.jpg'); ?>" alt="Paso 4">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo base_url('assets/global/img/concurso/concurso_5.jpg'); ?>" alt="Paso 5">
              </div>
            </div>
            <a class="carousel-control-prev" href="#como_participar_slides" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#como_participar_slides" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
          </div>
      </div>
    </div>
  </div>
</div>
