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
		if(!verificar_permiso(['may-7','adm-6'])){
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

	public function lista_pedidos()
	{
		$this->data['titulo'] = 'Sistema de ventas mayoreo';
		$this->data['descripcion'] = 'Administración y pedidos';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		if(!null==$this->input->get('id_empresa')){
			$this->data['pedidos'] = $this->GeneralModel->lista('pedidos_mayoreo','',[
				'ID_COMPRADOR'=>$this->input->get('id_empresa')
			],'ID_PEDIDO DESC','','');
		}else{
			$this->data['pedidos'] = $this->GeneralModel->lista('pedidos_mayoreo','','','ID_PEDIDO DESC','','');
		}

		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/lista_pedidos',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
	}

	public function lista_citas()
	{
		$this->data['titulo'] = 'Sistema de ventas mayoreo';
		$this->data['descripcion'] = 'Administración y pedidos';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		if(!null==$this->input->get('id_empresa')){
			$this->data['citas'] = $this->GeneralModel->lista('pedidos_mayoreo_citas','',[
				'ID_COMPRADOR'=>$this->input->get('id_empresa')
			],'ID_PEDIDO DESC','','');
		}else{
			$this->data['citas'] = $this->GeneralModel->lista('pedidos_mayoreo_citas','','','ID_PEDIDO DESC','','');
		}

		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/lista_citas',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
	}

	public function crear_cita()
	{
		$this->data['titulo'] = 'Crear empresa';
		$this->data['descripcion'] = 'Registros de empresas';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->form_validation->set_rules('FechaCita', 'Fecha de la cita', 'required', array( 'required' => 'Debes designar el %s.' ));

		if($this->form_validation->run())
    {

			switch ($_POST['Comprador']) {
				case 'auto':
						$id_comprador = $_SESSION['usuario']['id'];
						$nombre_comprador = $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];
						$correo_comprador = $_SESSION['usuario']['correo'];
						$telefono_comprador = $_SESSION['usuario']['correo'];
						$direccion_comprador = $_SESSION['usuario']['correo'];
					break;
				case 'nueva':
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


						$id_comprador = $id_empresa;
						$nombre_comprador = $this->input->post('NombreContacto').' '.$this->input->post('ApellidosContacto');
						$correo_comprador = $this->input->post('CorreoContacto');
						$telefono_comprador = $this->input->post('TelefonoContacto');
						$direccion_comprador = $this->input->post('DireccionEmpresa');
					break;

				default:
						$this->data['empresa']  = $this->GeneralModel->detalles('empresas',['ID'=>$_POST['Comprador']]);
						$id_comprador = $this->data['empresa']['ID'];
						$nombre_comprador = $this->data['empresa']['CONTACTO_NOMBRE'].' '.$this->data['empresa']['CONTACTO_APELLIDOS'];
						$correo_comprador = $this->data['empresa']['CONTACTO_CORREO'];
						$telefono_comprador = $this->data['empresa']['TELEFONO'];
						$direccion_comprador = $this->data['empresa']['DOMICILIO'];
					break;
			}

			$hora = $this->input->post('Hora').':'.$this->input->post('Minutos').' '.$this->input->post('AmPm');

			$parametros_cita = array(
				'ID_VENDEDOR'=>$_SESSION['usuario']['id'],
				'ID_COMPRADOR'=>$id_comprador,
				'PEDIDO_NOMBRE'=>$nombre_comprador,
				'PEDIDO_CORREO'=>$correo_comprador,
				'PEDIDO_TELEFONO'=>$telefono_comprador,
				'PEDIDO_DIRECCION'=>$direccion_comprador,
				'PEDIDO_FECHA_REGISTRO'=>date('Y-m-d H:i:s'),
				'PEDIDO_FECHA_CITA'=>$this->input->post('FechaCita'),
				'PEDIDO_HORA_CITA'=>$hora,
			);

			$id_empresa = $this->GeneralModel->crear('pedidos_mayoreo_citas',$parametros_cita);

			$this->session->set_flashdata('exito', 'Cita agendada correctamente');
      redirect(base_url('tienda-mayoreo/lista_citas'));

    }else{

			$this->data['empresas'] = $this->GeneralModel->lista('empresas','',['ESTADO'=>'activo'],'ID DESC','','');
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/form_cita',$this->data);
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

	public function pedido_confirmacion()
	{
		$this->data['titulo'] = 'Confirmación de pedido';
		$this->data['descripcion'] = 'Administración y pedidos';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->data['empresas'] = $this->GeneralModel->lista('empresas','',['ESTADO'=>'activo'],'ID DESC','','');

		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/pedido_confirmacion',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
	}

	public function crear_pedido()
	{
		switch ($_POST['Comprador']) {
			case 'auto':
					$id_comprador = $_SESSION['usuario']['id'];
					$nombre_comprador = $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];
					$correo_comprador = $_SESSION['usuario']['correo'];
					$telefono_comprador = $_SESSION['usuario']['correo'];
					$direccion_comprador = $_SESSION['usuario']['correo'];
				break;
			case 'nueva':
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


					$id_comprador = $id_empresa;
					$nombre_comprador = $this->input->post('NombreContacto').' '.$this->input->post('ApellidosContacto');
					$correo_comprador = $this->input->post('CorreoContacto');
					$telefono_comprador = $this->input->post('TelefonoContacto');
					$direccion_comprador = $this->input->post('DireccionEmpresa');
				break;

			default:
					$this->data['empresa']  = $this->GeneralModel->detalles('empresas',['ID'=>$_POST['Comprador']]);
					$id_comprador = $this->data['empresa']['ID'];
					$nombre_comprador = $this->data['empresa']['CONTACTO_NOMBRE'].' '.$this->data['empresa']['CONTACTO_APELLIDOS'];
					$correo_comprador = $this->data['empresa']['CONTACTO_CORREO'];
					$telefono_comprador = $this->data['empresa']['TELEFONO'];
					$direccion_comprador = $this->data['empresa']['DOMICILIO'];
				break;
		}

		// Creo el pedido
		$folio = folio_pedido();

		$parametros_pedido = array(
			'PEDIDO_FOLIO'=>$folio,
			'ID_VENDEDOR'=>$_SESSION['usuario']['id'],
			'ID_COMPRADOR'=>$id_comprador,
			'PEDIDO_NOMBRE'=>$nombre_comprador,
			'PEDIDO_CORREO'=>$correo_comprador,
			'PEDIDO_TELEFONO'=>$telefono_comprador,
			'PEDIDO_DIRECCION'=>$direccion_comprador,
			'PEDIDO_ESTADO_PAGO'=>'pendiente',
			'PEDIDO_ESTADO_PEDIDO'=>'pendiente',
			'PEDIDO_TIPO'=>$this->input->post('TipoPedido'),
			'PEDIDO_ESTADO_PEDIDO'=>'confirmado',
			'PEDIDO_FECHA_REGISTRO'=>date('Y-m-d H:i:s'),
			'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s'),
		);

		$id_pedido = $this->GeneralModel->crear('pedidos_mayoreo',$parametros_pedido);

		// Cargo los productos al pedido
		$suma_total = 0;

		// Bucle de Pedidos Productos
		foreach($_SESSION['carrito']['productos'] as $producto){
				// variables de precio

					$precio_venta = $producto['precio_producto'];
					$suma = $producto['cantidad_producto']*$producto['precio_producto'];


			$parametros_productos = array(
				'ID_PEDIDO'=>$id_pedido,
				'ID_PRODUCTO'=>$producto['id_producto'],
				'PRODUCTO_NOMBRE'=>$producto['nombre_producto'],
				'PRODUCTO_DETALLES'=>$producto['detalles_producto'],
				'PRODUCTO_IMAGEN'=>$producto['imagen_producto'],
				'CANTIDAD'=>$producto['cantidad_producto'],
				'IMPORTE'=>number_format($precio_venta,2,'.',''),
				'IMPORTE_TOTAL'=>number_format($producto['cantidad_producto']*$precio_venta,2,'.',''),
			);
			$this->GeneralModel->crear('pedidos_mayoreo_productos',$parametros_productos);

			$producto_a_actualizar = $this->ProductosModel->detalles($producto['id_producto']);
			$combinacion_a_actualizar = $this->GeneralModel->detalles('productos_combinaciones',['ID_COMBINACION'=>$producto['id_combinacion']]);

			if(empty($combinacion_a_actualizar)){
				$nueva_cantidad = $producto_a_actualizar['PRODUCTO_CANTIDAD']-$producto['cantidad_producto'];
				if($nueva_cantidad<0){
					$nueva_cantidad = 0;
				}
				$cantidad = array(
					'PRODUCTO_CANTIDAD'=>$nueva_cantidad
				);
				$this->ProductosModel->actualizar($producto['id_producto'],$cantidad);

				// Ajustar cantidades
				$movimiento_cantidad_anterior = $producto_a_actualizar['PRODUCTO_CANTIDAD'];
				$movimiento_cantidad_nueva = $nueva_cantidad;

				if($movimiento_cantidad_nueva!=$movimiento_cantidad_anterior){
					$parametros_movimiento = array(
						'ORIGEN'=>'mayoreo',
						'ID_PEDIDO'=>$id_pedido,
						'ID_PRODUCTO'=>$producto['id_producto'],
						'ID_COMBINACION'=>$producto['id_combinacion'],
						'TIPO_MOVIMIENTO'=>'pedido',
						'DETALLES'=>'Compra pedido '.$folio,
						'CANTIDAD_ORIGINAL'=>$movimiento_cantidad_anterior,
						'CANTIDAD_FINAL'=>$movimiento_cantidad_nueva,
						'FECHA'=>date('Y-m-d H:i:s'),
						'ID_USUARIO'=>$_SESSION['usuario']['id']
					);

					$movimiento = $this->GeneralModel->crear('movimientos',$parametros_movimiento);
				}

			}else{

				$nueva_cantidad = $combinacion_a_actualizar['COMBINACION_CANTIDAD']-$producto['cantidad_producto'];

				$parametros_cantidad_combinacion = array(
					'COMBINACION_CANTIDAD'=>$nueva_cantidad
				);

				$this->GeneralModel->actualizar('productos_combinaciones',['ID_COMBINACION'=>$producto['id_combinacion']],$parametros_cantidad_combinacion);

				// Ajustar cantidades
				$cantidades_combinaciones = $this->GeneralModel->lista('productos_combinaciones','',['ID_PRODUCTO'=>$producto['id_producto']],'','','');
				$detalles_producto =  $this->GeneralModel->detalles('productos',['ID_PRODUCTO'=>$producto['id_producto']]);

				$movimiento_cantidad_anterior = $detalles_producto['PRODUCTO_CANTIDAD'];
				$movimiento_cantidad_nueva = 0;
				foreach($cantidades_combinaciones as $cantidad){
					$movimiento_cantidad_nueva += $cantidad->COMBINACION_CANTIDAD;
				}

				if($movimiento_cantidad_nueva!=$movimiento_cantidad_anterior){
					$parametros_movimiento = array(
						'ORIGEN'=>'mayoreo',
						'ID_PEDIDO'=>$id_pedido,
						'ID_PRODUCTO'=>$producto['id_producto'],
						'ID_COMBINACION'=>$producto['id_combinacion'],
						'TIPO_MOVIMIENTO'=>'pedido',
						'DETALLES'=>'Compra pedido '.$folio,
						'CANTIDAD_ORIGINAL'=>$movimiento_cantidad_anterior,
						'CANTIDAD_FINAL'=>$movimiento_cantidad_nueva,
						'FECHA'=>date('Y-m-d H:i:s'),
						'ID_USUARIO'=>$_SESSION['usuario']['id']
					);

					$movimiento = $this->GeneralModel->crear('movimientos',$parametros_movimiento);
					$parametros_cantidad_producto = array(
						'PRODUCTO_CANTIDAD'=>$movimiento_cantidad_nueva
					);
					$this->GeneralModel->actualizar('productos',['ID_PRODUCTO'=>$producto['id_producto']],$parametros_cantidad_producto);
				}
			} // Termina la actualizacion de combinaciones y productos
			$suma_total += $suma;
		} // Termina el bucle de productos

		// Actualizo importe_total

		$importe = array(
			'	PEDIDO_IMPORTE_TOTAL' =>$suma_total
		);

		$this->GeneralModel->actualizar('pedidos_mayoreo',['ID_PEDIDO'=>$id_pedido],$importe);

		unset($_SESSION['carrito']['tiendas']);
		unset($_SESSION['carrito']['productos']);
		unset($_SESSION['pedido']);
		$_SESSION['carrito']['productos']=array();
		$_SESSION['carrito']['tiendas']=array();
		$_SESSION['pedido']=array();

		// Confirmo y redirecciono
		$this->session->set_flashdata('exito', 'Pedido creado correctamente');
		redirect(base_url('tienda-mayoreo/pedido_detalles?id_pedido='.$id_pedido));

	}

	public function pedido_firma()
	{
		$this->data['titulo'] = 'Firma de pedido';
		$this->data['descripcion'] = 'Administración y pedidos';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->data['pedido'] = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$_GET['id_pedido']]);
		$this->data['productos_pedido'] = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$_GET['id_pedido']],'ID DESC','','');

		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/pedido_firma',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
	}

	public function firmar_pedido()
	{
		$parametros_pedido = array(
			'PEDIDO_TIPO'=>$this->input->post('TipoPedido'),
			'PEDIDO_ESTADO_PEDIDO'=>'confirmado'
		);

		$this->GeneralModel->actualizar('pedidos_mayoreo',['ID_PEDIDO'=>$this->input->post('Identificador')],$parametros_pedido);

		// Confirmo y redirecciono
		$this->session->set_flashdata('exito', 'Pedido creado correctamente');
		redirect(base_url('tienda-mayoreo/pedido_detalles?id_pedido='.$this->input->post('Identificador')));
	}

	public function pedido_detalles()
	{
		$this->data['titulo'] = 'Detalles del pedido';
		$this->data['descripcion'] = 'Administración y pedidos';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->data['pedido'] = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$_GET['id_pedido']]);
		$this->data['productos_pedido'] = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$_GET['id_pedido']],'ID DESC','','');

		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/pedido_detalles',$this->data);
		$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
	}
	public function pedido_actualizar()
	{
		$this->data['titulo'] = 'Actualizar Pedido';
		$this->data['descripcion'] = 'Registros de empresas';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->form_validation->set_rules('Identificador', 'Id del pedido', 'required', array( 'required' => 'Debes designar el %s.' ));

		if($this->form_validation->run())
		{

			$parametros_pedido = array(
				'PEDIDO_NOMBRE'=>$this->input->post('NombrePedido'),
				'PEDIDO_CORREO'=>$this->input->post('CorreoPedido'),
				'PEDIDO_TELEFONO'=>$this->input->post('TelefonoPedido'),
				'PEDIDO_DIRECCION'=>$this->input->post('DireccionPedido'),
				'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s'),
			);

			$this->GeneralModel->actualizar('pedidos_mayoreo',['ID_PEDIDO'=>$this->input->post('Identificador')],$parametros_pedido);

			$this->session->set_flashdata('exito', 'Pedido actualizado correctamente');
			redirect(base_url('tienda-mayoreo/pedido_detalles?id_pedido='.$this->input->post('Identificador')));

		}else{

			$this->data['pedido'] = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$_GET['id_pedido']]);
			$this->data['productos_pedido'] = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$_GET['id_pedido']],'ID DESC','','');

			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/form_actualizar_pedido',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
		}

	}
	public function pedido_envio()
	{
		$this->data['titulo'] = 'Actualizar Pedido';
		$this->data['descripcion'] = 'Registros de empresas';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->form_validation->set_rules('Identificador', 'Id del pedido', 'required', array( 'required' => 'Debes designar el %s.' ));

		if($this->form_validation->run())
		{

			$importe_productos = $this->input->post('ImporteProductosParcialPedido');
			$importe_impuestos = $this->input->post('ImporteImpuestosPedido');
			$importe_envio = $this->input->post('ImporteEnvioTotalPedido');

			$importe_total = $importe_productos+$importe_impuestos+$importe_envio;

			$parametros_pedido = array(
				'PEDIDO_NOMBRE_TRANSPORTISTA'=>$this->input->post('NombreTransportistaPedido'),
				'PEDIDO_IMPORTE_ENVIO_TOTAL'=>$this->input->post('ImporteEnvioTotalPedido'),
				'PEDIDO_IMPORTE_TOTAL'=>$importe_total,
				'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s'),
			);

			$this->GeneralModel->actualizar('pedidos_mayoreo',['ID_PEDIDO'=>$this->input->post('Identificador')],$parametros_pedido);

			$this->session->set_flashdata('exito', 'Pedido actualizado correctamente');
			redirect(base_url('tienda-mayoreo/pedido_detalles?id_pedido='.$this->input->post('Identificador')));

		}else{

			$this->data['pedido'] = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$_GET['id_pedido']]);
			$this->data['productos_pedido'] = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$_GET['id_pedido']],'ID DESC','','');

			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/form_envio_pedido',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
		}

	}
	public function pedido_impuestos()
	{
		$this->data['titulo'] = 'Actualizar Pedido';
		$this->data['descripcion'] = 'Registros de empresas';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->form_validation->set_rules('Identificador', 'Id del pedido', 'required', array( 'required' => 'Debes designar el %s.' ));

		if($this->form_validation->run())
		{

			$importe_productos = $this->input->post('ImporteProductosParcialPedido');
			$importe_impuestos = $this->input->post('ImporteImpuestosPedido');
			$importe_envio = $this->input->post('ImporteEnvioTotalPedido');

			$importe_total = $importe_productos+$importe_impuestos+$importe_envio;

			$parametros_pedido = array(
				'PEDIDO_IMPORTE_IMPUESTOS'=>$this->input->post('ImporteImpuestosPedido'),
				'PEDIDO_IMPUESTO_DETALLES'=>$this->input->post('ImpuestoDetallesPedido'),
				'PEDIDO_IMPORTE_TOTAL'=>$importe_total,
				'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s'),
			);

			$this->GeneralModel->actualizar('pedidos_mayoreo',['ID_PEDIDO'=>$this->input->post('Identificador')],$parametros_pedido);

			$this->session->set_flashdata('exito', 'Pedido actualizado correctamente');
			redirect(base_url('tienda-mayoreo/pedido_detalles?id_pedido='.$this->input->post('Identificador')));

		}else{

			$this->data['pedido'] = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$_GET['id_pedido']]);
			$this->data['productos_pedido'] = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$_GET['id_pedido']],'ID DESC','','');

			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/form_impuestos_pedido',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
		}

	}
	public function pedido_precios()
	{
		$this->data['titulo'] = 'Actualizar Pedido';
		$this->data['descripcion'] = 'Registros de empresas';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->form_validation->set_rules('Identificador', 'Id del pedido', 'required', array( 'required' => 'Debes designar el %s.' ));

		if($this->form_validation->run())
		{

			$suma = $this->input->post('Cantidad')*$this->input->post('Importe');
			$parametros_precio = array(
				'CANTIDAD'=>$this->input->post('Cantidad'),
				'IMPORTE'=>$this->input->post('Importe'),
				'IMPORTE_TOTAL'=>$suma
			);
			$this->GeneralModel->actualizar('pedidos_mayoreo_productos',['ID'=>$this->input->post('IdProducto')],$parametros_precio);
			$productos = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$this->input->post('Identificador')],'ID DESC','','');

			$suma_productos = 0;
			foreach($productos as $producto){
				$suma_productos+=($producto->CANTIDAD*$producto->IMPORTE);
			};

			//var_dump($suma_productos);


			$importe_productos = $suma_productos;
			$importe_impuestos = $this->input->post('ImporteImpuestosPedido');
			$importe_envio = $this->input->post('ImporteEnvioTotalPedido');

			$importe_total = $importe_productos+$importe_impuestos+$importe_envio;
			$parametros_pedido = array(
				'PEDIDO_IMPORTE_PRODUCTOS_PARCIAL'=>$importe_productos,
				'PEDIDO_IMPORTE_TOTAL'=>$importe_total,
				'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s'),
			);

			$this->GeneralModel->actualizar('pedidos_mayoreo',['ID_PEDIDO'=>$this->input->post('Identificador')],$parametros_pedido);

			$this->session->set_flashdata('exito', 'Pedido actualizado correctamente');
			redirect(base_url('tienda-mayoreo/pedido_detalles?id_pedido='.$this->input->post('Identificador')));

		}else{

			$this->data['pedido'] = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$_GET['id_pedido']]);
			$this->data['productos_pedido'] = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$_GET['id_pedido']],'ID DESC','','');

			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/form_precios_pedido',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
		}

	}

	public function pedido_pago()
	{
		$this->data['titulo'] = 'Actualizar Pedido';
		$this->data['descripcion'] = 'Registros de empresas';
		$this->data['keywords'] = '';
		$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');

		$this->form_validation->set_rules('Identificador', 'Id del pedido', 'required', array( 'required' => 'Debes designar el %s.' ));

		if($this->form_validation->run())
		{
			$parametros_pedido = array(
				'PEDIDO_FORMA_PAGO'=>$this->input->post('FormaPagoPedido'),
				'PEDIDO_ESTADO_PAGO'=>$this->input->post('EstadoPagoPedido'),
				'PEDIDO_ESTADO_PEDIDO'=>'pagado',
			);

			$this->GeneralModel->actualizar('pedidos_mayoreo',['ID_PEDIDO'=>$this->input->post('Identificador')],$parametros_pedido);

			$this->session->set_flashdata('exito', 'Pedido actualizado correctamente');
			redirect(base_url('tienda-mayoreo/pedido_detalles?id_pedido='.$this->input->post('Identificador')));

		}else{

			$this->data['pedido'] = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$_GET['id_pedido']]);
			$this->data['productos_pedido'] = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$_GET['id_pedido']],'ID DESC','','');

			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/headers/header_inicio',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/pedido_pago',$this->data);
			$this->load->view($this->data['dispositivo'].'/tienda_mayoreo/footers/footer_inicio',$this->data);
		}
	}
}
