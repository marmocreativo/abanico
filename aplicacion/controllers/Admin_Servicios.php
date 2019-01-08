<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Servicios extends CI_Controller {

	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();

		// Variables defaults
		$this->data['primary'] = "-primary";

		if($this->agent->is_mobile()){
			$this->data['dispositivo']  = "desktop";
		}else{
			$this->data['dispositivo']  = "desktop";
		}

		// Cargo el modelo
		$this->load->model('ServiciosModel');
		$this->load->model('UsuariosModel');
		$this->load->model('PerfilServiciosModel');
		$this->load->model('GaleriasModel');
		$this->load->model('GaleriasServiciosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('CategoriasServiciosModel');

		// Verifico Sesión
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes Iniciar Sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		// Verifico Permiso
		if(!verificar_permiso(['tec-5','adm-6'])){
			$this->session->set_flashdata('alerta', 'No tienes permiso de entrar en esa sección');
			redirect(base_url('usuario'));
		}
  }

	public function index()
	{
			// Tipo de Servicio

			// Reviso si hay id del usuario
			if(isset($_GET['id_usuario'])){
				$this->data['servicios'] = $this->ServiciosModel->lista('',$_GET['id_usuario'],'SERVICIO_FECHA_REGISTRO DESC','');
				$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
				$this->data['perfil'] = $this->PerfilServiciosModel->perfil_usuario($_GET['id_usuario']);
			}else{
				$this->data['servicios'] = $this->ServiciosModel->lista('','','SERVICIO_FECHA_REGISTRO DESC','');
			}
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_servicios',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'USUARIO_NOMBRE'=>$_GET['Busqueda'],
				'SERVICIO_NOMBRE'=>$_GET['Busqueda']
			);
			$this->data['servicios'] = $this->ServiciosModel->lista($parametros,'','','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_servicios',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/servicios'));
		}
	}


	public function crear()
	{
		// Valido mi formulario
		$this->form_validation->set_rules('NombreServicio', 'Nombre del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('DescripcionServicio', 'Descripcion del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('PaisDireccion', 'País del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('EstadoDireccion', 'Estado del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('MunicipioDireccion', 'Municipio del Servicio', 'required', array( 'required' => 'Debes designar el %s'));

		if($this->form_validation->run())
    {
			// Parametros del servicio
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
				'SERVICIO_ESTADO'=> 'activo',
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
			// Mensaje de feedback
			$this->session->set_flashdata('exito', 'Tu servicio se ha actualizado, puedes continuar añadiendo imagenes a la galería');
			// redirección
			redirect(base_url('admin/servicios?id_usuario='.$this->input->post('IdUsuario')));
    }else{
			if(!isset($_GET['tipo_servicio'])||empty($_GET['tipo_servicio'])){ $this->data['tipo_servicio']='normal'; }else{ $this->data['tipo_servicio']=$_GET['tipo_servicio']; }
			$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			$this->data['perfil'] = $this->PerfilServiciosModel->perfil_usuario($_GET['id_usuario']);
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_servicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}


	public function actualizar()
	{

		$this->form_validation->set_rules('NombreServicio', 'Nombre del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('DescripcionServicio', 'Descripcion del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('PaisDireccion', 'País del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('EstadoDireccion', 'Estado del Servicio', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('MunicipioDireccion', 'Municipio del Servicio', 'required', array( 'required' => 'Debes designar el %s'));

		if($this->form_validation->run())
    {
			// Parametros del servicio
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
				'SERVICIO_ESTADO'=> 'activo',
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

			// Borro la relación de categorias
			$this->CategoriasServiciosModel->borrar($this->input->post('Identificador'));
			// Reviso si se envió información de categoria
			if(!null==$this->input->post('CategoriaServicio')){
				// Parametros Categoria
				$parametros_relacion_categorias = array(
					'ID_CATEGORIA'=>$this->input->post('CategoriaServicio'),
					'ID_SERVICIO'=>$this->input->post('Identificador')
				);
				$this->CategoriasServiciosModel->crear($parametros_relacion_categorias);
			}
			// Mensaje de Feedback
			$this->session->set_flashdata('exito', 'Actualización correcta');
			// Redirección
			redirect(base_url('admin/servicios/?id_usuario=').$this->input->post('IdUsuario'));
    }else{

			$this->data['servicio'] = $this->ServiciosModel->detalles($_GET['id']);
			$this->data['usuarios'] = $this->UsuariosModel->lista([ 'USUARIO_ESTADO'=>'activo' ],'','','');
			$this->data['usuario_servicio'] = $this->UsuariosModel->detalles($this->data['servicio']['ID_USUARIO']);
			$this->data['perfil'] = $this->PerfilServiciosModel->perfil_usuario($this->data['usuario_servicio']['ID_USUARIO']);
			$this->data['galerias'] = $this->GaleriasServiciosModel->lista($_GET['id'],'','5');
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');
			$this->data['relacion_categorias'] = $this->CategoriasServiciosModel->lista($_GET['id']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_servicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$servicio = $this->ServiciosModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($servicio['ID_SERVICIO']))
        {
            $this->ServiciosModel->borrar($_GET['id']);
						// Mensaje de Feedback
						$this->session->set_flashdata('exito', 'Servicio Borrado');
						// Redirección
            redirect(base_url('admin/servicios?id_usuario=').$_GET['id_usuario']);
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function borrar_galeria()
	{
		$galeria = $this->GaleriasModel->detalles($_GET['id']);
				// check if the institucione exists before trying to delete it
				if(isset($galeria['ID_GALERIA']))
				{
						$this->GaleriasModel->borrar($_GET['id']);
						redirect(base_url('admin/servicios/actualizar?id=').$_GET['id_servicio']);
				} else {

						show_error('La entrada que deseas borrar no existe');
				}
	}
	public function portada()
	{
		$this->GaleriasModel->portada($_GET['id_servicio'],$_GET['id']);
		redirect(base_url('admin/servicios/actualizar?id=').$_GET['id_servicio']);
	}
	public function activar()
	{
		$this->ServiciosModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/servicios/usuario?id_usuario='.$_GET['id_usuario']));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
