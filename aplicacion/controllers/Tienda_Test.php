<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Test extends CI_Controller {

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
			$this->data['dispositivo']  = "desktop";
		}else{
			$this->data['dispositivo']  = "desktop";
		}

		// Cargo el modelo
		$this->load->model('TiendaModel');
		$this->load->model('ProductosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasProductoModel');
		$this->load->model('CalificacionesModel');
		$this->load->model('PedidosModel');
		$this->load->model('PedidosProductosModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('PublicacionesModel');
  }

	public function index()
	{

		$this->data['titulo'] = 'Abanico siempre lo mejor';
		$this->data['descripcion'] = 'Compra y vende artículos por internet';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/test',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
	}
	public function guia(){
		$this->data['pedido']['PEDIDO_NOMBRE']='Georgina Alcántar López';
		$this->data['pedido']['PEDIDO_DIRECCION']='Bahía No. 51 depto 103 Ampli. Las Águilas. Álvaro Obregón. CDMX. CP. 01159';
		$this->data['pedido_tienda']['GUIA_PAQUETERIA']='';

		$this->data['titulo'] = 'Abanico siempre lo mejor';
		$this->data['descripcion'] = 'Compra y vende artículos por internet';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');
		
		$this->load->view($this->data['dispositivo'].'/admin/imprimir_guia_limpia',$this->data);
	}
	public function barcode(){
		require_once(APPPATH.'libraries/barcode/BarcodeGenerator.php');
		require_once(APPPATH.'libraries/barcode/BarcodeGeneratorHTML.php');
		$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
		echo $generator->getBarcode('081231723897', $generator::TYPE_CODE_128);
	}
}
