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
<div class="contenido_principal fila p-3" style="background:#eee;">
  <div class="container">
    <div class="row">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Inicio</a></li>
          <li class="breadcrumb-item active <?php echo 'text'.$primary; ?>" aria-current="page"><?php echo $titulo_categoria; ?></li>
        </ol>
      </nav>
      <!-- <div class="fila">
        <h1 class="h3 border-bottom pb-3"> <i class="fa fa-boxes"></i> <?php echo $titulo_categoria; ?></h1>
      </div> -->
    </div>
    <div class="row">
    <div class="col-2 d-none d-sm-block fila filtro-cont">
      <form class="" action="<?php echo base_url('busqueda') ?>" method="get">
        <input type="hidden" name="Busqueda" value="<?php if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){ echo filter_var ( $_GET['Busqueda'], FILTER_SANITIZE_STRING); } ?>">
        <?php if(!isset($categoria['CATEGORIA_TIPO'])){ ?>
        <input type="hidden" name="BuscarEn" value="<?php if(isset($_GET['BuscarEn'])){ echo $_GET['BuscarEn']; }else{ echo 'productos'; }; ?>">
      <?php }else{ ?>
        <input type="hidden" name="BuscarEn" value="<?php if(isset($_GET['BuscarEn'])){ echo $_GET['BuscarEn']; }else{ echo $categoria['CATEGORIA_TIPO']; }; ?>">
      <?php } ?>
        <div class="contenedor-filtros">
          <select class="custom-select filtro-sel" name="OrdenBusqueda">
            <option selected>Ordenar por</option>
            <option value="precio_desc" <?php if(isset($_GET['OrdenBusqueda'])&&$_GET['OrdenBusqueda']=='precio_desc'){ echo 'selected'; } ?>>Más caro primero</option>
            <option value="precio_asc" <?php if(isset($_GET['OrdenBusqueda'])&&$_GET['OrdenBusqueda']=='precio_asc'){ echo 'selected'; } ?>>Más barato primero</option>
            <option value="alfabetico_asc" <?php if(isset($_GET['OrdenBusqueda'])&&$_GET['OrdenBusqueda']=='alfabetico_asc'){ echo 'selected'; } ?>>Alfabético A-Z</option>
            <option value="alfabetico_desc" <?php if(isset($_GET['OrdenBusqueda'])&&$_GET['OrdenBusqueda']=='alfabetico_desc'){ echo 'selected'; } ?>>Alfabético Z-A</option>
            <option value="fecha_desc" <?php if(isset($_GET['OrdenBusqueda'])&&$_GET['OrdenBusqueda']=='fecha_desc'){ echo 'selected'; } ?>>Más nuevos</option>
            <option value="fecha_asc" <?php if(isset($_GET['OrdenBusqueda'])&&$_GET['OrdenBusqueda']=='fecha_asc'){ echo 'selected'; } ?>>Más viejos</option>
          </select>
          <hr>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="OrigenBusqueda" id="OrigenBusqueda" <?php if(isset($_GET['OrigenBusqueda'])){ echo 'checked'; } ?>>
            <label class="custom-control-label" for="OrigenBusqueda">Mexicano</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="TiempoBusqueda" id="TiempoBusqueda" <?php if(isset($_GET['TiempoBusqueda'])){ echo 'checked'; } ?>>
            <label class="custom-control-label" for="TiempoBusqueda">Nuevo</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="OfertaBusqueda" id="OfertaBusqueda" <?php if(isset($_GET['OfertaBusqueda'])){ echo 'checked'; } ?>>
            <label class="custom-control-label" for="OfertaBusqueda">Oferta</label>
          </div>
          <!--
          <hr>
          <label for="customRange1">Rango de Precio</label>
          <input type="range" class="custom-range" min="0" max="5" id="customRange1">
        -->
        <hr>
        <button type="submit" class="btn btn<?php echo $primary; ?> btn-block" >Filtrar</button>
        </form>
        </div>
      </div>
      <div class="col">
        <div class="card-deck">
          <?php foreach($productos as $producto){ ?>
            <div class="col-xl-3 col-md-4 col-sm-4 col-6 mb-3">
              <div class="cuadricula-productos">
                <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="enlace-principal">
                  <div class="imagen-producto">
                    <div class="contenedor-etiquetas">
                      <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                        <span class="etiqueta-1">Mex</span>
                      <?php } ?>
                      <?php if(strtotime($producto->PRODUCTO_FECHA_PUBLICACION) > strtotime('-'.$op['dias_productos_nuevos'].' Days')){ ?>
                        <span class="etiqueta-2 <?php echo 'bg'.$primary; ?>">Nuevo</span>
                      <?php } ?>
                      <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                        <span class="etiqueta-3">Oferta</span>
                      <?php } ?>
                    </div>
                      <span  style="background-image:url(<?php echo base_url($ruta_portada); ?>)"></span>
                      <div class="overlay-producto <?php echo 'bg'.$primary; ?>"><div class="overlay-producto-in"></div></div>
                      <div class="boton-ver">
                        <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Ver Producto"> <span class="fa fa-eye"></span> </a>
                      <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                        <a href="<?php echo base_url('producto/favorito?id='.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$producto->ID_PRODUCTO)); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                      <?php } ?>
                      </div>
                  </div>
                  </a>
                  <div class="product-content text-center">
                    <?php
                    $promedio = $this->CalificacionesModel->promedio_calificaciones_producto($producto->ID_PRODUCTO);
                    $cantidad = $this->CalificacionesModel->conteo_calificaciones_producto($producto->ID_PRODUCTO);
                    ?>
                      <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $producto->PRODUCTO_NOMBRE; ?></h3>
                      <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                        <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO_LISTA,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
                      <?php } ?>
                      <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>
                      <ul class="rating">
                        <?php $estrellas = round($promedio['CALIFICACION_ESTRELLAS']); $estrellas_restan= 5-$estrellas; ?>
                        <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                          <li class="fa fa-star <?php echo 'text'.$primary; ?>"></li>
                        <?php } ?>
                        <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                          <li class="far fa-star <?php echo 'text'.$primary; ?>"></li>
                        <?php } ?>
                        <li class="fa text-dark">(<?php echo $cantidad; ?>)</li>
                      </ul>
                  </div>
              </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>

