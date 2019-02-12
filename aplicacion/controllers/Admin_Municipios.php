<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Municipios extends CI_Controller {

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
		$this->load->model('MunicipiosModel');
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
			$parametros = '';

			$this->data['municipios'] = $this->MunicipiosModel->lista($parametros,$_GET['estado'],'');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_municipios',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{

		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'MUNICIPIO_NOMBRE'=>$_GET['Busqueda'],
			);
			$this->data['municipios'] = $this->MunicipiosModel->lista($parametros,$_GET['estado'],'');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_municipios',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/municipios').$pais);
		}
	}
	public function crear()
	{
		if(isset($_GET['estado'])&&!empty($_GET['estado'])){
			$parametros = array( 'ESTADO_NOMBRE'=>$_GET['estado'] );
		}else{$parametros = ''; }

		$this->form_validation->set_rules('IsoMunicipio', 'Código ISO', 'required', array( 'required' => 'Debes designar el %s.' ));
		$this->form_validation->set_rules('NombreMunicipio', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'ID_PAIS' => $this->input->post('IdPais'),
				'ESTADO_ISO' => $this->input->post('IsoMunicipio'),
				'ESTADO_NOMBRE' => $this->input->post('NombreMunicipio'),
      );

			if(null !== $this->input->post('EstadoMunicipio') && !empty($this->input->post('EstadoMunicipio'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['ESTADO_ESTADO']= $estado;

      $estado_id = $this->MunicipiosModel->crear($parametros);
      redirect(base_url('admin/municipios').$pais);
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_municipio',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		if(isset($_GET['estado'])&&!empty($_GET['estado'])){
			$parametros = array( 'ESTADO_NOMBRE'=>$_GET['estado'] );
		}else{$parametros = ''; }

		$this->form_validation->set_rules('IsoMunicipio', 'Código ISO', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('NombreMunicipio', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'ID_PAIS' => $this->input->post('IdPais'),
				'ESTADO_ISO' => $this->input->post('IsoMunicipio'),
				'ESTADO_NOMBRE' => $this->input->post('NombreMunicipio'),
      );

			if(null !== $this->input->post('EstadoMunicipio') && !empty($this->input->post('EstadoMunicipio'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['ESTADO_ESTADO']= $estado;

      $estado_id = $this->MunicipiosModel->actualizar( $this->input->post('Identificador'),$parametros);
        redirect(base_url('admin/municipios').$pais);
    }else{

			$this->data['municipio'] = $this->MunicipiosModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_municipio',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		if(isset($_GET['estado'])&&!empty($_GET['estado'])){
			$parametros = array( 'ESTADO_NOMBRE'=>$_GET['estado'] );
		}else{$parametros = ''; }

		$estado = $this->MunicipiosModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($estado['ID_ESTADO']))
        {
            $this->MunicipiosModel->borrar($_GET['id']);
            redirect(base_url('admin/municipios').$pais);
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
			$pais = "?pais=".$_GET['pais'];
			$estado = "&estado=".$_GET['estadoDir'];

		$this->MunicipiosModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/municipios').$pais.$estado);
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
