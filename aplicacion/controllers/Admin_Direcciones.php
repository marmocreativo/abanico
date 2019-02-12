<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Direcciones extends CI_Controller {

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
		$this->load->model('DireccionesModel');
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
		if(isset($_GET['id_usuario'])){
			$this->data['direcciones'] = $this->DireccionesModel->lista_direcciones($_GET['id_usuario']);
		}else{
			$this->data['direcciones'] = $this->DireccionesModel->lista('','','','');
		}
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_direcciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'DIRECCION_NOMBRE'=>$_GET['Busqueda'],
				'DIRECCION_RAZON_SOCIAL'=>$_GET['Busqueda'],
				'DIRECCION_RFC'=>$_GET['Busqueda']
			);
			$this->data['direcciones'] = $this->DireccionesModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_direcciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/direcciones'));
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

			$direccion_id = $this->DireccionesModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Dirección creada correctamente');
      redirect(base_url('admin/direcciones?id_usuario=').$this->input->post('IdUsuario'));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_direccion',$this->data);
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
			$this->session->set_flashdata('exito', 'Dirección actualizada');
      redirect(base_url('admin/direcciones?id_usuario='.$this->input->post('IdUsuario')));
    }else{

			$this->data['direccion'] = $this->DireccionesModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_direccion',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$direccion = $this->DireccionesModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($direccion['ID_DIRECCION']))
        {
            $this->DireccionesModel->borrar($_GET['id']);
						$this->session->set_flashdata('exito', 'Dirección eliminada');
            redirect(base_url('admin/direcciones?id_usuario='.$direccion['ID_USUARIO']));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
}
