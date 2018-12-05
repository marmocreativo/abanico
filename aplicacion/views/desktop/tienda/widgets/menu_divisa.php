<div class="btn-group" role="group">
  <button id="btnMenuDivisa" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo $_SESSION['divisa']['iso']; ?>
  </button>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuDivisa">
    <?php foreach($divisas_activas as $divisas){ ?>
      <a class="dropdown-item" href="<?php echo $divisas->DIVISA_ISO; ?>"><?php echo $divisas->DIVISA_ISO; ?></a>
    <?php } ?>
  </div>
</div>
