<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Rangos extends CI_Controller {

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
		$this->load->model('TransportistasModel');
		$this->load->model('TransportistasDisponibilidadModel');
		$this->load->model('TransportistasRangosModel');
		$this->load->model('EstadisticasModel');
		$this->load->model('NotificacionesModel');

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
			$this->data['transportista'] = $this->TransportistasModel->detalles($_GET['id_transportista']);
			$this->data['rangos'] = $this->TransportistasRangosModel->lista($_GET['id_transportista'],'transportistas_rangos.IMPORTE ASC','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_rangos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'TRANSPORTISTA_NOMBRE'=>$_GET['Busqueda']
			);
			$this->data['rangos'] = $this->TransportistasRangosModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_rangos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/rangos'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('PesoMax', 'Peso Máximo', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('ImporteMin', 'Importe Mínimo', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('Importe', 'Importe', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('IdTransportista', 'Transportista', 'required', array( 'required' => 'Debes designar el %s.'));

		if($this->form_validation->run())
    {

      $parametros = array(
				'ID_TRANSPORTISTA' => $this->input->post('IdTransportista'),
				'PESO_MAX' => $this->input->post('PesoMax'),
				'IMPORTE_MIN' => $this->input->post('ImporteMin'),
				'IMPORTE' => $this->input->post('Importe')
      );

      $this->TransportistasRangosModel->crear($parametros);
			// Mensaje Feedback
			$this->session->set_flashdata('exito', 'Rango Creado correctamente');
			// Redirecciono
      redirect(base_url('admin/rangos?id_transportista='.$this->input->post('IdTransportista')));
    }else{

			$this->data['transportista'] = $this->TransportistasModel->detalles($_GET['id_transportista']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_rango',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{

		$this->form_validation->set_rules('PesoMax', 'Peso Máximo', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('ImporteMin', 'Importe Mínimo', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('Importe', 'Importe', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('IdTransportista', 'Transportista', 'required', array( 'required' => 'Debes designar el %s.'));

		if($this->form_validation->run())
    {

			$parametros = array(
				'ID_TRANSPORTISTA' => $this->input->post('IdTransportista'),
				'PESO_MAX' => $this->input->post('PesoMax'),
				'IMPORTE_MIN' => $this->input->post('ImporteMin'),
				'IMPORTE' => $this->input->post('Importe')
      );

			$this->TransportistasRangosModel->actualizar($this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Rango actualizado');
			// Redirecciono
      redirect(base_url('admin/rangos?id_transportista='.$this->input->post('IdTransportista')));
    }else{
			$this->data['rango'] = $this->TransportistasRangosModel->detalles($_GET['id']);
			$this->data['transportista'] = $this->TransportistasModel->detalles($_GET['id_transportista']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_rango',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$rango = $this->TransportistasRangosModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($rango['ID']))
        {
            $this->TransportistasRangosModel->borrar($rango['ID']);
						$this->session->set_flashdata('exito', 'Rango Eliminado');
            redirect(base_url('admin/rangos?id_transportista='.$rango['ID_TRANSPORTISTA']));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		$this->TransportistasRangosModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/rangos'));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
