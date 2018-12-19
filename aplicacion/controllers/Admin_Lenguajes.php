<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Lenguajes extends CI_Controller {

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
		$this->load->model('LenguajesModel');
  }

	public function index()
	{
			$this->data['lenguajes'] = $this->LenguajesModel->lista('','','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_lenguajes',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'LENGUAJE_ISO'=>$_GET['Busqueda'],
				'LENGUAJE_NOMBRE'=>$_GET['Busqueda']
			);
			$this->data['lenguajes'] = $this->LenguajesModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_lenguajes',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/lenguajes'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('IsoLenguaje', 'Código ISO', 'required|is_unique[lenguajes.LENGUAJE_ISO]', array( 'required' => 'Debes designar el %s.', 'is_unique' => 'Este lenguaje ya ha sido registrado' ));
		$this->form_validation->set_rules('NombreLenguaje', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'LENGUAJE_ISO' => $this->input->post('IsoLenguaje'),
				'LENGUAJE_NOMBRE' => $this->input->post('NombreLenguaje'),
      );

			if(null !== $this->input->post('EstadoLenguaje') && !empty($this->input->post('EstadoLenguaje'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['LENGUAJE_ESTADO']= $estado;

      $lenguaje_id = $this->LenguajesModel->crear($parametros);
      redirect(base_url('admin/lenguajes'));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_lenguaje',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('IsoLenguaje', 'Código ISO', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('NombreLenguaje', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'LENGUAJE_ISO' => $this->input->post('IsoLenguaje'),
				'LENGUAJE_NOMBRE' => $this->input->post('NombreLenguaje'),
      );

			if(null !== $this->input->post('EstadoLenguaje') && !empty($this->input->post('EstadoLenguaje'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['LENGUAJE_ESTADO']= $estado;

      $lenguaje_id = $this->LenguajesModel->actualizar( $this->input->post('Identificador'),$parametros);
      redirect(base_url('admin/lenguajes'));
    }else{

			$this->data['lenguaje'] = $this->LenguajesModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_lenguaje',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$lenguaje = $this->LenguajesModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($lenguaje['ID_LENGUAJE']))
        {
            $this->LenguajesModel->borrar($_GET['id']);
            redirect(base_url('admin/lenguajes'));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		$this->LenguajesModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/lenguajes'));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
