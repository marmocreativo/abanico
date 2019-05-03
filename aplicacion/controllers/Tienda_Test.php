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
		$this->data['info']= array();
		$this->data['info']['Monto'] = 260;
		$this->data['info']['Referencia'] = '98000002179953';
		$this->data['info']['Titulo'] = 'Titulo';
		$this->data['info']['Nombre'] = 'Nombre';
		$this->data['info']['Mensaje'] = 'Un mensaje Largo';
		$this->data['info']['EnlaceBoton'] = 'Enlace';
		$this->data['info']['TextoBoton'] = 'Texto del boton';
		$this->data['pedido']['PEDIDO_FOLIO'] = 'XXXXXX';
		$this->data['pedido']['PEDIDO_IMPORTE_TOTAL'] = 'XXXXXX';
		$this->data['pedido']['PEDIDO_DIVISA'] = 'XXXXXX';
		if(isset($_GET['mail'])){
			$mail = $_GET['mail'];
		}else{
			$mail = 'ficha_oxxo';
		}
		$mensaje_oxxo = $this->load->view('emails/'.$mail,$this->data);
	}
	public function guia(){
		$this->data['pedido']['PEDIDO_NOMBRE']='Georgina Alcántar López';
		$this->data['pedido']['PEDIDO_DIRECCION']='Bahía No. 51 depto 103 Ampli. Las Águilas. Álvaro Obregón. CDMX. CP. 01159';
		$this->data['pedido_tienda']['GUIA_PAQUETERIA']='';
		$this->load->view($this->data['dispositivo'].'/admin/imprimir_guia_limpia',$this->data);
	}
}
