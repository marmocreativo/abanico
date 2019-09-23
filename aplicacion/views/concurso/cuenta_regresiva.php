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
            <h1 class="titulo-concurso">Prepárate, nuestro concurso inaugural empieza en:</h1>
          </div>
          <div class="col-12">
            <h3 class="display-2" id="cuenta_regresiva"></h3>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-2 d-flex h-100 align-items-center">
        <div class="row">
          <div class="col-12 my-3">
            <a href="<?php echo base_url('usuario/registrar'); ?>" class="btn btn-primary-5 btn-block"> <i class="fa fa-pencil-alt"></i> Regístrate</a>
          </div>
          <div class="col-12">
            <button type="button" class="btn btn-primary-6 btn-block" name="button" data-toggle="modal" data-target="#como_participar"> <i class="fa fa-question-circle"></i> ¿Como participar?</button>
          </div>
        </div>
      </div>
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
