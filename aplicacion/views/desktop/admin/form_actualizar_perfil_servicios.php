<div class="container-fluid">
  <div class="row">
    <div class="col-7">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-user-tie"></span> Actualizar <?php echo $perfil['PERFIL_NOMBRE']; ?></h1>
          </div>
        </div>
        <div class="card-body">
          <?php retro_alimentacion(); ?>
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/perfiles_servicios/actualizar');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Identificador" value="<?php echo $perfil['ID_PERFIL']; ?>">
            <input type="hidden" name="IdUsuario" value="<?php echo $usuario['ID_USUARIO']; ?>">
            <input type="hidden" name="ImagenAnteriorPerfil" value="<?php echo $perfil['PERFIL_IMAGEN']; ?>">
            <div class="row">
              <div class="col-8">
                <img src="<?php echo base_url('contenido/img/perfiles/completo/'.$perfil['PERFIL_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                <hr>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="ImagenPerfil" name="ImagenPerfil" placeholder="" value="">
                  <label class="custom-file-label" for="ImagenPerfil">Logotipo de tu Perfil</label>
                </div>
              </div>
              <div class="col-12 mt-4">
                <hr>
                 <div class="form-group">
                   <label for="NombrePerfil">Nombre público</label>
                   <input type="text" class="form-control" id="NombrePerfil" name="NombrePerfil" placeholder="" value="<?php echo $perfil['PERFIL_NOMBRE']; ?>">
                 </div>
                 <hr>
                 <h5 class="mb-3"><span class="fa fa-file-invoice"></span> Datos Fiscales (Opcionales)</h5>
                 <div class="form-group">
                   <label for="RazonSocialPerfil">Razón social</label>
                   <input type="text" class="form-control" id="RazonSocialPerfil" name="RazonSocialPerfil" placeholder="" value="<?php echo $perfil['PERFIL_RAZON_SOCIAL']; ?>">
                 </div>
                 <div class="form-group">
                   <label for="RfcPerfil">R.F.C.</label>
                   <input type="text" class="form-control" id="RfcPerfil" name="RfcPerfil" placeholder="" value="<?php echo $perfil['PERFIL_RFC']; ?>">
                 </div>
                 <h6 class="mb-3"><span class="fa fa-file-invoice"></span> Datos de Contacto (Obligatorios)</h6>
                 <div class="form-group">
                   <label for="TelefonoPerfil">Teléfono</label>
                   <input type="text" class="form-control" id="TelefonoPerfil" name="TelefonoPerfil" placeholder="" value="<?php echo $perfil['PERFIL_TELEFONO']; ?>">
                 </div>
                 <hr>
                 <h6 class="mb-3"> <span class="fa fa-building"></span> Dirección</h6>
                 <input type="hidden" name="IdentificadorDireccion" value="<?php echo $direccion_perfil_servicios['ID_DIRECCION'] ?>">
                 <input type="hidden" name="TipoDireccion" value="perfil">
                 <input type="hidden" name="AliasDireccion" value="Direccion Perfil">
                  <input type="hidden" name="ReferenciasDireccion" value="-">
                 <div class="row">
                   <div class="col">
                     <div class="form-group">
                       <label for="PaisDireccion">País </label>
                       <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo $direccion_perfil_servicios['DIRECCION_PAIS']; ?>" required>
                         <option value="">Selecciona un País</option>
                       </select>
                     </div>
                   </div>
                   <div class="col">
                     <div class="form-group">
                       <label for="EstadoDireccion">Estado </label>
                       <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo $direccion_perfil_servicios['DIRECCION_ESTADO']; ?>" required>
                         <option value="">Selecciona tu estado</option>
                       </select>
                     </div>
                   </div>
                   <div class="col">
                     <div class="form-group">
                       <label for="MunicipioDireccion">Municipio / Alcaldía</label>
                       <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo $direccion_perfil_servicios['DIRECCION_MUNICIPIO']; ?>" required>
                         <option value="">Selecciona tu Municipio / Alcaldía</option>
                       </select>
                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col">
                     <div class="form-group">
                       <label for="CiudadPerfil">Ciudad (Opcional)</label>
                       <input type="text" name="CiudadDireccion" class="form-control" value="<?php echo $direccion_perfil_servicios['DIRECCION_CIUDAD']; ?>">
                     </div>
                   </div>
                     <div class="col">
                       <div class="form-group">
                         <label for="CodigoPostalDireccion">Código Postal</label>
                         <input type="text" name="CodigoPostalDireccion" class="form-control" value="<?php echo $direccion_perfil_servicios['DIRECCION_CODIGO_POSTAL']; ?>">
                       </div>
                     </div>
                 </div>
                 <div class="form-group">
                   <label for="BarrioDireccion">Barrio / Colonia</label>
                   <input type="text" name="BarrioDireccion" class="form-control" value="<?php echo $direccion_perfil_servicios['DIRECCION_BARRIO']; ?>">
                 </div>
                 <div class="form-group">
                   <label for="CalleDireccion">Calle y Número</label>
                   <textarea name="CalleDireccion" class="form-control" rows="3"><?php echo $direccion_perfil_servicios['DIRECCION_CALLE_Y_NUMERO']; ?></textarea>
                 </div>
                 <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Actualizar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-5">
        <?php if(!empty($plan)){ ?>
          <div class="card <?php echo 'border'.$primary; ?>">
            <div class="card-body">
              <h4 class="h5"> <span class="fa fa-file-signature"></span> Plan activo | <b><?php echo $plan['PLAN_NOMBRE']; ?></b></h4>
              <hr>
              <table class="table table-sm table-striped">
                <tr>
                  <td>Mensualidad</td>
                  <td>$<?php echo $plan['PLAN_MENSUALIDAD']; ?></td>
                </tr>
                <tr>
                  <td>Comisión por venta</td>
                  <td><?php echo $plan['PLAN_COMISION']; ?>%</td>
                </tr>
                <tr>
                  <td>Espacio de Almacenamiento</td>
                  <td><?php echo $plan['PLAN_ESPACIO_ALMACENAMIENTO']; ?> M<sup>3</sup></td>
                </tr>
                <tr>
                  <td>Costo de Almacenamiento</td>
                  <td>$<?php echo $plan['PLAN_COSTO_ALMACENAMIENTO']; ?> x M<sup>3</sup></td>
                </tr>
                <tr>
                  <td>Costo Manejo de producto</td>
                  <td><?php echo $plan['PLAN_MANEJO_PRODUCTOS']; ?>%</td>
                </tr>
                <tr>
                  <td>Envios Administrados por</td>
                  <td><?php echo $plan['PLAN_ENVIO']; ?></td>
                </tr>
                <tr>
                  <td>Servicios Financieros</td>
                  <td><?php echo $plan['PLAN_SERVICIOS_FINANCIEROS']; ?>% + $<?php echo $plan['PLAN_SERVICIOS_FINANCIEROS_FIJO']; ?></td>
                </tr>
                <?php if($plan['PLAN_TIPO']=='productos'){ ?>
                <tr>
                  <td>Límite de Productos Activos</td>
                  <td><?php echo $plan['PLAN_LIMITE_PRODUCTOS']; ?></td>
                </tr>
                <tr>
                  <td>Límite fotografías por producto</td>
                  <td><?php echo $plan['PLAN_FOTOS_PRODUCTOS']; ?></td>
                </tr>
                <?php } ?>
                <?php if($plan['PLAN_TIPO']=='servicios'){ ?>
                <tr>
                  <td>Límite de Servicios Activos</td>
                  <td><?php echo $plan['PLAN_LIMITE_SERVICIOS']; ?></td>
                </tr>
                <tr>
                  <td>Límite de fotografías por servicio</td>
                  <td><?php echo $plan['PLAN_FOTOS_SERVICIOS']; ?></td>
                </tr>
                <?php } ?>
              </table>
              <div class="row">
                <div class="col">
                  <div class="card border-primary">
                    <div class="card-body p-2">
                      <p class="mb-1"> <b>Registro:</b> <?php echo $plan['FECHA_INICIO']; ?></p>
                      <p class="mb-1"> <b>Vigencia:</b> <?php echo $plan['FECHA_TERMINO']; ?></p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card border-primary">
                    <div class="card-body p-2">
                      <?php if($plan['AUTO_RENOVAR']=='si'){ ?>
                      <p class="mb-1"> <b>Auto renovar:</b> <?php echo $plan['FECHA_TERMINO']; ?></p>
                        <a href="<?php echo base_url('admin/planes/auto_renovar?id='.$plan['ID_PLAN_USUARIO'].'&estado=no'); ?>" class="btn btn-sm btn-block btn-outline-primary"> <i class="fa fa-ban"></i> Cancelar Auto Renovación </a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url('admin/planes/auto_renovar?id='.$plan['ID_PLAN_USUARIO'].'&estado=si'); ?>" class="btn btn-sm btn-block btn-primary"> <i class="fa fa-check"></i> Activar Auto Renovación </a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col">
                  <p>Estado del Pago: <b><?php echo $plan['PLAN_ESTADO']; ?></b></p>
                </div>
                <div class="col d-flex justify-content-end">
                  <p>Fecha Límite de Pago: <b><?php echo date('Y-m-d',strtotime("+10 days",strtotime($plan['FECHA_INICIO']))); ?></b></p>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <a href="<?php echo base_url('admin/planes/actualizar_plan_usuario?id='.$plan['ID_PLAN_USUARIO']); ?>" class="btn btn-primary btn-block">Editar Plan</a>
                </div>
              </div>
            </div>
          </div>
        <?php }else{?>
          <div class="card <?php echo 'border'.$primary; ?>">
            <div class="card-body">
              <h4 class="h5"> <span class="fa fa-file-signature"></span> Plan activo | <b>Ninguno</b></h4>
              <hr>
              <a href="<?php echo base_url('admin/planes/lista_planes?tipo=productos&id_usuario='.$tienda['ID_USUARIO']); ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Activar Plan</a>
            </div>
          </div>
        <?php } ?>
    </div>
  </div>
</div>
