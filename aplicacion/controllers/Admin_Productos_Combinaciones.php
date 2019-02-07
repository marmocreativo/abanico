<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Productos_Combinaciones extends CI_Controller {

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
		$this->load->model('ProductosCombinacionesModel');
		$this->load->model('EstadisticasModel');
		$this->load->model('NotificacionesModel');

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

			$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
			$this->data['combinaciones'] = $this->ProductosCombinacionesModel->lista($_GET['id'],'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_combinaciones',$this->data);
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
		$this->form_validation->set_rules('GrupoCombinacion', 'Grupo', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('OpcionCombinacion', 'Opcion', 'required', array( 'required' => 'Debes designar la %s'));

		if($this->form_validation->run())
		{
			// Parametros del producto
			$parametros = array(
				'ID_PRODUCTO'=> $this->input->post('IdProducto'),
				'COMBINACION_GRUPO'=> $this->input->post('GrupoCombinacion'),
				'COMBINACION_OPCION'=> $this->input->post('OpcionCombinacion'),
				'COMBINACION_PRECIO'=> $this->input->post('PrecioCombinacion'),
				'COMBINACION_ANCHO'=> $this->input->post('AnchoCombinacion'),
				'COMBINACION_ALTO'=> $this->input->post('AltoCombinacion'),
				'COMBINACION_PROFUNDO'=> $this->input->post('ProfundoCombinacion'),
				'COMBINACION_PESO'=> $this->input->post('PesoCombinacion'),
			);
			// Creo el Producto
			$combinacion_id = $this->ProductosCombinacionesModel->crear($parametros);

			// Mensaje Retroalimentación
			$this->session->set_flashdata('exito', 'Combinación Creado!');
			// Redirección
			redirect(base_url('admin/productos_combinaciones?id='.$this->input->post('IdProducto')));
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
		// Defino el tipo de Categoria
		$this->form_validation->set_rules('GrupoCombinacion', 'Grupo', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('OpcionCombinacion', 'Opcion', 'required', array( 'required' => 'Debes designar la %s'));

			if($this->form_validation->run())
			{
				// Parametros del producto
				$parametros = array(
					'ID_PRODUCTO'=> $this->input->post('IdProducto'),
					'COMBINACION_GRUPO'=> $this->input->post('GrupoCombinacion'),
					'COMBINACION_OPCION'=> $this->input->post('OpcionCombinacion'),
					'COMBINACION_PRECIO'=> $this->input->post('PrecioCombinacion'),
					'COMBINACION_ANCHO'=> $this->input->post('AnchoCombinacion'),
					'COMBINACION_ALTO'=> $this->input->post('AltoCombinacion'),
					'COMBINACION_PROFUNDO'=> $this->input->post('ProfundoCombinacion'),
					'COMBINACION_PESO'=> $this->input->post('PesoCombinacion'),
				);
				// Creo el Producto
				$producto_id = $this->ProductosCombinacionesModel->actualizar($this->input->post('Identificador'),$parametros);

				// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Actualización correcta');
			// Redirección
			redirect(base_url('admin/productos_combinaciones?id='.$this->input->post('IdProducto')));
    }else{

			$this->data['combinacion'] = $this->ProductosCombinacionesModel->detalles($_GET['id']);
			$this->data['producto'] = $this->ProductosModel->detalles($this->data['combinacion']['ID_PRODUCTO']);
			$this->data['usuario_producto'] = $this->UsuariosModel->detalles($this->data['producto']['ID_USUARIO']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_combinaciones',$this->data);
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
