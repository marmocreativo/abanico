<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Pedidos extends CI_Controller {
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
			$this->data['dispositivo']  = "mobile";
		}else{
			$this->data['dispositivo']  = "desktop";
		}
			// Cargo el modelo
			$this->load->model('ProductosModel');
			$this->load->model('UsuariosModel');
			$this->load->model('GaleriasModel');
			$this->load->model('CategoriasModel');
			$this->load->model('CategoriasProductoModel');
			$this->load->model('TiendasModel');
			$this->load->model('PerfilServiciosModel');
			$this->load->model('PedidosModel');
			$this->load->model('PedidosTiendasModel');
			$this->load->model('PedidosProductosModel');
			$this->load->model('GuiasPedidosModel');
			$this->load->model('PagosPedidosModel');
			$this->load->model('DevolucionesModel');
			$this->load->model('NotificacionesModel');
  }

	public function index()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

				// Obtengo los datos de mi tiendas
				$this->data['pedidos'] = $this->PedidosModel->lista_usuario('',$_SESSION['usuario']['id'],'PEDIDO_FECHA_REGISTRO DESC','');
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/lista_pedidos',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}
	public function detalles()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

				// Obtengo los datos de mi tiendas
				$this->data['pedido'] = $this->PedidosModel->detalles($_GET['id_pedido']);
				$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
				$this->data['productos'] = $this->PedidosProductosModel->lista(['ID_PEDIDO'=>$_GET['id_pedido']],'','');
				$this->data['tiendas'] = $this->PedidosTiendasModel->lista_tiendas($_GET['id_pedido']);
				$this->data['guias_abanico'] = $this->GuiasPedidosModel->lista(['ID_PEDIDO'=>$_GET['id_pedido']],'','');
				$this->data['pagos'] = $this->PagosPedidosModel->lista($_GET['id_pedido']);
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/detalles_pedido',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}

	public function subir_comprobante()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}

			$this->form_validation->set_rules('FormaPago', 'Forma de Pago', 'required', array( 'required' => 'Debes designar la %s'));

			if($this->form_validation->run())
			{
				// Subo el archivo
				$nombre_archivo = 'pago-'.uniqid();
				$config['upload_path']          = 'contenido/adjuntos/pedidos';
				$config['allowed_types']        = 'pdf|jpg|png';
				$config['file_name']						=	$nombre_archivo;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('ArchivoPago')){
					$this->session->set_flashdata('alerta', 'No se pudo subir el archivo');
					redirect(base_url('usuario/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
				}else{
					$archivo = $this->upload->data('file_name');
					// Parametros del Servicio
					$parametros = array(
						'ID_PEDIDO'=> $this->input->post('IdPedido'),
						'PAGO_FORMA'=> $this->input->post('FormaPago'),
						'PAGO_FOLIO'=> $this->input->post('FolioPago'),
						'PAGO_ARCHIVO'=>$archivo,
						'PAGO_DESCRIPCION'=> $this->input->post('DescripcionPago'),
						'PAGO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
						'PAGO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
						'PAGO_ESTADO'=> $this->input->post('EstadoPago'),
					);
					$parametros_pedido = array(
						'PEDIDO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
						'PEDIDO_ESTADO_PAGO'=> $this->input->post('EstadoPago'),
					);
				}
				// Creo el Servicio
				$adjunto_id = $this->PagosPedidosModel->crear($parametros);
				$adjunto_id = $this->PedidosModel->actualizar($this->input->post('IdPedido'),$parametros_pedido);
				$this->session->set_flashdata('exito', 'Comprobante cargado correctamente');
				redirect(base_url('usuario/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
			}else{
				$this->session->set_flashdata('alerta', 'No se pudo subir el archivo');
				redirect(base_url('usuario/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
			}
}
	/*
	* Cancelar
	*/
	public function cambiar_estado()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		$this->PedidosModel->estado($_GET['id'],$_GET['estado']);
		redirect(base_url('usuario/pedidos/detalles?id_pedido='.$_GET['id']));
	}
	/*
	* Devolucion
	*/
	public function devolucion()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

			$this->form_validation->set_rules('ComentarioDevolucion', 'Comentario', 'required', array( 'required' => 'Debes agregar tu comentario %s'));

			if($this->form_validation->run())
			{
				// Subo el archivo
				$nombre_archivo = 'devolucion-'.uniqid();
				$config['upload_path']          = 'contenido/adjuntos/pedidos';
				$config['allowed_types']        = 'pdf|jpg|png';
				$config['file_name']						=	$nombre_archivo;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('ArchivoDevolucion')){
					$archivo = '';
				}else{
					$archivo = $this->upload->data('file_name');
				}
					// Parametros del Servicio
					$parametros = array(
						'ID_PEDIDO'=> $this->input->post('IdPedido'),
						'DEVOLUCION_COMENTARIO'=>$this->input->post('ComentarioDevolucion'),
						'DEVOLUCION_ARCHIVO'=>$archivo,
						'DEVOLUCION_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
						'DEVOLUCION_ESTADO'=>'Solicitud'
					);
					$parametros_pedido = array(
						'PEDIDO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
						'PEDIDO_ESTADO_PEDIDO'=> 'Solicitud Devolucion',
					);
				// Creo el Servicio
				$adjunto_id = $this->DevolucionesModel->crear($parametros);
				$adjunto_id = $this->PedidosModel->actualizar($this->input->post('IdPedido'),$parametros_pedido);
				$this->session->set_flashdata('exito', 'Comprobante cargado correctamente');
				redirect(base_url('usuario/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
			}else{
				$this->session->set_flashdata('alerta', 'No se pudo subir el archivo');
				redirect(base_url('usuario/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
			}
	}
}
