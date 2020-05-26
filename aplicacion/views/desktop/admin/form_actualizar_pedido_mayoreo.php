
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
									<form class="" action="<?php echo base_url('admin/pedidos/pedido_mayoreo_actualizar'); ?>" method="post">
										<input type="hidden" name="Identificador" value="<?php echo $pedido['ID_PEDIDO']; ?>">
										<div class="row">
											<div class="col-12">
												<h6>Datos</h6>
											</div>
											<div class="col-12 col-sm-3">
												Folio:
													<h5><?php echo $pedido['PEDIDO_FOLIO']; ?></h5>

											</div>
											<div class="col-12 col-sm-3">
												<div class="form-group">
													<label for="PedidoEstado">Estado</label>
													<select class="form-control form-control-sm" name="PedidoEstado">
														<option value="finalizado" <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='finalizado'){ echo 'selected'; } ?>>Finalizado</option>
														<option value="pedido" <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='pedido'){ echo 'selected'; } ?>>Pedido</option>
														<option value="comision" <?php if($pedido['PEDIDO_ESTADO_PEDIDO']=='comision'){ echo 'selected'; } ?>>Comisión</option>
													</select>
												</div>
											</div>

											<div class="col-12 col-sm-3">
												<div class="form-group">
													<label for="PedidoTipo">Tipo</label>
													<select class="form-control form-control-sm" name="PedidoTipo">
														<option value="venta_directa" <?php if($pedido['PEDIDO_TIPO']=='venta_directa'){ echo 'selected'; } ?>>Venta directa</option>
														<option value="pedido" <?php if($pedido['PEDIDO_TIPO']=='pedido'){ echo 'selected'; } ?>>Pedido</option>
														<option value="comision" <?php if($pedido['PEDIDO_TIPO']=='comision'){ echo 'selected'; } ?>>Comisión</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-sm-3">
												<div class="form-group">
													<label for="PedidoFechaCreacion">Fecha creación del pedido <br> <?php echo $pedido['PEDIDO_FECHA_REGISTRO']; ?></label>
													<input type="datetime-local" class="form-control form-control-sm" name="PedidoFechaCreacion" value="<?php echo date('Y-m-d\TH:i:s', strtotime($pedido['PEDIDO_FECHA_REGISTRO'])); ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<h6>Cliente</h6>
											</div>
											<div class="col-12 col-sm-8">
												<div class="row">
													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label for="PedidoNombreEmpresa">Nombre Empresa</label>
															<input type="text" class="form-control form-control-sm" name="PedidoNombreEmpresa" value="<?php echo $pedido['PEDIDO_NOMBRE_EMPRESA']; ?>">
														</div>
													</div>
													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label for="PedidoNombreCliente">Nombre Cliente</label>
															<input type="text" class="form-control form-control-sm" name="PedidoNombreCliente" value="<?php echo $pedido['PEDIDO_NOMBRE']; ?>">
														</div>
													</div>
													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label for="PedidoCorreo">Correo</label>
															<input type="email" class="form-control form-control-sm" name="PedidoCorreo" value="<?php echo $pedido['PEDIDO_CORREO']; ?>">
														</div>
													</div>
													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label for="PedidoTelefono">Teléfono</label>
															<input type="phone" class="form-control form-control-sm" name="PedidoTelefono" value="<?php echo $pedido['PEDIDO_TELEFONO']; ?>">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="PedidoDireccion">Dirección</label>
													<textarea name="PedidoDireccion" class="form-control" rows="5"><?php echo $pedido['PEDIDO_DIRECCION']; ?></textarea>
												</div>
											</div>
											<div class="col-12 col-sm-4 bg-light">
												<h6 class="text-danger">No mover de no ser necesario</h6>
												<?php $empresas = $this->GeneralModel->lista('empresas','',['ESTADO'=>'activo'],'EMPRESA_NOMBRE ASC','',''); ?>
												<div class="form-group">
													<label for="IdComprador">Cambiar Empresa Asignada</label>
													<select class="form-control form-control-sm" name="IdComprador">
														<?php foreach($empresas as $empresa){ ?>
														<option value="<?php echo $empresa->ID; ?>" <?php if($pedido['ID_COMPRADOR']==$empresa->ID){ echo 'selected';} ?>><?php echo $empresa->EMPRESA_NOMBRE; ?></option>
														<?php } ?>
													</select>
													<small  class="form-text text-danger">
													 Cambiar este campo NO cambiará los datos del pedido
													</small>
												</div>
												<div class="form-check">
												  <input class="form-check-input" type="checkbox" name="ActualizarEmpresa" id="ActualizarEmpresa">
												  <label class="form-check-label" for="ActualizarEmpresa">
												    Actualizar también empresa
												  </label>
													<small  class="form-text text-danger">
													 Se actualizarán los datos de este pedido y de la empresa, otros pedidos asignados a esta empresa no sufriran cambio
													</small>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<h6>Pago</h6>
											</div>
											<div class="col-12 col-sm-3">
												<div class="form-group">
													<label for="PedidoImpuestosPorcentaje">Porcentaje Impuestos</label>
													<select class="form-control" name="PedidoImpuestosPorcentaje">
														<option value="">Ninguno</option>
														<option value="16" <?php if($pedido['PEDIDO_IMPUESTO_DETALLES']=='16'){ echo 'selected'; } ?>>16%</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-sm-3">
												<div class="form-group">
													<label for="PedidoFormaPago">Forma de pago</label>
													<select class="form-control form-control-sm" name="PedidoFormaPago">
														<option value="">Ninguna</option>
														<option value="efectivo" <?php if($pedido['PEDIDO_FORMA_PAGO']=='efectivo'){ echo 'selected'; } ?>>Efectivo</option>
														<option value="transferencia" <?php if($pedido['PEDIDO_FORMA_PAGO']=='transferencia'){ echo 'selected'; } ?>>Transferencia / depósito</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-sm-3">
												<div class="form-group">
													<label for="PedidoEstadoPago">Estado del pago</label>
													<select class="form-control form-control-sm" name="PedidoEstadoPago">
														<option value="pendiete" <?php if($pedido['PEDIDO_ESTADO_PAGO']=='pendiete'){ echo 'selected'; } ?>>Pendiente</option>
														<option value="pagado" <?php if($pedido['PEDIDO_ESTADO_PAGO']=='pagado'){ echo 'selected'; } ?>>Pagado</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-sm-3">
												<div class="form-group">
													<label for="FechaPago">Fecha pago</label>
													<input type="date" class="form-control form-control-sm" name="FechaPago" value="<?php echo date('Y-m-d', strtotime($pedido['FECHA_PAGO'])); ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<button type="submit" class="btn btn-primary d-block ml-auto" name="button">Actualizar </button>
											</div>
										</div>
									</form>
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
