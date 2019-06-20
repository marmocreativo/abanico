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

<div class="bxInfoContent clr1 py-4">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="col-12">
          <ol class="breadcrumb vistaMovil">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('categoria_productos_migas_inicio'); ?></a></li>
            <li class="breadcrumb-item active text-primary " aria-current="page"><?php echo $categoria['CATEGORIA_NOMBRE']; ?></li>
          </ol>
        </div>
      </div>
      <div class="col-12 mb-3">
        <h3><?php echo $categoria['CATEGORIA_NOMBRE']; ?></h3>
        <div class="card" style="background-color:transparent;">
          <?php   $sub_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria['ID_CATEGORIA']],$categoria['CATEGORIA_TIPO'],'','');?>
          <?php if(!empty($sub_categorias)){ ?>
            <button class="btn btn-outline<?php echo $categoria['CATEGORIA_COLOR']; ?> btn-sm" type="button" data-toggle="collapse" data-target="#collapseCategorias" aria-expanded="false" aria-controls="collapseExample">
              <i class="fas fa-th mr-2"></i>Subcategorias
            </button>
            <div class="collapse" id="collapseCategorias">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <?php $i=0; foreach($sub_categorias as $sub_categoria){ ?>
                    <?php
                      // Variables de traducción
                      if($_SESSION['lenguaje']['iso']=='es'){
                        $titulo = $sub_categoria->CATEGORIA_NOMBRE;
                      }else{
                        $traduccion = $this->TraduccionesModel->lista($sub_categoria->ID_CATEGORIA,'categoria',$_SESSION['lenguaje']['iso']);
                        if(!empty($traduccion['TITULO'])){
                          $titulo = $traduccion['TITULO'];
                        }else{
                          $titulo = $sub_categoria->CATEGORIA_NOMBRE;
                        }
                      }
                    ?>
                  <a class="nav-link text<?php echo $sub_categoria->CATEGORIA_COLOR; ?>" id="menu-categoria-<?php echo $sub_categoria->ID_CATEGORIA; ?>" href="<?php echo base_url('categoria?slug='.$sub_categoria->CATEGORIA_URL); ?>">
                  <?php echo $titulo; ?>
                  </a>
                  <?php ++$i;  } ?>
               </div>
            </div>
            <hr>
          <?php } ?>

          <button class="btn btnFiltros btn<?php echo $primary; ?> btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="fas fa-sliders-h mr-2"></i>Filtros
          </button>
          <div class="collapse" id="collapseExample">
            <div class="p-3">
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
                  <select class="custom-select filtro-sel" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php if(isset($_GET['EstadoDireccion'])){ echo $_GET['EstadoDireccion']; }; ?>" >
                    <option value=""><?php echo $this->lang->line('usuario_form_direcciones_estado_selecciona'); ?></option>
                  </select>
                  <hr>
                  <select class="custom-select filtro-sel" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php if(isset($_GET['MunicipioDireccion'])){ echo $_GET['MunicipioDireccion']; }; ?>">
                    <option value=""><?php echo $this->lang->line('usuario_form_direcciones_municipio_selecciona'); ?></option>
                  </select>
                <hr>
                <button type="submit" class="btn btn<?php echo $primary; ?> btn-block" ><?php echo $this->lang->line('filtro_categoria_productos_filtrar'); ?></button>
                </div>
                </form>
            </div>
          </div>

        </div>
      </div>
      <div class="col-12">
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
        }else{  $hay_servicios = true; }// termina el condicional de productos
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
          <div class="servicios <?php echo $visible; ?>">
            <?php $galeria = $this->GaleriasServiciosModel->galeria_portada($servicio->ID_SERVICIO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
            <?php if($paquete['PLAN_NIVEL']>=2){ ?>
              <a href="<?php echo base_url('servicio?id='.$servicio->ID_SERVICIO); ?>" class="portada enlace-principal-servicio">
            <?php }else{ ?>
              <a href="#" class="portada enlace-principal-servicio" data-toggle="modal" data-target="#modal<?php echo $servicio->ID_SERVICIO; ?>">
            <?php } ?>

              <div class="rounded-circle" style="background-image:url(<?php echo base_url($ruta_portada); ?>)"> </div>
            </a>
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
              <h3 class="title text<?php echo $primary; ?>"><?php echo $titulo; ?> </h3>
              <?php if($servicio->SERVICIO_TIPO=='digital'){ ?>
                <span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio"><?php echo $this->lang->line('pagina_servicio_digital'); ?></span>
              <?php }else{ ?>
                <span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio"><?php echo $this->lang->line('pagina_servicio_profesional'); ?></span>
              <?php } ?>
              <hr>
              <div class="">
                <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                  <a href="<?php echo base_url('servicio/favorito?id='.$servicio->ID_SERVICIO); ?>" class="btn btn-outline-primary" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                <?php }else{ ?>
                  <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$servicio->ID_SERVICIO)); ?>" class="btn btn-outline-primary" title="Quitar de Favoritos"> <span class="fa fa-heart"></span> </a>
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="modal<?php echo $servicio->ID_SERVICIO; ?>" tabindex="-1" role="dialog" aria-labelledby="modal<?php echo $servicio->ID_SERVICIO; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 my-4 d-flex justify-content-center">
                      <div class="border rounded-circle" style="width:70%; padding-top:70%; background-position: center; background-repeat: no-repeat; background-size: contain; background-image:url(<?php echo base_url($ruta_portada) ?>);"></div>
                    </div>
                    <div class="col">
                      <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h3>
                      <div class="border-top mt-3 pt-3">
                        <?php echo $descripcion_corta; ?>
                      </div>
                      <div class="pt-2 border-top">
                        <?php if($servicio->SERVICIO_TIPO=='digital'){ ?>
                          <span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio"><?php echo $this->lang->line('pagina_servicio_digital'); ?></span> <?php echo $this->lang->line('pagina_servicio_digital_descripcion'); ?>
                        <?php }else{ ?>
                          <span class="badge <?php echo 'badge'.$primary; ?> etiqueta-servicio"><?php echo $this->lang->line('pagina_servicio_profesional'); ?></span> <?php echo $this->lang->line('pagina_servicio_profesional_descripcion'); ?>
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
        <?php }// Termina cuadritula de servicios ?>
          <!-- /CUADRICULA DE SERVICIOS -->
        <?php if(!$hay_servicios){ ?>
          <div class="border border-default p-3 text-center">
            <a href="<?php echo base_url('usuario/registrar'); ?>"><h3>Sé el primero en ofrecer servicios en esta categoría.</h3></a>
          </div>
        <?php } ?>
       </div>

    </div>
  </div>
</div>
