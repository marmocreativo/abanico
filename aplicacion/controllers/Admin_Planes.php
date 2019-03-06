<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Planes extends CI_Controller {

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
		$this->load->model('PlanesModel');
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
			$this->data['planes'] = $this->PlanesModel->lista('','','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_planes',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'PLAN_ISO'=>$_GET['Busqueda'],
				'PLAN_NOMBRE'=>$_GET['Busqueda']
			);
			$this->data['planes'] = $this->PlanesModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_planes',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/planes'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('NombrePlan', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'PLAN_NOMBRE' => $this->input->post('NombrePlan'),
				'PLAN_DESCRIPCION' => $this->input->post('DescripcionPlan'),
				'PLAN_MENSUALIDAD' => $this->input->post('MensualidadPlan'),
				'PLAN_ALMACENAMIENTO' => $this->input->post('AlmacenamientoPlan'),
				'PLAN_COMISION' => $this->input->post('ComisionPlan'),
				'PLAN_MANEJO_PRODUCTOS' => $this->input->post('ManejoProductosPlan'),
				'PLAN_ENVIO' => $this->input->post('EnvioPlan'),
				'PLAN_SERVICIOS_FINANCIEROS' => $this->input->post('ServiciosFinancierosPlan'),
				'PLAN_SERVICIOS_FINANCIEROS_FIJO' => $this->input->post('ServiciosFinancierosFijoPlan'),
				'PLAN_TIPO' => $this->input->post('TipoPlan'),
				'PLAN_NIVEL' => $this->input->post('NivelPlan'),
				'PLAN_LIMITE_PRODUCTOS' => $this->input->post('LimiteProductosPlan'),
				'PLAN_LIMITE_SERVICIOS' => $this->input->post('LimiteServiciosPlan'),
				'PLAN_FOTOS_PRODUCTOS' => $this->input->post('FotosProductosPlan'),
				'PLAN_FOTOS_SERVICIOS' => $this->input->post('FotosProductosPlan'),
      );

      $plan_id = $this->PlanesModel->crear($parametros);

			$this->session->set_flashdata('exito', 'Plan creado correctamente');
      redirect(base_url('admin/planes'));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_plan',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('NombrePlan', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
			$parametros = array(
				'PLAN_NOMBRE' => $this->input->post('NombrePlan'),
				'PLAN_DESCRIPCION' => $this->input->post('DescripcionPlan'),
				'PLAN_MENSUALIDAD' => $this->input->post('MensualidadPlan'),
				'PLAN_ALMACENAMIENTO' => $this->input->post('AlmacenamientoPlan'),
				'PLAN_COMISION' => $this->input->post('ComisionPlan'),
				'PLAN_MANEJO_PRODUCTOS' => $this->input->post('ManejoProductosPlan'),
				'PLAN_ENVIO' => $this->input->post('EnvioPlan'),
				'PLAN_SERVICIOS_FINANCIEROS' => $this->input->post('ServiciosFinancierosPlan'),
				'PLAN_SERVICIOS_FINANCIEROS_FIJO' => $this->input->post('ServiciosFinancierosFijoPlan'),
				'PLAN_TIPO' => $this->input->post('TipoPlan'),
				'PLAN_NIVEL' => $this->input->post('NivelPlan'),
				'PLAN_LIMITE_PRODUCTOS' => $this->input->post('LimiteProductosPlan'),
				'PLAN_LIMITE_SERVICIOS' => $this->input->post('LimiteServiciosPlan'),
				'PLAN_FOTOS_PRODUCTOS' => $this->input->post('FotosProductosPlan'),
				'PLAN_FOTOS_SERVICIOS' => $this->input->post('FotosProductosPlan'),
      );

      $institucione_id = $this->PlanesModel->actualizar( $this->input->post('Identificador'),$parametros);
      redirect(base_url('admin/planes'));
    }else{

			$this->data['plan'] = $this->PlanesModel->detalles($_GET['id']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_plan',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$plan = $this->PlanesModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($plan['ID_PLAN']))
        {
            $this->PlanesModel->borrar($_GET['id']);
            redirect(base_url('admin/planes'));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		$this->PlanesModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/planes'));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
