<div class="contenido_principal">
  <div class="container">
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
                   <div class="form-group">
                     <label for="ImagenCategoria">Imagen Categoria</label>
                     <input type="file" class="form-control" id="ImagenCategoria" name="ImagenCategoria" placeholder="" value="<?php echo $categoria['CATEGORIA_DESCRIPCION']; ?>">
                   </div>
                 </div>
               </div>
               <hr>
               <button type="submit" class="btn btn-primary float-right">Guardar</button>
             </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
