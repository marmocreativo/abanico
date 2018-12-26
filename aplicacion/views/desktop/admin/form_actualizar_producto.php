<?php if(isset($producto['ID_USUARIO'])){
  $id_usuario = $producto['ID_USUARIO'];
}else{
  $id_usuario = '';
}
if(isset($_GET['tab'])){ $tab = $_GET['tab']; } else { $tab='categoria'; }
?>
<div class="contenido_principal">
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="titulo">
              <h1 class="h5"> <span class="fa fa-box"></span> Actualizar <?php echo $producto['PRODUCTO_NOMBRE']; ?></h1>
            </div>
            <div class="herramientas">
                <a href="<?php echo base_url('admin/productos/'); ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-arrow-left"></span> Salir a todos los Productos </a>
                <a href="<?php echo base_url('admin/productos/usuario?id_usuario='.$usuario_producto['ID_USUARIO']); ?>" class="btn btn-sm btn-success"> <span class="fa fa-chevron-left"></span> Salir a Productos de <?php echo $usuario_producto['USUARIO_NOMBRE']." ".$usuario_producto['USUARIO_APELLIDOS'];  ?> </a>
            </div>
          </div>
          <div class="card-body">
            <!-- Alertas y Mensajes -->
            <?php if(isset($_GET['mensaje'])){
              switch($_GET['mensaje']){
                case 'producto_actualizado':
                  $alerta = 'alert-success';
                  $mensaje = 'Tu Producto se actualizó correctamente';
                break;
                case 'producto_creado':
                  $alerta = 'alert-success';
                  $mensaje = 'Tu Producto se ha creado correctamente, Puedes seguir añadiendo imagenes a la galería';
                break;
              }
              ?>

              <div class="alert <?php echo  $alerta; ?>">
                <p><?php echo  $mensaje; ?></p>
              </div>
            <?php }// Termina la condicionante ?>
            <!-- Alertas de Validación -->
            <?php if(!empty(validation_errors())){ ?>
              <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
              </div>
              <hr>
            <?php } ?>
            <form class="" action="<?php echo base_url('admin/productos/actualizar'); ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="TipoProducto" value="<?php echo $tipo_producto; ?>">
              <input type="hidden" name="IdUsuario" value="<?php echo $id_usuario; ?>">
              <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
              <input type="hidden" name="UrlProducto" value="<?php echo $producto['PRODUCTO_URL']; ?>">
              <div class="row mb-3">
                <div class="col-9">
                  <div class="border border-primary p-2">
                    <h6 class="border-bottom pb-2"> <i class="fa fa-tag"></i> Información Básica Obligatoria</h6>
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="NombreProducto">Nombre del producto</label>
                          <input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="<?php echo $producto['PRODUCTO_NOMBRE']; ?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="PrecioProducto">Precio de Venta</label>
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
                          <label for="PrecioListaProducto">Precio de Lista</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">$</div>
                            </div>
                          <input type="text" class="form-control" id="PrecioListaProducto" name="PrecioListaProducto" placeholder="" value="<?php echo $producto['PRODUCTO_PRECIO_LISTA']; ?>">
                          </div>
                          <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Este es el precio que aparecerá en la lista de producto Tachado</small>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="CantidadProducto">Cantidad Disponibles</label>
                          <input type="number" class="form-control" id="CantidadProducto" required name="CantidadProducto" placeholder="" min="1" value="<?php echo $producto['PRODUCTO_CANTIDAD']; ?>">
                        </div>
                      </div>
                    </div>
                    <h6 class="border-bottom pb-2"> <i class="fa fa-clipboard-list"></i> Cantidades</h6>
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="ModeloProducto">Modelo</label>
                            <input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" value="<?php echo $producto['PRODUCTO_MODELO']; ?>">
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
                            <label for="CantidadMinimaProducto">Venta mínima</label>
                            <input type="number" class="form-control" id="CantidadMinimaProducto" required name="CantidadMinimaProducto" placeholder="" min="1" value="<?php echo $producto['PRODUCTO_CANTIDAD_MINIMA']; ?>">
                          </div>
                        </div>
                      </div>
                    <h6 class="border-bottom pb-2"> <i class="fa fa-cube"></i> Dimensiones</h6>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="AnchoProducto">Ancho</label>
                          <div class="input-group input-group-sm mb-2">
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
                          <div class="input-group input-group-sm mb-2">
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
                          <div class="input-group input-group-sm mb-2">
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
                <div class="col-3">
                  <div class="border border-default p-2">
                  <div class="form-group">
                    <label for="EstadoProducto">Estado del Producto</label>
                    <select class="form-control" id="EstadoProducto" name="EstadoProducto" placeholder="">
                      <option value="activo" <?php if($producto['PRODUCTO_ESTADO']=='activo'){ echo 'selected';} ?> >Publicado</option>
                      <option value="inactivo" <?php if($producto['PRODUCTO_ESTADO']=='inactivo'){ echo 'selected';} ?>>Borrador</option>
                    </select>
                  </div>
                </div>
                </div>
              </div>
              <div class="row">

                <div class="col">
                  <div class="border border-default p-2">
                  <h6> <i class="fa fa-file"></i> Descripción e Información extra</h6>
                  <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link <?php if($tab=='categoria'){ echo 'active'; } ?>" id="categoria-tab" data-toggle="tab" href="#categoria" role="tab" aria-controls="categoria" aria-selected="false"> <span class="fa fa-list"></span> Categorias</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?php if($tab=='datos'){ echo 'active'; } ?>" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="true"> <span class="fa fa-file-alt"></span> Descripción</a>
                    </li>

                    <!--
                    <li class="nav-item">
                      <a class="nav-link " id="inventario-tab" data-toggle="tab" href="#inventario" role="tab" aria-controls="inventario" aria-selected="true"> <span class="fa fa-boxes"></span> Inventario</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " id="envio-tab" data-toggle="tab" href="#envio" role="tab" aria-controls="envio" aria-selected="true"> <span class="fa fa-truck"></span> Envio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="extras-tab" data-toggle="tab" href="#extras" role="tab" aria-controls="extras" aria-selected="false"> <span class="fa fa-table"></span> Datos Extra</a>
                    </li>

                  -->
                    <li class="nav-item">
                      <a class="nav-link <?php if($tab=='galeria'){ echo 'active'; } ?>" id="galeria-tab" data-toggle="tab" href="#galeria" role="tab" aria-controls="galeria" aria-selected="false"> <span class="fa fa-image"></span> Galeria</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade <?php if($tab=='categoria'|| $tab==''){ echo 'show active'; } ?> p-3" id="categoria" role="tabpanel" aria-labelledby="datos-tab">
                      <div class="row">
                          <?php foreach($categorias as $categoria){ ?>
                              <div class="col-12 border border-default p-3">
                                <h6 class="border-bottom pb-3"><?php echo $categoria->CATEGORIA_NOMBRE; ?></h6>
                                <?php $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
                                <div class="row">
                                <?php foreach($segundo_categorias as $segunda_categoria){ ?>
                                  <div class="col-4">
                                    <div class="border border-default p-3">
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
                                                  required
                                                  >
                                          <label class="custom-control-label" for="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>">-<?php echo $tercera_categoria->CATEGORIA_NOMBRE; ?></label>
                                        </div>
                                      </li>
                                    <?php } ?>
                                    </ul>
                                    </div>
                                  </div>
                                <?php } ?>
                                </div>
                              </div>
                          <?php } ?>
                      </div>
                    </div>
                    <div class="tab-pane fade <?php if($tab=='datos'){ echo 'show active'; } ?> p-3" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                      <div class="form-group">
                        <label for="DescripcionProducto">Descripción corta</label>
                        <textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control" rows="3"><?php echo $producto['PRODUCTO_DESCRIPCION']; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="DetallesProducto">Detalles del producto</label>
                        <textarea id="DetallesProducto" name="DetallesProducto" class="form-control Editor" rows="5"><?php echo $producto['PRODUCTO_DETALLES']; ?></textarea>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <div class="form-group">
                            <label for="OrigenProducto">Origen</label>
                            <select class="form-control form-control-sm" name="OrigenProducto" id="OrigenProducto">
                              <option value="México" <?php if($producto['PRODUCTO_ORIGEN']=='México'){ echo 'selected';} ?>>México</option>
                              <option value="Otro" <?php if($producto['PPRODUCTO_ORIGEN']=='Otro'){ echo 'selected';} ?>>Otro</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="UpcProducto">UPC</label>
                            <input type="text" class="form-control form-control-sm" id="UpcProducto" name="UpcProducto" placeholder="" value="<?php echo $producto['PRODUCTO_UPC']; ?>">
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="EanProducto">EAN</label>
                            <input type="text" class="form-control form-control-sm" id="EanProducto" name="EanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_EAN']; ?>">
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="JanProducto">JAN</label>
                            <input type="text" class="form-control form-control-sm" id="JanProducto" name="JanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_JAN']; ?>">
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="IsbnProducto">ISBN</label>
                            <input type="text" class="form-control form-control-sm" id="IsbnProducto" name="IsbnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_ISBN']; ?>">
                          </div>
                        </div>
                        <div class="col-4">

                          <div class="form-group">
                            <label for="MpnProducto">MPN</label>
                            <input type="text" class="form-control form-control-sm" id="MpnProducto" name="MpnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_MPN']; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade p-3" id="inventario" role="tabpanel" aria-labelledby="datos-tab">
                    </div>
                    <div class="tab-pane fade p-3" id="envio" role="tabpanel" aria-labelledby="datos-tab">
                      <!-- Espacio para datos de envio-->
                    </div>
                    <div class="tab-pane fade p-3" id="extras" role="tabpanel" aria-labelledby="extras-tab">
                      <h5>Datos extra del producto</h5>
                      <div class="row">
                        <div class="col">

                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade <?php if($tab=='galeria'){ echo 'show active'; } ?> p-3" id="galeria" role="tabpanel" aria-labelledby="extras-tab">
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="ImagenProducto">Añadir Imagen</label>
                            <input type="file" class="form-control" id="ImagenProducto" name="ImagenProducto">
                          </div>
                          <table class="table table-bordered table-sm">
                            <thead>
                              <tr>
                                <th class="text-center">id</th>
                                <th class="text-center">Imagen</th>
                                <th class="text-center">Portada</th>
                                <th class="text-right">Controles</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($galerias as $galeria){ ?>
                                <tr>
                                  <td class="text-center"><?php echo $galeria->ID_GALERIA; ?></td>
                                  <td class="text-center">
                                    <img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO) ?>" alt="" width="50">
                                  </td>
                                  <td class="text-center">
                                    <?php if($galeria->GALERIA_PORTADA=='si'){ ?>
                                      <a href="<?php echo base_url('usuario/productos/portada')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                                    <?php }else{ ?>
                                      <a href="<?php echo base_url('usuario/productos/portada')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                                    <?php } ?>
                                  </td>
                                  <td class="text-right">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <a href="<?php echo base_url('usuario/productos/borrar_galeria')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></a>
                                    </div>
                                  </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="row border-top mt-3 pt-3">
                <div class="col">
                  <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Actualizar Producto</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>