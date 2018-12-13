<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Divisas extends CI_Controller {

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
		$this->load->model('DivisasModel');
  }

	public function index()
	{
			$this->data['divisas'] = $this->DivisasModel->lista('','','');
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_divisas',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}
	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'DIVISA_ISO'=>$_GET['Busqueda'],
				'DIVISA_NOMBRE'=>$_GET['Busqueda']
			);
			$this->data['divisas'] = $this->DivisasModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_divisas',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/divisas'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('IsoDivisa', 'Código ISO', 'required|is_unique[divisas.DIVISA_ISO]', array( 'required' => 'Debes designar el %s.', 'is_unique' => 'Esta Moneda ya ha sido registrada' ));
		$this->form_validation->set_rules('NombreDivisa', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));
		$this->form_validation->set_rules('SignoDivisa', 'Signo', 'required', array( 'required' => 'Debes designar el %s.' ));
		$this->form_validation->set_rules('ConversionDivisa', 'Conversión', 'required', array( 'required' => 'Debes designar el valor de la %s.' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'DIVISA_ISO' => $this->input->post('IsoDivisa'),
				'DIVISA_NOMBRE' => $this->input->post('NombreDivisa'),
				'DIVISA_SIGNO' => $this->input->post('SignoDivisa'),
				'DIVISA_CONVERSION' => $this->input->post('ConversionDivisa'),
      );

			if(null !== $this->input->post('EstadoDivisa') && !empty($this->input->post('EstadoDivisa'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['DIVISA_ESTADO']= $estado;

      $divisa_id = $this->DivisasModel->crear($parametros);
      redirect(base_url('admin/divisas'));
    }else{
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_divisa',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('IsoDivisa', 'Código ISO', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('NombreDivisa', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));
		$this->form_validation->set_rules('SignoDivisa', 'Signo', 'required', array( 'required' => 'Debes designar el %s.' ));
		$this->form_validation->set_rules('ConversionDivisa', 'Conversión', 'required', array( 'required' => 'Debes designar el valor de la %s.' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'DIVISA_ISO' => $this->input->post('IsoDivisa'),
				'DIVISA_NOMBRE' => $this->input->post('NombreDivisa'),
				'DIVISA_SIGNO' => $this->input->post('SignoDivisa'),
				'DIVISA_CONVERSION' => $this->input->post('ConversionDivisa'),
      );

			if(null !== $this->input->post('EstadoDivisa') && !empty($this->input->post('EstadoDivisa'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['DIVISA_ESTADO']= $estado;

      $institucione_id = $this->DivisasModel->actualizar( $this->input->post('Identificador'),$parametros);
      redirect(base_url('admin/divisas'));
    }else{

			$this->data['divisa'] = $this->DivisasModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_divisa',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$divisa = $this->DivisasModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($divisa['ID_DIVISA']))
        {
            $this->DivisasModel->borrar($_GET['id']);
            redirect(base_url('admin/divisas'));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		$this->DivisasModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/divisas'));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
