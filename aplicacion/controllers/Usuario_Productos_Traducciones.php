<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Productos_Traducciones extends CI_Controller {
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
			$this->load->model('TiendasModel');
			$this->load->model('ProductosCombinacionesModel');
			$this->load->model('NotificacionesModel');
			$this->load->model('LenguajesModel');
			$this->load->model('TraduccionesModel');
  }

	public function index()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		// reviso si el usuario tiene una tienda
		$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
		if(!empty($this->data['tienda'])){
				$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
				$this->data['combinaciones'] = $this->ProductosCombinacionesModel->lista($_GET['id'],'','');
				$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/lista_traducciones_producto',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}else{
			// si ya existe una sesión activa redirijo con el siguiente mensaje
			$this->session->set_flashdata('advertencia', 'No puedes entrar al administrador de productos si no has creado una tienda');
			redirect(base_url('usuario/tienda'));
		}
	}
	public function lenguaje_default()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}

		// Defino el tipo de Categoria
		$this->form_validation->set_rules('ProductoLenguaje', 'Lenguaje por defecto', 'required', array( 'required' => 'Debes designar el %s'));

			if($this->form_validation->run())
			{
				// Parametros del producto
				$parametros = array(
					'LENGUAJE'=> $this->input->post('ProductoLenguaje'),
				);
				// Creo el Producto
				$producto_id = $this->ProductosModel->actualizar($this->input->post('IdProducto'),$parametros);

				// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Actualización correcta');
				// Redirecciono
				redirect(base_url('usuario/productos_traducciones?id='.$this->input->post('IdProducto')));
			}else{
				// reviso si el usuario tiene una tienda
				$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
				if(!empty($this->data['tienda'])){
						$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
						$this->data['combinacion'] = $this->ProductosCombinacionesModel->detalles($_GET['id']);
						$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');
						$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
						$this->load->view($this->data['dispositivo'].'/usuarios/form_actualizar_combinaciones',$this->data);
						$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
				}else{
					// si ya existe una sesión activa redirijo con el siguiente mensaje
					$this->session->set_flashdata('advertencia', 'No puedes entrar al administrador de productos si no has creado una tienda');
					redirect(base_url('usuario/tienda'));
				}
			}
}
	public function crear()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
			// Defino el tipo de Categoria
			$this->form_validation->set_rules('TraduccionTitulo', 'Título', 'required', array( 'required' => 'Se requiere que escribas el título %s'));

			if($this->form_validation->run())
			{
				// Parametros del producto
				$parametros = array(
					'ID_OBJETO'=> $this->input->post('IdObjeto'),
					'TIPO_OBJETO'=> $this->input->post('TipoObjeto'),
					'TITULO'=> $this->input->post('TraduccionTitulo'),
					'DESCRIPCION_CORTA'=> $this->input->post('TraduccionDescripcionCorta'),
					'DESCRIPCION_LARGA'=> $this->input->post('TraduccionDescripcionLarga'),
					'LENGUAJE'=> $this->input->post('Lenguaje'),
				);
				// Creo el Producto
				$producto_id = $this->TraduccionesModel->crear($parametros);

				// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Traducción creada');
				// Redirecciono
				redirect(base_url('usuario/productos_traducciones?id='.$this->input->post('IdObjeto')));
			}else{
				// reviso si el usuario tiene una tienda
				$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
				if(!empty($this->data['tienda'])){
						$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
						$this->data['combinaciones'] = $this->ProductosCombinacionesModel->lista($_GET['id'],'','');
						$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');
						$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
						$this->load->view($this->data['dispositivo'].'/usuarios/lista_combinaciones',$this->data);
						$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
				}else{
					// si ya existe una sesión activa redirijo con el siguiente mensaje
					$this->session->set_flashdata('advertencia', 'No puedes entrar al administrador de productos si no has creado una tienda');
					redirect(base_url('usuario/tienda'));
				}
			}
	}

		public function actualizar()
		{
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

			// Defino el tipo de Categoria
			$this->form_validation->set_rules('TraduccionTitulo', 'Título', 'required', array( 'required' => 'Se requiere que escribas el título %s'));

				if($this->form_validation->run())
				{
					// Parametros del producto
					$parametros = array(
						'ID_OBJETO'=> $this->input->post('IdObjeto'),
						'TIPO_OBJETO'=> $this->input->post('TipoObjeto'),
						'TITULO'=> $this->input->post('TraduccionTitulo'),
						'DESCRIPCION_CORTA'=> $this->input->post('TraduccionDescripcionCorta'),
						'DESCRIPCION_LARGA'=> $this->input->post('TraduccionDescripcionLarga'),
						'LENGUAJE'=> $this->input->post('Lenguaje'),
					);
					// Creo el Producto
					$producto_id = $this->TraduccionesModel->actualizar($this->input->post('IdTraduccion'),$parametros);

					// Mensaje Feedback
						$this->session->set_flashdata('exito', 'Actualización correcta');
					// Redirecciono
					redirect(base_url('usuario/productos_traducciones?id='.$this->input->post('IdObjeto')));
				}else{
					// reviso si el usuario tiene una tienda
					$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
					if(!empty($this->data['tienda'])){
							$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
							$this->data['combinacion'] = $this->ProductosCombinacionesModel->detalles($_GET['id']);
							$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');
							$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
							$this->load->view($this->data['dispositivo'].'/usuarios/form_actualizar_combinaciones',$this->data);
							$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
					}else{
						// si ya existe una sesión activa redirijo con el siguiente mensaje
						$this->session->set_flashdata('advertencia', 'No puedes entrar al administrador de productos si no has creado una tienda');
						redirect(base_url('usuario/tienda'));
					}
				}
	}
}
