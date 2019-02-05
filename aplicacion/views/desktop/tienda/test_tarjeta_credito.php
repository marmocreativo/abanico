<div class="contenido_principal">
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Tarjeta de crédito o débito</h5>
      </div>
        <div class="pre-footer">
          <div class="barra-color barra-azul"></div>
          <div class="barra-color barra-rosa"></div>
          <div class="barra-color barra-amarillo"></div>
          <div class="barra-color barra-verde"></div>
          <div class="barra-color barra-morado"></div>
        </div>
      <div class="card-body">
        <form>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputTitular">Nombre del Titular</label>
              <input type="number" class="form-control" id="inputTitular" placeholder="Como aparece en la tarjeta">
            </div>
            <div class="form-group col-md-6">
              <label for="cardNumber">Número de Tarjeta</label>
          		<div class="input-group">
          			<input type="text" class="form-control" name="cardNumber" placeholder="">
          			<div class="input-group-append">
          				<span class="input-group-text text-muted">
          					<i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>  
          					<i class="fab fa-cc-mastercard"></i>
          				</span>
          			</div>
          		</div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-sm-8">
              <div class="form-group">
                <label><span class="hidden-xs">Fecha de Expiración</span> </label>
                <div class="form-inline">
                  <select class="form-control" style="width:45%">
                    <option>MM</option>
                    <option>01 - Enero</option>
                    <option>02 - Febrero</option>
                    <option>03 - Marzo</option>
                  </select>
                  <span style="width:10%; text-align: center"> / </span>
                  <select class="form-control" style="width:45%">
                    <option>YY</option>
                    <option>2018</option>
                    <option>2019</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
                <input class="form-control" required="" type="text">
              </div> <!-- form-group.// -->
            </div>
      	</div>
          <button type="submit" class="btn btn-lg btn-primary-17 mt-2">Pagar</button>
        </form>
      </div>
    </div>
  <div>
</div>
