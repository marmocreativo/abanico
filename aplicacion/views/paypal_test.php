<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
</head>

<body>
	<script
		src="https://www.paypal.com/sdk/js?client-id=AT8N8rczYaHnQt4fJFppsMIcCdzD4POW_AoS-U7PPjXcMUhz_XfFH5Sy9XjWCG-SfLWQ6Jz2agmEAb1u&currency=MXN&disable-funding=card"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
	</script>

	<div id="paypal-button-container"></div>

	<script>
	  paypal.Buttons({
	    createOrder: function(data, actions) {
	      // This function sets up the details of the transaction, including the amount and line item details.
	      return actions.order.create({
	        purchase_units: [{
						description: 'Codigo de referencia HOLA',
	          amount: {
	            value: '500.00'
	          }
	        }]
	      });
	    },
			onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        alert('Transaction completed by ' + details.payer.name.given_name);
        // Call your server to save the transaction
        console.log(data);
      });
    }
	  }).render('#paypal-button-container');
	  //This function displays Smart Payment Buttons on your web page.
	</script>
</body>
