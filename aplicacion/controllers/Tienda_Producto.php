<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Producto extends CI_Controller {
	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();
		$this->load->model('TiendaModel');

		// Variables comunes
		$this->data['primary'] = "-primary-1";
  }
	 public function index()
 	{

 		if($this->agent->is_mobile()){
 			$dispositivo = "mobile";
 		}else{
 			$dispositivo = "desktop";
 		}
		$this->data['producto'] = $this->TiendaModel->datos_producto($_GET['id']);
 		$this->load->view($dispositivo.'/tienda/headers/header_inicio',$this->data);
 		$this->load->view($dispositivo.'/tienda/producto',$this->data);
 		$this->load->view($dispositivo.'/tienda/footers/footer_inicio',$this->data);

 	}
}
