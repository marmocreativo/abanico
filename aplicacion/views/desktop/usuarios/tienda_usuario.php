<div class="contenido_principal">
  <div class="fila fila-titulo">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <h1 class="h3"> <span class="fa fa-store"></span> Tienda <?php echo $_SESSION['usuario']['nombre'] ?></h1>
        </div>
      </div>
    </div>
  </div>
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col-sm-6 col-md-8">
          <div class="card">
            <div class="card-header">
              <h4>Tu tienda</h4>
            </div>
            <div class="card card-info">
              <div class="card-body">
                <p>Hola, Bienvenido al creador de tiendas, al crear tu tienda tendrás la facultad de.</p>
                <ul>
                  <li>Crear Productos y ofrecerlos a la venta</li>
                  <li>Crear Servicios y ofrecerlos en nuestro catálogo</li>
                </ul>
              </div>
            </div>
            <div class="card-body">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <form class="" action="<?php echo base_url('usuario/actualizar_tienda');?>" method="post">
                <div class="row">
                  <div class="col-12 col-sm-3">
                    <img src="../assets/global/img/usuario_default.jpg" alt="" class="img-fluid">
                  </div>
                  <div class="col-12 col-sm-9">
                    <h5> <span class="fa fa-store"></span> Datos de tu tienda</h5>
                     <div class="form-group">
                       <label for="TiendaNombre">Nombre Público</label>
                       <input type="text" class="form-control" id="TiendaNombre" name="TiendaNombre" placeholder="" value="">
                     </div>
                     <hr>
                     <h5><span class="fa fa-file-invoice"></span> Datos Fiscales</h5>
                     <div class="form-group">
                       <label for="TiendaRazonSocial">Razón Social</label>
                       <input type="text" class="form-control" id="TiendaRazonSocial" name="TiendaRazonSocial" placeholder="" value="">
                     </div>
                     <div class="form-group">
                       <label for="TiendaRFC">R.F.C.</label>
                       <input type="text" class="form-control" id="TiendaRFC" name="TiendaRFC" placeholder="" value="">
                     </div>
                     <div class="form-group">
                       <label for="TiendaTelefono">Teléfono</label>
                       <input type="text" class="form-control" id="TiendaTelefono" name="TiendaTelefono" placeholder="" value="">
                     </div>
                     <div class="form-check">
                       <input type="checkbox" class="form-check-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                       <label class="form-check-label" for="TerminosyCondiciones">Acepto los Términos y Condiciones de Vendedores</label>
                     </div>
                     <hr>
                     <button type="submit" class="btn btn-primary btn-block">Registrarme</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer">

            </div>
          </div>
        </div>
        <div class="col-sm-3 col-md-2">
        <?php $this->load->view('desktop/usuarios/widgets/mensajes_recientes'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
