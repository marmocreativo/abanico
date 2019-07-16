<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Categorias extends CI_Controller {

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
			$this->data['dispositivo']  = "desktop";
		}else{
			$this->data['dispositivo']  = "desktop";
		}

		// Cargo el modelo
		$this->load->model('CategoriasModel');
		$this->load->model('EstadisticasModel');
		$this->load->model('LenguajesModel');
		$this->load->model('TraduccionesModel');
		$this->load->model('NotificacionesModel');
		// Verifico Sesión
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
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
			// Tipo de Categoria por defecto
			if(!isset($_GET['tipo_categoria'])||empty($_GET['tipo_categoria'])){ $this->data['tipo_categoria']='productos'; }else{ $this->data['tipo_categoria']=$_GET['tipo_categoria']; }
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$this->data['tipo_categoria'],'','');
			$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_categorias',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'CATEGORIA_NOMBRE'=>$_GET['Busqueda']
			);
			$this->data['categorias'] = $this->CategoriasModel->lista($parametros,'','');
			$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_categorias',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/divisas'));
		}
	}

	public function crear()
	{
		if(!isset($_GET['tipo_categoria'])||empty($_GET['tipo_categoria'])){ $this->data['tipo_categoria']='productos'; }else{ $this->data['tipo_categoria']=$_GET['tipo_categoria']; }


		$this->form_validation->set_rules('NombreCategoria', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenCategoria']['name'])){

				$archivo = $_FILES['ImagenCategoria']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_categorias'];
				$alto = $this->data['op']['alto_imagenes_categorias'];
				$calidad = 80;
				$nombre = 'categoria-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_categorias'].'completo/';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = 'default.jpg';
			}

		// verifico la URI
		$titulo = convert_accented_characters($this->input->post('NombreCategoria'));
			$url = url_title($titulo,'-',TRUE);
			if($this->CategoriasModel->verificar_uri($url)){
				$url = url_title($titulo,'-',TRUE).'-'.uniq_slug(3);
				if($this->CategoriasModel->verificar_uri($url)){
					$url = url_title($titulo,'-',TRUE).'-'.uniq_slug(3);
				}
			}
			echo $imagen;
      $parametros = array(
				'CATEGORIA_NOMBRE' => $this->input->post('NombreCategoria'),
				'CATEGORIA_URL' => $url,
				'CATEGORIA_IMAGEN' => $imagen,
				'CATEGORIA_DESCRIPCION' => $this->input->post('DescripcionCategoria'),
				'CATEGORIA_COLOR' => $this->input->post('ColorCategoria'),
				'CATEGORIA_ICONO' => $this->input->post('IconoCategoria'),
				'CATEGORIA_PADRE' => $this->input->post('PadreCategoria'),
				'CATEGORIA_TIPO' => $this->input->post('TipoCategoria'),
				'CATEGORIA_ESTADO'=> 'activo'
      );
			// Creo la categoría
      $categoria_id = $this->CategoriasModel->crear($parametros);
			// Redirecciono
      redirect(base_url('admin/categorias?tipo_categoria='.$this->input->post('TipoCategoria').'&tab=collapse'.$this->input->post('Tab')));
    }else{

			if(!isset($_GET['categoria_padre'])||empty($_GET['categoria_padre'])){
				$this->data['categoria_padre']='0';
				$this->data['categoria_color']='-primary';
				$this->data['categoria_icono']='fas fa-list';
			}else{
				$datos_categoria_padre = $this->CategoriasModel->detalles($_GET['categoria_padre']);
				$this->data['categoria_padre']=$datos_categoria_padre['ID_CATEGORIA'];
				$this->data['categoria_color']=$datos_categoria_padre['CATEGORIA_COLOR'];
				$this->data['categoria_icono']=$datos_categoria_padre['CATEGORIA_ICONO'];
			}
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_categoria',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('NombreCategoria', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {

				// Verifico URL
				$url = url_title($this->input->post('NombreCategoria'),'-',TRUE);
				if($this->CategoriasModel->verificar_uri($url)){
					$url = url_title($this->input->post('NombreCategoria'),'-',TRUE).'-'.uniq_slug(3);
					if($this->CategoriasModel->verificar_uri($url)){
						$url = url_title($this->input->post('NombreCategoria'),'-',TRUE).'-'.uniq_slug(3);
					}
				}
			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenCategoria']['name'])){

				$archivo = $_FILES['ImagenCategoria']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_categorias'];
				$alto = $this->data['op']['alto_imagenes_categorias'];
				$calidad = 80;
				$nombre = 'categoria-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_categorias'].'completo/';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = $this->input->post('ImagenActualCategoria');
			}

			$parametros = array(
				'CATEGORIA_NOMBRE' => $this->input->post('NombreCategoria'),
				'CATEGORIA_URL' => $url,
				'CATEGORIA_DESCRIPCION' => $this->input->post('DescripcionCategoria'),
				'CATEGORIA_COLOR' => $this->input->post('ColorCategoria'),
				'CATEGORIA_ICONO' => $this->input->post('IconoCategoria'),
				'CATEGORIA_IMAGEN' => $imagen,
				'CATEGORIA_PADRE' => $this->input->post('PadreCategoria'),
				'CATEGORIA_TIPO' => $this->input->post('TipoCategoria'),
				'CATEGORIA_ESTADO'=> 'activo'
      );

      $this->CategoriasModel->actualizar( $this->input->post('Identificador'),$parametros);

			$color = $this->input->post('ColorCategoria');
			$icono = $this->input->post('IconoCategoria');

			// Busco Segundo Nivel
			$categorias_segundo = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$this->input->post('Identificador')],$this->input->post('TipoCategoria'),'','');

			foreach($categorias_segundo as $categoria_segundo){
				// Actualizo
				$parametros_segundo = array(
					'CATEGORIA_COLOR' => $color,
					'CATEGORIA_ICONO' => $icono
	      );
				$this->CategoriasModel->actualizar($categoria_segundo->ID_CATEGORIA,$parametros_segundo);
				// Busco tercer Nivel
				$categorias_tercero = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>$categoria_segundo->ID_CATEGORIA],$this->input->post('TipoCategoria'),'','');
				foreach($categorias_tercero as $categoria_tercero){
					$parametros_tercero = array(
						'CATEGORIA_COLOR' => $color,
						'CATEGORIA_ICONO' => $icono
		      );
					$this->CategoriasModel->actualizar($categoria_tercero->ID_CATEGORIA,$parametros_tercero);
				}
			}

			// Mensaje Feedback
			$this->session->set_flashdata('exito', 'Categoría actualizada');
			//  Redirecciono
      redirect(base_url('admin/categorias?tipo_categoria='.$this->input->post('TipoCategoria').'&tab=collapse'.$this->input->post('Tab')));
    }else{

			$this->data['categoria'] = $this->CategoriasModel->detalles($_GET['id']);
			$this->data['lenguajes'] = $this->LenguajesModel->lista(['LENGUAJE_ESTADO'=>'activo'],'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_categoria',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function crear_traduccion()
	{
			// Defino el tipo de Categoria
			$this->form_validation->set_rules('TraduccionTitulo', 'Título', 'required', array( 'required' => 'Se requiere que escribas el título %s'));

			if($this->form_validation->run())
			{
				// Parametros del producto
				$parametros = array(
					'ID_OBJETO'=> $this->input->post('IdObjeto'),
					'TIPO_OBJETO'=> $this->input->post('TipoObjeto'),
					'TITULO'=> $this->input->post('TraduccionTitulo'),
					'LENGUAJE'=> $this->input->post('Lenguaje'),
				);
				// Creo el Producto
				$producto_id = $this->TraduccionesModel->crear($parametros);

				// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Traducción creada');
				// Redirecciono
				redirect(base_url('admin/categorias?tipo_categoria='.$this->input->post('TipoCategoria').'&tab=collapse'.$this->input->post('Tab')));
			}else{
				// Mensaje Feedback
					$this->session->set_flashdata('alerta', 'Error al traducir');
				// Redirecciono
				redirect(base_url('admin/categorias/actualizar?id='.$this->input->post('IdObjeto')));
			}
	}
	public function actualizar_traduccion()
	{
			// Defino el tipo de Categoria
			$this->form_validation->set_rules('TraduccionTitulo', 'Título', 'required', array( 'required' => 'Se requiere que escribas el título %s'));

			if($this->form_validation->run())
			{
				// Parametros del producto
				$parametros = array(
					'ID_OBJETO'=> $this->input->post('IdObjeto'),
					'TIPO_OBJETO'=> $this->input->post('TipoObjeto'),
					'TITULO'=> $this->input->post('TraduccionTitulo'),
					'LENGUAJE'=> $this->input->post('Lenguaje'),
				);
				// Creo el Producto
				$producto_id = $this->TraduccionesModel->actualizar($this->input->post('IdTraduccion'),$parametros);

				// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Traducción Actualizada');
				// Redirecciono
				redirect(base_url('admin/categorias?tipo_categoria='.$this->input->post('TipoCategoria').'&tab=collapse'.$this->input->post('Tab')));
			}else{
				// Mensaje Feedback
					$this->session->set_flashdata('alerta', 'Error al traducir');
				// Redirecciono
				redirect(base_url('admin/categorias/actualizar?id='.$this->input->post('IdObjeto')));
			}
	}

	public function borrar()
	{
		$categoria = $this->CategoriasModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($categoria['ID_CATEGORIA']))
        {
					$parametros = array( 'CATEGORIA_ESTADO' => 'borrada');
					$this->CategoriasModel->actualizar( $_GET['id'],$parametros);

						// Mensaje Feedback
						$this->session->set_flashdata('exito', 'Categoría borrada');
						//  Redirecciono
            redirect(base_url('admin/categorias?tipo_categoria='.$_GET['tipo_categoria'].'&tab=collapse'.$_GET['tab']));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		$this->CategoriasModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/categorias'));
	}
}
