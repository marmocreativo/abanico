<div class="btn-group" role="group">
  <button id="btnMenuMoneda" type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo $_SESSION['lenguaje']['nombre']; ?>
  </button>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnMenuMoneda">
    <?php foreach($lenguajes_activos as $lenguajes){ ?>
      <a class="dropdown-item" href="<?php echo base_url('lenguaje?iso='.$lenguajes->LENGUAJE_ISO.'&url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])); ?>"><?php echo $lenguajes->LENGUAJE_NOMBRE; ?></a>
    <?php } ?>
  </div>
</div>
