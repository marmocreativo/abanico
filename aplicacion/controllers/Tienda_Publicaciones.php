<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Publicaciones extends CI_Controller {

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
		$this->load->model('NotificacionesModel');
		$this->load->model('TraduccionesModel');
		$this->load->model('SlidersModel');
		$this->load->model('SlidesModel');
		$this->load->model('PremiosModel');
		$this->load->model('UsuariosModel');
		$this->load->model('PedidosModel');
		$this->load->model('PublicacionesModel');
		$this->load->model('PublicacionesModel');
		$this->load->model('PlanesModel');
  }

	public function index()
	{
		$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'productos','','');
		$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'servicios','','');
		$this->data['publicacion'] = $this->PublicacionesModel->detalles_url($this->uri->segment(2));

		// Metadatos de Producto
		$this->data['titulo'] = $this->data['publicacion']['PUBLICACION_TITULO'].'| Abanico siempre lo mejor';
		if(!empty($this->data['publicacion']['META_TITULO'])){ $this->data['titulo'] = $this->data['publicacion']['META_TITULO'].'| Abanico siempre lo mejor'; }
		$this->data['descripcion'] = $this->data['publicacion']['PUBLICACION_RESUMEN'];
		if(!empty($this->data['publicacion']['META_DESCRIPCION'])){ $this->data['titulo'] = $this->data['publicacion']['META_DESCRIPCION'].'| Abanico siempre lo mejor'; }
		$this->data['keywords'] = $this->data['publicacion']['META_KEYWORDS'];
		$this->data['imagen'] = base_url('contenido/img/productos/completo/'.$this->data['publicacion']['PUBLICACION_IMAGEN']);

		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/publicacion',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
	}

}
