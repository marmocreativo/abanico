<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Carruseles extends CI_Controller {

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
		$this->load->model('CarruselesModel');
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

		$this->data['carruseles'] = $this->CarruselesModel->lista('','ORDEN ASC','');
		$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
		$this->load->view($this->data['dispositivo'].'/admin/lista_carruseles',$this->data);
		$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function crear()
	{
		$this->form_validation->set_rules('Titulo', 'Titulo', 'required', array('required' => 'Debes escribir el %s.'));

		if($this->form_validation->run())
		{

			// Parametros de la dirección
			$parametros = array(
				'TITULO' => $this->input->post('Titulo'),
				'DESCRIPCION' => $this->input->post('Descripcion'),
				'TIPO' => $this->input->post('Tipo'),
				'CATEGORIAS' => $this->input->post('Categorias'),
				'ORIGEN' => $this->input->post('Origen'),
				'ARTESANAL' => $this->input->post('Artesanal'),
				'ORDEN_PRODUCTOS' => $this->input->post('OrdenProductos'),
				'LIMITE' => $this->input->post('Limite'),
				'ENLACE' => $this->input->post('Enlace'),
				'ESTADO' => $this->input->post('Estado')
			);

			$this->CarruselesModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Carrusel creado correctamente');
      redirect(base_url('admin/carruseles'));
    }else{

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_carrusel',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
			$this->form_validation->set_rules('Titulo', 'Titulo', 'required', array('required' => 'Debes escribir el %s.'));

		if($this->form_validation->run())
		{


			// Parametros de la dirección
			$parametros = array(
				'TITULO' => $this->input->post('Titulo'),
				'DESCRIPCION' => $this->input->post('Descripcion'),
				'TIPO' => $this->input->post('Tipo'),
				'CATEGORIAS' => $this->input->post('Categorias'),
				'ORIGEN' => $this->input->post('Origen'),
				'ARTESANAL' => $this->input->post('Artesanal'),
				'ORDEN_PRODUCTOS' => $this->input->post('OrdenProductos'),
				'LIMITE' => $this->input->post('Limite'),
				'ENLACE' => $this->input->post('Enlace'),
				'ESTADO' => $this->input->post('Estado')
			);

			$this->CarruselesModel->actualizar( $this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Carrusel actualizado');
      redirect(base_url('admin/carruseles'));
    }else{

			$this->data['carrusel'] = $this->CarruselesModel->detalles($_GET['id']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_carrusel',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function activar()
	{
		$this->CarruselesModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/carruseles'));
	}

	public function borrar()
	{

	}
}
