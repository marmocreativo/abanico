
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
									<?php foreach($productos_pedido as $producto){ ?>
							    <form class="" action="<?php echo base_url('admin/pedidos/pedido_mayoreo_precios'); ?>" method="post">
							    <input type="hidden" name="Identificador" value="<?php echo $pedido['ID_PEDIDO']; ?>">
							    <input type="hidden" name="IdProducto" value="<?php echo $producto->ID; ?>">
							    <input type="hidden" name="ImporteImpuestosPedido" value="<?php echo $pedido['PEDIDO_IMPORTE_IMPUESTOS']; ?>">
							    <input type="hidden" name="ImporteEnvioTotalPedido" value="<?php echo $pedido['PEDIDO_IMPORTE_ENVIO_TOTAL']; ?>">
							    <div class="row">
							      <div class="col-12 bg-light py-3 mb-4 border">
							        <h5><?php echo $producto->PRODUCTO_NOMBRE; ?><br>
							        <small>
							          <?php echo $producto->PRODUCTO_DETALLES; ?>
							        </small></h5>
							        <div class="row">
												<div class="col-1">
													<img src="<?php echo $producto->PRODUCTO_IMAGEN;  ?>" class="img-fluid"><br><b>X<?php echo $producto->CANTIDAD; ?></b>
												</div>
							          <div class="col">
							            <div class="form-group">
							              <label for="Cantidad">Cantidad</label>
							              <input type="text" class="form-control" name="Cantidad" value="<?php echo $producto->CANTIDAD; ?>" required>
							            </div>
							          </div>
							          <div class="col">
							            <div class="form-group">
							              <label for="Importe">Importe individual</label>
							              <input type="text" class="form-control" name="Importe" value="<?php echo $producto->IMPORTE; ?>" required>
							            </div>
							          </div>
							          <div class="col-2 pt-1">
							            <button type="submit" class="btn btn-primary btn-block mt-4"> <i class="fa fa-sync-alt"></i> Actualizar</button>
							          </div>
							        </div>
							      </div>
							    </div>
							    </form>
							    <?php } ?>
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
