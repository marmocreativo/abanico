<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proceso_Pago extends CI_Controller {

	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();
// Cargo Lenguaje
$this->lang->load('front_end', $_SESSION['lenguaje']['iso']);

		// Variables defaults
		$this->data['primary'] = "-primary";

		if($this->agent->is_mobile()){
			$this->data['dispositivo']  = "mobile";
		}else{
			$this->data['dispositivo']  = "desktop";
		}
		// Cargo el modelo
		$this->load->model('UsuariosModel');
		$this->load->model('DireccionesModel');
		$this->load->model('TiendaModel');
		$this->load->model('TiendasModel');
		$this->load->model('TransportistasRangosModel');
		$this->load->model('ProductosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasProductoModel');
		$this->load->model('PedidosModel');
		$this->load->model('PedidosProductosModel');
		$this->load->model('PedidosTiendasModel');
		$this->load->model('AutenticacionModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('PublicacionesModel');
		$this->load->model('PlanesModel');
		$this->load->model('DivisasModel');

		//var_dump($_SESSION['pedido']);
	}
	public function index()
	{
		// Aún no se que poner aquí
		// Limpio la sesión del pedido
		$_SESSION['pedido'] = array();
		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_carrito',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
	}
	public function paso1()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			redirect(base_url('proceso_pago_2'));
		}else{
			// Limpio la sesión del pedido
			$_SESSION['pedido'] = array();
			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_1',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
		}
	}

	public function paso2()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			if(empty($_SESSION['carrito']['productos'])){
				redirect(base_url('carrito'));
			}
			// Limpio la sesión del pedido
			$_SESSION['pedido'] = array();
			// Continúo con la carga normal
			$this->data['direcciones'] = $this->DireccionesModel->lista_direcciones($_SESSION['usuario']['id']);
			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_2',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);

		}else{
			redirect(base_url('proceso_pago_1'));
		}
	}
	public function paso3()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			if(empty($_SESSION['carrito']['productos'])){
				redirect(base_url('carrito'));
			}

			// Reviso si obtuve Id de Dirección o una Dirección Nueva
			if(!null== $this->input->post('CalleDireccion')){
				$this->form_validation->set_rules('CalleDireccion', 'Calle y Número', 'required', array('required' => 'Debes escribir tu %s.'));
				$this->form_validation->set_rules('PaisDireccion', 'País', 'required', array('required' => 'Debes elegir tu %s.'));
				$this->form_validation->set_rules('EstadoDireccion', 'Estado', 'required', array('required' => 'Debes elegir tu %s.'));
				$this->form_validation->set_rules('MunicipioDireccion', 'Municipio', 'required', array('required' => 'Debes elegir tu %s.'));
				$this->form_validation->set_rules('CodigoPostalDireccion', 'Código Postal', 'required', array('required' => 'Debes escribir tu %s.'));
				// Despues de verificar
				if($this->form_validation->run())
				{
					// Parametros de la dirección
					$parametros = array(
						'ID_USUARIO' => $this->input->post('IdUsuario'),
						'DIRECCION_TIPO' => $this->input->post('TipoDireccion'),
						'DIRECCION_ALIAS' => $this->input->post('AliasDireccion'),
						'DIRECCION_PAIS' => $this->input->post('PaisDireccion'),
						'DIRECCION_ESTADO' => $this->input->post('EstadoDireccion'),
						'DIRECCION_CIUDAD' => $this->input->post('CiudadDireccion'),
						'DIRECCION_MUNICIPIO' => $this->input->post('MunicipioDireccion'),
						'DIRECCION_BARRIO' => $this->input->post('BarrioDireccion'),
						'DIRECCION_CALLE_Y_NUMERO' => $this->input->post('CalleDireccion'),
						'DIRECCION_CODIGO_POSTAL' => $this->input->post('CodigoPostalDireccion'),
						'DIRECCION_REFERENCIAS' => $this->input->post('ReferenciasDireccion'),
						'DIRECCION_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
						'DIRECCION_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
					);

					$direccion_id = $this->DireccionesModel->crear($parametros);
				}else{
					// Si tengo errores en la verificación regreso al paso anterior
					// Mensaje de feedback
					$this->session->set_flashdata('alerta', 'Hubo un error al cargar la Nueva Dirección por favor verifica los datos');
					// Redirecciono
					redirect(base_url('proceso_pago_2'));
				}

			}else{
				if(!null==$this->input->post('IdDireccion')){
					$direccion_id = $this->input->post('IdDireccion');
				}else{
					// Mensaje de feedback
					$this->session->set_flashdata('alerta', 'Hay un problema con tu dirección por favor vuelve a seleccionarla');
					// Redirecciono
					redirect(base_url('proceso_pago_2'));
				}
			}

			$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
			$this->data['detalles_direccion'] = $this->DireccionesModel->detalles($direccion_id);
			$this->data['direccion'] = $this->DireccionesModel->direccion_formateada($direccion_id);
			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_3',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

		}else{
			redirect(base_url('proceso_pago_1'));
		}
	}
	public function paso3_banco()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			if(empty($_SESSION['carrito']['productos'])){
				redirect(base_url('carrito'));
			}
			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_3_banco',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);

		}else{
			redirect(base_url('proceso_pago_1'));
		}
	}
	public function paso3_oxxo()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			if(empty($_SESSION['carrito']['productos'])){
				redirect(base_url('carrito'));
			}

			//var_dump($_POST);
			require_once(APPPATH."libraries/conekta/Conekta.php");
			\Conekta\Conekta::setApiKey("key_SP3qR73rqHWqzeJ98i5zCw");
			\Conekta\Conekta::setApiVersion("2.0.0");
			$importe_total = $_POST['ImporteTotal']*100;

