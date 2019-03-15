<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Slides extends CI_Controller {

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
		$this->load->model('SlidersModel');
		$this->load->model('SlidesModel');
		$this->load->model('LenguajesModel');
		$this->load->model('EstadisticasModel');
		$this->load->model('NotificacionesModel');

		// Verifico Sesión
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		// Verifico Permiso
		if(!verificar_permiso(['tec-5','adm-6'])){
			$this->session->set_flashdata('alerta', 'No tienes permiso de entrar en esa sección');
			redirect(base_url('usuario'));
		}
  }

	public function index()
	{

		$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');
		$this->data['slides'] = $this->SlidesModel->lista('','','');
		$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
		$this->load->view($this->data['dispositivo'].'/admin/lista_slides',$this->data);
		$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function crear()
	{
		$this->form_validation->set_rules('EnlaceSlide', 'Enlace', 'required', array('required' => 'Debes escribir el %s.'));

		if($this->form_validation->run())
		{
			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenSlide']['name'])){

				$archivo = $_FILES['ImagenSlide']['tmp_name'];
				$ancho = $this->input->post('AnchoSlider');
				$alto = $this->input->post('AltoSlider');
				$calidad = 80;
				$nombre = 'slide-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_slider'];
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = 'default.jpg';
			}
			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenSlideMovil']['name'])){

				$archivo = $_FILES['ImagenSlideMovil']['tmp_name'];
				$ancho = $this->input->post('AnchoMovilSlider');
				$alto = $this->input->post('AltoMovilSlider');
				$calidad = 80;
				$nombre = 'slide_movil_'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_slider'];
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen_movil = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen_movil = 'default.jpg';
			}

			// Parametros de la dirección
			$parametros = array(
				'ID_SLIDER' => $this->input->post('IdSlider'),
				'SLIDE_IMAGEN' => $imagen,
				'SLIDE_IMAGEN_MOVIL' => $imagen_movil,
				'SLIDE_TITULO' => $this->input->post('TituloSlide'),
				'SLIDE_SUBTITULO' => $this->input->post('SubtituloSlide'),
				'SLIDE_BOTON' => $this->input->post('BotonSlide'),
				'SLIDE_ENLACE' => $this->input->post('EnlaceSlide'),
				'SLIDE_ESTADO' => $this->input->post('EstadoSlide'),
			);

			$direccion_id = $this->SlidesModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Publicación creada correctamente');
      redirect(base_url('admin/slides?slider='.$this->input->post('IdSlider')));
    }else{

			$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');
			$this->data['slider'] = $this->SlidersModel->detalles($_GET['id_slider']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_slides',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
			$this->form_validation->set_rules('EnlaceSlide', 'Enlace', 'required', array('required' => 'Debes escribir el %s.'));

		if($this->form_validation->run())
		{
			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenSlide']['name'])){

				$archivo = $_FILES['ImagenSlide']['tmp_name'];
				$ancho = $this->input->post('AnchoSlider');
				$alto = $this->input->post('AltoSlider');
				$calidad = 80;
				$nombre = 'slide-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_slider'];
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = $this->input->post('ImagenSlideAnterior');
			}
			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenSlideMovil']['name'])){

				$archivo = $_FILES['ImagenSlideMovil']['tmp_name'];
				$ancho = $this->input->post('AnchoMovilSlider');
				$alto = $this->input->post('AltoMovilSlider');
				$calidad = 80;
				$nombre = 'slide_movil_'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_slider'];
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen_movil = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen_movil = $this->input->post('ImagenSlideMovilAnterior');
			}

			// Parametros de la dirección
			$parametros = array(
				'ID_SLIDER' => $this->input->post('IdSlider'),
				'SLIDE_IMAGEN' => $imagen,
				'SLIDE_IMAGEN_MOVIL' => $imagen_movil,
				'SLIDE_TITULO' => $this->input->post('TituloSlide'),
				'SLIDE_SUBTITULO' => $this->input->post('SubtituloSlide'),
				'SLIDE_BOTON' => $this->input->post('BotonSlide'),
				'SLIDE_ENLACE' => $this->input->post('EnlaceSlide'),
				'SLIDE_ESTADO' => $this->input->post('EstadoSlide'),
			);

			$usuario_id = $this->SlidesModel->actualizar( $this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Publicación actualizada');
      redirect(base_url('admin/slides?slider='.$this->input->post('IdSlider')));
    }else{

			$this->data['slide'] = $this->SlidesModel->detalles($_GET['id']);
			$this->data['slider'] = $this->SlidersModel->detalles($this->data['slide']['ID_SLIDER']);
			$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_slides',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function activar()
	{
		$this->SlidesModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/slides?slider='.$_GET['id_slider']));
	}

	public function borrar()
	{
		$slide = $this->SlidesModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($slide['ID_SLIDE']))
        {
            $this->SlidesModel->borrar($_GET['id']);
						$this->session->set_flashdata('exito', 'Publicación eliminada');
            redirect(base_url('admin/slides?slider='.$slide['ID_SLIDER']));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
}
