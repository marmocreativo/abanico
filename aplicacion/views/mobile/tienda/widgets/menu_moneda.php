<div class="btn-group" role="group">
  <button id="btnMenuMoneda" type="button" class="btn btn-link btn-sm dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Moneda
  </button>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuMoneda">
    <?php foreach($divisas_activas as $divisas){ ?>
      <a class="dropdown-item" href="<?php echo $divisas->DIVISA_ISO; ?>"><?php echo $divisas->DIVISA_NOMBRE; ?></a>
    <?php } ?>
  </div>
</div>
