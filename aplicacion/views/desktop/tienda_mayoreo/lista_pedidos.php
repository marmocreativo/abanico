<div class="contenido_principal">
  <?php retro_alimentacion(); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h1>Lista de pedidos</h1>
        <?php if(isset($_GET['id_empresa'])&&!empty($_GET['id_empresa'])){ ?>
          <p class="h4">Pedidos de <b><?php $empresa = $this->GeneralModel->detalles('empresas',['ID'=>$_GET['id_empresa']]); echo $empresa['EMPRESA_NOMBRE']; ?></b> </p>
        <?php } ?>
      </div>
    </div>
    <div class="row">
      <div class="col py-3 bg-light mb-4 border">
      <div class="formulario mb-4">
        <form class="form-inline" action="<?php echo base_url('tienda-mayoreo/lista_pedidos'); ?>" method="get">
          <div class="form-group m-0 mr-2">
            <input type="date" class="form-control" name="Fecha" value="<?php if(isset($_GET['Fecha'])){ echo $_GET['Fecha'];}else{ echo date('Y-m-d'); } ?>">
          </div>
          <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-search"></i> Buscar</button>
        </form>
      </div>
          <?php foreach($pedidos as $pedido){ ?>
            <div class="card mb-4">
              <div class="card-header bg-secondary text-white p-0">
                <table class="table table-sm table-borderless m-0">
                  <tr>
                    <td><span style="text-transform:uppercase"><?php echo $pedido->PEDIDO_TIPO; ?></span> / <?php echo $pedido->PEDIDO_ESTADO_PEDIDO; ?></td>
                    <td class="text-right">Folio: <b><?php echo $pedido->PEDIDO_FOLIO; ?></b></td>
                  </tr>
                  <tr>
                    <td colspan="2">Registro: <b><?php echo date('d / M / Y H:i',strtotime($pedido->PEDIDO_FECHA_REGISTRO)); ?></b></td>

                  </tr>
                  <?php if($pedido->PEDIDO_FECHA_ENTREGA!=NULL&&$pedido->PEDIDO_FECHA_ENTREGA!='0000-00-00 00:00:00'){ ?>
                  <tr>
                    <td colspan="2">Entregar el: <b><?php echo date('d / M / Y H:i',strtotime($pedido->PEDIDO_FECHA_ENTREGA)); ?></b></td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
              <div class="card-body p-1">
                <table class="table table-bordered table-sm">
                  <tr>
                    <td>Negocio:</td>
                    <td><?php echo $pedido->PEDIDO_NOMBRE_EMPRESA; ?></td>
                  </tr>
                  <tr>
                    <td>Cliente:</td>
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
                </table>
                <?php $productos = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$pedido->ID_PEDIDO],'','',''); ?>
                <table class="table table-striped table-bordered table-sm">
                  <?php foreach($productos as $producto){ ?>
                    <tr>
                      <td>
                        <img src="<?php echo $producto->PRODUCTO_IMAGEN;  ?>" width="30px;"><br>
                        <?php echo $producto->PRODUCTO_NOMBRE; ?><br>
                        <small>
                          <?php echo $producto->PRODUCTO_DETALLES; ?>
                        </small>
                      <td>
                        <h5>X<?php echo $producto->CANTIDAD; ?></h5>
                      </td>
                    </tr>
                  <?php }?>
                </table>
                <table class="table table-bordered table-sm">
                  <tr>
                    <td class="text-right">Importe Total:</td>
                    <td class="text-right"><b>$<?php echo $pedido->PEDIDO_IMPORTE_TOTAL; ?></b></td>
                  </tr>
                </table>
                <div class="row">
                  <div class="col text-center">
                    Pago: <br><b><?php echo $pedido->PEDIDO_FORMA_PAGO; ?> / <?php echo $pedido->PEDIDO_ESTADO_PAGO; ?></b><br>
                  </div>
                  <div class="col text-center">
                    Factura: <b><?php echo $pedido->PEDIDO_REQUIERE_FACTURA; ?></b><br>
                  </div>
                  <div class="col-12 mt-3">
                    <a href="<?php echo base_url('tienda-mayoreo/pedido_detalles?id_pedido='.$pedido->ID_PEDIDO); ?>" class="btn btn-success btn-block"> Ver detalles y editar</a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
      </div>
    </div>
  </div>
</div>
