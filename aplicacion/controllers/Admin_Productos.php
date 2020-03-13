<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Productos extends CI_Controller {

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
		$this->load->model('ProductosModel');
		$this->load->model('UsuariosModel');
		$this->load->model('TiendasModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasModel');
		$this->load->model('CategoriasProductoModel');
		$this->load->model('EstadisticasModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('TransportistasModel');
		$this->load->model('PlanesModel');

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
			// Tipo de Producto
			if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }

			// Reviso si hay id del usuario
			if(isset($_GET['id_usuario'])){
				$this->data['productos'] = $this->ProductosModel->lista_admin(['PRODUCTO_TIPO'=>$this->data['tipo_producto']],$_GET['id_usuario'],'PRODUCTO_FECHA_REGISTRO DESC','');
				$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
				$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_GET['id_usuario']);
			}else{
				$this->data['productos'] = $this->ProductosModel->lista_admin(['PRODUCTO_TIPO'=>$this->data['tipo_producto']],'','PRODUCTO_FECHA_REGISTRO DESC','');
			}
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_productos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		// Tipo de Producto
		if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'PRODUCTO_NOMBRE'=>$_GET['Busqueda'],
				'PRODUCTO_DESCRIPCION'=>$_GET['Busqueda'],
				'PRODUCTO_MODELO'=>$_GET['Busqueda']
			);

			// Reviso si hay id del usuario
			if(isset($_GET['id_usuario'])){
				$this->data['productos'] = $this->ProductosModel->lista_admin($parametros,$_GET['id_usuario'],'PRODUCTO_FECHA_REGISTRO DESC','');
				$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
				$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_GET['id_usuario']);
			}else{
				$this->data['productos'] = $this->ProductosModel->lista_admin($parametros,'','PRODUCTO_FECHA_REGISTRO DESC','');
			}


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

		if($this->form_validation->run())
    {
			// Verifico URL
			if(!empty($this->input->post('MetaTitulo'))){
				$titulo = convert_accented_characters($this->input->post('MetaTitulo'));
			}else{
				$titulo = convert_accented_characters($this->input->post('NombreProducto'));
			}

			$url = url_title($titulo,'-',TRUE);
			if($this->ProductosModel->verificar_uri($url)){
				$url = url_title($titulo,'-',TRUE).'-'.easy_slug(2);
				if($this->ProductosModel->verificar_uri($url)){
					$url = url_title($titulo,'-',TRUE).'-'.easy_slug(2);
				}
			}
			// Parametros del producto
			$parametros = array(
				'ID_USUARIO'=> $this->input->post('IdUsuario'),
				'ID_TIENDA'=> $this->input->post('IdTienda'),
				'META_TITULO'=> $this->input->post('MetaTitulo'),
				'META_DESCRIPCION'=> $this->input->post('MetaDescripcion'),
				'META_KEYWORDS'=> $this->input->post('MetaKeywords'),
				'PRODUCTO_NOMBRE'=> $this->input->post('NombreProducto'),
				'PRODUCTO_URL'=> $url,
				'PRODUCTO_DESCRIPCION'=> $this->input->post('DescripcionProducto'),
				'PRODUCTO_DETALLES'=> $this->input->post('DetallesProducto'),
				'PRODUCTO_MODELO'=> $this->input->post('ModeloProducto'),
				'PRODUCTO_ORIGEN'=> $this->input->post('OrigenProducto'),
				'PRODUCTO_ARTESANAL'=> $this->input->post('ArtesanalProducto'),
				'PRODUCTO_SKU'=> $this->input->post('SkuProducto'),
				'PRODUCTO_UPC'=> $this->input->post('UpcProducto'),
				'PRODUCTO_EAN'=> $this->input->post('EanProducto'),
				'PRODUCTO_JAN'=> $this->input->post('JanProducto'),
				'PRODUCTO_ISBN'=> $this->input->post('IsbnProducto'),
				'PRODUCTO_MPN'=> $this->input->post('MpnProducto'),
				'PRODUCTO_PRECIO'=> $this->input->post('PrecioProducto'),
				'PRODUCTO_PRECIO_LISTA'=> $this->input->post('PrecioListaProducto'),
				'PRODUCTO_DIVISA_DEFAULT'=> $this->input->post('DivisaDefaultProducto'),
				'PRODUCTO_CONTRA_ENTREGA'=> $this->input->post('ContraEntregaProducto'),
				'PRODUCTO_ENVIO_GRATUITO'=> $this->input->post('EnvioGratuitoProducto'),
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
				'PRODUCTO_PESO_NETO'=> $this->input->post('PesoNetoProducto'),
				'PRODUCTO_TIPO'=> $this->input->post('TipoProducto'),
				'PRODUCTO_CONDICION'=> $this->input->post('CondicionProducto'),
				'PRODUCTO_MAYOREO'=> $this->input->post('MayoreoProducto'),
				'PRODUCTO_ESTADO'=> $this->input->post('EstadoProducto'),
				'ORDEN'=> '1'
			);
			// Creo el Producto
			$producto_id = $this->ProductosModel->crear($parametros);

			// Reviso si llegó Imagen
			if(!empty($_FILES['ImagenProducto']['name'])){

				$archivo = $_FILES['ImagenProducto']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_producto'];
				$alto = $this->data['op']['alto_imagenes_producto'];
				$calidad = 80;
				$nombre = 'producto-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_producto'].'completo/';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico($archivo,$ancho,$alto,$calidad,$nombre,$destino);
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

			// Reviso si se envió información de categoria
			if(!null==$this->input->post('CategoriaProducto')){
				foreach($this->input->post('CategoriaProducto') as $id_categoria){
					$parametros_relacion_categorias = array(
						'ID_CATEGORIA'=>$id_categoria,
						'ID_PRODUCTO'=>$producto_id
					);
					$this->CategoriasProductoModel->crear($parametros_relacion_categorias);
				}
				// Parametros Categoria

			}
			// Mensaje de feedback
			$this->session->set_flashdata('exito', 'Tu producto se ha actualizado, puedes continuar añadiendo imagenes a la galería');
			// redirección

			switch ($this->input->post('Guardar')) {
				case 'guardar':
					redirect(base_url('admin/productos/actualizar?id='.$producto_id));
					break;

				case 'salir':
					redirect(base_url('admin/productos?tipo=normal'));
					break;

				case 'tienda':
					redirect(base_url('admin/productos?id_usuario='.$this->input->post('IdUsuario')));
					break;

				case 'combinaciones':
					redirect(base_url('admin/productos_combinaciones?id='.$producto_id));
					break;

				case 'rangos':
					redirect(base_url('admin/productos_rangos_mayoreo?id='.$producto_id));
					break;

				default:
					redirect(base_url('admin/productos/actualizar?id='.$producto_id));
					break;
			}

    }else{
			if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }
			$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_GET['id_usuario']);
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$tipo_categoria,'','');
			$this->data['transportistas'] = $this->TransportistasModel->lista(['TRANSPORTISTA_ESTADO'=>'activo'],'','');
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

			$tab=$this->input->post('SeccionActiva');
			// Verifico URL
			if(!empty($this->input->post('MetaTitulo'))){
				$titulo = convert_accented_characters($this->input->post('MetaTitulo'));
			}else{
				$titulo = convert_accented_characters($this->input->post('NombreProducto'));
			}

			$url = url_title($titulo,'-',TRUE);
			if($this->ProductosModel->verificar_uri($url)){
				$url = url_title($titulo,'-',TRUE).'-'.easy_slug(2);
				if($this->ProductosModel->verificar_uri($url)){
					$url = url_title($titulo,'-',TRUE).'-'.easy_slug(2);
				}
			}
			// Parametros del producto
			$parametros = array(
				'ID_USUARIO'=> $this->input->post('IdUsuario'),
				'ID_TIENDA'=> $this->input->post('IdTienda'),
				'META_TITULO'=> $this->input->post('MetaTitulo'),
				'META_DESCRIPCION'=> $this->input->post('MetaDescripcion'),
				'META_KEYWORDS'=> $this->input->post('MetaKeywords'),
				'PRODUCTO_NOMBRE'=> $this->input->post('NombreProducto'),
				'PRODUCTO_URL'=> $url,
				'PRODUCTO_DESCRIPCION'=> $this->input->post('DescripcionProducto'),
				'PRODUCTO_DETALLES'=> $this->input->post('DetallesProducto'),
				'PRODUCTO_MODELO'=> $this->input->post('ModeloProducto'),
				'PRODUCTO_ORIGEN'=> $this->input->post('OrigenProducto'),
				'PRODUCTO_ARTESANAL'=> $this->input->post('ArtesanalProducto'),
				'PRODUCTO_SKU'=> $this->input->post('SkuProducto'),
				'PRODUCTO_UPC'=> $this->input->post('UpcProducto'),
				'PRODUCTO_EAN'=> $this->input->post('EanProducto'),
				'PRODUCTO_JAN'=> $this->input->post('JanProducto'),
				'PRODUCTO_ISBN'=> $this->input->post('IsbnProducto'),
				'PRODUCTO_MPN'=> $this->input->post('MpnProducto'),
				'PRODUCTO_PRECIO'=> $this->input->post('PrecioProducto'),
				'PRODUCTO_PRECIO_LISTA'=> $this->input->post('PrecioListaProducto'),
				'PRODUCTO_DIVISA_DEFAULT'=> $this->input->post('DivisaDefaultProducto'),
				'PRODUCTO_CONTRA_ENTREGA'=> $this->input->post('ContraEntregaProducto'),
				'PRODUCTO_ENVIO_GRATUITO'=> $this->input->post('EnvioGratuitoProducto'),
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
				'PRODUCTO_PESO_NETO'=> $this->input->post('PesoNetoProducto'),
				'PRODUCTO_TIPO'=> $this->input->post('TipoProducto'),
				'PRODUCTO_CONDICION'=> $this->input->post('CondicionProducto'),
				'PRODUCTO_MAYOREO'=> $this->input->post('MayoreoProducto'),
				'PRODUCTO_ESTADO'=> $this->input->post('EstadoProducto'),
				'ORDEN'=> '1'
			);
			// Creo el Producto
			$producto_id = $this->ProductosModel->actualizar($this->input->post('Identificador'),$parametros);

			// Reviso si llegó Imagen
			if(!empty($_FILES['ImagenProducto']['name'])){

				$archivo = $_FILES['ImagenProducto']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_producto'];
				$alto = $this->data['op']['alto_imagenes_producto'];
				$calidad = 80;
				$nombre = 'producto-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_producto'].'completo/';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico($archivo,$ancho,$alto,$calidad,$nombre,$destino);
				// Cargo la imagen
				$hay_portada = $this->GaleriasModel->galeria_portada($this->input->post('Identificador'));
				if(!empty($hay_portada)){ $portada = 'no'; }else { $portada = 'si'; };
				$parametros_galeria = array(
					'ID_PRODUCTO'=>$this->input->post('Identificador'),
					'GALERIA_ARCHIVO'=>$imagen,
					'GALERIA_ESTADO'=>'activo',
					'GALERIA_PORTADA'=>$portada,
					'ORDEN'=>'1'
				);
				$galeria_id = $this->GaleriasModel->crear($parametros_galeria);
			}

			// Borro la relación de categorias
			$this->CategoriasProductoModel->borrar($this->input->post('Identificador'));
			// Reviso si se envió información de categoria
			if(!null==$this->input->post('CategoriaProducto')){
				foreach($this->input->post('CategoriaProducto') as $id_categoria){
					$parametros_relacion_categorias = array(
						'ID_CATEGORIA'=>$id_categoria,
						'ID_PRODUCTO'=>$this->input->post('Identificador')
					);
					$this->CategoriasProductoModel->crear($parametros_relacion_categorias);
				}
				// Parametros Categoria

			}
			// Mensaje de Feedback
			$this->session->set_flashdata('exito', 'Actualización correcta');
			// Redirección

			switch ($this->input->post('Guardar')) {
				case 'guardar':
					redirect(base_url('admin/productos/actualizar?id='.$this->input->post('Identificador')));
					break;

				case 'salir':
					redirect(base_url('admin/productos?tipo=normal'));
					break;

				case 'tienda':
					redirect(base_url('admin/productos?id_usuario='.$this->input->post('IdUsuario')));
					break;

				case 'combinaciones':
					redirect(base_url('admin/productos_combinaciones?id='.$this->input->post('Identificador')));
					break;
				case 'rangos':
					redirect(base_url('admin/productos_rangos_mayoreo?id='.$this->input->post('Identificador')));
					break;

				default:
					redirect(base_url('admin/productos/actualizar?id='.$this->input->post('Identificador')));
					break;
			}


    }else{

			if(isset($_POST['Identificador'])){
				$this->data['producto'] = $this->ProductosModel->detalles($_POST['Identificador']);
			}else{
				$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
			}
			$this->data['usuarios'] = $this->UsuariosModel->lista([ 'USUARIO_ESTADO'=>'activo' ],'','','','');
			$this->data['usuario_producto'] = $this->UsuariosModel->detalles($this->data['producto']['ID_USUARIO']);
			$this->data['tienda'] = $this->TiendasModel->tienda_usuario($this->data['usuario_producto']['ID_USUARIO']);
			$this->data['galerias'] = $this->GaleriasModel->lista($_GET['id'],'ORDEN ASC','');
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$tipo_categoria,'','');
			$this->data['relacion_categorias'] = $this->CategoriasProductoModel->lista($_GET['id']);
			$this->data['transportistas'] = $this->TransportistasModel->lista(['TRANSPORTISTA_ESTADO'=>'activo'],'','');
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
			$parametros = array( 'PRODUCTO_ESTADO' => 'borrado');
			$this->ProductosModel->actualizar( $_GET['id'],$parametros);

			$this->session->set_flashdata('exito', 'Producto borrado');
			// redirección
			 redirect(base_url('admin/productos?id_usuario=').$_GET['id_usuario']);
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
		redirect(base_url('admin/productos?id_usuario='.$_GET['id_usuario']));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
