<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Servicio extends CI_Controller {
	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();

		// Variables defaults
		$this->data['primary'] = "-primary";

		if($this->agent->is_mobile()){
			$this->data['dispositivo'] = "mobile";
		}else{
			$this->data['dispositivo']  = "desktop";
		}
		$this->load->model('UsuariosModel');
		$this->load->model('ServiciosModel');
		$this->load->model('GaleriasServiciosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('CategoriasModel');
		$this->load->model('TiendasModel');
		$this->load->model('DireccionesModel');
		$this->load->model('FavoritosModel');

		// Variables comunes
		$this->data['primary'] = "-info";
  }
	 public function index()
 	{

		$this->data['servicio'] = $this->ServiciosModel->detalles($_GET['id']);
		$this->data['portada'] = $this->GaleriasServiciosModel->galeria_portada($_GET['id']);
		$this->data['galerias'] = $this->GaleriasServiciosModel->galeria_servicio($_GET['id']);
		$this->data['tienda'] = $this->TiendasModel->tienda_usuario($this->data['servicio']['ID_USUARIO']);
		$direccion_fiscal = $this->DireccionesModel->direccion_fiscal($this->data['servicio']['ID_USUARIO']);
		$this->data['direccion_formateada'] = $this->DireccionesModel->direccion_formateada($direccion_fiscal['ID_DIRECCION']);
		$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');

 		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_servicios',$this->data);
 		$this->load->view($this->data['dispositivo'].'/tienda/servicio',$this->data);
 		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

 	}
}
