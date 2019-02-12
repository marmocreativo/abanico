<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Lenguaje extends CI_Controller {

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
		$this->load->model('LenguajesModel');
		$this->load->model('NotificacionesModel');
  }

	public function index()
	{
		$this->data['lenguaje'] = $this->LenguajesModel->detalles_iso($_GET['iso']);

		if(!null== $this->data['lenguaje']){
			$_SESSION['lenguaje']['id'] = $this->data['lenguaje']['ID_LENGUAJE'];
			$_SESSION['lenguaje']['nombre'] = $this->data['lenguaje']['LENGUAJE_NOMBRE'];
			$_SESSION['lenguaje']['iso'] = $this->data['lenguaje']['LENGUAJE_ISO'];
		}
		if(isset($_GET['url_redirect'])&&!empty($_GET['url_redirect'])){
		redirect($_GET['url_redirect']);
		}else{
			redirect(base_url());
		}

	}
}
