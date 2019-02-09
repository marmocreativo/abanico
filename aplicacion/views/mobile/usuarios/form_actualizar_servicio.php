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
        <?php if(!empty(validation_errors())){ ?>
          <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
          </div>
        <?php } ?>
      <form class="" action="<?php echo base_url('usuario/servicios/actualizar');?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
        <input type="hidden" name="Identificador" value="<?php echo $_GET['id'] ?>">
        <div class="card mb-3">
          <div class="card-body">
              <?php $galeria = $this->GaleriasServiciosModel->galeria_portada($servicio['ID_SERVICIO']); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
              <span class="portada-servicios img-thumbnail rounded-circle" style="background-image:url('<?php echo base_url($ruta_portada); ?>');"> </span>
              <hr>
               <div class="form-group">
                 <label for="NombreUsuario">Nombre de la persona que Ofrece el servicio</label>
                 <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" required value="<?php echo $servicio['USUARIO_NOMBRE']; ?>">
               </div>
               <div class="form-group">
                 <label for="NombreServicio">¿Qué Servicio Ofreces?</label>
                 <input type="text" class="form-control" id="NombreServicio" name="NombreServicio" placeholder="" required value="<?php echo $servicio['SERVICIO_NOMBRE']; ?>">
               </div>
               <div class="form-group">
                 <label for="DescripcionServicio">Descripción Corta</label>
                  <textarea class="form-control" name="DescripcionServicio" rows="3" cols="80" required><?php echo $servicio['SERVICIO_DESCRIPCION']; ?></textarea>
               </div>

               <div class="form-group">
                 <label for="TipoServicio">Tipo de Servicio</label>
                 <select class="form-control" name="TipoServicio">
                   <option value="profesional" <?php if($servicio['SERVICIO_TIPO']=='normal'){ echo 'selected'; } ?>>Servicio Presencial</option>
                   <option value="digital" <?php if($servicio['SERVICIO_TIPO']=='digital'){ echo 'selected'; } ?>>Servicio a Distancia</option>
                 </select>
               </div>
               <p class="text-muted"> <i class="fa fa-info-circle"></i> Los Servicios a distancia, son los que se pueden ejercer a traves de internet.</p>

               <h6> <i class="fa fa-map-marker"></i> ¿En dónde ofreces tu servicio?</h6>

               <div class="form-group">
                 <label for="PaisDireccion">País </label>
                 <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo $servicio['SERVICIO_PAIS']; ?>" required>
                   <option value="">Selecciona un País</option>
                 </select>
               </div>

               <div class="form-group">
                 <label for="EstadoDireccion">Estado </label>
                 <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo $servicio['SERVICIO_ESTADO_DIR']; ?>" required>
                   <option value="">Selecciona tu estado</option>
                 </select>
               </div>
               <div class="form-group">
                 <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                 <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo $servicio['SERVICIO_MUNICIPIO']; ?>" required>
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
                                    <?php if($relacion_categorias['ID_CATEGORIA']==$segunda_categoria->ID_CATEGORIA){ echo 'checked'; } ?>
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
                                    <?php if($relacion_categorias['ID_CATEGORIA']==$tercera_categoria->ID_CATEGORIA){ echo 'checked'; } ?>
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
                    <label for="DetallesServicio">Descripción Detallada</label>
                    <textarea class="form-control Editor" name="DetallesServicio" rows="5" cols="80"><?php echo $servicio['SERVICIO_DETALLES']; ?></textarea>
                  </div>


                </div>
              </div>
            </div>
            // Galeria
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <span class="fa fa-file-alt"></span> Galería
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  <div class="form-group">
                    <label for="ImagenServicio">Añadir Imagen</label>
                    <input type="file" class="form-control" id="ImagenServicio" name="ImagenServicio">
                  </div>
                  <table class="table table-bordered table-sm table-responsive">
                    <thead>
                      <tr>
                        <th class="text-center">id</th>
                        <th class="text-center">Imagen</th>
                        <th class="text-center">Portada</th>
                        <th class="text-right">Controles</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($galerias as $galeria){ ?>
                        <tr>
                          <td class="text-center"><?php echo $galeria->ID_GALERIA; ?></td>
                          <td class="text-center">
                            <img src="<?php echo base_url($op['ruta_imagenes_servicios'].'completo/'.$galeria->GALERIA_ARCHIVO) ?>" alt="" width="50">
                          </td>
                          <td class="text-center">
                            <?php if($galeria->GALERIA_PORTADA=='si'){ ?>
                              <a href="<?php echo base_url('usuario/servicios/portada')."?id=".$galeria->ID_GALERIA."&id_servicio=".$galeria->ID_SERVICIO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                            <?php }else{ ?>
                              <a href="<?php echo base_url('usuario/servicios/portada')."?id=".$galeria->ID_GALERIA."&id_servicio=".$galeria->ID_SERVICIO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                            <?php } ?>
                          </td>
                          <td class="text-right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <a href="<?php echo base_url('usuario/servicios/borrar_galeria')."?id=".$galeria->ID_GALERIA."&id_servicio=".$galeria->ID_SERVICIO; ?>" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></a>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>

          <div class="card mt-3">
            <div class="card-body">
              <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-save"></i> Registrar Servicio</button>
            </div>
          </div>

        </form>
        <div class="card mb-3">
          <div class="card-body">
            <h6> <i class="fa fa-file"></i> Archivos Anexos</h6>
            <p class="text-muted">Añade cartas de recomendación diplomas o cualquier archivo que consideres que puede acreditar tu capacidad.</p>
            <hr>
            <table class="table table-sm table-responsive">
              <thead>
                <tr>
                  <th>Archivo</th>
                  <th>Controles</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($adjuntos as $adjunto){ ?>
                <tr>
                  <td>
                    <h6><?php echo $adjunto->ADJUNTO_NOMBRE; ?></h6>
                    <p><?php echo $adjunto->ADJUNTO_ARCHIVO; ?></p>
                  </td>
                  <td>
                    <div class="btn-group float-right">
                      <a href="<?php echo base_url('contenido/adjuntos/servicios/'.$adjunto->ADJUNTO_ARCHIVO); ?>" target="_blank" class="btn btn-sm btn-success" title="Descargar Archivo"> <span class="fa fa-download"></span> </a>
                      <button data-enlace='<?php echo base_url('usuario/servicios/borrar_adjunto?id='.$adjunto->ID_ADJUNTO); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Archivo"> <span class="fa fa-trash"></span> </button>
                    </div>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            <hr>
            <form class="" action="<?php echo base_url('usuario/servicios/subir_adjunto'); ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
              <input type="hidden" name="IdObjeto" value="<?php echo $_GET['id'] ?>">
              <div class="form-group">
                <label for="NombreAdjunto">Nombre / Descripción Adjunto</label>
                <textarea name="NombreAdjunto" class="form-control" rows="4" required></textarea>
              </div>
              <div class="form-group">
                <label for="ArchivoAdjunto">Archivo <small>Tipos de Archivo Permitidos: PDF, JPG, PNG</small></label>
                <input type="file" class="form-control" name="ArchivoAdjunto" value="">
              </div>
              <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-upload"></i> Subir Adjunto</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>