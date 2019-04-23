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
  <?php if($perfil['PERFIL_ESTADO']=='activo'){ ?>
  <div class="row">
    <div class="col-12">
      <?php retro_alimentacion(); ?>
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="pt-2"> <i class="fa fa-user-tie"></i> <?php echo $this->lang->line('usuario_vista_perfil_servicios'); ?></h5>
        </div>
        <div class="card-body">
          <img class="img-fluid d-block mx-auto mb-3 img-thumbnail rounded-circle" style="width:150px" src="<?php echo base_url('contenido/img/perfiles/completo/'.$perfil['PERFIL_IMAGEN']) ?>" alt="">
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_nombre'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_NOMBRE']; ?></p>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_razon'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_RAZON_SOCIAL']; ?></p>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_rfc'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_RFC']; ?></p>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_telefono'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_TELEFONO']; ?></p>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_registro'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_FECHA_REGISTRO']; ?></p>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_actualizacion'); ?></strong></h6>
          <p><?php echo $perfil['PERFIL_FECHA_ACTUALIZACION']; ?></p>
          <hr>
          <h6><strong><?php echo $this->lang->line('usuario_vista_tienda_direccion_fiscal'); ?></strong></h6>
          <p><?php echo $direccion_formateada; ?></p>
        </div>
        <!--
        <div class="card-footer">
          <a href="<?php echo base_url('usuario/perfil_servicios/actualizar'); ?>" class="btn btn-link btn-block"> <i class="fa fa-pencil-alt"></i> <?php echo $this->lang->line('usuario_listas_generales_editar'); ?></a>
        </div>
      -->
      </div>

    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-body pb-2 pt-3 bg-primary text-white text-center">
          <h4 class="h5"><i class="fa fa-tools"></i> <?php echo $this->lang->line('usuario_vista_perfil_servicios_catalogo_titulo'); ?></h4>
        </div>
        <div class="card-footer text-center">
          <a href="<?php echo base_url('usuario/servicios');?>"><?php echo $this->lang->line('usuario_vista_perfil_servicios_catalogo_boton'); ?></a>
        </div>
      </div>
    </div>

  </div>
<?php }else{ ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-danger">
        <h6><?php echo $this->lang->line('usuario_vista_perfil_servicios_suspendido'); ?>.</h6>
      </div>
    </div>
  </div>
<?php } ?>
</div>

<!-- Modal de flujos -->

<!-- Modal -->
<div class="modal fade" id="ModalAyuda" tabindex="-1" role="dialog" aria-labelledby="ModalAyuda" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-question-circle"></i> Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">

          <div class="linea-colores-delgada">
            <div class="barra-color barra-azul"></div>
            <div class="barra-color barra-rosa"></div>
            <div class="barra-color barra-amarillo"></div>
            <div class="barra-color barra-verde"></div>
            <div class="barra-color barra-morado"></div>
          </div>
        <!-- Slider Ayuda-->
        <div id="carouselAyuda" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselAyuda" data-slide-to="0" class="active"></li>
            <li data-target="#carouselAyuda" data-slide-to="1"></li>
            <li data-target="#carouselAyuda" data-slide-to="2"></li>
            <li data-target="#carouselAyuda" data-slide-to="3"></li>
            <li data-target="#carouselAyuda" data-slide-to="4"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.1.png'); ?>" alt="Registro paso 1">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.2.png'); ?>" alt="Registro paso 2">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.3.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.4.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.5.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.6.png'); ?>" alt="Registro paso 3">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.7.png'); ?>" alt="Registro paso 4">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselAyuda" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselAyuda" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
