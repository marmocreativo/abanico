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
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <?php $galeria = $this->GaleriasModel->galeria_portada($producto->ID_PRODUCTO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_producto'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_producto'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                      <!-- <a href="<?php echo base_url('tienda-mayoreo/producto/'.$producto->PRODUCTO_URL.'/'.$producto->ID_PRODUCTO); ?>" class="enlace-principal"> -->
                      <div class="row">
                        <div class="col-4">
                          <img src="<?php echo base_url($ruta_portada); ?>" class="img-fluid">
                        </div>
                        <div class="col-8">
                          <h3 class="h6 <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h3>
                          <div class="py-3">
                              <div class="form-group">
                                <label for="" class="sr-only"><?php echo $this->lang->line('pagina_producto_formulario_cantidad'); ?></label>
                                <input type="number" class="form-control" name="CantidadProducto" id='CantidadProducto' min="1" max="<?php echo $producto->PRODUCTO_CANTIDAD; ?>" value="<?php echo $producto->PRODUCTO_CANTIDAD_MINIMA; ?>">
                              </div>
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
                                  data-precio-producto='0'
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
