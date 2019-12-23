<div class="contenido_principal pt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8">
        <div class="card">
          <div class="card-body">
            <div id="paypal-button"></div>
              <script src="https://www.paypalobjects.com/api/checkout.js"></script>
              <script>
                paypal.Button.render({
                  // Configure environment
                  env: 'sandbox',
                  client: {
                    sandbox: 'demo_sandbox_client_id',
                    production: 'demo_production_client_id'
                  },
                  // Customize button (optional)
                  locale: 'es_MX',
                  style: {
                    size: 'responsive',
                    color: 'gold',
                    shape: 'pill'
                  },

                  // Enable Pay Now checkout flow (optional)
                  commit: true,

                  // Set up a payment
                  payment: function(data, actions) {
                    return actions.payment.create({
                      transactions: [{
                        amount: {
                          total: '600',
                          currency: 'MXN'
                        }
                      }]
                    });
                  },
                  // Execute the payment
                  onAuthorize: function(data, actions) {
                    return actions.payment.execute().then(function() {
                      // Show a confirmation message to the buyer
                      window.alert('Thank you for your purchase!');
                    });
                  }
                }, '#paypal-button');

              </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
