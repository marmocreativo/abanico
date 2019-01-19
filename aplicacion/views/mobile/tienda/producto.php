<div class="bxInfoContent bxDetalle pb-4">
  <div class="container">
    <div class="row">

      <div class="slideBxProducto mb-4">
        <ul class="slides">
          <?php for($i=0; $i<=3; $i++){ ?>
          <li>
            <img src="https://picsum.photos/300/300/?random=<?php echo $i; ?>" alt="">
          </li>
          <?php } ?>
        </ul>
      </div>

      <div class="col-12 mb-4">
        <p class="text-muted"><small>1 Disponibles</small></p>
        <h4 class="product-title mb-2">JABON</h4>
        <hr>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p>
        <hr>
        <h2 class="product-price display-6">
          <small>$</small>
          <span id="Precio_Producto">50.00</span>
          <small>MXN </small>
        </h2>
        <hr>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="" class="sr-only">Cantidad</label>
              <input type="number" class="form-control" name="CantidadProducto" id="CantidadProducto" min="1" max="1" value="1">
            </div>
          </div>
          <div class="col">
            <button class="btn btn-primary-3 btn- btn-block" id="BotonComprar" data-id-producto="8" data-nombre-producto="JABON" data-imagen-producto="http://localhost/abanico-master/contenido/img/productos/completo/categoria-5c1a76bd5a6fd.jpg" data-peso-producto="20.00" data-detalles-producto="" data-precio-producto="50.00" data-id-tienda="1" data-nombre-tienda="Espejo Negro">
              <span class="fa fa-shopping-cart"></span> Comprar Ahora
            </button>
          </div>
        </div>
      </div>

      <div class="col-12 mb-4">
          <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detalles</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Características</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="preguntas-tab" data-toggle="tab" href="#preguntas" role="tab" aria-controls="preguntas" aria-selected="false">Preguntas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Acerca del Vendedor</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="py-3">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
              </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="py-3">
                <div class="row">
                  <div class="col-12">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th colspan="2">Modelo y Claves</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Modelo</td>
                          <td>ROMA </td>
                        </tr>
                        <tr>
                          <td>Origen</td>
                          <td>México </td>
                        </tr>
                        <tr>
                          <td>SKU</td>
                          <td>ROM </td>
                        </tr>
                        <tr>
                          <td>UPC</td>
                          <td>    </td>
                        </tr>
                        <tr>
                          <td>EAN</td>
                          <td>    </td>
                        </tr>
                        <tr>
                          <td>JAN</td>
                          <td>    </td>
                        </tr>
                        <tr>
                          <td>ISBN</td>
                          <td>    </td>
                        </tr>
                        <tr>
                          <td>MPN</td>
                          <td>    </td>
                        </tr>
                        <tr>
                          <td>EAN</td>
                          <td>    </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-12">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th colspan="2">Dimensiones y Peso</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Ancho</td>
                          <td>30.00 <small>cm</small> </td>
                        </tr>
                        <tr>
                          <td>Alto</td>
                          <td>25.00 <small>cm</small> </td>
                        </tr>
                        <tr>
                          <td>Profundo</td>
                          <td>15.00 <small>cm</small> </td>
                        </tr>
                        <tr>
                          <td>Peso</td>
                          <td>20.00 <small>Kg</small> </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="preguntas" role="tabpanel" aria-labelledby="contact-tab">
              <div class="py-3">
                <div class="card">
                  <div class="card-body">
                    <p>Para preguntar debes Iniciar Sesión.</p>
                    <a href="http://localhost/abanico-master/login?url_redirect=http://localhost/abanico-master/producto/?id=8" class="btn btn-outline-primary-3 btn-block"> <i class="fa fa-sign-in-alt"></i> Inicia Sesión</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              <div class="py-3">
                <div class="row">
                  <div class="col-3">
                    <img src="http://localhost/abanico-master/contenido/img/tiendas/completo/tienda-5c1e6ac549a93.jpg" alt="" class="img-fluid img-thumbnail rounded-circle">
                  </div>
                  <div class="col-9">
                    <table class="table table-sm table-borderless">
                      <tbody><tr>
                        <td><b>Nombre Público</b></td>
                        <td>Espejo Negro</td>
                      </tr>
                      <tr>
                        <td><b>Razón Social</b></td>
                        <td>Espejo Negro SA de CV</td>
                      </tr>
                      <tr>
                        <td><b>R.F.C.</b></td>
                        <td>ESNE34565677</td>
                      </tr>
                      <tr>
                        <td><b>Teléfono</b></td>
                        <td>26032335</td>
                      </tr>
                      <tr>
                        <td><b>Registro</b><br>2018-12-05 08:05:30</td>
                        <td><b>Actualización</b><br>2019-01-06 16:02:39</td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <hr>
                <div class="row pt-3">
                  <div class="col-12">
                    <h6>Dirección Fiscal</h6>
                    <p>Avenida 561 No. 148, San Juan de Aragón II, Gustavo A. Madero, Ciudad de México, Ciudad de México, 07969, México</p>
                  </div>
                </div>
              </div>

            </div>
          </div>
      </div>

      <div class="col-12 mb-4">

        <div class="mb-4">
          <h5 class="mb-3">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
            Calificaciones (1)
          </h5>
          <div class="row">
            <div class="col-5">
              <ul class=" list-unstyled rating m-0">
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
              </ul>
            </div>
            <div class="col-7">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-5">
              <ul class=" list-unstyled rating m-0">
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
              </ul>
            </div>
            <div class="col-7">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-5">
              <ul class=" list-unstyled rating m-0">
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
              </ul>
            </div>
            <div class="col-7">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-5">
              <ul class=" list-unstyled rating m-0">
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
              </ul>
            </div>
            <div class="col-7">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-5">
              <ul class=" list-unstyled rating m-0">
                <i class="fa fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
                <i class="far fa-star" style="font-size:0.8em;"></i>
              </ul>
            </div>
            <div class="col-7">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

           <div class="card mb-4">
                <div class="card-body">
                  <p>Para calificar este producto.</p>
                  <a href="http://localhost/abanico-master/login?url_redirect=http://localhost/abanico-master/producto/?id=8" class="btn btn-outline-primary-3 btn-block"> <i class="fa fa-sign-in-alt"></i> Inicia Sesión</a>
                </div>
           </div>

          <ul class="list-unstyled">
              <li class="media py-3">
                <img class="mr-3 img-thumbnail rounded-circle" src="http://localhost/abanico-master/assets/global/img/usuario_default.png" alt="" width="64">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">JORGE CARRASCO</h5>
                  <div class="d-flex border-top border-bottom py-3">
                       <i class="fa fa-star"></i>
                       <i class="fa fa-star"></i>
                       <i class="fa fa-star"></i>
                       <i class="fa fa-star"></i>
                       <i class="fa fa-star"></i>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
              </li>
              <li class="media py-3">
                <img class="mr-3 img-thumbnail rounded-circle" src="http://localhost/abanico-master/assets/global/img/usuario_default.png" alt="" width="64">
                <div class="media-body">
                   <h5 class="mt-0 mb-1">Martha Martínez Ruíz</h5>
                   <div class="d-flex border-top border-bottom py-3">
                       <i class="fa fa-star"></i>
                       <i class="far fa-star"></i>
                       <i class="far fa-star"></i>
                       <i class="far fa-star"></i>
                       <i class="far fa-star"></i>
                   </div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
             </li>
          </ul>
      </div>

    </div>
  </div>
</div>
