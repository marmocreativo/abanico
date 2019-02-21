<!-- empieza panel usuario resposivo -->

<div class="fila-gris">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('mobile/usuarios/widgets/menu_control_usuario'); ?>
      </div>
    </div>
  </div>
</div>

<div class="container py-3 mb-3">
  <div class="row">
    <div class="col-12">
      <?php if(!empty(validation_errors())){ ?>
        <div class="alert alert-danger">
          <?php echo validation_errors(); ?>
        </div>
      <?php } ?>
      <div class="card">
        <div class="card-header">
          <h5> <i class="fa fa-map-marker-alt"></i> <?php echo $this->lang->line('usuario_listas_generales_nuevo'); ?> <?php echo $this->lang->line('usuario_lista_direcciones_singular'); ?></h5>
        </div>
        <div class="card-body">
          <form class="" action="<?php echo base_url('usuario/direcciones/crear');?>" method="post">
            <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
              <div class="form-group">
              <label for="AliasDireccion"><?php echo $this->lang->line('usuario_form_direcciones_nombre'); ?> <small><?php echo $this->lang->line('usuario_form_direcciones_nombre_instrucciones'); ?></small> </label>
                <input type="text" name="AliasDireccion" class="form-control form-control-sm" placeholder="Ej. Mi casa, Trabajo">
              </div>
              <div class="form-group">
                <label for="TipoDireccion"><?php echo $this->lang->line('usuario_form_direcciones_tipo_direccion'); ?> </label>
                <select class="form-control" name="TipoDireccion" id="TipoDireccion" required>
                  <option value="envio"><?php echo $this->lang->line('usuario_form_direcciones_tipo_direccion_envio'); ?></option>
                  <option value="facturacion"><?php echo $this->lang->line('usuario_form_direcciones_tipo_direccion_facturacion'); ?></option>
                </select>
              </div>
              <div class="form-group">
                <label for="PaisDireccion"><?php echo $this->lang->line('usuario_form_direcciones_pais'); ?> </label>
                <select class="form-control" name="PaisDireccion" id="PaisDireccion" required>
                  <option value=""><?php echo $this->lang->line('usuario_form_direcciones_pais_selecciona'); ?></option>
                </select>
              </div>
              <div class="form-group">
                <label for="EstadoDireccion"><?php echo $this->lang->line('usuario_form_direcciones_estado'); ?> </label>
                <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" required>
                  <option value=""><?php echo $this->lang->line('usuario_form_direcciones_estado_selecciona'); ?></option>
                </select>
              </div>
              <div class="form-group">
                <label for="CiudadDireccion"><?php echo $this->lang->line('usuario_form_direcciones_ciudad'); ?> <?php echo $this->lang->line('usuario_form_direcciones_ciudad_instrucciones'); ?></label>
                <input type="text" name="CiudadDireccion" class="form-control">
              </div>
              <div class="form-group">
                <label for="MunicipioDireccion"><?php echo $this->lang->line('usuario_form_direcciones_municipio'); ?></label>
                <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" required>
                  <option value=""><?php echo $this->lang->line('usuario_form_direcciones_municipio_selecciona'); ?></option>
                </select>
              </div>
              <div class="form-group">
                <label for="CodigoPostalDireccion"><?php echo $this->lang->line('usuario_form_direcciones_codigo_postal'); ?></label>
                <input type="text" name="CodigoPostalDireccion" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="BarrioDireccion"><?php echo $this->lang->line('usuario_form_direcciones_barrio_colonia'); ?></label>
                <input type="text" name="BarrioDireccion" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="CalleDireccion"><?php echo $this->lang->line('usuario_form_direcciones_calle_numero'); ?></label>
                <textarea name="CalleDireccion" class="form-control" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="ReferenciasDireccion"><?php echo $this->lang->line('usuario_form_direcciones_referencias'); ?></label>
                <textarea name="ReferenciasDireccion" class="form-control" rows="3"></textarea>
              </div>
              <hr>
              <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-save"></i><?php echo $this->lang->line('usuario_listas_generales_actualizar'); ?> <?php echo $this->lang->line('usuario_lista_direcciones_singular'); ?></button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
