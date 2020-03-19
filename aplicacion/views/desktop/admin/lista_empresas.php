
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
	        <h1>Lista de empresas</h1>

	      </div>
	    </div>
	    <div class="row">
	      <div class="col">
	        <form class="" action="<?php echo base_url('admin/pedidos/lista_empresas'); ?>" method="get">
	          <div class="row">
	            <div class="col-8">
	              <div class="form-group">
	                <input type="text" class="form-control" name="busqueda" placeholder="Busqueda" value="<?php if(isset($_GET['busqueda'])){ echo $_GET['busqueda']; } ?>">
	              </div>
	            </div>
	            <div class="col-2">
	              <button type="submit" class="btn btn-primary btn-block"> <i class="fas fa-search"></i> </button>
	            </div>
							<div class="col-2">
								<a href="<?php echo base_url('admin/pedidos/crear_empresa'); ?>" class="btn btn-outline-success"> <i class="fas fa-plus"></i>Nueva empresa</a>
							</div>
	          </div>
	        </form>
	        <table class="table table-sm table-striped">
	          <tr>
	            <th>Empresa</th>
	            <th class="text-center">Controles</th>
	          </tr>
	          <?php foreach($empresas as $empresa){ ?>
	          <tr>
	            <td>
	              <h6><?php echo $empresa->EMPRESA_NOMBRE; ?></h6>
	              <p><b><?php echo $empresa->RFC; ?></b></p>
								<p><b><?php echo $empresa->RAZON_SOCIAL; ?></b></p>
								<p><b><?php echo $empresa->DOMICILIO; ?></b></p>
	              <p>
	                <?php echo $empresa->CONTACTO_NOMBRE.' '.$empresa->CONTACTO_APELLIDOS; ?><br>
	                <?php echo $empresa->CONTACTO_CORREO; ?>
	              </p>
	            </td>
	            <td>
								<div class="btn-group float-right">
									<a href="<?php echo base_url('admin/pedidos/lista_pedidos_mayoreo?id_empresa='.$empresa->ID); ?>" class="btn btn-success"> <i class="fas fa-shopping-bag"></i> Pedidos</a>
		              <a href="<?php echo base_url('admin/pedidos/actualizar_empresa?id_empresa='.$empresa->ID); ?>" class="btn btn-warning"> <i class="fas fa-pencil-alt"></i> Editar</a>
								</div>
	            </td>
	          </tr>
	          <?php } ?>
	        </table>
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
