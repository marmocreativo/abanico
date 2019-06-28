<?php
  // Variables de Traducción
  if($_SESSION['lenguaje']['iso']==$producto['LENGUAJE']){
    $titulo = $producto['PRODUCTO_NOMBRE'];
    $descripcion_corta = $producto['PRODUCTO_DESCRIPCION'];
    $descripcion_larga = $producto['PRODUCTO_DETALLES'];
  }else{
    $traduccion = $this->TraduccionesModel->lista($producto['ID_PRODUCTO'],'producto',$_SESSION['lenguaje']['iso']);
    if(!empty($traduccion)){
      $titulo = $traduccion['TITULO'];
      $descripcion_corta = $traduccion['DESCRIPCION_CORTA'];
      $descripcion_larga = $traduccion['DESCRIPCION_LARGA'];
    }else{
      $titulo = $producto['PRODUCTO_NOMBRE'];
      $descripcion_corta = $producto['PRODUCTO_DESCRIPCION'];
      $descripcion_larga = $producto['PRODUCTO_DETALLES'];
    }
  }
  // Variables de paquete
  $paquete = $this->PlanesModel->plan_activo_usuario($producto['ID_USUARIO'],'productos');
?>

<div class="contenido_principal">
  <div class="main">
      <div class="serv-profile">
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('pagina_producto_migas_inicio'); ?></a></li>
              <li class="breadcrumb-item active <?php echo 'text'.$primary; ?>" aria-current="page"><?php echo $this->lang->line('pagina_producto_migas_producto'); ?></li>
            </ol>
          </nav>
          <?php retro_alimentacion(); ?>
          <div class="row mb-5">
            <div class="col-7">
              <div class="col-12 mb-3 slider-fotos d-flex align-items-center justify-content-center">
                <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
                <img src="<?php echo base_url($ruta_portada) ?>" class="img-fluid visor-galeria-producto" style="max-height:500px" alt="">
              </div>
              <div class="row">
                <?php foreach($galerias as $galeria){ ?>
                  <?php $ruta_galeria = $op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO; ?>
                  <div class="col-2 mb-2 px-1">
                  <div class="card slider-thumbs deck-imagenes" style="background-image:url('<?php echo base_url($ruta_galeria) ?>'); background-size:contain; background-position:center; background-repeat:no-repeat;">
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="col-5">
              <h5><?php echo $titulo; ?></h5>
              <hr>
              <?php echo $descripcion_corta; ?>
              <hr>
              <!-- Solo muestro precio si el producto está en venta -->
              <?php
                if(
                  !empty($paquete)&&
                  $producto['PRODUCTO_CANTIDAD']>0&&
                  $producto['PRODUCTO_ESTADO']=='activo'&&
                  $op['permitir_compra']=='si'
                ){ // Aquí se activa o desactiva la visibilidad del precio si el producto está a la venta
                ?>
                <?php
                  // variables de precio
                  if($producto['PRODUCTO_DIVISA_DEFAULT']!=$_SESSION['divisa']['iso']){
                    $cambio_divisa_default = $this->DivisasModel->detalles_iso($producto['PRODUCTO_DIVISA_DEFAULT']);
                    if($producto['PRODUCTO_DIVISA_DEFAULT']!='MXN'){
                      $precio_lista = $producto['PRODUCTO_PRECIO_LISTA']/$cambio_divisa_default['DIVISA_CONVERSION'];
                      $precio_venta = $producto['PRODUCTO_PRECIO']/$cambio_divisa_default['DIVISA_CONVERSION'];
                    }else{
                      $precio_lista = $_SESSION['divisa']['conversion']*$producto['PRODUCTO_PRECIO_LISTA'];
                      $precio_venta = $_SESSION['divisa']['conversion']*$producto['PRODUCTO_PRECIO'];
                    }
                  }else{
                    $precio_lista = $producto['PRODUCTO_PRECIO_LISTA'];
                    $precio_venta = $producto['PRODUCTO_PRECIO'];
                  }
                 ?>
              <?php if(!empty($producto['PRODUCTO_PRECIO_LISTA'])&&$producto['PRODUCTO_PRECIO_LISTA']>$producto['PRODUCTO_PRECIO']){ ?>
              <h3 class="product-price-descuento h6"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_lista ,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></h3>
              <?php } ?>
              <h2 class="product-price display-6" >
                <small><?php echo $_SESSION['divisa']['signo']; ?></small>
                  <span id="Precio_Producto" ><?php echo number_format( $precio_venta,2); ?></span>
                <small><?php echo $_SESSION['divisa']['iso']; ?> </small>
              </h2>
              <div class="row my-3">
                  <?php if(!empty($combinaciones)){ ?>
                  <div class="col">
                    <div class="form-group">
                      <label for="CombinacionProducto" class="sr-only"><?php echo $this->lang->line('pagina_producto_formulario_opciones'); ?></label>
                      <select class="form-control CombinacionProducto" name="CombinacionProducto">
                      <?php foreach($combinaciones as $combinacion){?>
                        <option value="<?php echo  $combinacion->COMBINACION_OPCION; ?>"
                          data-precio-producto='<?php echo $combinacion->COMBINACION_PRECIO; ?>'
                          data-precio-visible-producto='<?php echo number_format($_SESSION['divisa']['conversion']*$combinacion->COMBINACION_PRECIO,2); ?>'
                          data-detalles-producto='<?php echo $combinacion->COMBINACION_GRUPO.'-'.$combinacion->COMBINACION_OPCION; ?>'
                          ><?php echo $combinacion->COMBINACION_GRUPO.'-'.$combinacion->COMBINACION_OPCION; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php } ?>
                <div class="col">
                  <div class="form-group">
                    <label for="" class="sr-only"><?php echo $this->lang->line('pagina_producto_formulario_cantidad'); ?></label>
                    <input type="number" class="form-control" name="CantidadProducto" id='CantidadProducto' min="1" max="<?php echo $producto['PRODUCTO_CANTIDAD']; ?>" value="<?php echo $producto['PRODUCTO_CANTIDAD_MINIMA']; ?>">
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn <?php echo 'btn-outline'.$primary; ?> btn- btn-block" id="BotonComprar"
                      data-id-producto='<?php echo $producto['ID_PRODUCTO']; ?>'
                      data-nombre-producto='<?php echo $titulo; ?>'
                      data-sku='<?php echo $producto['PRODUCTO_SKU']; ?>'
                      data-cantidad-max='<?php echo $producto['PRODUCTO_CANTIDAD']; ?>'
                      data-divisa-default='<?php echo $producto['PRODUCTO_DIVISA_DEFAULT']; ?>'
                      data-contra-entrega='<?php echo $producto['PRODUCTO_CONTRA_ENTREGA']; ?>'
                      data-imagen-producto='<?php echo base_url($ruta_portada) ?>'
                      data-peso-producto='<?php echo $producto['PRODUCTO_PESO']; ?>'
                      data-detalles-producto=''
                      data-precio-producto='<?php echo $producto['PRODUCTO_PRECIO']; ?>'
                      data-id-tienda='<?php echo $tienda['ID_TIENDA']; ?>'
                      data-nombre-tienda='<?php echo $tienda['TIENDA_NOMBRE']; ?>'
                      >
                     <span class="fa fa-shopping-cart"></span> <?php echo $this->lang->line('pagina_producto_formulario_al_carrito'); ?></button>
                </div>
                <?php if(isset($_SESSION['usuario']['id'])){ ?>
                  <div class="col-12">
                    <hr>
                    <button class="btn <?php echo 'btn'.$primary; ?> btn- btn-block" id="BotonCompraRapida"
                        data-id-producto='<?php echo $producto['ID_PRODUCTO']; ?>'
                        data-nombre-producto='<?php echo $titulo; ?>'
                        data-sku='<?php echo $producto['PRODUCTO_SKU']; ?>'
                        data-cantidad-max='<?php echo $producto['PRODUCTO_CANTIDAD']; ?>'
                        data-divisa-default='<?php echo $producto['PRODUCTO_DIVISA_DEFAULT']; ?>'
                        data-contra-entrega='<?php echo $producto['PRODUCTO_CONTRA_ENTREGA']; ?>'
                        data-imagen-producto='<?php echo base_url($ruta_portada) ?>'
                        data-peso-producto='<?php echo $producto['PRODUCTO_PESO']; ?>'
                        data-detalles-producto=''
                        data-precio-producto='<?php echo $producto['PRODUCTO_PRECIO']; ?>'
                        data-id-tienda='<?php echo $tienda['ID_TIENDA']; ?>'
                        data-nombre-tienda='<?php echo $tienda['TIENDA_NOMBRE']; ?>'
                        >
                       <span class="fa fa-shopping-cart"></span> <?php echo $this->lang->line('pagina_producto_formulario_comprar_ahora'); ?></button>
                  </div>
                <?php } ?>
              </div>

            <?php }else{ ?>
              <div class="p-4 my-3 text-center border <?php echo 'border'.$primary.' '.'text'.$primary; ?>">
                Compra con nosotros a partir de julio del 2019.
              </div>
            <?php } ?>

              <div class="card opiniones-serv">
                <div class="card-body">
                  <?php $promedio_calificaciones = $promedio_calificaciones['CALIFICACION_ESTRELLAS']; $estrellas_restan= 5-$promedio_calificaciones; ?>
                  <h5 class="card-title"><?php echo $this->lang->line('pagina_producto_calificaciones_promedio'); ?></h5>
                  <h1 style="display:inline;"><?php echo number_format($promedio_calificaciones,1); ?></h1>
                  <?php for($i = 1; $i<=$promedio_calificaciones; $i++){ ?>
                    <span class="fa fa-star <?php echo 'text'.$primary; ?>"></span>
                  <?php } ?>
                  <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                    <span class="far fa-star <?php echo 'text'.$primary; ?>"></span>
                  <?php } ?>
                  <?php $e = 5; foreach($estrellas as $estrella){ ?>
                <?php $restan = 5-$e; ?>
                <?php if($cantidad_calificaciones!=0){ $porcentaje = ($estrella*100)/$cantidad_calificaciones; }else{ $porcentaje=0; }?>
                <div class="row">
                  <div class="col">
                    <ul class=" list-unstyled rating m-0">
                      <?php for($i = 1; $i<=$e; $i++){ ?>
                        <i class="fa fa-star" style="font-size:0.8em;"></i>
                      <?php } ?>
                      <?php for($i = 1; $i<=$restan; $i++){ ?>
                        <i class="far fa-star" style="font-size:0.8em;"></i>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="col-7">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $porcentaje; ?>%" aria-valuenow="<?php echo $porcentaje; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                  </div>
                </div>
              <?php $e--; } ?>
                  <h6 class="card-subtitle my-3 text-muted"><?php echo $this->lang->line('pagina_producto_calificaciones_opiniones'); ?></h6>
                  <div class="row mt-3">
                  <div class="col">
                  <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                    <?php if(empty($mi_calificacion)){ ?>
                    <div class="card">
                        <div class="card-body">
                          <form class="" action="<?php echo base_url('producto/calificar'); ?>" method="post">
                            <input type="hidden" name="IdProducto" value="<?php echo $producto['ID_PRODUCTO']; ?>">
                            <input type="hidden" name="IdUsuario" value="<?php echo $producto['ID_USUARIO']; ?>">
                            <input type="hidden" name="IdCalificador" value="<?php echo $_SESSION['usuario']['id'] ?>">
                            <label for="EstrellasCalificacion"><?php echo $this->lang->line('pagina_producto_formulario_calificaciones_invita'); ?></label>
                            <div class="estrellas"></div>
                            <input type="hidden" id="EstrellasCalificacion" name="EstrellasCalificacion" value="1">
                            <div class="form-group">
                              <label for="ComentarioCalificacion"><?php echo $this->lang->line('pagina_producto_formulario_calificaciones_comentario'); ?></label>
                              <textarea class="form-control" name="ComentarioCalificacion" rows="2" cols="80"></textarea>
                            </div>
                            <button type="submit" class="btn <?php echo 'btn'.$primary; ?> btn-sm float-right" name="button"> <i class="fa fa-star"></i> <?php echo $this->lang->line('pagina_producto_formulario_calificaciones_calificar'); ?></button>
                          </form>
                        </div>
                    </div>
                  <?php }else{ ?>
                    <h6><?php echo $this->lang->line('pagina_producto_formulario_calificaciones_gracias'); ?></h6>
                  <?php } ?>
                  <?php }else{ ?>
                    <div class="card">
                      <div class="card-body">
                        <p><?php echo $this->lang->line('pagina_producto_formulario_calificaciones_para_calificar'); ?></p>
                        <a href="<?php echo base_url('login?url_redirect='.base_url('producto/?id='.$producto['ID_PRODUCTO'])); ?>" class="btn <?php echo 'btn-outline'.$primary; ?> btn-block"> <i class="fa fa-sign-in-alt"></i> <?php echo $this->lang->line('pagina_producto_formulario_calificaciones_iniciar_sesion'); ?></a>
                      </div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
                  <div class="list-group">
                  <?php if(!empty($mi_calificacion)){ ?>
                    <li class="media border border-info p-3">
                      <img class="mr-3 img-thumbnail rounded-circle" src="<?php echo base_url('assets/global/img/usuario_default.png') ?>" width="64" alt="">
                      <div class="media-body">
                        <h5 class="mt-0 mb-1"><?php echo $mi_calificacion['USUARIO_NOMBRE'].' '.$mi_calificacion['USUARIO_APELLIDOS']; ?></h5>
                        <div class="d-flex border-top border-bottom py-3">
                          <?php $estrellas = $mi_calificacion['CALIFICACION_ESTRELLAS']; $estrellas_restan= 5-$estrellas; ?>
                          <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                            <i class="fa fa-star"></i>
                          <?php } ?>
                          <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                            <i class="far fa-star"></i>
                          <?php } ?>
                        </div>
                        <p><?php echo $mi_calificacion['CALIFICACION_COMENTARIO']; ?></p>
                      </div>
                    </li>
                  <?php } ?>
                    <?php foreach($calificaciones as $calificacion){ ?>
                      <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                          <ul class="rating pl-0">
                            <?php $estrellas = $calificacion->CALIFICACION_ESTRELLAS; $estrellas_restan= 5-$estrellas; ?>
                            <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                              <li class="fa fa-star <?php echo 'text'.$primary; ?>"></li>
                            <?php } ?>
                            <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                              <li class="far fa-star <?php echo 'text'.$primary; ?>"></li>
                            <?php } ?>
                          </ul>
                          <small><?php echo $calificacion->CALIFICACION_FECHA_REGISTRO; ?></small>
                        </div>
                        <p class="mb-1"><?php echo $calificacion->CALIFICACION_COMENTARIO; ?></p>
                        <small></small>
                      </a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-5">
            <div class="col-12">
              <ul class="nav nav-tabs nav-fill fila-gris" id="tabProductos" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo $this->lang->line('pagina_producto_tabs_producto_detalles'); ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?php echo $this->lang->line('pagina_producto_tabs_producto_caracteristicas'); ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="preguntas-tab" data-toggle="tab" href="#preguntas" role="tab" aria-controls="preguntas" aria-selected="false"><?php echo $this->lang->line('pagina_producto_tabs_producto_preguntas'); ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><?php echo $this->lang->line('pagina_producto_tabs_producto_acerca_de'); ?></a>
                </li>
              </ul>
              <div class="tab-content fila-gris" id="contProductos">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="p-3">
                    <?php
                    $CI =& get_instance();
                    $CI->load->model('ConcursosModel');
                    $concurso = $CI->ConcursosModel->activo();
                    $productos_concurso = explode(' ',$concurso['PRODUCTOS']);
                    $frase_concurso = explode(' ',$concurso['FRASE']);
                    if(in_array ($producto['ID_PRODUCTO'],$productos_concurso)){
                      echo '<h3 class="text-danger">Aquí debe haber una palabra oculta</h3>';
                    };
                    ?>
                    <h5><?php echo $this->lang->line('pagina_producto_tab_detalles_titulo'); ?></h5>
                    <?php echo $descripcion_larga; ?>
                  </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="p-3">
                    <div class="row">
                      <div class="col">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th colspan="2"><?php echo $this->lang->line('pagina_producto_tab_detalles_modelo_y_clave'); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?php echo $this->lang->line('pagina_producto_tab_detalles_modelo'); ?></td>
                              <td><?php echo $producto['PRODUCTO_MODELO']; ?> </td>
                            </tr>
                            <tr>
                              <td><?php echo $this->lang->line('pagina_producto_tab_detalles_origen'); ?></td>
                              <td><?php echo $producto['PRODUCTO_ORIGEN']; ?> </td>
                            </tr>
                            <tr>
                              <td>SKU</td>
                              <td><?php echo $producto['PRODUCTO_SKU']; ?> </td>
                            </tr>
                            <tr>
                              <td>UPC</td>
                              <td><?php echo $producto['PRODUCTO_UPC']; ?> </td>
                            </tr>
                            <tr>
                              <td>EAN</td>
                              <td><?php echo $producto['PRODUCTO_EAN']; ?> </td>
                            </tr>
                            <tr>
                              <td>JAN</td>
                              <td><?php echo $producto['PRODUCTO_JAN']; ?> </td>
                            </tr>
                            <tr>
                              <td>ISBN</td>
                              <td><?php echo $producto['PRODUCTO_ISBN']; ?> </td>
                            </tr>
                            <tr>
                              <td>MPN</td>
                              <td><?php echo $producto['PRODUCTO_MPN']; ?> </td>
                            </tr>
                            <tr>
                              <td>EAN</td>
                              <td><?php echo $producto['PRODUCTO_EAN']; ?> </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th colspan="2"><?php echo $this->lang->line('pagina_producto_tab_detalles_dimensiones_y_peso'); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?php echo $this->lang->line('pagina_producto_tab_detalles_ancho'); ?></td>
                              <td><?php echo number_format($producto['PRODUCTO_ANCHO'],2); ?> <small>cm</small> </td>
                            </tr>
                            <tr>
                              <td><?php echo $this->lang->line('pagina_producto_tab_detalles_alto'); ?></td>
                              <td><?php echo number_format($producto['PRODUCTO_ALTO'],2); ?> <small>cm</small> </td>
                            </tr>
                            <tr>
                              <td><?php echo $this->lang->line('pagina_producto_tab_detalles_profundo'); ?></td>
                              <td><?php echo number_format($producto['PRODUCTO_PROFUNDO'],2); ?> <small>cm</small> </td>
                            </tr>
                            <tr>
                              <td><?php echo $this->lang->line('pagina_producto_tab_detalles_peso'); ?></td>
                              <td><?php echo number_format($producto['PRODUCTO_PESO'],2); ?> <small>Kg</small> </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="preguntas" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="p-3">
                    <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                    <form class="" action="<?php echo base_url('producto/contacto'); ?>" method="post">
                      <input type="hidden" name="IdReceptor" value="<?php echo $producto['ID_USUARIO']; ?>">
                      <input type="hidden" name="IdRemitente" value="<?php echo $_SESSION['usuario']['id']; ?>">
                      <input type="hidden" name="ProductoNombre" value="<?php echo $titulo; ?>">
                      <input type="hidden" name="IdProducto" value="<?php echo $producto['ID_PRODUCTO']; ?>">
                      <div class="row">
                        <table class="table">
                          <tr>
                            <td><strong><?php echo $this->lang->line('pagina_producto_tab_preguntas_remitente'); ?>:</strong></td>
                            <td><?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']?></td>
                          </tr>
                        </table>
                      </div>
                      <p> <i class="fa fa-info-circle"></i> <?php echo $this->lang->line('pagina_producto_tab_preguntas_tienes_dudas'); ?></p>
                      <div class="form-group">
                        <label for="MensajeTexto"><?php echo $this->lang->line('pagina_producto_tab_preguntas_mensaje'); ?></label>
                        <textarea class="form-control" name="MensajeTexto" rows="8" required></textarea>
                      </div>
                      <button class="btn <?php echo 'btn'.$primary; ?> float-right"> <span class="fa fa-envelope"></span> <?php echo $this->lang->line('pagina_producto_tab_preguntas_contactar'); ?></button>
                    </form>
                    <span class="clearfix"> </span>
                  <?php }else{ ?>
                    <div class="card">
                      <div class="card-body">
                        <p><?php echo $this->lang->line('pagina_producto_tab_preguntas_para_preguntar'); ?>.</p>
                        <a href="<?php echo base_url('login?url_redirect='.base_url('producto/?id='.$producto['ID_PRODUCTO'])); ?>" class="btn <?php echo 'btn-outline'.$primary; ?> btn-block"> <i class="fa fa-sign-in-alt"></i> <?php echo $this->lang->line('pagina_producto_tab_preguntas_inicia_sesion'); ?></a>
                      </div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
                <div class="tab-pane fade p-3" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                  <div class="row">
                    <div class="col-3">
                        <img src="<?php echo base_url('contenido/img/tiendas/completo/'.$tienda['TIENDA_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                    </div>
                    <div class="col-9">
                      <table class="table table-sm table-borderless">
                        <tr>
                          <td><b><?php echo $this->lang->line('pagina_producto_tab_acerca_de_nombre'); ?></b></td>
                          <td><?php echo $tienda['TIENDA_NOMBRE']; ?></td>
                        </tr>
                        <tr>
                          <td><b><?php echo $this->lang->line('pagina_producto_tab_acerca_de_razon_social'); ?></b></td>
                          <td><?php echo $tienda['TIENDA_RAZON_SOCIAL']; ?></td>
                        </tr>
                        <tr>
                          <td><b><?php echo $this->lang->line('pagina_producto_tab_acerca_de_rfc'); ?></b></td>
                          <td><?php echo $tienda['TIENDA_RFC']; ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Slider productos relacionados -->
          <?php
            $categorias_específicas = [
              $categoria_producto['CATEGORIA_URL']=>'10'
            ];
           ?>

          <div class="fila fila-gris">
            <div class="container-fluid">
              <div class="row">
                <div class="col">
                  <h2 class="car-titulo text-center text-primary pb-3 mb-3"><img alt="" src="<?php echo base_url(); ?>assets/global/img/decor_izq.png" width="25px">Productos Relacionados<img alt="" src="<?php echo base_url(); ?>assets/global/img/decor_der.png" width="25px"></h2>
                  <section class="slider">
                  <div class="flexslider carousel">
                    <ul class="slides">
                      <?php foreach($categorias_específicas as $slug => $limite){ ?>
                        <?php
                        $categoria = $this->CategoriasModel->detalles_slug($slug);
                        $productos = $this->ProductosModel->lista_categoria_activos('',['productos.ID_PRODUCTO !='=>$producto['ID_PRODUCTO']],$categoria['ID_CATEGORIA'],'',$limite);
                        ?>
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
                      <li class="<?php echo $visible; ?>">
                        <div class="cuadricula-productos">
                          <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                          <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>" class="enlace-principal">
                            <div class="imagen-producto">
                              <div class="contenedor-etiquetas">
                                <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                                  <span class="etiqueta-1"><?php echo $this->lang->line('etiquetas_productos_mexico'); ?></span>
                                <?php } ?>
                                <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                                  <span class="etiqueta-3"><?php echo $this->lang->line('etiquetas_productos_oferta'); ?></span>
                                <?php } ?>
                                <?php if($producto->PRODUCTO_ARTESANAL=='si'){ ?>
                                  <span class="etiqueta-artesanal"><img src="<?php echo base_url('assets/global/img/artesanal.png'); ?>"></span>
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
                                <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h3>
                                <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                                  <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_lista,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
                                <?php } ?>
                                <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_venta,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>
                            </div>
                        </div>
            	    		</li>
                      <?php } ?>
                    <?php }// Bucle de categrias específicas ?>
                    </ul>
                  </div>
                </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div> <!-- /container -->
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
