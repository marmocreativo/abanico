<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin_Usuarios extends CI_Controller {

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
		$this->load->model('UsuariosModel');
		$this->load->model('TiendasModel');
		$this->load->model('PerfilServiciosModel');
		$this->load->model('ProductosModel');
		$this->load->model('ServiciosModel');
		$this->load->model('DireccionesModel');
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
			// Tipo de Uusario por defecto
			if(!isset($_GET['tipo_usuario'])||empty($_GET['tipo_usuario'])){ $this->data['tipo_usuario']=''; }else{ $this->data['tipo_usuario']=$_GET['tipo_usuario']; }
			$this->data['usuarios'] = $this->UsuariosModel->lista_admin('','',$this->data['tipo_usuario'],'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_usuarios',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		// Tipo de Uusario por defecto
		if(!isset($_GET['tipo_usuario'])||empty($_GET['tipo_usuario'])){ $this->data['tipo_usuario']='usr-1'; }else{ $this->data['tipo_usuario']=$_GET['tipo_usuario']; }
		if(isset($_GET['Busqueda'])){

			if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
				$parametros = array(
					'USUARIO_NOMBRE'=>$_GET['Busqueda'],
					'USUARIO_APELLIDOS'=>$_GET['Busqueda'],
					'USUARIO_CORREO'=>$_GET['Busqueda'],
				);
			}else{
				$parametros = '';
			}

			$fechas = array();
			if(isset($_GET['FechaDesde'])&&!empty($_GET['FechaDesde'])){
				$fechas['USUARIO_FECHA_REGISTRO >='] = $_GET['FechaDesde'];
			}
			if(isset($_GET['FechaHasta'])&&!empty($_GET['FechaHasta'])){
				$fechas['USUARIO_FECHA_REGISTRO <='] = $_GET['FechaHasta'];
			}
			$this->data['usuarios'] = $this->UsuariosModel->lista_admin($parametros,$fechas,$_GET['tipo_usuario'],'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_usuarios',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/usuarios?tipo_usuario='.$_GET['tipo_usuario']));
		}
	}
	public function crear()
	{
		// Tipo de Uusario por defecto
		if(!isset($_GET['tipo_usuario'])||empty($_GET['tipo_usuario'])){ $this->data['tipo_usuario']='usr-1'; }else{ $this->data['tipo_usuario']=$_GET['tipo_usuario']; }
		// Validar Formulario
		$this->form_validation->set_rules('NombreUsuario', 'Nombre', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('ApellidosUsuario', 'Apellidos', 'required', array('required' => 'Debes escribir tus %s.'));
		$this->form_validation->set_rules('CorreoUsuario', 'Correo Electrónico', 'required|valid_email|is_unique[usuarios.USUARIO_CORREO]', array(
			'required' => 'Debes escribir tu %s.',
			'valid_email' => 'Debes escribir una dirección de correo valida.',
			'is_unique' => 'La dirección de correo ya está registrada'
		));
		$this->form_validation->set_rules('PassUsuario', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('PassUsuarioConf', 'Contraseña Confirmación', 'required|matches[PassUsuario]', array(
			'required' => 'Debes confirmar la Contraseña',
			'matches' => 'La confirmación de la contraseña no coincide.'
		));
		$this->form_validation->set_rules('EstadoUsuario', 'Estado del Usuario', 'required', array('required' => 'Debes definir el %s.'));

		if($this->form_validation->run())
    {
			// Creo el identificador Único
			$id_usuario = uniqid('', true);
			if(!$this->UsuariosModel->id_usuario_existe($id_usuario)){
				$id_usuario = uniqid('', true);
			}
			// Creo la contraseña

			$pass = password_hash($this->input->post('PassUsuario'), PASSWORD_DEFAULT);

			if(!empty($_FILES['ImagenUsuario']['name'])){

				$archivo = $_FILES['ImagenUsuario']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_producto'];
				$alto = $this->data['op']['alto_imagenes_producto'];
				$calidad = 80;
				$nombre = 'usuario-'.uniqid();
				$destino = 'contenido/img/usuarios';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = 'default.jpg';
			}

      $parametros = array(
				'ID_USUARIO' => $id_usuario,
				'USUARIO_NOMBRE' => $this->input->post('NombreUsuario'),
				'USUARIO_APELLIDOS' => $this->input->post('ApellidosUsuario'),
				'USUARIO_CORREO' => $this->input->post('CorreoUsuario'),
				'USUARIO_TELEFONO' => $this->input->post('TelefonoUsuario'),
				'USUARIO_PASSWORD' => $pass,
				'USUARIO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'USUARIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'USUARIO_FECHA_NACIMIENTO' => $this->input->post('FechaNacimientoUsuario'),
				'USUARIO_TIPO' => $this->input->post('TipoUsuario'),
				'USUARIO_IMAGEN' => $imagen,
				'USUARIO_ESTADO' => $this->input->post('EstadoUsuario'),
      );

      $pais_id = $this->UsuariosModel->crear($parametros);
      redirect(base_url('admin/usuarios?tipo_usuario='.$this->input->post('TipoUsuario')));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}


	public function actualizar()
	{
		// Tipo de Uusario por defecto
		if(!isset($_GET['tipo_usuario'])||empty($_GET['tipo_usuario'])){ $this->data['tipo_usuario']='usr-1'; }else{ $this->data['tipo_usuario']=$_GET['tipo_usuario']; }
		// Validar Formulario
		$this->form_validation->set_rules('NombreUsuario', 'Nombre', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('ApellidosUsuario', 'Apellidos', 'required', array('required' => 'Debes escribir tus %s.'));
		$this->form_validation->set_rules('CorreoUsuario', 'Correo Electrónico', 'required|valid_email', array(
			'required' => 'Debes escribir tu %s.',
			'valid_email' => 'Debes escribir una dirección de correo valida.',
			'is_unique' => 'La dirección de correo ya está registrada'
		));
		// reviso si está marcada la casilla de lista de correo
		if(!null==$this->input->post('ListaDeCorreoUsuario')){ $lista_correo = 'si'; }else{ $lista_correo = 'no'; }

		if($this->form_validation->run())
		{
			if(!empty($_FILES['ImagenUsuario']['name'])){

				$archivo = $_FILES['ImagenUsuario']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_producto'];
				$alto = $this->data['op']['alto_imagenes_producto'];
				$calidad = 80;
				$nombre = 'usuario-'.uniqid();
				$destino = 'contenido/img/usuarios/';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = $this->input->post('ImagenUsuarioAnterior');
			}


			$parametros = array(
				'USUARIO_NOMBRE' => $this->input->post('NombreUsuario'),
				'USUARIO_APELLIDOS' => $this->input->post('ApellidosUsuario'),
				'USUARIO_CORREO' => $this->input->post('CorreoUsuario'),
				'USUARIO_TELEFONO' => $this->input->post('TelefonoUsuario'),
				'USUARIO_LISTA_DE_CORREO' => $lista_correo,
				'USUARIO_FECHA_NACIMIENTO' => $this->input->post('FechaNacimientoUsuario'),
				'USUARIO_IMAGEN' => $imagen,
				'USUARIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
			);
			if(null!==$this->input->post('PassUsuario')&&!empty($this->input->post('PassUsuario'))){ $parametros['USUARIO_PASSWORD']= $pass; };

      $this->UsuariosModel->actualizar( $this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Usuario Actualizado');
      redirect(base_url('admin/usuarios/perfil?id_usuario='.$this->input->post('Identificador')));
    }else{

			$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function pass()
	{
		// Obtengo los datos de usuario

		$this->form_validation->set_rules('PassUsuario', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('PassUsuarioConf', 'Contraseña Confirmación', 'required|matches[PassUsuario]', array(
			'required' => 'Debes confirmar la Contraseña',
			'matches' => 'La confirmación de la contraseña no coincide.'
		));

		if($this->form_validation->run())
		{
			$this->load->model('AutenticacionModel');
				$id = $this->input->post('Identificador');
				$pass = password_hash($this->input->post('PassUsuario'), PASSWORD_DEFAULT);
				$parametros = array(
					'USUARIO_PASSWORD' => $pass
				);
				$this->AutenticacionModel->restaurar_pass($id,$parametros);
				// Mensaje de feedback
				$this->session->set_flashdata('exito', 'Contraseña actualizada correctamente');
				// redirección
				redirect(base_url('admin/usuarios/perfil?id_usuario='.$this->input->post('Identificador')));
		}else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_pass',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$usuario = $this->UsuariosModel->detalles($_GET['id']);
		// check if the institucione exists before trying to delete it
		  if(isset($usuario['ID_USUARIO']))
		{
			$parametros = array( 'USUARIO_ESTADO' => 'borrado');

			$this->UsuariosModel->actualizar( $_GET['id'],$parametros);

				$this->session->set_flashdata('exito', 'Usuario borrado');
				redirect(base_url('admin/usuarios?tipo_usuario='.$usuario['USUARIO_TIPO']));
		} else {

		   	show_error('La entrada que deseas borrar no existe');
		}
	}
	public function activar()
	{
		$this->UsuariosModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/usuarios?tipo_usuario='.$_GET['tipo_usuario']));
	}
	public function estado()
	{
		$this->UsuariosModel->estado($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/usuarios?tipo_usuario='.$_GET['tipo_usuario']));
	}
		/*
		*
		*Funciones ESPECIALES
		*
		*/
		public function perfil()
		{
			$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_GET['id_usuario']);
			$this->data['perfil'] = $this->PerfilServiciosModel->perfil_usuario($_GET['id_usuario']);
			$this->data['direccion_perfil'] = $this->DireccionesModel->direccion_formateada($this->data['perfil']['ID_DIRECCION']);
			$this->data['direccion_tienda'] = $this->DireccionesModel->direccion_formateada($this->data['tienda']['ID_DIRECCION']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/perfil_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}

		/*
* EXCEL
*/
public function excel()
{
	if(!isset($_GET['tipo_usuario'])||empty($_GET['tipo_usuario'])){ $this->data['tipo_usuario']=''; }else{ $this->data['tipo_usuario']=$_GET['tipo_usuario']; }

	if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
		$parametros = array(
			'USUARIO_NOMBRE'=>$_GET['Busqueda'],
			'USUARIO_APELLIDOS'=>$_GET['Busqueda'],
			'USUARIO_CORREO'=>$_GET['Busqueda'],
		);
	}else{
		$parametros = '';
	}

	$fechas = array();
	if(isset($_GET['FechaDesde'])&&!empty($_GET['FechaDesde'])){
		$fechas['USUARIO_FECHA_REGISTRO >='] = $_GET['FechaDesde'];
	}
	if(isset($_GET['FechaHasta'])&&!empty($_GET['FechaHasta'])){
		$fechas['USUARIO_FECHA_REGISTRO <='] = $_GET['FechaHasta'];
	}

	$this->data['usuarios'] = $this->UsuariosModel->lista_admin($parametros,$fechas,$this->data['tipo_usuario'],'','');


	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();
	// Estilos encabezado
	$sheet->getStyle('A1:G1')
	->getFill()
	->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
	->getStartColor()
	->setARGB('3c8dbc');

	$spreadsheet->getActiveSheet()->getStyle('A1:G1')
	->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

	$spreadsheet->getActiveSheet()->getStyle('A1:G1')
	->getAlignment()->setWrapText(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

	$sheet->setCellValue('A1', 'ID');
	$sheet->setCellValue('B1', 'Nombre');
	$sheet->setCellValue('C1', 'Apellidos');
	$sheet->setCellValue('D1', 'Correo');
	$sheet->setCellValue('E1', 'Tipo de Usuario');
	$sheet->setCellValue('F1', 'Lista de correos');
	$sheet->setCellValue('G1', 'Fecha de registro');

	$i = 3;
	foreach($this->data['usuarios'] as $usuario){

		// Creo la fila con Excel
		$sheet->setCellValue('A'.$i, $usuario->ID_USUARIO);
		$sheet->setCellValue('B'.$i, $usuario->USUARIO_NOMBRE);
		$sheet->setCellValue('C'.$i, $usuario->USUARIO_APELLIDOS);
		$sheet->setCellValue('D'.$i, $usuario->USUARIO_CORREO);
		$sheet->setCellValue('E'.$i, $usuario->USUARIO_TIPO);
		$sheet->setCellValue('F'.$i, $usuario->USUARIO_LISTA_DE_CORREO);
		$sheet->setCellValue('G'.$i, $usuario->USUARIO_FECHA_REGISTRO);
	$i ++;
	}

	$writer = new Xlsx($spreadsheet);

	$filename = 'usuarios_abanico_'.date('d-m-Y H:i');

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
	header('Cache-Control: max-age=0');

	$writer->save('php://output'); // download file


	}

}
