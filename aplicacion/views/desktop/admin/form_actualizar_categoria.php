
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
    <div class="col mt-3">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-list"></span> Nueva Categoria</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/categorias/actualizar'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="TipoCategoria" value="<?php echo $categoria['CATEGORIA_TIPO']; ?>">
            <input type="hidden" name="PadreCategoria" value="<?php echo $categoria['CATEGORIA_PADRE']; ?>">
            <input type="hidden" name="Identificador" value="<?php echo $categoria['ID_CATEGORIA']; ?>">
            <input type="hidden" name="UrlCategoria" value="<?php echo $categoria['CATEGORIA_URL']; ?>">
            <input type="hidden" name="ImagenActualCategoria" value="<?php echo $categoria['CATEGORIA_IMAGEN']; ?>">
            <input type="hidden" name="Tab" value="<?php if(isset($_GET['tab'])){ echo $_GET['tab']; } ?>">
               <div class="form-group">
                 <label for="NombreCategoria">Nombre</label>
                 <input type="text" class="form-control" id="NombreCategoria" name="NombreCategoria" placeholder="" value="<?php echo $categoria['CATEGORIA_NOMBRE']; ?>" required>
               </div>
               <div class="form-group">
                 <label for="DescripcionCategoria">Descripción</label>
                 <input type="text" class="form-control" id="DescripcionCategoria" name="DescripcionCategoria" placeholder="" value="<?php echo $categoria['CATEGORIA_DESCRIPCION']; ?>">
               </div>
               <hr>
               <h5><span class="fas fa-paint-brush"></span> Apariencia</h5>
               <div class="row">
                 <div class="col">
                   <div class="form-group">
                     <label for="ColorCategoria">Color de Categoría</label>
                     <select class="form-control" id="ColorCategoria" name="ColorCategoria">
                       <option value="-default">  Elije un color</option>
                       <option value="-primary" class="bg-primary" <?php if($categoria['CATEGORIA_COLOR']=='-primary'){ echo 'selected'; } ?>>  Color 1</option>
                       <option value="-secondary" class="bg-secondary" <?php if($categoria['CATEGORIA_COLOR']=='-secondary'){ echo 'selected'; } ?>> Color 2 </option>
                       <option value="-success" class="bg-success" <?php if($categoria['CATEGORIA_COLOR']=='-success'){ echo 'selected'; } ?>> Color 3 </option>
                       <option value="-warning" class="bg-warning" <?php if($categoria['CATEGORIA_COLOR']=='-warning'){ echo 'selected'; } ?>> Color 4 </option>
                       <option value="-danger" class="bg-danger" <?php if($categoria['CATEGORIA_COLOR']=='-danger'){ echo 'selected'; } ?>> Color 5 </option>
                       <option value="-light" class="bg-light" <?php if($categoria['CATEGORIA_COLOR']=='-light'){ echo 'selected'; } ?>> Color 6 </option>
                       <option value="-dark" class="bg-dark" <?php if($categoria['CATEGORIA_COLOR']=='-dark'){ echo 'selected'; } ?>> Color 7 </option>
                       <option value="-primary-1" class="bg-primary-1" <?php if($categoria['CATEGORIA_COLOR']=='-primary-1'){ echo 'selected'; } ?>>  Color 8</option>
                       <option value="-primary-2" class="bg-primary-2" <?php if($categoria['CATEGORIA_COLOR']=='-primary-2'){ echo 'selected'; } ?>>  Color 9</option>
                       <option value="-primary-3" class="bg-primary-3" <?php if($categoria['CATEGORIA_COLOR']=='-primary-3'){ echo 'selected'; } ?>>  Color 10</option>
                       <option value="-primary-4" class="bg-primary-4" <?php if($categoria['CATEGORIA_COLOR']=='-primary-4'){ echo 'selected'; } ?>>  Color 11</option>
                       <option value="-primary-5" class="bg-primary-5" <?php if($categoria['CATEGORIA_COLOR']=='-primary-5'){ echo 'selected'; } ?>>  Color 12</option>
                       <option value="-primary-6" class="bg-primary-6" <?php if($categoria['CATEGORIA_COLOR']=='-primary-6'){ echo 'selected'; } ?>>  Color 13</option>
                       <option value="-primary-7" class="bg-primary-7" <?php if($categoria['CATEGORIA_COLOR']=='-primary-7'){ echo 'selected'; } ?>>  Color 14</option>
                       <option value="-primary-8" class="bg-primary-8" <?php if($categoria['CATEGORIA_COLOR']=='-primary-8'){ echo 'selected'; } ?>>  Color 15</option>
                       <option value="-primary-9" class="bg-primary-9" <?php if($categoria['CATEGORIA_COLOR']=='-primary-9'){ echo 'selected'; } ?>>  Color 16</option>
                       <option value="-primary-10" class="bg-primary-10" <?php if($categoria['CATEGORIA_COLOR']=='-primary-10'){ echo 'selected'; } ?>>  Color 17</option>
                       <option value="-primary-11" class="bg-primary-11" <?php if($categoria['CATEGORIA_COLOR']=='-primary-11'){ echo 'selected'; } ?>>  Color 18</option>
                       <option value="-primary-12" class="bg-primary-12" <?php if($categoria['CATEGORIA_COLOR']=='-primary-12'){ echo 'selected'; } ?>>  Color 19</option>
                       <option value="-primary-13" class="bg-primary-13" <?php if($categoria['CATEGORIA_COLOR']=='-primary-13'){ echo 'selected'; } ?>>  Color 20</option>
                       <option value="-primary-14" class="bg-primary-14" <?php if($categoria['CATEGORIA_COLOR']=='-primary-14'){ echo 'selected'; } ?>>  Color 21</option>
                       <option value="-primary-15" class="bg-primary-15" <?php if($categoria['CATEGORIA_COLOR']=='-primary-15'){ echo 'selected'; } ?>>  Color 22</option>
                       <option value="-primary-16" class="bg-primary-16" <?php if($categoria['CATEGORIA_COLOR']=='-primary-16'){ echo 'selected'; } ?>>  Color 23</option>
                       <option value="-primary-17" class="bg-primary-17" <?php if($categoria['CATEGORIA_COLOR']=='-primary-17'){ echo 'selected'; } ?>>  Color 24</option>
                       <option value="-primary-18" class="bg-primary-18" <?php if($categoria['CATEGORIA_COLOR']=='-primary-18'){ echo 'selected'; } ?>>  Color 25</option>
                       <option value="-primary-19" class="bg-primary-19" <?php if($categoria['CATEGORIA_COLOR']=='-primary-19'){ echo 'selected'; } ?>>  Color 26</option>
                       <option value="-primary-20" class="bg-primary-20" <?php if($categoria['CATEGORIA_COLOR']=='-primary-20'){ echo 'selected'; } ?>>  Color 27</option>
                     </select>
                   </div>
                 </div>
                 <div class="col">
                   <div class="col">
                     <div class="form-group">
                       <label for="IconoCategoria">Imagen Categoría</label>
                       <br>
                     <!-- Button tag -->
                      <button type="button" class="btn btn-primary btn-block" name="IconoCategoria" role="iconpicker" data-icon="<?php echo $categoria['CATEGORIA_ICONO']; ?>"></button>
                    </div>
                   </div>
                 </div>
                 <div class="col">
                   <h6>Imagen Actual</h6>
                   <img src="<?php echo base_url('contenido/img/categorias/completo/'.$categoria['CATEGORIA_IMAGEN']); ?>" alt="" width="300">
                   <div class="form-group">
                     <label for="ImagenCategoria">Nueva Imagen Categoria</label>
                     <input type="file" class="form-control" id="ImagenCategoria" name="ImagenCategoria" placeholder="" value="<?php echo $categoria['CATEGORIA_DESCRIPCION']; ?>">
                   </div>
                 </div>
               </div>
               <hr>
               <div class="col-12">

                 <button type="submit" class="btn btn-primary float-right">Guardar</button>
               </div>
             </form>
             <hr>

             <h4> <i class="fa fa-language"></i> Traducciones</h4>
             <table class="table table-sm table-bordered">
               <tbody>
                 <?php foreach($lenguajes as $lenguaje){ ?>
                   <?php if($lenguaje->LENGUAJE_ISO!='es'){ ?>
                 <tr>
                   <td width="15%"> <h4 class="text-center"> <?php echo $lenguaje->LENGUAJE_NOMBRE; ?> </h4></td>
                   <td>
                     <?php $traduccion = $this->TraduccionesModel->lista($categoria['ID_CATEGORIA'],'categoria',$lenguaje->LENGUAJE_ISO); ?>
                     <?php if(empty($traduccion)){ ?>
                     <form class="" action="<?php echo base_url('admin/categorias/crear_traduccion'); ?>" method="post">
                       <input type="hidden" name="IdObjeto" value="<?php echo $categoria['ID_CATEGORIA'] ?>">
                       <input type="hidden" name="TipoObjeto" value="categoria">
                       <input type="hidden" name="Lenguaje" value="<?php echo $lenguaje->LENGUAJE_ISO; ?>">
                       <div class="form-group">
                         <label for="TraduccionTitulo">Título</label>
                         <input type="text" class="form-control" name="TraduccionTitulo" value="" required>
                       </div>
                       <hr>
                       <button type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-save"></i> Guardar Traducción</button>
                     </form>
                   <?php }else{ ?>
                     <form class="" action="<?php echo base_url('admin/categorias/actualizar_traduccion'); ?>" method="post">
                       <input type="hidden" name="IdTraduccion" value="<?php echo $traduccion['ID_TRADUCCION'] ?>">
                       <input type="hidden" name="IdObjeto" value="<?php echo $traduccion['ID_OBJETO'] ?>">
                       <input type="hidden" name="TipoObjeto" value="<?php echo $traduccion['TIPO_OBJETO'] ?>">
                       <input type="hidden" name="Lenguaje" value="<?php echo $traduccion['LENGUAJE'] ?>">
                       <div class="form-group">
                         <label for="TraduccionTitulo">Título</label>
                         <input type="text" class="form-control" name="TraduccionTitulo" value="<?php echo $traduccion['TITULO'] ?>" required>
                       </div>
                       <hr>
                       <button type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-save"></i> Guardar Traducción</button>
                     </form>
                   <?php } ?>
                   </td>
                 </tr>
               <?php } ?>
               <?php } ?>
               </tbody>
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
