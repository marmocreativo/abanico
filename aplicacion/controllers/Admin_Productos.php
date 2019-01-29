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
			// Tipo de Producto
			if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }

			// Reviso si hay id del usuario
			if(isset($_GET['id_usuario'])){
				$this->data['productos'] = $this->ProductosModel->lista(['PRODUCTO_TIPO'=>$this->data['tipo_producto']],$_GET['id_usuario'],'PRODUCTO_FECHA_REGISTRO DESC','');
				$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
				$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_GET['id_usuario']);
			}else{
				$this->data['productos'] = $this->ProductosModel->lista(['PRODUCTO_TIPO'=>$this->data['tipo_producto']],'','PRODUCTO_FECHA_REGISTRO DESC','');
			}
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
			// Verifico URL
			$url = url_title($this->input->post('NombreProducto'),'-',TRUE);
			if($this->ProductosModel->verificar_uri($url)){
				$url = url_title($this->input->post('NombreProducto'),'-',TRUE).'-'.uniq_slug(3);
				if($this->ProductosModel->verificar_uri($url)){
					$url = url_title($this->input->post('NombreProducto'),'-',TRUE).'-'.uniq_slug(3);
				}
			}
			// Parametros del producto
			$parametros = array(
				'ID_USUARIO'=> $this->input->post('IdUsuario'),
				'ID_TIENDA'=> $this->input->post('IdTienda'),
				'PRODUCTO_NOMBRE'=> $this->input->post('NombreProducto'),
				'PRODUCTO_URL'=> $url,
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
				'PRODUCTO_PRECIO_LISTA'=> $this->input->post('PrecioListaProducto'),
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
				'PRODUCTO_CONDICION'=> $this->input->post('CondicionProducto'),
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
				// Parametros Categoria
				$parametros_relacion_categorias = array(
					'ID_CATEGORIA'=>$this->input->post('CategoriaProducto'),
					'ID_PRODUCTO'=>$producto_id
				);
				$this->CategoriasProductoModel->crear($parametros_relacion_categorias);
			}
			// Mensaje de feedback
			$this->session->set_flashdata('exito', 'Tu producto se ha actualizado, puedes continuar añadiendo imagenes a la galería');
			// redirección
			redirect(base_url('admin/productos/actualizar?id='.$producto_id));
    }else{
			if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }
			$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_GET['id_usuario']);
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
			$tab='categoria';
			// verifico la Url del Producto
			if(empty($this->input->post('UrlProducto'))){
				// Verifico URL
				$url = url_title($this->input->post('NombreProducto'),'-',TRUE);
				if($this->ProductosModel->verificar_uri($url)){
					$url = url_title($this->input->post('NombreProducto'),'-',TRUE).'-'.uniq_slug(3);
					if($this->ProductosModel->verificar_uri($url)){
						$url = url_title($this->input->post('NombreProducto'),'-',TRUE).'-'.uniq_slug(3);
					}
				}
			}else{
				$url = $this->input->post('UrlProducto');
			}
			// Parametros del producto
			$parametros = array(
				'ID_USUARIO'=> $this->input->post('IdUsuario'),
				'ID_TIENDA'=> $this->input->post('IdTienda'),
				'PRODUCTO_NOMBRE'=> $this->input->post('NombreProducto'),
				'PRODUCTO_URL'=> $url,
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
				'PRODUCTO_PRECIO_LISTA'=> $this->input->post('PrecioListaProducto'),
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
				'PRODUCTO_CONDICION'=> $this->input->post('CondicionProducto'),
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
				$tab='galeria';
			}

			// Borro la relación de categorias
			$this->CategoriasProductoModel->borrar($this->input->post('Identificador'));
			// Reviso si se envió información de categoria
			if(!null==$this->input->post('CategoriaProducto')){
				// Parametros Categoria
				$parametros_relacion_categorias = array(
					'ID_CATEGORIA'=>$this->input->post('CategoriaProducto'),
					'ID_PRODUCTO'=>$this->input->post('Identificador')
				);
				$this->CategoriasProductoModel->crear($parametros_relacion_categorias);
			}
			// Mensaje de Feedback
			$this->session->set_flashdata('exito', 'Actualización correcta');
			// Redirección
			redirect(base_url('admin/productos/actualizar?id=').$this->input->post('Identificador'));
    }else{

			$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
			$this->data['usuarios'] = $this->UsuariosModel->lista([ 'USUARIO_ESTADO'=>'activo' ],'','','');
			$this->data['usuario_producto'] = $this->UsuariosModel->detalles($this->data['producto']['ID_USUARIO']);
			$this->data['tienda'] = $this->TiendasModel->tienda_usuario($this->data['usuario_producto']['ID_USUARIO']);
			$this->data['galerias'] = $this->GaleriasModel->lista($_GET['id'],'','5');
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],$tipo_categoria,'','');
			$this->data['relacion_categorias'] = $this->CategoriasProductoModel->lista($_GET['id']);
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
						// Mensaje de Feedback
						$this->session->set_flashdata('exito', 'Producto Borrado');
						// Redirección
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
		redirect(base_url('admin/productos/usuario?id_usuario='.$_GET['id_usuario']));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
