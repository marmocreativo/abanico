<?php
  if(isset($categoria['CATEGORIA_NOMBRE'])){
    $titulo_categoria = $categoria['CATEGORIA_NOMBRE'];
  }else{
    $titulo_categoria = 'Todos los productos';
  }
  if(isset($_GET['Busqueda'])){
    $titulo_categoria = 'Resultados para tu Busqueda';
  }

?>
<div class="fila fila-gris py-4 pb-5">
  <div class="container">
    <div class="row">

      <div class="col-12">
        <ol class="breadcrumb vistaMovil">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('categoria_productos_migas_inicio'); ?></a></li>
          <li class="breadcrumb-item active text-primary " aria-current="page">Todos los productos</li>
        </ol>
      </div>

      <div class="col-12 mb-3">
        <div class="card">

          <button class="btn btnFiltros btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="fas fa-sliders-h mr-2"></i>Filtros
          </button>
          <div class="collapse" id="collapseExample">
            <div class="p-3">
              <form class="" action="<?php echo base_url($origen_formulario) ?>" method="get">
                <?php if($origen_formulario=='categoria'){ ?>
                  <input type="hidden" name="slug" value="<?php echo $categoria['CATEGORIA_URL']; ?>">
                <?php } ?>
                <input type="hidden" name="Busqueda" value="<?php if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){ echo filter_var ( $_GET['Busqueda'], FILTER_SANITIZE_STRING); } ?>">
                <?php if(!isset($categoria['CATEGORIA_TIPO'])){ ?>
                <input type="hidden" name="BuscarEn" value="<?php if(isset($_GET['BuscarEn'])){ echo $_GET['BuscarEn']; }else{ echo 'productos'; }; ?>">
              <?php }else{ ?>
                <input type="hidden" name="BuscarEn" value="<?php if(isset($_GET['BuscarEn'])){ echo $_GET['BuscarEn']; }else{ echo $categoria['CATEGORIA_TIPO']; }; ?>">
              <?php } ?>
                  <select class="custom-select filtro-sel" name="OrdenBusqueda">
                    <option selected><?php echo $this->lang->line('filtro_categoria_productos_ordenar_por'); ?></option>
                    <option value="precio_desc" <?php if(isset($_GET['OrdenBusqueda'])&&$_GET['OrdenBusqueda']=='precio_desc'){ echo 'selected'; } ?>><?php echo $this->lang->line('filtro_categoria_productos_mayor_precio'); ?></option>
                    <option value="precio_asc" <?php if(isset($_GET['OrdenBusqueda'])&&$_GET['OrdenBusqueda']=='precio_asc'){ echo 'selected'; } ?>><?php echo $this->lang->line('filtro_categoria_productos_menor_precio'); ?></option>
                  </select>
                  <hr>
                  <select class="custom-select filtro-sel" name="OrigenBusqueda">
                    <option value="cualquiera" <?php if(isset($_GET['OrigenBusqueda'])&&$_GET['OrigenBusqueda']=='cualquiera'){ echo 'selected'; } ?>><?php echo $this->lang->line('filtro_categoria_productos_origen'); ?></option>
                    <option value="nacionales" <?php if(isset($_GET['OrigenBusqueda'])&&$_GET['OrigenBusqueda']=='nacionales'){ echo 'selected'; } ?>><?php echo $this->lang->line('filtro_categoria_productos_nacionales'); ?></option>
                    <option value="Importados" <?php if(isset($_GET['OrigenBusqueda'])&&$_GET['OrigenBusqueda']=='Importados'){ echo 'selected'; } ?>><?php echo $this->lang->line('filtro_categoria_productos_importados'); ?></option>
                  </select>
                  <hr>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="OfertaBusqueda" id="OfertaBusqueda" <?php if(isset($_GET['OfertaBusqueda'])){ echo 'checked'; } ?>>
                    <label class="custom-control-label" for="OfertaBusqueda"><?php echo $this->lang->line('filtro_categoria_productos_en_oferta'); ?></label>
                  </div>
                <hr>
                <button type="submit" class="btn btn<?php echo $primary; ?> btn-block" ><?php echo $this->lang->line('filtro_categoria_productos_filtrar'); ?></button>
                </form>
            </div>
          </div>

        </div>
      </div>

      <div class="col-12 mb-4">

        <?php foreach($productos as $producto){ ?>
        <div class="card mb-2 vistaProductos">
            <div class="bx">
              <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
              <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>">
                <div class="imagen-producto">
                  <img class="spanImg mr-1" src="<?php echo base_url($ruta_portada); ?>"></img>
                  <div class="contenedorEtiquetas">
                    <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                      <span class="etiqueta-1"><?php echo $this->lang->line('etiquetas_productos_mexico'); ?></span>
                    <?php } ?>
                    <?php if(strtotime($producto->PRODUCTO_FECHA_PUBLICACION) > strtotime('-'.$op['dias_productos_nuevos'].' Days')){ ?>
                      <span class="etiqueta-2 <?php echo 'bg'.$primary; ?>"><?php echo 'bg'.$primary; ?>"><?php echo $this->lang->line('etiquetas_productos_nuevo'); ?></span>
                    <?php } ?>
                    <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                      <span class="etiqueta-3"><?php echo $this->lang->line('etiquetas_productos_oferta'); ?></span>
                    <?php } ?>
                  </div>
                </div>
                <div class="product-content text-left p-3">
                  <?php
                  $promedio = $this->CalificacionesModel->promedio_calificaciones_producto($producto->ID_PRODUCTO);
                  $cantidad = $this->CalificacionesModel->conteo_calificaciones_producto($producto->ID_PRODUCTO);
                  ?>
                  <ul class="rating mb-1">
                    <?php $estrellas = round($promedio['CALIFICACION_ESTRELLAS']); $estrellas_restan= 5-$estrellas; ?>
                    <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                      <li class="fa fa-star <?php echo 'text'.$primary; ?>"></li>
                    <?php } ?>
                    <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                      <li class="far fa-star <?php echo 'text'.$primary; ?>"></li>
                    <?php } ?>
                  </ul>
                  <h4 class="title text-primary"><?php echo $producto->PRODUCTO_NOMBRE; ?></h4>
                  <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                    <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO_LISTA,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
                  <?php } ?>
                  <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>

                </div>
              </a>
              <a href="#" class="btnFavorito" title="Añadir a Favoritos"> <span class="far fa-heart text-primary-6"></span> </a>
           </div>
        </div>
        <?php } ?>

      </div>
    </div>
