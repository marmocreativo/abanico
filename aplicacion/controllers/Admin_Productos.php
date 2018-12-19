<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Productos extends CI_Controller {

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
		$this->load->model('ProductosModel');
		$this->load->model('UsuariosModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasModel');
		$this->load->model('CategoriasProductoModel');
  }

	public function index()
	{
			if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }
			$this->data['productos'] = $this->ProductosModel->lista(['PRODUCTO_TIPO'=>$this->data['tipo_producto']],'','','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_productos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function usuario()
	{
			if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }
			$this->data['productos'] = $this->ProductosModel->lista(['PRODUCTO_TIPO'=>$this->data['tipo_producto']],$_GET['id_usuario'],'','');
			$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_productos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'PRODUCTO_NOMBRE'=>$_GET['Busqueda'],
				'PRODUCTO_DESCRIPCION'=>$_GET['Busqueda'],
				'PRODUCTO_MODELO'=>$_GET['Busqueda']
			);
			$this->data['productos'] = $this->ProductosModel->lista($parametros,'','','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_productos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/productos'));
		}
	}


	public function crear()
	{
		// Defino tipo de producto y tipo de Categoría
		if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }
		switch ($this->data['tipo_producto']) {
			case 'normal':
				$tipo_categoria = 'productos';
				break;
			case 'mayoreo':
				$tipo_categoria = 'mayoreo';
				break;
			default:
				$tipo_categoria = 'productos';
				break;
		}
		// Valido mi formulario
		$this->form_validation->set_rules('NombreProducto', 'Nombre del producto', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('PrecioProducto', 'Precio del producto', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('CantidadProducto', 'Cantidad del producto', 'required', array( 'required' => 'Debes designar la %s'));
		$this->form_validation->set_rules('CategoriaProducto', 'Categoría', 'required', array( 'required' => 'Debes elegir pot lo menos una %s'));

		if($this->form_validation->run())
    {

      $parametros = array(
				'ID_USUARIO'=> $this->input->post('IdUsuario'),
				'PRODUCTO_NOMBRE'=> $this->input->post('NombreProducto'),
				'PRODUCTO_DESCRIPCION'=> $this->input->post('DescripcionProducto'),
				'PRODUCTO_DETALLES'=> $this->input->post('DetallesProducto'),
				'PRODUCTO_MODELO'=> $this->input->post('ModeloProducto'),
				'PRODUCTO_ORIGEN'=> $this->input->post('OrigenProducto'),
				'PRODUCTO_SKU'=> $this->input->post('SkuProducto'),
				'PRODUCTO_UPC'=> $this->input->post('UpcProducto'),
				'PRODUCTO_EAN'=> $this->input->post('EanProducto'),
				'PRODUCTO_JAN'=> $this->input->post('JanProducto'),
				'PRODUCTO_ISBN'=> $this->input->post('IsbnProducto'),
				'PRODUCTO_MPN'=> $this->input->post('MpnProducto'),
				'PRODUCTO_PRECIO'=> $this->input->post('PrecioProducto'),
				'PRODUCTO_CANTIDAD'=> $this->input->post('CantidadProducto'),
				'PRODUCTO_CANTIDAD_MINIMA'=> $this->input->post('CantidadMinimaProducto'),
				'PRODUCTO_INVENTARIO'=> '1',
				'PRODUCTO_MENSAJE_SIN_STOCK'=> 'No disponible para la venta',
				'PRODUCTO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'PRODUCTO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'PRODUCTO_FECHA_PUBLICACION' => date('Y-m-d H:i:s'),
				'PRODUCTO_ANCHO'=> $this->input->post('AnchoProducto'),
				'PRODUCTO_ALTO'=> $this->input->post('AltoProducto'),
				'PRODUCTO_PROFUNDO'=> $this->input->post('ProfundoProducto'),
				'PRODUCTO_PESO'=> $this->input->post('PesoProducto'),
				'PRODUCTO_TIPO'=> $this->input->post('TipoProducto'),
				'PRODUCTO_ESTADO'=> 'activo',
				'ORDEN'=> '1'
      );

      $producto_id = $this->ProductosModel->crear($parametros);

			// Reviso si llegó Imagen

				if(!empty($_FILES['ImagenProducto']['name'])){
					$folder_imagen = 'assets/tienda/img/productos/originales';
					$nombre_archivo = 'categoria-'.uniqid();
					$config['upload_path']          = $folder_imagen;
					$config['file_name']						= 'producto-'.uniqid();
		      $config['allowed_types']        = 'gif|jpg|png';
		      $config['max_size']             = 5000;
		      $config['max_width']            = 1920;
		      $config['max_height']           = 1920;

		      $this->load->library('upload', $config);
					$this->load->library('SimpleImage');

		      if ( ! $this->upload->do_upload('ImagenProducto'))
		      { echo $this->upload->display_errors();   }else{
						try {
						    $this->simpleimage->fromFile($this->upload->data('full_path'))
						    ->thumbnail(634, 811)                          // resize to 320x200 pixels
						    ->toFile('assets/tienda/img/productos/completo/'.$nombre_archivo.'.jpg' );      // convert to PNG and save a copy to new-image.png
						} catch(Exception $err) {
						  // Handle errors
						  echo $err->getMessage();
						}
						$imagen = $nombre_archivo.'.jpg';
					}
					// Cargo la imagen
					$parametros_galeria = array(
						'ID_PRODUCTO'=>$producto_id,
						'GALERIA_ARCHIVO'=>$imagen,
						'GALERIA_ESTADO'=>'activo',
						'GALERIA_PORTADA'=>'si',
						'ORDEN'=>'1'
					);
					$galeria_id = $this->GaleriasModel->crear($parametros_galeria);

				}

			// Preparo los parametros para la relación
			$parametros_relacion_categorias = array(
				'ID_CATEGORIA'=>$this->input->post('CategoriaProducto'),
				'ID_PRODUCTO'=>$producto_id
			);
			$this->CategoriasProductoModel->crear($parametros_relacion_categorias);
			redirect(base_url('admin/productos/actualizar?id=').$producto_id.'&mensaje=producto_creado');
    }else{
			if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }
			$this->data['usuarios'] = $this->UsuariosModel->lista([ 'USUARIO_ESTADO'=>'activo' ],'','','');
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$tipo_categoria,'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_producto',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}


	public function actualizar()
	{
		if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }

		switch ($this->data['tipo_producto']) {
			case 'normal':
				$tipo_categoria = 'productos';
				break;
			case 'mayoreo':
				$tipo_categoria = 'mayoreo';
				break;
			default:
				$tipo_categoria = 'productos';
				break;
		}

		$this->form_validation->set_rules('NombreProducto', 'Nombre del producto', 'required', array( 'required' => 'Debes designar el %s.'));

		if($this->form_validation->run())
    {
			if(!empty($_FILES['ImagenProducto']['name'])){
				$folder_imagen = 'assets/tienda/img/productos/originales';
				$nombre_archivo = 'categoria-'.uniqid();
				$config['upload_path']          = $folder_imagen;
				$config['file_name']						= 'producto-'.uniqid();
	      $config['allowed_types']        = 'gif|jpg|png';
	      $config['max_size']             = 5000;
	      $config['max_width']            = 1920;
	      $config['max_height']           = 1920;

	      $this->load->library('upload', $config);
				$this->load->library('SimpleImage');

	      if ( ! $this->upload->do_upload('ImagenProducto'))
	      { echo $this->upload->display_errors();   }else{
					try {
					    $this->simpleimage->fromFile($this->upload->data('full_path'))
					    ->thumbnail(634, 811)                          // resize to 320x200 pixels
					    ->toFile('assets/tienda/img/productos/completo/'.$nombre_archivo.'.jpg' );      // convert to PNG and save a copy to new-image.png
					} catch(Exception $err) {
					  // Handle errors
					  echo $err->getMessage();
					}
					$imagen = $nombre_archivo.'.jpg';
				}
				// Cargo la imagen
				$parametros_galeria = array(
					'ID_PRODUCTO'=>$this->input->post('Identificador'),
					'GALERIA_ARCHIVO'=>$imagen,
					'GALERIA_ESTADO'=>'activo',
					'GALERIA_PORTADA'=>'no',
					'ORDEN'=>'1'
				);
				$galeria_id = $this->GaleriasModel->crear($parametros_galeria);

			}
			// PArametros para la actualización Principal
			$parametros = array(
				'ID_USUARIO'=> $this->input->post('IdUsuario'),
				'PRODUCTO_NOMBRE'=> $this->input->post('NombreProducto'),
				'PRODUCTO_DESCRIPCION'=> $this->input->post('DescripcionProducto'),
				'PRODUCTO_DETALLES'=> $this->input->post('DetallesProducto'),
				'PRODUCTO_MODELO'=> $this->input->post('ModeloProducto'),
				'PRODUCTO_ORIGEN'=> $this->input->post('OrigenProducto'),
				'PRODUCTO_SKU'=> $this->input->post('SkuProducto'),
				'PRODUCTO_UPC'=> $this->input->post('UpcProducto'),
				'PRODUCTO_EAN'=> $this->input->post('EanProducto'),
				'PRODUCTO_JAN'=> $this->input->post('JanProducto'),
				'PRODUCTO_ISBN'=> $this->input->post('IsbnProducto'),
				'PRODUCTO_MPN'=> $this->input->post('MpnProducto'),
				'PRODUCTO_PRECIO'=> $this->input->post('PrecioProducto'),
				'PRODUCTO_CANTIDAD'=> $this->input->post('CantidadProducto'),
				'PRODUCTO_CANTIDAD_MINIMA'=> $this->input->post('CantidadMinimaProducto'),
				'PRODUCTO_INVENTARIO'=> '1',
				'PRODUCTO_MENSAJE_SIN_STOCK'=> 'No disponible para la venta',
				'PRODUCTO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'PRODUCTO_ANCHO'=> $this->input->post('AnchoProducto'),
				'PRODUCTO_ALTO'=> $this->input->post('AltoProducto'),
				'PRODUCTO_PROFUNDO'=> $this->input->post('ProfundoProducto'),
				'PRODUCTO_PESO'=> $this->input->post('PesoProducto'),
				'PRODUCTO_TIPO'=> $this->input->post('TipoProducto'),
				'PRODUCTO_ESTADO'=>  $this->input->post('EstadoProducto'),
				'ORDEN'=> '1'
      );
			// Borro la relación de categorias
			$this->CategoriasProductoModel->borrar($this->input->post('Identificador'));
			// Preparo los parametros para la relación
			$parametros_relacion_categorias = array(
				'ID_CATEGORIA'=>$this->input->post('CategoriaProducto'),
				'ID_PRODUCTO'=>$this->input->post('Identificador')
			);
			$this->CategoriasProductoModel->crear($parametros_relacion_categorias);

			// Actualizo
      $producto_id = $this->ProductosModel->actualizar( $this->input->post('Identificador'),$parametros);
			// redirecciono
			redirect(base_url('admin/productos/actualizar?id=').$this->input->post('Identificador').'&mensaje=producto_actualizado');
    }else{

			$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
			$this->data['usuarios'] = $this->UsuariosModel->lista([ 'USUARIO_ESTADO'=>'activo' ],'','','');
			$this->data['usuario_producto'] = $this->UsuariosModel->detalles($this->data['producto']['ID_USUARIO']);
			$this->data['galerias'] = $this->GaleriasModel->lista($_GET['id'],'','5');
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$tipo_categoria,'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_producto',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$producto = $this->ProductosModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($producto['ID_PRODUCTO']))
        {
            $this->ProductosModel->borrar($_GET['id']);
            redirect(base_url('admin/productos/usuario?id_usuario=').$_GET['id_usuario']);
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
						redirect(base_url('admin/productos/actualizar?id=').$_GET['id_producto']);
				} else {

						show_error('La entrada que deseas borrar no existe');
				}
	}
	public function portada()
	{
		$this->GaleriasModel->portada($_GET['id_producto'],$_GET['id']);
		redirect(base_url('admin/productos/actualizar?id=').$_GET['id_producto']);
	}
	public function activar()
	{
		$this->ProductosModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/productos/usuario?id_usuario='.$_GET['id_usuario']));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
