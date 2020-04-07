
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
	      <div class="col-9">
	        <table class="table table-bordered table-sm">
						<tr>
							<td>
								Folio: <b><?php echo $pedido['PEDIDO_FOLIO'] ?></b>
							</td>
							<td>
								Estado: <b><?php echo $pedido['PEDIDO_ESTADO_PEDIDO'] ?></b>
							</td>
							<td>
								Fecha registro: <b><?php echo date('d / M / Y', strtotime($pedido['PEDIDO_FECHA_REGISTRO'])) ?></b>
							</td>
						</tr>
	          <tr>
	            <td>Cliente:<br>
								<b><?php echo $pedido['PEDIDO_NOMBRE_EMPRESA'] ?></b><br>
								<?php echo $pedido['PEDIDO_NOMBRE'] ?>

							</td>
							<td>Correo:<br>
								<b><?php echo $pedido['PEDIDO_CORREO'] ?></b>
							</td>
							<td>Teléfono:<br>
								<b><?php echo $pedido['PEDIDO_TELEFONO'] ?></b>
							</td>
	          </tr>
	          <tr>
							<td colspan="3">Direccion:<br>
								<?php echo $pedido['PEDIDO_DIRECCION'] ?>
							</td>
	          </tr>
						<tr>
							<td colspan="3">Tipo: <b><?php echo $pedido['PEDIDO_TIPO'] ?></b>
							</td>
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
	                  <img src="<?php echo $producto->PRODUCTO_IMAGEN;  ?>" width="50px;">
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
	              <td>Importe Total</td>
	              <td>$<?php echo $pedido['PEDIDO_IMPORTE_TOTAL'] ?></td>
	            </tr>
							<tr>
								<td>
									Estado del pago: <b><?php echo $pedido['PEDIDO_ESTADO_PAGO'] ?></b><br>
									Forma de pago: <b><?php echo $pedido['PEDIDO_FORMA_PAGO'] ?></b>

								</td>
								<td>Fecha de pago: <b><?php if($pedido['FECHA_PAGO']!='0000-00-00 00:00:00' && $pedido['FECHA_PAGO'] !=null ){ echo date('d / M / Y', strtotime($pedido['FECHA_PAGO'])); }?></td>
							</tr>
	          </table>
	      </div>
	      <div class="col-3">
	        <div class="row justify-content-center">
	          <div class="col-12 mb-3">
	            <a href="<?php echo base_url('admin/pedidos/pedido_mayoreo_actualizar?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-warning btn-block"> Actualizar datos</a>
	          </div>
	          <div class="col-12 mb-3">
	            <a href="<?php echo base_url('admin/pedidos/pedido_mayoreo_precios?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-success btn-block"> Cambiar precios</a>
	          </div>
						<div class="col-12 mb-3">
	            <a href="<?php echo base_url('admin/pedidos/pedido_mayoreo_recibo?id_pedido='.$pedido['ID_PEDIDO']); ?>" class="btn btn-sm btn-outline-success btn-block"> Enviar recibo por correo</a>
	          </div>
						<div class="col-12 mb-3">
							<button data-enlace='<?php echo base_url('admin/pedidos/pedido_mayoreo_borrar?id='.$pedido['ID_PEDIDO']); ?>' class="btn btn-outline-danger btn-block borrar_entrada" title="Cancelar Pedido">
			          Borrar pedido
			        </button>
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
