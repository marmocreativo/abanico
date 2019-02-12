<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
          <?php if($perfil['PERFIL_ESTADO']=='activo'){ ?>
          <div class="row">
            <div class="col-8">
              <div class="row">
                <div class="col">
                  <?php retro_alimentacion(); ?>
                  <div class="card">
                    <div class="card-header">
                      <h5> <i class="fa fa-user-tie"></i> <?php echo $this->lang->line('usuario_vista_perfil_servicios'); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="col-3">
                              <img src="<?php echo base_url('contenido/img/perfiles/completo/'.$perfil['PERFIL_IMAGEN']) ?>" alt="" class="img-fluid img-thumbnail rounded-circle">
                          </div>
                          <div class="col-9">
                            <table class="table table-sm table-borderless">
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_nombre'); ?></b></td>
                                <td><?php echo $perfil['PERFIL_NOMBRE']; ?></td>
                              </tr>
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_razon'); ?></b></td>
                                <td><?php echo $perfil['PERFIL_RAZON_SOCIAL']; ?></td>
                              </tr>
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_rfc'); ?></b></td>
                                <td><?php echo $perfil['PERFIL_RFC']; ?></td>
                              </tr>
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_telefono'); ?></b></td>
                                <td><?php echo $perfil['PERFIL_TELEFONO']; ?></td>
                              </tr>
                              <tr>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_registro'); ?></b><br><?php echo $perfil['PERFIL_FECHA_REGISTRO']; ?></td>
                                <td><b><?php echo $this->lang->line('usuario_vista_tienda_actualizacion'); ?></b><br><?php echo $perfil['PERFIL_FECHA_ACTUALIZACION']; ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row border-top pt-3">
                          <div class="col">
                            <h6><?php echo $this->lang->line('usuario_vista_tienda_direccion_fiscal'); ?></h6>
                            <p><?php echo $direccion_formateada; ?></p>
                          </div>
                        </div>
                    </div>
                    <div class="card-footer">
                      <a href="<?php echo base_url('usuario/perfil_servicios/actualizar'); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> <?php echo $this->lang->line('usuario_listas_generales_editar'); ?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card <?php echo 'border'.$primary; ?> text-center  mb-4">
                <div class="card-header <?php echo 'bg'.$primary; ?> text-white">
                  <h4 class="h5"> <span class="fa fa-tools"></span> <?php echo $this->lang->line('usuario_vista_perfil_servicios_catalogo_titulo'); ?></h4>
                </div>
                <div class="card-body">
                  <a href="<?php echo base_url('usuario/servicios');?>"><?php echo $this->lang->line('usuario_vista_perfil_servicios_catalogo_boton'); ?></a>
                </div>
              </div>
            </div>
          </div>
        <?php }else{ ?>
          <div class="row">
            <div class="col">
              <div class="alert alert-danger">
                <h6><?php echo $this->lang->line('usuario_vista_perfil_servicios_suspendido'); ?></h6>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
