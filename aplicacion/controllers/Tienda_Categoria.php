<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Categoria extends CI_Controller {
	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();
		$this->load->model('TiendaModel');

		// Variables comunes
		$this->data['primary'] = "-primary-".rand(1,8);
  }
	 public function index()
 	{

 		if($this->agent->is_mobile()){
 			$dispositivo = "mobile";
 		}else{
 			$dispositivo = "desktop";
 		}
		$this->data['productos'] = $this->TiendaModel->get_productos();
 		$this->load->view($dispositivo.'/tienda/headers/header_inicio',$this->data);
 		$this->load->view($dispositivo.'/tienda/categoria_productos',$this->data);
 		$this->load->view($dispositivo.'/tienda/footers/footer_inicio',$this->data);

 	}
}
