<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="titulo">
                  <h1 class="h5"> <span class="fa fa-box"></span> <?php echo $this->lang->line('usuario_listas_generales_actualizar'); ?> <?php echo $producto['PRODUCTO_NOMBRE']; ?></h1>
                </div>
                <div class="herramientas">
                    <a href="<?php echo base_url('usuario/productos'); ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-arrow-left"></span> <?php echo $this->lang->line('usuario_form_producto_regresar'); ?></a>
                </div>
              </div>
              <div class="card-body">
                <?php retro_alimentacion(); ?>
                <?php if(!empty(validation_errors())){ ?>
                  <div class="alert alert-danger">
                    <?php echo validation_errors(); ?>
                  </div>
                  <hr>
                <?php } ?>

                <div class="row">
                  <div class="col">
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab='); ?>"> <span class="fa fa-list"></span>
                          <?php echo $this->lang->line('usuario_form_producto_datos'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab=categoria'); ?>"> <span class="fa fa-list"></span>
                          <?php echo $this->lang->line('usuario_form_producto_categorias'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab=datos'); ?>"> <span class="fa fa-file-alt"></span>
                          <?php echo $this->lang->line('usuario_form_producto_descripcion'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id'].'&tab=galeria'); ?>"> <span class="fa fa-image"></span>
                          <?php echo $this->lang->line('usuario_form_producto_galeria'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuario/productos/actualizar?id='.$_GET['id']); ?>" > <span class="fa fa-sitemap"></span>
                          <?php echo $this->lang->line('usuario_form_producto_combinaciones'); ?>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('usuario/productos_traducciones?id='.$_GET['id']); ?>" > <span class="fa fa-language"></span>
                          Traducciones
                        </a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active p-3" id="galeria" role="tabpanel" aria-labelledby="extras-tab">
                        <div class="row">
                          <div class="col">
                            <div class="border p-3 mb-3">
                              <form class="" action="<?php echo base_url('usuario/productos_traducciones/default'); ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="IdProducto" value="<?php echo $_GET['id']; ?>">
                                <h6> <i class="fa fa-language"></i> Lenguaje por defecto del producto</h6>
                                <div class="row pt-3">
                                  <div class="col">
                                      <label for="ProductoLenguaje">Lenguaje por Defecto</label>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <select class="form-control" name="ProductoLenguaje">
                                        <?php foreach($lenguajes as $lenguaje){ ?>
                                        <option value="<?php echo $lenguaje->LENGUAJE_ISO; ?>" <?php if($producto['LENGUAJE']==$lenguaje->LENGUAJE_ISO){ echo 'selected'; } ?>><?php echo $lenguaje->LENGUAJE_NOMBRE; ?></option>
                                      <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Guardar Lenguaje por defecto</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <h5> <i class="fa fa-language"></i> Traducciones</h5>
                            <table class="table table-sm">
                              <thead>
                                <tr>
                                  <th>Lenguaje</th>
                                  <th>Traduccion</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($lenguajes as $lenguaje){ ?>
                                  <?php if($producto['LENGUAJE']!=$lenguaje->LENGUAJE_ISO){ ?>
                                <tr>
                                  <td><?php echo $lenguaje->LENGUAJE_NOMBRE; ?></td>
                                  <td>Traduccion</td>
                                </tr>
                              <?php } ?>
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
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
