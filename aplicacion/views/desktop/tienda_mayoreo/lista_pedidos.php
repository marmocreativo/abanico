<div class="contenido_principal">
  <?php retro_alimentacion(); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h1>Lista de pedidos</h1>
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
          <?php foreach($pedidos as $pedido){ ?>
            <table class="table table-bordered table-sm">
              <tr>
                <td>Folio:</td>
                <td><?php echo $pedido->PEDIDO_FOLIO; ?></td>
              </tr>
              <tr>
                <td>Nombre:</td>
                <td><?php echo $pedido->PEDIDO_NOMBRE; ?></td>
              </tr>
              <tr>
                <td>Correo:</td>
                <td><?php echo $pedido->PEDIDO_CORREO; ?></td>
              </tr>
              <tr>
                <td>Teléfono:</td>
                <td><?php echo $pedido->PEDIDO_TELEFONO; ?></td>
              </tr>
              <tr>
                <td>Direccion:</td>
                <td><?php echo $pedido->PEDIDO_DIRECCION; ?></td>
              </tr>
              <tr>
                <td>Importe Total:</td>
                <td>$<?php echo $pedido->PEDIDO_IMPORTE_TOTAL; ?></td>
              </tr>
            </table>
            <div class="row">
              <div class="col">
                Tipo: <b><?php echo $pedido->PEDIDO_TIPO; ?></b>
              </div>
              <div class="col">
                Estado: <b><?php echo $pedido->PEDIDO_ESTADO_PEDIDO; ?></b>
              </div>
              <div class="col">
                Pago: <b><?php echo $pedido->PEDIDO_ESTADO_PAGO; ?></b><br>
                <?php echo $pedido->PEDIDO_FORMA_PAGO; ?>
              </div>
              <div class="col-12">
                <a href="<?php echo base_url('tienda-mayoreo/pedido_detalles?id_pedido='.$pedido->ID_PEDIDO); ?>" class="btn btn-success btn-block"> Ver detalles y editar</a>
              </div>
            </div>
          <?php } ?>
      </div>
    </div>
  </div>
</div>
