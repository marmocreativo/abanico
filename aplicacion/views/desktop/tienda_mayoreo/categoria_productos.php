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
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('categoria_productos_migas_inicio'); ?></a></li>
          <li class="breadcrumb-item active <?php echo 'text'.$primary; ?>" aria-current="page"><?php echo $titulo_categoria; ?></li>
        </ol>
      </nav>
      <!-- <div class="fila">
        <h1 class="h3 border-bottom pb-3"> <i class="fa fa-boxes"></i> <?php echo $titulo_categoria; ?></h1>
      </div> -->
    </div>
    <div class="row">
    <div class="col-2 d-none">
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
      <div class="row">
          <?php
          // Verificación de productos
          $hay_productos = true;
            ?>
            <!-- CUADRICULA DE PRODUCTOS -->
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
                ?>
                <div class="col-12 col-md-4 col-lg-3 mb-3">
                  <div class="cuadricula-productos">
                    <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                    <!-- <a href="<?php echo base_url('tienda-mayoreo/producto/'.$producto->PRODUCTO_URL.'/'.$producto->ID_PRODUCTO); ?>" class="enlace-principal"> -->
                    <a href="javascript:void(0);">
                      <div class="imagen-producto">
                          <span  style="background-image:url(<?php echo base_url($ruta_portada); ?>)"></span>
                      </div>
                      </a>
                      <div class="product-content text-center">
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
                          <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h3>
                          <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                            <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($producto->PRODUCTO_PRECIO_LISTA,2); ?> <small><?php echo $producto->PRODUCTO_DIVISA_DEFAULT; ?> </small> </div>
                          <?php } ?>
                          <?php $rangos_precios = $this->ProductosRangosMayoreoModel->lista_unidades($producto->ID_PRODUCTO);?>
                          <table class="table">
                            <?php foreach($rangos_precios as $rango){ ?>
                            <tr>
                              <td><?php echo $rango->RANGO_MIN; ?> - <?php echo $rango->RANGO_MAX; ?> <?php echo $rango->RANGO_UNIDAD; ?></td>
                              <td>$<?php echo $rango->RANGO_PRECIO_UNIDAD; ?></td>
                            </tr>
                            <?php } ?>
                          </table>
                          <div class="py-3">
                            <div class="col-12">
                              <div class="form-group">
                                <label for="" class="sr-only"><?php echo $this->lang->line('pagina_producto_formulario_cantidad'); ?></label>
                                <input type="number" class="form-control" name="CantidadProducto" id='CantidadProducto' min="1" max="<?php echo $producto->PRODUCTO_CANTIDAD; ?>" value="<?php echo $producto->PRODUCTO_CANTIDAD_MINIMA; ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <button class="btn <?php echo 'btn-outline'.$primary; ?> btn- btn-block BotonEnLista"
                                  data-id-producto='<?php echo $producto->ID_PRODUCTO; ?>'
                                  data-nombre-producto='<?php echo $titulo; ?>'
                                  data-sku='<?php echo $producto->PRODUCTO_SKU; ?>'
                                  data-cantidad-max='<?php echo $producto->PRODUCTO_CANTIDAD; ?>'
                                  data-divisa-default='<?php echo $producto->PRODUCTO_DIVISA_DEFAULT; ?>'
                                  data-contra-entrega='no'
                                  data-envio-gratuito='no'
                                  data-imagen-producto='<?php echo base_url($ruta_portada) ?>'
                                  data-peso-producto='<?php echo $producto->PRODUCTO_PESO; ?>'
                                  data-detalles-producto=''
                                  data-precio-producto='<?php echo $precio_venta; ?>'
                                  data-id-tienda='1'
                                  data-nombre-tienda='Abanico Mayoreo'
                                  >
                                 <span class="fa fa-shopping-cart"></span> <?php echo $this->lang->line('pagina_producto_formulario_al_carrito'); ?></button>
                            </div>
                          </div>

                      </div>
                  </div>
              </div>
            <?php } ?>
            <!-- /CUADRICULA DE PRODUCTOS -->
        <?php if(!$hay_productos){ ?>
          <div class="border border-default p-3 text-center">
            <a href="<?php echo base_url('usuario/registrar'); ?>"><h3>Por el momento no tenemos productos de mayoreo</h3></a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<!-- Modal de flujos -->

<!-- Modal -->
<div class="modal fade" id="ModalAyuda" tabindex="-1" role="dialog" aria-labelledby="ModalAyuda" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-question-circle"></i> Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">

          <div class="linea-colores-delgada">
            <div class="barra-color barra-azul"></div>
            <div class="barra-color barra-rosa"></div>
            <div class="barra-color barra-amarillo"></div>
            <div class="barra-color barra-verde"></div>
            <div class="barra-color barra-morado"></div>
          </div>
        <!-- Slider Ayuda-->
        <div id="carouselAyuda" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselAyuda" data-slide-to="0" class="active"></li>
            <li data-target="#carouselAyuda" data-slide-to="1"></li>
            <li data-target="#carouselAyuda" data-slide-to="2"></li>
            <li data-target="#carouselAyuda" data-slide-to="3"></li>
            <li data-target="#carouselAyuda" data-slide-to="4"></li>
            <li data-target="#carouselAyuda" data-slide-to="5"></li>
            <li data-target="#carouselAyuda" data-slide-to="6"></li>
            <li data-target="#carouselAyuda" data-slide-to="7"></li>
            <li data-target="#carouselAyuda" data-slide-to="8"></li>
            <li data-target="#carouselAyuda" data-slide-to="9"></li>
            <li data-target="#carouselAyuda" data-slide-to="10"></li>
            <li data-target="#carouselAyuda" data-slide-to="11"></li>
            <li data-target="#carouselAyuda" data-slide-to="12"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.1.png'); ?>" alt="Registro paso 1">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.2.png'); ?>" alt="Registro paso 2">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.3.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.4.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.5.png'); ?>" alt="Registro paso 5">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.6.png'); ?>" alt="Registro paso 6">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.7.png'); ?>" alt="Registro paso 7">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.8.png'); ?>" alt="Registro paso 8">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.9.png'); ?>" alt="Registro paso 9">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.10.png'); ?>" alt="Registro paso 10">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.11.png'); ?>" alt="Registro paso 11">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.12.png'); ?>" alt="Registro paso 12">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselAyuda" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselAyuda" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
