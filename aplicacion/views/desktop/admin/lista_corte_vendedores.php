<?php if(isset($_GET['id_usuario'])){ ?>
  <div class="row">
    <div class="col-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-four">
              <div class="stat-icon dib">
                  <i class="fa fa-user-tag text-muted"></i>
              </div>
              <div class="stat-content">
                  <div class="text-left dib">
                      <div class="stat-heading">Usuario</div>
                      <div class="stat-text"><?php echo $usuario['USUARIO_NOMBRE'].' '.$usuario['USUARIO_APELLIDOS']; ?></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
  <div class="row">
    <div class="col">
      <?php retro_alimentacion(); ?>
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <form class="" action="<?php echo base_url('admin/corte_vendedores'); ?>" method="get">
            <div class="titulo">
              <h1 class="h6"> <span class="fa fa-box"></span> Corte Vendedores</h1>
            </div>
            <div class="formulario form-inline">
              <div class="form-group mx-2">
                <label for="MesCorte"> Mes </label>
                <select class="form-control" name="MesCorte">
                  <option value="1">Enero</option>
                  <option value="2">Febrero</option>
                  <option value="3">Marzo</option>
                  <option value="4">Abril</option>
                  <option value="5">Mayo</option>
                  <option value="6">Junio</option>
                  <option value="7">Julio</option>
                  <option value="8">Agosto</option>
                  <option value="9">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
                </select>
              </div>
              <div class="form-group mx-2">
                <label for="AnioCorte"> Año </label>
                <select class="form-control" name="AnioCorte">
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                </select>
              </div>
                <button type="submit" class="btn btn-primary btn-sm" name="button"> <i class="fa fa-search"></i> Buscar</button>
            </div>
          </form>
        </div>
        <div class="card-body p-0">

        </div>
      </div>
    </div>
  </div>
