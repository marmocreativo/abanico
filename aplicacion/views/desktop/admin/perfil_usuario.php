<div class="contenido_principal">
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 fila fila-gris p-0">
      <?php $this->load->view('desktop/admin/widgets/menu_control_administrador'); ?>
    </div>
    <div class="col-3 mt-3">
      <div class="row justify-content-center">
        <div class="col-8 col-md-6">
            <img src="<?php echo base_url('assets/global/img/usuario_default.png') ?>" class="img-fluid img-thumbnail rounded-circle mx-auto" alt="">
        </div>
      </div>
      <div class="row">
        <div class="col text-center">
          <h2 class="h6"><?php  echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?></h2>
        </div>
      </div>
      <div class="card">
        <div class="card-body p-0">
          <table class="table table-sm table-striped" style="font-size:0.8em;">
            <tr>
              <td> <strong>Identificador:</strong> </td>
              <td><?php echo $usuario['ID_USUARIO']; ?></td>
            </tr>
            <tr>
            <tr>
              <td> <strong>Nombre:</strong> </td>
              <td><?php echo $usuario['USUARIO_NOMBRE']; ?></td>
            </tr>
            <tr>
              <td> <strong>Apellidos:</strong> </td>
              <td><?php echo $usuario['USUARIO_APELLIDOS']; ?></td>
            </tr>
            <tr>
              <td> <strong>Correo:</strong> </td>
              <td><?php echo $usuario['USUARIO_CORREO']; ?></td>
            </tr>
            <tr>
              <td> <strong>Teléfono:</strong> </td>
              <td><?php echo $usuario['USUARIO_TELEFONO']; ?></td>
            </tr>
            <tr>
              <td> <strong>Fecha de Registro:</strong> </td>
              <td><?php echo $usuario['USUARIO_FECHA_REGISTRO']; ?></td>
            </tr>
            <tr>
              <td> <strong>Última Actualización</strong> </td>
              <td><?php echo $usuario['USUARIO_FECHA_ACTUALIZACION']; ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="col mt-3">
      <div class="row">

        <div class="col-6">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="titulo">
                <h1 class="h5"> <span class="fa fa-store"></span> Tienda</h1>
              </div>
            </div>
            <div class="card-body p-0">
              <?php if(!isset($tienda)||empty($tienda)){ ?>
                <a href="<?php echo base_url('admin/tiendas/crear?id_usuario=').$_GET['id']; ?>" class="btn btn-success btn-block"> <span class="fa fa-plus"></span> Crear Tienda </a>
              <?php }else{ ?>
                  <table class="table table-sm table-striped" style="font-size:0.8em;">
                    <tr>
                      <td> <strong>Identificador:</strong> </td>
                      <td><?php echo $tienda['ID_TIENDA']; ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td> <strong>Nombre:</strong> </td>
                      <td><?php echo $tienda['TIENDA_NOMBRE']; ?></td>
                    </tr>
                    <tr>
                      <td> <strong>Razón Social:</strong> </td>
                      <td><?php echo $tienda['TIENDA_RAZON_SOCIAL']; ?></td>
                    </tr>
                    <tr>
                      <td> <strong>R.F.C.</strong> </td>
                      <td><?php echo $tienda['TIENDA_RFC']; ?></td>
                    </tr>
                  </table>
                  <hr>
                  <a href="<?php echo base_url('admin/productos/usuario?id_usuario=').$_GET['id']; ?>" class="btn btn-success btn-block"> <span class="fa fa-plus"></span> Ver productos </a>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="titulo">
                <h1 class="h5"> <span class="fa fa-hammer"></span> Servicios</h1>
              </div>
            </div>
            <div class="card-body">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
                <hr>
              <?php } ?>

            </div>
          </div>
        </div>
        <div class="col-12 mt-4">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="titulo">
                <h1 class="h5"> <span class="fa fa-map"></span> Direcciones</h1>
              </div>
            </div>
            <div class="card-body">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
                <hr>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
