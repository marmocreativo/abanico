<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Inicio extends CI_Controller {

	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();
		$this->load->model('TiendaModel');

		// Variables defaults
		$this->data['primary'] = "-primary";
  }

	public function index()
	{
		//Redirección al modo mantenimiento
		if($this->data['op']['modo_mantenimiento']=='no'){
			if($this->agent->is_mobile()){
				$dispositivo = "mobile";
			}else{
				$dispositivo = "desktop";
			}
			$this->data['productos'] = $this->TiendaModel->get_productos();
			$this->load->view($dispositivo.'/tienda/headers/header_inicio',$this->data);
			$this->load->view($dispositivo.'/tienda/pagina_inicio',$this->data);
			$this->load->view($dispositivo.'/tienda/footers/footer_inicio',$this->data);

		}else{
			$this->load->view('mantenimiento');
		}
	}
}
