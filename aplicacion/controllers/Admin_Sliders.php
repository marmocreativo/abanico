<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Sliders extends CI_Controller {

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
		$this->load->model('SlidersModel');
		$this->load->model('LenguajesModel');
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

		$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');
		$this->data['sliders'] = $this->SlidersModel->lista('','','');
		$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
		$this->load->view($this->data['dispositivo'].'/admin/lista_sliders',$this->data);
		$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'SLIDER_NOMBRE'=>$_GET['Busqueda'],
				'SLIDER_RAZON_SOCIAL'=>$_GET['Busqueda'],
				'SLIDER_RFC'=>$_GET['Busqueda']
			);
			$this->data['sliders'] = $this->SlidersModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_sliders',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/sliders'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('NombreSlider', 'Nombre', 'required', array('required' => 'Debes escribir el %s.'));

		if($this->form_validation->run())
		{

			// Parametros de la dirección
			$parametros = array(
				'SLIDER_ANCHO' => $this->input->post('AnchoSlider'),
				'SLIDER_ALTO' => $this->input->post('AltoSlider'),
				'SLIDER_ANCHO_MOVIL' => $this->input->post('AnchoMovilSlider'),
				'SLIDER_ALTO_MOVIL' => $this->input->post('AltoMovilSlider'),
				'SLIDER_NOMBRE' => $this->input->post('NombreSlider'),
				'SLIDER_LENGUAJE' => $this->input->post('LenguajeSlider'),
				'SLIDER_ESTADO' => $this->input->post('EstadoSlider')
			);

			$direccion_id = $this->SlidersModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Publicación creada correctamente');
      redirect(base_url('admin/sliders'));
    }else{

			$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_sliders',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
			$this->form_validation->set_rules('NombreSlider', 'Nombre', 'required', array('required' => 'Debes escribir el %s.'));

		if($this->form_validation->run())
		{


			// Parametros de la dirección
			$parametros = array(
				'SLIDER_ANCHO' => $this->input->post('AnchoSlider'),
				'SLIDER_ALTO' => $this->input->post('AltoSlider'),
				'SLIDER_ANCHO_MOVIL' => $this->input->post('AnchoMovilSlider'),
				'SLIDER_ALTO_MOVIL' => $this->input->post('AltoMovilSlider'),
				'SLIDER_NOMBRE' => $this->input->post('NombreSlider'),
				'SLIDER_LENGUAJE' => $this->input->post('LenguajeSlider'),
				'SLIDER_ESTADO' => $this->input->post('EstadoSlider')
			);

			$usuario_id = $this->SlidersModel->actualizar( $this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Publicación actualizada');
      redirect(base_url('admin/sliders'));
    }else{

			$this->data['slider'] = $this->SlidersModel->detalles($_GET['id']);
			$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_sliders',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function activar()
	{
		$this->SlidersModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/sliders?tipo_slide='.$_GET['tipo_slide']));
	}

	public function borrar()
	{
		$slide = $this->SlidersModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($slide['ID_SLIDER']))
        {
            $this->SlidersModel->borrar($_GET['id']);
						$this->session->set_flashdata('exito', 'Publicación eliminada');
            redirect(base_url('admin/sliders?tipo_slide='.$slide['SLIDER_TIPO']));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
}
