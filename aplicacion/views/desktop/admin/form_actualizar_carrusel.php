
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
      <div class="card">
        <div class="card-header">
          <h5> <i class="fa fa-file"></i> Editar Carrusel</h5>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/carruseles/actualizar');?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="Identificador" value="<?php echo $carrusel['ID']; ?>">
            <div class="row">
              <div class="col-9">
								<div class="form-group">
                  <label for="Titulo">Titulo </label>
                  <input type="text" name="Titulo" class="form-control" value="<?php echo $carrusel['TITULO']; ?>">
                </div>
								<div class="form-group">
                  <label for="Descripcion">Descripción </label>
                  <input type="text" name="Descripcion" class="form-control" value="<?php echo $carrusel['DESCRIPCION']; ?>">
                </div>
								<div class="form-group">
                  <label for="Tipo">Cargar de: </label>
									<select class="form-control" id="Tipo" name="Tipo" placeholder="">
										<option value="todos" <?php if($carrusel['TIPO']=='todos'){ echo 'selected';} ?>>Todos los productos</option>
										<option value="incluyente" <?php if($carrusel['TIPO']=='incluyente'){ echo 'selected';} ?>>Solo ciertas Categorías</option>
										<option value="excluyente" <?php if($carrusel['TIPO']=='excluyente'){ echo 'selected';} ?>>Excepto ciertas categorías</option>
                  </select>
                </div>
								<div class="row">
                    <!-- inicia categoria -->
										<?php $categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','',''); ?>
										<?php $relacion_categorias = explode(',',$carrusel['CATEGORIAS']); ?>
										<?php $i = 1; foreach($categorias as $categoria){ ?>
											<div class="col-12 card"> <!-- Título y botón de categoría -->
												<div class="card-header" id="heading<?php echo $i; ?>">
													<h5 class="mb-0">
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
															<h6><i class="<?php echo $categoria->CATEGORIA_ICONO; ?>"></i> <?php echo $categoria->CATEGORIA_NOMBRE; ?></h6>
															<?php $segundo_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],$categoria->CATEGORIA_TIPO,'',''); ?>
														</button>
													</h5>
												</div>

													<div class="row collapse" id="collapse<?php echo $i; ?>" aria-labelledby="heading<?php echo $i; ?>">
													<?php foreach($segundo_categorias as $segunda_categoria){ ?>
														<div class="col-4">
															<div class="p-3">
																<div class="custom-control custom-checkbox">
																	<input  type="checkbox"
																					id="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>"
																					name="Categorias[]" class="custom-control-input"
																					value="<?php echo $segunda_categoria->CATEGORIA_URL; ?>"
																					<?php if(in_array($segunda_categoria->CATEGORIA_URL,$relacion_categorias)){ echo 'checked'; } ?>
																					>
																	<label class="custom-control-label h6" for="categoria-<?php echo $segunda_categoria->ID_CATEGORIA; ?>">-<?php echo $segunda_categoria->CATEGORIA_NOMBRE; ?></label>
																</div>
															<?php $tercero_categorias = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$segunda_categoria->ID_CATEGORIA],$segunda_categoria->CATEGORIA_TIPO,'',''); ?>
															<ul class="list list-unstyled ml-3">
																<?php foreach($tercero_categorias as $tercera_categoria){ ?>
																<li>
																	<div class="custom-control custom-checkbox">
																		<input  type="checkbox"
																						id="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>"
																						name="Categorias[]" class="custom-control-input"
																						value="<?php echo $tercera_categoria->CATEGORIA_URL; ?>"
																						<?php if(in_array($tercera_categoria->CATEGORIA_URL,$relacion_categorias)){ echo 'checked'; } ?>
																						>
																		<label class="custom-control-label" for="categoria-<?php echo $tercera_categoria->ID_CATEGORIA; ?>">-<?php echo $tercera_categoria->CATEGORIA_NOMBRE; ?></label>
																	</div>
																</li>
															<?php } ?>
															</ul>
															</div>
														</div>
													<?php } ?>
													</div>
												</div>
										<?php $i ++; } ?>
                    <!-- termina categoria -->
                </div>
								<div class="form-group">
                  <label for="Artesanal">Artesanal </label>
									<select class="form-control" id="Artesanal" name="Artesanal" placeholder="">
                  	<option value="" <?php if($carrusel['ARTESANAL']==''){ echo 'selected';} ?> >Todos</option>
										<option value="si" <?php if($carrusel['ARTESANAL']=='si'){ echo 'selected';} ?> >Solo Artesanales</option>
										<option value="no" <?php if($carrusel['ARTESANAL']=='no'){ echo 'selected';} ?> >Todo excepto artesanales</option>
                  </select>
                </div>
								<div class="form-group">
                  <label for="Origen">Origen </label>
									<select class="form-control" id="Origen" name="Origen" placeholder="">
                  	<option value="" <?php if($carrusel['ORIGEN']==''){ echo 'selected';} ?> >Todos</option>
										<option value="México" <?php if($carrusel['ORIGEN']=='México'){ echo 'selected';} ?> >Solo Mexicano</option>
										<option value="Otro" <?php if($carrusel['ORIGEN']=='Otro'){ echo 'selected';} ?> >Todo excepto Mexicano</option>
                  </select>
                </div>
								<div class="form-group">
                  <label for="OrdenProductos">Ordenar por</label>
                  <select class="form-control" id="OrdenProductos" name="OrdenProductos" placeholder="">
                  	<option value="" <?php if($carrusel['ORDEN_PRODUCTOS']==''){ echo 'selected';} ?>>Aleatorio</option>
										<option value="PRODUCTO_FECHA_REGISTRO DESC" <?php if($carrusel['ORDEN_PRODUCTOS']=='PRODUCTO_FECHA_REGISTRO DESC'){ echo 'selected';} ?> >Nuevos Primero</option>
										<option value="PRODUCTO_NOMBRE ASC" <?php if($carrusel['ORDEN_PRODUCTOS']=='PRODUCTO_NOMBRE ASC'){ echo 'selected';} ?> >A-Z</option>
										<option value="PRODUCTO_NOMBRE DESC" <?php if($carrusel['ORDEN_PRODUCTOS']=='PRODUCTO_NOMBRE DESC'){ echo 'selected';} ?> >Z-A</option>
                  </select>
                </div>
								<div class="form-group">
                  <label for="Limite">Limite </label>
                  <input type="number" name="Limite" class="form-control" min="10" value="<?php echo $carrusel['LIMITE']; ?>">
                </div>
								<div class="form-group">
                  <label for="Enlace">Enlace </label>
                  <input type="text" name="Enlace" class="form-control" value="<?php echo $carrusel['ENLACE']; ?>">
                </div>
              </div>
              <div class="col-3">
                  <div class="form-group">
                    <label for="Estado">Estado de la publicacion</label>
                    <select class="form-control" id="Estado" name="Estado" placeholder="">
                      <option value="activo"  <?php if($carrusel['ESTADO']=='activo'){ echo 'selected';} ?>>Publicado</option>
                      <option value="inactivo" <?php if($carrusel['ESTADO']=='inactivo'){ echo 'selected';} ?>>Borrador</option>
                    </select>
                  </div>
              </div>
              <div class="col">
                 <hr>
                 <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Guardar Publicación</button>
              </div>
            </div>
          </form>
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
