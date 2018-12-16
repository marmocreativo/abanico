<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		// Variables defaults
			$this->data['primary'] = "-primary";

		if($this->agent->is_mobile()){
			$this->data['dispositivo'] = "mobile";
		}else{
			$this->data['dispositivo']  = "desktop";
		}
			// Cargo el modelo
		$this->load->model('UsuariosModel');
  }
	public function index()
	{
		if(verificar_sesion()){
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/panel_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}else{
			redirect(base_url('login'));
		}
	}


	public function registrar()
	{
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
				'USUARIO_TELEFONO' => $this->input->post('TelefonoUsuario'),
				'USUARIO_PASSWORD' => $pass,
				'USUARIO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'USUARIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'USUARIO_TIPO' => 'usr-1'
			);

			$usuario_id = $this->UsuariosModel->crear($parametros);
			redirect(base_url('login?mensaje=registro_correcto'));
		}else{
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/form_registro_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}


	public function actualizar()
	{
		// Obtengo los datos de usuario

		$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
		$this->form_validation->set_rules('NombreUsuario', 'Nombre', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('ApellidosUsuario', 'Apellidos', 'required', array('required' => 'Debes escribir tus %s.'));
		$this->form_validation->set_rules('CorreoUsuario', 'Correo Electrónico', 'required|valid_email', array(
			'required' => 'Debes escribir tu %s.',
			'valid_email' => 'Debes escribir una dirección de correo valida.',
			'is_unique' => 'La dirección de correo ya está registrada'
		));

		if($this->form_validation->run())
		{
			$parametros = array(
				'USUARIO_NOMBRE' => $this->input->post('NombreUsuario'),
				'USUARIO_APELLIDOS' => $this->input->post('ApellidosUsuario'),
				'USUARIO_CORREO' => $this->input->post('CorreoUsuario'),
				'USUARIO_TELEFONO' => $this->input->post('TelefonoUsuario'),
				'USUARIO_FECHA_NACIMIENTO' => $this->input->post('FechaNacimientoUsuario'),
				'USUARIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
			);

			$usuario_id = $this->UsuariosModel->actualizar($_SESSION['usuario']['id'],$parametros);
			redirect(base_url('usuario/actualizar?mensaje=actualizacion_correcta'));
		}else{
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/form_actualizar_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}
	public function pass()
	{
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
			echo $_SESSION['usuario']['correo'];
			echo $this->input->post('PassActualUsuario');
			if($this->AutenticacionModel->verificar_password($_SESSION['usuario']['correo'],$this->input->post('PassActualUsuario'))){
				$id = $_SESSION['usuario']['id'];
				$pass = password_hash($this->input->post('PassUsuario'), PASSWORD_DEFAULT);
				$parametros = array(
					'USUARIO_PASSWORD' => $pass
				);
				$this->AutenticacionModel->restaurar_pass($id,$parametros);
				redirect(base_url('usuario/pass?mensaje=pass_actualizado'));
			}else{
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
		$this->load->model('ProductosModel');
		$this->UsuariosModel->borrar($_SESSION['usuario']['id']);
		$this->ProductosModel->borrar_productos_usuario($_SESSION['usuario']['id']);
		redirect(base_url('login/cerrar'));

	// Login Form
	}
}
