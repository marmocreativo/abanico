<div class="contenido_principal">
  <div class="fila fila-titulo">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <h1 class="h3"> <span class="fa fa-tachometer-alt"></span> Escritorio de <?php echo $_SESSION['usuario']['nombre'] ?></h1>
        </div>
      </div>
    </div>
  </div>
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col-sm-6 col-md-8">
          <div class="card">
            <div class="card-header">
              <h4>Pedidos recientes</h4>
            </div>
            <div class="card-body">
              <div class="alert alert-info">
                <p>Aquí se mostrará un resumen de las ultimas compras. En desarrollo</p>
              </div>
            </div>
            <div class="card-footer">
              <p> <a href="#" class="btn btn-primary float-right"> Ver todos</a> </p>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-md-2">
          <?php $this->load->view('desktop/usuarios/widgets/mensajes_recientes'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
