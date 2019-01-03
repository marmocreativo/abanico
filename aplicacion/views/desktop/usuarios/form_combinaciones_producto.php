<?php if(isset($_GET['tab'])){ $tab = $_GET['tab']; } else { $tab='categoria'; } ?>
<div class="contenido_principal">
  <div class="fila">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 fila fila-gris">
          <?php $this->load->view('desktop/usuarios/widgets/menu_control_usuario'); ?>
        </div>
        <div class="col">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="titulo">
                  <h1 class="h5"> <span class="fa fa-box"></span> Actualizar <?php echo $producto['PRODUCTO_NOMBRE']; ?></h1>
                </div>
                <div class="herramientas">
                    <a href="<?php echo base_url('usuario/productos'); ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-arrow-left"></span> Regresar a los productos</a>
                </div>
              </div>
              <div class="card-body">
                <?php retro_alimentacion(); ?>
                <?php if(!empty(validation_errors())){ ?>
                  <div class="alert alert-danger">
                    <?php echo validation_errors(); ?>
                  </div>
                  <hr>
                <?php } ?>
              <form class="" action="<?php echo base_url('usuario/productos_combinaciones/actualizar'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="TipoProducto" value="<?php echo $tipo_producto; ?>">
                <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION['usuario']['id']; ?>">
                <input type="hidden" name="IdTienda" value="<?php echo $tienda['ID_TIENDA']; ?>">
                <input type="hidden" name="Identificador" value="<?php echo $_GET['id']; ?>">
                <input type="hidden" name="UrlProducto" value="<?php echo $producto['PRODUCTO_URL']; ?>">
                <div class="row">
                  <div class="col">
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link <?php if($tab==''){ echo 'active'; } ?>" id="basicos-tab" data-toggle="tab" href="#basicos" role="tab" aria-controls="basicos" aria-selected="false"> <span class="fa fa-list"></span> Datos Básicos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link <?php if($tab=='categoria'){ echo 'active'; } ?>" id="categoria-tab" data-toggle="tab" href="#categoria" role="tab" aria-controls="categoria" aria-selected="false"> <span class="fa fa-list"></span> Categorias</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link <?php if($tab=='datos'){ echo 'active'; } ?>" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="true"> <span class="fa fa-file-alt"></span> Descripción</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link <?php if($tab=='galeria'){ echo 'active'; } ?>" id="galeria-tab" data-toggle="tab" href="#galeria" role="tab" aria-controls="galeria" aria-selected="false"> <span class="fa fa-image"></span> Galeria</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade <?php if($tab=='galeria'){ echo 'show active'; } ?> p-3" id="galeria" role="tabpanel" aria-labelledby="extras-tab">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="ImagenProducto">Añadir Imagen</label>
                              <input type="file" class="form-control" id="ImagenProducto" name="ImagenProducto">
                            </div>
                            <table class="table table-bordered table-sm">
                              <thead>
                                <tr>
                                  <th class="text-center">id</th>
                                  <th class="text-center">Imagen</th>
                                  <th class="text-center">Portada</th>
                                  <th class="text-right">Controles</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($galerias as $galeria){ ?>
                                  <tr>
                                    <td class="text-center"><?php echo $galeria->ID_GALERIA; ?></td>
                                    <td class="text-center">
                                      <img src="<?php echo base_url($op['ruta_imagenes_producto'].'completo/'.$galeria->GALERIA_ARCHIVO) ?>" alt="" width="50">
                                    </td>
                                    <td class="text-center">
                                      <?php if($galeria->GALERIA_PORTADA=='si'){ ?>
                                        <a href="<?php echo base_url('usuario/productos/portada')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                                      <?php }else{ ?>
                                        <a href="<?php echo base_url('usuario/productos/portada')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                                      <?php } ?>
                                    </td>
                                    <td class="text-right">
                                      <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="<?php echo base_url('usuario/productos/borrar_galeria')."?id=".$galeria->ID_GALERIA."&id_producto=".$galeria->ID_PRODUCTO; ?>" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></a>
                                      </div>
                                    </td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row border-top mt-3 pt-3">
                  <div class="col">
                    <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Actualizar Producto</button>
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
