<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Productos_Combinaciones extends CI_Controller {
	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();
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
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/lista_combinaciones',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}else{
			// si ya existe una sesión activa redirijo con el siguiente mensaje
			$this->session->set_flashdata('advertencia', 'No puedes entrar al administrador de productos si no has creado una tienda');
			redirect(base_url('usuario/tienda'));
		}
	}
	public function crear()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
			// Defino el tipo de Categoria
			$this->form_validation->set_rules('GrupoCombinacion', 'Grupo', 'required', array( 'required' => 'Debes designar el %s'));
			$this->form_validation->set_rules('OpcionCombinacion', 'Opcion', 'required', array( 'required' => 'Debes designar la %s'));

			if($this->form_validation->run())
			{
				// Parametros del producto
				$parametros = array(
					'ID_PRODUCTO'=> $this->input->post('IdProducto'),
					'COMBINACION_GRUPO'=> $this->input->post('GrupoCombinacion'),
					'COMBINACION_OPCION'=> $this->input->post('OpcionCombinacion'),
					'COMBINACION_PRECIO'=> $this->input->post('PrecioCombinacion'),
					'COMBINACION_ANCHO'=> $this->input->post('AnchoCombinacion'),
					'COMBINACION_ALTO'=> $this->input->post('AltoCombinacion'),
					'COMBINACION_PROFUNDO'=> $this->input->post('ProfundoCombinacion'),
					'COMBINACION_PESO'=> $this->input->post('PesoCombinacion'),
				);
				// Creo el Producto
				$producto_id = $this->ProductosCombinacionesModel->crear($parametros);

				// Mensaje Retroalimentación
				$this->session->set_flashdata('exito', 'Combinación Creada!');
				// Redirección
				redirect(base_url('usuario/productos_combinaciones?id='.$this->input->post('IdProducto')));
			}else{
				// reviso si el usuario tiene una tienda
				$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
				if(!empty($this->data['tienda'])){
						$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
						$this->data['combinaciones'] = $this->ProductosCombinacionesModel->lista($_GET['id'],'','');
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
			$this->form_validation->set_rules('GrupoCombinacion', 'Grupo', 'required', array( 'required' => 'Debes designar el %s'));
			$this->form_validation->set_rules('OpcionCombinacion', 'Opcion', 'required', array( 'required' => 'Debes designar la %s'));

				if($this->form_validation->run())
				{
					// Parametros del producto
					$parametros = array(
						'ID_PRODUCTO'=> $this->input->post('IdProducto'),
						'COMBINACION_GRUPO'=> $this->input->post('GrupoCombinacion'),
						'COMBINACION_OPCION'=> $this->input->post('OpcionCombinacion'),
						'COMBINACION_PRECIO'=> $this->input->post('PrecioCombinacion'),
						'COMBINACION_ANCHO'=> $this->input->post('AnchoCombinacion'),
						'COMBINACION_ALTO'=> $this->input->post('AltoCombinacion'),
						'COMBINACION_PROFUNDO'=> $this->input->post('ProfundoCombinacion'),
						'COMBINACION_PESO'=> $this->input->post('PesoCombinacion'),
					);
					// Creo el Producto
					$producto_id = $this->ProductosCombinacionesModel->actualizar($this->input->post('Identificador'),$parametros);

					// Mensaje Feedback
						$this->session->set_flashdata('exito', 'Actualización correcta');
					// Redirecciono
					redirect(base_url('usuario/productos_combinaciones?id='.$this->input->post('IdProducto')));
				}else{
					// reviso si el usuario tiene una tienda
					$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
					if(!empty($this->data['tienda'])){
							$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
							$this->data['combinacion'] = $this->ProductosCombinacionesModel->detalles($_GET['id']);
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


		public function borrar()
		{
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}
			$combinacion = $this->ProductosCombinacionesModel->detalles($_GET['id']);

	        // check if the institucione exists before trying to delete it
	        if(isset($combinacion['ID_COMBINACION']))
	        {
							$this->ProductosCombinacionesModel->borrar($_GET['id']);
	            redirect(base_url('usuario/productos_combinaciones?id='.$combinacion['ID_PRODUCTO']));
	        } else {

		         	show_error('La entrada que deseas borrar no existe');
					}
		}
}
