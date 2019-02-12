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
           <h5 class="h5 pt-1"> <span class="fa fa-sitemap"></span> Actualizar</h5>
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
                <label for="">Grupo <small>Ej. Talla</small> </label>
                <input type="text" class="form-control" id="GrupoCombinacion" name="GrupoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_GRUPO']; ?>">
              </div>

              <div class="form-group">
                <label for="">Opción <small>Ej. Chica</small> </label>
                <input type="text" class="form-control" id="OpcionCombinacion" name="OpcionCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_OPCION']; ?>">
              </div>

              <div class="form-group">
                <label for="">Precio de Venta</label>
                <div class="input-group input-group-sm mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">$</div>
                  </div>
                <input type="text" class="form-control" id="PrecioCombinacion" name="PrecioCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PRECIO']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="">Ancho</label>
                <div class="input-group input-group-sm mb-2">
                  <input type="text" class="form-control" id="AnchoCombinacion" name="AnchoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_ANCHO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="">Alto</label>
                <div class="input-group input-group-sm mb-2">
                  <input type="text" class="form-control" id="AltoCombinacion" name="AltoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_ALTO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="">Profundo</label>
                <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control" id="ProfundoCombinacion" name="ProfundoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PROFUNDO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">cm</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="">Peso</label>
                <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control" id="PesoCombinacion" name="PesoCombinacion" required placeholder="" value="<?php echo $combinacion['COMBINACION_PESO']; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">Kg</div>
                  </div>
                </div>
              </div>

              <div class="text-right">
                <button type="submit" class="btn btn-sm btn-primary mb-4"> <span class="fa fa-save"></span> Actualizar Combinación</button>
              </div>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>
