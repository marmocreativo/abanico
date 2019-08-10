<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Registros_Rapidos extends CI_Controller {
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
	public function registro_usuario()
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


			$parametros = array(
				'ID_USUARIO' => $id_usuario,
				'USUARIO_NOMBRE' => $this->input->post('NombreUsuario'),
				'USUARIO_APELLIDOS' => $this->input->post('ApellidosUsuario'),
				'USUARIO_CORREO' => $this->input->post('CorreoUsuario'),
				'USUARIO_PASSWORD' => $pass,
				'USUARIO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'USUARIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
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

			$this->session->set_flashdata('exito', 'Gracias por registrarte, ya podrás participar en nuestro concurso, no olvides iniciar sesión');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}else{
			/*
			+ Sin validación de formulario
			*/
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/form_registro_rapido_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}

	}

	public function registro_tienda()
	{

	}

	public function registro_perfil()
	{

	}

	public function gracias_usuario()
	{

	}

	public function gracias_perfil()
	{

	}

}
