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

          <form class="" action="<?php echo base_url('admin/categorias/crear'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="TipoCategoria" value="<?php echo $tipo_categoria; ?>">
            <input type="hidden" name="PadreCategoria" value="<?php echo $categoria_padre; ?>">
               <div class="form-group">
                 <label for="NombreCategoria">Nombre</label>
                 <input type="text" class="form-control" id="NombreCategoria" name="NombreCategoria" placeholder="" value="" required>
               </div>
               <div class="form-group">
                 <label for="DescripcionCategoria">Descripción</label>
                 <input type="text" class="form-control" id="DescripcionCategoria" name="DescripcionCategoria" placeholder="" value="">
               </div>
               <hr>
               <h5><span class="fas fa-paint-brush"></span> Apariencia</h5>
               <div class="row">
                 <div class="col">
                   <div class="form-group">
                     <label for="ColorCategoria">Color de Categoría</label>
                     <select class="form-control" id="ColorCategoria" name="ColorCategoria">
                       <option value="-default">  Elije un color</option>
                       <option value="-primary" class="bg-primary">  Color 1</option>
                       <option value="-secondary" class="bg-secondary"> Color 2 </option>
                       <option value="-success" class="bg-success"> Color 3 </option>
                       <option value="-warning" class="bg-warning"> Color 4 </option>
                       <option value="-danger" class="bg-danger"> Color 5 </option>
                       <option value="-light" class="bg-light"> Color 6 </option>
                       <option value="-dark" class="bg-dark"> Color 7 </option>
                       <option value="-primary-1" class="bg-primary-1">  Color 8</option>
                       <option value="-primary-2" class="bg-primary-2">  Color 9</option>
                       <option value="-primary-3" class="bg-primary-3">  Color 10</option>
                       <option value="-primary-4" class="bg-primary-4">  Color 11</option>
                       <option value="-primary-5" class="bg-primary-5">  Color 12</option>
                       <option value="-primary-6" class="bg-primary-6">  Color 13</option>
                       <option value="-primary-7" class="bg-primary-7">  Color 14</option>
                       <option value="-primary-8" class="bg-primary-8">  Color 15</option>
                     </select>
                   </div>
                 </div>
                 <div class="col">
                   <div class="col">
                     <div class="form-group">
                       <label for="IconoCategoria">Imagen Categoría</label>
                       <br>
                     <!-- Button tag -->
                      <button type="button" class="btn btn-primary btn-block" name="IconoCategoria" role="iconpicker" data-icon="fas fa-list"></button>
                    </div>
                   </div>
                 </div>
                 <div class="col">
                   <div class="form-group">
                     <label for="ImagenCategoria">Imagen Categoria</label>
                     <input type="file" class="form-control" id="ImagenCategoria" name="ImagenCategoria" placeholder="" value="">
                   </div>
                 </div>
               </div>
               <hr>
               <button type="submit" class="btn btn-primary float-right">Crear</button>
             </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
