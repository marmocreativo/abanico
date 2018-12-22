<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Direcciones extends CI_Controller {
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
			$this->load->model('UsuariosModel');
			$this->load->model('DireccionesModel');
  }

	public function index()
	{
		if(verificar_sesion()){
			$this->data['direcciones'] = $this->DireccionesModel->lista_direcciones($_SESSION['usuario']['id']);
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/lista_direcciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}else{
			redirect(base_url('login'));
		}
	}
	public function crear()
	{
		if(verificar_sesion()){
			$this->form_validation->set_rules('CalleDireccion', 'Calle y Número', 'required', array('required' => 'Debes escribir tu %s.'));
			$this->form_validation->set_rules('PaisDireccion', 'País', 'required', array('required' => 'Debes elegir tu %s.'));
			$this->form_validation->set_rules('EstadoDireccion', 'Estado', 'required', array('required' => 'Debes elegir tu %s.'));
			$this->form_validation->set_rules('MunicipioDireccion', 'Municipio', 'required', array('required' => 'Debes elegir tu %s.'));
			$this->form_validation->set_rules('CodigoPostalDireccion', 'Código Postal', 'required', array('required' => 'Debes escribir tu %s.'));

			if($this->form_validation->run())
			{
				// Parametros de la dirección
				$parametros = array(
					'ID_USUARIO' => $this->input->post('IdUsuario'),
					'DIRECCION_TIPO' => $this->input->post('TipoDireccion'),
					'DIRECCION_ALIAS' => $this->input->post('AliasDireccion'),
					'DIRECCION_PAIS' => $this->input->post('PaisDireccion'),
					'DIRECCION_ESTADO' => $this->input->post('EstadoDireccion'),
					'DIRECCION_CIUDAD' => $this->input->post('CiudadDireccion'),
					'DIRECCION_MUNICIPIO' => $this->input->post('MunicipioDireccion'),
					'DIRECCION_BARRIO' => $this->input->post('BarrioDireccion'),
					'DIRECCION_CALLE_Y_NUMERO' => $this->input->post('CalleDireccion'),
					'DIRECCION_CODIGO_POSTAL' => $this->input->post('CodigoPostalDireccion'),
					'DIRECCION_REFERENCIAS' => $this->input->post('ReferenciasDireccion'),
					'DIRECCION_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
					'DIRECCION_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
				);

				$usuario_id = $this->DireccionesModel->crear($parametros);
				redirect(base_url('usuario/direcciones'));
			}else{
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/form_direccion',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
			}
		}else{
			redirect(base_url('login'));
		}
	}


	public function actualizar()
	{
		if(verificar_sesion()){
			$this->form_validation->set_rules('CalleDireccion', 'Calle y Número', 'required', array('required' => 'Debes escribir tu %s.'));
			$this->form_validation->set_rules('PaisDireccion', 'País', 'required', array('required' => 'Debes elegir tu %s.'));
			$this->form_validation->set_rules('EstadoDireccion', 'Estado', 'required', array('required' => 'Debes elegir tu %s.'));
			$this->form_validation->set_rules('MunicipioDireccion', 'Municipio', 'required', array('required' => 'Debes elegir tu %s.'));
			$this->form_validation->set_rules('CodigoPostalDireccion', 'Código Postal', 'required', array('required' => 'Debes escribir tu %s.'));

			if($this->form_validation->run())
			{
				// Parametros de la dirección
				$parametros = array(
					'ID_USUARIO' => $this->input->post('IdUsuario'),
					'DIRECCION_TIPO' => $this->input->post('TipoDireccion'),
					'DIRECCION_ALIAS' => $this->input->post('AliasDireccion'),
					'DIRECCION_PAIS' => $this->input->post('PaisDireccion'),
					'DIRECCION_ESTADO' => $this->input->post('EstadoDireccion'),
					'DIRECCION_CIUDAD' => $this->input->post('CiudadDireccion'),
					'DIRECCION_MUNICIPIO' => $this->input->post('MunicipioDireccion'),
					'DIRECCION_BARRIO' => $this->input->post('BarrioDireccion'),
					'DIRECCION_CALLE_Y_NUMERO' => $this->input->post('CalleDireccion'),
					'DIRECCION_CODIGO_POSTAL' => $this->input->post('CodigoPostalDireccion'),
					'DIRECCION_REFERENCIAS' => $this->input->post('ReferenciasDireccion'),
					'DIRECCION_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
				);

				$usuario_id = $this->DireccionesModel->actualizar( $this->input->post('Identificador'),$parametros);
				redirect(base_url('usuario/direcciones'));
			}else{
				$this->data['direccion'] = $this->DireccionesModel->detalles($_GET['id']);
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/form_actualizar_direccion',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
			}
		}else{
			redirect(base_url('login'));
		}
	}
	public function borrar()
	{
		if(verificar_sesion()){
			$this->DireccionesModel->borrar($_GET['id']);
			redirect(base_url('usuario/direcciones'));
		}else{
			redirect(base_url('login'));
	}

	// Login Form
	}
}
