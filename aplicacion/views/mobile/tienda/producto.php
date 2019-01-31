<div class="bxInfoContent bxDetalle pb-4">
  <div class="container">
    <div class="row">

      <div class="slideBxProducto mb-4">
        <ul class="slides">
          <?php foreach($galerias as $galeria){ ?>
          <li>
              <?php $ruta_galeria = $op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO; ?>
            <img src="<?php echo base_url($ruta_galeria) ?>" alt="">
          </li>
          <?php } ?>
        </ul>
      </div>

      <div class="col-12 mb-4">
        <p class="text-muted"><small>1Disponibles</small></p>
        <h4 class="product-title mb-2">JABON</h4>
        <hr>
        <?php echo $producto['PRODUCTO_DESCRIPCION']; ?>
        <hr>
        <?php if(!empty($producto['PRODUCTO_PRECIO_LISTA'])&&$producto['PRODUCTO_PRECIO_LISTA']>$producto['PRODUCTO_PRECIO']){ ?>
        <h3 class="product-price-descuento h6"><small><?php echo $_SESSION['divisa']['signo']; ?></small> <?php echo number_format($_SESSION['divisa']['conversion']*$producto['PRODUCTO_PRECIO_LISTA'],2); ?> <small><?php echo $_SESSION['divisa']['iso']; ?> </small></h3>
        <?php } ?>
        <h2 class="product-price display-6" >
          <small><?php echo $_SESSION['divisa']['signo']; ?></small>
            <span id="Precio_Producto" ><?php echo number_format($_SESSION['divisa']['conversion']*$producto['PRODUCTO_PRECIO'],2); ?></span>
          <small><?php echo $_SESSION['divisa']['iso']; ?> </small>
        </h2>
        <hr>
        <div class="row">
          <?php if(!empty($combinaciones)){ ?>
          <div class="col-12">
            <div class="form-group">
              <label for="CombinacionProducto" class="sr-only">Opciones</label>
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
              <label for="" class="sr-only">Cantidad</label>
              <input type="number" class="form-control" name="CantidadProducto" id="CantidadProducto" min="1" max="<?php echo $producto['PRODUCTO_CANTIDAD']; ?>" value="<?php echo $producto['PRODUCTO_CANTIDAD_MINIMA']; ?>">
            </div>
          </div>
          <div class="col">
            <button class="btn <?php echo 'btn-outline'.$primary; ?> btn- btn-block" id="BotonComprar"
                data-id-producto='<?php echo $producto['ID_PRODUCTO']; ?>'
                data-nombre-producto='<?php echo $producto['PRODUCTO_NOMBRE']; ?>'
                data-imagen-producto='<?php echo base_url($ruta_portada) ?>'
                data-peso-producto='<?php echo $producto['PRODUCTO_PESO']; ?>'
                data-detalles-producto=''
                data-precio-producto='<?php echo $producto['PRODUCTO_PRECIO']; ?>'
                data-id-tienda='<?php echo $tienda['ID_TIENDA']; ?>'
                data-nombre-tienda='<?php echo $tienda['TIENDA_NOMBRE']; ?>'
                >
               <span class="fa fa-shopping-cart"></span> Añadir al Carrito</button>
          </div>
          <?php if(isset($_SESSION['usuario']['id'])){ ?>
            <div class="col-12">
              <hr>
              <button class="btn <?php echo 'btn'.$primary; ?> btn- btn-block" id="BotonCompraRapida"
                  data-id-producto='<?php echo $producto['ID_PRODUCTO']; ?>'
                  data-nombre-producto='<?php echo $producto['PRODUCTO_NOMBRE']; ?>'
                  data-imagen-producto='<?php echo base_url($ruta_portada) ?>'
                  data-peso-producto='<?php echo $producto['PRODUCTO_PESO']; ?>'
                  data-detalles-producto=''
                  data-precio-producto='<?php echo $producto['PRODUCTO_PRECIO']; ?>'
                  data-id-tienda='<?php echo $tienda['ID_TIENDA']; ?>'
                  data-nombre-tienda='<?php echo $tienda['TIENDA_NOMBRE']; ?>'
                  >
                 <span class="fa fa-shopping-cart"></span> Comprar Ahora</button>
            </div>
          <?php } ?>
        </div>
      </div>

      <div class="col-12">
        <div class="accordion mb-4" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Detalles
                </button>
              </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Características
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">

                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th colspan="2">Modelo y Claves</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Modelo</td>
                        <td>ROMA </td>
                      </tr>
                      <tr>
                        <td>Origen</td>
                        <td>México </td>
                      </tr>
                      <tr>
                        <td>SKU</td>
                        <td>ROM </td>
                      </tr>
                      <tr>
                        <td>UPC</td>
                        <td>    </td>
                      </tr>
                      <tr>
                        <td>EAN</td>
                        <td>    </td>
                      </tr>
                      <tr>
                        <td>JAN</td>
                        <td>    </td>
                      </tr>
                      <tr>
                        <td>ISBN</td>
                        <td>    </td>
                      </tr>
                      <tr>
                        <td>MPN</td>
                        <td>    </td>
                      </tr>
                      <tr>
                        <td>EAN</td>
                        <td>    </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th colspan="2">Dimensiones y Peso</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Ancho</td>
                        <td>30.00 <small>cm</small> </td>
                      </tr>
                      <tr>
                        <td>Alto</td>
                        <td>25.00 <small>cm</small> </td>
                      </tr>
                      <tr>
                        <td>Profundo</td>
                        <td>15.00 <small>cm</small> </td>
                      </tr>
                      <tr>
                        <td>Peso</td>
                        <td>20.00 <small>Kg</small> </td>
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
                  Preguntas
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">

                <p>Para preguntar debes Iniciar Sesión.</p>
                <a href="http://localhost/abanico-master/login?url_redirect=http://localhost/abanico-master/producto/?id=8" class="btn btn-sm btn-outline-primary-3 btn-block"> <i class="fa fa-sign-in-alt"></i> Inicia Sesión</a>

              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingFour">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Acerca del Vendedor
                </button>
              </h2>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
              <div class="card-body">

                <img src="http://localhost/abanico-master/contenido/img/tiendas/completo/tienda-5c1e6ac549a93.jpg" alt="" style="width:100px; height:100px" class="mb-3 m d-block img-thumbnail mx-auto rounded-circle">

                <table class="table table-sm table-borderless">
                  <tbody><tr>
                    <td><b>Nombre Público</b></td>
                    <td>Espejo Negro</td>
                  </tr>
                  <tr>
                    <td><b>Razón Social</b></td>
                    <td>Espejo Negro SA de CV</td>
                  </tr>
                  <tr>
                    <td><b>R.F.C.</b></td>
                    <td>ESNE34565677</td>
                  </tr>
                  <tr>
                    <td><b>Teléfono</b></td>
                    <td>26032335</td>
                  </tr>
                  <tr>
                    <td><b>Registro</b><br>2018-12-05 08:05:30</td>
                    <td><b>Actualización</b><br>2019-01-06 16:02:39</td>
                  </tr>
                </tbody></table>
                <hr>
                <h6>Dirección Fiscal</h6>
                <p>Avenida 561 No. 148, San Juan de Aragón II, Gustavo A. Madero, Ciudad de México, Ciudad de México, 07969, México</p>

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
                  <p>Para calificar este producto.</p>
                  <a href="http://localhost/abanico-master/login?url_redirect=http://localhost/abanico-master/producto/?id=8" class="btn btn-sm btn-outline-primary-3 btn-block"> <i class="fa fa-sign-in-alt"></i> Inicia Sesión</a>
                </div>
           </div>

          <ul class="list-unstyled">
            <?php if(!empty($mi_calificacion)){ ?>
              <li class="media py-3">
                <img class="mr-3 img-thumbnail rounded-circle" src="http://localhost/abanico-master/assets/global/img/usuario_default.png" alt="" width="64">
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
