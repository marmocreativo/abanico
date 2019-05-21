<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auto_hooks extends CI_Controller {

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
		$this->load->model('PagosPedidosModel');
		$this->load->model('DivisasModel');

		//var_dump($_SESSION['pedido']);
	}
	public function index()
	{
		echo 'Sistemas automáticos';
	}
	public function actualizacion_pago_oxxo()
	{

		$body = @file_get_contents('php://input');
		$datos = json_decode($body);
		http_response_code(200); // Return 200 OK

		if($datos->data->object->payment_status=='paid'){
		$folio = $datos->data->object->id;
		$pago = $this->PagosPedidosModel->detalles_folio($folio);
		$pedido = $this->PedidosModel->detalles($pago['ID_PEDIDO']);
		$parametros_pago = array(
			'PAGO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
			'PAGO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
			'PAGO_ESTADO'=> 'Pagado'
		);
		$this->PagosPedidosModel->actualizar_oxxo($folio,$parametros_pago);
		// Pedido
		$parametros_pedido = array(
			'PEDIDO_ESTADO_PEDIDO'=>'Pagado',
			'PEDIDO_ESTADO_PAGO'=>'Pagado',
			'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s')
		);
		$this->PedidosModel->actualizar($pago['ID_PEDIDO'],$parametros_pedido);

		// Preparo correo de revisión

		$this->data['info'] = array();

		$this->data['info']['Titulo'] = 'Se ha realizado un pago con OXXO | Pedido '.$pedido['PEDIDO_FOLIO'];
		$this->data['info']['Nombre'] = 'Por favor revisa que el comprobante sea valido y actualiza el estado del pedido a pagado';
		$this->data['info']['Mensaje'] = '<p>Puedes revisar los detalles del plan en el administrador</p>';
		$this->data['info']['TextoBoton'] = 'Iniciar sesión';
		$this->data['info']['EnlaceBoton'] = base_url('admin/pedidos/detalles?id_pedido='.$pedido['ID_PEDIDO']);
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
		$this->email->to('pagos@abanicoytu.com');


		$this->email->subject('Comprobante de pago '.$pedido['PEDIDO_FOLIO']);
		$this->email->message($mensaje_abanico);
		// envio el correo

		$this->email->send();
	}

	}
}
