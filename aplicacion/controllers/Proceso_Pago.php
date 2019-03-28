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
			echo 'Sesion caduca';
			//redirect(base_url('proceso_pago_1'));
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
			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_3_oxxo',$this->data);
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
		$folio = $_SESSION['pedido']['Folio'];
		// Variables inicializadas
		$correos_tiendas= array();
		$parametros_pedido = array(
			'PEDIDO_FOLIO'=>$folio,
			'ID_USUARIO' => $_SESSION['pedido']['IdUsuario'],
			'PEDIDO_NOMBRE' => $_SESSION['pedido']['PedidoNombre'],
			'PEDIDO_CORREO' => $_SESSION['pedido']['PedidoCorreo'],
			'PEDIDO_TELEFONO' => $_SESSION['pedido']['PedidoTelefono'],
			'ID_DIRECCION' => $_SESSION['pedido']['IdDireccion'],
			'PEDIDO_DIRECCION' => $_SESSION['pedido']['Direccion'],
			'PEDIDO_DIVISA' => $_SESSION['pedido']['Divisa'],
			'PEDIDO_CONVERSION' => $_SESSION['pedido']['Conversion'],
			'PEDIDO_IMPORTE_PRODUCTOS_PARCIAL' => $_SESSION['pedido']['ImporteProductosParcial'],
			'PEDIDO_IMPORTE_PRODUCTOS_TOTAL' => $_SESSION['pedido']['ImporteProductosTotal'],
			'PEDIDO_IMPORTE_ENVIO_PARCIAL' => $_SESSION['pedido']['ImporteEnvioParcial'],
			'PEDIDO_IMPORTE_ENVIO_TOTAL' => $_SESSION['pedido']['ImporteEnvioTotal'],
			'PEDIDO_ID_TRANSPORTISTA' => $_SESSION['pedido']['IdTransportista'],
			'PEDIDO_NOMBRE_TRANSPORTISTA' => $_SESSION['pedido']['NombreTransportista'],
			'PEDIDO_IMPORTE_TOTAL' => $_SESSION['pedido']['ImporteTotal'],
			'PEDIDO_FORMA_PAGO' => $_SESSION['pedido']['FormaPago'],
			'PEDIDO_ESTADO_PAGO' => $_SESSION['pedido']['EstadoPago'],
			'PEDIDO_ESTADO_PEDIDO' => $_SESSION['pedido']['EstadoPedido'],
			'PEDIDO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
			'PEDIDO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
		);

			$pedido_id = $this->PedidosModel->crear($parametros_pedido);
			$pedidos_tienda = unserialize($_SESSION['pedido']['PedidosTiendas']);

			// Bucle de pedidos Tiendas
			foreach($pedidos_tienda as $id_tienda => $tienda){
				$parametros_tienda = array(
					'ID_PEDIDO'=>$pedido_id,
					'ID_TIENDA'=>$id_tienda,
					'PEDIDO_TIENDA_IMPORTE_PRODUCTOS'=>$tienda['ImporteProductos'],
					'PEDIDO_TIENDA_IMPORTE_ENVIO'=>$tienda['ImporteEnvio'],
					'ID_TRANSPORTISTA'=>$tienda['IdTransportista'],
					'TRANSPORTISTA_NOMBRE'=>$tienda['NombreTransportista'],
					'PEDIDO_TIENDA_ESTADO'=>$this->input->post('EstadoPedido')
				);
				$this->data['tienda'] = $this->TiendasModel->detalles($id_tienda);
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
				$parametros_productos = array(
					'ID_PEDIDO'=>$pedido_id,
					'ID_TIENDA'=>$producto['id_tienda'],
					'ID_PRODUCTO'=>$producto['id_producto'],
					'PRODUCTO_NOMBRE'=>$producto['nombre_producto'],
					'PRODUCTO_DETALLES'=>$producto['detalles_producto'],
					'PRODUCTO_IMAGEN'=>$producto['imagen_producto'],
					'CANTIDAD'=>$producto['cantidad_producto'],
					'IMPORTE'=>number_format($_SESSION['divisa']['conversion']*$producto['precio_producto'],2,'.',''),
					'IMPORTE_TOTAL'=>number_format($_SESSION['divisa']['conversion']*($producto['cantidad_producto']*$producto['precio_producto']),2,'.',''),
				);
				$producto_id = $this->PedidosProductosModel->crear($parametros_productos);
			}

			// Datos para enviar por correo

			$this->data['pedido'] = $this->PedidosModel->detalles($pedido_id);
			$this->data['productos'] = $this->PedidosProductosModel->lista(['ID_PEDIDO'=>$pedido_id],'','');

			$this->data['pedido_tienda'] = $this->PedidosModel->detalles($pedido_id);
			$this->data['productos_tienda'] = $this->PedidosProductosModel->lista(['ID_PEDIDO'=>$pedido_id, 'ID_TIENDA'=>$id_tienda],'','');
			$correos_tienda[] = $this->input->post('PedidoCorreo');

			$remitente = $this->data['op']['correo_sitio'];
			$destinatarios = $correos_tienda;
			$plantilla = 'emails/pedido_usuario';
			$asunto = 'Pedido Abanico | '.$pedido_id;
			enviar_correo_abanico($remitente,$destinatarios,$plantilla,$asunto);


		unset($_SESSION['carrito']['productos']);
		unset($_SESSION['carrito']['tiendas']);
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
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);

		}else{
			redirect(base_url('proceso_pago_1'));
		}
	}
}
