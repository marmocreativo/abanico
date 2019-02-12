<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col-12 col-md-6">
          <div class="card">
            <div class="card-header">
              <h5> <i class="fa fa-map-marker-alt"></i> <?php echo $this->lang->line('usuario_listas_generales_nuevo'); ?> <?php echo $this->lang->line('usuario_lista_direcciones_singular'); ?></h5>
            </div>
            <div class="card-body">
              <?php if(!empty(validation_errors())){ ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <form class="" action="<?php echo base_url('usuario/direcciones/actualizar');?>" method="post">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
                <input type="hidden" name="Identificador" value="<?php echo $direccion['ID_DIRECCION']; ?>">
                <div class="row">
                  <div class="col">
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="AliasDireccion"><?php echo $this->lang->line('usuario_form_direcciones_nombre'); ?> <small>P<?php echo $this->lang->line('usuario_form_direcciones_nombre_instrucciones'); ?></small> </label>
                            <input type="text" name="AliasDireccion" class="form-control" value="<?php echo $direccion['DIRECCION_ALIAS']; ?>">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="TipoDireccion"><?php echo $this->lang->line('usuario_form_direcciones_tipo_direccion'); ?> </label>
                            <select class="form-control" name="TipoDireccion" id="TipoDireccion" required>
                              <option value="envio" <?php if($direccion['DIRECCION_TIPO']=='envio'){ echo 'selected'; } ?>><?php echo $this->lang->line('usuario_form_direcciones_tipo_direccion_envio'); ?></option>
                              <option value="facturacion" <?php if($direccion['DIRECCION_TIPO']=='facturacion'){ echo 'selected'; } ?>><?php echo $this->lang->line('usuario_form_direcciones_tipo_direccion_facturacion'); ?></option>
                            </select>
                          </div>
                        </div>
                      </div>
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="PaisDireccion"><?php echo $this->lang->line('usuario_form_direcciones_pais'); ?> </label>
                           <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo $direccion['DIRECCION_PAIS']; ?>"  required>
                             <option value=""><?php echo $this->lang->line('usuario_form_direcciones_pais_selecciona'); ?></option>
                           </select>
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="EstadoDireccion"><?php echo $this->lang->line('usuario_form_direcciones_estado'); ?> </label>
                           <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo $direccion['DIRECCION_ESTADO']; ?>" required>
                             <option value=""><?php echo $this->lang->line('usuario_form_direcciones_estado_selecciona'); ?></option>
                           </select>
                         </div>
                       </div>

                       <div class="col">
                         <div class="form-group">
                           <label for="MunicipioDireccion"><?php echo $this->lang->line('usuario_form_direcciones_municipio'); ?></label>
                           <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo $direccion['DIRECCION_MUNICIPIO']; ?>" required>
                             <option value=""><?php echo $this->lang->line('usuario_form_direcciones_municipio_selecciona'); ?></option>
                           </select>
                         </div>
                       </div>
                     </div>
                     <div class="row">
                       <div class="col">
                         <div class="form-group">
                           <label for="CiudadDireccion"><?php echo $this->lang->line('usuario_form_direcciones_ciudad'); ?> <?php echo $this->lang->line('usuario_form_direcciones_ciudad_instrucciones'); ?></label>
                           <input type="text" name="CiudadDireccion" class="form-control"  value="<?php echo $direccion['DIRECCION_CIUDAD']; ?>">
                         </div>
                       </div>
                       <div class="col">
                         <div class="form-group">
                           <label for="CodigoPostalDireccion"><?php echo $this->lang->line('usuario_form_direcciones_codigo_postal'); ?></label>
                           <input type="text" name="CodigoPostalDireccion" class="form-control"  value="<?php echo $direccion['DIRECCION_CODIGO_POSTAL']; ?>" required>
                         </div>
                       </div>
                     </div>
                     <div class="form-group">
                       <label for="BarrioDireccion"><?php echo $this->lang->line('usuario_form_direcciones_barrio_colonia'); ?></label>
                       <input type="text" name="BarrioDireccion" class="form-control" value="<?php echo $direccion['DIRECCION_BARRIO']; ?>" required>
                     </div>
                     <div class="form-group">
                       <label for="CalleDireccion"><?php echo $this->lang->line('usuario_form_direcciones_calle_numero'); ?></label>
                       <textarea name="CalleDireccion" class="form-control" rows="3" required><?php echo $direccion['DIRECCION_CALLE_Y_NUMERO']; ?></textarea>
                     </div>
                     <div class="form-group">
                       <label for="ReferenciasDireccion"><?php echo $this->lang->line('usuario_form_direcciones_referencias'); ?></label>
                       <textarea name="ReferenciasDireccion" class="form-control" rows="3"><?php echo $direccion['DIRECCION_REFERENCIAS']; ?></textarea>
                     </div>
                     <hr>
                     <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> <?php echo $this->lang->line('usuario_listas_generales_actualizar'); ?> <?php echo $this->lang->line('usuario_lista_direcciones_singular'); ?></button>
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
