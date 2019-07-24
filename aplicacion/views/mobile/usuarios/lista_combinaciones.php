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

      <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
           <h5 class="h5 pt-1"> <span class="fa fa-sitemap"></span> <?php echo $this->lang->line('usuario_listas_generales_actualizar'); ?> <?php echo $producto['PRODUCTO_NOMBRE']; ?></h5>
           <a href="<?php echo base_url('usuario/productos'); ?>" class="btn mt-1 btn-sm btn-outline-success"> <span class="fa fa-arrow-left"></span></a>
        </div>
        <?php retro_alimentacion(); ?>
        <?php if(!empty(validation_errors())){ ?>
          <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
          </div>
          <hr>
        <?php } ?>
        <div class="card-body">
          <div class="border border-info p-3 mb-4">
            <p><i class="fas fa-info-circle"></i> Las combinaciones puedes usarlas para que los usuarios elijan características específicas de tu producto, por ejemplo Talle, Color, Capacidad, o Contenido.<br><br><i class="fas fa-info-circle"></i> En cada combinación puedes especificar Precio y dimensiones en caso de que tengan algún cambio con respecto al producto por defecto.</p>
          </div>
        </div>
      </div>


      <div class="card mb-3">
        <div class="card-header">
          <h5 class="pt-2"> <span class="fa fa-sitemap"></span> <?php echo $this->lang->line('usuario_form_producto_combinaciones_agregar'); ?></h5>
        </div>
        <div class="card-body">
          <form class="" action="<?php echo base_url('usuario/productos_combinaciones/crear'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="IdProducto" value="<?php echo $_GET['id']; ?>">

              <div class="form-group">
                <label for="GrupoCombinacion"><?php echo $this->lang->line('usuario_form_producto_combinaciones_grupo'); ?> <small><?php echo $this->lang->line('usuario_form_producto_combinaciones_grupo_instrucciones'); ?></small> </label>
                <input type="text" class="form-control" id="GrupoCombinacion" name="GrupoCombinacion" required placeholder="" value="<?=!form_error('GrupoCombinacion')?set_value('GrupoCombinacion'):''?>">
              </div>

              <div class="form-group">
                <label for="OpcionCombinacion"><?php echo $this->lang->line('usuario_form_producto_combinaciones_opcion'); ?> <small><?php echo $this->lang->line('usuario_form_producto_combinaciones_opcion_instrucciones'); ?></small> </label>
                <input type="text" class="form-control" id="OpcionCombinacion" name="OpcionCombinacion" required placeholder="" value="<?=!form_error('OpcionCombinacion')?set_value('OpcionCombinacion'):''?>">
              </div>

              <div class="form-group">
                <label for="PrecioCombinacion"><?php echo $this->lang->line('usuario_form_producto_precio_venta'); ?></label>
                <div class="input-group input-group-sm mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">$</div>
                  </div>
                <input type="text" class="form-control" id="PrecioCombinacion" name="PrecioCombinacion" required placeholder="" value="<?php echo $producto['PRODUCTO_PRECIO']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="AnchoCombinacion"><?php echo $this->lang->line('usuario_form_producto_ancho'); ?></label>
                <div class="input-group input-group-sm mb-2">
                  <input type="text" class="form-control" id="AnchoCombinacion" name="AnchoCombinacion" required placeholder="" value="<?php echo $producto['PRODUCTO_ANCHO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="AltoCombinacion"><?php echo $this->lang->line('usuario_form_producto_alto'); ?></label>
                <div class="input-group input-group-sm mb-2">
                  <input type="text" class="form-control" id="AltoCombinacion" name="AltoCombinacion" required placeholder="" value="<?php echo $producto['PRODUCTO_ALTO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="ProfundoCombinacion"><?php echo $this->lang->line('usuario_form_producto_profundo'); ?></label>
                <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control" id="ProfundoCombinacion" name="ProfundoCombinacion" required placeholder="" value="<?php echo $producto['PRODUCTO_PROFUNDO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="PesoCombinacion"><?php echo $this->lang->line('usuario_form_producto_peso'); ?></label>
                <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control" id="PesoCombinacion" name="PesoCombinacion" required placeholder="" value="<?php echo $producto['PRODUCTO_PESO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">Kg</div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="PesoNetoCombinacion">Peso Neto</label>
                <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control" id="PesoNetoCombinacion" name="PesoNetoCombinacion" placeholder="" value="<?php echo $producto['PRODUCTO_PESO_NETO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">Kg</div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <label for="">Imagen</label>
                </div>
                <?php $i =0; foreach($galerias as $galeria){ ?>
                  <div class="col-6 text-center mb-3 pb-3">
                    <label for="ImagenCombinacion-<?php echo $galeria->ID_GALERIA; ?>">
                      <img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO) ?>" class="img-fluid" alt="">
                      <hr>
                      <input class="form-check-input" type="radio" name="ImagenCombinacion" id="ImagenCombinacion-<?php echo $galeria->ID_GALERIA; ?>" <?php if($i==0){echo 'checked';} ?> value="<?php echo $galeria->GALERIA_ARCHIVO; ?>">
                    </label>
                  </div>
                <?php $i ++; } ?>
                <?php if(empty($galeria)){ ?>
                  <div class="col-1 text-center">
                    <label for="ImagenCombinacion-0">
                      <img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/default.jpg') ?>" class="img-fluid" alt="">
                      <hr>
                      <input class="form-check-input" type="radio" name="ImagenCombinacion" id="ImagenCombinacion-0" checked value="default.jpg">
                    </label>
                  </div>
                <?php } ?>
              </div>

              <div class="text-right">
                <button type="submit" class="btn btn-sm btn-primary mb-4"> <span class="fa fa-save"></span> <?php echo $this->lang->line('usuario_form_producto_combinaciones_agregar'); ?></button>
              </div>

          </form>
        </div>
      </div>

      <div class="card ">
        <div class="card-header">
          <h5 class="pt-2"> <i class="fa fa-sitemap"></i> <?php echo $this->lang->line('usuario_form_producto_combinaciones_actuales'); ?></h5>
        </div>
        <div class="card-body">
          <?php foreach($combinaciones as $combinacion){ ?>
          <div class="mb-2 pb-3 border-bottom">
            <div class="row mb-3">
              <div class="col-4">
                <img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$combinacion->COMBINACION_IMAGEN) ?>" width="100%;">
              </div>
              <div class="col-8">
                <h3 class="h6"><strong><?php echo $this->lang->line('usuario_form_producto_combinaciones_grupo'); ?>: </strong><?php echo $combinacion->COMBINACION_GRUPO; ?></h3>
                <h3 class="h6"><strong><?php echo $this->lang->line('usuario_form_producto_combinaciones_opcion'); ?></strong>: <?php echo $combinacion->COMBINACION_OPCION; ?></h3>
                <h3 class="h6"><strong>Peso:</strong> <?php echo $combinacion->COMBINACION_PESO; ?> Kg</h3>
                <h3 class="h6"><strong><?php echo $this->lang->line('usuario_form_producto_combinaciones_precio'); ?>:</strong> $<?php echo $combinacion->COMBINACION_PRECIO; ?></h3>
              </div>
            </div>
            <div class="btn-group">
              <a href="<?php echo base_url('usuario/productos_combinaciones/actualizar?id='.$combinacion->ID_COMBINACION); ?>" class="btn btn-sm btn-warning" title="Editar Combinación"> <span class="fa fa-pencil-alt"></span> </a>
              <button data-enlace='<?php echo base_url('usuario/productos_combinaciones/borrar?id='.$combinacion->ID_COMBINACION); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Combinacion"> <span class="fa fa-trash"></span> </button>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>




    </div>
  </div>
</div>
