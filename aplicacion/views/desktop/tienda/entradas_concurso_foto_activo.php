<div class="contenido_principal fila py-4 pb-5">
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <h2>Concurso Fotográfico</h2>
        <p>Instrucciones lkñjñlaksjd ñalksjdñ laksjdalksjdhjagdfkajhghd aksjdh </p>
        <hr>
        <div class="row">
          <?php foreach($entradas_concurso as $entrada){ ?>
          <div class="col-4 mb-3">
            <div class="card">
              <div class="card-body">
                <img src="<?php echo base_url('contenido/img/publicaciones/'.$entrada->ARCHIVO); ?>" class="img-fluid" alt="">
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
