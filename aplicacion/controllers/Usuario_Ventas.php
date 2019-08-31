<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Ventas extends CI_Controller {
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
			$this->load->model('ProductosModel');
			$this->load->model('UsuariosModel');
			$this->load->model('GaleriasModel');
			$this->load->model('CategoriasModel');
			$this->load->model('CategoriasProductoModel');
			$this->load->model('TiendasModel');
			$this->load->model('PerfilServiciosModel');
			$this->load->model('PedidosModel');
			$this->load->model('PedidosTiendasModel');
			$this->load->model('PedidosProductosModel');
			$this->load->model('GuiasPedidosModel');
			$this->load->model('PagosPedidosModel');
			$this->load->model('NotificacionesModel');
  }

	public function index()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

				// Obtengo los datos de mi tiendas
				$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
				$this->data['pedidos'] = $this->PedidosTiendasModel->lista_pedidos_tienda($this->data['tienda']['ID_TIENDA']);

				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/lista_ventas',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}
	public function detalles()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

				// Obtengo los datos de mi tiendas
				$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
				$this->data['pedido'] = $this->PedidosModel->detalles($_GET['id_pedido']);
				$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
				$this->data['productos'] = $this->PedidosProductosModel->lista_tienda(['ID_PEDIDO'=>$_GET['id_pedido']],$this->data['tienda']['ID_TIENDA'],'','');
				$this->data['tiendas'] = $this->PedidosTiendasModel->lista_tiendas($_GET['id_pedido']);
				$this->data['pedido_tienda'] = $this->PedidosTiendasModel->detalles($_GET['id_pedido'],$this->data['tienda']['ID_TIENDA']);
				$this->data['guias_abanico'] = $this->GuiasPedidosModel->lista(['ID_PEDIDO'=>$_GET['id_pedido']],'','');
				$this->data['pagos'] = $this->PagosPedidosModel->lista($_GET['id_pedido']);
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/detalles_venta',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}

	public function guia()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
			// Defino tipo de Servicio y tipo de Categoría
			$tipo_categoria = 'servicios';

			$this->form_validation->set_rules('GuiaPaqueteria', 'Número de Guía', 'required', array( 'required' => 'Debes designar el %s'));

			if($this->form_validation->run())
			{
				$parametros = array(
					'GUIA_PAQUETERIA'=> $this->input->post('GuiaPaqueteria'),
					'URL_RASTREO'=> $this->input->post('UrlRastreo'),
					'PEDIDO_TIENDA_ESTADO'=> 'Enviado',
				);
				$parametros_pedido = array(
					'PEDIDO_ESTADO_PEDIDO'=> 'Enviado',
					'PEDIDO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				);
				// Creo el Servicio
				$this->PedidosTiendasModel->actualizar($this->input->post('IdPedidoTienda'),$parametros);
				$this->PedidosModel->actualizar($this->input->post('IdPedido'),$parametros_pedido);

				//
				$this->data['tienda'] = $this->TiendasModel->detalles($this->input->post('IdTienda'));
				$this->data['pedido'] = $this->PedidosModel->detalles($this->input->post('IdPedido'));
				$this->data['productos'] = $this->PedidosProductosModel->lista_tienda(['ID_PEDIDO'=>$this->input->post('IdPedidoTienda')],$this->data['tienda']['ID_TIENDA'],'','');
				$this->data['tiendas'] = $this->PedidosTiendasModel->lista_tiendas($_GET['id_pedido']);
				$this->data['pedido_tienda'] = $this->PedidosTiendasModel->detalles($_GET['id_pedido'],$this->data['tienda']['ID_TIENDA']);
				$this->data['guias_abanico'] = $this->GuiasPedidosModel->lista(['ID_PEDIDO'=>$_GET['id_pedido']],'','');
				$this->data['pagos'] = $this->PagosPedidosModel->lista($_GET['id_pedido']);
				// Pedido General
				$correo = $this->load->view('emails/pedido_guia',$this->data, true);

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

					// Ficha de Pago
					$this->email->clear();
					$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
					$this->email->to($this->data['pedido']['PEDIDO_CORREO']);

					$this->email->subject('Guía de rastreo | '.$this->data['pedido']['PEDIDO_FOLIO']);
					$this->email->message($correo);
					// envio el correo
					if($this->email->send()){
						$this->session->set_flashdata('exito', 'Número de Guía Enviada');
						redirect(base_url('usuario/ventas/detalles?id_pedido='.$this->input->post('IdPedido')));
					}else{
						$this->session->set_flashdata('advertencia', 'Guía asignada correctamente, no se pudo enviar el correo');
						redirect(base_url('usuario/ventas/detalles?id_pedido='.$this->input->post('IdPedido')));
					}


			}else{
				$this->session->set_flashdata('alerta', 'No se pudo asignar la guia');
				redirect(base_url('usuario/ventas/detalles?id_pedido='.$this->input->post('IdPedido')));
			}
}
	public function conversacion()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

				// Obtengo los datos de mi tiendas
				$this->data['conversacion'] = $this->PedidosModel->detalles($_GET['id']);
				$this->data['mensajes'] = $this->ConversacionesMensajesModel->lista_mensajes_conversacion($_GET['id']);
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/lista_mensajes',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}


	public function enviar_correo()
	{
		// datos generales
		$this->data['tienda'] = $this->TiendasModel->detalles($_GET['id_tienda']);
		$this->data['pedido'] = $this->PedidosModel->detalles($_GET['id_pedido']);
		$this->data['productos'] = $this->PedidosProductosModel->lista_tienda(['ID_PEDIDO'=>$_GET['id_pedido']],$this->data['tienda']['ID_TIENDA'],'','');
		$this->data['tiendas'] = $this->PedidosTiendasModel->lista_tiendas($_GET['id_pedido']);
		$this->data['pedido_tienda'] = $this->PedidosTiendasModel->detalles($_GET['id_pedido'],$this->data['tienda']['ID_TIENDA']);
		$this->data['guias_abanico'] = $this->GuiasPedidosModel->lista(['ID_PEDIDO'=>$_GET['id_pedido']],'','');
		$this->data['pagos'] = $this->PagosPedidosModel->lista($_GET['id_pedido']);

		if(isset($_GET['tipo_mensaje'])&&!empty($_GET['tipo_mensaje'])){
			switch ($_GET['tipo_mensaje']) {
				case 'estado':
					// code...
					break;
				case 'reenviar':
					// code...
					break;
				case 'guia':
						// Datos para el correo

						// Pedido General
						$correo = $this->load->view('emails/pedido_guia',$this->data, true);

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

							// Ficha de Pago
							$this->email->clear();
							$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
							$this->email->to($this->data['pedido']['PEDIDO_CORREO']);

							$this->email->subject('Guía de rastreo | '.$this->data['pedido']['PEDIDO_FOLIO']);
							$this->email->message($correo);
							// envio el correo

							$this->email->send();

						$this->session->set_flashdata('exito', 'Número de Guía Enviada');
						redirect(base_url('usuario/ventas/detalles?id_pedido='.$this->input->get('id_pedido')));
					break;
			}
		}
		$this->session->set_flashdata('alerta', 'No se ha enviado nigún mensaje');
		redirect(base_url('usuario/ventas/detalles?id_pedido='.$this->input->get('id_pedido')));
	}
}
