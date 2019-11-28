<div class="contenido_principal fila py-4 pb-5">
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <h2><?php echo $concurso_activo['TITULO']; ?></h2>
        <p><?php echo $concurso_activo['DESCRIPCION']; ?> </p>
        <hr>
        <div class="row">
          <?php foreach($entradas_concurso as $entrada){ ?>
          <div class="col-4 mb-3">
            <div class="card">
              <div class="card-body p-0">
                <img src="<?php echo base_url('contenido/img/publicaciones/'.$entrada->ARCHIVO); ?>" class="img-fluid" <?php if($entrada->VALIDO=='no'){ ?> style="-webkit-filter: grayscale(100%) blur(10px); filter: grayscale(100%) blur(10px);" <?php } ?> alt="">
              </div>
              <div class="card-footer">
                <?php echo $entrada->FECHA_REGISTRO; ?>
                <p><?php echo $entrada->DESCRIPCION; ?></p>
                <?php if($entrada->VALIDO=='no'){ ?>
                  <p class="text-danger" style="font-size:10px;">La foto no cumple con la actividad</p>
                <?php } ?>
              </div>
              <?php if($entrada->GANADOR=='si'){ ?>
                <div style="display:block; position:absolute; top:0; right:0;" class="p-3 animated heartBeat infinite"> <span class="fas fa-award text-warning" style="font-size:60px;"></span> </div>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
