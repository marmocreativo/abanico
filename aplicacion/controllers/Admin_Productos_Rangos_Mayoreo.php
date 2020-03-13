<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Productos_Rangos_Mayoreo extends CI_Controller {

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
		$this->load->model('ProductosRangosMayoreoModel');
		$this->load->model('GaleriasModel');
		$this->load->model('EstadisticasModel');
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
			// Tipo de Producto
			if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }

			$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
			$this->data['usuario'] = $this->UsuariosModel->detalles($this->data['producto']['ID_USUARIO']);
			$this->data['tienda'] = $this->TiendasModel->detalles($this->data['producto']['ID_TIENDA']);
			$this->data['rangos_mayoreo'] = $this->ProductosRangosMayoreoModel->lista($_GET['id'],'ORDEN ASC','');
			$this->data['galerias'] = $this->GaleriasModel->lista($_GET['id'],'ORDEN ASC','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/rangos_mayoreo',$this->data);
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
		// Defino el tipo de Categoria
		$this->form_validation->set_rules('UnidadRango', 'Grupo', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('MinimoRango', 'Opcion', 'required', array( 'required' => 'Debes designar la %s'));

		if($this->form_validation->run())
		{
			// Parametros del producto
			$parametros = array(
				'ID_PRODUCTO'=> $this->input->post('IdProducto'),
				'RANGO_UNIDAD'=> $this->input->post('UnidadRango'),
				'RANGO_MIN'=> $this->input->post('MinimoRango'),
				'RANGO_MAX'=> $this->input->post('MaximoRango'),
				'RANGO_PRECIO_UNIDAD'=> $this->input->post('PrecioUnidadRango'),
			);
			// Creo el Producto
			$combinacion_id = $this->ProductosRangosMayoreoModel->crear($parametros);

			// Mensaje Retroalimentación
			$this->session->set_flashdata('exito', 'Rango Creado!');
			// Redirección
			redirect(base_url('admin/productos_rangos_mayoreo?id='.$this->input->post('IdProducto')));
    }else{
			$this->session->set_flashdata('alerta', 'Rango No creada');
			redirect(base_url('admin/productos_rangos_mayoreo?id='.$this->input->post('IdProducto')));
		}
	}


	public function actualizar()
	{
		// Defino el tipo de Categoria
		$this->form_validation->set_rules('UnidadRango', 'Grupo', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('MinimoRango', 'Opcion', 'required', array( 'required' => 'Debes designar la %s'));

			if($this->form_validation->run())
			{
				// Parametros del producto
				$parametros = array(
					'ID_PRODUCTO'=> $this->input->post('IdProducto'),
					'RANGO_UNIDAD'=> $this->input->post('UnidadRango'),
					'RANGO_MIN'=> $this->input->post('MinimoRango'),
					'RANGO_MAX'=> $this->input->post('MaximoRango'),
					'RANGO_PRECIO_UNIDAD'=> $this->input->post('PrecioUnidadRango'),
				);
				// Creo el Producto
				$producto_id = $this->ProductosCombinacionesModel->actualizar($this->input->post('Identificador'),$parametros);

				// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Actualización correcta');
			// Redirección
			redirect(base_url('admin/productos_rangos_mayoreo?id='.$this->input->post('IdProducto')));
    }else{

			$this->data['rango'] = $this->ProductosCombinacionesModel->detalles($_GET['id']);
			$this->data['producto'] = $this->ProductosModel->detalles($this->data['combinacion']['ID_PRODUCTO']);
			$this->data['usuario_producto'] = $this->UsuariosModel->detalles($this->data['producto']['ID_USUARIO']);
			$this->data['galerias'] = $this->GaleriasModel->lista($this->data['producto']['ID_PRODUCTO'],'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_rango_mayoreo',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$combinacion = $this->ProductosCombinacionesModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($combinacion['ID_COMBINACION']))
        {
            $this->ProductosCombinacionesModel->borrar($_GET['id']);
						// Mensaje de Feedback
						$this->session->set_flashdata('exito', 'Combinación Borrada');
						// Redirección
            redirect(base_url('admin/productos_combinaciones?id=').$combinacion['ID_PRODUCTO']);
        } else {
	         	show_error('La entrada que deseas borrar no existe');
				}

	}
}
