<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <?php retro_alimentacion(); ?>
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="titulo">
                <h1 class="h5"> <span class="fa fa-user-tie"></span> <?php echo $this->lang->line('usuario_form_perfil_servicio_titulo'); ?></h1>
              </div>
            </div>
            <div class="card-body">
              <div class="card card-info mb-3">
                <div class="card-body">
                  <h5><?php echo $this->lang->line('usuario_form_perfil_servicio_bienvenida'); ?></h5>
                  <p><?php echo $this->lang->line('usuario_form_perfil_servicio_bienvenida_instrucciones'); ?>:</p>
                  <ul>
                    <li><?php echo $this->lang->line('usuario_form_perfil_servicio_beneficios_1'); ?></li>
                    <li><?php echo $this->lang->line('usuario_form_perfil_servicio_beneficios_2'); ?></li>
                  </ul>
                </div>
              </div>
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <form class="" action="<?php echo base_url('usuario/perfil_servicios/crear');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
                <div class="row">
                  <div class="col-12 col-sm-3">
                    <img src="<?php echo base_url('contenido/img/tiendas/completo/default.jpg') ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                    <hr>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="ImagenPerfil" name="ImagenPerfil" placeholder="" value="">
                      <label class="custom-file-label" for="ImagenPerfil"><?php echo $this->lang->line('usuario_form_perfil_servicio_fotografia_personal'); ?></label>
                    </div>
                  </div>
                  <div class="col-12 col-sm-9">
                     <div class="form-group">
                       <label for="NombrePerfil"><?php echo $this->lang->line('usuario_vista_tienda_nombre'); ?></label>
                       <input type="text" class="form-control" id="NombrePerfil" name="NombrePerfil" placeholder="" autocomplete="nope" value="<?php if(form_error('NombrePerfil') != NULL){echo set_value('NombrePerfil');}else{ echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; }?>">
                     </div>
                     <hr>
                     <h6 class="mb-3"><span class="fa fa-file-invoice"></span> <?php echo $this->lang->line('usuario_form_tienda_datos_fiscales'); ?></h6>
                     <div class="form-group">
                       <label for="RazonSocialPerfil"><?php echo $this->lang->line('usuario_vista_tienda_razon'); ?></label>
                       <input type="text" class="form-control" id="RazonSocialPerfil" name="RazonSocialPerfil" placeholder="" value="<?php echo set_value('RazonSocialPerfil'); ?>">
                     </div>
                     <div class="form-group">
                       <label for="RfcPerfil"><?php echo $this->lang->line('usuario_vista_tienda_rfc'); ?></label>
                       <input type="text" class="form-control" id="RfcPerfil" name="RfcPerfil" placeholder="" value="<?php echo set_value('RfcPerfil'); ?>">
                     </div>
                     <h6 class="mb-3"><span class="fa fa-file-invoice"></span> <?php echo $this->lang->line('usuario_form_perfil_servicio_datos_contaco'); ?></h6>
                     <div class="form-group">
                       <label for="TelefonoPerfil"><?php echo $this->lang->line('usuario_vista_tienda_telefono'); ?></label>
                       <input type="text" class="form-control" id="TelefonoPerfil" name="TelefonoPerfil" placeholder="" value="<?php echo set_value('TelefonoPerfil'); ?>">
                     </div>
                     <h6 class="mb-3"> <span class="fa fa-building"></span> <?php echo $this->lang->line('usuario_lista_direcciones_singular'); ?></h6>
                     <input type="hidden" name="TipoDireccion" value="perfil">
                     <input type="hidden" name="AliasDireccion" value="Direccion Perfil">
                      <input type="hidden" name="ReferenciasDireccion" value="-">
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="PaisDireccion"><?php echo $this->lang->line('usuario_form_direcciones_pais'); ?> </label>
                           <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo set_value('PaisDireccion'); ?>" required>
                             <option value=""><?php echo $this->lang->line('usuario_form_direcciones_pais_selecciona'); ?></option>
                           </select>
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="EstadoDireccion"><?php echo $this->lang->line('usuario_form_direcciones_estado'); ?> </label>
                           <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo set_value('EstadoDireccion'); ?>" required>
                             <option value=""><?php echo $this->lang->line('usuario_form_direcciones_estado_selecciona'); ?></option>
                           </select>
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="MunicipioDireccion"><?php echo $this->lang->line('usuario_form_direcciones_municipio'); ?></label>
                           <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo set_value('MunicipioDireccion'); ?>" required>
                             <option value=""><?php echo $this->lang->line('usuario_form_direcciones_municipio_selecciona'); ?></option>
                           </select>
                         </div>
                       </div>
                     </div>
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="CiudadDireccion"><?php echo $this->lang->line('usuario_form_direcciones_ciudad'); ?> <?php echo $this->lang->line('usuario_form_direcciones_ciudad_instrucciones'); ?></label>
                           <input type="text" name="CiudadDireccion" class="form-control" value="<?php echo set_value('CiudadDireccion'); ?>">
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="CodigoPostalDireccion"><?php echo $this->lang->line('usuario_form_direcciones_codigo_postal'); ?></label>
                           <input type="text" name="CodigoPostalDireccion" class="form-control" required value="<?php echo set_value('CodigoPostalDireccion'); ?>">
                         </div>
                       </div>
                     </div>
                     <div class="form-group">
                       <label for="BarrioDireccion"><?php echo $this->lang->line('usuario_form_direcciones_barrio_colonia'); ?></label>
                       <input type="text" name="BarrioDireccion" class="form-control" value="<?php echo set_value('BarrioDireccion'); ?>">
                     </div>
                     <div class="form-group">
                       <label for="CalleDireccion"><?php echo $this->lang->line('usuario_form_direcciones_calle_numero'); ?></label>
                       <textarea name="CalleDireccion" class="form-control" rows="3" required><?php echo set_value('CalleDireccion'); ?></textarea>
                     </div>
                     <hr>
                     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="TerminosyCondiciones" name="TerminosyCondiciones" required>
                        <label class="custom-control-label" for="TerminosyCondiciones"><?php echo $this->lang->line('usuario_form_tienda_terminos_y_condiciones'); ?></label>
                      </div>
                     <hr>
                     <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> <?php echo $this->lang->line('usuario_form_perfil_servicio_registrar'); ?></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
