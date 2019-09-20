<div class="contenedor_concurso" >
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6 col-md-3">
        <div class="imagen_concurso">
          <img src="<?php echo base_url('assets/global/img/concurso/busca.png'); ?>" class="img-fluid" alt="">
        </div>
      </div>
      <div class="col-12 col-md-9 text-center">
        <div class="row align-items-center h-75">
          <div class="col-12">
            <h1 class="titulo-concurso"><?php echo $concurso['TITULO']; ?></h1>
          </div>
          <div class="col-12">
            <h2 class="subtitulo-concurso">no pierdas la oportunidad de ganar</h2>
          </div>
          <div class="col-12">
            <a href="<?php echo base_url('login'); ?>" class="btn btn-primary">Inicia sesión</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
