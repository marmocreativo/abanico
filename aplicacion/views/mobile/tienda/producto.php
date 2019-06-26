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
<div class="bxInfoContent bxDetalle pb-4">
  <div class="container">
    <div class="row">

      <div class="slideBxProducto mb-4">
        <ul class="slides">
          <?php if(empty($portada)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$portada['GALERIA_ARCHIVO']; } ?>
          <?php foreach($galerias as $galeria){ ?>
          <li>
              <?php $ruta_galeria = $op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO; ?>
            <img src="<?php echo base_url($ruta_galeria) ?>" alt="">
          </li>
          <?php } ?>
        </ul>
      </div>

      <div class="col-12 mb-4">
        <p class="text-muted"><small><?php echo $producto['PRODUCTO_CANTIDAD']; ?> disponibles</small></p>
        <h4 class="product-title mb-2"><?php echo $titulo; ?></h4>
        <hr>
        <?php echo $descripcion_corta; ?>
        <hr>
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
        <h3 class="product-price-descuento h6"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_lista,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></h3>
        <?php } ?>
        <h2 class="product-price display-6" >
          <small><?php echo $_SESSION['divisa']['signo']; ?></small>
            <span id="Precio_Producto" ><?php echo number_format($precio_venta,2); ?></span>
          <small><?php echo $_SESSION['divisa']['iso']; ?> </small>
        </h2>
        <hr>
        <div class="row">
          <?php if(!empty($combinaciones)){ ?>
          <div class="col-12">
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
              <input type="number" class="form-control" name="CantidadProducto" id="CantidadProducto" min="1" max="<?php echo $producto['PRODUCTO_CANTIDAD']; ?>" value="<?php echo $producto['PRODUCTO_CANTIDAD_MINIMA']; ?>">
            </div>
          </div>
          <div class="col">
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
      </div>

      <div class="col-12">
        <div class="accordion mb-4" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <?php echo $this->lang->line('pagina_producto_tabs_producto_detalles'); ?>
                </button>
              </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <?php echo $descripcion_larga; ?>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <?php echo $this->lang->line('pagina_producto_tabs_producto_caracteristicas'); ?>
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">

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
                <div class="col-12">
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

          <div class="card">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <?php echo $this->lang->line('pagina_producto_tabs_producto_preguntas'); ?>
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
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
                    <a href="<?php echo base_url('login?url_redirect='.base_url('producto/?id='.$producto['ID_PRODUCTO'])); ?>" class="btn <?php echo 'btn-outline'.$primary; ?> btn-block"> <i class="fa fa-sign-in-alt"></i> Inicia Sesión</a>
                  </div>
                </div>
              <?php } ?>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingFour">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  <?php echo $this->lang->line('pagina_producto_tabs_producto_acerca_de'); ?>
                </button>
              </h2>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
              <div class="card-body">

                <img src="<?php echo base_url('contenido/img/tiendas/completo/'.$tienda['TIENDA_IMAGEN']) ?>" alt="" style="width:100px; height:100px" class="mb-3 m d-block img-thumbnail mx-auto rounded-circle">

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

      <div class="col-12 mb-4">

        <div class="mb-4">
          <?php $promedio_calificaciones = $promedio_calificaciones['CALIFICACION_ESTRELLAS']; $estrellas_restan= 5-$promedio_calificaciones; ?>
          <h5 class="mb-3">
            <?php for($i = 1; $i<=$promedio_calificaciones; $i++){ ?>
              <span class="fa fa-star <?php echo 'text'.$primary; ?>"></span>
            <?php } ?>
            <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
              <span class="far fa-star <?php echo 'text'.$primary; ?>"></span>
            <?php } ?>
          </h5>

          <?php $e = 5; foreach($estrellas as $estrella){ ?>
        <?php $restan = 5-$e; ?>
        <?php if($cantidad_calificaciones!=0){ $porcentaje = ($estrella*100)/$cantidad_calificaciones; }else{ $porcentaje=0; }?>
          <div class="row">
            <div class="col-5">
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

        </div>

           <div class="card mb-4">
              <div class="card-body">
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
                      <a href="<?php echo base_url('login?url_redirect='.base_url('producto/?id='.$producto['ID_PRODUCTO'])); ?>" class="btn <?php echo 'btn-outline'.$primary; ?> btn-block"> <i class="fa fa-sign-in-alt"></i> Inicia Sesión</a>
                    </div>
                  </div>
                <?php } ?>
              </div>
           </div>

          <ul class="list-unstyled">
            <?php foreach($calificaciones as $calificacion){ ?>
              <li class="media py-3">
                <img class="mr-3 img-thumbnail rounded-circle" src="http://localhost/abanico-master/assets/global/img/usuario_default.png" alt="" width="64">
                <div class="media-body">
                   <h5 class="mt-0 mb-1"><?php echo $calificacion->USUARIO_NOMBRE.' '.$calificacion->USUARIO_APELLIDOS; ?></h5>
                   <div class="d-flex border-top border-bottom py-3">
                     <?php $estrellas = $calificacion->CALIFICACION_ESTRELLAS; $estrellas_restan= 5-$estrellas; ?>
                     <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                       <i class="fa fa-star"></i>
                     <?php } ?>
                     <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                       <i class="far fa-star"></i>
                     <?php } ?>
                   </div>
                      <p><?php echo $calificacion->CALIFICACION_COMENTARIO; ?></p>
                </div>
             </li>
             <?php } ?>
          </ul>
      </div>

    </div>
  </div>
</div>
<?php
  $categorias_específicas = [
    $categoria_producto['CATEGORIA_URL']=>'10'
  ];
 ?>
 <div class="fila fila-gris py-4 pb-5">
   <div class="container">
     <div class="row">
       <div class="col-12">
         <h2 class="h4 text-center pb-3">Productos relacionados</h2>
       </div>
     </div>
   </div>
    <div class="sliderProductos">
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
        <li>
          <div class="card">
            <a href="<?php echo base_url('producto?id='.$producto->ID_PRODUCTO); ?>">
              <div class="imagen-producto">
                <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                <img class="spanImg" src="<?php echo base_url($ruta_portada); ?>"></img>
                <div class="contenedor-etiquetas">
                  <?php if($producto->PRODUCTO_ORIGEN=='México'){ ?>
                    <span class="etiqueta-1">Méx</span>
                  <?php } ?>
                  <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                    <span class="etiqueta-3">Oferta</span>
                  <?php } ?>
                </div>
              </div>
              <div class="product-content text-center py-3">
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
                <h4 class="title <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h4>
                <?php if(!empty($producto->PRODUCTO_PRECIO_LISTA)&&$producto->PRODUCTO_PRECIO<$producto->PRODUCTO_PRECIO_LISTA){ ?>
                  <div class="price-list"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_lista,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small> </div>
                <?php } ?>
                <div class="price"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($precio_venta,2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></div>
              </div>
            </a>
            <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
            <a href="<?php echo base_url('producto/favorito?id='.$producto->ID_PRODUCTO); ?>" class="btnFavorito" title="Añadir a Favoritos"> <span class="far fa-heart text-primary-6"></span> </a>
            <?php }else{ ?>
              <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$producto->ID_PRODUCTO)); ?>" class="btnFavorito" title="Añadir a Favoritos"> <span class="far fa-heart text-primary-6"></span> </a>
            <?php } ?>
          </div>
        </li>
        <?php } ?>
      <?php }// Bucle de categoria ?>
      </ul>
    </div>
 </div>
