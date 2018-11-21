<div class="btn-group" role="group">
  <button id="btnMenuMoneda" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Lenguaje
  </button>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuMoneda">
    <?php foreach($lenguajes_activos as $lenguajes){ ?>
      <a class="dropdown-item" href="<?php echo $lenguajes->LENGUAJE_ISO; ?>"><?php echo $lenguajes->LENGUAJE_NOMBRE; ?></a>
    <?php } ?>
  </div>
</div>
