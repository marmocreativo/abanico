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
          <li class="breadcrumb-item active text-primary " aria-current="page"><?php if(!empty($categoria)){ echo $categoria['CATEGORIA_NOMBRE']; } ?></li>
        </ol>
      </div>

      <div class="col-12 mb-3">
        <?php if(!empty($categoria)&&isset($categoria)){ ?>
        <h3><?php echo $categoria['CATEGORIA_NOMBRE']; ?></h3>
      <?php }else{ ?>
        <h3>Todos los productos</h3>
      <?php } ?>
        <div class="card" style="background-color:transparent;">
          <?php if(!empty($categoria)&&isset($categoria)){ ?>
          <?php   $sub_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria['ID_CATEGORIA']],$categoria['CATEGORIA_TIPO'],'','');?>
          <?php if(!empty($sub_categorias)){ ?>
            <button class="btn btn-outline<?php echo $categoria['CATEGORIA_COLOR']; ?> btn-sm" type="button" data-toggle="collapse" data-target="#collapseCategorias" aria-expanded="false" aria-controls="collapseExample">
              <i class="fas fa-th mr-2"></i>Subcategorias
            </button>
            <div class="collapse" id="collapseCategorias">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <?php $i=0; foreach($sub_categorias as $sub_categoria){ ?>
                    <?php
                      // Variables de traducción
                      if($_SESSION['lenguaje']['iso']=='es'){
                        $titulo = $sub_categoria->CATEGORIA_NOMBRE;
                      }else{
                        $traduccion = $this->TraduccionesModel->lista($sub_categoria->ID_CATEGORIA,'categoria',$_SESSION['lenguaje']['iso']);
                        if(!empty($traduccion['TITULO'])){
                          $titulo = $traduccion['TITULO'];
                        }else{
                          $titulo = $sub_categoria->CATEGORIA_NOMBRE;
                        }
                      }
                    ?>
                  <a class="nav-link text<?php echo $sub_categoria->CATEGORIA_COLOR; ?>" id="menu-categoria-<?php echo $sub_categoria->ID_CATEGORIA; ?>" href="<?php echo base_url('categoria?slug='.$sub_categoria->CATEGORIA_URL); ?>">
                  <?php echo $titulo; ?>
                  </a>
                  <?php ++$i;  } ?>
               </div>
            </div>
            <hr>
          <?php } ?>
          <?php } ?>

          <button class="btn btnFiltros btn<?php echo $primary; ?> btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="fas fa-sliders-h mr-2"></i>Filtros
          </button>
          <div class="collapse" id="collapseExample">
            <div class="p-3">
              <form class="" action="<?php echo base_url($origen_formulario) ?>" method="get">
                <?php if($origen_formulario=='categoria'&&!empty($categoria)){ ?>
                  <input type="hidden" name="slug" value="<?php echo $categoria['CATEGORIA_URL']; ?>">
                <?php } ?>
                <input type="hidden" name="Busqueda" value="<?php if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){ echo filter_var ( $_GET['Busqueda'], FILTER_SANITIZE_STRING); } ?>">
                <?php if(!isset($categoria['CATEGORIA_TIPO'])){ ?>
                <input type="hidden" name="BuscarEn" value="<?php if(isset($_GET['BuscarEn'])){ echo $_GET['BuscarEn']; }else{ echo 'productos'; }; ?>">
              <?php }else{ ?>
                <input type="hidden" name="BuscarEn" value="<?php if(isset($_GET['BuscarEn'])){ echo $_GET['BuscarEn']; }else{ echo $categoria['CATEGORIA_TIPO']; }; ?>">
              <?php } ?>
                <div class="contenedor-filtros">
                  <select class="custom-select filtro-sel" name="OrdenBusqueda">
                    <option value="" selected><?php echo $this->lang->line('filtro_categoria_productos_ordenar_por'); ?></option>
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
                  <select class="custom-select filtro-sel" name="CondicionBusqueda">
                    <option value="cualquiera" <?php if(isset($_GET['CondicionBusqueda'])&&$_GET['CondicionBusqueda']=='cualquiera'){ echo 'selected'; } ?>>Condición</option>
                    <option value="nuevo" <?php if(isset($_GET['CondicionBusqueda'])&&$_GET['CondicionBusqueda']=='nuevo'){ echo 'selected'; } ?>>Nuevo</option>
                    <option value="usado" <?php if(isset($_GET['CondicionBusqueda'])&&$_GET['CondicionBusqueda']=='usado'){ echo 'selected'; } ?>>Usado</option>
                  </select>
                  <hr>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="OfertaBusqueda" id="OfertaBusqueda" <?php if(isset($_GET['OfertaBusqueda'])){ echo 'checked'; } ?>>
                    <label class="custom-control-label" for="OfertaBusqueda"><?php echo $this->lang->line('filtro_categoria_productos_en_oferta'); ?></label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="ArtesanalBusqueda" id="ArtesanalBusqueda" <?php if(isset($_GET['ArtesanalBusqueda'])){ echo 'checked'; } ?>>
                    <label class="custom-control-label" for="ArtesanalBusqueda">Artesanal</label>
                  </div>
                  <!--
                  <hr>
                  <label for="customRange1">Rango de Precio</label>
                  <input type="range" class="custom-range" min="0" max="5" id="customRange1">
                -->
                <hr>
                <button type="submit" class="btn btn<?php echo $primary; ?> btn-block" ><?php echo $this->lang->line('filtro_categoria_productos_filtrar'); ?></button>
                </div>
                </form>
            </div>
          </div>

        </div>
      </div>

      <div class="col-12 mb-4">
        <?php $hay_productos = false;

        if(empty($productos)&&isset($categoria)){
            // Busco categorías hijas
            $categorias_segundo_nivel = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria['ID_CATEGORIA']],'productos','','');
            foreach ($categorias_segundo_nivel as $categoria_segunda){
              $productos_segundo = $this->ProductosModel->lista_categoria_activos($parametros_or,$parametros_and,[$categoria_segunda->ID_CATEGORIA],$orden,'');
              if(!empty($productos_segundo)) {
                $hay_productos = true;
                $productos = array_merge($productos, $productos_segundo);
              }
              $categorias_tercer_nivel = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria_segunda->ID_CATEGORIA],'productos','','');
              foreach ($categorias_tercer_nivel as $categoria_tercera){
                $productos_tercer = $this->ProductosModel->lista_categoria_activos($parametros_or,$parametros_and,[$categoria_tercera->ID_CATEGORIA],$orden,'');
                if(!empty($productos_tercer)) {
                  $hay_productos = true;
                  $productos = array_merge($productos, $productos_tercer);
                }
                } // Categorias de Tercer nivel
              }// Categorias de Segundo Nivel
          }else{  $hay_productos = true;  }// Condicional de productos
          ?>
          <!-- CUADRICULA PRODUCTOS -->
          <?php foreach($productos as $producto){ ?>
            <?php
            // Variables de Traducción
            if($_SESSION['lenguaje']['iso']==$producto->LENGUAJE){
              $titulo = $producto->PRODUCTO_NOMBRE;
            }else{
              $traduccion = $this->TraduccionesModel->lista($producto->ID_PRODUCTO,'producto',$_SESSION['lenguaje']['iso']);
              if(!empty($traduccion)){
                $titulo = $traduccion['TITULO'];
              }else{
                $titulo = $producto->PRODUCTO_NOMBRE;
              }
            }
            // Variables de Paquete
            $paquete = $this->PlanesModel->plan_activo_usuario($producto->ID_USUARIO,'productos');
            if($paquete==null){
              $visible = 'd-none';
            }else{
              $visible = '';
            }
          ?>
          <div class="card mb-2 vistaProductos <?php echo $visible; ?>">
              <div class="bx">
                <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                <a href="<?php echo base_url('producto/'.$producto->PRODUCTO_URL.'/'.$producto->ID_PRODUCTO); ?>">
                  <div class="imagen-producto">
                    <img class="spanImg mr-1" src="<?php echo base_url($ruta_portada); ?>"></img>
                    <div class="contenedorEtiquetas">
                      <?php if($producto->PRODUCTO_ARTESANAL=='si'){ ?>
                        <span class="etiqueta-artesanal"><img src="<?php echo base_url('assets/global/img/artesanal.png'); ?>" class="img-fluid"></span>
                      <?php } ?>
                      <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                        <span class="etiqueta-1"><?php echo $this->lang->line('etiquetas_productos_mexico'); ?></span>
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
                    // variables de precio
                    if($producto->PRODUCTO_DIVISA_DEFAULT!=$_SESSION['divisa']['iso']){
                      $cambio_divisa_default = $this->DivisasModel->detalles_iso($producto->PRODUCTO_DIVISA_DEFAULT);
                      if($producto->PRODUCTO_DIVISA_DEFAULT!='MXN'){
                        $precio_lista = $producto->PRODUCTO_PRECIO_LISTA/$cambio_divisa_default['DIVISA_CONVERSION'];
                        $precio_venta = $producto->PRODUCTO_PRECIO/$cambio_divisa_default['DIVISA_CONVERSION'];
                        $precio_display = $producto->PRODUCTO_PRECIO;
                      }else{
                        $precio_lista = $_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO_LISTA;
                        $precio_venta = $_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO;
                        $precio_display = $producto->PRODUCTO_PRECIO;
                      }
                    }else{
                      $precio_lista = $producto->PRODUCTO_PRECIO_LISTA;
                      $precio_venta = $producto->PRODUCTO_PRECIO;
                      $precio_display = $producto->PRODUCTO_PRECIO;
                    }
                    ?>
                    <ul class="rating mb-1">
                      <?php $estrellas = round($promedio['CALIFICACION_ESTRELLAS']); $estrellas_restan= 5-$estrellas; ?>
                      <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                        <li class="fa fa-star "></li>
                      <?php } ?>
                      <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                        <li class="far fa-star "></li>
                      <?php } ?>
                    </ul>
                    <h4 class="title"><?php echo $titulo; ?></h4>
                    <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                      <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($producto->PRODUCTO_PRECIO_LISTA,2); ?> <small><?php echo $producto->PRODUCTO_DIVISA_DEFAULT; ?> </small> </div>
                    <?php } ?>
                    <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_display,2); ?> <small><?php echo $producto->PRODUCTO_DIVISA_DEFAULT; ?> </small></div>
                    <?php if($producto->PRODUCTO_ENVIO_GRATUITO!='no'){ ?>
                    <div class="p-1 border border-success text-center rounded" style="border-style:dashed !important">
                      <span style="font-size:12px;" class="text-success"> Envío gratis <i class="fa fa-truck"></i></span>
                    </div>
                    <?php } ?>
                  </div>
                </a>
                <a href="#" class="btnFavorito" title="Añadir a Favoritos"> <span class="far fa-heart text-primary-6"></span> </a>
             </div>
          </div>
        <?php } ?>
          <!-- /CUADRICULA PRODUCTOS -->
        <?php if(!$hay_productos){ ?>
          <div class="border border-default p-3 text-center">
            <a href="<?php echo base_url('usuario/registrar'); ?>"><h3>Sé el primero en ofrecer productos en esta categoría.</h3></a>
          </div>
        <?php } ?>

      </div>
    </div>
