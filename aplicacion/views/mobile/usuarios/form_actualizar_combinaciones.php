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

      <div class="card">
        <div class="card-header d-flex justify-content-between">
           <h5 class="h5 pt-1"> <span class="fa fa-sitemap"></span> <?php echo $this->lang->line('usuario_listas_generales_actualizar'); ?> <?php echo $this->lang->line('usuario_lista_combinaciones_singular'); ?></h5>
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
          <form class="" action="<?php echo base_url('usuario/productos_combinaciones/actualizar'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="IdProducto" value="<?php echo $combinacion['ID_PRODUCTO']; ?>">
              <div class="form-group">
                  <label for="GrupoCombinacion"><?php echo $this->lang->line('usuario_form_producto_combinaciones_grupo'); ?> <small><?php echo $this->lang->line('usuario_form_producto_combinaciones_grupo_instrucciones'); ?></small> </label>
                <input type="text" class="form-control" id="GrupoCombinacion" name="GrupoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_GRUPO']; ?>">
              </div>

              <div class="form-group">
                <label for="OpcionCombinacion"><?php echo $this->lang->line('usuario_form_producto_combinaciones_opcion'); ?> <small><?php echo $this->lang->line('usuario_form_producto_combinaciones_opcion_instrucciones'); ?></small> </label>
                <input type="text" class="form-control" id="OpcionCombinacion" name="OpcionCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_OPCION']; ?>">
              </div>

              <div class="form-group">
                <label for="PrecioCombinacion"><?php echo $this->lang->line('usuario_form_producto_precio_venta'); ?></label>
                <div class="input-group input-group-sm mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">$</div>
                  </div>
                <input type="text" class="form-control" id="PrecioCombinacion" name="PrecioCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PRECIO']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="AnchoCombinacion"><?php echo $this->lang->line('usuario_form_producto_ancho'); ?></label>
                <div class="input-group input-group-sm mb-2">
                  <input type="text" class="form-control" id="AnchoCombinacion" name="AnchoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_ANCHO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for=""><label for="AltoCombinacion"><?php echo $this->lang->line('usuario_form_producto_alto'); ?></label></label>
                <div class="input-group input-group-sm mb-2">
                  <input type="text" class="form-control" id="AltoCombinacion" name="AltoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_ALTO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for=""><label for="ProfundoCombinacion"><?php echo $this->lang->line('usuario_form_producto_profundo'); ?></label></label>
                <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control" id="ProfundoCombinacion" name="ProfundoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PROFUNDO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for=""><label for="PesoCombinacion"><?php echo $this->lang->line('usuario_form_producto_peso'); ?></label></label>
                <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control" id="PesoCombinacion" name="PesoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PESO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">Kg</div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for=""><label for="PesoNetoCombinacion">Peso Neto</label></label>
                <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control" id="PesoNetoCombinacion" name="PesoNetoCombinacion" placeholder="" value="<?php echo $combinacion['COMBINACION_PESO_NETO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">Kg</div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <label for="">Imagen</label>
                </div>
                <?php foreach($galerias as $galeria){ ?>
                  <div class="col-6 text-center mb-3 pb-3">
                    <label for="ImagenCombinacion-<?php echo $galeria->ID_GALERIA; ?>">
                      <img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO) ?>" class="img-fluid" alt="">
                      <hr>
                      <input class="form-check-input" type="radio" name="ImagenCombinacion" id="ImagenCombinacion-<?php echo $galeria->ID_GALERIA; ?>" <?php if($galeria->GALERIA_ARCHIVO==$combinacion['COMBINACION_IMAGEN']){ echo 'checked'; } ?> value="<?php echo $galeria->GALERIA_ARCHIVO; ?>">
                    </label>
                  </div>
                <?php } ?>
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
                <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> <?php echo $this->lang->line('usuario_form_producto_combinaciones_actualizar'); ?></button>
              </div>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>
