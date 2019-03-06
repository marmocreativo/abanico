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
<div class="fila p-3" style="background:#eee;">
  <div class="container">
    <div class="row">
      <div class="fila">
        <h1 class="h3 border-bottom pb-3"> <i class="fa fa-tools"></i> <?php echo $titulo_categoria; ?></h1>
      </div>
    </div>
    <div class="row">
    <div class="col-2 d-none d-sm-block fila fila-gris">
        <div class="contenedor-filtros">

        </div>
      </div>
      <div class="col">
        <div class="card-deck">
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
            ?>
            <div class="col-xl-3 col-md-3 col-6 mb-3">
              <div class="cuadricula-productos">
                <?php $galeria = $this->GaleriasServiciosModel->galeria_portada($servicio->ID_SERVICIO); if(empty($galeria)){ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/default.jpg'; }else{ $ruta_portada = $op['ruta_imagenes_servicios'].'completo/'.$galeria['GALERIA_ARCHIVO']; } ?>
                <a href="#""<?php echo base_url('servicio?id='.$servicio->ID_SERVICIO); ?>" class="enlace-principal-servicio"  data-toggle="modal" data-target="#modal<?php echo $servicio->ID_SERVICIO; ?>">
                  <div class="portada-servicios img-thumbnail rounded-circle" style="background-image:url(<?php echo base_url($ruta_portada); ?>)"> </div>
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
                      <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h3>
                      <div class="">
                        <?php if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
                          <a href="<?php echo base_url('servicio/favorito?id='.$servicio->ID_SERVICIO); ?>" class="btn btn-outline-primary" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                        <?php }else{ ?>
                          <a href="<?php echo base_url('login?url_redirect='.base_url('producto/favorito?id='.$servicio->ID_SERVICIO)); ?>" class="btn btn-outline-primary" title="Añadir a Favoritos"> <span class="fa fa-heart"></span> </a>
                        <?php } ?>
                      </div>
                  </div>
              </div>

                <!-- Modal -->
                <div class="modal fade" id="modal<?php echo $servicio->ID_SERVICIO; ?>" tabindex="-1" role="dialog" aria-labelledby="modal<?php echo $servicio->ID_SERVICIO; ?>" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-3">
                            <div class="portada-servicios img-thumbnail rounded-circle" style="background-image:url(<?php echo base_url($ruta_portada); ?>)"> </div>
                          </div>
                          <div class="col">
                            <h3 class="title <?php echo 'text'.$primary; ?>"><?php echo $titulo; ?></h3>
                            <div class="border-top mt-3 pt-3">
                              <?php echo $descripcion_corta; ?>
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
        </div>
      </div>
    </div>
  </div>
</div>
