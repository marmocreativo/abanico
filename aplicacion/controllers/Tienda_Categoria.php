<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Categoria extends CI_Controller {
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

		$this->load->model('TiendaModel');
		$this->load->model('ProductosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasProductoModel');
		$this->load->model('CalificacionesModel');
		$this->load->model('ServiciosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('GaleriasServiciosModel');
		$this->load->model('CalificacionesServiciosModel');

		// Variables comunes
  }


	 public function index()
 	{
		if(isset($_GET['slug'])&&!empty($_GET['slug'])){
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
			$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');
			$this->data['categoria'] = $this->CategoriasModel->detalles_slug($_GET['slug']);
			$this->data['productos'] = $this->ProductosModel->lista_categoria_activos('',$this->data['categoria']['ID_CATEGORIA'],'','');
			$this->data['primary'] = $this->data['categoria']['CATEGORIA_COLOR'];
	 		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/categoria_productos',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
		}else{
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
			$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');
			$this->data['productos'] = $this->ProductosModel->lista_activos('','','','');
	 		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/categoria_productos',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
		}

 	}


	public function busqueda()
 {
	 if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
		 $parametros = array(
			 'PRODUCTO_NOMBRE'=>$_GET['Busqueda'],
			 'PRODUCTO_MODELO'=>$_GET['Busqueda']
		 );$this->data['productos'] = $this->ProductosModel->lista($parametros,'','','');
		 $this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
		 $this->load->view($this->data['dispositivo'].'/tienda/categoria_productos',$this->data);
		 $this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

	 }else{
		 redirect(base_url('categoria'));
	 }
 }
}
