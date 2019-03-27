<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Publicaciones extends CI_Controller {

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
		$this->load->model('PublicacionesModel');
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
		if(!isset($_GET['tipo_publicacion'])||empty($_GET['tipo_publicacion'])){ $this->data['tipo_publicacion']='pagina'; }else{ $this->data['tipo_publicacion']=$_GET['tipo_publicacion']; }

			$this->data['publicaciones'] = $this->PublicacionesModel->lista(['PUBLICACION_TIPO'=>$this->data['tipo_publicacion']],'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_publicaciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'PUBLICACION_NOMBRE'=>$_GET['Busqueda'],
				'PUBLICACION_RAZON_SOCIAL'=>$_GET['Busqueda'],
				'PUBLICACION_RFC'=>$_GET['Busqueda']
			);
			$this->data['publicaciones'] = $this->PublicacionesModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_publicaciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/publicaciones'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('TituloPublicacion', 'Titulo', 'required', array('required' => 'Debes escribir el %s.'));

		if($this->form_validation->run())
		{
			// URI
			// Quito los acentos
			$titulo = convert_accented_characters($this->input->post('TituloPublicacion'));
			$url = url_title($titulo,'-',TRUE);
			if($this->PublicacionesModel->verificar_uri($url)){
				$url = url_title($titulo,'-',TRUE).'-'.uniq_slug(3);
				if($this->PublicacionesModel->verificar_uri($url)){
					$url = url_title($titulo,'-',TRUE).'-'.uniq_slug(3);
				}
			}

			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenPublicacion']['name'])){

				$archivo = $_FILES['ImagenPublicacion']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_publicaciones'];
				$alto = $this->data['op']['alto_imagenes_publicaciones'];
				$calidad = 80;
				$nombre = 'publicacion-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_publicaciones'];
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = 'default.jpg';
			}

			// Parametros de la dirección
			$parametros = array(
				'PUBLICACION_TITULO' => $this->input->post('TituloPublicacion'),
				'PUBLICACION_URL' => $url,
				'PUBLICACION_RESUMEN' => $this->input->post('ResumenPublicacion'),
				'PUBLICACION_CONTENIDO' => $this->input->post('ContenidoPublicacion'),
				'PUBLICACION_IMAGEN' => $imagen,
				'PUBLICACION_TIPO' => $this->input->post('TipoPublicacion'),
				'PUBLICACION_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'PUBLICACION_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'PUBLICACION_FECHA_PUBLICACION' => date('Y-m-d H:i:s'),
				'PUBLICACION_ESTADO' => $this->input->post('EstadoPublicacion')
			);
			//var_dump($parametros);
			$publicacion_id = $this->PublicacionesModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Publicación creada correctamente');
      redirect(base_url('admin/publicaciones?tipo_publicacion=').$this->input->post('TipoPublicacion'));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_publicacion',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('TituloPublicacion', 'Titulo', 'required', array('required' => 'Debes escribir el %s.'));

		if($this->form_validation->run())
		{
			// URI
			// Quito los acentos
			$titulo = convert_accented_characters($this->input->post('TituloPublicacion'));
			$url = url_title($titulo,'-',TRUE);
			if($this->PublicacionesModel->verificar_uri($url)){
				$url = url_title($titulo,'-',TRUE).'-'.uniq_slug(3);
				if($this->PublicacionesModel->verificar_uri($url)){
					$url = url_title($titulo,'-',TRUE).'-'.uniq_slug(3);
				}
			}
			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenPublicacion']['name'])){

				$archivo = $_FILES['ImagenPublicacion']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_publicaciones'];
				$alto = $this->data['op']['alto_imagenes_publicaciones'];
				$calidad = 80;
				$nombre = 'publicacion-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_publicaciones'];
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = $this->input->post('ImagenPublicacionAnterior');
			}

			// Parametros de la dirección
			$parametros = array(
				'PUBLICACION_TITULO' => $this->input->post('TituloPublicacion'),
				'PUBLICACION_URL' => $url,
				'PUBLICACION_RESUMEN' => $this->input->post('ResumenPublicacion'),
				'PUBLICACION_CONTENIDO' => $this->input->post('ContenidoPublicacion'),
				'PUBLICACION_IMAGEN' => $imagen,
				'PUBLICACION_TIPO' => $this->input->post('TipoPublicacion'),
				'PUBLICACION_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'PUBLICACION_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'PUBLICACION_FECHA_PUBLICACION' => date('Y-m-d H:i:s'),
				'PUBLICACION_ESTADO' => $this->input->post('EstadoPublicacion')
			);

			$publicacion_id = $this->PublicacionesModel->actualizar( $this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Publicación actualizada');
      redirect(base_url('admin/publicaciones?tipo_publicacion=').$this->input->post('TipoPublicacion'));
    }else{

			$this->data['publicacion'] = $this->PublicacionesModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_publicacion',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function activar()
	{
		$this->PublicacionesModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/publicaciones?tipo_publicacion='.$_GET['tipo_publicacion']));
	}

	public function borrar()
	{
		$publicacion = $this->PublicacionesModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($publicacion['ID_PUBLICACION']))
        {
            $this->PublicacionesModel->borrar($_GET['id']);
						$this->session->set_flashdata('exito', 'Publicación eliminada');
            redirect(base_url('admin/publicaciones?tipo_publicacion='.$publicacion['PUBLICACION_TIPO']));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
}
