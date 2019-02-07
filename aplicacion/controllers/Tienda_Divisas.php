<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Divisas extends CI_Controller {

	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();

		// Variables defaults
		$this->data['primary'] = "-primary";

		if($this->agent->is_mobile()){
			$this->data['dispositivo']  = "mobile";
		}else{
			$this->data['dispositivo']  = "desktop";
		}

		// Cargo el modelo
		$this->load->model('DivisasModel');
		$this->load->model('NotificacionesModel');
  }

	public function index()
	{
		$this->data['divisa'] = $this->DivisasModel->detalles_iso($_GET['iso']);
		if(!null== $this->data['divisa']){
			$_SESSION['divisa']['id'] = $this->data['divisa']['ID_DIVISA'];
			$_SESSION['divisa']['conversion'] = $this->data['divisa']['DIVISA_CONVERSION'];
			$_SESSION['divisa']['signo'] = $this->data['divisa']['DIVISA_SIGNO'];
			$_SESSION['divisa']['iso'] = $this->data['divisa']['DIVISA_ISO'];
		}
		if(isset($_GET['url_redirect'])&&!empty($_GET['url_redirect'])){
		redirect($_GET['url_redirect']);
		}else{
			redirect(base_url());
		}
	}
}
