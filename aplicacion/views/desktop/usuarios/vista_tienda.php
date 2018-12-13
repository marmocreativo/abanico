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
  <?php foreach($tienda as $tienda){ ?>
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col-sm-6 col-md-8">
          <div class="card">
            <div class="card-header">
              <h4> <span class="fa fa-store"></span> <?php echo $tienda->TIENDA_NOMBRE; ?></h4>
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
                    <img src="../assets/global/img/usuario_default.jpg" alt="" class="img-fluid img-thumbnail">
                  </div>
                  <div class="col-12 col-sm-9">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td><strong>Razón Social: </strong></td>
                          <td><?php echo $tienda->TIENDA_RAZON_SOCIAL; ?></td>
                        </tr>
                        <tr>
                          <td><strong>R.F.C.: </strong></td>
                          <td><?php echo $tienda->TIENDA_RFC; ?></td>
                        </tr>
                        <tr>
                          <td><strong>Teléfono: </strong></td>
                          <td><?php echo $tienda->TIENDA_TELEFONO; ?></td>
                        </tr>
                        <tr>
                          <td><strong>Registro: </strong></td>
                          <td><?php echo date("d-m-Y", strtotime($tienda->TIENDA_FECHA_REGISTRO)); ?></td>
                        </tr>
                        <tr>
                          <td><strong>Actualizado: </strong></td>
                          <td><?php echo date("d-m-Y", strtotime($tienda->TIENDA_FECHA_ACTUALIZACION)); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer">

            </div>
          </div>
          <hr>
            <div class="card">
              <div class="card-header">
                <h5 class="float-left"> <span class="fa fa-boxes"></span> Productos</h5>
                <a href="<?php echo base_url('usuario/producto_form'); ?>" class="btn btn-success float-right"> <span class="fa fa-plus"></span> Nuevo Producto</a>
              </div>
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>SKU</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th class="text-right">Controles</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($productos as $producto){ ?>
                    <tr>
                      <td><?php echo $producto->PRODUCTO_NOMBRE; ?></td>
                      <td><?php echo $producto->PRODUCTO_SKU; ?></td>
                      <td><?php echo $producto->PRODUCTO_CANTIDAD; ?></td>
                      <td>$<?php echo $producto->PRODUCTO_PRECIO; ?></td>
                      <td>
                        <div class="btn-group float-right">
                          <a href="<?php echo base_url('usuario/producto_form_actualizar?id='.$producto->ID_PRODUCTO); ?>" class="btn btn-xs btn-warning" title="Editar Producto"> <span class="fa fa-pencil-alt"></span> </a>
                          <a href="<?php echo base_url('usuario/borrar_producto?id='.$producto->ID_PRODUCTO); ?>" class="btn btn-xs btn-danger" title="Editar Producto"> <span class="fa fa-ban"></span> </a>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="col-sm-3 col-md-2">
          <?php $this->load->view('desktop/usuarios/widgets/mensajes_recientes'); ?>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
