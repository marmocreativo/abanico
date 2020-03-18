<div class="contenido_principal">
  <div class="container">
    <div class="row">
      <div class="col-12 py-3 text-center">
        <h2>Vendedores autorizados <i class="fa fa-id-card-alt"></i> </h2>
      </div>
      <div class="col">
        <div class="row justify-content-center">
          <?php foreach($vendedores_autorizados as $vendedor){ ?>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="card">
              <div class="card-body text-center">
                <img src="<?php echo base_url('contenido/img/usuarios/'.$vendedor->USUARIO_IMAGEN); ?>" class="img-fluid" alt="">
                <h3 class="mt-3"><?php echo $vendedor->USUARIO_NOMBRE.' '.$vendedor->USUARIO_APELLIDOS ?></h3>
                <p class="text-success">Activo <i class="fa fa-check-circle"></i> </p>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>

</div>
