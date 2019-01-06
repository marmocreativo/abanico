
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="titulo">
            <h1 class="h5"> <span class="fa fa-truck"></span> Actualizar Transportista</h1>
          </div>
        </div>
        <div class="card-body">
          <?php if(!empty(validation_errors())){ ?>
            <div class="alert alert-danger">
              <?php echo validation_errors(); ?>
            </div>
            <hr>
          <?php } ?>
          <form class="" action="<?php echo base_url('admin/transportistas/actualizar'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
            <div class="row">
              <div class="col-8">
                <input type="hidden" name="Identificador" value="<?php echo $transportista['ID_TRANSPORTISTA']; ?>">
                <input type="hidden" name="ImagenAnteriorTransportista" value="<?php echo $transportista['TRANSPORTISTA_LOGO']; ?>">
                <div class="form-group">
                  <label for="NombreTransportista">Nombre</label>
                  <input type="text" class="form-control" name="NombreTransportista" id="NombreTransportista" placeholder="" required value="<?php echo $transportista['TRANSPORTISTA_NOMBRE']; ?>">
                </div>
                <div class="form-group">
                  <label for="DescripcionTransportista">Descripción</label>
                  <textarea class="form-control" name="DescripcionTransportista" rows="4" cols="80"><?php echo $transportista['TRANSPORTISTA_DESCRIPCION']; ?></textarea>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="ImagenTransportista" name="ImagenTransportista" placeholder="" value="">
                  <label class="custom-file-label" for="ImagenTransportista">Logo</label>
                </div>
                <div class="form-group">
                  <label for="TiempoEntregaTransportista">Tiempo de entrega <small>Solo como nota de texto</small></label>
                  <input type="text" class="form-control" name="TiempoEntregaTransportista" id="TiempoEntregaTransportista" placeholder="" required value="<?php echo $transportista['TRANSPORTISTA_TIEMPO_ENTREGA']; ?>">
                </div>
                <div class="form-group">
                  <label for="UrlRastreoTransportista">URL de rastreo</label>
                  <input type="text" class="form-control" name="UrlRastreoTransportista" id="UrlRastreoTransportista" placeholder="" value="<?php echo $transportista['TRANSPORTISTA_URL_RASTREO']; ?>">
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="EstadoTransportista" id="EstadoTransportista" <?php if($transportista['TRANSPORTISTA_ESTADO']=='activo'){ echo 'checked'; } ?> >
                  <label class="custom-control-label" for="EstadoTransportista">Activar</label>
                  <small class="text-info"> <span class="fa fa-info-circle"></span> Si se activa el transportista estará disponible en todo el sistema</small>
                </div>
              </div>
              <div class="col-4">
                <h6> <i class="fa fa-globe-americas mb-2"></i> Disponible en:</h6>
                <div id="accordion">
                    <?php foreach($paises as $pais){ ?>
                  <div class="card">
                    <div class="card-header" id="pais-<?php echo $pais->ID_PAIS ?>">
                      <h5 class="mb-0">
                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?php echo $pais->ID_PAIS ?>" aria-expanded="true" aria-controls="collapse-<?php echo $pais->ID_PAIS ?>">
                          <?php echo $pais->PAIS_NOMBRE; ?> <i class="fa fa-caret-down"></i>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse-<?php echo $pais->ID_PAIS ?>" class="collapse" aria-labelledby="collapse-<?php echo $pais->ID_PAIS ?>" data-parent="#accordion">
                      <div class="card-body">
                        <?php
                          // Obtengo los Estados
                          $estados = $this->EstadosModel->estados_del_pais($pais->ID_PAIS);
                        ?>
                        <div class="form-check border-bottom mb-2 pb-2">
                          <input class="form-check-input control" type="checkbox" name="ControlPais-<?php echo $pais->ID_PAIS; ?>" id="ControlPais-<?php echo $pais->ID_PAIS; ?>" data-controla="estado-<?php echo $pais->ID_PAIS; ?>" indeterminated>
                          <label class="form-check-label" for="ControlPais-<?php echo $pais->ID_PAIS; ?>">
                            Todos
                          </label>
                        </div>
                        <ul class="list-unstyled">
                          <?php foreach($estados as $estado){ ?>
                          <li>
                            <div class="form-check">
                              <input class="form-check-input hijo estado-<?php echo $pais->ID_PAIS; ?>" type="checkbox" data-padre="ControlPais-<?php echo $pais->ID_PAIS; ?>"
                              <?php $disponibilidad = $this->TransportistasDisponibilidadModel->lista(['ID_TRANSPORTISTA'=>$_GET['id'],'TRANSPORTISTA_PAIS'=>$pais->PAIS_NOMBRE,'TRANSPORTISTA_ESTADO'=>$estado->ESTADO_NOMBRE],'','') ?>
                              value="<?php echo $estado->ESTADO_NOMBRE; ?>" name="EstadosDisponible[]" id="estado<?php echo $estado->ID_ESTADO; ?>" <?php if(!empty($disponibilidad)){ echo 'checked'; } ?>>
                              <label class="form-check-label" for="estado<?php echo $estado->ID_ESTADO; ?>">
                                <?php echo $estado->ESTADO_NOMBRE; ?>
                              </label>
                            </div>
                          </li>
                        <?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <?php } ?>
                </div>
              </div>
            </div>

            <hr>
            <button type="submit" class="btn btn<?php echo $primary; ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
