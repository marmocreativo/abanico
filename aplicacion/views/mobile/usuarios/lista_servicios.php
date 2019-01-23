<!-- empieza panel usuario resposivo -->

<div class="fila-gris">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('mobile/usuarios/widgets/menu_control_usuario'); ?>
      </div>
    </div>
  </div>
</div>

<div class="container py-3 mb-3">
  <div class="row">
    <div class="col-12">

      <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h2 class="h5 mb-0 pt-1"> <span class="fa fa-box"></span> Tus Servicios</h2>
          </div>
          <div class="opciones">
              <a href="" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span></a>
          </div>
        </div>
        <div class="card-body">
          <h3 class="h6"><strong>Lorem ipsum dolor</strong></h3>
          <p>Activo</p>
          <div class="btn-group float-right">
            <a href="" class="btn btn-sm btn-warning" title="Editar Dirección"> <span class="fa fa-pencil-alt"></span> </a>
            <button data-enlace="" class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Dirección"> <span class="fa fa-trash"></span> </button>
          </div>
        </div>
        <hr>
        <div class="card-body">
          <h3 class="h6"><strong>Lorem ipsum dolor</strong></h3>
          <p>Activo</p>
          <div class="btn-group float-right">
            <a href="" class="btn btn-sm btn-warning" title="Editar Dirección"> <span class="fa fa-pencil-alt"></span> </a>
            <button data-enlace="" class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Dirección"> <span class="fa fa-trash"></span> </button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<hr><hr><hr>

<!-- termina panel usuario resposivo -->

<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="titulo">
                <h2 class="h5 mb-0"> <span class="fa fa-box"></span> Tus Servicios</h2>
              </div>
              <div class="opciones">
                  <a href="<?php echo base_url('usuario/servicios/crear'); ?>" class="btn btn-success"> <span class="fa fa-plus"></span> Nuevo Servicio </a>
              </div>
            </div>
            <div class="card-body py-0">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Servicio</th>
                    <th>Estado</th>
                    <th class="text-right">Controles</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($servicios as $servicio){ ?>
                  <tr>
                    <td><?php echo $servicio->SERVICIO_NOMBRE; ?></td>
                    <td><?php echo $servicio->SERVICIO_ESTADO; ?></td>
                    <td>
                      <div class="btn-group float-right">
                        <a href="<?php echo base_url('usuario/servicios/actualizar?id='.$servicio->ID_SERVICIO); ?>" class="btn btn-sm btn-warning" title="Editar Servicio"> <span class="fa fa-pencil-alt"></span> </a>
                        <button data-enlace='<?php echo base_url('usuario/servicios/borrar?id='.$servicio->ID_SERVICIO); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar Servicio"> <span class="fa fa-trash"></span> </button>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
