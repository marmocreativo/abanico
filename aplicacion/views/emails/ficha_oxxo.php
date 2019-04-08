<html style="margin: 0;padding: 0;">
	<head style="margin: 0;padding: 0;">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" style="margin: 0;padding: 0;">
	</head>
	<body style="margin: 0;padding: 0;font-size: 14px;">
		<div class="opps" style="margin: 40px auto;padding: 0 45px;width: 496px;border-radius: 4px;box-sizing: border-box;overflow: hidden;border: 1px solid #b0afb5;font-family: 'Open Sans', sans-serif;color: #4f5365;">
			<div class="opps-header" style="margin: 0;padding: 0;">
				<div class="opps-reminder" style="margin: 0;padding: 9px 0 10px;position: relative;top: -1px;font-size: 11px;text-transform: uppercase;text-align: center;color: #ffffff;background: #000000;">Ficha digital. No es necesario imprimir.</div>
				<div class="opps-info" style="margin: 0;padding: 0;margin-top: 26px;position: relative;">
					<div class="opps-brand" style="margin: 0;padding: 0;width: 45%;float: left;"><img src="<?php echo base_url('assets/global/img/oxxopay_brand.png'); ?>" alt="OXXOPay" style="margin: 0;padding: 0;max-width: 150px;margin-top: 2px;"></div>
					<div class="opps-ammount" style="margin: 0;padding: 0;width: 55%;float: right;">
						<h3 style="margin: 0;padding: 0;margin-bottom: 10px;font-size: 15px;font-weight: 600;text-transform: uppercase;">Monto a pagar</h3>
						<h2 style="margin: 0;padding: 0;font-size: 36px;color: #000000;line-height: 24px;margin-bottom: 15px;">$<?php echo $info['Monto'] ?> <sup style="margin: 0;padding: 0;font-size: 16px;position: relative;top: -2px;">MXN</sup></h2>
						<p style="margin: 0;padding: 0;font-size: 10px;line-height: 14px;">OXXO cobrará una comisión adicional al momento de realizar el pago.</p>
					</div>
				</div>
				<div class="opps-reference" style="margin: 0;padding: 0;margin-top: 14px;">
					<h3 style="margin: 0;padding: 0;margin-bottom: 10px;font-size: 15px;font-weight: 600;text-transform: uppercase;">Referencia</h3>
					<h1 style="margin: 0;padding: 6px 0 7px;font-size: 27px;color: #000000;text-align: center;margin-top: -1px;border: 1px solid #b0afb5;border-radius: 4px;background: #f8f9fa;"><?php echo $info['Referencia'] ?></h1>
				</div>
			</div>
			<div class="opps-instructions" style="margin: 32px -45px 0;padding: 32px 45px 45px;border-top: 1px solid #b0afb5;background: #f8f9fa;">
				<h3 style="margin: 0;padding: 0;margin-bottom: 10px;font-size: 15px;font-weight: 600;text-transform: uppercase;">Instrucciones</h3>
				<ol style="margin: 17px 0 0 16px;padding: 0;">
					<li style="margin: 0;padding: 0;">Acude a la tienda OXXO más cercana. <a href="https://www.google.com.mx/maps/search/oxxo/" target="_blank" style="margin: 0;padding: 0;color: #1155cc;">Encuéntrala aquí</a>.</li>
					<li style="margin: 0;padding: 0;margin-top: 10px;color: #000000;">Indica en caja que quieres realizar un pago de <strong style="margin: 0;padding: 0;">OXXOPay</strong>.</li>
					<li style="margin: 0;padding: 0;margin-top: 10px;color: #000000;">Dicta al cajero el número de referencia en esta ficha para que tecleé directamete en la pantalla de venta.</li>
					<li style="margin: 0;padding: 0;margin-top: 10px;color: #000000;">Realiza el pago correspondiente con dinero en efectivo.</li>
					<li style="margin: 0;padding: 0;margin-top: 10px;color: #000000;">Al confirmar tu pago, el cajero te entregará un comprobante impreso.<strong style="margin: 0;padding: 0;">En el podrás verificar que se haya realizado correctamente.</strong> Conserva este comprobante de pago.</li>
				</ol>
				<div class="opps-footnote" style="margin: 0;padding: 22px 20 24px;margin-top: 22px;color: #108f30;text-align: center;border: 1px solid #108f30;border-radius: 4px;background: #ffffff;">Al completar estos pasos recibirás un correo de <br style="margin: 0;padding: 0;"><strong style="margin: 0;padding: 0;">Abanico</strong> confirmando tu pago.</div>
			</div>
		</div>
	</body>
</html>
