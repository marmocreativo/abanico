<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Cupones extends CI_Controller {

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
		$this->load->model('CuponesModel');
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
			$this->data['cupones'] = $this->CuponesModel->lista('','','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_cupones',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function crear()
	{
		$this->form_validation->set_rules('Codigo', 'Codigo requerido', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{


			// Parametros de la dirección
			$parametros = array(
				'CODIGO' => $this->input->post('Codigo'),
				'PRODUCTOS' => $this->input->post('Productos'),
				'IMPORTE_MINIMO' => $this->input->post('ImporteMinimo'),
				'DESCUENTO' => $this->input->post('Descuento'),
				'TIPO_DESCUENTO' => $this->input->post('TipoDescuento'),
				'FECHA_INICIO' => $this->input->post('FechaInicio'),
				'FECHA_FINAL' => $this->input->post('FechaFinal'),
				'LIMITE_POR_USUARIO' => $this->input->post('LimitePorUsuario'),
			);

			$concurso_id = $this->CuponesModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Cupon creado correctamente');
      redirect(base_url('admin/cupones'));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_cupon',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('Codigo', 'Codigo requerido', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{
			// Parametros de la dirección
			$parametros = array(
				'CODIGO' => $this->input->post('Codigo'),
				'PRODUCTOS' => $this->input->post('Productos'),
				'IMPORTE_MINIMO' => $this->input->post('ImporteMinimo'),
				'DESCUENTO' => $this->input->post('Descuento'),
				'TIPO_DESCUENTO' => $this->input->post('TipoDescuento'),
				'FECHA_INICIO' => $this->input->post('FechaInicio'),
				'FECHA_FINAL' => $this->input->post('FechaFinal'),
				'LIMITE_POR_USUARIO' => $this->input->post('LimitePorUsuario'),
			);

			$this->CuponesModel->actualizar( $this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Concurso actualizado');
      redirect(base_url('admin/cupones'));
    }else{

			$this->data['cupon'] = $this->CuponesModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_cupon',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$concurso = $this->CuponesModel->detalles($_GET['id']);
		// check if the institucione exists before trying to delete it
		if(isset($concurso['ID']))
		{
			$this->CuponesModel->borrar( $_GET['id']);

				$this->session->set_flashdata('exito', 'Cupon eliminado');
		    redirect(base_url('admin/cupones'));
		} else {

		   	show_error('La entrada que deseas borrar no existe');
		}
	}
}