</div>

<?php /*

<?php foreach($productos as $producto){ ?>
  <?php
  // Variables de Traducción
  if($_SESSION['lenguaje']['iso']==$producto->LENGUAJE){
    $titulo = $producto->PRODUCTO_NOMBRE;
  }else{
    $traduccion = $this->TraduccionesModel->lista($producto->ID_PRODUCTO,'producto',$_SESSION['lenguaje']['iso']);
    if(!empty($traduccion)){
      $titulo = $traduccion['TITULO'];
    }else{
      $titulo = $producto->PRODUCTO_NOMBRE;
    }
  }
  // Variables de Paquete
  $paquete = $this->PlanesModel->plan_activo_usuario($producto->ID_USUARIO,'productos');
  if($paquete==null){
    $visible = 'd-none';
  }else{
    $visible = '';
  }
  ?>
<div class="card mb-2 vistaProductos">
    <div class="bx">
      <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
      <a href="<?php echo base_url('producto/'.$producto->PRODUCTO_URL.'/'.$producto->ID_PRODUCTO); ?>">
        <div class="imagen-producto">
          <img class="spanImg mr-1" src="<?php echo base_url($ruta_portada); ?>"></img>
          <div class="contenedorEtiquetas">
            <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
              <span class="etiqueta-1"><?php echo $this->lang->line('etiquetas_productos_mexico'); ?></span>
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
          // variables de precio
          if($producto->PRODUCTO_DIVISA_DEFAULT!=$_SESSION['divisa']['iso']){
            $cambio_divisa_default = $this->DivisasModel->detalles_iso($producto->PRODUCTO_DIVISA_DEFAULT);
            if($producto->PRODUCTO_DIVISA_DEFAULT!='MXN'){
              $precio_lista = $producto->PRODUCTO_PRECIO_LISTA/$cambio_divisa_default['DIVISA_CONVERSION'];
              $precio_venta = $producto->PRODUCTO_PRECIO/$cambio_divisa_default['DIVISA_CONVERSION'];
            }else{
              $precio_lista = $_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO_LISTA;
              $precio_venta = $_SESSION['divisa']['conversion']*$producto->PRODUCTO_PRECIO;
            }
          }else{
            $precio_lista = $producto->PRODUCTO_PRECIO_LISTA;
            $precio_venta = $producto->PRODUCTO_PRECIO;
          }
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
          <h4 class="title text-primary"><?php echo $titulo; ?></h4>
          <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
            <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_lista,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
          <?php } ?>
          <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_venta,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>

        </div>
      </a>
      <a href="#" class="btnFavorito" title="Añadir a Favoritos"> <span class="far fa-heart text-primary-6"></span> </a>
   </div>
</div>
<?php } ?>

*/?>
