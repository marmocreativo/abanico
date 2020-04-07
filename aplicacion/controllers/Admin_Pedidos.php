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
			$parametros['PEDIDO_FECHA_REGISTRO >'] = $this->input->get('Fecha');
			$parametros['PEDIDO_FECHA_REGISTRO <'] = date('Y-m-d',strtotime($this->input->get('Fecha').' + 1 day'));
		}else{
			$parametros['PEDIDO_FECHA_REGISTRO >'] = date('Y-m-d');
			$parametros['PEDIDO_FECHA_REGISTRO <'] = date('Y-m-d',strtotime(date('Y-m-d').' + 1 day'));
		}
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
				'PEDIDO_FECHA_REGISTRO'=>date('Y-m-d H:i:s', strtotime($this->input->post('PedidoFechaCreacion'))),
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
