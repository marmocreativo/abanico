<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <?php alerta_plan(); ?>
          <?php retro_alimentacion(); ?>
          <?php
            $productos_activo = null;
            $fotografias_producto = null;
            $servicios_activos = null;
            $fotografias_servicios = null;
            $anexos = false;
            $plan = $this->PlanesModel->plan_pendiente_usuario($_SESSION['usuario']['id'],'productos');
            if(!empty($plan)){
              $productos_activo = $plan['PLAN_LIMITE_PRODUCTOS'];
              $fotografias_producto = $plan['PLAN_FOTOS_PRODUCTOS'];
              $servicios_activos = $plan['PLAN_LIMITE_SERVICIOS'];
              $fotografias_servicios = $plan['PLAN_FOTOS_SERVICIOS'];
              if($plan['PLAN_NIVEL']>1){
                $anexos = true;
              }
            }
            $cantidad_productos = count($productos);
          ?>
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="titulo">
                <h2 class="h5 mb-0"> <span class="fa fa-box"></span> <?php echo $this->lang->line('usuario_lista_productos_titulo'); ?></h2>
              </div>
              <div class="formulario">
                <form class="form-inline" action="<?php echo base_url('usuario/productos/busqueda');?>" method="get">
                  <div class="input-group">
                    <input type="text" class="form-control" id="Busqueda" name="Busqueda" placeholder="Buscar">
                      <div class="input-group-append">
                        <button class="btn btn-outline<?php echo $primary ?>" type="submit"><span class="fa fa-search"></span></button>
                      </div>
                    </div>
                </form>
              </div>
              <div class="opciones">
                <?php if($productos_activo!=null&&($productos_activo>$cantidad_productos||$productos_activo==0)){ ?>
                  <a href="<?php echo base_url('usuario/productos/crear'); ?>" class="btn btn-success"> <span class="fa fa-plus"></span> <?php echo $this->lang->line('usuario_listas_generales_nuevo'); ?> <?php echo $this->lang->line('usuario_lista_productos_singular'); ?> </a>
                <?php }else{ ?>
                  <p class="text-danger">Límite de productos alcanzado</p>
                <?php } ?>
              </div>
            </div>
            <div class="card-body py-0">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th><?php echo $this->lang->line('usuario_lista_productos_nombre'); ?></th>
                    <th><?php echo $this->lang->line('usuario_lista_productos_sku'); ?></th>
                    <th><?php echo $this->lang->line('usuario_lista_productos_cantidad'); ?></th>
                    <th><?php echo $this->lang->line('usuario_lista_productos_precio'); ?></th>
                    <th><?php echo $this->lang->line('usuario_lista_productos_estado'); ?></th>
                    <th class="text-right"><?php echo $this->lang->line('usuario_listas_generales_controles'); ?></th>
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
                      <?php
                        switch ($producto->PRODUCTO_ESTADO) {
                          case 'activo':
                            echo '<p class="text-success">Publicado</p>';
                            break;
                          case 'inactivo':
                            echo '<p class="text-danger">Borrador</p>';
                            break;
                        }
                      ?>
                    </td>
                    <td>
                      <div class="btn-group float-right">
                        <a href="<?php echo base_url('producto/vista_previa'."?id=".$producto->ID_PRODUCTO); ?>" target="_blank" class="btn btn-sm btn-info" title="Vista Previa"> <span class="fa fa-eye"></span> </a>
                        <a href="<?php echo base_url('usuario/productos/actualizar?id='.$producto->ID_PRODUCTO); ?>" class="btn btn-sm btn-warning" title="<?php echo $this->lang->line('usuario_listas_generales_editar'); ?> <?php echo $this->lang->line('usuario_lista_productos_singular'); ?>"> <span class="fa fa-pencil-alt"></span> </a>
                        <button data-enlace='<?php echo base_url('usuario/productos/borrar?id='.$producto->ID_PRODUCTO); ?>' class="btn btn-sm btn-danger borrar_entrada" title="<?php echo $this->lang->line('usuario_listas_generales_eliminar'); ?> <?php echo $this->lang->line('usuario_lista_productos_singular'); ?>"> <span class="fa fa-trash"></span> </button>
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
