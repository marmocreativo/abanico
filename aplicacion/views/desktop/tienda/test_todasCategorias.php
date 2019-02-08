<div class="contenido_principal">
  <div class="container">
    <nav class="my-3" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Inicio</a></li>
        <li class="breadcrumb-item active <?php echo 'text'.$primary; ?>" aria-current="page">Mis servicios</li>
      </ol>
    </nav>
    <div class="row">
      <!--
      <div class="col-3">
        <div class="card" id="menuTodasCategorias">
          <div class="card-header">
            Categorías
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item link-primary"><a href=""><i class="fas fa-laptop"></i> Categoría 1</a></li>
          </ul>
        </div>
      </div>
    -->
      <div class="col">
        <div class="row">
          <?php $i = 1; foreach($categorias as $categoria){ ?>
          <h4 class="col-12 text-primary pb-2" id="tituloCategoria"><i class="fas fa-laptop"></i> <?php echo $categoria->CATEGORIA_NOMBRE; ?></h4>
          <?php $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
            <?php foreach($segundo_categorias as $segunda_categoria){ ?>
            <div class="col-4">
              <h4><?php echo $segunda_categoria->CATEGORIA_NOMBRE; ?></h4>
              <?php $tercero_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'',''); ?>
              <ul class="list list-unstyled">
                <?php foreach($tercero_categorias as $tercera_categoria){ ?>
                <li><?php echo $tercera_categoria->CATEGORIA_NOMBRE; ?></li>
              <?php } // Termina tercera categoria ?>
              </ul>
            </div>
          <?php } // Termina segunda categoria ?>
        <?php } // Termina primer categoria ?>
        </div>
      </div>
    </div>
  </div>
</div>
