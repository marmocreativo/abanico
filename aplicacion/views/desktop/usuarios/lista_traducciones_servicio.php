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
                  <h1 class="h5"> <span class="fa fa-box"></span> <?php echo $this->lang->line('usuario_listas_generales_actualizar'); ?> <?php echo $servicio['SERVICIO_NOMBRE']; ?></h1>
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
                        <a class="nav-link" href="<?php echo base_url('usuario/servicios/actualizar?id='.$_GET['id'].'&tab='); ?>"> <span class="fa fa-tools"></span>
                          Datos del Servicio
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
                              <form class="" action="<?php echo base_url('usuario/servicios_traducciones/lenguaje_default'); ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="IdServicio" value="<?php echo $_GET['id']; ?>">
                                <div class="row pt-3">
                                  <div class="col-6">
                                      <label for="ProductoLenguaje">Idioma en el que escribiste la descripción de tu producto</label>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <select class="form-control" name="ServicioLenguaje">
                                        <?php foreach($lenguajes as $lenguaje){ ?>
                                        <option value="<?php echo $lenguaje->LENGUAJE_ISO; ?>" <?php if($servicio['LENGUAJE']==$lenguaje->LENGUAJE_ISO){ echo 'selected'; } ?>><?php echo $lenguaje->LENGUAJE_NOMBRE; ?></option>
                                      <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Guardar </button>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <h5> <i class="fa fa-language"></i> Escribe la descripción de tu producto en otro idioma</h5>
                            <table class="table table-sm table-bordered">
                              <tbody>
                                <?php foreach($lenguajes as $lenguaje){ ?>
                                  <?php if($servicio['LENGUAJE']!=$lenguaje->LENGUAJE_ISO){ ?>
                                <tr>
                                  <td> <h3> <?php echo $lenguaje->LENGUAJE_NOMBRE; ?> </h3></td>
                                  <td>
                                    <?php $traduccion = $this->TraduccionesModel->lista($servicio['ID_SERVICIO'],'servicio',$lenguaje->LENGUAJE_ISO); ?>
                                    <?php if(empty($traduccion)){ ?>
                                    <form class="" action="<?php echo base_url('usuario/servicios_traducciones/crear'); ?>" method="post">
                                      <input type="hidden" name="IdObjeto" value="<?php echo $servicio['ID_SERVICIO'] ?>">
                                      <input type="hidden" name="TipoObjeto" value="servicio">
                                      <input type="hidden" name="Lenguaje" value="<?php echo $lenguaje->LENGUAJE_ISO; ?>">
                                      <div class="form-group">
                                        <label for="TraduccionTitulo">Título</label>
                                        <input type="text" class="form-control" name="TraduccionTitulo" value="" required>
                                      </div>
                                      <div class="form_group">
                                        <label for="TraduccionDescripcionCorta">Descripción corta</label>
                                        <textarea name="TraduccionDescripcionCorta" class="form-control" rows="5"></textarea>
                                      </div>
                                      <div class="form_group">
                                        <label for="TraduccionDescripcionLarga">Descripción Detallada</label>
                                        <textarea name="TraduccionDescripcionLarga" class="form-control" rows="5"></textarea>
                                      </div>
                                      <hr>
                                      <button type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-save"></i> Crear Traducción</button>
                                    </form>
                                  <?php }else{ ?>
                                    <form class="" action="<?php echo base_url('usuario/servicios_traducciones/actualizar'); ?>" method="post">
                                      <input type="hidden" name="IdTraduccion" value="<?php echo $traduccion['ID_TRADUCCION'] ?>">
                                      <input type="hidden" name="IdObjeto" value="<?php echo $traduccion['ID_OBJETO'] ?>">
                                      <input type="hidden" name="TipoObjeto" value="<?php echo $traduccion['TIPO_OBJETO'] ?>">
                                      <input type="hidden" name="Lenguaje" value="<?php echo $traduccion['LENGUAJE'] ?>">
                                      <div class="form-group">
                                        <label for="TraduccionTitulo">Título</label>
                                        <input type="text" class="form-control" name="TraduccionTitulo" value="<?php echo $traduccion['TITULO'] ?>" required>
                                      </div>
                                      <div class="form_group">
                                        <label for="TraduccionDescripcionCorta">Descripción corta</label>
                                        <textarea name="TraduccionDescripcionCorta" class="form-control" rows="5"><?php echo $traduccion['DESCRIPCION_CORTA'] ?></textarea>
                                      </div>
                                      <div class="form_group">
                                        <label for="TraduccionDescripcionLarga">Descripción Detallada</label>
                                        <textarea name="TraduccionDescripcionLarga" class="form-control" rows="5"><?php echo $traduccion['DESCRIPCION_LARGA'] ?></textarea>
                                      </div>
                                      <hr>
                                      <button type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-save"></i> Actualizar Traducción</button>
                                    </form>
                                  <?php } ?>
                                  </td>
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