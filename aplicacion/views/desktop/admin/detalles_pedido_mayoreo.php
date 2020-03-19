
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
		<div class="kt-container kt-body kt-grid kt-grid--ver" id="kt_body">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

				<!-- begin:: Subheader -->
				<div class="kt-subheader   kt-grid__item" id="kt_subheader">
					<div class="kt-subheader__main">
					</div>
					<div class="kt-subheader__toolbar">
					</div>
				</div>

				<!-- end:: Subheader -->

				<!-- begin:: Content -->
				<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

					<!--Begin::Dashboard 8-->

					<!--Begin::Section-->
					<div class="row mb-3">
						<div class="col-xl-12">

							<!--begin:: Widgets/Trends-->
							<div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
								<div class="kt-portlet__body">
  <div class="row">
		<div class="col">
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
	            <td>Nombre:</td>
	            <td><b><?php echo $pedido['PEDIDO_NOMBRE'] ?></b></td>
							<td>Correo:</td>
	            <td><b><?php echo $pedido['PEDIDO_CORREO'] ?></b></td>
							<td>Teléfono:</td>
	            <td><b><?php echo $pedido['PEDIDO_TELEFONO'] ?></b></td>
	          </tr>
	          <tr>
							<td>Direccion:</td>
	            <td colspan="6"><?php echo $pedido['PEDIDO_DIRECCION'] ?></td>
	          </tr>
	        </table>
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
	                  <img src="<?php echo $producto->PRODUCTO_IMAGEN;  ?>" width="100px;">
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
	            <tr>
	              <td>Importe envio <b><?php echo $pedido['PEDIDO_NOMBRE_TRANSPORTISTA'] ?></b></td>
	              <td>$<?php echo $pedido['PEDIDO_IMPORTE_ENVIO_TOTAL'] ?>
	                <?php if($pedido['PEDIDO_ESTADO_PAGO']=='pendiente'){ ?>
	                <a href="<?php echo base_url('tienda-mayoreo/pedido_envio?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-info"> <i class="fa fa-plus"></i> </a>
	                <?php } ?>
	              </td>
	            </tr>
	            <tr>
	              <td>Importe Total</td>
	              <td>$<?php echo $pedido['PEDIDO_IMPORTE_TOTAL'] ?></td>
	            </tr>
	          </table>
	      </div>
	      <div class="col-12">
	        <div class="row justify-content-center">
	          <div class="col">
	            <a href="<?php echo base_url('tienda-mayoreo/pedido_actualizar?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-warning btn-block"> Actualizar datos</a>
	          </div>
	          <div class="col">
	            <a href="<?php echo base_url('tienda-mayoreo/pedido_precios?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-success btn-block"> Cambiar precios</a>
	          </div>
	          <div class="col">
	            <a href="<?php echo base_url('tienda-mayoreo/pedido_pago?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-success btn-block"> Pagar</a>
	          </div>
	        </div>
	      </div>
	    </div>
		</div>
  </div>

</div>
</div>

<!--end:: Widgets/Trends-->
</div>
</div>
<!--End::Section-->

<!--End::Dashboard 8-->
</div>

<!-- end:: Content -->
</div>
</div>
</div>
