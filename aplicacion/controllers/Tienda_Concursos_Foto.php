<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Concursos_Foto extends CI_Controller {

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
		$this->load->model('PlanesModel');
		$this->load->model('DivisasModel');
		$this->load->model('CarruselesModel');
		$this->load->model('ConcursosFotoModel');
  }

	public function index()
	{
		$this->data['concurso_activo'] = $this->ConcursosFotoModel->activo();

		if(!empty($this->data['concurso_activo'])){
			// Metadatos de Producto
			$this->data['titulo'] = $this->data['concurso_activo']['TITULO'];
			$this->data['descripcion'] = $this->data['concurso_activo']['DESCRIPCION'];
			$this->data['keywords'] = '';
			$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

			if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){

				$this->data['entradas_concurso'] = $this->ConcursosFotoModel->entradas($this->data['concurso_activo']['ID']);
				$mi_entrada = $this->ConcursosFotoModel->mi_entrada($this->data['concurso_activo']['ID'],$_SESSION['usuario']['id'],'','');

				if(!empty($mi_entrada)){
					$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
					$this->load->view($this->data['dispositivo'].'/tienda/entradas_concurso_foto_activo',$this->data);
					$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
				}else{
					$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
					$this->load->view($this->data['dispositivo'].'/tienda/concurso_foto_activo',$this->data);
					$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
				}
			}else{
				$this->session->set_flashdata('alerta', 'No se pudo subir la foto');
				redirect(base_url('login?url_redirect='.base_url('concursos_foto')));
			}

		}else{
			$this->data['titulo'] = 'No hay concursos por el momento';
			$this->data['descripcion'] = 'Pronto tendremos mas actividades para tí';
			$this->data['keywords'] = '';
			$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

			$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/concurso_foto_inactivo',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
		}
	}
	public function subir()
	{
		if(!empty($_FILES['Entrada']['name'])){

			$archivo = $_FILES['Entrada']['tmp_name'];
			$ancho = $this->data['op']['ancho_imagenes_publicaciones'];
			$alto = $this->data['op']['alto_imagenes_publicaciones'];
			$calidad = 80;
			$nombre = 'concurso-'.uniqid();
			$destino = $this->data['op']['ruta_imagenes_publicaciones'];
			// Subo la imagen y obtengo el nombre Default si va vacía
			$imagen = subir_imagen_abanico($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			$parametros = array(
				'ID_CONCURSO' => $this->input->post('IdConcurso'),
				'ID_USUARIO' => $this->input->post('IdUsuario'),
				'DESCRIPCION' => $this->input->post('Descripcion'),
				'ARCHIVO' => $imagen,
				'FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'VALIDO'=>'si',
				'GANADOR'=>'no'
			);
			 $this->ConcursosFotoModel->crear_entrada($parametros);
			 $this->session->set_flashdata('exito', 'Gracias por compartir tu foto');
 			redirect(base_url('concursos_foto'));
		}else{
			$this->session->set_flashdata('alerta', 'Concurso creado correctamente');
			redirect(base_url('concursos_foto'));
		}
	}
}
