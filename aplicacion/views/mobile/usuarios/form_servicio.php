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

      <div class="card card-info mb-3">
        <div class="card-body">
          <h5>Reglas de Servicios Personales</h5>
          <ul class="pl-3">
            <li>Los servicios están sometidos a un tiempo de revisión antes de que se vean publicados en el sitio.</li>
            <li>Aunque el servicio se le puede asignar un Nombre específico son responsabilidad del usuario que los da de alta.</li>
            <li>Por favor manten tu información personal siempre actualizada</li>
          </ul>
        </div>
      </div>

      <div class="card mb-3">
        <div class="card-body">
          <h6> <i class="fa fa-exclamation"></i> Primero debes guardar tu servicio para poder Adjuntar Archivos</h6>
        </div>
      </div>

      <form class="" action="" method="post" enctype="multipart/form-data">

        <div class="card mb-3">
          <div class="card-body">
              <img class="img-fluid img-thumbnail mx-auto mb-3 d-block rounded-circle" style="width:150px" src="http://localhost/abanico-master/contenido/img/servicios/completo/default.jpg" alt="" >
              <div class="custom-file file-sm mb-3">
                <input type="file" class="custom-file-input" id="ImagenServicio" name="ImagenServicio" placeholder="" value="">
                <label class="custom-file-label" for="ImagenServicio">Fotografía</label>
              </div>
               <div class="form-group">
                 <label for="NombreUsuario">Nombre de la persona que Ofrece el servicio</label>
                 <input type="text" class="form-control form-control-sm" id="NombreUsuario" name="NombreUsuario" placeholder="" required="" value="antonio gutierrez">
               </div>
               <div class="form-group">
                 <label for="NombreServicio">¿Qué Servicio Ofreces?</label>
                 <input type="text" class="form-control form-control-sm" id="NombreServicio" name="NombreServicio" placeholder="" required="" value="">
               </div>
               <div class="form-group">
                 <label for="DescripcionServicio">Descripción Corta</label>
                 <textarea class="form-control form-control-sm" name="DescripcionServicio" rows="3" cols="80" required=""></textarea>
               </div>

               <div class="form-group">
                 <label for="TipoServicio">Tipo de Servicio</label>
                 <select class="form-control form-control-sm" name="TipoServicio">
                   <option value="profesional">Servicio Presencial</option>
                   <option value="digital">Servicio a Distancia</option>
                 </select>
               </div>
               <p class="text-muted"> <i class="fa fa-info-circle"></i> Los Servicios a distancia, son los que se pueden ejercer a traves de internet.</p>

               <h6> <i class="fa fa-map-marker"></i> ¿En dónde ofreces tu servicio?</h6>

               <div class="form-group">
                 <label for="PaisDireccion">País </label>
                 <select class="form-control form-control-sm" name="PaisDireccion" id="PaisDireccion" required="">
                   <option value="">Selecciona un País</option>
                 <option value="México" data-id="1">México</option><option value="Estados Unidos" data-id="2">Estados Unidos</option></select>
               </div>

               <div class="form-group">
                 <label for="EstadoDireccion">Estado </label>
                 <select class="form-control form-control-sm" name="EstadoDireccion" id="EstadoDireccion" required="">
                   <option value="">Selecciona tu estado</option>
                 </select>
               </div>
               <div class="form-group">
                 <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                 <select class="form-control form-control-sm" name="MunicipioDireccion" id="MunicipioDireccion" required="">
                   <option value="">Selecciona tu Municipio / Alcaldía</option>
                 </select>
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

                  <div class="">
                    <h6 class="pb-3">Ingeniería y Construcción</h6>
                    <div class="row">
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Eléctrica y Electrónica</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Ingeniería Civil</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Ingeniería Ambiental</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Computación</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Ingeniería Mecánica</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Ingeniería Industrial</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Instalaciones </label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Obras</label>
                          </div>
                      </div>
                    </div>
                  </div>

                  <hr>

                  <div class="">
                    <h6 class="pb-3">Ingeniería y Construcción</h6>
                    <div class="row">
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Eléctrico</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Plomería</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Cerrajería</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Albañilería</label>
                          </div>
                      </div>
                    </div>
                  </div>

                  <hr>

                  <div class="">
                    <h6 class="pb-3">Mecánicos y Automotrices</h6>
                  </div>

                  <hr>

                  <div class="">
                    <h6 class="pb-3">Administración</h6>
                  </div>

                  <hr>

                  <div class="">
                    <h6 class="pb-3">Arte y entretenimiento</h6>
                    <div class="row">
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Actores</label>
                          </div>
                      </div>
                    </div>
                  </div>

                  <hr>

                  <div class="">
                    <h6 class="pb-3">Salud</h6>
                    <div class="row">
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Pediatra</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Dermatología</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Psicología</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Ginecología</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Dentista</label>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="" name="" class="custom-control-input" value="" required="">
                            <label class="custom-control-label h6" for="">Ortopedista</label>
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
                    <span class="fa fa-file-alt"></span> Descripción
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">


                  <div class="form-group">
                    <label for="DetallesServicio">Descripción Detallada</label>
                    <textarea class="form-control Editor" name="" rows="5" cols="80"><?php echo set_value('DetallesServicio'); ?></textarea>
                  </div>


                </div>
              </div>
            </div>
          </div>

          <div class="card mt-3">
            <div class="card-body">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                <label class="custom-control-label" for="TerminosyCondiciones">Acepto los términos y condiciones de los Servicios</label>
              </div>
              <hr>
              <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-save"></i> Registrar Servicio</button>
            </div>
          </div>

        </form>

      </div>

    </div>
  </div>
