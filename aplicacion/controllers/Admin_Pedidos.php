<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Pedidos extends CI_Controller {

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
		$this->load->model('PedidosModel');
		$this->load->model('UsuariosModel');
		$this->load->model('PedidosProductosModel');
		$this->load->model('TiendasModel');
		$this->load->model('PedidosTiendasModel');
		$this->load->model('GuiasPedidosModel');
		$this->load->model('PagosPedidosModel');
		$this->load->model('DevolucionesModel');
		$this->load->model('EstadisticasModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('CategoriasModel');
		$this->load->model('ProductosModel');
		$this->load->model('PlanesModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CalificacionesModel');
		$this->load->model('GeneralModel');

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

			// Reviso si hay id del usuario
			if(isset($_GET['id_usuario'])){
				$this->data['pedidos'] = $this->PedidosModel->lista_usuario('',$_GET['id_usuario'],'ID_PEDIDO DESC','');
				$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			}else{
				$this->data['pedidos'] = $this->PedidosModel->lista('','ID_PEDIDO DESC','50');
			}
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_pedidos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function devoluciones()
	{

			// Reviso si hay id del usuario
			if(isset($_GET['id_usuario'])){
				$this->data['devoluciones'] = $this->DevolucionesModel->devoluciones_usuario($_GET['id_usuario'],'DEVOLUCION_FECHA_REGISTRO DESC');
				$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			}else{
				$this->data['devoluciones'] = $this->DevolucionesModel->todas_las_devoluciones('DEVOLUCION_FECHA_REGISTRO DESC');
			}
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_devoluciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'PEDIDO_IMPORTE'=>$_GET['Busqueda'],
				'PEDIDO_NOMBRE'=>$_GET['Busqueda'],
				'PEDIDO_CORREO'=>$_GET['Busqueda']
			);
			if(isset($_GET['id_usuario'])){
				$this->data['pedidos'] = $this->PedidosModel->lista_usuario('',$_GET['id_usuario'],'PEDIDO_FECHA_REGISTRO DESC','');
				$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			}else{
				$this->data['pedidos'] = $this->PedidosModel->lista('','PEDIDO_FECHA_REGISTRO DESC','');
			}

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_pedidos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/productos'));
		}
	}
	public function detalles()
	{
			$this->data['pedido'] = $this->PedidosModel->detalles($_GET['id_pedido']);
			$this->data['usuario'] = $this->UsuariosModel->detalles($this->data['pedido']['ID_USUARIO']);
			$this->data['tiendas'] = $this->PedidosTiendasModel->lista_tiendas($_GET['id_pedido']);
			$this->data['productos'] = $this->PedidosProductosModel->lista(['ID_PEDIDO'=>$_GET['id_pedido']],'','');
			$this->data['guias'] = $this->GuiasPedidosModel->lista_guias($_GET['id_pedido']);
			$this->data['pagos'] = $this->PagosPedidosModel->lista($_GET['id_pedido']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/detalles_pedido',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function actualizar_estado()
	{
			$parametros = array(
				'PEDIDO_ESTADO_PEDIDO'=>$this->input->post('EstadoPedido'),
				'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s')
			);
			// Actualizo Pedido
			$this->PedidosModel->actualizar($this->input->post('IdPedido'),$parametros);
			// Actualizo Pago si es que es "Pagado"
			if($this->input->post('EstadoPedido')=='Pagado'){
				$parametros_pago = array(
					'PAGO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
					'PAGO_ESTADO'=> $this->input->post('EstadoPedido'),
				);
				 $this->PagosPedidosModel->actualizar($this->input->post('IdPedido'),$parametros_pago);

				 $parametros = array(
	 				'PEDIDO_ESTADO_PAGO'=>$this->input->post('EstadoPedido'),
					'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s')
				);

				$this->PedidosModel->actualizar($this->input->post('IdPedido'),$parametros);
			}
			$this->session->set_flashdata('exito', 'Pedido actualizado correctamente');
      redirect(base_url('admin/pedidos/detalles?id_pedido=').$this->input->post('IdPedido'));
	}
	public function solicitar_calificacion()
	{
		$datos_pedido = $this->PedidosModel->detalles($this->input->get('id_pedido'));

		// Preparo correo de revisión

		$this->data['info'] = array();

		$this->data['info']['Titulo'] = 'Nos gustaría conocer su opinión | '.$datos_pedido['PEDIDO_FOLIO'];
		$this->data['info']['Nombre'] = $datos_pedido['PEDIDO_NOMBRE'];
		$this->data['info']['Mensaje'] = '<p>Nos gustaría que nos diréras tu opinión sobre los productos que compraste así como de nuestro servicio.</p>';
		$this->data['info']['TextoBoton'] = 'Calificar y dar opiniones';
		$this->data['info']['EnlaceBoton'] = base_url('usuario/pedidos/calificar?id_pedido='.$datos_pedido['ID_PEDIDO']);
		// Pedido General
		$mensaje_abanico = $this->load->view('emails/mensaje_general',$this->data,true);

		// Envio correos Generales
		// Datos para enviar por correo
		// Config General

		$config['protocol']    = 'smtp';
		$config['smtp_host']    = $this->data['op']['mailer_host'];
		$config['smtp_port']    = $this->data['op']['mailer_port'];
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = $this->data['op']['mailer_user'];
		$config['smtp_pass']    = $this->data['op']['mailer_pass'];
		$config['charset']    = 'utf-8';
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not

		$this->email->initialize($config);

		// Envio correo comprobante
		$this->email->clear();
		$this->email->from($this->data['op']['mailer_user'], 'Abanico Siempre lo Mejor');
		$this->email->to($datos_pedido['PEDIDO_CORREO']);


		$this->email->subject('Nos gustaría conocer tu opinión '.$datos_pedido['PEDIDO_FOLIO']);
		$this->email->message($mensaje_abanico);
		// envio el correo

		if($this->email->send()){
			$this->session->set_flashdata('exito', 'Comentarios solicitados por correo');
			redirect(base_url('admin/pedidos/detalles?id_pedido='.$this->input->get('id_pedido')));
		}else{
			$this->session->set_flashdata('advertencia', 'No se pudo enviar el correo, por favor inténtelo mas tarde');
			redirect(base_url('admin/pedidos/detalles?id_pedido='.$this->input->get('id_pedido')));
		}
	}
	public function subir_comprobante()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}

			$this->form_validation->set_rules('FormaPago', 'Forma de Pago', 'required', array( 'required' => 'Debes designar la %s'));

			if($this->form_validation->run())
			{
				// Subo el archivo
				$nombre_archivo = 'pago-'.uniqid();
				$config['upload_path']          = 'contenido/adjuntos/pedidos';
				$config['allowed_types']        = 'pdf|jpg|png';
				$config['file_name']						=	$nombre_archivo;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('ArchivoPago')){
					$this->session->set_flashdata('alerta', 'No se pudo subir el archivo');
					redirect(base_url('usuario/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
				}else{
					$archivo = $this->upload->data('file_name');
					// Parametros del Servicio
					$parametros_pago = array(
						'ID_PEDIDO'=> $this->input->post('IdPedido'),
						'PAGO_FORMA'=> $this->input->post('FormaPago'),
						'PAGO_FOLIO'=> $this->input->post('FolioPago'),
						'PAGO_ARCHIVO'=>$archivo,
						'PAGO_IMPORTE'=> $this->input->post('PedidoImporte'),
						'PAGO_DESCRIPCION'=> $this->input->post('DescripcionPago'),
						'PAGO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
						'PAGO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
						'PAGO_ESTADO'=> $this->input->post('EstadoPago'),
					);
					$parametros_pedido = array(
						'PEDIDO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
						'PEDIDO_ESTADO_PAGO'=> $this->input->post('EstadoPago'),
					);
				}
				// Creo el Servicio
				$adjunto_id = $this->PagosPedidosModel->crear($parametros_pago);
				$this->PedidosModel->actualizar($this->input->post('IdPedido'),$parametros_pedido);

				$datos_pedido = $this->PedidosModel->detalles($this->input->post('IdPedido'));

				// Preparo correo de revisión

				$this->data['info'] = array();

				$this->data['info']['Titulo'] = 'Se ha subido un comprobante de pago para el pedido | '.$datos_pedido['PEDIDO_FOLIO'];
				$this->data['info']['Nombre'] = 'Muchas gracias por comprar con nosotros';
				$this->data['info']['Mensaje'] = '<p>Puedes revisar los detalles en el panel de control</p>';
				$this->data['info']['TextoBoton'] = 'Iniciar sesión';
				$this->data['info']['EnlaceBoton'] = base_url('usuario/pedidos/detalles?id_pedido='.$datos_pedido['ID_PEDIDO']);
				// Pedido General
				$mensaje_abanico = $this->load->view('emails/mensaje_general',$this->data,true);

				// Envio correos Generales
				// Datos para enviar por correo
				// Config General

				$config['protocol']    = 'smtp';
				$config['smtp_host']    = $this->data['op']['mailer_host'];
				$config['smtp_port']    = $this->data['op']['mailer_port'];
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = $this->data['op']['mailer_user'];
				$config['smtp_pass']    = $this->data['op']['mailer_pass'];
				$config['charset']    = 'utf-8';
				$config['mailtype'] = 'html'; // or html
				$config['validation'] = TRUE; // bool whether to validate email or not

				$this->email->initialize($config);

				// Envio correo comprobante
				$this->email->clear();
				$this->email->from($this->data['op']['mailer_user'], 'Abanico Siempre lo Mejor');
				$this->email->to($datos_pedido['PEDIDO_CORREO']);


				$this->email->subject('Comprobante de pago '.$datos_pedido['PEDIDO_FOLIO']);
				$this->email->message($mensaje_abanico);
				// envio el correo

				if($this->email->send()){
					$this->session->set_flashdata('exito', 'Comprobante cargado correctamente');
					redirect(base_url('admin/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
				}else{
					$this->session->set_flashdata('exito', 'Comprobante cargado correctamente, no se pudo enviar la notificación por correo');
					redirect(base_url('admin/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
				}


			}else{
				$this->session->set_flashdata('alerta', 'No se pudo subir el archivo');
				redirect(base_url('admin/pedidos/detalles?id_pedido='.$this->input->post('IdPedido')));
			}
		}
	public function guia()
	{
			$this->form_validation->set_rules('IdPedido', 'Número de Orden del Pedido', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{
			$guia = folio_pedido().'-'.$this->input->post('IdPedido');
			$parametros = array(
				'GUIA_CODIGO' => $guia,
				'ID_PEDIDO' => $this->input->post('IdPedido'),
				'GUIA_NOMBRE' => $this->input->post('NombreGuia'),
				'GUIA_DIRECCION' => $this->input->post('DireccionGuia'),
				'GUIA_TELEFONO' => $this->input->post('TelefonoGuia'),
				'GUIA_CORREO' => $this->input->post('CorreoGuia'),
				'GUIA_ESTADO' => 'Preparacion',
				'GUIA_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'GUIA_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
			);
			$guia_id = $this->GuiasPedidosModel->crear($parametros);
			$this->session->set_flashdata('exito', 'Tu Guía se asigno correctamente');
      redirect(base_url('admin/pedidos/detalles?id_pedido=').$this->input->post('IdPedido'));

		}else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/detalles_pedido',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function responder_devolucion()
	{
		$parametros_devolucion = array(
			'DEVOLUCION_RESPUESTA'=>$this->input->post('RespuestaDevolucion'),
			'DEVOLUCION_ESTADO'=>$this->input->post('EstadoDevolucion')
		);
			$parametros = array(
				'PEDIDO_ESTADO_PEDIDO'=>$this->input->post('EstadoDevolucion'),
				'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s')
			);
			$this->DevolucionesModel->actualizar($this->input->post('IdDevolucion'),$parametros_devolucion);
			$this->PedidosModel->actualizar($this->input->post('IdPedido'),$parametros);
			$this->session->set_flashdata('exito', 'Pedido actualizado correctamente');
      redirect(base_url('admin/pedidos/detalles?id_pedido=').$this->input->post('IdPedido'));
	}

	public function lista_pedidos_mayoreo()
	{

		$parametros = array();

		if(!null==$this->input->get('Fecha')){
			$mes = $this->input->get('Fecha');
		}else{
			 $mes = date('F');
		}
		$mes_desde = date('Y-m-01',strtotime($mes));
		$mes_hasta = date('Y-m-01',strtotime($mes.' + 1 month'));

			$parametros['PEDIDO_FECHA_REGISTRO >='] = $mes_desde;
			$parametros['PEDIDO_FECHA_REGISTRO <='] = $mes_hasta;

		if(!null==$this->input->get('id_empresa')){ $parametros['ID_COMPRADOR'] = $this->input->get('id_empresa'); }

		$this->data['pedidos'] = $this->GeneralModel->lista('pedidos_mayoreo','',$parametros,'ID_PEDIDO DESC','','');

		$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
		$this->load->view($this->data['dispositivo'].'/admin/lista_pedidos_mayoreo',$this->data);
		$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function detalles_pedido_mayoreo()
	{

			$this->data['pedido'] = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$_GET['id_pedido']]);
			$this->data['productos_pedido'] = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$_GET['id_pedido']],'ID DESC','','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/detalles_pedido_mayoreo',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function nuevo_pedido_mayoreo()
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
			$orden = 'PRODUCTO_NOMBRE ASC';
		}

			$this->data['parametros_or'] = $parametros_or;
			$this->data['parametros_and'] = $parametros_and;
			$this->data['orden'] = $orden;

			$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'productos','','');
			$this->data['categorias_hijas'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'productos','','');
			$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'servicios','','');
			$this->data['productos'] = $this->ProductosModel->lista_mayoreo($parametros_or,$parametros_and,'',$orden,'');
			$this->data['origen_formulario'] = 'categoria';

			$this->data['titulo'] = 'Todos los productos | Abanico siempre lo mejor';
			$this->data['descripcion'] = 'Compra y vende artículos por internet';
			$this->data['keywords'] = '';
			$this->data['imagen'] = base_url('assets/global/img/default_share.jpg');
			$this->data['empresas'] = $this->GeneralModel->lista('empresas','',['ESTADO'=>'activo'],'ID DESC','','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_productos_mayoreo',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function crear_pedido_mayoreo()
	{
		switch ($_POST['Comprador']) {
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
					$nombre_empresa = $this->input->post('NombreEmpresa');
					$nombre_comprador = $this->input->post('NombreContacto').' '.$this->input->post('ApellidosContacto');
					$correo_comprador = $this->input->post('CorreoContacto');
					$telefono_comprador = $this->input->post('TelefonoContacto');
					$direccion_comprador = $this->input->post('DireccionEmpresa');
				break;

			default:
					$this->data['empresa']  = $this->GeneralModel->detalles('empresas',['ID'=>$_POST['Comprador']]);
					$id_comprador = $this->data['empresa']['ID'];
					$nombre_empresa = $this->data['empresa']['EMPRESA_NOMBRE'];
					$nombre_comprador = $this->data['empresa']['CONTACTO_NOMBRE'].' '.$this->data['empresa']['CONTACTO_APELLIDOS'];
					$correo_comprador = $this->data['empresa']['CONTACTO_CORREO'];
					$telefono_comprador = $this->data['empresa']['TELEFONO'];
					$direccion_comprador = $this->data['empresa']['DOMICILIO'];
				break;
		}

		$pedido_tipo = 'venta_directa';
		$estado_pedido = 'finalizado';
		$estado_pago = 'pagado';
		$forma_pago = 'efectivo';
		$fecha_pago = date('Y-m-d H:i:s');
		$fecha_armada = $this->input->post('FechaEntrega').' '.$this->input->post('Hora').':'.$this->input->post('Minutos').' '.$this->input->post('AmPm');

		$fecha_entrega = date('Y-m-d H:i:s', strtotime($fecha_armada));

		$requiere_factura = $this->input->post('Factura');
		$dejas_producto = $this->input->post('DejasProducto');
		$pagar_ahora = $this->input->post('PagarAhora');

		// Tipos posibles de pedido
			// venta_directa
			// pedido
			// comision

			if($dejas_producto=='si'&&$pagar_ahora=='no_comision'){
				$pedido_tipo = 'comision';
			}

			if($dejas_producto=='no'){
				$pedido_tipo = 'pedido';
			}


		// Estado del pedido
			// finalizado
			// pedido
			// comision

			if($dejas_producto=='si'&&$pagar_ahora=='no_comision'){
				$estado_pedido = 'comision';
			}

			if($dejas_producto=='no'){
				$estado_pedido = 'pedido';
			}

		// Forma de pago
			// efectivo
			// transferencia
		// Estado del pago
			// pagado
			// pendiente

			if($pagar_ahora=='no_contra_entrega'||$pagar_ahora=='no_comision'){
				$forma_pago = '';
				$estado_pago = 'pendiente';
				$fecha_pago = null;
			}




		// Creo el pedido
		$folio = folio_pedido();

		$parametros_pedido = array(
			'PEDIDO_FOLIO'=>$folio,
			'ID_VENDEDOR'=>$_SESSION['usuario']['id'],
			'ID_COMPRADOR'=>$id_comprador,
			'PEDIDO_NOMBRE_EMPRESA'=>$nombre_empresa,
			'PEDIDO_NOMBRE'=>$nombre_comprador,
			'PEDIDO_CORREO'=>$correo_comprador,
			'PEDIDO_TELEFONO'=>$telefono_comprador,
			'PEDIDO_DIRECCION'=>$direccion_comprador,
			'PEDIDO_ESTADO_PAGO'=>$estado_pago,
			'PEDIDO_ESTADO_PEDIDO'=>$estado_pedido,
			'PEDIDO_TIPO'=>$pedido_tipo,
			'PEDIDO_ESTADO_PAGO'=>$estado_pago,
			'PEDIDO_FORMA_PAGO'=>$forma_pago,
			'PEDIDO_REQUIERE_FACTURA'=>$requiere_factura,
			'FECHA_PAGO'=>$fecha_pago,
			'PEDIDO_FECHA_REGISTRO'=>date('Y-m-d H:i:s'),
			'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s'),
			'PEDIDO_FECHA_ENTREGA'=>$fecha_entrega
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
				'ID_COMBINACION'=>$producto['id_combinacion'],
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

		if($requiere_factura=='si'){
			$importe_impuestos = ($suma_total*16)/100;
			$importe_total = $suma_total + $importe_impuestos;
			$importe = array(
				'PEDIDO_IMPORTE_PRODUCTOS_PARCIAL' =>$suma_total,
				'PEDIDO_IMPUESTO_DETALLES' =>'IVA 16%',
				'PEDIDO_IMPORTE_IMPUESTOS' =>$importe_impuestos,
				'PEDIDO_IMPORTE_TOTAL' =>$importe_total
			);
		}else{
			$importe = array(
				'PEDIDO_IMPORTE_PRODUCTOS_PARCIAL' =>$suma_total,
				'PEDIDO_IMPORTE_TOTAL' =>$suma_total
			);
		}



		$this->GeneralModel->actualizar('pedidos_mayoreo',['ID_PEDIDO'=>$id_pedido],$importe);

		unset($_SESSION['carrito']['tiendas']);
		unset($_SESSION['carrito']['productos']);
		unset($_SESSION['pedido']);
		$_SESSION['carrito']['productos']=array();
		$_SESSION['carrito']['tiendas']=array();
		$_SESSION['pedido']=array();

		// Confirmo y redirecciono
		$this->session->set_flashdata('exito', 'Pedido creado correctamente');
		redirect(base_url('admin/pedidos/detalles_pedido_mayoreo?id_pedido='.$id_pedido));


	}
	public function pedido_mayoreo_actualizar()
	{
		$this->form_validation->set_rules('Identificador', 'Id del pedido', 'required', array( 'required' => 'Debes designar el %s.' ));

		if($this->form_validation->run())
		{

			$pedido = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$this->input->post('Identificador')]);

			// Cálculo de impuestos
			$factura = 'no';
			$impuestos_detalles = '';
			$importe_productos = $pedido['PEDIDO_IMPORTE_PRODUCTOS_PARCIAL'];
			$importe_impuestos = 0;

			if($this->input->post('PedidoImpuestosPorcentaje')=='16'){
				$impuestos_detalles = 'IVA 16%';
				$importe_impuestos = ($importe_productos*$this->input->post('PedidoImpuestosPorcentaje'))/100;
				$factura = 'si';
			}

			$importe_total = $importe_productos+$importe_impuestos;

			if(isset($_POST['ActualizarEmpresa'])){
				$parametros_empresa = array(
					'EMPRESA_NOMBRE'=>$this->input->post('PedidoNombreEmpresa'),
					'DOMICILIO'=>$this->input->post('PedidoDireccion'),
					'TELEFONO'=>$this->input->post('PedidoTelefono'),
					'CONTACTO_NOMBRE'=>$this->input->post('PedidoNombreCliente'),
					'CONTACTO_CORREO'=>$this->input->post('PedidoCorreo'),
				);

				$this->GeneralModel->actualizar('empresas',['ID'=>$this->input->post('IdComprador')],$parametros_empresa);
			}


			$parametros_pedido = array(
				'ID_COMPRADOR'=>$this->input->post('IdComprador'),
				'PEDIDO_NOMBRE_EMPRESA'=>$this->input->post('PedidoNombreEmpresa'),
				'PEDIDO_NOMBRE'=>$this->input->post('PedidoNombreCliente'),
				'PEDIDO_CORREO'=>$this->input->post('PedidoCorreo'),
				'PEDIDO_TELEFONO'=>$this->input->post('PedidoTelefono'),
				'PEDIDO_DIRECCION'=>$this->input->post('PedidoDireccion'),
				'PEDIDO_IMPUESTO_DETALLES'=>$impuestos_detalles,
				'PEDIDO_IMPUESTO_PORCENTAJE'=>$this->input->post('PedidoImpuestosPorcentaje'),
				'PEDIDO_IMPORTE_IMPUESTOS'=>$importe_impuestos,
				'PEDIDO_IMPORTE_TOTAL'=>$importe_total,
				'PEDIDO_FORMA_PAGO'=>$this->input->post('PedidoFormaPago'),
				'PEDIDO_ESTADO_PAGO'=>$this->input->post('PedidoEstadoPago'),
				'PEDIDO_ESTADO_PEDIDO'=>$this->input->post('PedidoEstado'),
				'PEDIDO_TIPO'=>$this->input->post('PedidoTipo'),
				'FECHA_PAGO'=>date('Y-m-d H:i:s', strtotime($this->input->post('FechaPago'))),
				'PEDIDO_REQUIERE_FACTURA'=>$factura,
				//'PEDIDO_FECHA_REGISTRO'=>date('Y-m-d H:i:s', strtotime($this->input->post('PedidoFechaCreacion'))),
				'PEDIDO_FECHA_ACTUALIZACION'=>date('Y-m-d H:i:s'),
			);

			$this->GeneralModel->actualizar('pedidos_mayoreo',['ID_PEDIDO'=>$this->input->post('Identificador')],$parametros_pedido);

			$this->session->set_flashdata('exito', 'Pedido actualizado correctamente');
			redirect(base_url('admin/pedidos/detalles_pedido_mayoreo?id_pedido='.$this->input->post('Identificador')));

		}else{

			$this->data['pedido'] = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$_GET['id_pedido']]);
			$this->data['productos_pedido'] = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$_GET['id_pedido']],'ID DESC','','');


			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_pedido_mayoreo',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}

	}

	public function pedido_mayoreo_precios()
	{
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

			$pedido = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$this->input->post('Identificador')]);

			$suma_productos = 0;
			foreach($productos as $producto){
				$suma_productos+= $producto->CANTIDAD*$producto->IMPORTE;
			};

			//var_dump($suma_productos);

			$importe_productos = $suma_productos;

			if(!empty($pedido['PEDIDO_IMPUESTO_DETALLES'])){
				$porcentaje_impuestos = 16;
			}else{
				$porcentaje_impuestos = 0;
			}

			$importe_impuestos = ($importe_productos*$porcentaje_impuestos)/100;
			$importe_total = $importe_productos+$importe_impuestos;



			if(!empty($pedido['PEDIDO_IMPUESTO_DETALLES'])){

				$importe = array(
					'PEDIDO_IMPORTE_PRODUCTOS_PARCIAL' =>$importe_productos,
					'PEDIDO_IMPORTE_IMPUESTOS' =>$importe_impuestos,
					'PEDIDO_IMPORTE_TOTAL' =>$importe_total
				);

			}else{

				$importe = array(
					'PEDIDO_IMPORTE_PRODUCTOS_PARCIAL' =>$importe_productos,
					'PEDIDO_IMPORTE_TOTAL' =>$importe_productos
				);
			}

			$this->GeneralModel->actualizar('pedidos_mayoreo',['ID_PEDIDO'=>$this->input->post('Identificador')],$importe);

			$this->session->set_flashdata('exito', 'Pedido actualizado correctamente');
			redirect(base_url('admin/pedidos/detalles_pedido_mayoreo?id_pedido='.$this->input->post('Identificador')));

		}else{

			$this->data['pedido'] = $this->GeneralModel->detalles('pedidos_mayoreo',['ID_PEDIDO'=>$_GET['id_pedido']]);
			$this->data['productos_pedido'] = $this->GeneralModel->lista('pedidos_mayoreo_productos','',['ID_PEDIDO'=>$_GET['id_pedido']],'ID DESC','','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_precios_pedido_mayoreo',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}

	}
	public function pedido_mayoreo_recibo()
	{
		$this->session->set_flashdata('exito', 'Recibo enviado correctamente');
		redirect(base_url('admin/pedidos/detalles_pedido_mayoreo?id_pedido='.$this->input->get('id_pedido')));
	}
	public function pedido_mayoreo_borrar()
	{
			$this->GeneralModel->borrar('pedidos_mayoreo',['ID_PEDIDO'=>$this->input->get('id')]);
			$this->GeneralModel->borrar('pedidos_mayoreo_productos',['ID_PEDIDO'=>$this->input->get('id')]);
			$this->session->set_flashdata('exito', 'Pedido borrado correctamente');
			redirect(base_url('admin/pedidos/lista_pedidos_mayoreo'));

	}

	public function lista_empresas()
	{
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

		$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
		$this->load->view($this->data['dispositivo'].'/admin/lista_empresas',$this->data);
		$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function crear_empresa()
	{
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
      redirect(base_url('admin/pedidos/lista_empresas'));

    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_empresas',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar_empresa()
	{
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
			redirect(base_url('admin/pedidos/lista_empresas'));

		}else{

			$this->data['empresa']  = $this->GeneralModel->detalles('empresas',['ID'=>$_GET['id_empresa']]);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_empresas',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

}
