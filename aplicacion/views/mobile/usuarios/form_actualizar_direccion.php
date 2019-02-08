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
          <h5 class="pt-2"> <i class="fa fa-map-marker-alt"></i> Actualizar Dirección</h5>
        </div>
        <div class="card-body">
           <form class="" action="<?php echo base_url('usuario/direcciones/actualizar');?>" method="post">
             <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
             <input type="hidden" name="Identificador" value="<?php echo $direccion['ID_DIRECCION']; ?>">
             <div class="form-group">
               <label for="AliasDireccion">Nombre <small>Para identificar tu dirección</small> </label>
               <input type="text" name="AliasDireccion" class="form-control form-control-sm" value="<?php echo $direccion['DIRECCION_ALIAS']; ?>">
             </div>
             <div class="form-group">
               <label for="TipoDireccion">Tipo de Dirección </label>
               <select class="form-control form-control-sm" name="TipoDireccion" id="TipoDireccion" required>
                 <option value="envio" <?php if($direccion['DIRECCION_TIPO']=='envio'){ echo 'selected'; } ?>>Para envío</option>
                 <option value="facturacion" <?php if($direccion['DIRECCION_TIPO']=='facturacion'){ echo 'selected'; } ?>>Para Facturación</option>
               </select>
             </div>
             <div class="form-group">
               <label for="PaisDireccion">País </label>
               <select class="form-control form-control-sm" name="PaisDireccion" id="PaisDireccion" data-valor-anterior="<?php echo $direccion['DIRECCION_PAIS']; ?>" required>
                 <option value="">Selecciona un País</option>
               </select>
             </div>
             <div class="form-group">
               <label for="EstadoDireccion">Estado </label>
               <select class="form-control form-control-sm" name="EstadoDireccion" id="EstadoDireccion" data-valor-anterior="<?php echo $direccion['DIRECCION_ESTADO']; ?>" required>
               </select>
             </div>
             <div class="form-group">
               <label for="MunicipioDireccion">Municipio / Alcaldía</label>
               <select class="form-control form-control-sm" name="MunicipioDireccion" id="MunicipioDireccion" data-valor-anterior="<?php echo $direccion['DIRECCION_MUNICIPIO']; ?>" required>
               </select>
             </div>
             <div class="form-group">
               <label for="CiudadDireccion">Ciudad (Opcional)</label>
               <input type="text" name="CiudadDireccion" class="form-control form-control-sm" value="<?php echo $direccion['DIRECCION_CIUDAD']; ?>">
             </div>
             <div class="form-group">
               <label for="CodigoPostalDireccion">Código Postal</label>
               <input type="text" name="CodigoPostalDireccion" class="form-control form-control-sm" value="<?php echo $direccion['DIRECCION_CODIGO_POSTAL']; ?>" required>
             </div>
             <div class="form-group">
               <label for="BarrioDireccion">Barrio / Colonia</label>
               <input type="text" name="BarrioDireccion" class="form-control form-control-sm" value="<?php echo $direccion['DIRECCION_BARRIO']; ?>" required>
             </div>
             <div class="form-group">
               <label for="CalleDireccion">Calle y Número</label>
               <textarea name="CalleDireccion" class="form-control form-control-sm" rows="3" required><?php echo $direccion['DIRECCION_CALLE_Y_NUMERO']; ?></textarea>
             </div>
             <div class="form-group">
               <label for="ReferenciasDireccion">Referencias</label>
               <textarea name="ReferenciasDireccion" class="form-control form-control-sm" rows="3"><?php echo $direccion['DIRECCION_REFERENCIAS']; ?></textarea>
             </div>
             <hr>
             <button type="submit" class="btn btn-sm btn-primary float-right"> <i class="fa fa-save"></i> Actualizar Direción</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
