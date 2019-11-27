<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Concursos_Foto extends CI_Controller {

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
		$this->load->model('ConcursosFotoModel');
		$this->load->model('UsuariosModel');
		$this->load->model('EstadisticasModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('ProductosModel');

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
			$this->data['concursos'] = $this->ConcursosFotoModel->lista('','','','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_concurso_foto',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function entradas()
	{
			$this->data['concurso'] = $this->ConcursosFotoModel->detalles($_GET['id']);
				$this->data['entradas_concurso'] = $this->ConcursosFotoModel->entradas($this->data['concurso']['ID']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/entradas_concurso_fotos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function crear()
	{
		$this->form_validation->set_rules('Titulo', 'Titulo del concurso requerido', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{


			// Parametros de la dirección
			$parametros = array(
				'TITULO' => $this->input->post('Titulo'),
				'DESCRIPCION' => $this->input->post('Descripcion'),
				'CANTIDAD_GANADORES' => $this->input->post('CantidadGanadores'),
				'FECHA_INICIO' => $this->input->post('FechaInicio'),
				'FECHA_FIN' => $this->input->post('FechaFin'),
			);

			$concurso_id = $this->ConcursosFotoModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Concurso creado correctamente');
      redirect(base_url('admin/concursos_foto'));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_concurso_foto',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('Titulo', 'Titulo del concurso requerido', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{
			$parametros = array(
				'TITULO' => $this->input->post('Titulo'),
				'DESCRIPCION' => $this->input->post('Descripcion'),
				'CANTIDAD_GANADORES' => $this->input->post('CantidadGanadores'),
				'FECHA_INICIO' => $this->input->post('FechaInicio'),
				'FECHA_FIN' => $this->input->post('FechaFin'),
			);

			$this->ConcursosFotoModel->actualizar( $this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Concurso actualizado');
      redirect(base_url('admin/concursos_foto'));
    }else{

			$this->data['concurso'] = $this->ConcursosFotoModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_concurso_foto',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function validar()
	{
		$this->ConcursosFotoModel->validar($_GET['id'],$_GET['id_concurso'],$_GET['valido']);
		redirect(base_url('admin/concursos_foto/entradas?id='.$_GET['id_concurso']));
	}

	public function borrar()
	{
		$concurso = $this->ConcursosModel->detalles($_GET['id']);
		// check if the institucione exists before trying to delete it
		if(isset($concurso['ID']))
		{
			$this->ConcursosModel->borrar( $_GET['id']);

				$this->session->set_flashdata('exito', 'Concurso eliminado');
		    redirect(base_url('admin/concursos'));
		} else {

		   	show_error('La entrada que deseas borrar no existe');
		}
	}
}
