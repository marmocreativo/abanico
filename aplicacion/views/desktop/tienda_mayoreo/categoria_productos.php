<div class="contenido_principal fila p-3" style="background:#eee;">
  <div class="container">
    <div class="row">
      <div class="col text-center py-4">
        <h3>Productos Disponibles</h3>
      </div>
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
                <div class="col-12 col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                      <!-- <a href="<?php echo base_url('tienda-mayoreo/producto/'.$producto->PRODUCTO_URL.'/'.$producto->ID_PRODUCTO); ?>" class="enlace-principal"> -->
                      <div class="row">
                        <div class="col-4">
                          <img src="<?php echo base_url($ruta_portada); ?>" class="img-fluid imagen_producto" data-id-producto='<?php echo $producto->ID_PRODUCTO; ?>'>
                        </div>
                        <div class="col-8">
                          <h3 class="h6 <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h3>
                        </div>
                        <div class="col-12 mt-2">
                          <div class="row">
                            <div class="col-12">
                              <?php $combinaciones = $this->GeneralModel->lista('productos_combinaciones','',['ID_PRODUCTO'=>$producto->ID_PRODUCTO],'ORDEN ASC','',''); ?>
                              <div class="form-group">
                                <label for="CombinacionProducto" class="sr-only"><?php echo $this->lang->line('pagina_producto_formulario_opciones'); ?></label>
                                <select class="form-control CombinacionProducto" name="CombinacionProducto">
                                <?php foreach($combinaciones as $combinacion){?>
                                  <option value="<?php echo  $combinacion->COMBINACION_OPCION; ?>"
                                    data-id-producto='<?php echo $combinacion->ID_PRODUCTO; ?>'
                                    data-id-combinacion='<?php echo $combinacion->ID_COMBINACION; ?>'
                                    data-precio-producto='<?php echo $combinacion->COMBINACION_PRECIO; ?>'
                                    data-peso-producto='<?php echo $combinacion->COMBINACION_PESO; ?>'
                                    data-imagen-producto='<?php echo $combinacion->COMBINACION_IMAGEN; ?>'
                                    data-cantidad-max='<?php echo $combinacion->COMBINACION_CANTIDAD; ?>'
                                    data-precio-visible-producto='<?php echo number_format($combinacion->COMBINACION_PRECIO_MAYOREO,2); ?>'
                                    data-detalles-producto='<?php echo $combinacion->COMBINACION_GRUPO.'-'.$combinacion->COMBINACION_OPCION; ?>'
                                    <?php if($combinacion->COMBINACION_CANTIDAD==0){ echo 'disabled'; } ?>
                                    ><?php echo $combinacion->COMBINACION_GRUPO.'-'.$combinacion->COMBINACION_OPCION; ?> <?php if($combinacion->COMBINACION_CANTIDAD==0){ echo '- Agotado'; } ?></option>
                                <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group">
                                <label for="" class="sr-only"><?php echo $this->lang->line('pagina_producto_formulario_cantidad'); ?></label>
                                <input type="number" class="form-control cantidad_producto" data-id-producto='<?php echo $producto->ID_PRODUCTO; ?>' min="1" max="<?php echo $producto->PRODUCTO_CANTIDAD; ?>" value="<?php echo $producto->PRODUCTO_CANTIDAD_MINIMA; ?>">
                              </div>
                            </div>
                            <div class="col-6">
                              <button class="btn btn-success btn- btn-block BotonEnLista"
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
                                  data-precio-producto='<?php echo $producto->PRODUCTO_PRECIO_MAYOREO; ?>'
                                  data-id-tienda='1'
                                  data-nombre-tienda='Abanico Mayoreo'
                                  >
                                 <i class="fa fa-plus"></i>  <span class="fa fa-shopping-cart"></span> </button>
                            </div>
                          </div>
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
<!-- Modal de flujos -->
