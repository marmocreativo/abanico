<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <div class="titulo">
          <h1 class="h6"> <span class="fa fa-file-signature"></span> Planes</h1>
        </div>
        <div class="opciones d-flex">
          <div class="btn-group btn-sm">
            <a href="<?php echo base_url('admin/planes/crear'); ?>" class="btn btn-sm btn-success"> <span class="fa fa-plus"></span> Nuevo Plan </a>
          </div>

        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-sm table-hover table-striped">
          <thead class="text-light bg<?php echo $primary; ?>">
            <tr>
              <th class="text-center">Nombre</th>
              <th class="text-center">Tipo</th>
              <th class="text-center">Mensualidad</th>
              <th class="text-center">Comisión</th>
              <th class="text-center">Nivel</th>
              <th class="text-right">Controles</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($planes as $plan){ ?>
            <tr>
              <td class="text-center"><?php echo $plan->PLAN_NOMBRE; ?></td>
              <td class="text-center"><?php echo $plan->PLAN_TIPO; ?></td>
              <td class="text-center">$<?php echo $plan->PLAN_MENSUALIDAD; ?></td>
              <td class="text-center"><?php echo $plan->PLAN_COMISION; ?>%</td>
              <td class="text-center"><?php echo $plan->PLAN_NIVEL; ?></td>
              <td class="text-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="<?php echo base_url('admin/planes/actualizar')."?id=".$plan->ID_PLAN; ?>" class="btn btn-sm btn-warning" title="Editar Plan"> <span class="fa fa-pencil-alt"></span> </a>

                  <button type="button" class="btn btn-danger btn-sm borrar_entrada" data-enlace="<?php echo base_url('admin/planes/borrar')."?id=".$plan->ID_PLAN; ?>" title="Eliminar Plan"><span class="fa fa-trash"></span></button>

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
