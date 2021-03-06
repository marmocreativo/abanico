<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Concursos extends CI_Controller {

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
		$this->load->model('ConcursosModel');
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
			$this->data['concursos'] = $this->ConcursosModel->lista('','','','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_concurso',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function crear()
	{
		$this->form_validation->set_rules('Frase', 'Frase del concurso requerida', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('Productos', 'Frase del concurso requerida', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{
			$frase = $this->input->post('Frase');
			$productos = $this->input->post('Productos');
			// Parametros de la dirección
			$parametros = array(
				'FRASE' => $frase,
				'PRODUCTOS' => $productos,
				'FECHA_INICIO' => $this->input->post('FechaInicio'),
				'FECHA_FIN' => $this->input->post('FechaFin'),
				'MOSTRAR_FRASE' => $this->input->post('MostrarFrase')
			);

			$concurso_id = $this->ConcursosModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Concurso creado correctamente');
      redirect(base_url('admin/concursos'));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_concurso',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('Frase', 'Frase del concurso requerida', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('Productos', 'Frase del concurso requerida', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{
			$frase = $this->input->post('Frase');
			$productos = $this->input->post('Productos');
			// Parametros de la dirección
			$parametros = array(
				'FRASE' => $frase,
				'PRODUCTOS' => $productos,
				'FECHA_INICIO' => $this->input->post('FechaInicio'),
				'FECHA_FIN' => $this->input->post('FechaFin'),
				'MOSTRAR_FRASE' => $this->input->post('MostrarFrase')
			);

			$this->ConcursosModel->actualizar( $this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Concurso actualizado');
      redirect(base_url('admin/direcciones?id_usuario='.$this->input->post('IdUsuario')));
    }else{

			$this->data['concurso'] = $this->ConcursosModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_concurso',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
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
