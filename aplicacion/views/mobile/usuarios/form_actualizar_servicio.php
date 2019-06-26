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
        <?php
          $productos_activo = null;
          $fotografias_producto = null;
          $servicios_activos = null;
          $fotografias_servicios = null;
          $anexos = false;
          $plan = $this->PlanesModel->plan_activo_usuario($_SESSION['usuario']['id'],'servicios');
          if(!empty($plan)){
            $productos_activo = $plan['PLAN_LIMITE_PRODUCTOS'];
            $fotografias_producto = $plan['PLAN_FOTOS_PRODUCTOS'];
            $servicios_activos = $plan['PLAN_LIMITE_SERVICIOS'];
            $fotografias_servicios = $plan['PLAN_FOTOS_SERVICIOS'];
            if($plan['PLAN_NIVEL']>1){
              $anexos = true;
            }
          }
        ?>
      <form class="" action="<?php echo base_url('usuario/servicios/actualizar');?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
        <input type="hidden" name="Identificador" value="<?php echo $_GET['id'] ?>">
        <div class="card mb-3">
          <div class="card-body">
              <?php $galeria = $this->GaleriasServiciosModel->galeria_portada($servicio['ID_SERVICIO']); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
              <div class="text-center">
                <span class="portada-servicios img-fluid img-thumbnail rounded-circle" style="display:block; width:150px; height:150px; background-size: cover; margin: 0 auto; background-image:url('<?php echo base_url($ruta_portada); ?>');"> </span>
              </div>
              <hr>
               <div class="form-group">
                 <label for="NombreUsuario"><?php echo $this->lang->line('usuario_form_servicio_nombre_persona'); ?></label>
                 <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" placeholder="" required value="<?php echo $servicio['USUARIO_NOMBRE']; ?>">
               </div>
               <div class="form-group">
                 <label for="NombreServicio"><?php echo $this->lang->line('usuario_form_servicio_nombre_servicio'); ?></label>
                 <input type="text" class="form-control" id="NombreServicio" name="NombreServicio" placeholder="" required value="<?php echo $servicio['SERVICIO_NOMBRE']; ?>">
               </div>
               <div class="form-group">
                 <label for="DescripcionServicio"><?php echo $this->lang->line('usuario_form_servicio_descripcion_corta'); ?></label>
                  <textarea class="form-control" name="DescripcionServicio" rows="3" cols="80" required><?php echo $servicio['SERVICIO_DESCRIPCION']; ?></textarea>
               </div>

               <div class="form-group">
                 <label for="TipoServicio"><?php echo $this->lang->line('usuario_form_servicio_tipo'); ?></label>
                 <select class="form-control" name="TipoServicio">
                   <option value="profesional" <?php if($servicio['SERVICIO_TIPO']=='normal'){ echo 'selected'; } ?>><?php echo $this->lang->line('usuario_form_servicio_tipo_presencial'); ?></option>
                   <option value="digital" <?php if($servicio['SERVICIO_TIPO']=='digital'){ echo 'selected'; } ?>><?php echo $this->lang->line('usuario_form_servicio_tipo_distancia'); ?></option>
                 </select>
               </div>
               <p class="text-muted"> <i class="fa fa-info-circle"></i> <?php echo $this->lang->line('usuario_form_servicio_tipo_distancia_instrucciones'); ?></p>

               <h6> <i class="fa fa-map-marker"></i> <?php echo $this->lang->line('usuario_form_servicio_zona_instrucciones'); ?></h6>

               <div class="form-group">
                 <label for="PaisDireccion"><?php echo $this->lang->line('usuario_form_direcciones_pais'); ?> </label>
                 <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo $servicio['SERVICIO_PAIS']; ?>" required>
                   <option value=""><?php echo $this->lang->line('usuario_form_direcciones_pais_selecciona'); ?></option>
                 </select>
               </div>

               <div class="form-group">
                 <label for="EstadoDireccion"><?php echo $this->lang->line('usuario_form_direcciones_estado'); ?> </label>
                 <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo $servicio['SERVICIO_ESTADO_DIR']; ?>" required>
                   <option value=""><?php echo $this->lang->line('usuario_form_direcciones_estado_selecciona'); ?></option>
                 </select>
               </div>
               <div class="form-group">
                 <label for="MunicipioDireccion"><?php echo $this->lang->line('usuario_form_direcciones_municipio'); ?></label>
                 <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo $servicio['SERVICIO_MUNICIPIO']; ?>" required>
                   <option value=""><?php echo $this->lang->line('usuario_form_direcciones_municipio_selecciona'); ?></option>
                 </select>
               </div>
               <div class="form-group">
                 <label for="ZonaTrabajoServicio"><?php echo $this->lang->line('usuario_form_servicio_zona'); ?> <small><?php echo $this->lang->line('usuario_form_servicio_zona_descripcion'); ?></small></label>
                 <textarea name="ZonaTrabajoServicio" class="form-control" rows="6"><?php echo $servicio['SERVICIO_ZONA_TRABAJO']; ?></textarea>
               </div>
            </div>
          </div>


          <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <span class="fa fa-list"></span> <?php echo $this->lang->line('usuario_form_servicio_categorias'); ?>
                  </button>
                </h2>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <?php foreach($categorias as $categoria){ ?>
                  <div class="mb-3 pb-2">
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
                    <span class="fa fa-file-alt"></span> <?php echo $this->lang->line('usuario_form_servicio_descripcion'); ?>
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">


                  <div class="form-group">
                    <label for="DetallesServicio"><?php echo $this->lang->line('usuario_form_servicio_descripcion_detallada'); ?></label>
                    <textarea class="form-control Editor" name="DetallesServicio" rows="5" cols="80"><?php echo $servicio['SERVICIO_DETALLES']; ?></textarea>
                  </div>


                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <span class="fa fa-file-alt"></span> <?php echo $this->lang->line('usuario_form_servicio_galeria'); ?>
                  </button>
                </h2>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                  <?php
                    $cantidad_imagenes = count($galerias);
                  ?>
                  <?php if($fotografias_servicios!=null&&($fotografias_servicios>$cantidad_imagenes||$fotografias_producto==0)){ ?>

                  <div class="form-group">
                    <label for="ImagenProducto"><?php echo $this->lang->line('usuario_form_producto_nueva_imagen'); ?></label>
                    <input type="file" class="form-control" id="ImagenServicio" name="ImagenServicio">
                  </div>

                <?php }else{ ?>
                  <p class="text-danger">Límite de imágenes alcanzado</p>
                <?php } ?>
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th class="text-center"><?php echo $this->lang->line('usuario_form_producto_lista_imagen_id'); ?></th>
                        <th class="text-center"><?php echo $this->lang->line('usuario_form_producto_lista_imagen'); ?></th>
                        <th class="text-center"><?php echo $this->lang->line('usuario_form_producto_lista_imagen_portada'); ?></th>
                        <th class="text-right"><?php echo $this->lang->line('usuario_listas_generales_controles'); ?></th>
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

          <div class="card mt-3 mb-3">
            <div class="card-body">
              <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-save"></i>  <?php echo $this->lang->line('usuario_form_servicio_actualizar_servicio'); ?></button>
            </div>
          </div>

        </form>
        <div class="card mb-3">
          <div class="card-body">
            <?php if($anexos){ ?>
            <h6> <i class="fa fa-file"></i> <?php echo $this->lang->line('usuario_form_servicio_anexos_titulo'); ?></h6>
            <p class="text-muted"><?php echo $this->lang->line('usuario_form_servicio_anexos_instrucciones'); ?></p>
            <hr>
            <table class="table table-sm table-responsive">
              <thead>
                <tr>
                  <th><?php echo $this->lang->line('usuario_form_servicio_anexos_archivo'); ?></th>
                  <th><th class="text-right"><?php echo $this->lang->line('usuario_listas_generales_controles'); ?></th></th>
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
            <?php
              $cantidad_anexos = count($adjuntos);
            ?>
            <?php if($fotografias_servicios!=null&&($fotografias_servicios>$cantidad_anexos||$fotografias_producto==0)){ ?>
            <hr>
            <form class="" action="<?php echo base_url('usuario/servicios/subir_adjunto'); ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
              <input type="hidden" name="IdObjeto" value="<?php echo $_GET['id'] ?>">
              <div class="form-group">
                <label for="NombreAdjunto"><?php echo $this->lang->line('usuario_form_servicio_anexos_nombre_descripcion'); ?></label>
                <textarea name="NombreAdjunto" class="form-control form-control-sm" rows="4" required></textarea>
              </div>
              <div class="form-group">
                <label for="ArchivoAdjunto"><?php echo $this->lang->line('usuario_form_servicio_anexos_archivo'); ?> <small><?php echo $this->lang->line('usuario_form_servicio_anexos_archivo_instrucciones'); ?></small></label>
                <input type="file" class="form-control form-control-sm" name="ArchivoAdjunto" value="">
              </div>
              <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-upload"></i> <?php echo $this->lang->line('usuario_form_servicio_anexos_archivo_subir'); ?></button>
            </form>
          <?php }else{ ?>
            <p class="text-danger">Límite de anexos alcanzado</p>
          <?php } ?>
        <?php }else{ ?>
          <p class="text-danger">Tu plan no permite subir anexos</p>
        <?php } ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
