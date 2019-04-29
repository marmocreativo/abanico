<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auto_hooks extends CI_Controller {

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

		// Cargo el modelo
		$this->load->model('UsuariosModel');
		$this->load->model('DireccionesModel');
		$this->load->model('TiendaModel');
		$this->load->model('TiendasModel');
		$this->load->model('TransportistasRangosModel');
		$this->load->model('ProductosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasProductoModel');
		$this->load->model('PedidosModel');
		$this->load->model('PedidosProductosModel');
		$this->load->model('PedidosTiendasModel');
		$this->load->model('AutenticacionModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('PublicacionesModel');
		$this->load->model('PlanesModel');
		$this->load->model('PagosPedidosModel');
		$this->load->model('DivisasModel');

		//var_dump($_SESSION['pedido']);
	}
	public function index()
	{
		echo 'Sistemas automáticos';
	}
}
