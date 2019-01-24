<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Busqueda extends CI_Controller {
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
	 switch ($_GET['BuscarEn']) {
	 	case 'productos':
		case '':
		// Código de Busqueda
				 $parametros_or['PRODUCTO_NOMBRE'] = $_GET['Busqueda'];
				 $parametros_or['PRODUCTO_MODELO'] = $_GET['Busqueda'];
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
						case 'fecha_desc':
					 		$orden = 'PRODUCTO_FECHA_PUBLICACION DESC';
					 		break;
						case 'fecha_asc':
					 		$orden = 'PRODUCTO_FECHA_PUBLICACION ASC';
					 		break;
					 	default:
					 		$orden = 'PRODUCTO_NOMBRE ASC';
					 		break;
					 }
				 }else{
					 $orden = '';
				 }
				 // OrigenBusqueda
				 if(isset($_GET['OrigenBusqueda'])){
					 $parametros_and['PRODUCTO_ORIGEN'] = 'México';
				 }
				 // TiempoBusqueda
				//if(isset($_GET['TiempoBusqueda'])){
				//	$parametros_or['PRODUCTO_FECHA_PUBLICACION >='] = strtotime('-'.$op['dias_productos_nuevos'].' Days');
				//}
				// OfertaBusqueda
			 if(isset($_GET['OfertaBusqueda'])){
				 $parametros_and['PRODUCTO_PRECIO_LISTA !='] = '0.00';
			 }


			 	$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
 				$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');
				 $this->data['productos'] = $this->ProductosModel->busqueda($parametros_or,$parametros_and,$orden,'');
				 $this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
				 $this->load->view($this->data['dispositivo'].'/tienda/categoria_productos',$this->data);
				 $this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

	 		break;

			case 'servicios':
			// Código de Busqueda
				if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
				 $parametros_or = array(
					 'SERVICIO_NOMBRE'=>$_GET['Busqueda'],
				 );
				 $parametros_or['PRODUCTO_NOMBRE'] = $_GET['Busqueda'];
				 $parametros_or['PRODUCTO_MODELO'] = $_GET['Busqueda'];
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
						case 'fecha_desc':
					 		$orden = 'PRODUCTO_FECHA_PUBLICACION DESC';
					 		break;
						case 'fecha_asc':
					 		$orden = 'PRODUCTO_FECHA_PUBLICACION ASC';
					 		break;
					 	default:
					 		$orden = 'PRODUCTO_NOMBRE ASC';
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

			 }
		 	break;
	 }

 }
}
