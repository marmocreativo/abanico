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
			$this->load->model('PlanesModel');
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

			$this->session->set_flashdata('exito', 'Gracias por registrarte. Ya podrás participar en nuestro concurso.');
			redirect(base_url('login?url_redirect='.base_url('categoria')));
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

			/*
			+ REGISTRO DE USUARIO
			*/
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

			$this->UsuariosModel->crear($parametros);
			/*
			+ REGISTRO DE TIENDA
			*/

			$parametros = array(
				'ID_USUARIO' => $id_usuario,
				'TIENDA_NOMBRE' => $this->input->post('NombreTienda'),
				'TIENDA_TELEFONO' => $this->input->post('TelefonoTienda'),
				'TIENDA_IMAGEN' => 'default.jpg',
				'TIENDA_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'TIENDA_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'TIENDA_TIPO' => $this->input->post('TipoTienda'),
				'TIENDA_ESTADO' => 'activo'
			);
			// Registro la Tienda
			$tienda_id = $this->TiendasModel->crear($parametros);

			/*
			+ REGISTRO DE PLAN
			*/

			$plan = $this->PlanesModel->detalles($this->input->post('IdPlan'));

			$parametros = array(
				'ID_PLAN'=>$plan['ID_PLAN'],
				'ID_USUARIO'=>$id_usuario,
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
			$this->data['info']['Titulo'] = 'Registro vendedor y plan | Abanico';
			$this->data['info']['Nombre'] = $this->input->post('NombreUsuario').' '.$this->input->post('ApellidosUsuario');
			$this->data['info']['Mensaje'] = '<p>Tu registro con nosotros está completo, dentro de poco nos comunicaremos contigo para el último paso de activación de plan</p>';
			$this->data['info']['Mensaje'] .= '<h5>Tienda: <small>'.$this->input->post('NombreTienda').'</small></h5>';
			$this->data['info']['Mensaje'] .= '<h5>Plan: <small>'.$plan['PLAN_NOMBRE'].'</small></h5>';
			$this->data['info']['TextoBoton'] = 'Iniciar sesión';
			$this->data['info']['EnlaceBoton'] = base_url('login');

			$mensaje = $this->load->view('emails/mensaje_general',$this->data,true);
			$this->email->initialize($config);

			$this->email->clear();
			$this->email->from($this->data['op']['mailer_user'], 'Abanico Siempre lo Mejor');
			$this->email->to($this->input->post('CorreoUsuario'));

			$this->email->subject('Registro vendedor y plan | '.$this->input->post('NombreTienda'));
			$this->email->message($mensaje);
				$this->email->send();


				$this->email->clear();
			$this->email->from($this->data['op']['mailer_user'], 'Abanico Siempre lo Mejor');
			$this->email->to($this->data['op']['correo_sitio']);

			$this->email->subject('Registro vendedor y plan | '.$this->input->post('NombreTienda'));
			$this->email->message($mensaje);
			// envio el correo

			$this->email->send();

			$this->session->set_flashdata('exito', 'Gracias por registrarte, nos comunicaremos contigo para los últimos detalles de la activación. Recuerda que ya puedes participar en nuestro concurso.');
			redirect(base_url('usuario/registro_rapido/gracias'));
		}else{
			/*
			+ Sin validación de formulario
			*/

			$this->data['planes'] = $this->PlanesModel->lista(['PLAN_TIPO'=>'productos']);
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/form_registro_rapido_tienda',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}

	}

	public function registro_perfil()
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

			/*
			+ REGISTRO DE USUARIO
			*/
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

			$this->UsuariosModel->crear($parametros);
			/*
			+ REGISTRO DE PERFIL
			*/
			$parametros = array(
				'ID_USUARIO' => $id_usuario,
				'PERFIL_NOMBRE' => $this->input->post('NombrePerfil'),
				'PERFIL_TELEFONO' => $this->input->post('TelefonoPerfil'),
				'PERFIL_IMAGEN' => 'default.jpg',
				'PERFIL_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'PERFIL_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'PERFIL_ESTADO' => 'activo'
			);
			// Registro la Perfil
			$perfil_servicios_id = $this->PerfilServiciosModel->crear($parametros);


			/*
			+ REGISTRO DE PLAN
			*/

			$plan = $this->PlanesModel->detalles($this->input->post('IdPlan'));

			$parametros = array(
				'ID_PLAN'=>$plan['ID_PLAN'],
				'ID_USUARIO'=>$id_usuario,
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
			$this->data['info']['Titulo'] = 'Registro perfil de servicios y plan | Abanico';
			$this->data['info']['Nombre'] = $this->input->post('NombreUsuario').' '.$this->input->post('ApellidosUsuario');
			$this->data['info']['Mensaje'] = '<p>Tu registro con nosotros está completo, dentro de poco nos comunicaremos contigo para el último paso de activación de plan</p>';
			$this->data['info']['Mensaje'] .= '<h5>Tienda: <small>'.$this->input->post('NombreTienda').'</small></h5>';
			$this->data['info']['Mensaje'] .= '<h5>Plan: <small>'.$plan['PLAN_NOMBRE'].'</small></h5>';
			$this->data['info']['TextoBoton'] = 'Iniciar sesión';
			$this->data['info']['EnlaceBoton'] = base_url('login');

			$mensaje = $this->load->view('emails/mensaje_general',$this->data,true);
			$this->email->initialize($config);

			$this->email->clear();
			$this->email->from($this->data['op']['mailer_user'], 'Abanico Siempre lo Mejor');
			$this->email->to($this->input->post('CorreoUsuario'));

			$this->email->subject('Registro vendedor y plan | '.$this->input->post('NombrePerfil'));
			$this->email->message($mensaje);
				$this->email->send();


				$this->email->clear();
			$this->email->from($this->data['op']['mailer_user'], 'Abanico Siempre lo Mejor');
			$this->email->to($this->data['op']['correo_sitio']);

			$this->email->subject('Registro perfil de servicios y plan | '.$this->input->post('NombrePerfil'));
			$this->email->message($mensaje);
			// envio el correo

			$this->email->send();

			$this->session->set_flashdata('exito', 'Gracias por registrarte, nos comunicaremos contigo para los últimos detalles de la activación. Recuerda que ya puedes participar en nuestro concurso.');
			redirect(base_url('usuario/registro_rapido/gracias'));
		}else{
			/*
			+ Sin validación de formulario
			*/

			$this->data['planes'] = $this->PlanesModel->lista(['PLAN_TIPO'=>'servicios']);
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/form_registro_rapido_perfil',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}

	}


	public function gracias()
	{
		$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
		$this->load->view($this->data['dispositivo'].'/usuarios/gracias_registro',$this->data);
		$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}

}