try{
  $order = \Conekta\Order::create(
    array(
      "line_items" => array(
        array(
          "name" => $_POST['Folio'],
          "unit_price" => $importe_total,
          "quantity" => 1
        )//first line_item
      ), //line_items
      "shipping_lines" => array(
        array(
          "amount" => 0,
          "carrier" => "ABANICO"
        )
      ), //shipping_lines - physical goods only
      "currency" => "MXN",
      "customer_info" => array(
        "name" => $_POST['PedidoNombre'],
        "email" => $_POST['PedidoCorreo'],
        "phone" => '+52'.$_POST['PedidoTelefono']
      ),
			"shipping_contact" => array(
        "address" => array(
          "street1" => 'asas kljakslj jh akjhs s',
          "postal_code" => "555555",
          "country" => "MXN"
        )//address
      ), //shipping_contact - required only for physical goods
      "charges" => array(
          array(
              "payment_method" => array(
                "type" => "oxxo_cash"
              )//payment_method
          ) //first charge
      ) //charges
    )//order
  );
} catch (\Conekta\ParameterValidationError $error){
  echo $error->getMessage();
} catch (\Conekta\Handler $error){
  echo $error->getMessage();
}

/*
echo "ID: ". $order->id;
echo "Payment Method:". $order->charges[0]->payment_method->service_name;
echo "Reference: ". $order->charges[0]->payment_method->reference;
echo "$". $order->amount/100 . $order->currency;
echo "Order";
echo $order->line_items[0]->quantity .
      "-". $order->line_items[0]->name .
      "- $". $order->line_items[0]->unit_price/100;
			*/


			$this->data['info']= array();

			$this->data['info']['Monto'] = $order->amount/100;
			$this->data['info']['Referencia'] = $order->charges[0]->payment_method->reference;


			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
			$this->load->view('emails/ficha_oxxo',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);


		}else{
			redirect(base_url('proceso_pago_1'));
		}
	}
	public function paso3_paypal()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			if(empty($_SESSION['carrito']['productos'])){
				redirect(base_url('carrito'));
			}
			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_3_paypal',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);

		}else{
			redirect(base_url('proceso_pago_1'));
		}
	}
	public function paso4()
	{
		if(empty($_SESSION['carrito']['productos'])){
			redirect(base_url('carrito'));
		}

		if(isset($_GET['pago'])&&$_GET['pago']=='paypal'){
			$folio = $_SESSION['pedido']['Folio'];
			$IdUsuario = $_SESSION['pedido']['IdUsuario'];
			$PedidoNombre = $_SESSION['pedido']['PedidoNombre'];
			$PedidoCorreo = $_SESSION['pedido']['PedidoCorreo'];
			$PedidoTelefono = $_SESSION['pedido']['PedidoTelefono'];
			$IdDireccion = $_SESSION['pedido']['IdDireccion'];
			$Direccion = $_SESSION['pedido']['Direccion'];
			$Divisa = $_SESSION['pedido']['Divisa'];
			$Conversion = $_SESSION['pedido']['Conversion'];
			$ImporteProductosParcial = $_SESSION['pedido']['ImporteProductosParcial'];
			$ImporteProductosTotal = $_SESSION['pedido']['ImporteProductosTotal'];
			$ImporteEnvioParcial = $_SESSION['pedido']['ImporteEnvioParcial'];
			$ImporteEnvioTotal = $_SESSION['pedido']['ImporteEnvioTotal'];
			$IdTransportista = $_SESSION['pedido']['IdTransportista'];
			$NombreTransportista = $_SESSION['pedido']['NombreTransportista'];
			$ImporteTotal = $_SESSION['pedido']['ImporteTotal'];
			$FormaPago = $_SESSION['pedido']['FormaPago'];
			$EstadoPago = $_SESSION['pedido']['EstadoPago'];
			$EstadoPedido = $_SESSION['pedido']['EstadoPedido'];
			$PedidosTiendas = $_SESSION['pedido']['PedidosTiendas'];
		}else{
			$folio = $_POST['Folio'];
			$IdUsuario = $_POST['IdUsuario'];
			$PedidoNombre = $_POST['PedidoNombre'];
			$PedidoCorreo = $_POST['PedidoCorreo'];
			$PedidoTelefono = $_POST['PedidoTelefono'];
			$IdDireccion = $_POST['IdDireccion'];
			$Direccion = $_POST['Direccion'];
			$Divisa = $_POST['Divisa'];
			$Conversion = $_POST['Conversion'];
			$ImporteProductosParcial = $_POST['ImporteProductosParcial'];
			$ImporteProductosTotal = $_POST['ImporteProductosTotal'];
			$ImporteEnvioParcial = $_POST['ImporteEnvioParcial'];
			$ImporteEnvioTotal = $_POST['ImporteEnvioTotal'];
			$IdTransportista = $_POST['IdTransportista'];
			$NombreTransportista = $_POST['NombreTransportista'];
			$ImporteTotal = $_POST['ImporteTotal'];
			$FormaPago = $_POST['FormaPago'];
			$EstadoPago = $_POST['EstadoPago'];
			$EstadoPedido = $_POST['EstadoPedido'];
			$PedidosTiendas = $_POST['PedidosTiendas'];
		}
		// Variables inicializadas
		$correos_tiendas= array();
		$parametros_pedido = array(
			'PEDIDO_FOLIO'=>$folio,
			'ID_USUARIO' => $IdUsuario,
			'PEDIDO_NOMBRE' => $PedidoNombre,
			'PEDIDO_CORREO' => $PedidoCorreo,
			'PEDIDO_TELEFONO' => $PedidoTelefono,
			'ID_DIRECCION' => $IdDireccion,
			'PEDIDO_DIRECCION' => $Direccion,
			'PEDIDO_DIVISA' => $Divisa,
			'PEDIDO_CONVERSION' => $Conversion,
			'PEDIDO_IMPORTE_PRODUCTOS_PARCIAL' => $ImporteProductosParcial,
			'PEDIDO_IMPORTE_PRODUCTOS_TOTAL' => $ImporteProductosTotal,
			'PEDIDO_IMPORTE_ENVIO_PARCIAL' => $ImporteEnvioParcial,
			'PEDIDO_IMPORTE_ENVIO_TOTAL' => $ImporteEnvioTotal,
			'PEDIDO_ID_TRANSPORTISTA' => $IdTransportista,
			'PEDIDO_NOMBRE_TRANSPORTISTA' => $NombreTransportista,
			'PEDIDO_IMPORTE_TOTAL' => $ImporteTotal,
			'PEDIDO_FORMA_PAGO' => $FormaPago,
			'PEDIDO_ESTADO_PAGO' => $EstadoPago,
			'PEDIDO_ESTADO_PEDIDO' => $EstadoPedido,
			'PEDIDO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
			'PEDIDO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
		);
			$pedido_id = $this->PedidosModel->crear($parametros_pedido);
			$pedidos_tienda = base64_decode($PedidosTiendas);
			$pedidos_tienda = json_decode($pedidos_tienda);
			// Bucle de pedidos Tiendas
			foreach($pedidos_tienda as $tienda){
				$parametros_tienda = array(
					'ID_PEDIDO'=>$pedido_id,
					'ID_TIENDA'=>$tienda->id_tienda,
					'PEDIDO_TIENDA_IMPORTE_PRODUCTOS'=>$tienda->importe_producto,
					'PEDIDO_TIENDA_IMPORTE_ENVIO'=>$tienda->importe_transportista,
					'ID_TRANSPORTISTA'=>$tienda->id_transportista,
					'TRANSPORTISTA_NOMBRE'=>$tienda->nombre_transportista,
					'PEDIDO_TIENDA_ESTADO'=>$this->input->post('EstadoPedido')
				);
				$this->data['tienda'] = $this->TiendasModel->detalles($tienda->id_tienda);
				$this->data['vendedor'] = $this->UsuariosModel->detalles($this->data['tienda']['ID_USUARIO']);
				$correos_tienda[] = $this->data['vendedor']['USUARIO_CORREO'];
				$tienda_id = $this->PedidosTiendasModel->crear($parametros_tienda);
				// Relleno Notificación
				$parametros_notificacion = array(
					'ID_USUARIO'=>$this->data['tienda']['ID_USUARIO'],
					'NOTIFICACION_CONTENIDO'=>'Felicidades alguien te ha hecho una compra',
					'NOTIFICACION_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
					'NOTIFICACION_ESTADO'=>'no leido'
				);
				// Creo la notificación
				$id_notificacion = $this->NotificacionesModel->crear($parametros_notificacion);
				// Redirecciono
			}
			// Bucle de Pedidos Productos
			foreach($_SESSION['carrito']['productos'] as $producto){
					// variables de precio
					if($producto['divisa_default']!=$_SESSION['divisa']['iso']){
						$cambio_divisa_default = $this->DivisasModel->detalles_iso($producto['divisa_default']);
						if($producto['divisa_default']!='MXN'){
							$precio_venta = $producto['precio_producto']/$cambio_divisa_default['DIVISA_CONVERSION'];
							$suma = ($producto['cantidad_producto']*$producto['precio_producto'])/$cambio_divisa_default['DIVISA_CONVERSION'];
						}else{
							$precio_venta = $_SESSION['divisa']['conversion']*$producto['precio_producto'];
							$suma = $_SESSION['divisa']['conversion']*($producto['cantidad_producto']*$producto['precio_producto']);
						}
					}else{

						$precio_venta = $producto['precio_producto'];
						$suma = $producto['cantidad_producto']*$producto['precio_producto'];
					}
					//verifico que solo sea un producto a contra ContraEntrega
					if($producto['contra_entrega']!='si'){
						$solo_productos_contra_entrega = false;
					}

				$parametros_productos = array(
					'ID_PEDIDO'=>$pedido_id,
					'ID_TIENDA'=>$producto['id_tienda'],
					'ID_PRODUCTO'=>$producto['id_producto'],
					'PRODUCTO_NOMBRE'=>$producto['nombre_producto'],
					'PRODUCTO_DETALLES'=>$producto['detalles_producto'],
					'PRODUCTO_IMAGEN'=>$producto['imagen_producto'],
					'CANTIDAD'=>$producto['cantidad_producto'],
					'IMPORTE'=>number_format($precio_venta,2,'.',''),
					'IMPORTE_TOTAL'=>number_format($producto['cantidad_producto']*$precio_venta,2,'.',''),
				);
				$producto_id = $this->PedidosProductosModel->crear($parametros_productos);

				$producto_a_actualizar = $this->ProductosModel->detalles($producto['id_producto']);
				$nueva_cantidad = $producto_a_actualizar['PRODUCTO_CANTIDAD']-$producto['cantidad_producto'];
				if($nueva_cantidad<0){
					$nueva_cantidad = 0;
				}
				$cantidad = array(
					'PRODUCTO_CANTIDAD'=>$nueva_cantidad
				);
				$this->ProductosModel->actualizar($producto['id_producto'],$cantidad);

			}

			// Datos para enviar por correo

			// Datos del pedido

			$this->data['pedido'] = $this->PedidosModel->detalles($pedido_id);
			$this->data['productos'] = $this->PedidosProductosModel->lista(['ID_PEDIDO'=>$pedido_id],'','');

			// Pedido General
			$ficha_pago = $this->load->view('emails/pedido_usuario_ficha',$this->data,true);
			$mensaje_usuario = $this->load->view('emails/pedido_usuario',$this->data,true);
			$mensaje_abanico = $this->load->view('emails/pedido_abanico',$this->data,true);

			// Envio correos Generales
			// Datos para enviar por correo
			// Config General
			$config['protocol']    = 'smtp';
			$config['smtp_host']    = $this->data['op']['mailer_host'];
			$config['smtp_port']    = $this->data['op']['mailer_port'];
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = $this->data['op']['mailer_user'];
			$config['smtp_pass']    = $this->data['op']['mailer_pass'];
			$config['charset']    = 'utf-8';
			$config['mailtype'] = 'html'; // or html
			$config['validation'] = TRUE; // bool whether to validate email or not

			$this->email->initialize($config);

			if($this->data['pedido']['PEDIDO_FORMA_PAGO']=='Transferencia Bancaria'){

				// Ficha de Pago
				$this->email->clear();
				$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
				$this->email->to($this->data['pedido']['PEDIDO_CORREO']);

				$this->email->subject('Ficha de pago '.$this->data['pedido']['PEDIDO_FOLIO']);
				$this->email->message($ficha_pago);
				// envio el correo

				$this->email->send();

			}

			// Terminar

			$this->email->clear();
			$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
			$this->email->to($this->data['pedido']['PEDIDO_CORREO']);

			$this->email->subject('Compra Abanico '.$this->data['pedido']['PEDIDO_FOLIO']);
			$this->email->message($mensaje_usuario);
			// envio el correo

			$this->email->send();

			// Envio correo Abanico
			$this->email->clear();
			$this->email->from($this->data['op']['mailer_user'], 'Abanico Siempre lo Mejor');
			$this->email->to($this->data['op']['correo_sitio']);

			$this->email->subject('Pedido Abanico '.$this->data['pedido']['PEDIDO_FOLIO']);
			$this->email->message($mensaje_abanico);
			// envio el correo

			$this->email->send();


			// Productos
			foreach($pedidos_tienda as $tienda){
				$this->data['pedido_tienda'] = $this->PedidosTiendasModel->detalles($pedido_id,$tienda->id_tienda);
				$this->data['tienda'] = $this->TiendasModel->detalles($tienda->id_tienda);
				$this->data['vendedor'] = $this->UsuariosModel->detalles($this->data['tienda']['ID_USUARIO']);
				$this->data['productos_tienda'] = $this->PedidosProductosModel->lista(['ID_PEDIDO'=>$pedido_id, 'ID_TIENDA'=>$tienda->id_tienda],'','');
						$mensaje_tienda = $this->load->view('emails/pedido_vendedor',$this->data,true);
				$this->email->clear();
				$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
				$this->email->to($this->data['vendedor']['USUARIO_CORREO']);

				$this->email->subject('Venta en Abanico '.$this->data['pedido']['PEDIDO_FOLIO']);
				$this->email->message($mensaje_tienda);
				// envio el correo

				$this->email->send();
			}


		unset($_SESSION['carrito']['tiendas']);
		unset($_SESSION['carrito']['productos']);
		unset($_SESSION['pedido']);
		$_SESSION['carrito']['productos']=array();
		$_SESSION['carrito']['tiendas']=array();
		$_SESSION['pedido']=array();

		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_4',$this->data);
		$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}
	/*
	***
	PASO INVITADO
	***
	*/
	public function invitado_paso2()
	{
			if(empty($_SESSION['carrito']['productos'])){
				redirect(base_url('carrito'));
			}

			$this->form_validation->set_rules('NombreUsuario', 'Nombre', 'required', array('required' => 'Debes escribir tu %s.'));
			$this->form_validation->set_rules('ApellidosUsuario', 'Apellidos', 'required', array('required' => 'Debes escribir tus %s.'));
			$this->form_validation->set_rules('CorreoUsuario', 'Correo Electrónico', 'required|valid_email|is_unique[usuarios.USUARIO_CORREO]', array(
				'required' => 'Debes escribir tu %s.',
				'valid_email' => 'Debes escribir una dirección de correo valida.',
				'is_unique' => 'La dirección de correo ya está registrada'
			));
			$this->form_validation->set_rules('PassUsuario', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));

			// Corro la validación
			if($this->form_validation->run())
			{
				/*
				+ Éxito de validación de formulario
				*/
				// Creo el identificador Único
				$id_usuario = uniqid('', true);
				if(!$this->UsuariosModel->id_usuario_existe($id_usuario)){
					$id_usuario = uniqid('', true);
				}
				// Creo la contraseña

				$pass = password_hash($this->input->post('PassUsuario'), PASSWORD_DEFAULT);
				$parametros = array(
					'ID_USUARIO' => $id_usuario,
					'USUARIO_NOMBRE' => $this->input->post('NombreUsuario'),
					'USUARIO_APELLIDOS' => $this->input->post('ApellidosUsuario'),
					'USUARIO_CORREO' => $this->input->post('CorreoUsuario'),
					'USUARIO_TELEFONO' => $this->input->post('TelefonoUsuario'),
					'USUARIO_PASSWORD' => $pass,
					'USUARIO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
					'USUARIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
					'USUARIO_TIPO' => 'usr-1'
				);
				$usuario_id = $this->UsuariosModel->crear($parametros);
				$parametros = $this->AutenticacionModel->detalles($this->input->post('CorreoUsuario'));
				iniciar_sesion($parametros);
				redirect(base_url('proceso_pago_2'));

			}else{
				$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
				$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_1',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
			}
			// Limpio la sesión del pedido
			$_SESSION['pedido'] = array();
			$_SESSION['pedido']['IdUsuario'] = '0';
			$_SESSION['pedido']['PedidoNombre'] = $this->input->post('NombreUsuario').' '.$this->input->post('ApellidosUsuario');
			$_SESSION['pedido']['PedidoCorreo'] = $this->input->post('CorreoUsuario');
			$_SESSION['pedido']['PedidoTelefono'] = $this->input->post('TelefonoUsuario');
			// Continúo con la carga normal

	}

	public function compra_rapida()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			if(empty($_SESSION['carrito']['productos'])){
				redirect(base_url('carrito'));
			}
			// Limpio la sesión del pedido
			$_SESSION['pedido'] = array();
			// Continúo con la carga normal
			$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
			$direccion = $this->DireccionesModel->direccion_rapida($_SESSION['usuario']['id']);
			$this->data['detalles_direccion'] = $this->DireccionesModel->detalles($direccion['ID_DIRECCION']);
			$this->data['direccion'] = $this->DireccionesModel->direccion_formateada($direccion['ID_DIRECCION']);

			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
			if(!empty($this->data['direccion'])){
			$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_3',$this->data);
		}else{
				$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_2',$this->data);
		}
			$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

		}else{
			redirect(base_url('proceso_pago_1'));
		}
	}
}
