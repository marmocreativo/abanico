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
		$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
		$this->data['productos'] = $this->ProductosModel->lista_activos('','','','',10);
		/*
		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/test',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
		*/
		$this->data['pedido'] = $this->PedidosModel->detalles(25);
		$this->data['productos'] = $this->PedidosProductosModel->lista(['ID_PEDIDO'=>$this->data['pedido']['ID_PEDIDO']],'','');
		$this->load->view('emails/pedido_usuario',$this->data);
	}


	public function categorias_todas()
	{
		$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$_GET['tipo'],'','');
		$this->data['productos'] = $this->ProductosModel->lista_activos('','','','',10);

		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/test_todasCategorias',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

	}
}
