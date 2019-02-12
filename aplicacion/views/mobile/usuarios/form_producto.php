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
      <?php retro_alimentacion(); ?>
      <div class="card border-bottom-0 mb-3">
        <div class="card-header">
          <h5 class="pt-2"> <span class="fa fa-box"></span> Nuevo Producto</h5>
        </div>
      </div>
      <?php if(!empty(validation_errors())){ ?>
        <div class="alert alert-danger">
          <?php echo validation_errors(); ?>
        </div>
        <hr>
      <?php } ?>
      <form class="" action="<?php echo base_url('usuario/productos/crear'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="TipoProducto" value="<?php echo $tipo_producto; ?>">
        <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
        <input type="hidden" name="IdTienda" value="<?php echo $tienda['ID_TIENDA']; ?>">
        <!-- menu de acordion -->
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header p-1" id="headingOne">
              <h4 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                   <span class="fa fa-list"></span> Datos Básicos
                </button>
              </h4>
            </div>

            <div id="collapseOne" class="" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">

                <div class="form-group">
                  <label for="EstadoProducto">Estado del Producto</label>
                  <select class="form-control" id="EstadoProducto" name="EstadoProducto">
                    <option value="activo">Publicado</option>
                    <option value="inactivo">Borrador</option>
                  </select>
                </div>

                <hr>

                <div class="border border-primary p-2">
                  <h6 class="border-bottom pb-2"> <i class="fa fa-tag"></i> Información Básica Obligatoria</h6>
                  <div class="form-group">
                    <label for="NombreProducto">Nombre del producto</label>
                    <input type="text" class="form-control" id="NombreProducto" name="NombreProducto" placeholder="" value="<?=!form_error('NombreProducto')?set_value('NombreProducto'):''?>">
                  </div>
                  <div class="form-group">
                    <label for="PrecioProducto">Precio de Venta</label>
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                      </div>
                    <input type="text" class="form-control" id="PrecioProducto" name="PrecioProducto" required placeholder="" value="<?=!form_error('PrecioProducto')?set_value('PrecioProducto'):''?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="PrecioListaProducto">Precio de Lista</label>
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                      </div>
                    <input type="text" class="form-control" id="PrecioListaProducto" name="PrecioListaProducto" placeholder="" value="<?=!form_error('PrecioListaProducto')?set_value('PrecioListaProducto'):''?>">
                    </div>
                    <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Este es el precio Tachado que aparecerá en la lista de productos</small>
                  </div>
                  <div class="form-group">
                    <label for="CantidadProducto">Cantidad disponibles</label>
                    <input type="number" class="form-control" id="CantidadProducto" required name="CantidadProducto" placeholder="" min="1" value="1">
                  </div>
                  <h6 class="border-bottom pb-2"> <i class="fa fa-clipboard-list"></i> Cantidades</h6>
                  <div class="form-group">
                    <label for="ModeloProducto">Modelo</label>
                    <input type="text" class="form-control" id="ModeloProducto" name="ModeloProducto" placeholder="" value="<?=!form_error('ModeloProducto')?set_value('ModeloProducto'):''?>">
                  </div>
                  <div class="form-group">
                    <label for="SkuProducto">SKU (Clave de Inventario)</label>
                    <input type="text" class="form-control" id="SkuProducto" name="SkuProducto" placeholder="" value="">
                  </div>
                  <div class="form-group">
                    <label for="CantidadMinimaProducto">Venta mínima</label>
                    <input type="number" class="form-control" id="CantidadMinimaProducto" required name="CantidadMinimaProducto" placeholder="" min="1" value="1">
                  </div>
                  <h6 class="border-bottom pb-2"> <i class="fa fa-cube"></i> Dimensiones</h6>
                  <div class="form-group">
                    <label for="AnchoProducto">Ancho</label>
                    <div class="input-group input-group-sm mb-2">
                      <input type="text" class="form-control" id="AnchoProducto" name="AnchoProducto" required placeholder="" value="<?=!form_error('AnchoProducto')?set_value('AnchoProducto'):''?>">
                      <div class="input-group-append">
                        <div class="input-group-text">cm</div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="AltoProducto">Alto</label>
                    <div class="input-group input-group-sm mb-2">
                      <input type="text" class="form-control" id="AltoProducto" name="AltoProducto" required placeholder="" value="<?=!form_error('AltoProducto')?set_value('AltoProducto'):''?>">
                      <div class="input-group-append">
                        <div class="input-group-text">cm</div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ProfundoProducto">Profundo</label>
                    <div class="input-group input-group-sm mb-2">
                    <input type="text" class="form-control" id="ProfundoProducto" name="ProfundoProducto" required placeholder="" value="<?=!form_error('ProfundoProducto')?set_value('ProfundoProducto'):''?>">
                      <div class="input-group-append">
                        <div class="input-group-text">cm</div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="PesoProducto">Peso</label>
                    <div class="input-group input-group-sm mb-2">
                    <input type="text" class="form-control" id="PesoProducto" name="PesoProducto" required placeholder="" value="">
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
                <?php $i = 1; foreach($categorias as $categoria){ ?>
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
                              >
                      <label class="custom-control-label" for="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>">-<?php echo $tercera_categoria->CATEGORIA_NOMBRE; ?></label>
                    </div>
                  </li>
                <?php }// Termina el bucle tercera categoria ?>
                </ul>
              <?php } // Termina Bucle segunda categoría ?>
            <?php } // Termina Bucle primera categoría ?>

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
                  <textarea id="DescripcionProducto" name="DescripcionProducto" class="form-control" rows="3"><?=!form_error('DescripcionProducto')?set_value('DescripcionProducto'):''?></textarea>
                </div>
                <div class="form-group">
                  <label for="DetallesProducto">Detalles del producto</label>
                  <textarea id="DetallesProducto" name="DetallesProducto" class="form-control Editor" rows="5"><?=!form_error('DetallesProducto')?set_value('DetallesProducto'):''?> </textarea>
                </div>

                <div class="form-group">
                  <label for="">Origen</label>
                  <select class="form-control form-control-sm" name="" id="">
                    <option value="México">México</option>
                    <option value="Otro">Otro</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="">UPC</label>
                  <input type="text" class="form-control form-control-sm" id="UpcProducto" name="UpcProducto" placeholder="" value="">
                </div>

                <div class="form-group">
                  <label for="">EAN</label>
                  <input type="text" class="form-control form-control-sm" id="EanProducto" name="EanProducto" placeholder="" value="">
                </div>

                <div class="form-group">
                  <label for="">JAN</label>
                  <input type="text" class="form-control form-control-sm" id="JanProducto" name="JanProducto" placeholder="" value="">
                </div>

                <div class="form-group">
                  <label for="">ISBN</label>
                  <input type="text" class="form-control form-control-sm" id="IsbnProducto" name="IsbnProducto" placeholder="" value="">
                </div>

                <div class="form-group">
                  <label for="">MPN</label>
                  <input type="text" class="form-control form-control-sm" id="MpnProducto" name="MpnProducto" placeholder="" value="">
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
                  <input type="file" class="custom-file-input" id="ImagenProducto" name="ImagenProducto" placeholder="" value="">
                  <label class="custom-file-label" for="ImagenProducto">Añadir Imagen</label>
                </div>

              </div>
            </div>
          </div>
        </div>


        <button type="submit" class="btn btn-sm mt-3 btn-primary float-right"> <span class="fa fa-save"></span> Crear Producto</button>

      </form>

    </div>
  </div>
</div>