<!--
    <div class="col-12 mb-4">
      <nav aria-label="Page navigation example">
        <ul class="pagination pagination-sm justify-content-center">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
-->
  </div>

  <!-- slider productos relacionados -->
<!--
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="h4 text-center pb-3">Productos destacados</h2>
      </div>
    </div>
  </div>

  <div class="sliderProductos">
    <ul class="slides">

      <?php for($i=0; $i<=5; $i++){ ?>
      <li>
        <div class="card">
          <a href="#producto">
            <div class="imagen-producto">
              <img class="spanImg" src="https://picsum.photos/300/300/?random=<?php echo $i; ?>"></img>
              <div class="contenedorEtiquetas">
                <span class="etiqueta-1">Méx</span>
                <span class="etiqueta-2">Nuevo</span>
                <span class="etiqueta-3">Oferta</span>
              </div>
            </div>
            <div class="product-content text-center py-3">
              <ul class="rating">
                <li class="far fa-star"></li>
                <li class="far fa-star"></li>
                <li class="far fa-star"></li>
                <li class="far fa-star"></li>
                <li class="far fa-star"></li>
                <br>
                <li class="text-dark">(1 calif)</li>
              </ul>
              <h4 class="title text-primary">Nombre producto</h4>
              <div class="price"><small>$</small> 120.00 <small>MXN </small></div>
            </div>
          </a>
          <a href="#favorito" class="btnFavorito" title="Añadir a Favoritos"> <span class="far fa-heart text-primary-6"></span> </a>
        </div>
      </li>
      <?php } ?>

    </ul>
  </div>
-->

</div>
