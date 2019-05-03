<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Planes extends CI_Controller {
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
			$this->load->model('PlanesModel');
			$this->load->model('PerfilServiciosModel');
			$this->load->model('DireccionesModel');
			$this->load->model('PlanesModel');
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
				$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
				$direccion_fiscal = $this->DireccionesModel->direccion_fiscal($_SESSION['usuario']['id']);
				$this->data['direccion_formateada'] = $this->DireccionesModel->direccion_formateada($this->data['tienda']['ID_DIRECCION']);
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/lista_planes',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}


	public function lista_planes()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

			// Obtengo los datos de mi tiendas
			if(!empty($_GET['tipo'])){
				$tipo = $_GET['tipo'];
			}else{
				$tipo = 'productos';
			}
			$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
			$this->data['planes'] = $this->PlanesModel->lista(['PLAN_TIPO'=>$tipo]);
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/form_planes',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}

	public function activar()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

			$plan = $this->PlanesModel->detalles($_GET['id']);

			$parametros = array(
				'ID_PLAN'=>$plan['ID_PLAN'],
				'ID_USUARIO'=>$_SESSION['usuario']['id'],
				'PLAN_NOMBRE'=>$plan['PLAN_NOMBRE'],
				'PLAN_MENSUALIDAD'=>$plan['PLAN_MENSUALIDAD'],
				'PLAN_ESPACIO_ALMACENAMIENTO'=>0.25,
				'PLAN_COSTO_ALMACENAMIENTO'=>$plan['PLAN_ALMACENAMIENTO'],
				'PLAN_COMISION'=>$plan['PLAN_COMISION'],
				'PLAN_MANEJO_PRODUCTOS'=>$plan['PLAN_MANEJO_PRODUCTOS'],
				'PLAN_ENVIO'=>$plan['PLAN_ENVIO'],
				'PLAN_SERVICIOS_FINANCIEROS'=>$plan['PLAN_SERVICIOS_FINANCIEROS'],
				'PLAN_SERVICIOS_FINANCIEROS_FIJO'=>$plan['PLAN_SERVICIOS_FINANCIEROS_FIJO'],
				'PLAN_TIPO'=>$plan['PLAN_TIPO'],
				'PLAN_LIMITE_PRODUCTOS'=>$plan['PLAN_LIMITE_PRODUCTOS'],
				'PLAN_LIMITE_SERVICIOS'=>$plan['PLAN_LIMITE_SERVICIOS'],
				'PLAN_FOTOS_PRODUCTOS'=>$plan['PLAN_FOTOS_PRODUCTOS'],
				'PLAN_FOTOS_SERVICIOS'=>$plan['PLAN_FOTOS_SERVICIOS'],
				'PLAN_NIVEL'=>$plan['PLAN_NIVEL'],
				'PLAN_ESTADO'=>'pendiente',
				'FECHA_INICIO'=>date('Y-m-d'),
				'FECHA_TERMINO'=>date('Y-m-d', strtotime("+1 month")),
				'AUTO_RENOVAR'=>'si',
			);
			$this->PlanesModel->crear_plan_usuario($parametros);

			$this->data['plan'] = $this->PlanesModel->detalles_usuario($_SESSION['usuario']['id']);
			$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
			$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
			$this->data['perfil_servidor'] = $this->PerfilServiciosModel->perfil_usuario($_SESSION['usuario']['id']);

			$this->data['info'] = array();
			if($plan['PLAN_TIPO']=='productos'){
				$this->data['info']['Titulo'] = 'Solicitud de activación de plan | '.$this->data['tienda']['TIENDA_NOMBRE'];
			}else{
				$this->data['info']['Titulo'] = 'Solicitud de activación de plan | '.$this->data['perfil_servidor']['PERFIL_NOMBRE'];
			}
			$this->data['info']['Nombre'] = 'se solicitó la activación del plan: '.$this->data['plan']['PLAN_NOMBRE'];
			$this->data['info']['Mensaje'] = '<p>Puedes revisar los detalles del plan en el administrador</p>';
			$this->data['info']['TextoBoton'] = 'Iniciar sesión';
			$this->data['info']['EnlaceBoton'] = base_url('admin/tiendas');
			// Pedido General
			$mensaje_abanico = $this->load->view('emails/mensaje_general',$this->data,true);

			// Envio correos Generales
			// Datos para enviar por correo
			// Config General

			$config['protocol']    = 'smtp';
			$config['smtp_host']    = $this->data['op']['mailer_host'];
			$config['smtp_port']    = $this->data['op']['mailer_port'];
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = $this->data['op']['mailer_user'];
			$config['smtp_pass']    = $this->data['op']['mailer_pass'];
			$config['charset']    = 'utf-8';
			$config['mailtype'] = 'html'; // or html
			$config['validation'] = TRUE; // bool whether to validate email or not

			$this->email->initialize($config);

			// Envio correo comprobante
			$this->email->clear();
			$this->email->from($this->data['op']['mailer_user'], 'Abanico Siempre lo Mejor');
			$this->email->to($this->data['op']['correo_sitio']);


			$this->email->subject('Solicitud de Plan '.$this->data['plan']['PLAN_NOMBRE']);
			$this->email->message($mensaje_abanico);
			// envio el correo

			$this->email->send();

			$this->session->set_flashdata('exito', 'Plan activado');
			if($plan['PLAN_TIPO']=='productos'){
				redirect('usuario/tienda');
			}
			if($plan['PLAN_TIPO']=='servicios'){
				redirect('usuario/perfil_servicios');
			}

	}
	public function subir_comprobante()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		// Subo el archivo
		$nombre_archivo = 'pago-'.uniqid();
		$config['upload_path']          = 'contenido/adjuntos/pedidos';
		$config['allowed_types']        = 'pdf|jpg|png';
		$config['file_name']						=	$nombre_archivo;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('ArchivoPago')){
			$this->session->set_flashdata('alerta', 'No se pudo subir el archivo');
			redirect(base_url('usuario/tienda'));
		}else{
			$archivo = $this->upload->data('file_name');
			// Parametros del Servicio
			$parametros = array(
				'PAGO_ARCHIVO'=>$archivo,
				'FECHA_PAGO' => date('Y-m-d'),
				'PAGO_ESTADO'=> 'comprobante',
			);
		}
		// Actualizo el pago
		$this->PlanesModel->actualizar_pago_plan($this->input->post('IdPago'),$parametros);

		//
		$this->data['plan'] = $this->PlanesModel->detalles_usuario($_SESSION['usuario']['id']);
		$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
		$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
		$this->data['perfil_servidor'] = $this->PerfilServiciosModel->perfil_usuario($_SESSION['usuario']['id']);

		$this->data['info'] = array();
		if($plan['PLAN_TIPO']=='productos'){
			$this->data['info']['Titulo'] = 'Comprobante de pago de | '.$this->data['tienda']['TIENDA_NOMBRE'];
		}else{
			$this->data['info']['Titulo'] = 'Comprobante de pago de | '.$this->data['perfil_servidor']['PERFIL_NOMBRE'];
		}

		$this->data['info']['Nombre'] = 'Se ha subido un comprobante de pago para : '.$this->data['plan']['PLAN_NOMBRE'];
		$this->data['info']['Mensaje'] = '<p>Puedes revisar los detalles del plan en el administrador</p>';
		$this->data['info']['TextoBoton'] = 'Iniciar sesión';
		$this->data['info']['EnlaceBoton'] = base_url('admin/tiendas');
		// Pedido General
		$mensaje_abanico = $this->load->view('emails/mensaje_general',$this->data,true);

		// Envio correos Generales
		// Datos para enviar por correo
		// Config General

		$config['protocol']    = 'smtp';
		$config['smtp_host']    = $this->data['op']['mailer_host'];
		$config['smtp_port']    = $this->data['op']['mailer_port'];
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = $this->data['op']['mailer_user'];
		$config['smtp_pass']    = $this->data['op']['mailer_pass'];
		$config['charset']    = 'utf-8';
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not

		$this->email->initialize($config);

		// Envio correo comprobante
		$this->email->clear();
		$this->email->from($this->data['op']['mailer_user'], 'Abanico Siempre lo Mejor');
		$this->email->to($this->data['op']['correo_sitio']);


		$this->email->subject('Comprobante de pago '.$this->data['plan']['PLAN_NOMBRE']);
		$this->email->message($mensaje_abanico);
		// envio el correo

		$this->email->send();

		$this->session->set_flashdata('exito', 'Comprobante cargado correctamente');
		redirect(base_url($this->input->post('Origen')));
	}
	public function auto_renovar()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		$plan = $this->PlanesModel->detalles_usuario($_GET['id']);
		$this->session->set_flashdata('exito', 'Plan Actualizado');
		$this->PlanesModel->auto_renovar($_GET['id'],$_GET['estado']);

		if($plan['PLAN_TIPO']=='productos'){
			redirect('usuario/tienda');
		}
		if($plan['PLAN_TIPO']=='servicios'){
			redirect('usuario/perfil_servicios');
		}
	}
}
