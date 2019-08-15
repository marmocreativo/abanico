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

      <?php if(!empty(validation_errors())){ ?>
        <div class="alert alert-danger">
          <?php echo validation_errors(); ?>
        </div>
      <?php } ?>



      <form class="" action="<?php echo base_url('usuario/servicios/crear');?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">

        <div class="card mb-3">
          <div class="card-body">
              <img class="img-fluid img-thumbnail mx-auto mb-3 d-block rounded-circle" id="PrevisualizarImagen" style="width:150px" src="<?php echo base_url('contenido/img/servicios/completo/default.jpg') ?>" alt="" >
              <div class="custom-file file-sm mb-3">
                <input type="file" class="custom-file-input" id="ImagenServicio" name="ImagenServicio" placeholder="" value="">
                <label class="custom-file-label" for="ImagenServicio"><?php echo $this->lang->line('usuario_form_servicio_fotografia'); ?></label>
              </div>
               <div class="form-group">
                 <label for="NombreUsuario"><?php echo $this->lang->line('usuario_form_servicio_nombre_persona'); ?></label>
                 <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" required value="<?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?>">
               </div>
               <div class="form-group">
                 <label for="NombreServicio"><?php echo $this->lang->line('usuario_form_servicio_nombre_servicio'); ?></label>
                 <input type="text" class="form-control" id="NombreServicio" name="NombreServicio" placeholder="" required value="<?php echo set_value('NombreServicio'); ?>">
               </div>
               <div class="form-group">
                 <label for="MetaTitulo">Meta Título</label>
                 <input type="text" class="form-control" id="MetaTitulo" name="MetaTitulo" placeholder="" value="">
                 <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Para mejorar el posicionamiento en internet, un título corto menos de 70 caracteres</small>
               </div>
               <div class="form-group">
                 <label for="DescripcionServicio"><?php echo $this->lang->line('usuario_form_servicio_descripcion_corta'); ?></label>
                 <textarea class="form-control" name="DescripcionServicio" rows="3" cols="80" required><?php echo set_value('DescripcionServicio'); ?></textarea>
               </div>
               <div class="form-group">
                 <label for="MetaDescripcion">Meta Descripción</label>
                 <textarea class="form-control" name="MetaDescripcion" rows="3" cols="80"></textarea>
                 <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Para mejorar el posicionamiento en internet, un título corto menos de 140 caracteres</small>
               </div>
               <div class="form-group">
                 <label for="MetaKeywords">Meta Keywords</label>
                 <textarea class="form-control" name="MetaKeywords" rows="3" cols="80"></textarea>
                 <small class="form-text text-muted"> <i class="fa fa-info-circle"></i> Para mejorar el posicionamiento en internet, de 1 a 10 frases separadas por coma que describan tu servicio</small>
               </div>

               <div class="form-group">
                 <label for="TipoServicio"><?php echo $this->lang->line('usuario_form_servicio_tipo'); ?></label>
                 <select class="form-control" name="TipoServicio">
                   <option value="profesional"><?php echo $this->lang->line('usuario_form_servicio_tipo_presencial'); ?></option>
                   <option value="digital"><?php echo $this->lang->line('usuario_form_servicio_tipo_distancia'); ?></option>
                 </select>
               </div>
               <p class="text-muted"> <i class="fa fa-info-circle"></i><?php echo $this->lang->line('usuario_form_servicio_tipo_distancia_instrucciones'); ?></p>

               <h6> <i class="fa fa-map-marker"></i> <?php echo $this->lang->line('usuario_form_servicio_zona_instrucciones'); ?></h6>

               <div class="form-group">
                 <label for="PaisDireccion"><?php echo $this->lang->line('usuario_form_direcciones_pais'); ?> </label>
                 <select class="form-control" name="PaisDireccion" id="PaisDireccion" required>
                   <option value=""><?php echo $this->lang->line('usuario_form_direcciones_pais_selecciona'); ?></option>
                 </select>
               </div>

               <div class="form-group">
                 <label for="EstadoDireccion"><?php echo $this->lang->line('usuario_form_direcciones_estado'); ?> </label>
                 <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" required>
                   <option value=""><?php echo $this->lang->line('usuario_form_direcciones_estado_selecciona'); ?></option>
                 </select>
               </div>
               <div class="form-group">
                 <label for="MunicipioDireccion"><?php echo $this->lang->line('usuario_form_direcciones_municipio'); ?></label>
                 <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" required>
                   <option value=""><?php echo $this->lang->line('usuario_form_direcciones_municipio_selecciona'); ?></option>
                 </select>
               </div>
               <div class="form-group">
                 <label for="ZonaTrabajoServicio"><?php echo $this->lang->line('usuario_form_servicio_zona'); ?> <small><?php echo $this->lang->line('usuario_form_servicio_zona_descripcion'); ?></small></label>
                 <textarea name="ZonaTrabajoServicio" class="form-control" rows="6"></textarea>
               </div>
            </div>
          </div>


          <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <span class="fa fa-list"></span> Categorias
                  </button>
                </h2>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <?php foreach($categorias as $categoria){ ?>
                  <div class="">
                    <h6 class="pb-3"><?php echo $categoria->CATEGORIA_NOMBRE; ?></h6>
                    <?php $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
                    <div class="row">
                      <?php foreach($segundo_categorias as $segunda_categoria){ ?>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input  type="radio"
                                    id="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>"
                                    name="CategoriaServicio" class="custom-control-input"
                                    value="<?php echo $segunda_categoria->ID_CATEGORIA; ?>"
                                    >
                            <label class="custom-control-label h6" for="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>">-<?php echo $segunda_categoria->CATEGORIA_NOMBRE; ?></label>
                          </div>
                      </div>
                      <?php $tercero_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'',''); ?>
                      <ul class="list list-unstyled">
                        <?php foreach($tercero_categorias as $tercera_categoria){ ?>
                        <li>
                          <div class="custom-control custom-radio">
                            <input  type="radio"
                                    id="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
                                    name="CategoriaServicio" class="custom-control-input"
                                    value="<?php echo $tercera_categoria->ID_CATEGORIA; ?>"

                                    >
                            <label class="custom-control-label" for="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>">-<?php echo $tercera_categoria->CATEGORIA_NOMBRE; ?></label>
                          </div>
                        </li>
                      <?php } ?>
                      </ul>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <span class="fa fa-file-alt"></span> Descripción
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">


                  <div class="form-group">
                    <<label for="DetallesServicio"><?php echo $this->lang->line('usuario_form_servicio_descripcion_detallada'); ?></label>
                    <textarea class="form-control Editor" name="DetallesServicio" rows="5" cols="80"><?php echo set_value('DetallesServicio'); ?></textarea>
                  </div>


                </div>
              </div>
            </div>
          </div>

          <div class="card mt-3">
            <div class="card-body">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                 <label class="custom-control-label" for="TerminosyCondiciones"><?php echo $this->lang->line('usuario_formulario_registro_terminos_y_condiciones'); ?></label>
              </div>
              <hr>
              <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-save"></i><?php echo $this->lang->line('usuario_form_servicio_crear_servicio'); ?></button>
            </div>
          </div>

        </form>
        <div class="card mb-3">
          <div class="card-body">
            <h6> <i class="fa fa-exclamation"></i> <?php echo $this->lang->line('usuario_form_servicio_anexos_antes'); ?></h6>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Modal de flujos -->

<!-- Modal -->
<div class="modal fade" id="ModalAyuda" tabindex="-1" role="dialog" aria-labelledby="ModalAyuda" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-question-circle"></i> Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">

          <div class="linea-colores-delgada">
            <div class="barra-color barra-azul"></div>
            <div class="barra-color barra-rosa"></div>
            <div class="barra-color barra-amarillo"></div>
            <div class="barra-color barra-verde"></div>
            <div class="barra-color barra-morado"></div>
          </div>
        <!-- Slider Ayuda-->
        <div id="carouselAyuda" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselAyuda" data-slide-to="0" class="active"></li>
            <li data-target="#carouselAyuda" data-slide-to="1"></li>
            <li data-target="#carouselAyuda" data-slide-to="2"></li>
            <li data-target="#carouselAyuda" data-slide-to="3"></li>
            <li data-target="#carouselAyuda" data-slide-to="4"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo5.1.png'); ?>" alt="Registro paso 1">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo5.2.png'); ?>" alt="Registro paso 2">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo5.3.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo5.4.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo5.5.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo5.6.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo5.7.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo5.8.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo5.9.png'); ?>" alt="Registro paso 4">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselAyuda" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselAyuda" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
