<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Puntos_Registro extends CI_Controller {

	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();

		// Variables defaults
		$this->data['primary'] = "-primary";

		if($this->agent->is_mobile()){
			$this->data['dispositivo']  = "desktop";
		}else{
			$this->data['dispositivo']  = "desktop";
		}

		// Cargo el modelo
		$this->load->model('PuntosRegistroModel');

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
			$this->data['puntos_registro'] = $this->PuntosRegistroModel->lista('','','','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_puntos_registro',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'PUNTO_NOMBRE'=>$_GET['Busqueda'],
				'PUNTO_RAZON_SOCIAL'=>$_GET['Busqueda'],
				'PUNTO_RFC'=>$_GET['Busqueda']
			);
			$this->data['puntos_registro'] = $this->PuntosRegistroModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_puntos_registro',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/puntos_registro'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('CalleDireccion', 'Calle y Número', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('PaisDireccion', 'País', 'required', array('required' => 'Debes elegir tu %s.'));
		$this->form_validation->set_rules('EstadoDireccion', 'Estado', 'required', array('required' => 'Debes elegir tu %s.'));
		$this->form_validation->set_rules('MunicipioDireccion', 'Municipio', 'required', array('required' => 'Debes elegir tu %s.'));
		$this->form_validation->set_rules('CodigoPostalDireccion', 'Código Postal', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{
			// Parametros de la dirección
			$parametros = array(
				'PUNTO_ALIAS' => $this->input->post('AliasDireccion'),
				'PUNTO_PAIS' => $this->input->post('PaisDireccion'),
				'PUNTO_ESTADO' => $this->input->post('EstadoDireccion'),
				'PUNTO_CIUDAD' => $this->input->post('CiudadDireccion'),
				'PUNTO_MUNICIPIO' => $this->input->post('MunicipioDireccion'),
				'PUNTO_BARRIO' => $this->input->post('BarrioDireccion'),
				'PUNTO_CALLE_Y_NUMERO' => $this->input->post('CalleDireccion'),
				'PUNTO_CODIGO_POSTAL' => $this->input->post('CodigoPostalDireccion'),
				'PUNTO_REFERENCIAS' => $this->input->post('ReferenciasDireccion')
			);

			$punto_registro_id = $this->PuntosRegistroModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Dirección creada correctamente');
      redirect(base_url('admin/puntos_registro?id_usuario=').$this->input->post('IdUsuario'));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_punto_registro',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('CalleDireccion', 'Calle y Número', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('PaisDireccion', 'País', 'required', array('required' => 'Debes elegir tu %s.'));
		$this->form_validation->set_rules('EstadoDireccion', 'Estado', 'required', array('required' => 'Debes elegir tu %s.'));
		$this->form_validation->set_rules('MunicipioDireccion', 'Municipio', 'required', array('required' => 'Debes elegir tu %s.'));
		$this->form_validation->set_rules('CodigoPostalDireccion', 'Código Postal', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{
			// Parametros de la dirección
			$parametros = array(
				'PUNTO_ALIAS' => $this->input->post('AliasDireccion'),
				'PUNTO_PAIS' => $this->input->post('PaisDireccion'),
				'PUNTO_ESTADO' => $this->input->post('EstadoDireccion'),
				'PUNTO_CIUDAD' => $this->input->post('CiudadDireccion'),
				'PUNTO_MUNICIPIO' => $this->input->post('MunicipioDireccion'),
				'PUNTO_BARRIO' => $this->input->post('BarrioDireccion'),
				'PUNTO_CALLE_Y_NUMERO' => $this->input->post('CalleDireccion'),
				'PUNTO_CODIGO_POSTAL' => $this->input->post('CodigoPostalDireccion'),
				'PUNTO_REFERENCIAS' => $this->input->post('ReferenciasDireccion')
			);

			$usuario_id = $this->PuntosRegistroModel->actualizar( $this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Dirección actualizada');
      redirect(base_url('admin/puntos_registro?id_usuario='.$this->input->post('IdUsuario')));
    }else{

			$this->data['punto_registro'] = $this->PuntosRegistroModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_punto_registro',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$punto_registro = $this->PuntosRegistroModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($punto_registro['ID_PUNTO']))
        {
            $this->PuntosRegistroModel->borrar($_GET['id']);
						$this->session->set_flashdata('exito', 'Dirección eliminada');
            redirect(base_url('admin/puntos_registro?id_usuario='.$punto_registro['ID_USUARIO']));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
}
