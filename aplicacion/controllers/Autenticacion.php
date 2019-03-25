<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion extends CI_Controller {
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
		$this->load->model('AutenticacionModel');
  }

	/*
	Formulario de Login, si ya existe una sesión envío al perfil
	*/
	public function index()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			redirect(base_url('usuario'));
		}else{
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/login_form',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}
	/*
	Método  de Inicio de sesión
	*/
	public function iniciar()
	{
		// Valido el Formulario
		$this->form_validation->set_rules('CorreoUsuario', 'Correo Electrónico', 'required|valid_email', array( 'required' => 'Debes escribir tu %s.', 	'valid_email' => 'Debes escribir una dirección de correo valida.' ));
		$this->form_validation->set_rules('PassUsuario', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
    {
				$correo = $this->input->post('CorreoUsuario');
				$pass = $this->input->post('PassUsuario');
			// Verifico si el correo está registrado y si coincide la contraseña
			if( $this->AutenticacionModel->verificar_registro($correo) && $this->AutenticacionModel->verificar_password($correo, $pass) ){
				// Si todo está correcto inicio sesión
				$parametros = $this->AutenticacionModel->detalles($correo);
				if($parametros['USUARIO_ESTADO']!='activo'){
						// Mensaje de feedback
						$this->session->set_flashdata('alerta', 'Tu cuenta parece estar inactiva por favor contacta con nosotros.');
						// redirección
						redirect(base_url('login'));
				}else{
					iniciar_sesion($parametros);
					if(!null==$this->input->post('UrlRedirect') ){
						redirect($this->input->post('UrlRedirect'));
					}else{
						redirect(base_url('usuario'));
					}
				}
			}else{
				// Mensaje de feedback
				$this->session->set_flashdata('alerta', 'Tu correo y contraseña no coinciden');
				// redirección
					// Si no coinciden vuelvo a cargar el formulario
					redirect(base_url('login'));
			}
		}else{
			// Si el formulario no se verifica cargo de nuevo el Login
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/login_form',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}
	/*
	Método  para contraseña Olvidad
	*/
	public function olvide()
	{
	// verificar Permisos
	// Valido el Formulario
	$this->form_validation->set_rules('CorreoUsuario', 'Correo Electrónico', 'required|valid_email', array( 'required' => 'Debes escribir tu %s.', 	'valid_email' => 'Debes escribir una dirección de correo valida.' ));

	if($this->form_validation->run())
	{
			$correo = $this->input->post('CorreoUsuario');
			// Verifico si el correo está registrado y si coincide la contraseña
			if( $this->AutenticacionModel->verificar_registro($correo)){
				// Si todo está correcto inicio sesión
				$parametros = $this->AutenticacionModel->detalles($correo);


				// Datos para enviar por correo
				$this->data['info'] = array();
				$this->data['info']['NOMBRE'] = $parametros['USUARIO_NOMBRE'];
				$this->data['info']['ID'] = $parametros['ID_USUARIO'];
				$this->data['info']['CLAVE'] = $this->AutenticacionModel->crear_pin($parametros['ID_USUARIO']);

					$config['protocol']    = 'smtp';
	        $config['smtp_host']    = $this->data['op']['mailer_host'];
	        $config['smtp_port']    = $this->data['op']['mailer_port'];
	        $config['smtp_timeout'] = '7';
	        $config['smtp_user']    = $this->data['op']['mailer_user'];
	        $config['smtp_pass']    = $this->data['op']['mailer_pass'];
	        $config['charset']    = 'utf-8';
	        $config['mailtype'] = 'html'; // or html
	        $config['validation'] = TRUE; // bool whether to validate email or not

				$mensaje = $this->load->view('emails/olvido',$this->data,true);
				$this->email->initialize($config);

				$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
				$this->email->to($correo);

				$this->email->subject('Recupera tu contraseña');
				$this->email->message($mensaje);
				// envio el correo

				if($this->email->send()){
					// Mensaje de feedback
					$this->session->set_flashdata('exito', 'Encontramos tu cuenta, te hemos enviado un correo con un enlace seguro para recuperar tu contraseña');
					// redirección
					redirect(base_url('login'));
				}
			}else{
					// Si no coinciden vuelvo a cargar el formulario
					// Mensaje de feedback
					$this->session->set_flashdata('alerta', 'No encontramos ninguna cuenta con los datos que proporcionaste');
					// redirección
					redirect(base_url('login/olvide'));
			}
		}else{
			// Si el formulario no se verifica cargo de nuevo el Login
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/olvide_form',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}
	/*
	Método  de Inicio de sesión
	*/
	public function restaurar()
	{
		// valido que tenga las variables id y clave en el GET
		if(isset($_GET['id'])&&!empty($_GET['id'])&&isset($_GET['clave'])&&!empty($_GET['clave'])){

			$id = $_GET['id'];
			$clave = $_GET['clave'];


					// Solo si el PIN es válido verifico el formulario
					// Valido el Formulario
					$this->form_validation->set_rules('PassUsuario', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));
					$this->form_validation->set_rules('PassUsuarioConf', 'Contraseña Confirmación', 'required|matches[PassUsuario]', array(
						'required' => 'Debes confirmar la Contraseña',
						'matches' => 'La confirmación de la contraseña no coincide.'
					));

					if($this->form_validation->run())
			    {
						// Si el formulario es válido creo el HASH de la contraseña
						$pass = password_hash($this->input->post('PassUsuario'), PASSWORD_DEFAULT);
						$parametros = array(
							'USUARIO_PASSWORD' => $pass
			      );
						$this->AutenticacionModel->restaurar_pass($id,$parametros);
						$this->AutenticacionModel->desactivar_pin($id,$clave);
						// Mensaje de feedback
						$this->session->set_flashdata('exito', 'Tu contraseña ha sido restaurada correctamente');
						redirect(base_url('login'));
					}else{
						if($this->AutenticacionModel->verificar_pin($id,$clave)){
								// Si el formulario no se verifica cargo de nuevo el Login
								$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
								$this->load->view($this->data['dispositivo'].'/usuarios/restaurar_form',$this->data);
								$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
						}else{
							// Mensaje de feedback
							$this->session->set_flashdata('alerta', 'El enlace que utilizaste no es válido.');
							// SI el PIN no es valido regreso y mando error
							redirect(base_url('login'));
						}
					}

		}else{
			// Si no tengo las variables definidas redirecciono directo al Login
			$this->session->set_flashdata('alerta', 'El enlace que utilizaste no es válido.');
			redirect(base_url('login'));
		}
	}
	/*
	Método para cerrar sesión
	*/
	public function cerrar()
	{
	// Login Form
	session_destroy();
	$this->session->set_flashdata('exito', 'Sesión cerrada correctamente');
	redirect(base_url('login'));
	}
}
