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
		$parametros_or = array();
		$parametros_and = array();
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros_or['PRODUCTO_NOMBRE'] = $_GET['Busqueda'];
			$parametros_or['PRODUCTO_MODELO'] = $_GET['Busqueda'];
		}
		// Orden
		if(isset($_GET['OrdenBusqueda'])&&!empty($_GET['OrdenBusqueda'])){
			switch ($_GET['OrdenBusqueda']) {
			 case 'precio_desc':
				 $orden = 'PRODUCTO_PRECIO DESC';
				 break;
			 case 'precio_asc':
				 $orden = 'PRODUCTO_PRECIO ASC';
				 break;
			 case 'alfabetico_desc':
				 $orden = 'PRODUCTO_NOMBRE DESC';
				 break;
			 case 'alfabetico_asc':
				 $orden = 'PRODUCTO_NOMBRE ASC';
				 break;
			 default:
				 $orden = 'PRODUCTO_NOMBRE ASC';
				 break;
			}
		}else{
			$orden = '';
		}
		// Origen
		if(isset($_GET['OrigenBusqueda'])&&!empty($_GET['OrigenBusqueda'])){
			switch ($_GET['OrigenBusqueda']) {
			 case 'cualquiera':
			 // NO hago nada
				 break;
			 case 'nacionales':
				 $parametros_and['PRODUCTO_ORIGEN'] = 'México';
				 break;
			 case 'Importados':
				 $parametros_and['PRODUCTO_ORIGEN'] = 'Otro';
				 break;
			 default:
				 // NO hago nada
				 break;
			}
		}else{
			$orden = '';
		}
	 // OfertaBusqueda
	if(isset($_GET['OfertaBusqueda'])){
		$parametros_and['PRODUCTO_PRECIO_LISTA >'] = 0;
	}

		if(isset($_GET['slug'])&&!empty($_GET['slug'])){
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
			$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');
			$this->data['categoria'] = $this->CategoriasModel->detalles_slug($_GET['slug']);
			$this->data['origen_formulario'] = 'categoria';
			$this->data['productos'] = $this->ProductosModel->lista_categoria_activos($parametros_or,$parametros_and,$this->data['categoria']['ID_CATEGORIA'],$orden,'');
			$this->data['primary'] = $this->data['categoria']['CATEGORIA_COLOR'];
	 		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/categoria_productos',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
		}else{
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
			$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');
			$this->data['productos'] = $this->ProductosModel->lista_categoria_activos($parametros_or,$parametros_and,'','',$orden,'');
			$this->data['origen_formulario'] = '';
	 		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/categoria_productos',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
		}

 	}
}
