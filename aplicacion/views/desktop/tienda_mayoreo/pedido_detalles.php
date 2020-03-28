<div class="contenido_principal">
  <div class="container-fluid">
    <?php retro_alimentacion(); ?>
    <div class="row">
      <div class="col text-center py-4">
        <h3>Pedido folio: <b><?php echo $pedido['PEDIDO_FOLIO']; ?></b></h3>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <table class="table table-sm">
          <tr>
            <td>Nombre Negocio:</td>
            <td><?php echo $pedido['PEDIDO_NOMBRE_EMPRESA'] ?></td>
          </tr>
          <tr>
            <td>Nombre Cliente:</td>
            <td><?php echo $pedido['PEDIDO_NOMBRE'] ?></td>
          </tr>
          <tr>
            <td>Correo:</td>
            <td><?php echo $pedido['PEDIDO_CORREO'] ?></td>
          </tr>
          <tr>
            <td>Teléfono:</td>
            <td><?php echo $pedido['PEDIDO_TELEFONO'] ?></td>
          </tr>
          <tr>
            <td>Direccion:</td>
            <td><?php echo $pedido['PEDIDO_DIRECCION'] ?></td>
          </tr>
        </table>
        <div class="row bg-light py-3">
          <div class="col-6 mb-3 text-center">
            Tipo: <b><?php echo $pedido['PEDIDO_TIPO']; ?></b>
          </div>
          <div class="col-6 mb-3 text-center">
            Estado: <b><?php echo $pedido['PEDIDO_ESTADO_PEDIDO']; ?></b>
          </div>
          <div class="col text-center">
            Pago: <b><?php echo $pedido['PEDIDO_FORMA_PAGO']; ?> / <?php echo $pedido['PEDIDO_ESTADO_PAGO']; ?></b><br>
          </div>
          <div class="col text-center">
            Factura: <b><?php echo $pedido['PEDIDO_REQUIERE_FACTURA']; ?></b><br>
          </div>
        </div>
        <?php if($pedido['PEDIDO_ESTADO_PEDIDO']!='finalizado'){ ?>
        <a href="<?php echo base_url('tienda-mayoreo/pedido_actualizar?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-warning btn-block"> Actualizar datos</a>
        <?php } ?>
        <hr>
          <table class="table table-striped table-bordered table-sm">
            <tr>
              <th>img</th>
              <th style="width:50%">Producto</th>
              <th>#</th>
              <th>Precio</th>
            </tr>
            <?php foreach($productos_pedido as $producto){ ?>
              <tr>
                <td>
                  <img src="<?php echo $producto->PRODUCTO_IMAGEN;  ?>" width="30px;">
                </td>
                <td>
                  <?php echo $producto->PRODUCTO_NOMBRE; ?><br>
                  <small>
                    <?php echo $producto->PRODUCTO_DETALLES; ?>
                  </small>
                </td>
                <td>
                  <?php echo $producto->CANTIDAD; ?>
                </td>
                <td>
                  $<?php echo $producto->IMPORTE_TOTAL; ?><br>
                  <small>$<?php echo $producto->IMPORTE; ?> c/u</small>
                </td>
              </tr>
            <?php }?>
          </table>
          <?php if($pedido['PEDIDO_ESTADO_PEDIDO']!='finalizado'){ ?>
          <a href="<?php echo base_url('tienda-mayoreo/pedido_precios?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-success btn-block"> Cambiar precios</a>
          <?php } ?>
          <hr>
          <table class="table table-bordered">
            <tr>
              <td>Importe productos</td>
              <td>$<?php echo $pedido['PEDIDO_IMPORTE_PRODUCTOS_PARCIAL'] ?></td>
            </tr>
            <tr>
              <td>Impuestos <b><?php echo $pedido['PEDIDO_IMPUESTO_DETALLES'] ?></b></td>
              <td>$<?php echo $pedido['PEDIDO_IMPORTE_IMPUESTOS'] ?>
                <?php if($pedido['PEDIDO_ESTADO_PAGO']=='pendiente'){ ?>
                <a href="<?php echo base_url('tienda-mayoreo/pedido_impuestos?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-info"> <i class="fa fa-plus"></i> </a>
                <?php } ?>
              </td>
            </tr>
            <!--
            <tr>
              <td>Importe envio <b><?php echo $pedido['PEDIDO_NOMBRE_TRANSPORTISTA'] ?></b></td>
              <td>$<?php echo $pedido['PEDIDO_IMPORTE_ENVIO_TOTAL'] ?>
                <?php if($pedido['PEDIDO_ESTADO_PAGO']=='pendiente'){ ?>
                <a href="<?php echo base_url('tienda-mayoreo/pedido_envio?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-info"> <i class="fa fa-plus"></i> </a>
                <?php } ?>
              </td>
            </tr>
          -->
            <tr>
              <td>Importe Total</td>
              <td>$<?php echo $pedido['PEDIDO_IMPORTE_TOTAL'] ?></td>
            </tr>
          </table>
      </div>
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-6 mb-3">
            <?php if($pedido['PEDIDO_TIPO']=='pedido'&&$pedido['PEDIDO_ESTADO_PEDIDO']=='pedido'){ ?>
              <a href="<?php echo base_url('tienda-mayoreo/form_entregar_pedido?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-success btn-block"> Entregar pedido</a>
            <?php } ?>
            <?php if($pedido['PEDIDO_TIPO']=='comision'&&$pedido['PEDIDO_ESTADO_PEDIDO']=='comision'){ ?>
            <a href="<?php echo base_url('tienda-mayoreo/form_finalizar_comision?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-success btn-block"> Finalizar comisión</a>
            <?php } ?>
            <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='finalizado'&&$pedido['PEDIDO_ESTADO_PAGO']=='pagado'){ ?>
              <h6>PEDIDO FINALIZADO <i class="fa fa-check-circle"></i> </h6>
            <?php } ?>
            <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='finalizado'&&$pedido['PEDIDO_ESTADO_PAGO']=='pendiente'){ ?>
              <a href="<?php echo base_url('tienda-mayoreo/pedido_pago?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-success btn-block"> Confirmar pago</a>
            <?php } ?>
          </div>
          <div class="col-6 mb-3">
            <a href="<?php echo base_url('tienda-mayoreo'); ?>" class="btn btn-sm btn-info btn-block"> Salir</a>
          </div>
        </div>
        <a href="<?php echo base_url('tienda-mayoreo/pedido_recibo?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-block btn-outline-success my-2"> <i class="fa fa-envelope"></i> Enviar recibo por correo</a>
        <button data-enlace='<?php echo base_url('tienda-mayoreo/pedido_borrar?id='.$pedido['ID_PEDIDO']); ?>' class="btn btn-link text-danger btn-block borrar_entrada" title="Cancelar Pedido">
          Borrar pedido
        </button>
      </div>
    </div>
  </div>
</div>