</div>

<hr><hr><hr>

<!-- termina panel usuario resposivo -->

<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h5> <i class="fa fa-tools"></i> Nuevo Servicio</h5>
            </div>
            <div class="card-body p-3">
              <form class="" action="<?php echo base_url('usuario/servicios/crear');?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
              <div class="row">
              <div class="col-8">
                  <div class="card card-info mb-3">
                    <div class="card-body">
                      <h5>Reglas de Servicios Personales.</h5>
                      <ul>
                        <li>Los servicios están sometidos a un tiempo de revisión antes de que se vean publicados en el sitio.</li>
                        <li>Aunque el servicio se le puede asignar un Nombre específico son responsabilidad del usuario que los da de alta.</li>
                        <li>Por favor manten tu información personal siempre actualizada</li>
                      </ul>
                    </div>
                  </div>
                  <?php if(!empty(validation_errors())){ ?>
                    <div class="alert alert-danger">
                      <?php echo validation_errors(); ?>
                    </div>
                  <?php } ?>
                    <div class="row">
                      <div class="col-3">
                        <img src="<?php echo base_url('contenido/img/servicios/completo/default.jpg') ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                        <hr>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="ImagenServicio" name="ImagenServicio" placeholder="" value="">
                          <label class="custom-file-label" for="ImagenServicio">Fotografía</label>
                        </div>
                      </div>
                      <div class="col">
                         <div class="form-group">
                           <label for="NombreUsuario">Nombre de la persona que Ofrece el servicio</label>
                           <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" required value="<?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?>">
                         </div>
                         <div class="form-group">
                           <label for="NombreServicio">¿Qué Servicio Ofreces?</label>
                           <input type="text" class="form-control" id="NombreServicio" name="NombreServicio" placeholder="" required value="<?php echo set_value('NombreServicio'); ?>">
                         </div>
                         <div class="form-group">
                           <label for="DescripcionServicio">Descripción Corta</label>
                           <textarea class="form-control" name="DescripcionServicio" rows="3" cols="80" required><?php echo set_value('DescripcionServicio'); ?></textarea>
                         </div>
                         <hr>
                         <div class="row">
                           <div class="col">
                             <div class="form-group">
                               <label for="TipoServicio">Tipo de Servicio</label>
                               <select class="form-control" name="TipoServicio">
                                 <option value="profesional">Servicio Presencial</option>
                                 <option value="digital">Servicio a Distancia</option>
                               </select>
                             </div>
                             <p class="text-muted"> <i class="fa fa-info-circle"></i> Los Servicios a distancia, son los que se pueden ejercer a traves de internet.</p>
                           </div>
                         </div>
                         <h6> <i class="fa fa-map-marker"></i> ¿En dónde ofreces tu servicio?</h6>
                         <div class="row">
                           <div class="col">
                             <div class="form-group">
                               <label for="PaisDireccion">País </label>
                               <select class="form-control" name="PaisDireccion" id="PaisDireccion" required>
                                 <option value="">Selecciona un País</option>
                               </select>
                             </div>
                           </div>
                           <div class="col">
                             <div class="form-group">
                               <label for="EstadoDireccion">Estado </label>
                               <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" required>
                                 <option value="">Selecciona tu estado</option>
                               </select>
                             </div>
                           </div>
                           <div class="col">
                             <div class="form-group">
                               <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                               <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" required>
                                 <option value="">Selecciona tu Municipio / Alcaldía</option>
                               </select>
                             </div>
                           </div>
                         </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col">
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="categoria-tab" data-toggle="tab" href="#categoria" role="tab" aria-controls="categoria" aria-selected="false"> <span class="fa fa-list"></span> Categorias</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="true"> <span class="fa fa-file-alt"></span> Descripción</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active  p-3" id="categoria" role="tabpanel" aria-labelledby="datos-tab">
                            <div class="row">
                                <?php foreach($categorias as $categoria){ ?>
                                    <div class="col-12 border border-default p-3">
                                      <h6 class="border-bottom pb-3"><?php echo $categoria->CATEGORIA_NOMBRE; ?></h6>
                                      <?php $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
                                      <div class="row">
                                      <?php foreach($segundo_categorias as $segunda_categoria){ ?>
                                        <div class="col-4">
                                          <div class="border border-default p-3">
                                          <div class="custom-control custom-radio">
                                            <input  type="radio"
                                                    id="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>"
                                                    name="CategoriaServicio" class="custom-control-input"
                                                    value="<?php echo $segunda_categoria->ID_CATEGORIA; ?>"
                                                    required
                                                    >
                                            <label class="custom-control-label h6" for="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>">-<?php echo $segunda_categoria->CATEGORIA_NOMBRE; ?></label>
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
                          <div class="tab-pane fade p-3" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                              <div class="form-group">
                                <label for="DetallesServicio">Descripción Detallada</label>
                                <textarea class="form-control Editor" name="DetallesServicio" rows="5" cols="80"><?php echo set_value('DetallesServicio'); ?></textarea>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                   <hr>
                    <div class="custom-control custom-checkbox">
                       <input type="checkbox" class="custom-control-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                       <label class="custom-control-label" for="TerminosyCondiciones">Acepto los términos y condiciones de los Servicios</label>
                     </div>
                    <hr>
                    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Registrar Servicio</button>
              </div>
              <div class="col-4">
                <div class="card border">
                  <div class="card-body">
                    <h6> <i class="fa fa-exclamation"></i> Primero debes guardar tu servicio para poder Adjuntar Archivos</h6>
                  </div>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
