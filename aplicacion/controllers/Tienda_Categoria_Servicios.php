<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Categoria_Servicios extends CI_Controller {
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
		$this->load->model('CategoriasServiciosModel');
		$this->load->model('CalificacionesServiciosModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('TraduccionesModel');
		$this->load->model('PublicacionesModel');
		$this->load->model('PlanesModel');

		// Variables comunes
  }


	 public function index()
 	{

		$parametros_or = array();
	 $parametros_and = array();

	 if(!empty($_GET['Busqueda'])){
			 $parametros_or['SERVICIO_NOMBRE'] = $_GET['Busqueda'];
		 }
			 // Orden
			 if(isset($_GET['OrdenBusqueda'])&&!empty($_GET['OrdenBusqueda'])){
				 switch ($_GET['OrdenBusqueda']) {
					case 'alfabetico_desc':
						$orden = 'SERVICIO_NOMBRE DESC';
						break;
					case 'alfabetico_asc':
						$orden = 'SERVICIO_NOMBRE ASC';
						break;
					case 'calificacion_desc':
						$orden = 'CALIFICACION DESC';
						break;
					default:
						$orden = 'SERVICIO_NOMBRE ASC';
						break;
				 }
			 }else{
				 $orden = '';
			 }

			 if(isset($_GET['TipoServicio'])&&!empty($_GET['TipoServicio'])){
				switch ($_GET['TipoServicio']) {
				 case 'cualquiera':
				 // NO hago nada
					 break;
				 case 'profesional':
					 $parametros_and['SERVICIO_TIPO'] = 'profesional';
					 break;
				 case 'digital':
					 $parametros_and['SERVICIO_TIPO'] = 'digital';
					 break;
				 default:
					 // NO hago nada
					 break;
				}
			}

			if(isset($_GET['PaisDireccion'])&&!empty($_GET['PaisDireccion'])){
				$parametros_and['SERVICIO_PAIS'] = $_GET['PaisDireccion'];
			}
			if(isset($_GET['EstadoDireccion'])&&!empty($_GET['EstadoDireccion'])&&$_GET['EstadoDireccion']!='-'){
				$parametros_and['SERVICIO_ESTADO_DIR'] = $_GET['EstadoDireccion'];
			}
			if(isset($_GET['MunicipioDireccion'])&&!empty($_GET['MunicipioDireccion'])&&$_GET['MunicipioDireccion']!='-'){
				$parametros_and['SERVICIO_MUNICIPIO'] = $_GET['MunicipioDireccion'];
			}

			$this->data['parametros_or'] = $parametros_or;
		  $this->data['parametros_and'] = $parametros_and;
		   $this->data['orden'] = $orden;


		if(isset($_GET['slug'])&&!empty($_GET['slug'])){
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
			$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');
			$this->data['categoria'] = $this->CategoriasModel->detalles_slug($_GET['slug']);
			$this->data['servicios'] = $this->ServiciosModel->lista_categoria_activos($parametros_or,$parametros_and,$this->data['categoria']['ID_CATEGORIA'],$orden,'');
			$this->data['primary'] = $this->data['categoria']['CATEGORIA_COLOR'];
			$this->data['origen_formulario'] = 'categoria/servicios';
	 		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/categoria_servicios',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
		}else{
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
			$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');
			echo $orden;
			$this->data['servicios'] = $this->ServiciosModel->lista_activos($parametros_or,$parametros_and,'',$orden,'');
			$this->data['origen_formulario'] = 'categoria/servicios';
	 		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/categoria_servicios',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
		}

 	}

}
