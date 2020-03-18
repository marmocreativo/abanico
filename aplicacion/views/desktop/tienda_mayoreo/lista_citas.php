<div class="contenido_principal">
  <?php retro_alimentacion(); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h1>Lista de citas</h1>
        <?php if(isset($_GET['id_empresa'])&&!empty($_GET['id_empresa'])){ ?>
          <p class="h4">Pedidos de <b><?php $empresa = $this->GeneralModel->detalles('empresas',['ID'=>$_GET['id_empresa']]); echo $empresa['EMPRESA_NOMBRE']; ?></b> </p>
        <?php } ?>
        <a href="<?php echo base_url('tienda-mayoreo/crear_cita'); ?>" class="btn btn-outline-success"> <i class="fas fa-plus"></i> Agregar una nueva cita</a>
      </div>
    </div>
    <div class="row">
      <div class="col py-3 bg-light mb-4 border">
        <!--
        <form class="" action="<?php echo base_url('tienda-mayoreo/lista_pedidos'); ?>" method="get">
          <div class="row">
            <div class="col-10">
              <div class="form-group">
                <input type="text" class="form-control" name="busqueda" placeholder="Busqueda" value="<?php if(isset($_GET['busqueda'])){ echo $_GET['busqueda']; } ?>">
              </div>
            </div>
            <div class="col-2 pl-0">
              <button type="submit" class="btn btn-primary btn-block"> <i class="fas fa-search"></i> </button>
            </div>
          </div>
        </form>
      -->
          <?php foreach($citas as $cita){ ?>
            <div class="card mb-4">
              <div class="card-header bg-secondary text-white p-0">
                <table class="table table-borderless m-0">
                  <tr>
                    <td>Fecha:<br>
                    <b><?php echo date('d / M / Y',strtotime($cita->PEDIDO_FECHA_CITA)); ?></b></td>
                    <td>Hora:<br>
                    <b><?php echo $cita->PEDIDO_HORA_CITA; ?></b></td>
                  </tr>
                </table>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-sm">
                  <tr>
                    <td>Nombre:</td>
                    <td><?php echo $cita->PEDIDO_NOMBRE; ?></td>
                  </tr>
                  <tr>
                    <td>Correo:</td>
                    <td><?php echo $cita->PEDIDO_CORREO; ?></td>
                  </tr>
                  <tr>
                    <td>Teléfono:</td>
                    <td><?php echo $cita->PEDIDO_TELEFONO; ?></td>
                  </tr>
                  <tr>
                    <td>Direccion:</td>
                    <td><?php echo $cita->PEDIDO_DIRECCION; ?></td>
                  </tr>
                </table>
              </div>
            </div>
          <?php } ?>
      </div>
    </div>
  </div>
</div>
