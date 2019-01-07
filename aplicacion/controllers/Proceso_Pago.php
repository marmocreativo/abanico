<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proceso_Pago extends CI_Controller {

	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();

		// Variables defaults
		$this->data['primary'] = "-primary";

		if($this->agent->is_mobile()){
			$this->data['dispositivo']  = "desktop";
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
	}
	public function index()
	{
		// Aún no se que poner aquí
		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_carrito',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
	}
	public function paso1()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			redirect(base_url('proceso_pago_2'));
		}else{
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
		// Variables inicializadas
		$correos_tiendas= array();
		$parametros_pedido = array(
			'ID_USUARIO' => $this->input->post('IdUsuario'),
			'PEDIDO_NOMBRE' => $this->input->post('PedidoNombre'),
			'PEDIDO_CORREO' => $this->input->post('PedidoCorreo'),
			'PEDIDO_TELEFONO' => $this->input->post('PedidoTelefono'),
			'ID_DIRECCION' => $this->input->post('IdDireccion'),
			'PEDIDO_DIRECCION' => $this->input->post('Direccion'),
			'PEDIDO_DIVISA' => $this->input->post('Divisa'),
			'PEDIDO_CONVERSION' => $this->input->post('Conversion'),
			'PEDIDO_IMPORTE_PRODUCTOS_PARCIAL' => $this->input->post('ImporteProductosParcial'),
			'PEDIDO_IMPORTE_PRODUCTOS_TOTAL' => $this->input->post('ImporteProductosTotal'),
			'PEDIDO_IMPORTE_ENVIO_PARCIAL' => $this->input->post('ImporteEnvioParcial'),
			'PEDIDO_IMPORTE_ENVIO_TOTAL' => $this->input->post('ImporteEnvioTotal'),
			'PEDIDO_ID_TRANSPORTISTA' => $this->input->post('IdTransportista'),
			'PEDIDO_NOMBRE_TRANSPORTISTA' => $this->input->post('NombreTransportista'),
			'PEDIDO_IMPORTE_TOTAL' => $this->input->post('ImporteTotal'),
			'PEDIDO_FORMA_PAGO' => $this->input->post('FormaPago'),
			'PEDIDO_ESTADO_PAGO' => $this->input->post('EstadoPago'),
			'PEDIDO_ESTADO_PEDIDO' => $this->input->post('EstadoPedido'),
			'PEDIDO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
			'PEDIDO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
		);

			$pedido_id = $this->PedidosModel->crear($parametros_pedido);
			$pedidos_tienda = unserialize($this->input->post('PedidosTiendas'));

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
			/*
			$config['protocol']    = 'smtp';
			$config['smtp_host']    = $this->data['op']['mailer_host'];
			$config['smtp_port']    = $this->data['op']['mailer_port'];
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = $this->data['op']['mailer_user'];
			$config['smtp_pass']    = $this->data['op']['mailer_pass'];
			$config['charset']    = 'utf-8';
			$config['mailtype'] = 'html'; // or html
			$config['validation'] = TRUE; // bool whether to validate email or not

			$mensaje = $this->load->view('emails/pedido_usuario',$this->data,true);
			$this->email->initialize($config);

			$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
			$correos_tienda[] = $this->input->post('PedidoCorreo');
			$this->email->to($correos_tienda);

			$this->email->subject('Pedido Abanico | '.$pedido_id);
			$this->email->message($mensaje);
			// envio el correo
			$this->email->send();
			*/
			$remitente = $this->data['op']['correo_sitio'];
			$destinatarios = $correos_tienda;
			$plantilla = 'emails/pedido_usuario';
			$asunto = 'Pedido Abanico | '.$pedido_id;
			enviar_correo_abanico($remitente,$destinatarios,$plantilla,$asunto);


		unset($_SESSION['carrito']['productos']);
		unset($_SESSION['carrito']['tiendas']);
		$_SESSION['carrito']['productos']=array();
		$_SESSION['carrito']['tiendas']=array();
		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_4',$this->data);
		$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}
}
