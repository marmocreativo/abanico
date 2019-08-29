<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Desktop extends CI_Controller {

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

		// Modelos
		$this->load->model('UsuariosModel');
		$this->load->model('PedidosModel');
		$this->load->model('ProductosModel');
		$this->load->model('ServiciosModel');
		$this->load->model('EstadisticasModel');
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
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/admin_desktop',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function opciones()
	{
		$this->form_validation->set_rules('Opciones[titulo_sitio]', 'Titulo', 'required', array( 'required' => 'Debes designar el valor de la %s.' ));

		if($this->form_validation->run())
    {
			foreach($_POST['Opciones'] as $opcion=>$valor){
				$parametros = array(
					'OPCION_VALOR'=>$valor
				);

				$this->opciones->actualizar($opcion,$parametros);
			}

			$this->session->set_flashdata('exito', 'Opciones guardadas exitosamente');
			redirect(base_url('admin/opciones'));

		}else{
			$this->data['lista_opciones'] = $this->opciones->lista_opciones();
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_opciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}

	}
	public function nueva_opcion()
	{
			echo 'Nueva Opcion';
	}
	public function carruseles()
	{
			echo 'Lista Carruseles';
	}
	public function nuevo_carrusel()
	{
			echo 'Nuevo Carrusel';
	}
	public function editar_carrusel()
	{
			echo 'Editar Carrusel';
	}
}
