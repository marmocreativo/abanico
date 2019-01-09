<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Guias extends CI_Controller {

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
		$this->load->model('PedidosModel');
		$this->load->model('UsuariosModel');
		$this->load->model('PedidosProductosModel');
		$this->load->model('TiendasModel');
		$this->load->model('PedidosTiendasModel');
		$this->load->model('GuiasPedidosModel');
		$this->load->model('RutasGuiasModel');
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

			$this->data['guias'] = $this->GuiasPedidosModel->lista('','GUIA_FECHA_REGISTRO DESC','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_guias',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'PEDIDO_IMPORTE'=>$_GET['Busqueda'],
				'PEDIDO_NOMBRE'=>$_GET['Busqueda'],
				'PEDIDO_CORREO'=>$_GET['Busqueda']
			);

			$this->data['guias'] = $this->GuiasPedidosModel->lista_guias($_GET['id_pedido']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_pedidos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/productos'));
		}
	}
	public function detalles()
	{
			$this->data['puntos_registro'] = $this->PuntosRegistroModel->lista('','','','');
			$this->data['guia'] = $this->GuiasPedidosModel->detalles($_GET['guia']);
			$this->data['ubicaciones'] = $this->RutasGuiasModel->lista_rutas($this->data['guia']['GUIA_CODIGO']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/detalles_guia',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function imprimir()
	{
			$this->data['guia'] = $this->GuiasPedidosModel->detalles($_GET['guia']);
			$this->load->view($this->data['dispositivo'].'/admin/imprimir_guia',$this->data);
	}
	public function ruta()
	{
		$this->form_validation->set_rules('Guia', 'Número de Guía', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{
			$parametros = array(
				'GUIA_CODIGO' => $this->input->post('Guia'),
				'ID_PUNTO' => $this->input->post('IdPunto'),
				'PUNTO_ALIAS' => $this->input->post('PuntoAlias'),
				'PUNTO_DIRECCION' => $this->input->post('PuntoDirección'),
				'RUTA_FECHA_REGISTRO' => date('Y-m-d H:i:s')
			);
			$ruta_id = $this->RutasGuiasModel->crear($parametros);
			$parametros_guia = array(
				'GUIA_ESTADO'=>$this->input->post('Estado')
			);
			// Actualizo Guía
			$this->GuiasPedidosModel->actualizar($this->input->post('Guia'),$parametros_guia);
			$this->session->set_flashdata('exito', 'Tu Guía se asigno correctamente');
      redirect(base_url('admin/guias/detalles?guia=').$this->input->post('Guia'));

		}else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/detalles_pedido',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function ruta_auto()
	{
		$this->form_validation->set_rules('Guia', 'Número de Guía', 'required', array('required' => 'Debes escribir tu %s.'));

		$punto_registro = $this->PuntosRegistroModel->detalles($this->input->post('IdPunto'));
		$direccion_punto_registro = $this->PuntosRegistroModel->direccion_formateada($this->input->post('IdPunto'));

		if($this->form_validation->run())
		{
			$parametros = array(
				'GUIA_CODIGO' => $this->input->post('Guia'),
				'ID_PUNTO' => $this->input->post('IdPunto'),
				'PUNTO_ALIAS' => $punto_registro['PUNTO_ALIAS'],
				'PUNTO_DIRECCION' => $direccion_punto_registro,
				'RUTA_FECHA_REGISTRO' => date('Y-m-d H:i:s')
			);
			$ruta_id = $this->RutasGuiasModel->crear($parametros);
			$parametros_guia = array(
				'GUIA_ESTADO'=>$this->input->post('Estado')
			);
			// Actualizo Guía
			$this->GuiasPedidosModel->actualizar($this->input->post('Guia'),$parametros_guia);
			$this->session->set_flashdata('exito', 'Tu Guía se asigno correctamente');
      redirect(base_url('admin/guias/detalles?guia=').$this->input->post('Guia'));

		}else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/detalles_pedido',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
}
