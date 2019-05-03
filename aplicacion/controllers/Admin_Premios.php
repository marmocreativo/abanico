<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Premios extends CI_Controller {

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
		$this->load->model('PremiosModel');
		$this->load->model('UsuariosModel');
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

			$this->data['premios'] = $this->PremiosModel->lista('','','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_premios',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function crear()
	{
		$this->form_validation->set_rules('FechaDisponiblePremio', 'Fecha', 'required', array('required' => 'Debes escribir el %s.'));

		if($this->form_validation->run())
		{

			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenPremio']['name'])){

				$archivo = $_FILES['ImagenPremio']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_producto'];
				$alto = $this->data['op']['alto_imagenes_producto'];
				$calidad = 80;
				$nombre = 'premio-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_publicaciones'];
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = 'default.jpg';
			}

			// Parametros de la dirección
			$parametros = array(
				'PREMIO_TITULO' => $this->input->post('TituloPremio'),
				'PREMIO_IMAGEN' => $imagen,
				'PREMIO_FECHA_DISPONIBLE' => date('Y-m-d',strtotime($this->input->post('FechaDisponiblePremio'))),
				'PREMIO_ESTADO' => $this->input->post('EstadoPremio')
			);
			$direccion_id = $this->PremiosModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Publicación creada correctamente');
      redirect(base_url('admin/premios?tipo_premio=').$this->input->post('TipoPublicacion'));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_premio',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('FechaDisponiblePremio', 'Fecha', 'required', array('required' => 'Debes escribir el %s.'));

		if($this->form_validation->run())
		{

			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenPremio']['name'])){

				$archivo = $_FILES['ImagenPremio']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_producto'];
				$alto = $this->data['op']['alto_imagenes_producto'];
				$calidad = 80;
				$nombre = 'premio-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_publicaciones'];
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = $this->input->post('ImagenPremioAnterior');
			}
			// Parametros de la dirección
			$parametros = array(
				'PREMIO_TITULO' => $this->input->post('TituloPremio'),
				'PREMIO_IMAGEN' => $imagen,
				'PREMIO_FECHA_DISPONIBLE' => date('Y-m-d',strtotime($this->input->post('FechaDisponiblePremio'))),
				'PREMIO_ESTADO' => $this->input->post('EstadoPremio')
			);
			$usuario_id = $this->PremiosModel->actualizar( $this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Premio actualizad');
      redirect(base_url('admin/premios'));
    }else{

			$this->data['premio'] = $this->PremiosModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_premio',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function activar()
	{
		$this->PremiosModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/premios'));
	}

	public function borrar()
	{
		$premio = $this->PremiosModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($premio['ID_PREMIO']))
        {
            $this->PremiosModel->borrar($_GET['id']);
						$this->session->set_flashdata('exito', 'Premio eliminado');
            redirect(base_url('admin/premios'));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
}
