<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8">
        <div class="card">
          <div class="card-body">
            <div class="border p-3 text-center">
              <h6> <i class="fa fa-shopping-cart"></i> <?php echo $this->lang->line('proceso_pago_carrito_titulo'); ?> </h6>
            </div>

            <?php retro_alimentacion(); ?>
            <div class="CargarCarrito">

            </div>
            <div class="border-info p-3 m-3" style="border:1px; border-style:dashed;">
              <?php if(isset($_SESSION['carrito']['cupon_codigo'])&&!empty($_SESSION['carrito']['cupon_codigo'])){ ?>
                <div class="row">
                  <div class="col-3">
                    <h5>Cupón: <b><?php echo $_SESSION['carrito']['cupon_codigo']; ?></b></h5>
                  </div>
                  <div class="col-8">
                    <?php
                      if($_SESSION['carrito']['cupon_tipo']=='porcentaje'){
                        $descuento = $_SESSION['carrito']['cupon_descuento'].'% de descuento';
                      }else{
                        $descuento = '$'.$_SESSION['carrito']['cupon_descuento'].' MXN de descuento';
                      }
                      if($_SESSION['carrito']['cupon_productos']=='todos'){
                        $detalles = '<small> En cualquier producto</small>';
                      }else{
                        $detalles = '<small> En productos vendidos por Abanico</small>';
                      }
                      echo '<h5>'.$descuento.$detalles.'</h5>';
                    ?>
                  </div>
                  <div class="col-1">
                    <a href="<?php echo base_url('eliminar_cupon'); ?>" class="btn btn-sm btn-outline-info "> <i class="fa fa-times"></i> </a>
                  </div>
                </div>
              <?php }else{ ?>
                <form class="" action="<?php echo base_url('canjear_cupon'); ?>" method="get">
                <div class="row">
                  <div class="col-12 form-inline d-flex justify-content-center">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Código del cupón" name="Codigo" value="">
                    </div>
                    <button type="submit" class="btn btn-sm btn-info"> <i class="fa fa-ticket-alt"></i> Validar</button>
                  </div>
                </div>
                </form>
              <?php } ?>
            </div>
          </div>
          <div class="card-footer d-flex justify-content-between">
            <a href="<?php echo base_url(); ?>" class="btn btn-outline-primary"> <i class="fa fa-chevron-left"></i> <?php echo $this->lang->line('proceso_pago_2_volver_a_tienda'); ?></a>
            <a href="<?php echo base_url('proceso_pago_1'); ?>" class="btn btn-success"> <?php echo $this->lang->line('proceso_pago_2_continuar'); ?> <i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
