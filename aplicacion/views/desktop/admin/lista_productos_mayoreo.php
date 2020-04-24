<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
  <div class="kt-container kt-body kt-grid kt-grid--ver" id="kt_body">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

      <!-- begin:: Subheader -->
      <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
        </div>
        <div class="kt-subheader__toolbar">
        </div>
      </div>

      <!-- end:: Subheader -->

      <!-- begin:: Content -->
      <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--Begin::Dashboard 8-->

        <!--Begin::Section-->
        <div class="row mb-3">
          <div class="col-xl-12">

            <!--begin:: Widgets/Trends-->
            <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
              <div class="kt-portlet__body">
<?php if(isset($_GET['id_usuario'])){ ?>
  <div class="row">
    <div class="col-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-four">
              <div class="stat-icon dib">
                  <i class="fa fa-user-tag text-muted"></i>
              </div>
              <div class="stat-content">
                  <div class="text-left dib">
                      <div class="stat-heading">Usuario</div>
                      <div class="stat-text"><?php echo $usuario['USUARIO_NOMBRE'].' '.$usuario['USUARIO_APELLIDOS']; ?></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
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
                            <p>Disponibles: <span class="cantidad_maxima_visible" data-id-producto='<?php echo $producto->ID_PRODUCTO; ?>'><?php echo $producto->PRODUCTO_CANTIDAD; ?></span></p>
                          </div>
                          <div class="col-12 mt-2">
                            <?php if($producto->PRODUCTO_CANTIDAD>0){ ?>
                            <div class="row">
                              <div class="col-12">
                                <?php $combinaciones = $this->GeneralModel->lista('productos_combinaciones','',['ID_PRODUCTO'=>$producto->ID_PRODUCTO,'COMBINACION_MOSTRAR_MAYOREO'=>'si'],'ORDEN ASC','',''); ?>
                                <?php if(!empty($combinaciones)){?>
                                <div class="form-group">
                                  <label for="CombinacionProducto" class="sr-only"><?php echo $this->lang->line('pagina_producto_formulario_opciones'); ?></label>
                                  <select class="form-control CombinacionProducto" name="CombinacionProducto">
                                  <?php foreach($combinaciones as $combinacion){?>
                                    <option value="<?php echo  $combinacion->COMBINACION_OPCION; ?>"
                                      data-id-producto='<?php echo $combinacion->ID_PRODUCTO; ?>'
                                      data-id-combinacion='<?php echo $combinacion->ID_COMBINACION; ?>'
                                      data-precio-producto='<?php echo $combinacion->COMBINACION_PRECIO_MAYOREO; ?>'
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
                                <?php } ?>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                  <label for="" class="sr-only"><?php echo $this->lang->line('pagina_producto_formulario_cantidad'); ?></label>
                                  <input type="number" class="form-control cantidad_producto" data-id-producto='<?php echo $producto->ID_PRODUCTO; ?>' min="1" max="<?php echo $producto->PRODUCTO_CANTIDAD; ?>" value="1">
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
                          <?php }else{ ?>
                            <p>Por el momento no hay existencias.</p>
                          <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              <?php } ?>
          </div>
          <div class="row bg-light py-3 mt-4">
            <div class="col mt-4">
              CARRITO
              <div class="CargarCarritoMayoreo">

              </div>
            </div>
            <div class="col-4">
              <form class="" action="<?php echo base_url('admin/pedidos/crear_pedido_mayoreo'); ?>" method="post">
                <div class="row">
                  <div class="col-12">
                      <div class="form-group">
                        <label for="Comprador">¿Quién compra?</label>
                        <select class="form-control Comprador" name="Comprador">
                          <option value="nueva">Nuevo Cliente</option>
                          <optgroup label="Negocios registrados">
                          <?php foreach($empresas as $empresa){ ?>
                            <option value="<?php echo $empresa->ID; ?>"><?php echo $empresa->EMPRESA_NOMBRE.' '.$empresa->RFC; ?></option>
                          <?php } ?>
                          </optgroup>
                        </select>
                      </div>
                      <div id="colapsar_form_empresa">
                        <div class="form-group">
                          <label for="NombreEmpresa">Nombre del negocio</label>
                          <input type="text" class="form-control" name="NombreEmpresa" value="" required>
                        </div>
                        <div class="form-group">
                          <label for="NombreContacto">Nombre del cliente<small> Persona de contacto </small></label>
                          <input type="text" class="form-control" name="NombreContacto" value="">
                        </div>
                        <div class="form-group">
                          <label for="CorreoContacto">Correo <small> Persona de contacto </small></label>
                          <input type="text" class="form-control" name="CorreoContacto" value="">
                        </div>
                        <div class="form-group">
                          <label for="TelefonoContacto">Teléfono <small> Persona de contacto </small></label>
                          <input type="text" class="form-control" name="TelefonoContacto" value="">
                        </div>
                        <div class="form-group">
                          <label for="DireccionEmpresa">Dirección donde se deja el producto</label>
                          <textarea name="DireccionEmpresa" class="form-control" rows="5"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Factura">¿Va a requerir factura?</label>
                        <select class="form-control" name="Factura">
                          <option value="no">No requiere factura</option>
                          <option value="si">Si requiere factura</option>
                        </select>
                      </div>
                  </div>
                  <div class="col-12 mb-3">
                    <div class="form-group">
                      <label for="DejasProducto">¿Dejas los producto en este momento?</label>
                      <select class="form-control" id="DejasProducto" name="DejasProducto">
                        <option value="si">Si</option>
                        <option value="no">No, Se entregará después</option>
                      </select>
                    </div>
                    <!-- Espacio para fecha -->
                    <div id="fecha_entrega" class="collapse">
                      <div class="form-group">
                        <label for="FechaEntrega">Dia</label>
                        <input type="date" name="FechaEntrega" class="form-control" value="">
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <p>Hora</p>
                        </div>
                        <div class="col pr-1">
                          <div class="form-group">
                            <select class="form-control" name="Hora">
                              <?php for($i=1; $i<=12; $i++){?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col p-1">
                          <div class="form-group">
                            <select class="form-control" name="Minutos">
                              <?php for($i=0; $i<=59; $i+=5){?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col pl-1">
                          <div class="form-group">
                            <select class="form-control" name="AmPm">
                              <option value="am">AM</option>
                              <option value="pm">PM</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Espacio para fecha -->
                    <div class="form-group">
                      <label for="PagarAhora">¿Te pagarán en este momento?</label>
                      <select class="form-control" name="PagarAhora">
                        <option value="si_efectivo">Si, en efectivo</option>
                        <option value="no_contra_entrega">No, pagarán al recibir los productos</option>
                        <option value="no_comision">No, se quedan a comisión</option>
                      </select>
                    </div>
                    <!--
                    <label for="">Firma de confirmación:</label>
                    <canvas style="border: solid 1px #000; min-width:300px; max-width:1600px;"></canvas>
                  -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block text-white"> <i class="fa fa-check"></i> Confirmar </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
    </div>
  </div>
</div>
</div>

<!--end:: Widgets/Trends-->
</div>
</div>
<!--End::Section-->

<!--End::Dashboard 8-->
</div>

<!-- end:: Content -->
</div>
</div>
</div>
