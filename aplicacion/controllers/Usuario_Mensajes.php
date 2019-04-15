<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Mensajes extends CI_Controller {
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
			$this->load->model('ConversacionesModel');
			$this->load->model('ConversacionesMensajesModel');
			$this->load->model('NotificacionesModel');
  }

	public function index()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}
			if(isset($_GET['tipo'])){
				$this->data['conversaciones'] = $this->ConversacionesModel->lista_tipo($_SESSION['usuario']['id'],$_GET['tipo']);
			}else{
				$this->data['conversaciones'] = $this->ConversacionesModel->lista($_SESSION['usuario']['id']);
			}
				// Obtengo los datos de mi tiendas
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/lista_conversaciones',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}
	public function conversacion()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

			$this->form_validation->set_rules('MensajeTexto', 'Mensaje', 'required', array( 'required' => 'Debes enviar un mensaje %s'));

	 		if($this->form_validation->run())
	 		{
	 			// Conversación
	 			$parametros_conversacion = array(
	 				'CONVERSACION_FECHA_ACTUALIZACION'=> date('Y-m-d H:i:s'),
	 				'CONVERSACION_ESTADO'=>'respuesta'
	 			);
	 			$conversacion_id = $this->ConversacionesModel->actualizar($this->input->post('Identificador'),$parametros_conversacion);
				$datos_conversacion = $this->ConversacionesModel->detalles($this->input->post('Identificador'));
	 			// Mensaje
	 			$mensaje = $this->input->post('MensajeTexto');
	 			$parametros_mensaje = array(
	 				'ID_CONVERSACION'=>$this->input->post('Identificador'),
	 				'ID_REMITENTE'=>$this->input->post('IdUsuario'),
	 				'MENSAJE_TEXTO'=>$mensaje,
	 				'MENSAJE_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
					'MENSAJE_ESTADO_A'=>'no leido',
					'MENSAJE_ESTADO_B'=>'no leido'
	 			);
	 			$mensaje_id = $this->ConversacionesMensajesModel->crear($parametros_mensaje);

				if($datos_conversacion['ID_USUARIO_A']==$this->input->post('IdUsuario')){
					$datos_receptor = $this->UsuariosModel->detalles($datos_conversacion['ID_USUARIO_B']);
					$datos_remitente = $this->UsuariosModel->detalles($datos_conversacion['ID_USUARIO_A']);
				}
				if($datos_conversacion['ID_USUARIO_B']==$this->input->post('IdUsuario')){
					$datos_receptor = $this->UsuariosModel->detalles($datos_conversacion['ID_USUARIO_A']);
					$datos_remitente = $this->UsuariosModel->detalles($datos_conversacion['ID_USUARIO_B']);
				}
				// Datos para enviar por correo

	 				$config['protocol']    = 'smtp';
	 				$config['smtp_host']    = $this->data['op']['mailer_host'];
	 				$config['smtp_port']    = $this->data['op']['mailer_port'];
	 				$config['smtp_timeout'] = '7';
	 				$config['smtp_user']    = $this->data['op']['mailer_user'];
	 				$config['smtp_pass']    = $this->data['op']['mailer_pass'];
	 				$config['charset']    = 'utf-8';
	 				$config['mailtype'] = 'html'; // or html
	 				$config['validation'] = TRUE; // bool whether to validate email or not


	 			$this->data['info'] = array();
	 			$this->data['info']['Titulo'] = 'Conversando con:  '.$datos_remitente['USUARIO_NOMBRE'].' '.$datos_remitente['USUARIO_APELLIDOS'];
	 			$this->data['info']['Nombre'] = 'Puedes contestar a esta pregunta en tu panel de usuario';
	 			$this->data['info']['Mensaje'] = $mensaje;
	 			$this->data['info']['TextoBoton'] = 'Bandeja de entrada';
	 			$this->data['info']['EnlaceBoton'] = base_url('usuario/mensajes');

	 			$mensaje = $this->load->view('emails/mensaje_general',$this->data,true);
	 			$this->email->initialize($config);

	 			$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
	 			$this->email->to($datos_receptor['USUARIO_CORREO']);

	 			$this->email->subject('Conversación sobre: '.$datos_conversacion['CONVERSACION_TIPO']);
	 			$this->email->message($mensaje);
	 			$this->email->send();
	 			// Redirecciono
	 			redirect(base_url('usuario/mensajes/conversacion?id='.$this->input->post('Identificador')));
			}else{
				// Obtengo los datos de mi tiendas
				$this->data['conversacion'] = $this->ConversacionesModel->detalles($_GET['id']);
				$this->data['mensajes'] = $this->ConversacionesMensajesModel->lista_mensajes_conversacion($_GET['id']);
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/lista_mensajes',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
			}
	}
	public function enviados()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

				// Obtengo los datos de mi tiendas
				$this->data['conversaciones'] = $this->ConversacionesModel->lista_enviados($_SESSION['usuario']['id']);
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/lista_conversaciones',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}
}
