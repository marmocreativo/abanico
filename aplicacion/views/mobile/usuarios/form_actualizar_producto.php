<!-- empieza panel usuario resposivo -->

<div class="fila-gris">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('mobile/usuarios/widgets/menu_control_usuario'); ?>
      </div>
    </div>
  </div>
</div>

<div class="container py-3 mb-3">
  <div class="row">
    <div class="col-12">

      <div class="card border-bottom-0 mb-3">
        <!-- <div class="card-header">
          <h5 class="pt-2"> <span class="fa fa-box"></span> Actualizar Producto</h5>
        </div> -->
        <div class="card-header d-flex justify-content-between">
           <h5 class="h6 pt-1"> <span class="fa fa-box"></span> Actualizar <small> <?php echo $producto['PRODUCTO_NOMBRE']; ?></small></h5>
           <a href="<?php echo base_url('usuario/productos'); ?>" class="btn mt-1 btn-sm btn-outline-success"> <span class="fa fa-arrow-left"></span></a>
        </div>
      </div>
      <?php retro_alimentacion(); ?>
      <?php if(!empty(validation_errors())){ ?>
        <div class="alert alert-danger">
          <?php echo validation_errors(); ?>
        </div>
        <hr>
      <?php } ?>
      <div class="card border-0 mb-3">

          <form class="" action="<?php echo base_url('usuario/productos/actualizar'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="TipoProducto" value="<?php echo $tipo_producto; ?>">
            <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
            <input type="hidden" name="IdTienda" value="<?php echo $tienda['ID_TIENDA']; ?>">
            <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="UrlProducto" value="<?php echo $producto['PRODUCTO_URL']; ?>">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                       <span class="fa fa-list"></span> Datos Básicos
                    </button>
                  </h2>
                </div>

                <div id="collapseOne" class="" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">

                    <div class="form-group">
                      <label for="EstadoProducto">Estado del Producto</label>
                      <select class="form-control" id="" name="" placeholder="">
                        <option value="activo" <?php if($producto['PRODUCTO_ESTADO']=='activo'){ echo 'selected';} ?>>Publicado</option>
                        <option value="inactivo" <?php if($producto['PRODUCTO_ESTADO']=='inactivo'){ echo 'selected';} ?>>Borrador</option>
                      </select>
                    </div>

                    <hr>

                    <div class="border border-primary p-2">
                      <h6 class="border-bottom pb-2"> <i class="fa fa-tag"></i> Información Básica Obligatoria</h6>
                      <div class="form-group">
                        <label for="NombreProducto">Nombre del producto</label>
                        <input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="<?php echo $producto['PRODUCTO_NOMBRE']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="PrecioProducto">Precio de Venta</label>
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                        <input type="text" class="form-control" id="PrecioProducto" name="PrecioProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PRECIO']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="PrecioListaProducto">Precio de Lista</label>
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                        <input type="text" class="form-control" id="PrecioListaProducto" name="PrecioListaProducto" placeholder="" value="<?php echo $producto['PRODUCTO_PRECIO_LISTA']; ?>">
                        </div>
                        <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Este es el precio Tachado que aparecerá en la lista de productos</small>
                      </div>
                      <div class="form-group">
                        <label for="CantidadProducto">Cantidad disponibles</label>
                        <input type="number" class="form-control" id="CantidadProducto" required name="CantidadProducto" placeholder="" min="1" value="<?php echo $producto['PRODUCTO_CANTIDAD']; ?>">
                      </div>
                      <h6 class="border-bottom pb-2"> <i class="fa fa-clipboard-list"></i> Cantidades</h6>
                      <div class="form-group">
                        <label for="ModeloProducto">Modelo</label>
                        <input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" value="<?php echo $producto['PRODUCTO_MODELO']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="SkuProducto">SKU (Clave de Inventario)</label>
                        <input type="text" class="form-control" id="SkuProducto" name="SkuProducto" placeholder="" value="<?php echo $producto['PRODUCTO_SKU']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="CantidadMinimaProducto">Venta mínima</label>
                        <input type="number" class="form-control" id="CantidadMinimaProducto" required name="CantidadMinimaProducto" placeholder="" min="1" value="<?php echo $producto['PRODUCTO_CANTIDAD_MINIMA']; ?>">
                      </div>
                      <h6 class="border-bottom pb-2"> <i class="fa fa-cube"></i> Dimensiones</h6>
                      <div class="form-group">
                        <label for="AnchoProducto">Ancho</label>
                        <div class="input-group input-group-sm mb-2">
                          <input type="text" class="form-control" id="AnchoProducto" name="AnchoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_ANCHO']; ?>">
                          <div class="input-group-append">
                            <div class="input-group-text">cm</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="AltoProducto">Alto</label>
                        <div class="input-group input-group-sm mb-2">
                          <input type="text" class="form-control" id="AltoProducto" name="AltoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_ALTO']; ?>">
                          <div class="input-group-append">
                            <div class="input-group-text">cm</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="ProfundoProducto">Profundo</label>
                        <div class="input-group input-group-sm mb-2">
                        <input type="text" class="form-control" id="ProfundoProducto" name="ProfundoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PROFUNDO']; ?>">
                          <div class="input-group-append">
                            <div class="input-group-text">cm</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="PesoProducto">Peso</label>
                        <div class="input-group input-group-sm mb-2">
                        <input type="text" class="form-control" id="PesoProducto" name="PesoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PESO']; ?>">
                          <div class="input-group-append">
                            <div class="input-group-text">Kg</div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                       <span class="fa fa-list"></span> Categorias
                    </button>
                  </h2>
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                    <?php $i=1; foreach($categorias as $categoria){ ?>
                  <h6 class="mb-3"><?php echo $categoria->CATEGORIA_NOMBRE; ?></h6>
                  <?php $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
                    <?php foreach($segundo_categorias as $segunda_categoria){ ?>
                    <h6 class="border-bottom pb-3"><?php echo $segunda_categoria->CATEGORIA_NOMBRE; ?></h6>
                    <?php $tercero_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'',''); ?>
                      <ul class="list list-unstyled">
                        <?php foreach($tercero_categorias as $tercera_categoria){ ?>
                        <li>
                          <div class="custom-control custom-radio">
                            <input  type="radio"
                                    id="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
                                    name="CategoriaProducto" class="custom-control-input"
                                    value="<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
                                    <?php if($relacion_categorias['ID_CATEGORIA']==$tercera_categoria->ID_CATEGORIA){ echo 'checked'; } ?>

                                    >
                            <label class="custom-control-label" for="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>">-<?php echo $tercera_categoria->CATEGORIA_NOMBRE; ?></label>
                          </div>
                        </li>
                      <?php } // Termina Bucle tercera categoria ?>
                      </ul>
                    <?php } // Termina Bucle segunda categoria ?>
                  <?php }// Termina bucle primer categoria ?>

                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingThree">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                       <span class="fa fa-file-alt"></span> Descripción
                    </button>
                  </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="card-body">

                    <div class="form-group">
                      <label for="DescripcionProducto">Descripción corta</label>
                      <textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control" rows="3"><?php echo $producto['PRODUCTO_DESCRIPCION']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="DetallesProducto">Detalles del producto</label>
                      <textarea id="DetallesProducto" name="DetallesProducto" class="form-control Editor" rows="5"><?php echo $producto['PRODUCTO_DETALLES']; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="">Origen</label>
                      <select class="form-control form-control-sm" name="OrigenProducto" id="OrigenProducto">
                        <option value="México" <?php if($producto['PRODUCTO_ORIGEN']=='México'){ echo 'selected';} ?>>México</option>
                        <option value="Otro" <?php if($producto['PRODUCTO_ORIGEN']=='Otro'){ echo 'selected';} ?>>Otro</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="">UPC</label>
                      <input type="text" class="form-control form-control-sm" id="UpcProducto" name="UpcProducto" placeholder="" value="<?php echo $producto['PRODUCTO_UPC']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="">EAN</label>
                      <input type="text" class="form-control form-control-sm" id="EanProducto" name="EanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_EAN']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="">JAN</label>
                      <input type="text" class="form-control form-control-sm" id="JanProducto" name="JanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_JAN']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="">ISBN</label>
                      <input type="text" class="form-control form-control-sm" id="IsbnProducto" name="IsbnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_ISBN']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="">MPN</label>
                      <input type="text" class="form-control form-control-sm" id="MpnProducto" name="MpnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_MPN']; ?>">
                    </div>

                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingFour">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <span class="fa fa-image"></span> Galeria
                    </button>
                  </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                  <div class="card-body">

                    <div class="custom-file file-sm mb-3">
                      <input type="file" class="custom-file-input" id="" name="" placeholder="" value="">
                      <label class="custom-file-label" for="">Añadir Imagen</label>
                    </div>
                    <?php foreach($galerias as $galeria){ ?>
                    <div class="mb-2">
                      <div class="row">
                        <div class="col">
                          <img class="mb-3" src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO) ?>" alt="" width="50">
                          <?php if($galeria->GALERIA_PORTADA=='si'){ ?>
                            <a href="<?php echo base_url('usuario/productos/portada')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                          <?php }else{ ?>
                            <a href="<?php echo base_url('usuario/productos/portada')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                          <?php } ?>
                        </div>
                        <div class="col">
                          <div class="btn-group float-right mb-3">
                            <button data-enlace="<?php echo base_url('usuario/productos/borrar_galeria')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-sm mt-3 btn-primary float-right"> <span class="fa fa-save"></span> Actualizar Producto</button>
          </form>
          <hr>
          <a href="<?php echo base_url('usuario/productos_combinaciones?id='.$_GET['id']); ?>" class="btn btn-sm mt-3 btn-primary"><span class="fa fa-sitemap"></span> Combinaciones</a>

      </div>

    </div>
  </div>
</div>
