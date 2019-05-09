<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Pedidos extends CI_Controller {
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
			$this->load->model('DevolucionesModel');
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
				$this->data['pedidos'] = $this->PedidosModel->lista_usuario('',$_SESSION['usuario']['id'],'PEDIDO_FECHA_REGISTRO DESC','');
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/lista_pedidos',$this->data);
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
				$this->data['pedido'] = $this->PedidosModel->detalles($_GET['id_pedido']);
				$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
				$this->data['productos'] = $this->PedidosProductosModel->lista(['ID_PEDIDO'=>$_GET['id_pedido']],'','');
				$this->data['tiendas'] = $this->PedidosTiendasModel->lista_tiendas($_GET['id_pedido']);
				$this->data['guias_abanico'] = $this->GuiasPedidosModel->lista(['ID_PEDIDO'=>$_GET['id_pedido']],'','');
				$this->data['pagos'] = $this->PagosPedidosModel->lista($_GET['id_pedido']);
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/detalles_pedido',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}

	public function subir_comprobante()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}

			$this->form_validation->set_rules('FormaPago', 'Forma de Pago', 'required', array( 'required' => 'Debes designar la %s'));

			if($this->form_validation->run())
			{
				// Subo el archivo
				$nombre_archivo = 'pago-'.uniqid();
				$config['upload_path']          = 'contenido/adjuntos/pedidos';
				$config['allowed_types']        = 'pdf|jpg|png';
				$config['file_name']						=	$nombre_archivo;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('ArchivoPago')){
					$this->session->set_flashdata('alerta', 'No se pudo subir el archivo');
					redirect(base_url('usuario/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
				}else{
					$archivo = $this->upload->data('file_name');
					// Parametros del Servicio
					$parametros_pago = array(
						'ID_PEDIDO'=> $this->input->post('IdPedido'),
						'PAGO_FORMA'=> $this->input->post('FormaPago'),
						'PAGO_FOLIO'=> $this->input->post('FolioPago'),
						'PAGO_ARCHIVO'=>$archivo,
						'PAGO_IMPORTE'=> $this->input->post('PedidoImporte'),
						'PAGO_DESCRIPCION'=> $this->input->post('DescripcionPago'),
						'PAGO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
						'PAGO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
						'PAGO_ESTADO'=> $this->input->post('EstadoPago'),
					);
					$parametros_pedido = array(
						'PEDIDO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
						'PEDIDO_ESTADO_PAGO'=> $this->input->post('EstadoPago'),
					);
				}
				// Creo el Servicio
				$adjunto_id = $this->PagosPedidosModel->crear($parametros_pago);
				$this->PedidosModel->actualizar($this->input->post('IdPedido'),$parametros_pedido);

				$datos_pedido = $this->PedidosModel->detalles($this->input->post('IdPedido'));

				// Preparo correo de revisión

				$this->data['info'] = array();

				$this->data['info']['Titulo'] = 'Se ha subido un comprobante de pago para el pedido | '.$datos_pedido['PEDIDO_FOLIO'];
				$this->data['info']['Nombre'] = 'Por favor revisa que el comprobante sea valido y actualiza el estado del pedido a pagado';
				$this->data['info']['Mensaje'] = '<p>Puedes revisar los detalles del plan en el administrador</p>';
				$this->data['info']['TextoBoton'] = 'Iniciar sesión';
				$this->data['info']['EnlaceBoton'] = base_url('admin/pedidos/detalles?id_pedido='.$datos_pedido['ID_PEDIDO']);
				// Pedido General
				$mensaje_abanico = $this->load->view('emails/mensaje_general',$this->data,true);

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

				// Envio correo comprobante
				$this->email->clear();
				$this->email->from($this->data['op']['mailer_user'], 'Abanico Siempre lo Mejor');
				$this->email->to($this->data['op']['correo_sitio']);


				$this->email->subject('Comprobante de pago '.$datos_pedido['PEDIDO_FOLIO']);
				$this->email->message($mensaje_abanico);
				// envio el correo

				$this->email->send();

				$this->session->set_flashdata('exito', 'Comprobante cargado correctamente');
				redirect(base_url('usuario/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
			}else{
				$this->session->set_flashdata('alerta', 'No se pudo subir el archivo');
				redirect(base_url('usuario/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
			}
}
	/*
	* Cancelar
	*/
	public function cambiar_estado()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		$this->PedidosModel->estado($_GET['id'],$_GET['estado']);
		redirect(base_url('usuario/pedidos/detalles?id_pedido='.$_GET['id']));
	}
	/*
	* Devolucion
	*/
	public function devolucion()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

			$this->form_validation->set_rules('ComentarioDevolucion', 'Comentario', 'required', array( 'required' => 'Debes agregar tu comentario %s'));

			if($this->form_validation->run())
			{
				// Subo el archivo
				$nombre_archivo = 'devolucion-'.uniqid();
				$config['upload_path']          = 'contenido/adjuntos/pedidos';
				$config['allowed_types']        = 'pdf|jpg|png';
				$config['file_name']						=	$nombre_archivo;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('ArchivoDevolucion')){
					$archivo = '';
				}else{
					$archivo = $this->upload->data('file_name');
				}
					// Parametros del Servicio
					$parametros = array(
						'ID_PEDIDO'=> $this->input->post('IdPedido'),
						'DEVOLUCION_COMENTARIO'=>$this->input->post('ComentarioDevolucion'),
						'DEVOLUCION_ARCHIVO'=>$archivo,
						'DEVOLUCION_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
						'DEVOLUCION_ESTADO'=>'Solicitud'
					);
					$parametros_pedido = array(
						'PEDIDO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
					);
				// Creo el Servicio
				$adjunto_id = $this->DevolucionesModel->crear($parametros);
				$adjunto_id = $this->PedidosModel->actualizar($this->input->post('IdPedido'),$parametros_pedido);

				// Preparo correo de revisión
				$datos_pedido = $this->PedidosMOdel->detalles($this->input->post('IdPedido'));

				$this->data['info'] = array();

				$this->data['info']['Titulo'] = 'Solicitud de devolución | '.$datos_pedido['PEDIDO_FOLIO'];
				$this->data['info']['Nombre'] = 'Por favor revisa que el mensaje y la fotografía';
				$this->data['info']['Mensaje'] = '<p>Puedes revisar los detalles de la solicitud en el administrador</p>';
				$this->data['info']['TextoBoton'] = 'Iniciar sesión';
				$this->data['info']['EnlaceBoton'] = base_url('admin/pedidos/detalles?id_pedido='.$datos_pedido['ID_PEDIDO']);
				// Pedido General
				$mensaje_abanico = $this->load->view('emails/mensaje_general',$this->data,true);

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

				// Envio correo comprobante
				$this->email->clear();
				$this->email->from($this->data['op']['mailer_user'], 'Abanico Siempre lo Mejor');
				$this->email->to($this->data['op']['correo_sitio']);


				$this->email->subject('Solicitud devolución '.$datos_pedido['PEDIDO_FOLIO']);
				$this->email->message($mensaje_abanico);
				// envio el correo

				$this->email->send();


				$this->session->set_flashdata('exito', 'Comprobante cargado correctamente');
				redirect(base_url('usuario/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
			}else{
				$this->session->set_flashdata('alerta', 'No se pudo subir el archivo');
				redirect(base_url('usuario/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
			}
	}
}
