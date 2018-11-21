<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Inicio extends CI_Controller {

	public function __construct(){
    parent::__construct();

		$this->load->database(); // load database
		// Cargo las librerías Nativas
		$this->load->library('user_agent');
		// Cargo Helpers Nativos
		$this->load->helper('url');

		// Cargo Opciones
		$this->load->model('opciones');
		$opciones_raw = $this->opciones->get_opciones();
		foreach($opciones_raw as $op_raw){
			$opciones[$op_raw->OPCION_NOMBRE] = $op_raw->OPCION_VALOR;
		}
		$this->data['op'] = $opciones;
		// Modelos Base de datos
		$this->load->model('lenguajes_activos');
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();

		$this->load->model('divisas_activas');
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();
  }

	public function index()
	{

		if($this->agent->is_mobile()){
			$dispositivo = "mobile";
		}else{
			$dispositivo = "desktop";
		}
		$this->load->view($dispositivo.'/tienda/headers/header_inicio',$this->data);
		$this->load->view($dispositivo.'/tienda/pagina_inicio',$this->data);
		$this->load->view($dispositivo.'/tienda/footers/footer_inicio',$this->data);

	}
}
