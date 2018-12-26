<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Servicios extends CI_Controller {
	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();
		// Variables defaults
			$this->data['primary'] = "-primary";

		if($this->agent->is_mobile()){
			$this->data['dispositivo'] = "mobile";
		}else{
			$this->data['dispositivo']  = "desktop";
		}
			// Cargo el modelo
			$this->load->model('ServiciosModel');
			$this->load->model('UsuariosModel');
			$this->load->model('GaleriasServiciosModel');
			$this->load->model('CategoriasModel');
			$this->load->model('CategoriasServiciosModel');
			$this->load->model('TiendasModel');
			$this->load->model('DireccionesModel');
  }

	public function index()
	{
		if(verificar_sesion()){
			$this->data['servicios'] = $this->ServiciosModel->lista('',$_SESSION['usuario']['id'],'','');
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/lista_servicios',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}else{
			redirect(base_url('login'));
		}
	}
	public function crear()
	{
		if(verificar_sesion()){
			// Defino el tipo de Categoria
			$tipo_categoria = 'servicios';

			$this->form_validation->set_rules('NombreServicio', 'Nombre del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
			$this->form_validation->set_rules('DescripcionServicio', 'Descripcion del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
			$this->form_validation->set_rules('PaisDireccion', 'País del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
			$this->form_validation->set_rules('EstadoDireccion', 'Estado del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
			$this->form_validation->set_rules('MunicipioDireccion', 'Municipio del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
			$this->form_validation->set_rules('TerminosyCondiciones', 'Términos y condiciones', 'required', array('required' => 'Debes aceptar los %s.'));

			if($this->form_validation->run())
			{
				// Parametros del Servicio
				$parametros = array(
					'ID_USUARIO'=> $this->input->post('IdUsuario'),
					'USUARIO_NOMBRE'=> $this->input->post('NombreUsuario'),
					'SERVICIO_NOMBRE'=> $this->input->post('NombreServicio'),
					'SERVICIO_DESCRIPCION'=> $this->input->post('DescripcionServicio'),
					'SERVICIO_DETALLES'=> $this->input->post('DetallesServicio'),
					'SERVICIO_PAIS'=> $this->input->post('PaisDireccion'),
					'SERVICIO_ESTADO_DIR'=> $this->input->post('EstadoDireccion'),
					'SERVICIO_MUNICIPIO'=> $this->input->post('MunicipioDireccion'),
					'SERVICIO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
					'SERVICIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
					'SERVICIO_FECHA_PUBLICACION' => date('Y-m-d H:i:s'),
					'SERVICIO_TIPO'=> 'profesional',
					'SERVICIO_ESTADO'=> 'pendiente',
					'ORDEN'=> '1'
	      );
				// Creo el Servicio
				$servicio_id = $this->ServiciosModel->crear($parametros);

				// Reviso si llegó Imagen
				if(!empty($_FILES['ImagenServicio']['name'])){

					$archivo = $_FILES['ImagenServicio']['tmp_name'];
					$ancho = $this->data['op']['ancho_imagenes_servicios'];
					$alto = $this->data['op']['alto_imagenes_servicios'];
					$calidad = 80;
					$nombre = 'Servicio-'.uniqid();
					$destino = $this->data['op']['ruta_imagenes_servicios'].'completo/';
					// Subo la imagen y obtengo el nombre Default si va vacía
					$imagen = subir_imagen_abanico($archivo,$ancho,$alto,$calidad,$nombre,$destino);
					// Cargo la imagen
					$parametros_galeria = array(
						'ID_SERVICIO'=>$servicio_id,
						'GALERIA_ARCHIVO'=>$imagen,
						'GALERIA_ESTADO'=>'activo',
						'GALERIA_PORTADA'=>'si',
						'ORDEN'=>'1'
					);
					$galeria_id = $this->GaleriasServiciosModel->crear($parametros_galeria);
				}

				// Reviso si se envió información de categoria
				if(!null==$this->input->post('CategoriaServicio')){
					// Parametros Categoria
					$parametros_relacion_categorias = array(
						'ID_CATEGORIA'=>$this->input->post('CategoriaServicio'),
						'ID_SERVICIO'=>$servicio_id
					);
					$this->CategoriasServiciosModel->crear($parametros_relacion_categorias);
				}

				redirect(base_url('usuario/servicios'));
			}else{
				$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$tipo_categoria,'','');
				$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/form_servicio',$this->data);
				$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
			}
		}else{
			redirect(base_url('login'));
		}
	}

		public function actualizar()
		{
			if(verificar_sesion()){
				// Defino tipo de Servicio y tipo de Categoría
				$tipo_categoria = 'servicios';

				$this->form_validation->set_rules('NombreServicio', 'Nombre del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
				$this->form_validation->set_rules('DescripcionServicio', 'Descripcion del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
				$this->form_validation->set_rules('PaisDireccion', 'País del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
				$this->form_validation->set_rules('EstadoDireccion', 'Estado del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
				$this->form_validation->set_rules('MunicipioDireccion', 'Municipio del Servicio', 'required', array( 'required' => 'Debes designar el %s'));

				if($this->form_validation->run())
				{
					$tab='categoria';
					// Parametros del Servicio
					$parametros = array(
						'ID_USUARIO'=> $this->input->post('IdUsuario'),
						'USUARIO_NOMBRE'=> $this->input->post('NombreUsuario'),
						'SERVICIO_NOMBRE'=> $this->input->post('NombreServicio'),
						'SERVICIO_DESCRIPCION'=> $this->input->post('DescripcionServicio'),
						'SERVICIO_DETALLES'=> $this->input->post('DetallesServicio'),
						'SERVICIO_PAIS'=> $this->input->post('PaisDireccion'),
						'SERVICIO_ESTADO_DIR'=> $this->input->post('EstadoDireccion'),
						'SERVICIO_MUNICIPIO'=> $this->input->post('MunicipioDireccion'),
						'SERVICIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
						'SERVICIO_TIPO'=> 'profesional',
						'SERVICIO_ESTADO'=> 'pendiente',
						'ORDEN'=> '1'
		      );
					// Creo el Servicio
					$servicio_id = $this->ServiciosModel->actualizar($this->input->post('Identificador'),$parametros);

					// Reviso si llegó Imagen
					if(!empty($_FILES['ImagenServicio']['name'])){

						$archivo = $_FILES['ImagenServicio']['tmp_name'];
						$ancho = $this->data['op']['ancho_imagenes_servicios'];
						$alto = $this->data['op']['alto_imagenes_servicios'];
						$calidad = 80;
						$nombre = 'Servicio-'.uniqid();
						$destino = $this->data['op']['ruta_imagenes_servicios'].'completo/';
						// Subo la imagen y obtengo el nombre Default si va vacía
						$imagen = subir_imagen_abanico($archivo,$ancho,$alto,$calidad,$nombre,$destino);
						// Cargo la imagen
						$hay_portada = $this->GaleriasServiciosModel->galeria_portada($this->input->post('Identificador'));
						if(!empty($hay_portada)){ $portada = 'no'; }else { $portada = 'si'; };
						$parametros_galeria = array(
							'ID_SERVICIO'=>$this->input->post('Identificador'),
							'GALERIA_ARCHIVO'=>$imagen,
							'GALERIA_ESTADO'=>'activo',
							'GALERIA_PORTADA'=>$portada,
							'ORDEN'=>'1'
						);
						$galeria_id = $this->GaleriasServiciosModel->crear($parametros_galeria);
						$tab='galeria';
					}

					// Reviso si se envió información de categoria
					if(!null==$this->input->post('CategoriaServicio')){
						// Parametros Categoria
						$parametros_relacion_categorias = array(
							'ID_CATEGORIA'=>$this->input->post('CategoriaServicio'),
							'ID_Servicio'=>$SERVICIO_id
						);
						$this->CategoriasServiciosModel->crear($parametros_relacion_categorias);
					}

					// Borro la relación de categorias
					$this->CategoriasServiciosModel->borrar($this->input->post('Identificador'));
					// Reviso si se envió información de categoria
					if(!null==$this->input->post('CategoriaServicio')){
						// Parametros Categoria
						$parametros_relacion_categorias = array(
							'ID_CATEGORIA'=>$this->input->post('CategoriaServicio'),
							'ID_Servicio'=>$this->input->post('Identificador')
						);
						$this->CategoriasServiciosModel->crear($parametros_relacion_categorias);
					}

					redirect(base_url('usuario/servicios/actualizar?id='.$this->input->post('Identificador').'&tab='.$tab));
				}else{
					$this->data['servicio'] = $this->ServiciosModel->detalles($_GET['id']);
					$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$tipo_categoria,'','');
					$this->data['relacion_categorias'] = $this->CategoriasServiciosModel->lista($_GET['id']);
					$this->data['galerias'] = $this->GaleriasServiciosModel->lista($_GET['id'],'','5');
					$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
					$this->load->view($this->data['dispositivo'].'/usuarios/form_actualizar_servicio',$this->data);
					$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
				}
			}else{
				redirect(base_url('login'));
			}
	}


		public function borrar()
		{
			$Servicio = $this->ServiciosModel->detalles($_GET['id']);

	        // check if the institucione exists before trying to delete it
	        if(isset($Servicio['ID_SERVICIO']))
	        {
	            $this->ServiciosModel->borrar($_GET['id']);
							$this->GaleriasServiciosModel->borrar_todo_de($_GET['id']);
							$this->CategoriasServiciosModel->borrar($_GET['id']);
	            redirect(base_url('usuario/servicios'));
	        } else {

		         	show_error('La entrada que deseas borrar no existe');
					}
		}
		public function borrar_galeria()
		{	$tab = 'galeria';
			$galeria = $this->GaleriasServiciosModel->detalles($_GET['id']);
					// check if the institucione exists before trying to delete it
					if(isset($galeria['ID_GALERIA']))
					{
							$this->GaleriasServiciosModel->borrar($_GET['id']);
							redirect(base_url('usuario/servicios/actualizar?id='.$_GET['id_servicio'].'&tab='.$tab));
					} else {

							show_error('La entrada que deseas borrar no existe');
					}
		}
		public function portada()
		{
			$tab = 'galeria';
			$this->GaleriasServiciosModel->portada($_GET['id_servicio'],$_GET['id']);
			redirect(base_url('usuario/servicios/actualizar?id='.$_GET['id_servicio'].'&tab='.$tab));
		}
		public function activar()
		{
			$this->ServiciosModel->activar($_GET['id'],$_GET['estado']);
			redirect(base_url('usuario/servicios'));
		}
}