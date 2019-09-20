<div class="contenedor_concurso" >
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6 col-md-2">
        <div class="imagen_concurso">
          <img src="<?php echo base_url('assets/global/img/concurso/perdiste.png'); ?>" class="img-fluid" alt="">
        </div>
      </div>
      <div class="col-12 col-md-8 text-center">
        <div class="row align-items-center h-75">
          <div class="col-12">
            <h1 class="titulo-concurso">Alguien ha ganado antes</h1>
          </div>
          <div class="col-12">
            <h2 class="subtitulo-concurso">Parece que alguien ha logrado completar el reto antes que tú, muchas gracias por participar</h2>
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
        </div>
      </div>
    </div>
  </div>
</div>
