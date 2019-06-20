
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
    <div class="col-7">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-user-tie"></span> Actualizar <?php echo $perfil['PERFIL_NOMBRE']; ?></h1>
          </div>
        </div>
        <div class="card-body">
          <?php retro_alimentacion(); ?>
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/perfiles_servicios/actualizar');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Identificador" value="<?php echo $perfil['ID_PERFIL']; ?>">
            <input type="hidden" name="IdUsuario" value="<?php echo $usuario['ID_USUARIO']; ?>">
            <input type="hidden" name="ImagenAnteriorPerfil" value="<?php echo $perfil['PERFIL_IMAGEN']; ?>">
            <div class="row">
              <div class="col-8">
                <img src="<?php echo base_url('contenido/img/perfiles/completo/'.$perfil['PERFIL_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                <hr>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="ImagenPerfil" name="ImagenPerfil" placeholder="" value="">
                  <label class="custom-file-label" for="ImagenPerfil">Logotipo de tu Perfil</label>
                </div>
              </div>
              <div class="col-12 mt-4">
                <hr>
                 <div class="form-group">
                   <label for="NombrePerfil">Nombre público</label>
                   <input type="text" class="form-control" id="NombrePerfil" name="NombrePerfil" placeholder="" value="<?php echo $perfil['PERFIL_NOMBRE']; ?>">
                 </div>
                 <hr>
                 <h5 class="mb-3"><span class="fa fa-file-invoice"></span> Datos Fiscales (Opcionales)</h5>
                 <div class="form-group">
                   <label for="RazonSocialPerfil">Razón social</label>
                   <input type="text" class="form-control" id="RazonSocialPerfil" name="RazonSocialPerfil" placeholder="" value="<?php echo $perfil['PERFIL_RAZON_SOCIAL']; ?>">
                 </div>
                 <div class="form-group">
                   <label for="RfcPerfil">R.F.C.</label>
                   <input type="text" class="form-control" id="RfcPerfil" name="RfcPerfil" placeholder="" value="<?php echo $perfil['PERFIL_RFC']; ?>">
                 </div>
                 <h6 class="mb-3"><span class="fa fa-file-invoice"></span> Datos de Contacto (Obligatorios)</h6>
                 <div class="form-group">
                   <label for="TelefonoPerfil">Teléfono</label>
                   <input type="text" class="form-control" id="TelefonoPerfil" name="TelefonoPerfil" placeholder="" value="<?php echo $perfil['PERFIL_TELEFONO']; ?>">
                 </div>
                 <hr>
                 <h6 class="mb-3"> <span class="fa fa-building"></span> Dirección</h6>
                 <input type="hidden" name="IdentificadorDireccion" value="<?php echo $direccion_perfil_servicios['ID_DIRECCION'] ?>">
                 <input type="hidden" name="TipoDireccion" value="perfil">
                 <input type="hidden" name="AliasDireccion" value="Direccion Perfil">
                  <input type="hidden" name="ReferenciasDireccion" value="-">
                 <div class="row">
                   <div class="col">
                     <div class="form-group">
                       <label for="PaisDireccion">País </label>
                       <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo $direccion_perfil_servicios['DIRECCION_PAIS']; ?>" required>
                         <option value="">Selecciona un País</option>
                       </select>
                     </div>
                   </div>
                   <div class="col">
                     <div class="form-group">
                       <label for="EstadoDireccion">Estado </label>
                       <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo $direccion_perfil_servicios['DIRECCION_ESTADO']; ?>" required>
                         <option value="">Selecciona tu estado</option>
                       </select>
                     </div>
                   </div>
                   <div class="col">
                     <div class="form-group">
                       <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                       <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo $direccion_perfil_servicios['DIRECCION_MUNICIPIO']; ?>" required>
                         <option value="">Selecciona tu Municipio / Alcaldía</option>
                       </select>
                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col">
                     <div class="form-group">
                       <label for="CiudadPerfil">Ciudad (Opcional)</label>
                       <input type="text" name="CiudadDireccion" class="form-control" value="<?php echo $direccion_perfil_servicios['DIRECCION_CIUDAD']; ?>">
                     </div>
                   </div>
                     <div class="col">
                       <div class="form-group">
                         <label for="CodigoPostalDireccion">Código Postal</label>
                         <input type="text" name="CodigoPostalDireccion" class="form-control" value="<?php echo $direccion_perfil_servicios['DIRECCION_CODIGO_POSTAL']; ?>">
                       </div>
                     </div>
                 </div>
                 <div class="form-group">
                   <label for="BarrioDireccion">Barrio / Colonia</label>
                   <input type="text" name="BarrioDireccion" class="form-control" value="<?php echo $direccion_perfil_servicios['DIRECCION_BARRIO']; ?>">
                 </div>
                 <div class="form-group">
                   <label for="CalleDireccion">Calle y Número</label>
                   <textarea name="CalleDireccion" class="form-control" rows="3"><?php echo $direccion_perfil_servicios['DIRECCION_CALLE_Y_NUMERO']; ?></textarea>
                 </div>
                 <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Actualizar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-5">
        <?php if(!empty($plan)){ ?>
					<div class="col" id="<?php echo $plan['PLAN_TIPO'].'_plan_'.$plan['PLAN_NIVEL']; ?>">
						<div class="card mb-3 rounded-0">
							<div class="card-header text-center">
								<img src="<?php echo base_url('assets/global/img/'.$plan['PLAN_TIPO'].'_plan_'.$plan['PLAN_NIVEL'].'_mono.png'); ?>" alt="">
								<h5 class="card-title"> <?php echo $plan['PLAN_NOMBRE']; ?></h5>
								<p>Estado: <b><?php echo $plan['PLAN_ESTADO']; ?></b></p>
							</div>
								<div class="card-body p-0">
									<table class="table m-0">
										<tr>
											<td>Mensualidad</td>
											<td>$<?php echo $plan['PLAN_MENSUALIDAD']; ?></td>
										</tr>
										<tr>
											<td>Límite de servicios activos</td>
											<td><?php echo $plan['PLAN_LIMITE_SERVICIOS']; ?></td>
										</tr>
										<tr>
											<td>Límite de fotografías por servicio</td>
											<td><?php echo $plan['PLAN_FOTOS_SERVICIOS']; ?></td>
										</tr>
									</table>
									<div class="row p-3">
										<div class="col-12 p-3">
											<div class="card border-primary">
												<div class="card-body p-2">
													<p class="mb-1"> <b>Registro:</b> <?php echo $plan['FECHA_INICIO']; ?></p>
													<p class="mb-1"> <b>Vigencia:</b> <?php echo $plan['FECHA_TERMINO']; ?></p>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="card border-primary">
												<div class="card-body p-2">
													<?php if($plan['AUTO_RENOVAR']=='si'){ ?>
													<p class="mb-1"> <b>Auto renovar:</b> <?php echo $plan['FECHA_TERMINO']; ?></p>
														<a href="<?php echo base_url('usuario/planes/auto_renovar?id='.$plan['ID_PLAN_USUARIO'].'&estado=no'); ?>" class="btn btn-sm btn-block btn-outline-primary"> <i class="fa fa-ban"></i> Cancelar Auto Renovación </a>
													<?php }else{ ?>
														<a href="<?php echo base_url('usuario/planes/auto_renovar?id='.$plan['ID_PLAN_USUARIO'].'&estado=si'); ?>" class="btn btn-sm btn-block btn-primary"> <i class="fa fa-check"></i> Activar Auto Renovación </a>
													<?php } ?>
												</div>
											</div>
										</div>
								</div>
								<div class="row p-3">
									<div class="col-12">
										<hr>
										<h4 class="h5"> <span class="fa fa-money-bill"></span> Pago del plan</b></h4>
									</div>
							<!--Permisos para pagar y cancelar -->
							<?php $pagos = $this->PlanesModel->lista_pagos($plan['ID_PLAN_USUARIO']); ?>
							<?php foreach($pagos as $pago){ ?>
								<?php if($pago->PAGO_ESTADO=='pendiente'){ ?>
									<div class="col-12">
										<form class="" action="<?php echo base_url('usuario/planes/subir_comprobante'); ?>" method="post" enctype="multipart/form-data">
											<input type="hidden" name="IdPago" value="<?php echo $pago->ID_PAGO; ?>">
											<input type="hidden" name="Origen" value="usuario/tienda">
											<div class="form-group">
												<label for="ArchivoPago"><?php echo $this->lang->line('usuario_detalles_pago_archivo'); ?></label>
												<input type="file" class="form-control" name="ArchivoPago" value="" required>
											</div>
											<button type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-upload"></i> <?php echo $this->lang->line('usuario_detalles_pago_subir'); ?></button>
										</form>
									</div>
								<?php }// Si el Pago está pendientes y es por transferencia Bancaria ?>
								<?php if($pago->PAGO_ESTADO=='comprobante'){ ?>
									<div class="col-12">
										<div class="alert alert-success">
											<h6>Tu comprobante ha sido recibido, tu plan estará activo pronto.</h6>
										</div>
									</div>
								<?php }// Si se subió comprobante ?>
								<?php if($pago->PAGO_ESTADO=='pagado'){ ?>
									<div class="col-12">
										<div class="alert alert-success">
											<h6>Tu plan se encuentra <?php echo $pago->PAGO_ESTADO; ?></h6>
										</div>
									</div>
								<?php }// Si se subió comprobante ?>
							<?php }// Bucle de pagos ?>
								</div>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col">
									<p>Estado del Pago: <b><?php echo $plan['PLAN_ESTADO']; ?></b></p>
								</div>
								<div class="col d-flex justify-content-end">
									<p>Fecha Límite de Pago: <b><?php echo date('d-m-Y',strtotime("+5 days",strtotime($plan['FECHA_INICIO']))); ?></b></p>
								</div>
							</div>
							<div class="row">
                <div class="col">
                  <a href="<?php echo base_url('admin/planes/actualizar_plan_usuario?id='.$plan['ID_PLAN_USUARIO']); ?>" class="btn btn-primary btn-block">Activar / Editar Plan</a>
                </div>
              </div>
						</div>
				</div>
				<?php }else{?>
					<div class="card <?php echo 'border'.$primary; ?>">
						<div class="card-body">
							<h4 class="h5"> <span class="fa fa-file-signature"></span> No has solicitado ningún plan</b></h4>
							<hr>
							<a href="<?php echo base_url('usuario/planes/lista_planes?tipo=servicios'); ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Solicitar activación de plan</a>
						</div>
					</div>
				<?php } ?>
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
