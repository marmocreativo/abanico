<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Paises extends CI_Controller {

	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();

		// Variables defaults
		$this->data['primary'] = "-primary";

		if($this->agent->is_mobile()){
			$this->data['dispositivo'] = "mobile";
		}else{
			$this->data['dispositivo']  = "desktop";
		}

		// Cargo el modelo
		$this->load->model('PaisesModel');

		// Verifico Sesión
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes Iniciar Sesión para continuar');
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
			$this->data['paises'] = $this->PaisesModel->lista('','','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_paises',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'PAIS_ISO'=>$_GET['Busqueda'],
				'PAIS_NOMBRE'=>$_GET['Busqueda']
			);
			$this->data['paises'] = $this->PaisesModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_paises',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/paises'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('IsoPais', 'Código ISO', 'required|is_unique[paises.PAIS_ISO]', array( 'required' => 'Debes designar el %s.', 'is_unique' => 'Este país ya ha sido registrado' ));
		$this->form_validation->set_rules('NombrePais', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'PAIS_ISO' => $this->input->post('IsoPais'),
				'PAIS_NOMBRE' => $this->input->post('NombrePais'),
      );

			if(null !== $this->input->post('EstadoPais') && !empty($this->input->post('EstadoPais'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['PAIS_ESTADO']= $estado;

      $pais_id = $this->PaisesModel->crear($parametros);
      redirect(base_url('admin/paises'));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_pais',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('IsoPais', 'Código ISO', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('NombrePais', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'PAIS_ISO' => $this->input->post('IsoPais'),
				'PAIS_NOMBRE' => $this->input->post('NombrePais'),
      );

			if(null !== $this->input->post('EstadoPais') && !empty($this->input->post('EstadoPais'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['PAIS_ESTADO']= $estado;

      $pais_id = $this->PaisesModel->actualizar( $this->input->post('Identificador'),$parametros);
      redirect(base_url('admin/paises'));
    }else{

			$this->data['pais'] = $this->PaisesModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_pais',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$pais = $this->PaisesModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($pais['ID_PAIS']))
        {
            $this->PaisesModel->borrar($_GET['id']);
            redirect(base_url('admin/paises'));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		$this->PaisesModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/paises'));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
