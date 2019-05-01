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
		$parametros_pago = array(
			'PAGO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
			'PAGO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
			'PAGO_ESTADO'=> 'Pagado'
		);
		$this->PagosPedidosModel->actualizar_oxxo($folio,$parametros_pago);
		// Pedido
		$parametros_pedido = array(
			'PEDIDO_ESTADO_PEDIDO'=>'Pagado',
			'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s')
		);
		$this->PedidosModel->actualizar($pago['ID_PEDIDO'],$parametros_pedido);
	}

	}
}
