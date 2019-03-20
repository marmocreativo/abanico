<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Busqueda extends CI_Controller {
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
		$this->load->model('PublicacionesModel');

		// Variables comunes
  }


	public function index()
 {
	 $parametros_or = array();
	 $parametros_and = array();
	 if(isset($_GET['BuscarEn'])){
		 $buscar_en = $_GET['BuscarEn'];
	 }else{
		 $buscar_en = '';
	 }
	 switch ($buscar_en) {
	 	case 'productos':
		case '':
		// Código de Busqueda
		if(!empty($_GET['Busqueda'])){
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
				 }
				 // Condición
		 		if(isset($_GET['CondicionBusqueda'])&&!empty($_GET['CondicionBusqueda'])){
		 			switch ($_GET['CondicionBusqueda']) {
		 			 case 'cualquiera':
		 			 // NO hago nada
		 				 break;
		 			 case 'nuevo':
		 				 $parametros_and['PRODUCTO_CONDICION'] = 'nuevo';
		 				 break;
		 			 case 'usado':
		 				 $parametros_and['PRODUCTO_CONDICION'] = 'usado';
		 				 break;
		 			 default:
		 				 // NO hago nada
		 				 break;
		 			}
		 		}
				// OfertaBusqueda
			 if(isset($_GET['OfertaBusqueda'])){
				 $parametros_and['PRODUCTO_PRECIO_LISTA >'] = 0;
			 }
			 // Artesanales
		  if(isset($_GET['ArtesanalBusqueda'])){
		 	 $parametros_and['PRODUCTO_ARTESANAL'] = 'si';
		  }

			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
			$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');
			$this->data['productos'] = $this->ProductosModel->busqueda($parametros_or,$parametros_and,$orden,'');
			$this->data['origen_formulario'] = 'busqueda';
			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/categoria_productos',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

	 		break;

			case 'servicios':
			// Código de Busqueda
				 $parametros_or = array(
					 'SERVICIO_NOMBRE'=>$_GET['Busqueda'],
				 );
				 $parametros_or['SERVICIO_NOMBRE'] = $_GET['Busqueda'];
				 // Orden
				 if(isset($_GET['OrdenBusqueda'])&&!empty($_GET['OrdenBusqueda'])){
					 switch ($_GET['OrdenBusqueda']) {
						case 'alfabetico_desc':
					 		$orden = 'SERVICIO_NOMBRE DESC';
					 		break;
						case 'alfabetico_asc':
					 		$orden = 'SERVICIO_NOMBRE ASC';
					 		break;
					 	default:
					 		$orden = 'SERVICIO_NOMBRE ASC';
					 		break;
					 }
				 }else{
					 $orden = '';
				 }
				 $this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
	 			$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');
				 $this->data['servicios'] = $this->ServiciosModel->busqueda($parametros_or,$parametros_and,$orden,'');
				 $this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
				 $this->load->view($this->data['dispositivo'].'/tienda/categoria_servicios',$this->data);
				 $this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

		 	break;
	 }

 }
}
