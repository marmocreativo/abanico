<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Transportistas_Restricciones extends CI_Controller {

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
		$this->load->model('TransportistasModel');
		$this->load->model('TransportistasDisponibilidadModel');
		$this->load->model('TransportistasRangosModel');
		$this->load->model('TransportistasRestriccionesModel');
		$this->load->model('ProductosModel');
		$this->load->model('UsuariosModel');
		$this->load->model('TiendasModel');
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
			$this->data['transportista'] = $this->TransportistasModel->detalles($_GET['id']);
			$this->data['tiendas'] = $this->TiendasModel->lista('','','','');
			$this->data['productos'] = $this->ProductosModel->lista(['PRODUCTO_TIPO'=>'normal'],'','PRODUCTO_FECHA_REGISTRO DESC','');
			$this->data['restricciones_tiendas'] = $this->TransportistasRestriccionesModel->lista($this->data['transportista']['ID_TRANSPORTISTA'],'tienda','');
			$this->data['restricciones_productos'] = $this->TransportistasRestriccionesModel->lista($this->data['transportista']['ID_TRANSPORTISTA'],'producto','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_transportista_restricciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function crear()
	{
		$parametros = array(
			'ID_TRANSPORTISTA' => $this->input->post('IdTransportista'),
			'ID_OBJETO' => $this->input->post('IdObjeto'),
			'TIPO_OBJETO' => $this->input->post('TipoObjeto')
		);

		$restriccion_id = $this->TransportistasRestriccionesModel->crear($parametros);

		$this->session->set_flashdata('exito', 'Restricción Creada');
		redirect(base_url('admin/transportistas_restricciones?id='.$this->input->post('IdTransportista')));
	}


	public function borrar()
	{
		$restriccion = $this->TransportistasRestriccionesModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($restriccion['ID_RESTRICCION']))
        {
            $this->TransportistasRestriccionesModel->borrar($restriccion['ID_RESTRICCION']);
						$this->session->set_flashdata('exito', 'Restricción Eliminada');
            redirect(base_url('admin/transportistas_restricciones?id='.$restriccion['ID_TRANSPORTISTA']));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
}
