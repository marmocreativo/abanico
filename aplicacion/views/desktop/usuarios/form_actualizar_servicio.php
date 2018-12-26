<?php if(isset($_GET['tab'])){ $tab = $_GET['tab']; } else { $tab='categoria'; } ?>
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
            <div class="card-body">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <form class="" action="<?php echo base_url('usuario/servicios/actualizar');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
                <input type="hidden" name="Identificador" value="<?php echo $_GET['id'] ?>">
                <div class="row">
                  <div class="col-3">
                    <?php $galeria = $this->GaleriasServiciosModel->galeria_portada($servicio['ID_SERVICIO']); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                    <span class="portada-servicios img-thumbnail rounded-circle" style="background-image:url('<?php echo base_url($ruta_portada); ?>');"> </span>
                    <hr>
                  </div>
                  <div class="col">
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
                     <hr>
                     <h6> <i class="fa fa-map-marker"></i> ¿En dónde ofreces tu servicio?</h6>
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="PaisDireccion">País </label>
                           <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo $servicio['SERVICIO_PAIS']; ?>" required>
                             <option value="">Selecciona un País</option>
                           </select>
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="EstadoDireccion">Estado </label>
                           <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo $servicio['SERVICIO_ESTADO_DIR']; ?>" required>
                             <option value="">Selecciona tu estado</option>
                           </select>
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                           <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo $servicio['SERVICIO_MUNICIPIO']; ?>" required>
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
                      <li class="nav-item">
                        <a class="nav-link" id="galeria-tab" data-toggle="tab" href="#galeria" role="tab" aria-controls="galeria" aria-selected="true"> <span class="fa fa-picture"></span> Galeria</a>
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
                                      <h6 class="border-bottom pb-3"><?php echo $segunda_categoria->CATEGORIA_NOMBRE; ?></h6>
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
                            <textarea class="form-control Editor" name="DetallesServicio" rows="5" cols="80"><?php echo $servicio['SERVICIO_DETALLES']; ?></textarea>
                          </div>
                      </div>
                      <div class="tab-pane fade <?php if($tab=='galeria'){ echo 'show active'; } ?> p-3" id="galeria" role="tabpanel" aria-labelledby="extras-tab">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="ImagenServicio">Añadir Imagen</label>
                              <input type="file" class="form-control" id="ImagenServicio" name="ImagenServicio">
                            </div>
                            <table class="table table-bordered table-sm">
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
                  </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Actualizar Servicio</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>