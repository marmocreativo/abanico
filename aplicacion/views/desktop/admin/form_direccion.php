<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-user"></span> Nueva Direccion</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>

          <form class="" action="<?php echo base_url('admin/tiendas/crear'); ?>" method="post">
            <input type="hidden" name="IdUsuario" value="<?php echo $_GET['id_usuario']; ?>">
              <h3>Datos Requeridos</h3>
               <div class="form-group">
                 <label for="CalleDireccion">Calle y Número</label>
                 <textarea name="CalleDireccion" class="form-control" rows="5" cols="80"></textarea>
               </div>
               <div class="form-group">
                 <label for="ColoniaDireccion">Colonia / Barrio</label>
                 <input type="text" class="form-control" id="ColoniaDireccion" name="ColoniaDireccion" placeholder="" value="">
               </div>
               <div class="form-group">
                 <label for="ColoniaDireccion">Delegación / municipio</label>
                 <input type="text" class="form-control" id="ColoniaDireccion" name="ColoniaDireccion" placeholder="" value="">
               </div>
               <div class="form-group">
                 <label for="ColoniaDireccion">Ciudad</label>
                 <input type="text" class="form-control" id="ColoniaDireccion" name="ColoniaDireccion" placeholder="" value="">
               </div>
               <div class="form-group">
                 <label for="TiendaRFC">R.F.C.</label>
                 <input type="text" class="form-control" id="TiendaRFC" name="TiendaRFC" placeholder="" value="" required>
               </div>
               <div class="form-group">
                 <label for="TiendaTelefono">Teléfono</label>
                 <input type="text" class="form-control" id="TiendaTelefono" name="TiendaTelefono" placeholder="" value="">
               </div>
               <hr>
               <button type="submit" class="btn btn-primary float-right">Registrar</button>
             </form>
        </div>
      </div>
    </div>
  </div>
</div>
