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
			$this->load->model('ProductosModel');
			$this->load->model('UsuariosModel');
			$this->load->model('GaleriasModel');
			$this->load->model('CategoriasModel');
			$this->load->model('CategoriasProductoModel');
  }
	public function index()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/panel_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}else{
			redirect(base_url('login'));
		}
	}


	public function registrar()
	{
		var_dump($_POST);
		/*
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

			if($this->input->post('PrimerContacto')!='otro'){
				$primer_contacto = $this->input->post('PrimerContacto');
			}else{
				$primer_contacto = $this->input->post('OtroContacto');
			}

			var_dump($_POST);

			$parametros = array(
				'ID_USUARIO' => $id_usuario,
				'USUARIO_NOMBRE' => $this->input->post('NombreUsuario'),
				'USUARIO_APELLIDOS' => $this->input->post('ApellidosUsuario'),
				'USUARIO_CORREO' => $this->input->post('CorreoUsuario'),
				'USUARIO_TELEFONO' => $this->input->post('TelefonoUsuario'),
				'USUARIO_PASSWORD' => $pass,
				'USUARIO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'USUARIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'USUARIO_PRIMER_CONTACTO' => $primer_contacto,
				'USUARIO_TIPO' => 'usr-1'
			);

			//$usuario_id = $this->UsuariosModel->crear($parametros);
			//redirect(base_url('login?mensaje=registro_correcto'));
		}else{
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/form_registro_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
		*/
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
	/*
	| -------------------------------------------------------------------------
	| Tienda
	| -------------------------------------------------------------------------
	*/
	public function tienda()
	{
		$this->load->model('UsuariosModel_bak');
		// Obtengo los datos de mi tiendas
		$this->data['tienda'] = $this->UsuariosModel_bak->get_tienda_usuario($_SESSION['usuario']['id']);


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
				$this->data['productos'] = $this->UsuariosModel_bak->get_productos($_SESSION['usuario']['id']);
			}
			$this->load->view($dispositivo.'/usuarios/headers/header',$this->data);
			$this->load->view($dispositivo.'/usuarios/'.$formulario,$this->data);
			$this->load->view($dispositivo.'/usuarios/footers/footer',$this->data);
		}else{
			redirect(base_url('usuario/login_form'));
		}
	}
	/*
	| -------------------------------------------------------------------------
	| Actualizar Tienda
	| -------------------------------------------------------------------------
	*/
	public function actualizar_tienda()
	{
		$this->load->model('UsuariosModel_bak');
		//$this->form_validation->set_rules('PassUsuario', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));
		$usuario=new UsuariosModel_bak;
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
		$this->load->model('UsuariosModel_bak');
		//Redirección al modo mantenimiento
		if($this->data['op']['modo_mantenimiento']=='no'){

			// Obtengo los datos de mi tiendas
			$this->data['tienda'] = $this->UsuariosModel_bak->get_tienda_usuario($_SESSION['usuario']['id']);


			// Reviso si se está revisando desde un celular o desde Escritorio
			if($this->agent->is_mobile()){
				$dispositivo = "mobile";
			}else{
				$dispositivo = "desktop";
			}
			// Debo redireccionar
			if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){
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
				$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$tipo_categoria,'','');
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
	| Formulario creación Producto
	| -------------------------------------------------------------------------
	*/
	public function producto_form_actualizar()
	{
		$this->load->model('UsuariosModel_bak');
		//Redirección al modo mantenimiento
		if($this->data['op']['modo_mantenimiento']=='no'){

			// Obtengo los datos de mi tiendas
			$this->data['producto'] = $this->UsuariosModel_bak->get_detalles_producto($_SESSION['usuario']['id'],$_GET['id']);


			// Reviso si se está revisando desde un celular o desde Escritorio
			if($this->agent->is_mobile()){
				$dispositivo = "mobile";
			}else{
				$dispositivo = "desktop";
			}
			// Debo redireccionar
			if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){
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
				$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$tipo_categoria,'','');
				$this->data['galerias'] = $this->GaleriasModel->lista($_GET['id'],'','5');
				$this->load->view($dispositivo.'/usuarios/headers/header',$this->data);
				$this->load->view($dispositivo.'/usuarios/producto_form_actualizar',$this->data);
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
			 // Creo el producto
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
			 // Creo la relación de Categorias
			 $this->CategoriasProductoModel->crear($parametros_relacion_categorias);
				 redirect(base_url('usuario/producto_form_actualizar?id=').$producto_id.'&mensaje=producto_creado');
		}else{
			redirect(base_url('usuario/producto/producto_form?mensaje=error en el producto'));
			}
	}

	/*
	| -------------------------------------------------------------------------
	| Actualizar Producto
	| -------------------------------------------------------------------------
	*/
	public function actualizar_producto()
	 {
		 // Valido mi formulario
		 $this->form_validation->set_rules('NombreProducto', 'Nombre del producto', 'required', array( 'required' => 'Debes designar el %s'));
		 $this->form_validation->set_rules('PrecioProducto', 'Precio del producto', 'required', array( 'required' => 'Debes designar el %s'));
		 $this->form_validation->set_rules('CantidadProducto', 'Cantidad del producto', 'required', array( 'required' => 'Debes designar la %s'));
		 $this->form_validation->set_rules('CategoriaProducto', 'Categoría', 'required', array( 'required' => 'Debes elegir pot lo menos una %s'));

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
				 redirect(base_url('usuario/producto_form_actualizar?id=').$this->input->post('Identificador').'&mensaje=producto_actualizado');
		}else{
			redirect(base_url('usuario/producto/producto_form?mensaje=error en el producto'));
			}
	}
	/*
	| -------------------------------------------------------------------------
	| Borrar Producto
	| -------------------------------------------------------------------------
	*/
	public function borrar_producto()
	 {
		 $this->load->model('UsuariosModel_bak');
			if($this->data['op']['modo_mantenimiento']=='no'){

				// Reviso si se está revisando desde un celular o desde Escritorio
				if($this->agent->is_mobile()){
					$dispositivo = "mobile";
				}else{
					$dispositivo = "desktop";
				}
					// El formulario si es validado creo un usuario unico
					$usuario=new UsuariosModel_bak;
					// Inserto los registros

					$usuario->borrar_producto($_GET['id']);

					redirect(base_url('usuario/tienda'));


			}else{
				$this->load->view('mantenimiento');
			}
		}
		/*
		| -------------------------------------------------------------------------
		| Borrar Galeria
		| -------------------------------------------------------------------------
		*/
		public function borrar_galeria()
		{
			$galeria = $this->GaleriasModel->detalles($_GET['id']);
					// check if the institucione exists before trying to delete it
					if(isset($galeria['ID_GALERIA']))
					{
							$this->GaleriasModel->borrar($_GET['id']);
							redirect(base_url('usuario/producto_form_actualizar?id=').$_GET['id_producto'].'&mensaje=producto_actualizado');
					} else {

							show_error('La entrada que deseas borrar no existe');
					}
		}
		/*
		| -------------------------------------------------------------------------
		| Asignar Portada
		| -------------------------------------------------------------------------
		*/
		public function portada()
		{
			$this->GaleriasModel->portada($_GET['id_producto'],$_GET['id']);
			redirect(base_url('usuario/producto_form_actualizar?id=').$_GET['id_producto'].'&mensaje=producto_actualizado');
		}
}
