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
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active pt-3" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                    <h5>Datos Generales</h5>
                    <div class="form-group">
                      <label for="NombreProducto">Nombre</label>
                      <input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="<?=!form_error('NombreProducto')?set_value('NombreProducto'):''?>">
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="ModeloProducto">Modelo</label>
                          <input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" value="<?=!form_error('ModeloProducto')?set_value('ModeloProducto'):''?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="OrigenProducto">Origen</label>
                          <select class="form-control" name="OrigenProducto" id="OrigenProducto">
                            <option value="México">México</option>
                            <option value="Otro">Otro</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="DescripcionProducto">Descripción corta</label>
                      <textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control" rows="5"><?=!form_error('DescripcionProducto')?set_value('DescripcionProducto'):''?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="DetallesProducto">Detalles del producto</label>
                      <textarea id="DetallesProducto" name="DetallesProducto" class="form-control" rows="5"><?=!form_error('DetallesProducto')?set_value('DetallesProducto'):''?></textarea>
                    </div>
                    <hr>
                    <h5>Datos de Inventario</h5>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="PrecioProducto">Precio Unitario</label>
                          <input type="text" class="form-control" id="PrecioProducto" name="PrecioProducto" placeholder="" value="<?=!form_error('PrecioProducto')?set_value('PrecioProducto'):''?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="SkuProducto">SKU (Clave de Inventario)</label>
                          <input type="text" class="form-control" id="SkuProducto" name="SkuProducto" placeholder="" value="<?=!form_error('SkuProducto')?set_value('SkuProducto'):''?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="CantidadProducto">Cantidad Disponibles para venta</label>
                          <input type="number" class="form-control" id="CantidadProducto" name="CantidadProducto" placeholder="" min="1" value="1">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="CantidadMinimaProducto">Cantidad Mínima para venta</label>
                          <input type="number" class="form-control" id="CantidadMinimaProducto" name="CantidadMinimaProducto" placeholder="" min="1" value="1">
                        </div>
                      </div>
                    </div>
                    <hr>
                    <h5>Datos para envío</h5>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="AnchoProducto">Ancho</label>
                          <input type="text" class="form-control" id="AnchoProducto" name="AnchoProducto" placeholder="" value="<?=!form_error('AnchoProducto')?set_value('AnchoProducto'):''?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="AltoProducto">Alto</label>
                          <input type="text" class="form-control" id="AltoProducto" name="AltoProducto" placeholder="" value="<?=!form_error('AltoProducto')?set_value('AltoProducto'):''?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="ProfundoProducto">Profundo</label>
                          <input type="text" class="form-control" id="ProfundoProducto" name="ProfundoProducto" placeholder="" value="<?=!form_error('ProfundoProducto')?set_value('ProfundoProducto'):''?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="PesoProducto">Peso</label>
                          <input type="text" class="form-control" id="PesoProducto" name="PesoProducto" placeholder="" value="<?=!form_error('PesoProducto')?set_value('PesoProducto'):''?>">
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
                          <input type="text" class="form-control" id="UpcProducto" name="UpcProducto" placeholder="" value="">
                        </div>
                        <div class="form-group">
                          <label for="EanProducto">EAN</label>
                          <input type="text" class="form-control" id="EanProducto" name="EanProducto" placeholder="" value="">
                        </div>
                        <div class="form-group">
                          <label for="JanProducto">JAN</label>
                          <input type="text" class="form-control" id="JanProducto" name="JanProducto" placeholder="" value="">
                        </div>
                        <div class="form-group">
                          <label for="IsbnProducto">ISBN</label>
                          <input type="text" class="form-control" id="IsbnProducto" name="IsbnProducto" placeholder="" value="">
                        </div>
                        <div class="form-group">
                          <label for="MpnProducto">ISBN</label>
                          <input type="text" class="form-control" id="MpnProducto" name="MpnProducto" placeholder="" value="">
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
