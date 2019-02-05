<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Favoritos extends CI_Controller {
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
		$this->load->model('ServiciosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('FavoritosModel');
		$this->load->model('GaleriasModel');
		$this->load->model('GaleriasServiciosModel');
		$this->load->model('CalificacionesModel');
		$this->load->model('CalificacionesServiciosModel');
		$this->load->model('CategoriasProductoModel');

		// Variables comunes
  }


	 public function index()
 	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes Iniciar Sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
				// Productos Favoritos
				$productos_favoritos_raw = $this->FavoritosModel->favoritos_usuario($_SESSION['usuario']['id'],'producto');
				$productos_favoritos = array();
				foreach($productos_favoritos_raw as $favorito){
					$productos_favoritos[]=$favorito->ID_OBJETO;
				}

				if(empty($productos_favoritos)){
					$this->data['productos'] = array();
				}else{
					$this->data['productos'] = $this->ProductosModel->lista_favoritos_activos($productos_favoritos);
				}
				// Servicios Favoritos
				$servicios_favoritos_raw = $this->FavoritosModel->favoritos_usuario($_SESSION['usuario']['id'],'servicio');
				$servicios_favoritos = array();
				foreach($servicios_favoritos_raw as $favorito){
					$servicios_favoritos[]=$favorito->ID_OBJETO;
				}

				if(empty($servicios_favoritos)){
					$this->data['servicios'] = array();
				}else{
					$this->data['servicios'] = $this->ServiciosModel->lista_favoritos_activos($servicios_favoritos);
				}
				// Categorías
				$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
				$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');

		 		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
		 		$this->load->view($this->data['dispositivo'].'/tienda/favoritos_productos',$this->data);
		 		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

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
