<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Pedidos extends CI_Controller {

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
		$this->load->model('PagosPedidosModel');
		$this->load->model('DevolucionesModel');

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

			// Reviso si hay id del usuario
			if(isset($_GET['id_usuario'])){
				$this->data['pedidos'] = $this->PedidosModel->lista_usuario('',$_GET['id_usuario'],'PEDIDO_FECHA_REGISTRO DESC','');
				$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			}else{
				$this->data['pedidos'] = $this->PedidosModel->lista('','PEDIDO_FECHA_REGISTRO DESC','');
			}
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_pedidos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function devoluciones()
	{

			// Reviso si hay id del usuario
			if(isset($_GET['id_usuario'])){
				$this->data['devoluciones'] = $this->DevolucionesModel->devoluciones_usuario($_GET['id_usuario'],'DEVOLUCION_FECHA_REGISTRO DESC');
				$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			}else{
				$this->data['devoluciones'] = $this->DevolucionesModel->todas_las_devoluciones('DEVOLUCION_FECHA_REGISTRO DESC');
			}
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_devoluciones',$this->data);
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
			if(isset($_GET['id_usuario'])){
				$this->data['pedidos'] = $this->PedidosModel->lista_usuario('',$_GET['id_usuario'],'PEDIDO_FECHA_REGISTRO DESC','');
				$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			}else{
				$this->data['pedidos'] = $this->PedidosModel->lista('','PEDIDO_FECHA_REGISTRO DESC','');
			}

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_pedidos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/productos'));
		}
	}
	public function detalles()
	{
			$this->data['pedido'] = $this->PedidosModel->detalles($_GET['id_pedido']);
			$this->data['usuario'] = $this->UsuariosModel->detalles($this->data['pedido']['ID_USUARIO']);
			$this->data['tiendas'] = $this->PedidosTiendasModel->lista_tiendas($_GET['id_pedido']);
			$this->data['productos'] = $this->PedidosProductosModel->lista(['ID_PEDIDO'=>$_GET['id_pedido']],'','');
			$this->data['guias'] = $this->GuiasPedidosModel->lista_guias($_GET['id_pedido']);
			$this->data['pagos'] = $this->PagosPedidosModel->lista($_GET['id_pedido']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/detalles_pedido',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function actualizar_estado()
	{
			$parametros = array(
				'PEDIDO_ESTADO_PEDIDO'=>$this->input->post('EstadoPedido'),
				'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s')
			);
			$this->PedidosModel->actualizar($this->input->post('IdPedido'),$parametros);
			$this->session->set_flashdata('exito', 'Pedido actualizado correctamente');
      redirect(base_url('admin/pedidos/detalles?id_pedido=').$this->input->post('IdPedido'));
	}
	public function guia()
	{
			$this->form_validation->set_rules('IdPedido', 'Número de Orden del Pedido', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{
			$guia = folio_pedido().'-'.$this->input->post('IdPedido');
			$parametros = array(
				'GUIA_CODIGO' => $guia,
				'ID_PEDIDO' => $this->input->post('IdPedido'),
				'GUIA_NOMBRE' => $this->input->post('NombreGuia'),
				'GUIA_DIRECCION' => $this->input->post('DireccionGuia'),
				'GUIA_TELEFONO' => $this->input->post('TelefonoGuia'),
				'GUIA_CORREO' => $this->input->post('CorreoGuia'),
				'GUIA_ESTADO' => 'Preparacion',
				'GUIA_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'GUIA_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
			);
			$guia_id = $this->GuiasPedidosModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Tu Guía se asigno correctamente');
      redirect(base_url('admin/pedidos/detalles?id_pedido=').$this->input->post('IdPedido'));

		}else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/detalles_pedido',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function responder_devolucion()
	{
		$parametros_devolucion = array(
			'DEVOLUCION_RESPUESTA'=>$this->input->post('RespuestaDevolucion'),
			'DEVOLUCION_ESTADO'=>$this->input->post('EstadoDevolucion')
		);
			$parametros = array(
				'PEDIDO_ESTADO_PEDIDO'=>$this->input->post('EstadoDevolucion'),
				'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s')
			);
			$this->DevolucionesModel->actualizar($this->input->post('IdDevolucion'),$parametros_devolucion);
			$this->PedidosModel->actualizar($this->input->post('IdPedido'),$parametros);
			$this->session->set_flashdata('exito', 'Pedido actualizado correctamente');
      redirect(base_url('admin/pedidos/detalles?id_pedido=').$this->input->post('IdPedido'));
	}
}
