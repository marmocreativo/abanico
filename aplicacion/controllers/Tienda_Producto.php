<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Producto extends CI_Controller {
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
			$this->data['dispositivo']  = "mobile";
		}else{
			$this->data['dispositivo']  = "desktop";
		}
		$this->load->model('UsuariosModel');
		$this->load->model('TiendaModel');
		$this->load->model('ProductosModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasModel');
		$this->load->model('CategoriasServiciosModel');
		$this->load->model('CategoriasProductoModel');
		$this->load->model('TiendasModel');
		$this->load->model('DireccionesModel');
		$this->load->model('FavoritosModel');
		$this->load->model('CalificacionesModel');
		$this->load->model('ProductosCombinacionesModel');
		$this->load->model('ConversacionesModel');
		$this->load->model('ConversacionesMensajesModel');
		$this->load->model('EstadisticasModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('TraduccionesModel');
		$this->load->model('PublicacionesModel');
		$this->load->model('PlanesModel');
		$this->load->model('DivisasModel');

		// Variables comunes
		$this->data['primary'] = "-primary";
  }
	 public function index()
 	{
		$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
		$this->data['portada'] = $this->GaleriasModel->galeria_portada($_GET['id']);
		$this->data['galerias'] = $this->GaleriasModel->galeria_producto($_GET['id']);
		$this->data['tienda'] = $this->TiendasModel->tienda_usuario($this->data['producto']['ID_USUARIO']);
		$direccion_fiscal = $this->DireccionesModel->direccion_fiscal($this->data['producto']['ID_USUARIO']);
		$this->data['direccion_formateada'] = $this->DireccionesModel->direccion_formateada($direccion_fiscal['ID_DIRECCION']);
		$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'productos','','');
		$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'servicios','','');
		$this->data['relacion_categoria_producto'] = $this->CategoriasProductoModel->lista($_GET['id']);
		$this->data['categoria_producto'] = $this->CategoriasModel->detalles($this->data['relacion_categoria_producto'][0]->ID_CATEGORIA);
		if(!null==$this->data['categoria_producto']){
			$this->data['primary'] = $this->data['categoria_producto']['CATEGORIA_COLOR'];
		}
		$this->data['combinaciones'] = $this->ProductosCombinacionesModel->lista($_GET['id'],'ORDEN ASC','');

		// Calificaciones
		$this->data['cantidad_calificaciones']= $this->CalificacionesModel->conteo_calificaciones_producto($_GET['id']);
		$this->data['promedio_calificaciones']= $this->CalificacionesModel->promedio_calificaciones_producto($_GET['id']);
		$estrellas = array();
		$estrellas['5']= $this->CalificacionesModel->conteo_calificaciones_estrellas($_GET['id'],5);
		$estrellas['4']= $this->CalificacionesModel->conteo_calificaciones_estrellas($_GET['id'],4);
		$estrellas['3']= $this->CalificacionesModel->conteo_calificaciones_estrellas($_GET['id'],3);
		$estrellas['2']= $this->CalificacionesModel->conteo_calificaciones_estrellas($_GET['id'],2);
		$estrellas['1']= $this->CalificacionesModel->conteo_calificaciones_estrellas($_GET['id'],1);
		$this->data['estrellas'] = $estrellas;

		// Calificaciones
		// Reviso si ya lo calificó el usuario
		if(isset($_SESSION['usuario']['id'])&!empty($_SESSION['usuario']['id'])){
			$this->data['mi_calificacion']= $this->CalificacionesModel->ya_calificado($this->data['producto']['ID_PRODUCTO'],$_SESSION['usuario']['id']);
			$this->data['calificaciones'] = $this->CalificacionesModel->calificaciones_producto($_GET['id'],'');
		}else{
				$this->data['calificaciones'] = $this->CalificacionesModel->calificaciones_producto($_GET['id'],'');
		}
		// Estadísticas de Producto
		$this->EstadisticasModel->objeto_visto('producto',$this->data['producto']['ID_PRODUCTO']);

		// Metadatos de Producto
		$this->data['titulo'] = $this->data['producto']['PRODUCTO_NOMBRE'].'| Abanico siempre lo mejor';
		if(!empty($this->data['producto']['META_TITULO'])){ $this->data['titulo'] = $this->data['producto']['META_TITULO'].'| Abanico siempre lo mejor'; }
		$this->data['descripcion'] = $this->data['producto']['PRODUCTO_DESCRIPCION'];
		if(!empty($this->data['producto']['META_DESCRIPCION'])){ $this->data['descripcion'] = $this->data['producto']['META_DESCRIPCION'].'| Abanico siempre lo mejor'; }
		$this->data['keywords'] = $this->data['producto']['META_KEYWORDS'];
		$this->data['imagen'] = base_url('contenido/img/productos/completo/'.$this->data['portada']['GALERIA_ARCHIVO']);

 		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
 		$this->load->view($this->data['dispositivo'].'/tienda/producto',$this->data);
 		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

 	}
	public function vista_previa()
 {
	 $this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
	 $this->data['portada'] = $this->GaleriasModel->galeria_portada($_GET['id']);
	 $this->data['galerias'] = $this->GaleriasModel->galeria_producto($_GET['id']);
	 $this->data['tienda'] = $this->TiendasModel->tienda_usuario($this->data['producto']['ID_USUARIO']);
	 $direccion_fiscal = $this->DireccionesModel->direccion_fiscal($this->data['producto']['ID_USUARIO']);
	 $this->data['direccion_formateada'] = $this->DireccionesModel->direccion_formateada($direccion_fiscal['ID_DIRECCION']);
	 $this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'productos','','');
	 $this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0,'CATEGORIA_ESTADO'=>'activo'],'servicios','','');
	 $this->data['relacion_categoria_producto'] = $this->CategoriasProductoModel->lista($_GET['id']);
	 $this->data['categoria_producto'] = $this->CategoriasModel->detalles($this->data['relacion_categoria_producto']['ID_CATEGORIA']);
	 if(!null==$this->data['categoria_producto']){
		 $this->data['primary'] = $this->data['categoria_producto']['CATEGORIA_COLOR'];
	 }
	 $this->data['combinaciones'] = $this->ProductosCombinacionesModel->lista($_GET['id'],'','');

	 // Calificaciones
	 $this->data['cantidad_calificaciones']= $this->CalificacionesModel->conteo_calificaciones_producto($_GET['id']);
	 $this->data['promedio_calificaciones']= $this->CalificacionesModel->promedio_calificaciones_producto($_GET['id']);
	 $estrellas = array();
	 $estrellas['5']= $this->CalificacionesModel->conteo_calificaciones_estrellas($_GET['id'],5);
	 $estrellas['4']= $this->CalificacionesModel->conteo_calificaciones_estrellas($_GET['id'],4);
	 $estrellas['3']= $this->CalificacionesModel->conteo_calificaciones_estrellas($_GET['id'],3);
	 $estrellas['2']= $this->CalificacionesModel->conteo_calificaciones_estrellas($_GET['id'],2);
	 $estrellas['1']= $this->CalificacionesModel->conteo_calificaciones_estrellas($_GET['id'],1);
	 $this->data['estrellas'] = $estrellas;

	 // Calificaciones
	 // Reviso si ya lo calificó el usuario
	 if(isset($_SESSION['usuario']['id'])&!empty($_SESSION['usuario']['id'])){
		 $this->data['mi_calificacion']= $this->CalificacionesModel->ya_calificado($this->data['producto']['ID_PRODUCTO'],$_SESSION['usuario']['id']);
		 $this->data['calificaciones'] = $this->CalificacionesModel->calificaciones_producto($_GET['id'],'');
	 }else{
			 $this->data['calificaciones'] = $this->CalificacionesModel->calificaciones_producto($_GET['id'],'');
	 }
	 // Estadísticas de Producto
	 $this->EstadisticasModel->objeto_visto('producto',$this->data['producto']['ID_PRODUCTO']);

	 // Metadatos de Producto
	 $this->data['titulo'] = $this->data['producto']['PRODUCTO_NOMBRE'].'| Abanico siempre lo mejor';
	 if(!empty($this->data['producto']['META_TITULO'])){ $this->data['titulo'] = $this->data['producto']['META_TITULO'].'| Abanico siempre lo mejor'; }
	 $this->data['descripcion'] = $this->data['producto']['PRODUCTO_DESCRIPCION'];
	 if(!empty($this->data['producto']['META_DESCRIPCION'])){ $this->data['titulo'] = $this->data['producto']['META_DESCRIPCION'].'| Abanico siempre lo mejor'; }
	 $this->data['keywords'] = $this->data['producto']['META_KEYWORDS'];
	 $this->data['imagen'] = base_url('contenido/img/productos/completo/'.$this->data['portada']['GALERIA_ARCHIVO']);

	 $this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
	 $this->load->view($this->data['dispositivo'].'/tienda/producto_previa',$this->data);
	 $this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

 }
