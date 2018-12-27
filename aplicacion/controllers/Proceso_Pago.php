<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proceso_Pago extends CI_Controller {

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
		// Cargo el modelo
		$this->load->model('UsuariosModel');
		$this->load->model('DireccionesModel');
		$this->load->model('TiendaModel');
		$this->load->model('ProductosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasProductoModel');
	}
	public function index()
	{
		// Aún no se que poner aquí
	}
	public function paso1()
	{
		if(verificar_sesion()){
			redirect(base_url('pago_paso_2'));
		}else{
			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_1',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
		}
	}

	public function paso2()
	{
		if(verificar_sesion()){
			$this->data['direcciones'] = $this->DireccionesModel->lista_direcciones($_SESSION['usuario']['id']);
			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_2',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);

		}else{
			redirect(base_url('pago_paso_1'));
		}
	}
	public function paso3()
	{
		if(verificar_sesion()){
			$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
			$this->data['detalles_direccion'] = $this->DireccionesModel->detalles($this->input->post('IdDireccion'));
			$this->data['direccion'] = $this->DireccionesModel->direccion_formateada($this->input->post('IdDireccion'));
			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_3',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);

		}else{
			redirect(base_url('pago_paso_1'));
		}
	}
	public function paso4()
	{
		unset($_SESSION['carrito']['productos']);
		$_SESSION['carrito']['productos']=array();
		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_pago',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/proceso_pago_4',$this->data);
		$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}
}
