<div class="contenido_principal">
  <?php retro_alimentacion(); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center py-4">
        <h1>Lista de empresas</h1>
        <a href="<?php echo base_url('tienda-mayoreo/crear_empresa'); ?>" class="btn btn-outline-success"> <i class="fas fa-plus"></i> Agregar una nueva empresa</a>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <form class="" action="<?php echo base_url('tienda-mayoreo/lista_empresas'); ?>" method="get">
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
        <table class="table table-sm table-striped">
          <tr>
            <th>Empresa</th>
            <th class="text-center">Controles</th>
          </tr>
          <?php foreach($empresas as $empresa){ ?>
          <tr>
            <td>
              <h6><?php echo $empresa->EMPRESA_NOMBRE; ?></h6>
              <p><b><?php echo $empresa->RFC; ?></b></p>
              <p>
                <?php echo $empresa->CONTACTO_NOMBRE.' '.$empresa->CONTACTO_APELLIDOS; ?><br>
                <?php echo $empresa->CONTACTO_CORREO; ?>
              </p>
            </td>
            <td>
              <a href="<?php echo base_url('tienda-mayoreo/lista_pedidos?id_empresa='.$empresa->ID); ?>" class="btn btn-success btn-block"> <i class="fas fa-shopping-bag"></i> Pedidos</a>
              <a href="<?php echo base_url('tienda-mayoreo/actualizar_empresa?id_empresa='.$empresa->ID); ?>" class="btn btn-warning btn-block btn-sm"> <i class="fas fa-pencil-alt"></i> Editar</a>
            </td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>
