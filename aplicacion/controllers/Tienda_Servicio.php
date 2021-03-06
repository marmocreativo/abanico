<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Servicio extends CI_Controller {
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
		$this->load->model('ServiciosModel');
		$this->load->model('GaleriasServiciosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('CategoriasServiciosModel');
		$this->load->model('TiendasModel');
		$this->load->model('DireccionesModel');
		$this->load->model('FavoritosModel');
		$this->load->model('CalificacionesServiciosModel');
		$this->load->model('FavoritosModel');
		$this->load->model('ConversacionesModel');
		$this->load->model('ConversacionesMensajesModel');
		$this->load->model('AdjuntosUsuariosModel');
		$this->load->model('EstadisticasModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('PublicacionesModel');
		$this->load->model('TraduccionesModel');

		// Variables comunes
		$this->data['primary'] = "-info";
  }
	 public function index()
 	{

		$this->data['servicio'] = $this->ServiciosModel->detalles($_GET['id']);
		$this->data['portada'] = $this->GaleriasServiciosModel->galeria_portada($_GET['id']);
		$this->data['galerias'] = $this->GaleriasServiciosModel->galeria_servicio($_GET['id']);
		$this->data['adjuntos'] = $this->AdjuntosUsuariosModel->lista_adjuntos_servicio($_GET['id'],'servicio');
		$this->data['tienda'] = $this->TiendasModel->tienda_usuario($this->data['servicio']['ID_USUARIO']);
		$direccion_fiscal = $this->DireccionesModel->direccion_fiscal($this->data['servicio']['ID_USUARIO']);
		$this->data['direccion_formateada'] = $this->DireccionesModel->direccion_formateada($direccion_fiscal['ID_DIRECCION']);
		$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
		$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');

		// Calificaciones
		$this->data['cantidad_calificaciones']= $this->CalificacionesServiciosModel->conteo_calificaciones_producto($_GET['id']);
		$this->data['promedio_calificaciones']= $this->CalificacionesServiciosModel->promedio_calificaciones_producto($_GET['id']);
		$estrellas = array();
		$estrellas['5']= $this->CalificacionesServiciosModel->conteo_calificaciones_estrellas($_GET['id'],5);
		$estrellas['4']= $this->CalificacionesServiciosModel->conteo_calificaciones_estrellas($_GET['id'],4);
		$estrellas['3']= $this->CalificacionesServiciosModel->conteo_calificaciones_estrellas($_GET['id'],3);
		$estrellas['2']= $this->CalificacionesServiciosModel->conteo_calificaciones_estrellas($_GET['id'],2);
		$estrellas['1']= $this->CalificacionesServiciosModel->conteo_calificaciones_estrellas($_GET['id'],1);
		$this->data['estrellas'] = $estrellas;

		// Calificaciones
		// Reviso si ya lo calificó el usuario
		if(isset($_SESSION['usuario']['id'])&!empty($_SESSION['usuario']['id'])){
			$this->data['mi_calificacion']= $this->CalificacionesServiciosModel->ya_calificado($this->data['servicio']['ID_SERVICIO'],$_SESSION['usuario']['id']);
			$this->data['calificaciones'] = $this->CalificacionesServiciosModel->calificaciones_producto($_GET['id'],$this->data['mi_calificacion']['ID_CALIFICACION']);
		}else{
				$this->data['calificaciones'] = $this->CalificacionesServiciosModel->calificaciones_producto($_GET['id'],'');
		}
		$this->EstadisticasModel->objeto_visto('servicio',$this->data['servicio']['ID_SERVICIO']);
 		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
 		$this->load->view($this->data['dispositivo'].'/tienda/servicio',$this->data);
 		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

 	}

public function favorito()
 {
	 if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
		 // verifico si ya existe
		 $es_favorito = $this->FavoritosModel->es_favorito($_GET['id'],$_SESSION['usuario']['id'],'servicio');
		 if(!$es_favorito){
				 $parametros = array(
					 'ID_USUARIO'=>$_SESSION['usuario']['id'],
					 'ID_OBJETO'=>$_GET['id'],
					 'FAVORITO_TIPO'=>'servicio',
					 'FAVORITO_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
				 );

				$this->FavoritosModel->crear($parametros);

			 // Relleno Notificación
			 $datos_servicio = $this->ServiciosModel->detalles($_GET['id']);
			 $datos_usuario = $this->UsuariosModel->detalles($datos_servicio['ID_USUARIO']);
			 $parametros_notificacion = array(
				 'ID_USUARIO'=>$datos_producto['ID_USUARIO'],
				 'NOTIFICACION_CONTENIDO'=>'Alguien añadió tu servicio '.$datos_servicio['SERVICIO_NOMBRE'].' a Favoritos',
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
  			$this->data['info']['Titulo'] = 'Tu servicios '.$datos_servicio['SERVICIO_NOMBRE'].' fue añadido a favoritos';
  			$this->data['info']['Nombre'] = $datos_usuario['USUARIO_NOMBRE'].' '.$datos_usuario['USUARIO_APELLIDOS'];
  			$this->data['info']['Mensaje'] = '<p>Tu servicio llamó la atención y ha sido añadido a favoritos.</p>';
  			$this->data['info']['TextoBoton'] = 'Ver tus servicios';
  			$this->data['info']['EnlaceBoton'] = base_url('login');

  			$mensaje = $this->load->view('emails/mensaje_general',$this->data,true);
  			$this->email->initialize($config);

  			$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
  			$this->email->to($datos_usuario['USUARIO_CORREO']);

  			$this->email->subject('Tu servicio en Favoritos');
  			$this->email->message($mensaje);
				$this->email->send();

		 	}
			 // Redirecciono
			 redirect(base_url('usuario/favoritos'));
		}else{
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}

 }
 public function quitar_favorito()
	{
		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			// verifico si ya existe
			$es_favorito = $this->FavoritosModel->es_favorito($_GET['id'],$_SESSION['usuario']['id'],'servicio');
			if($es_favorito){
				$favorito = $this->FavoritosModel->detalles($_GET['id'],$_SESSION['usuario']['id'],'servicio');

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
			 'ID_SERVICIO'=>$this->input->post('IdServicio'),
			 'ID_USUARIO'=>$this->input->post('IdUsuario'),
			 'ID_USUARIO_CALIFICADOR'=>$this->input->post('IdCalificador'),
			 'CALIFICACION_ESTRELLAS'=>$this->input->post('EstrellasCalificacion'),
			 'CALIFICACION_COMENTARIO'=>$this->input->post('ComentarioCalificacion'),
			 'CALIFICACION_ESTADO'=>'activo',
			 'CALIFICACION_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
		 );
		 $this->CalificacionesServiciosModel->crear($parametros);
		 // Relleno Notificación
		 $datos_servicio = $this->ServiciosModel->detalles($_GET['id']);
		 $parametros_notificacion = array(
			 'ID_USUARIO'=>$datos_producto['ID_USUARIO'],
			 'NOTIFICACION_CONTENIDO'=>'Alguien calificí tu servicio '.$datos_servicio['SERVICIO_NOMBRE'].' con '.$this->input->post('EstrellasCalificacion').' Estrellas',
			 'NOTIFICACION_TIPO'=>'general',
			 'NOTIFICACION_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
			 'NOTIFICACION_ESTADO'=>'no leido'
		 );
		 // Creo la notificación
		 $id_notificacion = $this->NotificacionesModel->crear($parametros_notificacion);
		 // Redirecciono
			 redirect(base_url('servicio?id='.$this->input->post('IdServicio')));
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
				'ID_OBJETO'=>$this->input->post('IdServicio'),
				'CONVERSACION_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
				'CONVERSACION_FECHA_ACTUALIZACION'=> date('Y-m-d H:i:s'),
				'CONVERSACION_TIPO'=>'mensaje servicio',
				'CONVERSACION_ESTADO'=>'no leido'
			);
			$conversacion_id = $this->ConversacionesModel->crear($parametros_conversacion);
			// Mensaje
			$mensaje = '<p><b>Servicio:</b> '.$this->input->post('ServicioNombre').'</p>';
			$mensaje .= '<p>'.$this->input->post('MensajeTexto').'</p>';
			$parametros_mensaje = array(
				'ID_CONVERSACION'=>$conversacion_id,
				'ID_REMITENTE'=>$this->input->post('IdRemitente'),
				'MENSAJE_ASUNTO'=>'Solicitud de Servicio',
				'MENSAJE_TEXTO'=>$mensaje,
				'MENSAJE_FECHA_REGISTRO'=> date('Y-m-d H:i:s'),
				'MENSAJE_ESTADO_A'=>'no leido',
				'MENSAJE_ESTADO_B'=>'no leido'
			);
			$mensaje_id = $this->ConversacionesMensajesModel->crear($parametros_mensaje);
			// Relleno Notificación
			$datos_servicio = $this->ServiciosModel->detalles($this->input->post('IdServicio'));
			$datos_usuario = $this->UsuariosModel->detalles($datos_servicio['ID_USUARIO']);
			$parametros_notificacion = array(
				'ID_USUARIO'=>$datos_servicio['ID_USUARIO'],
				'NOTIFICACION_CONTENIDO'=>'Tienes un nuevo mensaje sobre tu servicio'.$datos_servicio['SERVICIO_NOMBRE'],
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
 			$this->data['info']['Titulo'] = 'Hay preguntas sobre:  '.$datos_servicio['SERVICIO_NOMBRE'];
 			$this->data['info']['Nombre'] = 'Puedes contestar a esta pregunta en tu panel de usuario';
 			$this->data['info']['Mensaje'] = $mensaje;
 			$this->data['info']['TextoBoton'] = 'Bandeja de entrada';
 			$this->data['info']['EnlaceBoton'] = base_url('usuario/mensajes');

 			$mensaje = $this->load->view('emails/mensaje_general',$this->data,true);
 			$this->email->initialize($config);

 			$this->email->from($this->data['op']['correo_sitio'], 'Abanico Siempre lo Mejor');
 			$this->email->to($datos_usuario['USUARIO_CORREO']);

 			$this->email->subject('Pregunta sobre tus servicios');
 			$this->email->message($mensaje);
 			$this->email->send();

			// Redirecciono
			// Mensaje FeedBack
			$this->session->set_flashdata('exito', 'Tu mensaje ha sido enviado, recibirás la respuesta en tu <a href="'.base_url('usuario/mensajes').'">Bandeja de Entrada</a>');
			// Redirecciono
			redirect(base_url('servicio/contacto?id='.$this->input->post('IdServicio')));

		}else{
		 $this->data['servicio'] = $this->ServiciosModel->detalles($_GET['id']);
		 $this->data['portada'] = $this->GaleriasServiciosModel->galeria_portada($_GET['id']);
		 $this->data['galerias'] = $this->GaleriasServiciosModel->galeria_servicio($_GET['id']);
		 $this->data['tienda'] = $this->TiendasModel->tienda_usuario($this->data['servicio']['ID_USUARIO']);
		 $this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');
 		$this->data['categorias_servicios'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'servicios','','');

		 $this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
		 $this->load->view($this->data['dispositivo'].'/tienda/servicio_form_contacto',$this->data);
		 $this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);
		}

 }
}