<?php if(!isset($_GET['Busqueda'])){ ?>
  <!-- Slider productos relacionados -->
  <div class="row">
    <div class="fila fila-gris">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <h2 class="h3 text-center border-bottom pb-3 mb-3">Productos Relacionados</h2>
            <section class="slider">
            <div class="flexslider carousel">
              <ul class="slides">
                <?php foreach($productos as $producto){ ?>
                <li>
                  <div class="cuadricula-productos">
                    <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                    <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="enlace-principal">
                      <div class="imagen-producto">
                        <div class="contenedor-etiquetas">
                          <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                            <span class="etiqueta-1">Mex</span>
                          <?php } ?>
                          <?php if(strtotime($producto->PRODUCTO_FECHA_PUBLICACION) > strtotime('-'.$op['dias_productos_nuevos'].' Days')){ ?>
                            <span class="etiqueta-2">Nuevo</span>
                          <?php } ?>
                          <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                            <span class="etiqueta-3">Oferta</span>
                          <?php } ?>
                        </div>
                          <span  style="background-image:url(<?php echo base_url($ruta_portada); ?>)"></span>
                          <div class="overlay-producto <?php echo 'bg'.$primary; ?>"></div>
                          <div class="boton-ver">
                            <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Ver Producto"> <span class="fa fa-eye"></span> </a>
                          <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                            <a href="<?php echo base_url('producto/favorito?id='.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                          <?php }else{ ?>
                            <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$producto->ID_PRODUCTO)); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                          <?php } ?>
                          </div>
                      </div>
                      </a>
                      <div class="product-content text-center">
                        <?php
                        $promedio = $this->CalificacionesModel->promedio_calificaciones_producto($producto->ID_PRODUCTO);
                        $cantidad = $this->CalificacionesModel->conteo_calificaciones_producto($producto->ID_PRODUCTO);
                        ?>
                          <ul class="rating">
                            <?php $estrellas = round($promedio['CALIFICACION_ESTRELLAS']); $estrellas_restan= 5-$estrellas; ?>
                            <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                              <li class="fa fa-star"></li>
                            <?php } ?>
                            <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                              <li class="far fa-star"></li>
                            <?php } ?>
                            <li class="text-dark">(<?php echo $cantidad; ?> calif)</li>
                          </ul>
                          <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $producto->PRODUCTO_NOMBRE; ?></h3>
                          <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                            <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO_LISTA,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
                          <?php } ?>
                          <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>
                      </div>
                  </div>
                </li>
                <?php } ?>
              </ul>
            </div>
          </section>
            <!--
            <div class="card-deck mx-5 slides">
              <?php foreach($productos as $producto){ ?>
                <div class="col-3">
                  <div class="cuadricula-productos">
                    <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                    <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="enlace-principal">
                      <div class="imagen-producto">
                        <div class="contenedor-etiquetas">
                          <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                            <span class="etiqueta-1">Mex</span>
                          <?php } ?>
                          <?php if(strtotime($producto->PRODUCTO_FECHA_PUBLICACION) > strtotime('-'.$op['dias_productos_nuevos'].' Days')){ ?>
                            <span class="etiqueta-2">Nuevo</span>
                          <?php } ?>
                          <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                            <span class="etiqueta-3">Oferta</span>
                          <?php } ?>
                        </div>
                          <span  style="background-image:url(<?php echo base_url($ruta_portada); ?>)"></span>
                          <div class="overlay-producto <?php echo 'bg'.$primary; ?>"></div>
                          <div class="boton-ver">
                            <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Ver Producto"> <span class="fa fa-eye"></span> </a>
                          <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                            <a href="<?php echo base_url('producto/favorito?id='.$producto->ID_PRODUCTO); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                          <?php }else{ ?>
                            <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$producto->ID_PRODUCTO)); ?>" class="botones-flotantes border border-white rounded" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                          <?php } ?>
                          </div>
                      </div>
                      </a>
                      <div class="product-content text-center">
                          <ul class="rating">
                              <li class="fa fa-star"></li>
                              <li class="fa fa-star"></li>
                              <li class="fa fa-star"></li>
                              <li class="far fa-star"></li>
                              <li class="far fa-star"></li>
                          </ul>
                          <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $producto->PRODUCTO_NOMBRE; ?></h3>
                          <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                            <div class="price-list"> $<?php echo $producto->PRODUCTO_PRECIO_LISTA; ?></div>
                          <?php } ?>
                          <div class="price"> $<?php echo $producto->PRODUCTO_PRECIO; ?></div>
                      </div>
                  </div>
              </div>
            <?php } ?>
            </div>
          -->
          </div>
        </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
