<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Perfil extends CI_Controller {
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

			$this->load->model('UsuariosModel');
			$this->load->model('TiendasModel');
			$this->load->model('ProductosModel');
			$this->load->model('GaleriasModel');
			$this->load->model('PerfilServiciosModel');
			$this->load->model('ServiciosModel');
			$this->load->model('GaleriasServiciosModel');
			$this->load->model('CategoriasModel');
			$this->load->model('CategoriasProductoModel');
			$this->load->model('DireccionesModel');
			$this->load->model('PedidosModel');
			$this->load->model('ConversacionesModel');
			$this->load->model('ConversacionesMensajesModel');
			$this->load->model('NotificacionesModel');
  }
	public function index()
	{
		/*
		+ Permisos de sesión
		*/

		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}

			$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
			$this->data['perfil'] = $this->PerfilServiciosModel->perfil_usuario($_SESSION['usuario']['id']);
			$this->data['conteo_productos'] = $this->ProductosModel->conteo_productos_usuario($_SESSION['usuario']['id']);
			$this->data['conteo_servicios'] = $this->ServiciosModel->conteo_servicios_usuario($_SESSION['usuario']['id']);
			$this->data['conteo_pedidos'] = $this->PedidosModel->conteo_pedidos_usuario($_SESSION['usuario']['id']);
			$this->data['conteo_mensajes'] = $this->ConversacionesModel->conteo_conversaciones_usuario($_SESSION['usuario']['id']);
			$this->data['no_leidos'] = $this->ConversacionesModel->conteo_conversaciones_no_leidas_usuario($_SESSION['usuario']['id']);
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/panel_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}


	public function registrar()
	{
		/*
		+ Permisos de sesión
		*/
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			// si ya existe una sesión activa redirijo con el siguiente mensaje
			$this->session->set_flashdata('mensaje', 'No puedes registrar un usuario si ya iniciaste sesión');
			redirect(base_url('usuario'));
		}

		/*
		+ Validación de formulario
		*/

		$this->form_validation->set_rules('NombreUsuario', 'Nombre', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('ApellidosUsuario', 'Apellidos', 'required', array('required' => 'Debes escribir tus %s.'));
		$this->form_validation->set_rules('CorreoUsuario', 'Correo Electrónico', 'required|valid_email|is_unique[usuarios.USUARIO_CORREO]', array(
			'required' => 'Debes escribir tu %s.',
			'valid_email' => 'Debes escribir una dirección de correo valida.',
			'is_unique' => 'La dirección de correo ya está registrada'
		));
		$this->form_validation->set_rules('PassUsuario', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('PassUsuarioConf', 'Contraseña Confirmación', 'required|matches[PassUsuario]', array(
			'required' => 'Debes confirmar la Contraseña',
			'matches' => 'La confirmación de la contraseña no coincide.'
		));

		if($this->form_validation->run())
		{
			/*
			+ Éxito de validación de formulario
			*/
			// Creo el identificador Único
			$id_usuario = uniqid('', true);
			if(!$this->UsuariosModel->id_usuario_existe($id_usuario)){
				$id_usuario = uniqid('', true);
			}
			// Creo la contraseña

			$pass = password_hash($this->input->post('PassUsuario'), PASSWORD_DEFAULT);

			if($this->input->post('PrimerContacto')!='otro'){
				$primer_contacto = $this->input->post('PrimerContacto');
			}else{
				$primer_contacto = $this->input->post('OtroContacto');
			}

			$parametros = array(
				'ID_USUARIO' => $id_usuario,
				'USUARIO_NOMBRE' => $this->input->post('NombreUsuario'),
				'USUARIO_APELLIDOS' => $this->input->post('ApellidosUsuario'),
				'USUARIO_CORREO' => $this->input->post('CorreoUsuario'),
				'USUARIO_TELEFONO' => $this->input->post('TelefonoUsuario'),
				'USUARIO_PASSWORD' => $pass,
				'USUARIO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'USUARIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'USUARIO_PRIMER_CONTACTO' => $primer_contacto,
				'USUARIO_TIPO' => 'usr-1'
			);

			$usuario_id = $this->UsuariosModel->crear($parametros);

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
			$this->data['info']['Titulo'] = 'Bienvenido a Abanico';
			$this->data['info']['Nombre'] = $this->input->post('NombreUsuario').' '.$this->input->post('ApellidosUsuario');
			$this->data['info']['Mensaje'] = '<p>Tu registro con nosotros está completo, ahora podrás comprar y administrar tus datos iniciando sesión y entrando a tu perfil.</p>';
			$this->data['info']['TextoBoton'] = 'Iniciar sesión';
			$this->data['info']['EnlaceBoton'] = base_url('login');

			$mensaje = $this->load->view('emails/mensaje_general',$this->data,true);
			$this->email->initialize($config);

			$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
			$this->email->to($this->input->post('CorreoUsuario'));

			$this->email->subject('Bienvenido a Abanico');
			$this->email->message($mensaje);
			// envio el correo

			$this->email->send();

			$this->session->set_flashdata('exito', 'Tu registro se completó correctamente, ahora puedes iniciar sesión');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}else{
			/*
			+ Sin validación de formulario
			*/
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/form_registro_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}


	public function actualizar()
	{
		/*
		+ Permisos de sesión
		*/
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			// Creo el mensaje y redirecciono si la sesión no estpa activada
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}

		$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
		$this->form_validation->set_rules('NombreUsuario', 'Nombre', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('ApellidosUsuario', 'Apellidos', 'required', array('required' => 'Debes escribir tus %s.'));
		$this->form_validation->set_rules('CorreoUsuario', 'Correo Electrónico', 'required|valid_email', array(
			'required' => 'Debes escribir tu %s.',
			'valid_email' => 'Debes escribir una dirección de correo valida.',
			'is_unique' => 'La dirección de correo ya está registrada'
		));
		// reviso si está marcada la casilla de lista de correo
		if(!null==$this->input->post('ListaDeCorreoUsuario')){ $lista_correo = 'si'; }else{ $lista_correo = 'no'; }

		if($this->form_validation->run())
		{
			$parametros = array(
				'USUARIO_NOMBRE' => $this->input->post('NombreUsuario'),
				'USUARIO_APELLIDOS' => $this->input->post('ApellidosUsuario'),
				'USUARIO_CORREO' => $this->input->post('CorreoUsuario'),
				'USUARIO_TELEFONO' => $this->input->post('TelefonoUsuario'),
				'USUARIO_LISTA_DE_CORREO' => $lista_correo,
				'USUARIO_FECHA_NACIMIENTO' => $this->input->post('FechaNacimientoUsuario'),
				'USUARIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
			);

			$usuario_id = $this->UsuariosModel->actualizar($_SESSION['usuario']['id'],$parametros);
			$this->session->set_flashdata('exito', 'Perfil actualizado');
			redirect(base_url('usuario/actualizar'));
		}else{
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/form_actualizar_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}
	public function pass()
	{
		/*
		+ Permisos de sesión
		*/
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			// si ya existe una sesión activa redirijo con el siguiente mensaje
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('usuario'));
		}
		// Obtengo los datos de usuario

		$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
		$this->form_validation->set_rules('PassActualUsuario', 'Contraseña Actual', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('PassUsuario', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('PassUsuarioConf', 'Contraseña Confirmación', 'required|matches[PassUsuario]', array(
			'required' => 'Debes confirmar la Contraseña',
			'matches' => 'La confirmación de la contraseña no coincide.'
		));

		if($this->form_validation->run())
		{
			$this->load->model('AutenticacionModel');
			if($this->AutenticacionModel->verificar_password($_SESSION['usuario']['correo'],$this->input->post('PassActualUsuario'))){
				$id = $_SESSION['usuario']['id'];
				$pass = password_hash($this->input->post('PassUsuario'), PASSWORD_DEFAULT);
				$parametros = array(
					'USUARIO_PASSWORD' => $pass
				);
				$this->AutenticacionModel->restaurar_pass($id,$parametros);
				$this->session->set_flashdata('exito', 'Contraseña Actualizada');
				redirect(base_url('usuario/pass?mensaje=pass_actualizado'));
			}else{
				$this->session->set_flashdata('alerta', 'Tu contraseña actual es incorrecta');
				redirect(base_url('usuario/pass?mensaje=pass_incorrecto'));
			}
			//$usuario_id = $this->UsuariosModel->actualizar($_SESSION['usuario']['id'],$parametros);
			//
		}else{
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/form_actualizar_pass',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}
	public function borrar()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		$this->load->model('ProductosModel');
		$this->UsuariosModel->borrar($_SESSION['usuario']['id']);
		$this->ProductosModel->desactivar_productos_usuario($_SESSION['usuario']['id']);
		// cargo la retroalimentación
		$this->session->set_flashdata('exito', 'Tu cuenta ha sido borrada correctamente');
		redirect(base_url('login/cerrar'));
	}
}
