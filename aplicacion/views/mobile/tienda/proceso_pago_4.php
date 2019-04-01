<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" class="btn btn-default btn-circle" disabled="disabled">1</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" class="btn btn-default btn-circle"  disabled="disabled" >2</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" class="btn btn-default btn-circle"  disabled="disabled">3</a>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" class="btn btn-primary btn-circle" disabled="disabled">4</a>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col text-center">
                <h5><?php echo $this->lang->line('proceso_pago_4_pedido_completo'); ?></h5>
                <h5><?php echo $this->lang->line('proceso_pago_4_agradecimiento'); ?></h5>
                <p><?php echo $this->lang->line('proceso_pago_4_agradecimiento_instrucciones'); ?></p>
                <a href="<?php echo base_url('usuario'); ?>" class="btn btn-outline-info btn-block"><?php echo $this->lang->line('proceso_pago_4_ir_al_perfil'); ?>.</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
