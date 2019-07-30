<?php
  if(isset($categoria['CATEGORIA_NOMBRE'])){
    $titulo_categoria = $categoria['CATEGORIA_NOMBRE'];
  }else{
    $titulo_categoria = 'TODOS LOS SERVICIOS';
  }
  if(isset($_GET['Busqueda'])){
    $titulo_categoria = 'Resultados para tu Busqueda';
  }

?>
<div class="contenido_principal fila p-3" style="background:#eee;">
  <div class="container">
    <div class="row">
      <div class="fila">
        <h1 class="h3 border-bottom pb-3"> <i class="fa fa-tools"></i> <?php echo $titulo_categoria; ?></h1>
      </div>
    </div>
    <div class="row">
      <div class="col-2 d-none d-sm-block fila filtro-cont">
        <form class="" action="<?php echo base_url($origen_formulario) ?>" method="get">
          <?php if($origen_formulario=='categoria'&&!empty($categoria)){ ?>
            <input type="hidden" name="slug" value="<?php echo $categoria['CATEGORIA_URL']; ?>">
          <?php } ?>
          <input type="hidden" name="Busqueda" value="<?php if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){ echo filter_var ( $_GET['Busqueda'], FILTER_SANITIZE_STRING); } ?>">
          <?php if(!isset($categoria['CATEGORIA_TIPO'])){ ?>
          <input type="hidden" name="BuscarEn" value="<?php if(isset($_GET['BuscarEn'])){ echo $_GET['BuscarEn']; }else{ echo 'servicios'; }; ?>">
        <?php }else{ ?>
          <input type="hidden" name="BuscarEn" value="<?php if(isset($_GET['BuscarEn'])){ echo $_GET['BuscarEn']; }else{ echo $categoria['CATEGORIA_TIPO']; }; ?>">
        <?php } ?>
          <div class="contenedor-filtros">
            <select class="custom-select filtro-sel" name="OrdenBusqueda">
              <option value="" selected><?php echo $this->lang->line('filtro_categoria_productos_ordenar_por'); ?></option>
              <option value="alfabetico_asc" <?php if(isset($_GET['OrdenBusqueda'])&&$_GET['OrdenBusqueda']=='alfabetico_asc'){ echo 'selected'; } ?>><?php echo $this->lang->line('filtro_categoria_servicios_alfabetico_asc'); ?></option>
              <option value="alfabetico_desc" <?php if(isset($_GET['OrdenBusqueda'])&&$_GET['OrdenBusqueda']=='alfabetico_desc'){ echo 'selected'; } ?>><?php echo $this->lang->line('filtro_categoria_servicios_alfabetico_desc'); ?></option>
              <option value="calificacion_desc" <?php if(isset($_GET['OrdenBusqueda'])&&$_GET['OrdenBusqueda']=='calificacion_desc'){ echo 'selected'; } ?>><?php echo $this->lang->line('filtro_categoria_servicios_calificacion_desc'); ?></option>
            </select>
            <hr>
            <select class="custom-select filtro-sel" name="TipoServicio">
              <option value="cualquiera" <?php if(isset($_GET['TipoServicio'])&&$_GET['TipoServicio']=='cualquiera'){ echo 'selected'; } ?>><?php echo $this->lang->line('filtro_categoria_servicios_tipo'); ?></option>
              <option value="profesional" <?php if(isset($_GET['TipoServicio'])&&$_GET['TipoServicio']=='profesional'){ echo 'selected'; } ?>><?php echo $this->lang->line('filtro_categoria_servicios_presenciales'); ?></option>
              <option value="digital" <?php if(isset($_GET['TipoServicio'])&&$_GET['TipoServicio']=='digital'){ echo 'selected'; } ?>><?php echo $this->lang->line('filtro_categoria_servicios_digitales'); ?></option>
            </select>
            <hr>
            <select class="custom-select filtro-sel" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php if(isset($_GET['PaisDireccion'])){ echo $_GET['PaisDireccion']; }; ?>">
              <option value=""><?php echo $this->lang->line('usuario_form_direcciones_pais_selecciona'); ?></option>
            </select>
            <hr>
            <select class="custom-select filtro-sel" style="font-size:14px;" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php if(isset($_GET['EstadoDireccion'])){ echo $_GET['EstadoDireccion']; }; ?>" >
              <option value=""><?php echo $this->lang->line('usuario_form_direcciones_estado_selecciona'); ?></option>
            </select>
            <hr>
            <select class="custom-select filtro-sel" style="font-size:13px;" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php if(isset($_GET['MunicipioDireccion'])){ echo $_GET['MunicipioDireccion']; }; ?>">
              <option value=""><?php echo $this->lang->line('usuario_form_direcciones_municipio_selecciona'); ?></option>
            </select>
          <hr>
          <button type="submit" class="btn btn<?php echo $primary; ?> btn-block" ><?php echo $this->lang->line('filtro_categoria_productos_filtrar'); ?></button>
          </div>
          </form>
        </div>
      <div class="col">
        <div class="card-deck">
          <?php $hay_servicios = false;
           if(empty($servicios)&&isset($categoria)){
              // Busco categorías hijas
        			$categorias_segundo_nivel = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria['ID_CATEGORIA']],'servicios','','');
              foreach ($categorias_segundo_nivel as $categoria_segunda){
                $servicios_segundo = $this->ServiciosModel->lista_categoria_activos($parametros_or,$parametros_and,$categoria_segunda->ID_CATEGORIA,$orden,'');
                if(!empty($servicios_segundo)) {
                  $hay_servicios = true;
                  $servicios = array_merge($servicios, $servicios_segundo);
                }

              $categorias_tercer_nivel = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria_segunda->ID_CATEGORIA],'servicios','','');

              foreach ($categorias_tercer_nivel as $categoria_tercera){
                $servicios_tercer = $this->ServiciosModel->lista_categoria_activos($parametros_or,$parametros_and,$categoria_tercera->ID_CATEGORIA,$orden,'');
                if(!empty($servicios_tercer)) {
                  $hay_servicios = true;
                  $servicios = array_merge($servicios, $servicios_tercer);
                }


            } // Categorias de Tercer nivel
            } // Categorias de Segundo Nivel
           }else{  $hay_servicios = true; }
           ?>
           <!-- CUADRICULA DE SERVICIOS -->
           <?php foreach($servicios as $servicio){ ?>
                <?php
                  // Variables de Traducción
                  if($_SESSION['lenguaje']['iso']==$servicio->LENGUAJE){
                    $titulo = $servicio->SERVICIO_NOMBRE;
                    $descripcion_corta = $servicio->SERVICIO_DESCRIPCION;
                  }else{
                    $traduccion = $this->TraduccionesModel->lista($servicio->ID_SERVICIO,'servicio',$_SESSION['lenguaje']['iso']);
                    if(!empty($traduccion)){
                      $titulo = $traduccion['TITULO'];
                      $descripcion_corta = $traduccion['DESCRIPCION_CORTA'];
                    }else{
                      $titulo = $servicio->SERVICIO_NOMBRE;
                      $descripcion_corta = $servicio->SERVICIO_DESCRIPCION;
                    }
                  }
                  // Variables de Paquete
                  $paquete = $this->PlanesModel->plan_activo_usuario($servicio->ID_USUARIO,'servicios');
                  if($paquete==null){
                    $visible = 'd-none';
                  }else{
                    $visible = '';
                  }
                ?>
                <div class="<?php if($paquete['PLAN_NIVEL']>=2){ ?> col-md-4 <?php }else{ ?> col-md-3 <?php } ?>col-6 mb-3 <?php echo $visible; ?>">
                  <?php if($paquete['PLAN_NIVEL']>=2){ ?>

                      <a href="<?php echo base_url('servicio?id='.$servicio->ID_SERVICIO); ?>" >
                  <?php }else{ ?>

                    <a href="#"   data-toggle="modal" data-target="#modal<?php echo $servicio->ID_SERVICIO; ?>">
                  <?php } ?>
                  <div class="cuadricula-productos border border<?php echo $primary; ?>">
                    <?php $galeria = $this->GaleriasServiciosModel->galeria_portada($servicio->ID_SERVICIO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                    <div class="mx-2 p-3">
                        <div class="portada-servicios img-thumbnail rounded-circle" style="background-image:url(<?php echo base_url($ruta_portada); ?>)"> </div>
                    </div>
                      <div class="product-content text-center">
                        <?php
                        $promedio = $this->CalificacionesServiciosModel->promedio_calificaciones_producto($servicio->ID_SERVICIO);
                        $cantidad = $this->CalificacionesServiciosModel->conteo_calificaciones_producto($servicio->ID_SERVICIO);
                        ?>
                          <ul class="rating">
                            <?php $estrellas = round($promedio['CALIFICACION_ESTRELLAS']); $estrellas_restan= 5-$estrellas; ?>
                            <?php for($i = 1; $i<=$estrellas; $i++){ ?>
                              <li class="fa fa-star"></li>
                            <?php } ?>
                            <?php for($i = 1; $i<=$estrellas_restan; $i++){ ?>
                              <li class="far fa-star"></li>
                            <?php } ?>
                            <li class="text-dark">(<?php echo $cantidad; ?> calif)</li>
                          </ul>
                          <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h3>
                          <div class="">
                            <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                              <a href="<?php echo base_url('servicio/favorito?id='.$servicio->ID_SERVICIO); ?>" class="btn btn-outline<?php echo $primary; ?>" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                            <?php }else{ ?>
                              <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$servicio->ID_SERVICIO)); ?>" class="btn btn-outline<?php echo $primary; ?>" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                            <?php } ?>
                          </div>
                          <div class="text-center">
                            <?php if($servicio->SERVICIO_TIPO=='digital'){ ?>
                              <h5><span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio" style="padding:5px;"><?php echo $this->lang->line('pagina_servicio_digital'); ?></span></h5>
                            <?php }else{ ?>
                              <h5><span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio" style="padding:5px;"><?php echo $this->lang->line('pagina_servicio_profesional'); ?></span></h5>
                            <?php } ?>
                          </div>
                      </div>
                  </div>
                </a>

                    <!-- Modal -->
                    <div class="modal fade" id="modal<?php echo $servicio->ID_SERVICIO; ?>" tabindex="-1" role="dialog" aria-labelledby="modal<?php echo $servicio->ID_SERVICIO; ?>" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-3">
                                <div class="img-thumbnail rounded-circle" style="width:100%; padding-top:100%; background-image:url(<?php echo base_url($ruta_portada); ?>); background-size:contain; background-repeat:no-repeat; background-position: center;"> </div>
                              </div>
                              <div class="col">
                                <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h3>
                                <div class="border-top mt-3 pt-3">
                                  <?php echo $descripcion_corta; ?>
                                </div>
                                <div class="pt-2 border-top">
                                  <?php if($servicio->SERVICIO_TIPO=='digital'){ ?>
                                    <h5><span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio" style="padding:5px;"><?php echo $this->lang->line('pagina_servicio_digital'); ?></span> <?php echo $this->lang->line('pagina_servicio_digital_descripcion'); ?></h5>
                                  <?php }else{ ?>
                                    <h5><span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio" style="padding:5px;"><?php echo $this->lang->line('pagina_servicio_profesional'); ?></span> <?php echo $this->lang->line('pagina_servicio_profesional_descripcion'); ?></h5>
                                  <?php } ?>
                                </div>
                                <hr>
                                <a href="<?php echo base_url('servicio/contacto?id='.$servicio->ID_SERVICIO); ?>" class="btn btn-primary btn-block"> <i class="fa fa-paper-plane"></i> Contactar</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
              </div>
            <?php } ?>
           <!-- /CUADRICULA DE SERVICIOS -->
          </div>
            <?php if(!$hay_servicios){ ?>
              <div class="border border-default p-3 text-center">
                <a href="<?php echo base_url('usuario/registrar'); ?>"><h3>Sé el primero en ofrecer servicios en esta categoría.</h3></a>
              </div>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
