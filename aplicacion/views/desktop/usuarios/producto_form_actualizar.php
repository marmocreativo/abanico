<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col-sm-6 col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="float-left"> <span class="fa fa-boxes"></span> Formulario de Prodcutos</h5>
              </div>
              <div class="card-body">
                <form class="" action="<?php echo base_url('usuario/crear_producto'); ?>" method="post">
                  <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="true">Datos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="extras-tab" data-toggle="tab" href="#extras" role="tab" aria-controls="extras" aria-selected="false">Extras</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="imagenes-tab" data-toggle="tab" href="#imagenes" role="tab" aria-controls="imagenes" aria-selected="false">Imágenes</a>
                </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active pt-3" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                    <h5>Datos Generales</h5>
                    <div class="form-group">
                      <label for="NombreProducto">Nombre</label>
                      <input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="<?php echo $producto['PRODUCTO_NOMBRE']; ?>">
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="ModeloProducto">Modelo</label>
                          <input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" required value="<?php echo $producto['PRODUCTO_MODELO']; ?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="OrigenProducto">Origen</label>
                          <select class="form-control" name="OrigenProducto" id="OrigenProducto">
                            <option value="México" <?php if($producto['PRODUCTO_ORIGEN']=='México'){ echo "selected"; }?>>México</option>
                            <option value="Otro" <?php if($producto['PRODUCTO_ORIGEN']=='Otro'){ echo "selected"; }?>>Otro</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="DescripcionProducto">Descripción corta</label>
                      <textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control" rows="5"><?php echo $producto['PRODUCTO_DESCRIPCION']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="DetallesProducto">Detalles del producto</label>
                      <textarea id="DetallesProducto" name="DetallesProducto" class="form-control Editor" rows="5"><?php echo $producto['PRODUCTO_DETALLES']; ?></textarea>
                    </div>
                    <hr>
                    <h5>Datos de Inventario</h5>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="PrecioProducto">Precio Unitario</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">$</div>
                            </div>
                          <input type="text" class="form-control" id="PrecioProducto" name="PrecioProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PRECIO']; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="SkuProducto">SKU (Clave de Inventario)</label>
                          <input type="text" class="form-control" id="SkuProducto" name="SkuProducto" placeholder="" value="<?php echo $producto['PRODUCTO_SKU']; ?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="CantidadProducto">Cantidad Disponibles para venta</label>
                          <input type="number" class="form-control" id="CantidadProducto" required name="CantidadProducto" placeholder="" min="1" value="<?php echo $producto['PRODUCTO_CANTIDAD']; ?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="CantidadMinimaProducto">Cantidad Mínima para venta</label>
                          <input type="number" class="form-control" id="CantidadMinimaProducto" required name="CantidadMinimaProducto" placeholder="" min="1" value="<?php echo $producto['PRODUCTO_CANTIDAD_MINIMA']; ?>">
                        </div>
                      </div>
                    </div>
                    <hr>
                    <h5>Datos para envío</h5>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="AnchoProducto">Ancho</label>
                          <div class="input-group mb-2">
                            <input type="text" class="form-control" id="AnchoProducto" name="AnchoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_ANCHO']; ?>">
                            <div class="input-group-append">
                              <div class="input-group-text">cm</div>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="AltoProducto">Alto</label>
                          <div class="input-group mb-2">
                            <input type="text" class="form-control" id="AltoProducto" name="AltoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_ALTO']; ?>">
                            <div class="input-group-append">
                              <div class="input-group-text">cm</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="ProfundoProducto">Profundo</label>
                          <div class="input-group mb-2">
                          <input type="text" class="form-control" id="ProfundoProducto" name="ProfundoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PROFUNDO']; ?>">
                            <div class="input-group-append">
                              <div class="input-group-text">cm</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="PesoProducto">Peso</label>
                          <div class="input-group mb-2">
                          <input type="text" class="form-control" id="PesoProducto" name="PesoProducto" required placeholder="" value="<?php echo $producto['PRODUCTO_PESO']; ?>">
                            <div class="input-group-append">
                              <div class="input-group-text">Kg</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="extras" role="tabpanel" aria-labelledby="extras-tab">
                    <h5>Datos extra del producto</h5>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="UpcProducto">UPC</label>
                          <input type="text" class="form-control" id="UpcProducto" name="UpcProducto" placeholder="" value="<?php echo $producto['PRODUCTO_UPC']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="EanProducto">EAN</label>
                          <input type="text" class="form-control" id="EanProducto" name="EanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_EAN']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="JanProducto">JAN</label>
                          <input type="text" class="form-control" id="JanProducto" name="JanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_JAN']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="IsbnProducto">ISBN</label>
                          <input type="text" class="form-control" id="IsbnProducto" name="IsbnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_ISBN']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="MpnProducto">MPN</label>
                          <input type="text" class="form-control" id="MpnProducto" name="MpnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_MPN']; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="imagenes" role="tabpanel" aria-labelledby="imagenes-tab">
                    <h5>Imágenes del producto</h5>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="ImagenProducto">Nueva Imagen</label>
                          <input type="file" class="form-control" id="ImagenProducto" name="ImagenProducto" placeholder="" value="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary btn-block">Guardar Producto</button>
                </form>
              </div>
            </div>
        </div>
        <div class="col-sm-3 col-md-2">
          <?php $this->load->view('desktop/usuarios/widgets/mensajes_recientes'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
