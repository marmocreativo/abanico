<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Categorias extends CI_Controller {

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
		$this->load->model('CategoriasModel');
  }

	public function index()
		{
			// Tipo de Categoria por defecto
			if(!isset($_GET['tipo_categoria'])||empty($_GET['tipo_categoria'])){ $this->data['tipo_categoria']='productos'; }else{ $this->data['tipo_categoria']=$_GET['tipo_categoria']; }
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$this->data['tipo_categoria'],'','');
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
		if(!isset($_GET['tipo_categoria'])||empty($_GET['categoria_padre'])){ $this->data['categoria_padre']='0'; }else{ $this->data['categoria_padre']=$_GET['categoria_padre']; }

		$this->form_validation->set_rules('NombreCategoria', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenCategoria']['name'])){
					$folder_imagen = 'assets/tienda/img/categorias/originales';
					$nombre_archivo = 'categoria-'.uniqid();
					$config['upload_path']          = $folder_imagen;
					$config['file_name']						= 'categoria-'.uniqid();
		      $config['allowed_types']        = 'gif|jpg|png';
		      $config['max_size']             = 1000;
		      $config['max_width']            = 1920;
		      $config['max_height']           = 1920;

		      $this->load->library('upload', $config);
					$this->load->library('SimpleImage');

		      if ( ! $this->upload->do_upload('ImagenCategoria'))
		      { echo $this->upload->display_errors();   }else{
						try {
						    $this->simpleimage->fromFile($this->upload->data('full_path'))
						    ->thumbnail(634, 811)                          // resize to 320x200 pixels
						    ->toFile('assets/tienda/img/categorias/completo/'.$nombre_archivo.'.jpg' );      // convert to PNG and save a copy to new-image.png
						} catch(Exception $err) {
						  // Handle errors
						  echo $err->getMessage();
							$imagen = 'default.jpg';
						}
						$imagen = $nombre_archivo.'.jpg';
					}
				}else{
					$imagen = 'default.jpg';
				}

		// verifico la URI
			$url = url_title($this->input->post('NombreCategoria'),'-',TRUE);
			if($this->CategoriasModel->verificar_uri($url)){
				$url = url_title($this->input->post('NombreCategoria'),'-',TRUE).'-1';
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
      redirect(base_url('admin/categorias?tipo_categoria='.$this->input->post('TipoCategoria')));
    }else{
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
			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['ImagenCategoria']['name'])){
					$folder_imagen = 'assets/tienda/img/categorias/originales';
					$nombre_archivo = 'categoria-'.uniqid();
					$config['upload_path']          = $folder_imagen;
					$config['file_name']						= 'categoria-'.uniqid();
		      $config['allowed_types']        = 'gif|jpg|png';
		      $config['max_size']             = 1000;
		      $config['max_width']            = 1920;
		      $config['max_height']           = 1920;

		      $this->load->library('upload', $config);
					$this->load->library('SimpleImage');

		      if ( ! $this->upload->do_upload('ImagenCategoria'))
		      { echo $this->upload->display_errors();   }else{
						try {
						    $this->simpleimage->fromFile($this->upload->data('full_path'))
						    ->thumbnail(634, 811)                          // resize to 320x200 pixels
						    ->toFile('assets/tienda/img/categorias/completo/'.$nombre_archivo.'.jpg' );      // convert to PNG and save a copy to new-image.png
						} catch(Exception $err) {
						  // Handle errors
						  echo $err->getMessage();
							$imagen = $this->input->post('ImagenActualCategoria');
						}
						$imagen = $nombre_archivo.'.jpg';
					}
				}else{
					$imagen = $this->input->post('ImagenActualCategoria');
				}

			$parametros = array(
				'CATEGORIA_NOMBRE' => $this->input->post('NombreCategoria'),
				'CATEGORIA_URL' => $this->input->post('UrlCategoria'),
				'CATEGORIA_DESCRIPCION' => $this->input->post('DescripcionCategoria'),
				'CATEGORIA_COLOR' => $this->input->post('ColorCategoria'),
				'CATEGORIA_ICONO' => $this->input->post('IconoCategoria'),
				'CATEGORIA_IMAGEN' => $imagen,
				'CATEGORIA_PADRE' => $this->input->post('PadreCategoria'),
				'CATEGORIA_TIPO' => $this->input->post('TipoCategoria'),
				'CATEGORIA_ESTADO'=> 'activo'
      );

      $categoria_id = $this->CategoriasModel->actualizar( $this->input->post('Identificador'),$parametros);

      redirect(base_url('admin/categorias?tipo_categoria='.$this->input->post('TipoCategoria')));
    }else{

			$this->data['categoria'] = $this->CategoriasModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_categoria',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$categoria = $this->CategoriasModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($categoria['ID_CATEGORIA']))
        {
            $this->CategoriasModel->borrar($_GET['id']);
            redirect(base_url('admin/categorias?tipo_categoria'.$_GET['tipo_categoria']));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		$this->CategoriasModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/categorias'));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