public function favorito()
 {
	 if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
		 // verifico si ya existe
		 $es_favorito = $this->FavoritosModel->es_favorito($_GET['id'],$_SESSION['usuario']['id'],'producto');
		 if(!$es_favorito){
				 $parametros = array(
					 'ID_USUARIO'=>$_SESSION['usuario']['id'],
					 'ID_OBJETO'=>$_GET['id'],
					 'FAVORITO_TIPO'=>'producto',
					 'FAVORITO_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
				 );

				$this->FavoritosModel->crear($parametros);
				// Relleno la notifiación
				$datos_producto = $this->ProductosModel->detalles($_GET['id']);
				$datos_usuario = $this->UsuariosModel->detalles($datos_producto['ID_USUARIO']);
				$parametros_notificacion = array(
					'ID_USUARIO'=>$datos_producto['ID_USUARIO'],
					'NOTIFICACION_CONTENIDO'=>'Tu producto '.$datos_producto['PRODUCTO_NOMBRE'].' fue añadido a favoritos',
					'NOTIFICACION_TIPO'=>'general',
					'NOTIFICACION_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
					'NOTIFICACION_ESTADO'=>'no leido'
				);
				// Creo la notificación
				$id_notificacion = $this->NotificacionesModel->crear($parametros_notificacion);


 			 // Datos para enviar por correo

  				$config['protocol']    = 'smtp';
  				$config['smtp_host']    = $this->data['op']['mailer_host'];
  				$config['smtp_port']    = $this->data['op']['mailer_port'];
  				$config['smtp_timeout'] = '7';
  				$config['smtp_user']    = $this->data['op']['mailer_user'];
  				$config['smtp_pass']    = $this->data['op']['mailer_pass'];
  				$config['charset']    = 'utf-8';
  				$config['mailtype'] = 'html'; // or html
  				$config['validation'] = TRUE; // bool whether to validate email or not


  			$this->data['info'] = array();
  			$this->data['info']['Titulo'] = 'Tu producto '.$datos_producto['PRODUCTO_NOMBRE'].' fue añadido a favoritos';
  			$this->data['info']['Nombre'] = $datos_usuario['USUARIO_NOMBRE'].' '.$datos_usuario['USUARIO_APELLIDOS'];
  			$this->data['info']['Mensaje'] = '<p>Tu producto llamó la atención y ha sido añadido a favoritos.</p>';
  			$this->data['info']['TextoBoton'] = 'Ver tus productos';
  			$this->data['info']['EnlaceBoton'] = base_url('login');

  			$mensaje = $this->load->view('emails/mensaje_general',$this->data,true);
  			$this->email->initialize($config);

  			$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
  			$this->email->to($datos_usuario['USUARIO_CORREO']);

  			$this->email->subject('Tu producto en Favoritos');
  			$this->email->message($mensaje);
				$this->email->send();
			 }

			 redirect(base_url('usuario/favoritos'));
		}else{
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}

 }
 public function quitar_favorito()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			// verifico si ya existe
			$es_favorito = $this->FavoritosModel->es_favorito($_GET['id'],$_SESSION['usuario']['id'],'producto');
			if($es_favorito){
				$favorito = $this->FavoritosModel->detalles($_GET['id'],$_SESSION['usuario']['id'],'producto');

			 $this->FavoritosModel->borrar($favorito['ID_FAVORITO']);
			}
			redirect(base_url('usuario/favoritos'));
	 }else{
		 redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
	 }

	}
	public function calificar()
	{
	 if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
		 // Preparo mis parámetros
		 $parametros = array(
			 'ID_PRODUCTO'=>$this->input->post('IdProducto'),
			 'ID_USUARIO'=>$this->input->post('IdUsuario'),
			 'ID_USUARIO_CALIFICADOR'=>$this->input->post('IdCalificador'),
			 'CALIFICACION_ESTRELLAS'=>$this->input->post('EstrellasCalificacion'),
			 'CALIFICACION_COMENTARIO'=>$this->input->post('ComentarioCalificacion'),
			 'CALIFICACION_ESTADO'=>'activo',
			 'CALIFICACION_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
		 );
		 $this->CalificacionesModel->crear($parametros);
		 // Relleno la notificación
		 $datos_producto = $this->ProductosModel->detalles($this->input->post('IdProducto'));
		 $parametros_notificacion = array(
			 'ID_USUARIO'=>$datos_producto['ID_USUARIO'],
			 'NOTIFICACION_CONTENIDO'=>'Alguien calificó tu producto '.$datos_producto['PRODUCTO_NOMBRE'].' con '.$this->input->post('EstrellasCalificacion').' Estrellas',
			 'NOTIFICACION_TIPO'=>'general',
			 'NOTIFICACION_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
			 'NOTIFICACION_ESTADO'=>'no leido'
		 );
		 // Creo la notificación
		 $id_notificacion = $this->NotificacionesModel->crear($parametros_notificacion);
		 // Redirecciono
			 redirect(base_url('producto?id='.$this->input->post('IdProducto')));
		}else{
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}

	}
	public function contacto()
 {
	 if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
		 $this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
		 redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
	 }
	 $this->form_validation->set_rules('MensajeTexto', 'Mensaje', 'required', array( 'required' => 'Debes enviar un mensaje %s'));

		if($this->form_validation->run())
		{
			// Conversación
			$parametros_conversacion = array(
				'ID_USUARIO_A'=>$this->input->post('IdRemitente'),
				'ID_USUARIO_B'=>$this->input->post('IdReceptor'),
				'ID_OBJETO'=>$this->input->post('IdProducto'),
				'CONVERSACION_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
				'CONVERSACION_FECHA_ACTUALIZACION'=> date('Y-m-d H:i:s'),
				'CONVERSACION_TIPO'=>'pregunta producto',
				'CONVERSACION_ESTADO'=>'no leido'
			);
			$conversacion_id = $this->ConversacionesModel->crear($parametros_conversacion);
			// Mensaje
			$mensaje = '<p><b>Producto:</b> '.$this->input->post('ProductoNombre').'</p>';
			$mensaje .= '<p>'.$this->input->post('MensajeTexto').'</p>';
			$parametros_mensaje = array(
				'ID_CONVERSACION'=>$conversacion_id,
				'ID_REMITENTE'=>$this->input->post('IdRemitente'),
				'MENSAJE_ASUNTO'=>'Pregunta sobre un Producto',
				'MENSAJE_TEXTO'=>$mensaje,
				'MENSAJE_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
				'MENSAJE_ESTADO_A'=>'no leido',
				'MENSAJE_ESTADO_B'=>'no leido'
			);
			$mensaje_id = $this->ConversacionesMensajesModel->crear($parametros_mensaje);

			// Relleno la notificación
 		 $datos_producto = $this->ProductosModel->detalles($this->input->post('IdProducto'));
		 $datos_usuario = $this->UsuariosModel->detalles($datos_producto['ID_USUARIO']);
 		 $parametros_notificacion = array(
 			 'ID_USUARIO'=>$datos_producto['ID_USUARIO'],
 			 'NOTIFICACION_CONTENIDO'=>'Alguien ha hecho una pregunta sobre tu producto '.$datos_producto['PRODUCTO_NOMBRE'],
			 'NOTIFICACION_TIPO'=>'mensaje',
 			 'NOTIFICACION_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
 			 'NOTIFICACION_ESTADO'=>'no leido'
 		 );
 		 // Creo la notificación
 		 $id_notificacion = $this->NotificacionesModel->crear($parametros_notificacion);

		 // Datos para enviar por correo

				$config['protocol']    = 'smtp';
				$config['smtp_host']    = $this->data['op']['mailer_host'];
				$config['smtp_port']    = $this->data['op']['mailer_port'];
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = $this->data['op']['mailer_user'];
				$config['smtp_pass']    = $this->data['op']['mailer_pass'];
				$config['charset']    = 'utf-8';
				$config['mailtype'] = 'html'; // or html
				$config['validation'] = TRUE; // bool whether to validate email or not


			$this->data['info'] = array();
			$this->data['info']['Titulo'] = 'Hay preguntas sobre:  '.$datos_producto['PRODUCTO_NOMBRE'];
			$this->data['info']['Nombre'] = 'Puedes contestar a esta pregunta en tu panel de usuario';
			$this->data['info']['Mensaje'] = $mensaje;
			$this->data['info']['TextoBoton'] = 'Bandeja de entrada';
			$this->data['info']['EnlaceBoton'] = base_url('usuario/mensajes');

			$mensaje = $this->load->view('emails/mensaje_general',$this->data,true);
			$this->email->initialize($config);

			$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
			$this->email->to($datos_usuario['USUARIO_CORREO']);

			$this->email->subject('Pregunta sobre tus productos');
			$this->email->message($mensaje);
			$this->email->send();

			// Mensaje FeedBack
			$this->session->set_flashdata('exito', 'Tu mensaje ha sido enviado, recibirás la respuesta en tu <a href="'.base_url('usuario/mensajes').'">Bandeja de Entrada</a>');
			// Redirecciono
			redirect(base_url('producto?id='.$this->input->post('IdProducto')));

		}

 }
}
