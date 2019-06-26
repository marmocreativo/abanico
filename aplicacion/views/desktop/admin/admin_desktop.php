
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
					<div class="row">
						<div class="col-xl-12">

							<!--begin:: Widgets/Trends-->
							<div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
								<div class="kt-portlet__head kt-portlet__head--noborder">
									<div class="kt-portlet__head-label">
										<h3 class="kt-portlet__head-title">
											Resumen del sitio
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
									</div>
								</div>
								<div class="kt-portlet__body">
									<!--begin: CONTENIDO -->
									<div class="row mb-4">
									  <div class="col-6 col-md-3">
									      <div class="card">
									        <div class="card-body">
									          <div class="stat-widget-five">
									            <div class="stat-icon dib flat-color-4">
									              <i class="fa fa-users"></i>
									            </div>
									            <div class="stat-content">
									              <div class="text-left dib">
									                <?php $usuarios_compradores = $this->UsuariosModel->conteo_por_tipo('usr-1'); ?>
									                <div class="stat-text"><span class="count"><?php echo $usuarios_compradores; ?></span></div>
									                <div class="stat-heading">Clientes</div>
									              </div>
									            </div>
									          </div>
									        </div>
									      </div>
									  </div>
									  <div class="col-6 col-md-3">
									      <div class="card">
									        <div class="card-body">
									          <div class="stat-widget-five">
									            <div class="stat-icon dib flat-color-4">
									              <i class="fa fa-store"></i>
									            </div>
									            <div class="stat-content">
									              <div class="text-left dib">
									                <?php $usuarios_vendedores = $this->UsuariosModel->conteo_por_tipo('vnd-2'); ?>
									                <div class="stat-text"><span class="count"><?php echo $usuarios_vendedores; ?></span></div>
									                <div class="stat-heading">Vendedores</div>
									              </div>
									            </div>
									          </div>
									        </div>
									      </div>
									  </div>
									  <div class="col-6 col-md-3">
									      <div class="card">
									        <div class="card-body">
									          <div class="stat-widget-five">
									            <div class="stat-icon dib flat-color-4">
									              <i class="fa fa-user-tie"></i>
									            </div>
									            <div class="stat-content">
									              <div class="text-left dib">
									                <?php $usuarios_servidores = $this->UsuariosModel->conteo_por_tipo('ser-3'); ?>
									                <div class="stat-text"><span class="count"><?php echo $usuarios_servidores; ?></span></div>
									                <div class="stat-heading">Servidores</div>
									              </div>
									            </div>
									          </div>
									        </div>
									      </div>
									  </div>
									  <div class="col-6 col-md-3">
									      <div class="card">
									        <div class="card-body">
									          <div class="stat-widget-five">
									            <div class="stat-icon dib flat-color-4">
									              <i class="fa fa-star"></i>
									            </div>
									            <div class="stat-content">
									              <div class="text-left dib">
									                <?php $usuarios_ven_ser = $this->UsuariosModel->conteo_por_tipo('vns-4'); ?>
									                <div class="stat-text"><span class="count"><?php echo $usuarios_ven_ser; ?></span></div>
									                <div class="stat-heading">Ven-Serv</div>
									              </div>
									            </div>
									          </div>
									        </div>
									      </div>
									  </div>
									</div>
									<div class="row mb-4">
									  <div class="col-12">
									    <div class="card">
												<div class="card-header">
										        <h4> <i class="fa fa-boxes"></i> Resumen de Productos</h4>
												</div>
									      <div class="card-body">
													<div class="row">
														<div class="col-4">
													    <div class="card">
													      <div class="card-header">
													        <h6> <i class="fa fa-box"></i> 10 Productos Más Vistos</h6>
													      </div>
													      <div class="card-body p-0">
													          <?php  $productos_mas_vistos = $this->EstadisticasModel->mas_vistos('producto',10);?>
													          <ul class="list-group">
													          <?php foreach($productos_mas_vistos as $producto_mas){ ?>
													            <li class="list-group-item d-flex justify-content-between align-items-center">
													              <?php $producto=$this->ProductosModel->detalles($producto_mas['ID_OBJETO']); ?>
													              <?php echo $producto['PRODUCTO_NOMBRE'] ?>
													              <span class="badge badge-primary badge-pill"><?php echo $producto_mas['cantidad_total'] ?></span>
													            </li>
													          <?php } ?>
													          </ul>
													      </div>
													    </div>
													  </div>
													  <div class="col-4">
													    <div class="card">
													      <div class="card-header">
													        <h6> <i class="fa fa-box"></i> 10 Productos Más Vendidos</h6>
													      </div>
													      <div class="card-body p-0">
													          <?php  $productos_mas_vendidos = $this->EstadisticasModel->mas_vendidos(10);?>
													          <ul class="list-group">
													          <?php foreach($productos_mas_vendidos as $producto_mas){ ?>
													            <li class="list-group-item d-flex justify-content-between align-items-center">
													              <?php $producto=$this->ProductosModel->detalles($producto_mas['ID_PRODUCTO']); ?>
													              <?php echo $producto['PRODUCTO_NOMBRE'] ?>
													              <span class="badge badge-primary badge-pill"><?php echo $producto_mas['cantidad_total'] ?></span>
													            </li>
													          <?php } ?>
													          </ul>
													      </div>
													    </div>
													  </div>
													  <div class="col-4">
													    <div class="card">
													      <div class="card-header">
													        <h6> <i class="fa fa-box"></i> 10 Categorias con mas productos</h6>
													      </div>
													      <div class="card-body p-0">
													          <?php  $categorias_mas_productos = $this->EstadisticasModel->categorias_mas_productos(10);?>
													          <ul class="list-group">
													          <?php foreach($categorias_mas_productos as $categoria_mas){ ?>
													            <li class="list-group-item d-flex justify-content-between align-items-center">
													              <?php echo $categoria_mas['CATEGORIA_NOMBRE'] ?>
													              <span class="badge badge-primary badge-pill"><?php echo $categoria_mas['cantidad_total'] ?></span>
													            </li>
													          <?php } ?>
													          </ul>
													      </div>
													    </div>
													  </div>
													</div>
									      </div>
									    </div>
									  </div>
									</div>
									<div class="row mb-4">
									  <div class="col-12">
									    <div class="card">
												<div class="card-header">
													<h4> <i class="fa fa-tools"></i> Resumen de Servicios</h4>
												</div>
									      <div class="card-body">
													<div class="row">

													  <div class="col-6">
													    <div class="card">
													      <div class="card-header">
													        <h6> <i class="fa fa-tools"></i> 10 Servicios Más Vistos</h6>
													      </div>
													      <div class="card-body p-0">
													          <?php  $servivios_mas_vistos = $this->EstadisticasModel->mas_vistos('servicio',10);?>
													          <ul class="list-group">
													          <?php foreach($servivios_mas_vistos as $servicio_mas){ ?>
													            <li class="list-group-item d-flex justify-content-between align-items-center">
													              <?php $servicio=$this->ServiciosModel->detalles($servicio_mas['ID_OBJETO']); ?>
													              <?php echo $servicio['SERVICIO_NOMBRE'] ?>
													              <span class="badge badge-primary badge-pill"><?php echo $servicio_mas['cantidad_total'] ?></span>
													            </li>
													          <?php } ?>
													          </ul>
													      </div>
													    </div>
													  </div>
													  <div class="col-6">
													    <div class="card">
													      <div class="card-header">
													        <h6> <i class="fa fa-tools"></i> 10 Servicios Más Contactados</h6>
													      </div>
													      <div class="card-body p-0">
													          <?php  $servicio_mas_contacto = $this->EstadisticasModel->mas_contactos(10);?>
													          <ul class="list-group">
													          <?php  foreach($servicio_mas_contacto as $servicio_mas){ ?>
													            <li class="list-group-item d-flex justify-content-between align-items-center">
													              <?php $servicio=$this->ServiciosModel->detalles($servicio_mas['ID_OBJETO']); ?>
													              <?php echo $servicio['SERVICIO_NOMBRE'] ?>
													              <span class="badge badge-primary badge-pill"><?php echo $servicio_mas['cantidad_total'] ?></span>
													            </li>
													          <?php }  ?>
													          </ul>
													      </div>
													    </div>
													  </div>
													</div>
									      </div>
									    </div>
									  </div>
									</div>
									 <div class="row mb-4">
										 <div class="col-12">
 									    <div class="card">
 												<div class="card-header">
 										       <h4> <i class="fa fa-shopping-bag"></i> Resumen de Pedidos</h4>
 												</div>
 									      <div class="card-body">
 													<div class="row">
 														<div class="col-3">
 													      <div class="card">
 													        <div class="card-body">
 													          <div class="stat-widget-five">
 													            <div class="stat-icon dib flat-color-4">
 													              <i class="fa fa-shopping-bag"></i>
 													            </div>
 													            <div class="stat-content">
 													              <div class="text-left dib">
 													                <?php $todos_los_pedidos = $this->EstadisticasModel->conteo_pedidos(); ?>
 													                <div class="stat-text"><span class="count"><?php echo $todos_los_pedidos; ?></span></div>
 													                <div class="stat-heading">Todos los pedidos</div>
 													              </div>
 													            </div>
 													          </div>
 													        </div>
 													      </div>
 													  </div>
 													  <div class="col-3">
 													      <div class="card">
 													        <div class="card-body">
 													          <div class="stat-widget-five">
 													            <div class="stat-icon dib flat-color-4">
 													              <i class="fa fa-money-bill"></i>
 													            </div>
 													            <div class="stat-content">
 													              <div class="text-left dib">
 													                <?php $pedidos_pagados = $this->EstadisticasModel->conteo_pedidos_pagados(); ?>
 													                <div class="stat-text"><span class="count"><?php echo $pedidos_pagados; ?></span></div>
 													                <div class="stat-heading">Pedidos Pagados</div>
 													              </div>
 													            </div>
 													          </div>
 													        </div>
 													      </div>
 													  </div>
 													  <div class="col-3">
 													      <div class="card">
 													        <div class="card-body">
 													          <div class="stat-widget-five">
 													            <div class="stat-icon dib flat-color-4">
 													              <i class="fa fa-gift"></i>
 													            </div>
 													            <div class="stat-content">
 													              <div class="text-left dib">
 													                <?php $pedidos_entregados = $this->EstadisticasModel->conteo_pedidos_entregados(); ?>
 													                <div class="stat-text"><span class="count"><?php echo $pedidos_entregados; ?></span></div>
 													                <div class="stat-heading">Pedidos Entregados</div>
 													              </div>
 													            </div>
 													          </div>
 													        </div>
 													      </div>
 													  </div>
 													  <div class="col-3">
 													      <div class="card">
 													        <div class="card-body">
 													          <div class="stat-widget-five">
 													            <div class="stat-icon dib flat-color-4">
 													              <i class="fa fa-ban"></i>
 													            </div>
 													            <div class="stat-content">
 													              <div class="text-left dib">
 													                <?php $pedidos_cancelados = $this->EstadisticasModel->conteo_pedidos_cancelados(); ?>
 													                <div class="stat-text"><span class="count"><?php echo $pedidos_cancelados; ?></span></div>
 													                <div class="stat-heading">Pedidos Cancelados</div>
 													              </div>
 													            </div>
 													          </div>
 													        </div>
 													      </div>
 													  </div>
 													</div>
													<div class="row">
											      <div class="col">
											        <canvas id="Chart-linea" width="100%"></canvas>
											      </div>
											    </div>
 									      </div>
 									    </div>
 									  </div>
									 </div>
									</div>

									<!-- end: CONTENIDO -->
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
