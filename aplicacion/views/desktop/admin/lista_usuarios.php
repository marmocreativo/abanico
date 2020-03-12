<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
  <div class="kt-container kt-body kt-grid kt-grid--ver" id="kt_body">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

      <!-- begin:: Subheader -->
      <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
        </div>
        <div class="kt-subheader__toolbar">
        </div>
      </div>

      <!-- end:: Subheader -->

      <!-- begin:: Content -->
      <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--Begin::Dashboard 8-->

        <!--Begin::Section-->
        <div class="row mb-3">
          <div class="col-xl-12">

            <!--begin:: Widgets/Trends-->
            <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
              <div class="kt-portlet__body">
  <div class="row">
    <div class="col">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="titulo d-flex align-items-center">
              <h1 class="h6"> <span class="fa fa-user"></span> Usuarios</h1>
            </div>
            <div class="formulario d-flex align-items-center">
              <form class="form-inline" action="<?php echo base_url('admin/usuarios/busqueda');?>" method="get">
                <div class="form-group">
                  <label for="tipo_usuario">Tipo de Usuario</label>
                  <select class="form-control form-control-sm" name="tipo_usuario">
                    <option value="">Todos</option>
                    <option value="usr-1" <?php if($tipo_usuario=='usr-1'){ echo 'selected'; } ?> >Clientes</option>
                    <option value="vnd-2" <?php if($tipo_usuario=='vnd-2'){ echo 'selected'; } ?> >Vendedores</option>
                    <option value="ser-3" <?php if($tipo_usuario=='ser-3'){ echo 'selected'; } ?> >Servidores</option>
                    <option value="vns-4" <?php if($tipo_usuario=='vns-4'){ echo 'selected'; } ?> >Vendedores y Servidores</option>
                    <option value="tec-5" <?php if($tipo_usuario=='tec-5'){ echo 'selected'; } ?> >Técnicos</option>
                    <option value="adm-6" <?php if($tipo_usuario=='adm-6'){ echo 'selected'; } ?> >Administradores</option>
                    <option value="may-7" <?php if($tipo_usuario=='may-7'){ echo 'selected'; } ?> >Vendedores Mayoreo</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="Busqueda" class="sr-only">Busqueda</label>
                  <input type="text" class="form-control form-control-sm" id="Busqueda" name="Busqueda" placeholder="Nombre o Correo" value="<?php if(isset($_GET['Busqueda'])){ echo $_GET['Busqueda']; } ?>">
                </div>
                <div class="form-group">
                  <label for="FechaDesde">Desde</label>
                  <input type="date" class="form-control form-control-sm" name="FechaDesde" value="<?php if(isset($_GET['FechaDesde'])){ echo $_GET['FechaDesde']; } ?>">
                </div>
                <div class="form-group">
                  <label for="FechaHasta">Hasta</label>
                  <input type="date" class="form-control form-control-sm" name="FechaHasta" value="<?php if(isset($_GET['FechaHasta'])){ echo $_GET['FechaHasta']; } ?>">
                </div>
                <button type="submit" class="btn btn<?php echo $primary ?> btn-sm"> <span class="fa fa-search"></span> </button>
              </form>
            </div>
            <div class="opciones d-flex align-items-center">
              <div class="btn-group btn-sm">
                <a href="<?php echo base_url('admin/usuarios/excel'.'?'.$_SERVER['QUERY_STRING']); ?>" class="btn btn-info btn-sm"> <span class="fa fa-download"></span> Descargar </a>
                <a href="<?php echo base_url('admin/usuarios/crear?tipo_usuario='.$tipo_usuario); ?>" class="btn btn-success btn-sm"> <span class="fa fa-plus"></span> Nuevo Usuario </a>
              </div>

            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover table-striped">
              <thead class="text-light bg<?php echo $primary; ?>">
                <tr>
                  <th class="text-left">Foto</th>
                  <th class="text-left">Nombre</th>
                  <th class="text-center">Correo</th>
                  <th class="text-center">Tipo de Usuario</th>
                  <th class="text-center">Estado</th>
                  <th class="text-right">Controles</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($usuarios as $usuario){ ?>
                <tr>
                  <td> <img src="<?php echo base_url('contenido/img/usuarios/'.$usuario->USUARIO_IMAGEN); ?>" width="50" alt=""> </td>
                  <td class="text-left"><span style="<?php if($usuario->USUARIO_ESTADO=='borrado'){ echo 'text-decoration:line-through;';} ?>"><?php echo $usuario->USUARIO_NOMBRE.' '.$usuario->USUARIO_APELLIDOS; ?></span></td>
                  <td class="text-center"><span style="<?php if($usuario->USUARIO_ESTADO=='borrado'){ echo 'text-decoration:line-through;';} ?>"><?php echo $usuario->USUARIO_CORREO; ?></span></td>
                    <td class="text-center">
                        <?php
                          switch($usuario->USUARIO_TIPO){
                            case 'usr-1':
                              $tipo = '<span class="badge badge-primary">Cliente</span>';
                            break;
                            case 'vnd-2':
                              $tipo = '<span class="badge badge-success">Vendedor</span>';
                            break;
                            case 'ser-3':
                              $tipo = '<span class="badge badge-warning">Servicios</span>';
                            break;
                            case 'vns-4':
                              $tipo = '<span class="badge badge-success">Vendedores y Servicio</span>';
                            break;
                            case 'tec-5':
                              $tipo = '<span class="badge badge-success">Técnico</span>';
                            break;
                            case 'adm-6':
                              $tipo = '<span class="badge badge-danger">Administrador</span>';
                            break;
                            case 'may-7':
                              $tipo = '<span class="badge badge-success">Vendedor Mayoreo</span>';
                            break;

                          }
                        ?>
                      <div class="dropdown">
                          <?php echo $tipo; ?>
                      </div>
                    </td>
                  <td class="text-center">
                      <?php
                        switch($usuario->USUARIO_ESTADO){
                          case 'activo':
                            $estado_actual = 'Activo';
                            $color = 'success';
                            $icono = 'fa-check-circle';
                          break;
                          case 'inactivo':
                          $estado_actual = 'Inactivo';
                            $color = 'danger';
                            $icono = 'fa-times-circle';
                          break;
                          case 'pendiente':
                          $estado_actual = 'Pendiente';
                            $color = 'warning';
                            $icono = 'fa-exclamation-circle';
                          break;
                          case 'borrado':
                          $estado_actual = 'Borrado';
                            $color = 'default';
                            $icono = 'fa-ban';
                          break;

                        }
                      ?>
                    <div class="dropdown">
                      <button type="button" class="btn <?php echo 'btn-'.$color; ?> btn-sm dropdown-toggle" data-toggle="dropdown">
                        <?php echo $estado_actual; ?>
                      </button>
                      <div class="dropdown-menu">
                        <a href="<?php echo base_url('admin/usuarios/estado?id='.$usuario->ID_USUARIO.'&estado=activo&tipo_usuario='.$usuario->USUARIO_TIPO); ?>" class="dropdown-item text-<?php echo $color; ?>"> <span class="fa <?php echo $icono; ?>"></span> Cambiar estado a Activo</a>
                        <a href="<?php echo base_url('admin/usuarios/estado?id='.$usuario->ID_USUARIO.'&estado=pendiente&tipo_usuario='.$usuario->USUARIO_TIPO); ?>" class="dropdown-item text-<?php echo $color; ?>"> <span class="fa <?php echo $icono; ?>"></span> Cambiar estado a Pendiente</a>
                        <a href="<?php echo base_url('admin/usuarios/estado?id='.$usuario->ID_USUARIO.'&estado=inactivo&tipo_usuario='.$usuario->USUARIO_TIPO); ?>" class="dropdown-item text-<?php echo $color; ?>"> <span class="fa <?php echo $icono; ?>"></span> Cambiar estado a Inactivo</a>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="<?php echo base_url('admin/usuarios/perfil')."?id_usuario=".$usuario->ID_USUARIO; ?>" class="btn btn-sm btn-success" title="Ver todos los datos del Usuario"> <span class="fa fa-id-card"></span> Detalles</a>
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

<!--end:: Widgets/Trends-->
</div>
</div>
<!--End::Section-->

<!--End::Dashboard 8-->
</div>

<!-- end:: Content -->
</div>
</div>
</div>
