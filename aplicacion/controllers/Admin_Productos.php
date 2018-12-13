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
  }

	public function index()
	{
			$this->data['productos'] = $this->ProductosModel->lista('','','','');
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_productos',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}
	public function usuario()
	{
			$this->data['productos'] = $this->ProductosModel->lista('',$_GET['id_usuario'],'','');
			$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_productos',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
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

			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_productos',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/productos'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('NombreProducto', 'Nombre del producto', 'required', array( 'required' => 'Debes designar el %s'));

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
				'PRODUCTO_ESTADO'=> 'activo',
				'ORDEN'=> '1'
      );

      $producto_id = $this->ProductosModel->crear($parametros);
      redirect(base_url('admin/productos/usuario?id_usuario=').$this->input->post('IdUsuario'));
    }else{
			$this->data['usuarios'] = $this->UsuariosModel->lista([ 'USUARIO_ESTADO'=>'activo' ],'','','');
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_producto',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('NombreProducto', 'Nombre del producto', 'required', array( 'required' => 'Debes designar el %s.'));

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
				'PRODUCTO_ESTADO'=> 'activo',
				'ORDEN'=> '1'
      );

      $producto_id = $this->ProductosModel->actualizar( $this->input->post('Identificador'),$parametros);
			redirect(base_url('admin/productos/usuario?id_usuario=').$this->input->post('IdUsuario'));
    }else{

			$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);

			$this->data['usuarios'] = $this->UsuariosModel->lista([ 'USUARIO_ESTADO'=>'activo' ],'','','');
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_producto',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
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
