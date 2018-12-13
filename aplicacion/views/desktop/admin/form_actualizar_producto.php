<?php if(isset($producto['ID_USUARIO'])){
  $id_usuario = $producto['ID_USUARIO'];
}else{
  $id_usuario = '';
}
?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-globe-americas"></span> Actualizar <?php echo $producto['PRODUCTO_NOMBRE']; ?></h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/productos/actualizar'); ?>" method="post">
            <input type="hidden" name="Identificador" value="<?php echo $producto['ID_PRODUCTO']; ?>">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="true">Datos Generales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="extras-tab" data-toggle="tab" href="#extras" role="tab" aria-controls="extras" aria-selected="false">Datos Extra</a>
          </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active pt-3" id="datos" role="tabpanel" aria-labelledby="datos-tab">
              <h5>Datos Generales</h5>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="NombreProducto">Nombre del producto</label>
                    <input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="<?php if(empty(form_error('NombreProducto'))){ echo $producto['PRODUCTO_NOMBRE']; } else { set_value('NombreProducto'); } ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="OrigenProducto">Usuario</label>
                    <select class="form-control" name="IdUsuario" id="IdUsuario">
                      <?php foreach($usuarios as $usuario){ ?>
                        <option value="<?php echo $usuario->ID_USUARIO; ?>" <?php if($usuario->ID_USUARIO==$id_usuario){ echo 'selected'; } ?>><?php echo $usuario->USUARIO_NOMBRE." ".$usuario->USUARIO_APELLIDOS; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="ModeloProducto">Modelo</label>
                    <input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" required value="<?php if(empty(form_error('ModeloProducto'))){ echo $producto['PRODUCTO_MODELO']; } else { set_value('ModeloProducto'); } ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="OrigenProducto">Origen</label>
                    <select class="form-control" name="OrigenProducto" id="OrigenProducto">
                      <option value="México" <?php if($producto['PRODUCTO_ORIGEN']=='México'){ echo 'selected'; } ?>>México</option>
                      <option value="Otro" <?php if($producto['PRODUCTO_ORIGEN']=='Otro'){ echo 'selected'; } ?>>Otro</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="DescripcionProducto">Descripción corta</label>
                <textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control" rows="5"><?php if(empty(form_error('DescripcionProducto'))){ echo $producto['PRODUCTO_DESCRIPCION']; } else { set_value('DescripcionProducto'); } ?></textarea>
              </div>
              <div class="form-group">
                <label for="DetallesProducto">Detalles del producto</label>
                <textarea id="DetallesProducto" name="DetallesProducto" class="form-control Editor" rows="5"><?php if(empty(form_error('DetallesProducto'))){ echo $producto['PRODUCTO_DETALLES']; } else { set_value('DetallesProducto'); } ?> </textarea>
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
                    <input type="text" class="form-control" id="PrecioProducto" name="PrecioProducto" required placeholder="" value="<?php if(empty(form_error('PrecioProducto'))){ echo $producto['PRODUCTO_PRECIO']; } else { set_value('PrecioProducto'); } ?>">
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="SkuProducto">SKU (Clave de Inventario)</label>
                    <input type="text" class="form-control" id="SkuProducto" name="SkuProducto" placeholder="" value="<?php echo $producto['PRODUCTO_SKU'];?>">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="CantidadProducto">Cantidad Disponibles para venta</label>
                    <input type="number" class="form-control" id="CantidadProducto" required name="CantidadProducto" placeholder="" min="1" value="<?php echo $producto['PRODUCTO_CANTIDAD'];  ?>">
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
                      <input type="text" class="form-control" id="AnchoProducto" name="AnchoProducto" required placeholder="" value="<?php if(empty(form_error('AnchoProducto'))){ echo $producto['PRODUCTO_ANCHO']; } else { set_value('AnchoProducto'); } ?>">
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
                      <input type="text" class="form-control" id="AltoProducto" name="AltoProducto" required placeholder="" value="<?php if(empty(form_error('AltoProducto'))){ echo $producto['PRODUCTO_ALTO']; } else { set_value('AltoProducto'); } ?>  <?=!form_error('AltoProducto')?set_value('AltoProducto'):''?>">
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
                    <input type="text" class="form-control" id="ProfundoProducto" name="ProfundoProducto" required placeholder="" value="<?php if(empty(form_error('ProfundoProducto'))){ echo $producto['PRODUCTO_PROFUNDO']; } else { set_value('ProfundoProducto'); } ?>">
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
                    <input type="text" class="form-control" id="PesoProducto" name="PesoProducto" required placeholder="" value="<?php if(empty(form_error('PesoProducto'))){ echo $producto['PRODUCTO_PESO']; } else { set_value('PesoProducto'); } ?> ">
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
                    <input type="text" class="form-control" id="UpcProducto" name="UpcProducto" placeholder="" value="<?php echo $producto['PRODUCTO_UPC']; ?> ">
                  </div>
                  <div class="form-group">
                    <label for="EanProducto">EAN</label>
                    <input type="text" class="form-control" id="EanProducto" name="EanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_EAN']; ?> ">
                  </div>
                  <div class="form-group">
                    <label for="JanProducto">JAN</label>
                    <input type="text" class="form-control" id="JanProducto" name="JanProducto" placeholder="" value="<?php echo $producto['PRODUCTO_JAN']; ?> ">
                  </div>
                  <div class="form-group">
                    <label for="IsbnProducto">ISBN</label>
                    <input type="text" class="form-control" id="IsbnProducto" name="IsbnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_ISBN']; ?> ">
                  </div>
                  <div class="form-group">
                    <label for="MpnProducto">ISBN</label>
                    <input type="text" class="form-control" id="MpnProducto" name="MpnProducto" placeholder="" value="<?php echo $producto['PRODUCTO_MPN']; ?> ">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Guardar Producto</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
