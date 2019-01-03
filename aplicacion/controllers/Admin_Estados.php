<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Estados extends CI_Controller {

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
		$this->load->model('EstadosModel');

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
			if(isset($_GET['pais'])&&!empty($_GET['pais'])){
				$parametros = array( 'ID_PAIS'=>$_GET['pais'] );
			}else{$parametros = ''; }

			$this->data['estados'] = $this->EstadosModel->lista($parametros,'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_estados',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['pais'])&&!empty($_GET['pais'])){
			$pais = "?pais=".$_GET['pais'];
		}else{ $pais = ''; }

		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'ESTADO_ISO'=>$_GET['Busqueda'],
				'ESTADO_NOMBRE'=>$_GET['Busqueda']
			);
			$this->data['estados'] = $this->EstadosModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_estados',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/estados').$pais);
		}
	}
	public function crear()
	{
		if(isset($_GET['pais'])&&!empty($_GET['pais'])){
			$pais = "?pais=".$_GET['pais'];
		}else{ $pais = "?pais=1"; }

		$this->form_validation->set_rules('IsoEstado', 'Código ISO', 'required', array( 'required' => 'Debes designar el %s.' ));
		$this->form_validation->set_rules('NombreEstado', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'ID_PAIS' => $this->input->post('IdPais'),
				'ESTADO_ISO' => $this->input->post('IsoEstado'),
				'ESTADO_NOMBRE' => $this->input->post('NombreEstado'),
      );

			if(null !== $this->input->post('EstadoEstado') && !empty($this->input->post('EstadoEstado'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['ESTADO_ESTADO']= $estado;

      $estado_id = $this->EstadosModel->crear($parametros);
      redirect(base_url('admin/estados').$pais);
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_estado',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		if(isset($_GET['pais'])&&!empty($_GET['pais'])){
			$pais = "?pais=".$_GET['pais'];
		}else{ $pais = "?pais=1"; }

		$this->form_validation->set_rules('IsoEstado', 'Código ISO', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('NombreEstado', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'ID_PAIS' => $this->input->post('IdPais'),
				'ESTADO_ISO' => $this->input->post('IsoEstado'),
				'ESTADO_NOMBRE' => $this->input->post('NombreEstado'),
      );

			if(null !== $this->input->post('EstadoEstado') && !empty($this->input->post('EstadoEstado'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['ESTADO_ESTADO']= $estado;

      $estado_id = $this->EstadosModel->actualizar( $this->input->post('Identificador'),$parametros);
        redirect(base_url('admin/estados').$pais);
    }else{

			$this->data['estado'] = $this->EstadosModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_estado',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		if(isset($_GET['pais'])&&!empty($_GET['pais'])){
			$pais = "?pais=".$_GET['pais'];
		}else{ $pais = "?pais=1"; }

		$estado = $this->EstadosModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($estado['ID_ESTADO']))
        {
            $this->EstadosModel->borrar($_GET['id']);
            redirect(base_url('admin/estados').$pais);
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		if(isset($_GET['pais'])&&!empty($_GET['pais'])){
			$pais = "?pais=".$_GET['pais'];
		}else{ $pais = "?pais=1"; }

		$this->EstadosModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/estados').$pais);
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
