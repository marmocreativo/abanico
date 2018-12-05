<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();
		// Cargo El modelo
		$this->load->model('UsuariosModel');
		// Variables defaults
		$this->data['primary'] = "-secondary";
  }
	/*
	| -------------------------------------------------------------------------
	| Index
	| -------------------------------------------------------------------------
	*/
	public function index()
	{
		//Redirección al modo mantenimiento
		if($this->data['op']['modo_mantenimiento']=='no'){

			// Reviso si se está revisando desde un celular o desde Escritorio
			if($this->agent->is_mobile()){
				$dispositivo = "mobile";
			}else{
				$dispositivo = "desktop";
			}

			// Debo redireccionar
			if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){
				$this->load->view($dispositivo.'/usuarios/headers/header',$this->data);
				$this->load->view($dispositivo.'/usuarios/panel_usuario',$this->data);
				$this->load->view($dispositivo.'/usuarios/footers/footer',$this->data);
			}else{
				redirect(base_url('usuario/login_form'));
			}

		}else{
			$this->load->view('mantenimiento');
		}
	}
	/*
	| -------------------------------------------------------------------------
	| Login
	| -------------------------------------------------------------------------
	*/
	public function login_form()
	{
		//Redirección al modo mantenimiento
		if($this->data['op']['modo_mantenimiento']=='no'){

			// Reviso si se está revisando desde un celular o desde Escritorio
			if($this->agent->is_mobile()){
				$dispositivo = "mobile";
			}else{
				$dispositivo = "desktop";
			}

			// Debo redireccionar
			if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){
				redirect(base_url('usuario'));
			}else{

				$this->load->view($dispositivo.'/usuarios/headers/header',$this->data);
				$this->load->view($dispositivo.'/usuarios/login_form',$this->data);
				$this->load->view($dispositivo.'/usuarios/footers/footer',$this->data);
			}

		}else{
			$this->load->view('mantenimiento');
		}
	}
	/*
	| -------------------------------------------------------------------------
	| Formulario Registro
	| -------------------------------------------------------------------------
	*/
	public function registro_form()
	{
		//Redirección al modo mantenimiento
		if($this->data['op']['modo_mantenimiento']=='no'){

			// Reviso si se está revisando desde un celular o desde Escritorio
			if($this->agent->is_mobile()){
				$dispositivo = "mobile";
			}else{
				$dispositivo = "desktop";
			}

			// Debo redireccionar
			if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){
				redirect(base_url('usuario'));
			}else{

				$this->load->view($dispositivo.'/usuarios/headers/header',$this->data);
				$this->load->view($dispositivo.'/usuarios/registro_form',$this->data);
				$this->load->view($dispositivo.'/usuarios/footers/footer',$this->data);
			}

		}else{
			$this->load->view('mantenimiento');
		}
	}
	/*
	| -------------------------------------------------------------------------
	| Registrar
	| -------------------------------------------------------------------------
	*/
	public function registrar()
   {
			if($this->data['op']['modo_mantenimiento']=='no'){

				// Reviso si se está revisando desde un celular o desde Escritorio
				if($this->agent->is_mobile()){
					$dispositivo = "mobile";
				}else{
					$dispositivo = "desktop";
				}

				// Valido el Formulario
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
				$this->form_validation->set_rules('TerminosyCondiciones', 'Terminos y Condiciones', 'required', array('required' => 'Debes aceptar los %s.'));

				// Compruebo la verificación de los formularios
				if ($this->form_validation->run() == FALSE){
					// El formulario no es validado vuelvo a cargar el formulario
					$this->load->view($dispositivo.'/usuarios/headers/header',$this->data);
					$this->load->view($dispositivo.'/usuarios/registro_form',$this->data);
					$this->load->view($dispositivo.'/usuarios/footers/footer',$this->data);
	      } else {
					// El formulario si es validado creo un usuario unico
					$id_usuario = uniqid('', true);
					$usuario=new UsuariosModel;
					if(!$usuario->id_usuario_existe($id_usuario)){
						$id_usuario = uniqid('', true);
					}
					// Inserto los registros

					$usuario->registrar($id_usuario,'usr-1');

					redirect(base_url('usuario/login_form?mensaje=registro_correcto'));
	      }

			}else{
				$this->load->view('mantenimiento');
			}
    }
		/*
		| -------------------------------------------------------------------------
		| datos_usuario
		| -------------------------------------------------------------------------
		*/
		public function datos_usuario()
		{
			//Redirección al modo mantenimiento
			if($this->data['op']['modo_mantenimiento']=='no'){

				// Reviso si se está revisando desde un celular o desde Escritorio
				if($this->agent->is_mobile()){
					$dispositivo = "mobile";
				}else{
					$dispositivo = "desktop";
				}

				// Debo redireccionar
				if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){
					$this->load->view($dispositivo.'/usuarios/headers/header',$this->data);
					$this->load->view($dispositivo.'/usuarios/panel_usuario',$this->data);
					$this->load->view($dispositivo.'/usuarios/footers/footer',$this->data);
				}else{
					redirect(base_url('usuario/login_form'));
				}

			}else{
				$this->load->view('mantenimiento');
			}
		}
		/*
		| -------------------------------------------------------------------------
		| Iniciar Sesión
		| -------------------------------------------------------------------------
		*/
		public function iniciar_sesion()
		{
			//Redirección al modo mantenimiento
			if($this->data['op']['modo_mantenimiento']=='no'){

				// Reviso si se está revisando desde un celular o desde Escritorio
				if($this->agent->is_mobile()){
					$dispositivo = "mobile";
				}else{
					$dispositivo = "desktop";
				}

				// Verifico formulario
				$this->form_validation->set_rules('CorreoUsuario', 'Correo Electrónico', 'required|valid_email', array(
					'required' => 'Debes escribir tu %s.',
					'valid_email' => 'Debes escribir una dirección de correo valida.',
					'is_unique' => 'La dirección de correo ya está registrada'
				));
				$this->form_validation->set_rules('PassUsuario', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));

				// Compruebo Validación del formulario
				if ($this->form_validation->run() == FALSE){
					// El formulario no es validado vuelvo a cargar el formulario
					$this->load->view($dispositivo.'/usuarios/headers/header',$this->data);
					$this->load->view($dispositivo.'/usuarios/login_form',$this->data);
					$this->load->view($dispositivo.'/usuarios/footers/footer',$this->data);
	      } else {
					// El formulario si es validado verifico Identidad
					$correo = $this->input->post('CorreoUsuario');
					$pass = $this->input->post('PassUsuario');
					$usuario=new UsuariosModel;
					if($usuario->varifico_usuario_pass($correo,$pass)){
						$usuario->inicio_sesion($correo);
						redirect(base_url('usuario/index'));
					}else{
						redirect(base_url('usuario/login_form?mensaje=error_login'));
					}
	      }

			}else{
				$this->load->view('mantenimiento');
			}
		}
		/*
		| -------------------------------------------------------------------------
		| Formulario Registro
		| -------------------------------------------------------------------------
		*/
		public function cerrar_sesion()
		{
			session_destroy();
			redirect(base_url('usuario/login_form?mensaje=sesion_cerrada'));
		}
		/*
		| -------------------------------------------------------------------------
		| Tienda
		| -------------------------------------------------------------------------
		*/
		public function tienda()
		{
			//Redirección al modo mantenimiento
			if($this->data['op']['modo_mantenimiento']=='no'){

				// Obtengo los datos de mi tiendas
				$this->data['tienda'] = $this->UsuariosModel->get_tienda_usuario($_SESSION['usuario']['id']);


				// Reviso si se está revisando desde un celular o desde Escritorio
				if($this->agent->is_mobile()){
					$dispositivo = "mobile";
				}else{
					$dispositivo = "desktop";
				}
				// Debo redireccionar
				if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){

					// reviso si el usuario ya tiene tienda
					if(empty($this->data['tienda'])){
						$formulario = "tienda_usuario";
					}else{
						$formulario = "vista_tienda";
						$this->data['productos'] = $this->UsuariosModel->get_productos($_SESSION['usuario']['id']);
					}
					$this->load->view($dispositivo.'/usuarios/headers/header',$this->data);
					$this->load->view($dispositivo.'/usuarios/'.$formulario,$this->data);
					$this->load->view($dispositivo.'/usuarios/footers/footer',$this->data);
				}else{
					redirect(base_url('usuario/login_form'));
				}

			}else{
				$this->load->view('mantenimiento');
			}
		}
		/*
		| -------------------------------------------------------------------------
		| Actualizar Tienda
		| -------------------------------------------------------------------------
		*/
		public function actualizar_tienda()
		{
			//$this->form_validation->set_rules('PassUsuario', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));
			$usuario=new UsuariosModel;
			$id_tienda = "";
			$usuario->actualizar_tienda_usuario($id_tienda);
			redirect(base_url('usuario/tienda'));
		}
		/*
		| -------------------------------------------------------------------------
		| Formulario creación Producto
		| -------------------------------------------------------------------------
		*/
		public function producto_form()
		{
			//Redirección al modo mantenimiento
			if($this->data['op']['modo_mantenimiento']=='no'){

				// Obtengo los datos de mi tiendas
				$this->data['tienda'] = $this->UsuariosModel->get_tienda_usuario($_SESSION['usuario']['id']);


				// Reviso si se está revisando desde un celular o desde Escritorio
				if($this->agent->is_mobile()){
					$dispositivo = "mobile";
				}else{
					$dispositivo = "desktop";
				}
				// Debo redireccionar
				if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){
					$this->load->view($dispositivo.'/usuarios/headers/header',$this->data);
					$this->load->view($dispositivo.'/usuarios/producto_form',$this->data);
					$this->load->view($dispositivo.'/usuarios/footers/footer',$this->data);
				}else{
					redirect(base_url('usuario/login_form'));
				}

			}else{
				$this->load->view('mantenimiento');
			}
		}
		/*
		| -------------------------------------------------------------------------
		| Crear Producto
		| -------------------------------------------------------------------------
		*/
		public function crear_producto()
	   {
				if($this->data['op']['modo_mantenimiento']=='no'){

					// Reviso si se está revisando desde un celular o desde Escritorio
					if($this->agent->is_mobile()){
						$dispositivo = "mobile";
					}else{
						$dispositivo = "desktop";
					}
						// El formulario si es validado creo un usuario unico
						$usuario=new UsuariosModel;
						// Inserto los registros

						$usuario->crear_producto($_SESSION['usuario']['id']);

						$this->load->view($dispositivo.'/usuarios/headers/header',$this->data);
						$this->load->view($dispositivo.'/usuarios/registro_exitoso',$this->data);
						$this->load->view($dispositivo.'/usuarios/footers/footer',$this->data);


				}else{
					$this->load->view('mantenimiento');
				}
	    }
		/*
		| -------------------------------------------------------------------------
		| Borrar Producto
		| -------------------------------------------------------------------------
		*/
		public function borrar_producto()
	   {
				if($this->data['op']['modo_mantenimiento']=='no'){

					// Reviso si se está revisando desde un celular o desde Escritorio
					if($this->agent->is_mobile()){
						$dispositivo = "mobile";
					}else{
						$dispositivo = "desktop";
					}
						// El formulario si es validado creo un usuario unico
						$usuario=new UsuariosModel;
						// Inserto los registros

						$usuario->borrar_producto($_GET['id']);

						redirect(base_url('usuario/tienda'));


				}else{
					$this->load->view('mantenimiento');
				}
	    }
}
