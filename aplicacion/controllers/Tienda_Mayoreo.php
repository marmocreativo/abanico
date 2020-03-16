<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Mayoreo extends CI_Controller {
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

		$this->load->model('TiendaModel');
		$this->load->model('ProductosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasProductoModel');
		$this->load->model('CalificacionesModel');
		$this->load->model('ServiciosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('GaleriasServiciosModel');
		$this->load->model('CalificacionesServiciosModel');
		$this->load->model('ProductosRangosMayoreoModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('TraduccionesModel');
		$this->load->model('PublicacionesModel');
		$this->load->model('PlanesModel');
		$this->load->model('DivisasModel');
		$this->load->model('GeneralModel');

		// Verifico Sesión
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		// Verifico Permiso
		if(!verificar_permiso(['ven-7','adm-6'])){
			$this->session->set_flashdata('alerta', 'No tienes permiso de entrar en esa sección');
			redirect(base_url('usuario'));
		}

		// Variables comunes
  }

	public function index()
	{
		$this->data['titulo'] = 'Sistema de ventas mayoreo';
		$this->data['descripcion'] = 'Administración y pedidos';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/pagina_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
	}


	 public function productos()
 {
		$parametros_or = array();
		$parametros_and = array();
		// Orden
		if(isset($_GET['OrdenBusqueda'])&&!empty($_GET['OrdenBusqueda'])){
			switch ($_GET['OrdenBusqueda']) {
			 case 'precio_desc':
				 $orden = 'PRODUCTO_PRECIO DESC';
				 break;
			 case 'precio_asc':
				 $orden = 'PRODUCTO_PRECIO ASC';
				 break;
			 case 'alfabetico_desc':
				 $orden = 'PRODUCTO_NOMBRE DESC';
				 break;
			 case 'alfabetico_asc':
				 $orden = 'PRODUCTO_NOMBRE ASC';
				 break;
			 default:
				 $orden = 'PRODUCTO_NOMBRE ASC';
				 break;
			}
		}else{
			$orden = '';
		}
		// Origen
		if(isset($_GET['OrigenBusqueda'])&&!empty($_GET['OrigenBusqueda'])){
			switch ($_GET['OrigenBusqueda']) {
			 case 'cualquiera':
			 // NO hago nada
				 break;
			 case 'nacionales':
				 $parametros_and['PRODUCTO_ORIGEN'] = 'México';
				 break;
			 case 'Importados':
				 $parametros_and['PRODUCTO_ORIGEN'] = 'Otro';
				 break;
			 default:
				 // NO hago nada
				 break;
			}
		}
		// Condición
		if(isset($_GET['CondicionBusqueda'])&&!empty($_GET['CondicionBusqueda'])){
			switch ($_GET['CondicionBusqueda']) {
			 case 'cualquiera':
			 // NO hago nada
				 break;
			 case 'nuevo':
				 $parametros_and['PRODUCTO_CONDICION'] = 'nuevo';
				 break;
			 case 'usado':
				 $parametros_and['PRODUCTO_CONDICION'] = 'usado';
				 break;
			 default:
				 // NO hago nada
				 break;
			}
		}
	 // OfertaBusqueda
		if(isset($_GET['OfertaBusqueda'])){
			$parametros_and['PRODUCTO_PRECIO_LISTA >'] = 0;
		}
		// Artesanales
	 if(isset($_GET['ArtesanalBusqueda'])){
		 $parametros_and['PRODUCTO_ARTESANAL'] = 'si';
	 }

 	$this->data['parametros_or'] = $parametros_or;
 	$this->data['parametros_and'] = $parametros_and;
  $this->data['orden'] = $orden;

		if(isset($_GET['slug'])&&!empty($_GET['slug'])){
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'productos','','');
			$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'servicios','','');
			$this->data['categoria'] = $this->CategoriasModel->detalles_slug($_GET['slug']);
			$this->data['origen_formulario'] = 'categoria';
			$this->data['productos'] = $this->ProductosModel->lista_mayoreo($parametros_or,$parametros_and,[$this->data['categoria']['ID_CATEGORIA']],$orden,'');
			$this->data['primary'] = $this->data['categoria']['CATEGORIA_COLOR'];

			$this->data['titulo'] = $this->data['categoria']['CATEGORIA_NOMBRE'].'| Abanico siempre lo mejor';
			$this->data['descripcion'] = $this->data['categoria']['CATEGORIA_DESCRIPCION'];
			$this->data['keywords'] = $this->data['categoria']['META_KEYWORDS'];
			$this->data['imagen'] = base_url('contenido/img/categorias/completo/'.$this->data['categoria']['CATEGORIA_IMAGEN']);

	 		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/categoria_productos',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
		}else{
			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'productos','','');
			$this->data['categorias_hijas'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'productos','','');
			$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'servicios','','');
			$this->data['productos'] = $this->ProductosModel->lista_mayoreo($parametros_or,$parametros_and,'',$orden,'');
			$this->data['origen_formulario'] = 'categoria';

			$this->data['titulo'] = 'Todos los productos | Abanico siempre lo mejor';
			$this->data['descripcion'] = 'Compra y vende artículos por internet';
			$this->data['keywords'] = '';
			$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

	 		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/categoria_productos',$this->data);
	 		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
		}
 	}

	public function lista_empresas()
	{
		$this->data['titulo'] = 'Sistema de ventas mayoreo';
		$this->data['descripcion'] = 'Administración y pedidos';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		if(!null==$this->input->get('busqueda')){
			$this->data['empresas'] = $this->GeneralModel->lista('empresas',[
				'EMPRESA_NOMBRE'=>$this->input->get('busqueda'),
				'RFC'=>$this->input->get('busqueda'),
				'CONTACTO_NOMBRE'=>$this->input->get('busqueda'),
				'CONTACTO_APELLIDOS'=>$this->input->get('busqueda'),
				'CONTACTO_CORREO'=>$this->input->get('busqueda')
			],['ESTADO'=>'activo'],'ID DESC','','');
		}else{
			$this->data['empresas'] = $this->GeneralModel->lista('empresas','',['ESTADO'=>'activo'],'ID DESC','','');
		}



		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/lista_empresas',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
	}

	public function crear_empresa()
	{
		$this->data['titulo'] = 'Crear empresa';
		$this->data['descripcion'] = 'Registros de empresas';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->form_validation->set_rules('NombreEmpresa', 'Nombre de la empresa', 'required', array( 'required' => 'Debes designar el %s.' ));
		$this->form_validation->set_rules('CorreoContacto', 'Correo de contacto', 'required', array( 'required' => 'Debes designar el %s.' ));

		if($this->form_validation->run())
    {

			$parametros = array(
				'EMPRESA_NOMBRE' => $this->input->post('NombreEmpresa'),
				'RAZON_SOCIAL' => $this->input->post('RazonSocialEmpresa'),
				'RFC' => $this->input->post('RfcEmpresa'),
				'DOMICILIO' => $this->input->post('DireccionEmpresa'),
				'TELEFONO' => $this->input->post('TelefonoContacto'),
				'CONTACTO_NOMBRE' => $this->input->post('NombreContacto'),
				'CONTACTO_APELLIDOS' => $this->input->post('ApellidosContacto'),
				'CONTACTO_CORREO' => $this->input->post('CorreoContacto')
			);

			$id_empresa = $this->GeneralModel->crear('empresas',$parametros);

			$this->session->set_flashdata('exito', 'Empresa creada correctamente');
      redirect(base_url('tienda-mayoreo/lista_empresas'));

    }else{
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/form_empresas',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
		}
	}

	public function actualizar_empresa()
	{
		$this->data['titulo'] = 'Crear empresa';
		$this->data['descripcion'] = 'Registros de empresas';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->form_validation->set_rules('NombreEmpresa', 'Nombre de la empresa', 'required', array( 'required' => 'Debes designar el %s.' ));
		$this->form_validation->set_rules('CorreoContacto', 'Correo de contacto', 'required', array( 'required' => 'Debes designar el %s.' ));

		if($this->form_validation->run())
		{

			$parametros = array(
				'EMPRESA_NOMBRE' => $this->input->post('NombreEmpresa'),
				'RAZON_SOCIAL' => $this->input->post('RazonSocialEmpresa'),
				'RFC' => $this->input->post('RfcEmpresa'),
				'DOMICILIO' => $this->input->post('DireccionEmpresa'),
				'TELEFONO' => $this->input->post('TelefonoContacto'),
				'CONTACTO_NOMBRE' => $this->input->post('NombreContacto'),
				'CONTACTO_APELLIDOS' => $this->input->post('ApellidosContacto'),
				'CONTACTO_CORREO' => $this->input->post('CorreoContacto')
			);

			$id_empresa = $this->GeneralModel->actualizar('empresas',['ID'=>$this->input->post('Identificador')],$parametros);

			$this->session->set_flashdata('exito', 'Empresa creada correctamente');
			redirect(base_url('tienda-mayoreo/lista_empresas'));

		}else{

			$this->data['empresa']  = $this->GeneralModel->detalles('empresas',['ID'=>$_GET['id_empresa']]);

			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/form_actualizar_empresas',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
		}
	}
}
