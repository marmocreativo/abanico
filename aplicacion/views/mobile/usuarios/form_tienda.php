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
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-header">
          <h5> <i class="fa fa-store"></i> <?php echo $this->lang->line('usuario_form_tienda_titulo'); ?></h5>
        </div>
        <div class="card-body">

          <h5><?php echo $this->lang->line('usuario_form_tienda_bienvenida'); ?></h5>
          <p><?php echo $this->lang->line('usuario_form_tienda_bienvenida_instrucciones'); ?></p>
          <ul>
            <li><?php echo $this->lang->line('usuario_form_tienda_beneficios_1'); ?></li>
            <li><?php echo $this->lang->line('usuario_form_tienda_beneficios_2'); ?></li>
            <li><?php echo $this->lang->line('usuario_form_tienda_beneficios_3'); ?></li>
          </ul>
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>
          <form class="" action="<?php echo base_url('usuario/tienda/crear');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
            <img class="img-fluid img-thumbnail rounded-circle d-block mx-auto mb-3" style="width:150px" src="http://localhost/abanico-master/contenido/img/tiendas/completo/default.jpg" alt="" >
            <div class="custom-file file-sm mb-3">
              <input type="file" class="custom-file-input" id="ImagenTienda" name="ImagenTienda" placeholder="" value="">
              <label class="custom-file-label" for="ImagenTienda"><?php echo $this->lang->line('usuario_form_tienda_logotipo'); ?></label>
            </div>
            <!-- <h6><span class="fa fa-store"></span> Datos de tu tienda</h5> -->
            <div class="form-group">
              <label for="TipoTienda"><?php echo $this->lang->line('usuario_form_tienda_tipo_vendedor'); ?> </label>
              <select class="form-control" name="TipoTienda">
                <option value="tienda"><?php echo $this->lang->line('usuario_form_tienda_tipo_vendedor_tienda'); ?></option>
                <option value="vendedor"><?php echo $this->lang->line('usuario_form_tienda_tipo_vendedor_casual'); ?> </option>
              </select>
            </div>
             <div class="form-group">
               <label for="NombreTienda"><?php echo $this->lang->line('usuario_vista_tienda_nombre'); ?> <small><?php echo $this->lang->line('usuario_vista_tienda_nombre_instrucciones'); ?></small> </label>
               <input type="text" class="form-control form-control-sm" id="NombreTienda" name="NombreTienda" placeholder="" value="">
             </div>
             <hr>
             <h6><span class="fa fa-file-invoice"></span> <?php echo $this->lang->line('usuario_form_tienda_datos_fiscales'); ?></h6>
             <div class="form-group">
                <label for="RazonSocialTienda"><?php echo $this->lang->line('usuario_vista_tienda_razon'); ?></label>
               <input type="text" class="form-control form-control-sm" id="RazonSocialTienda" name="RazonSocialTienda"  placeholder="" value="">
             </div>
             <div class="form-group">
               <label for="RfcTienda"><?php echo $this->lang->line('usuario_vista_tienda_rfc'); ?></label>
               <input type="text" class="form-control form-control-sm" id="RfcTienda" name="RfcTienda" placeholder="" value="">
             </div>
             <div class="form-group">
                <label for="TelefonoTienda"><?php echo $this->lang->line('usuario_vista_tienda_telefono'); ?></label>
               <input type="text" class="form-control form-control-sm" id="TelefonoTienda" name="TelefonoTienda" placeholder="" value="">
             </div>
             <h6> <span class="fa fa-building"></span> <?php echo $this->lang->line('usuario_vista_tienda_direccion_fiscal'); ?></h6>
             <input type="hidden" name="TipoDireccion" value="fiscal">
             <input type="hidden" name="AliasDireccion" value="Direccion Tienda">
             <input type="hidden" name="ReferenciasDireccion" value="-">
             <div class="form-group">
               <label for="PaisDireccion"><?php echo $this->lang->line('usuario_form_direcciones_pais'); ?> </label>
               <select class="form-control" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo set_value('PaisDireccion'); ?>" required>
                 <option value=""><?php echo $this->lang->line('usuario_form_direcciones_pais_selecciona'); ?></option>
               </select>
             </div>
             <div class="form-group">
               <label for="EstadoDireccion"><?php echo $this->lang->line('usuario_form_direcciones_estado'); ?> </label>
               <select class="form-control" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo set_value('EstadoDireccion'); ?>" required>
                 <option value=""><?php echo $this->lang->line('usuario_form_direcciones_estado_selecciona'); ?></option>
               </select>
             </div>
             <div class="form-group">
               <label for="MunicipioDireccion"><?php echo $this->lang->line('usuario_form_direcciones_municipio'); ?></label>
               <select class="form-control" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo set_value('MunicipioDireccion'); ?>" required>
                 <option value=""><?php echo $this->lang->line('usuario_form_direcciones_municipio_selecciona'); ?></option>
               </select>
             </div>
             <div class="form-group">
               <label for="CiudadDireccion"><?php echo $this->lang->line('usuario_form_direcciones_ciudad'); ?> <small><?php echo $this->lang->line('usuario_form_direcciones_ciudad_instrucciones'); ?></small> </label>
               <input type="text" name="CiudadDireccion" class="form-control" value="<?php echo set_value('CiudadDireccion'); ?>">
             </div>
             <div class="form-group">
               <label for="CodigoPostalDireccion"><?php echo $this->lang->line('usuario_form_direcciones_codigo_postal'); ?></label>
               <input type="text" name="CodigoPostalDireccion" class="form-control" required value="<?php echo set_value('CodigoPostalDireccion'); ?>">
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
             <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-save"></i>  <?php echo $this->lang->line('usuario_form_tienda_registrar'); ?></button>
          </form>
        </div>
      </div>

    </div>
  </div>
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
            <li data-target="#carouselAyuda" data-slide-to="5"></li>
            <li data-target="#carouselAyuda" data-slide-to="6"></li>
            <li data-target="#carouselAyuda" data-slide-to="7"></li>
            <li data-target="#carouselAyuda" data-slide-to="8"></li>
            <li data-target="#carouselAyuda" data-slide-to="9"></li>
            <li data-target="#carouselAyuda" data-slide-to="10"></li>
            <li data-target="#carouselAyuda" data-slide-to="11"></li>
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
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.8.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.9.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.10.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.11.png'); ?>" alt="Registro paso 4">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url('assets/global/img/flujos/flujo2.12.png'); ?>" alt="Registro paso 4">
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
