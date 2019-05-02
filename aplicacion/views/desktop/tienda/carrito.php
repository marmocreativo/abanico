
<?php
  //echo '<pre>';
  //var_dump($_SESSION['carrito']['tiendas']);
  //echo '</pre>';
?>
<table class="table table-striped">
  <thead>
    <tr>
      <th style="width:45%"><?php echo $this->lang->line('carrito_producto'); ?></th>
      <th style="width:20%"><?php echo $this->lang->line('carrito_cantidad'); ?></th>
      <th style="width:15%"><?php echo $this->lang->line('carrito_precio'); ?></th>
      <th style="width:15%"><?php echo $this->lang->line('carrito_total'); ?></th>
      <th style="width:5%"></th>
    </tr>
  </thead>
  <tbody>
    <?php $suma_productos = 0;?>
    <?php if(!empty($_SESSION['carrito']['productos'] )){ ?>
    <?php foreach($_SESSION['carrito']['productos'] as $producto){ ?>
    <tr>
      <td style="vertical-align:middle">
        <div class="d-flex">
          <div class="w-25">
            <img src="<?php echo $producto['imagen_producto'];  ?>" class="img-thumbnail" width="70" alt="">
          </div>
          <div class="w-75 p-1">
            <a href="#" class="h6"><?php echo $producto['nombre_producto'];  ?></a>
            <p style="font-size:0.8em;" class="mb-1">Vendido por: <a href="#"><?php echo $producto['nombre_tienda'];  ?></a></p>
            <p style="font-size:0.8em;" class="mb-1"><?php echo $producto['detalles_producto'];  ?></p>
            <p style="font-size:0.8em;" class="mb-1"><?php echo $producto['peso_producto'];  ?>kg</p>
          </div>
        </div>
      </td>
      <td style="vertical-align:middle">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <button class="btn btn-outline-primary boton-disminuir-carrito" type="button" data-id-producto = '<?php echo $producto['id_producto']; ?>' data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>'>-</button>
          </div>
            <input type="number" max="<?php echo $producto['cantidad_max']; ?>"
            class="form-control form-cantidad-carrito"
            data-id-producto = '<?php echo $producto['id_producto']; ?>'
            data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>'
            data-cantidad-max='<?php echo $producto['cantidad_max']; ?>'
            value="<?php echo $producto['cantidad_producto'];  ?>"
            >
          <div class="input-group-append">
            <button class="btn btn-outline-primary boton-incrementar-carrito" type="button" data-id-producto = '<?php echo $producto['id_producto']; ?>' data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>' data-cantidad-max='<?php echo $producto['cantidad_max']; ?>'>+</button>
          </div>
        </div>
      </td>
      <?php
      // variables de precio
      if($producto['divisa_default']!=$_SESSION['divisa']['iso']){
        $cambio_divisa_default = $this->DivisasModel->detalles_iso($producto['divisa_default']);
        if($producto['divisa_default']!='MXN'){
          $precio_venta = $producto['precio_producto']/$cambio_divisa_default['DIVISA_CONVERSION'];
          $suma = ($producto['cantidad_producto']*$producto['precio_producto'])/$cambio_divisa_default['DIVISA_CONVERSION'];
        }else{

          $precio_venta = $_SESSION['divisa']['conversion']*$producto['precio_producto'];
          $suma = $_SESSION['divisa']['conversion']*($producto['cantidad_producto']*$producto['precio_producto']);
        }
      }else{

        $precio_venta = $producto['precio_producto'];
        $suma = $producto['cantidad_producto']*$producto['precio_producto'];
      }
      ?>
      <td style="vertical-align:middle">
        <small><?php echo $_SESSION['divisa']['signo']; ?></small>
        <?php echo number_format($precio_venta,2); ?><br>
        <small><?php echo $_SESSION['divisa']['iso']; ?></small>
      </td>
      <td style="vertical-align:middle">
        <small><?php echo $_SESSION['divisa']['signo']; ?></small>
          <?php  echo number_format($suma,2); ?><br>
        <small><?php echo $_SESSION['divisa']['iso']; ?></small>
      </td>
      <td style="vertical-align:middle;"> <button type="button" class="btn btn-danger btn-sm boton-eliminar-carrito" data-id-producto = '<?php echo $producto['id_producto']; ?>' data-detalles-producto = '<?php echo $producto['detalles_producto']; ?>'
        title="<?php echo $this->lang->line('usuario_listas_generales_eliminar'); ?> <?php echo $this->lang->line('usuario_lista_productos_singular'); ?> ">
        <i class="fa fa-trash"></i> </button>
      </td>
    </tr>
    <?php $suma_productos +=  $suma; ?>
  <?php } ?>
  <?php }else{ ?>
    <tr>
      <td colspan="5" class="text-center border-0"><?php echo $this->lang->line('carrito_sin_productos'); ?></td>
    </tr>
  <?php } ?>

    <!-- Suma -->
    <tr>
      <td colspan="3" class="text-right"><?php echo $this->lang->line('carrito_sub_total'); ?></td>
      <td colspan="2" style="text-align:right"><h5 class="display-5">
        <small><?php echo $_SESSION['divisa']['signo']; ?></small>
        <strong><?php echo number_format($suma_productos,2); ?></strong>
        <small><?php echo $_SESSION['divisa']['iso']; ?></small>
      </h5></td>
    </tr>
  </tbody>
</table>
<div class="linea-colores-delgada">
  <div class="barra-color barra-azul"></div>
  <div class="barra-color barra-rosa"></div>
  <div class="barra-color barra-amarillo"></div>
  <div class="barra-color barra-verde"></div>
  <div class="barra-color barra-morado"></div>
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
            <li data-target="#carouselAyuda" data-slide-to="5"></li>
            <li data-target="#carouselAyuda" data-slide-to="6"></li>
            <li data-target="#carouselAyuda" data-slide-to="7"></li>
            <li data-target="#carouselAyuda" data-slide-to="8"></li>
            <li data-target="#carouselAyuda" data-slide-to="9"></li>
            <li data-target="#carouselAyuda" data-slide-to="10"></li>
            <li data-target="#carouselAyuda" data-slide-to="11"></li>
            <li data-target="#carouselAyuda" data-slide-to="12"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.1.png'); ?>" alt="Registro paso 1">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.2.png'); ?>" alt="Registro paso 2">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.3.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.4.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.5.png'); ?>" alt="Registro paso 5">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.6.png'); ?>" alt="Registro paso 6">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.7.png'); ?>" alt="Registro paso 7">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.8.png'); ?>" alt="Registro paso 8">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.9.png'); ?>" alt="Registro paso 9">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.10.png'); ?>" alt="Registro paso 10">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.11.png'); ?>" alt="Registro paso 11">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo7.12.png'); ?>" alt="Registro paso 12">
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
