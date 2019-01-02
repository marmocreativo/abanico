<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Perfiles_Servicios extends CI_Controller {

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
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasModel');
		$this->load->model('CategoriasProductoModel');
		$this->load->model('TiendasModel');
		$this->load->model('PerfilServiciosModel');
		$this->load->model('DireccionesModel');

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
			$this->data['perfiles'] = $this->PerfilServiciosModel->lista('','','','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_perfiles_servicios',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'PERFIL_NOMBRE'=>$_GET['Busqueda'],
				'PERFIL_RAZON_SOCIAL'=>$_GET['Busqueda'],
				'PERFIL_RFC'=>$_GET['Busqueda']
			);
			$this->data['perfiles_servicios'] = $this->PerfilServiciosModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_perfiles_servicios',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/perfiles_servicios'));
		}
	}
	public function crear()
	{
		// Validaciones de Formulario
		$this->form_validation->set_rules('NombrePerfil', 'Nombre', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('TelefonoPerfil', 'Teléfono', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('TerminosyCondiciones', 'Términos y condiciones', 'required', array('required' => 'Debes aceptar los %s.'));


		// Valido
		if($this->form_validation->run())
		{
			// Preparo archivo para imagen
			$archivo = $_FILES['ImagenPerfil']['tmp_name'];
			$ancho = $this->data['op']['ancho_imagenes_perfil_servicios'];
			$alto = $this->data['op']['alto_imagenes_perfil_servicios'];
			$calidad = 80;
			$nombre = 'perfil_servicios-'.uniqid();
			$destino = $this->data['op']['ruta_imagenes_perfil_servicios'].'completo/';
			// Subo la imagen y obtengo el nombre Default si va vacía
			$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);
			// Parametros de la perfil_servicios
				$parametros = array(
					'ID_USUARIO' => $this->input->post('IdUsuario'),
					'PERFIL_NOMBRE' => $this->input->post('NombrePerfil'),
					'PERFIL_RAZON_SOCIAL' => $this->input->post('RazonSocialPerfil'),
					'PERFIL_RFC' => $this->input->post('RfcPerfil'),
					'PERFIL_TELEFONO' => $this->input->post('TelefonoPerfil'),
					'PERFIL_IMAGEN' => $imagen,
					'PERFIL_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
					'PERFIL_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
					'PERFIL_ESTADO' => 'activo'
				);
				// Registro la Perfil
				$perfil_servicios_id = $this->PerfilServiciosModel->crear($parametros);
				// Parametros dirección
				$parametros_direccion = array(
				 'ID_USUARIO' => $this->input->post('IdUsuario'),
				 'DIRECCION_TIPO' => $this->input->post('TipoDireccion'),
				 'DIRECCION_ALIAS' => $this->input->post('AliasDireccion'),
				 'DIRECCION_PAIS' => $this->input->post('PaisDireccion'),
				 'DIRECCION_ESTADO' => $this->input->post('EstadoDireccion'),
				 'DIRECCION_CIUDAD' => $this->input->post('CiudadDireccion'),
				 'DIRECCION_MUNICIPIO' => $this->input->post('MunicipioDireccion'),
				 'DIRECCION_BARRIO' => $this->input->post('BarrioDireccion'),
				 'DIRECCION_CALLE_Y_NUMERO' => $this->input->post('CalleDireccion'),
				 'DIRECCION_CODIGO_POSTAL' => $this->input->post('CodigoPostalDireccion'),
				 'DIRECCION_REFERENCIAS' => $this->input->post('ReferenciasDireccion'),
				 'DIRECCION_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				 'DIRECCION_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
			 );
			 $direccion_id = $this->DireccionesModel->crear($parametros_direccion);

			 // Registro la dirección en la perfil_servicios
			 $perfil_servicios_id = $this->PerfilServiciosModel->actualizar($perfil_servicios_id,array('ID_DIRECCION'=>$direccion_id));
			 // Reviso los permisos del Usuario
			 $usuario = $this->UsuariosModel->detalles($this->input->post('IdUsuario'));
			 $tienda = $this->TiendasModel->tienda_usuario($usuario['ID_USUARIO']);
			 $perfil = $this->PerfilServiciosModel->perfil_usuario($usuario['ID_USUARIO']);
			 $permiso = $usuario['USUARIO_TIPO'];

			 if($usuario['USUARIO_TIPO']!='tec-5'&&$usuario['USUARIO_TIPO']!='adm-6'){
				if(!null == $tienda){
 					$permiso = 'vnd-2';
 				}
 				if(!null == $perfil){
 					$permiso = 'ser-3';
 				}
 				if(!null == $tienda&& !null == $perfil){
 					$permiso = 'vns-4';
 				}
			 }
			 // Actualizo el tipo de Usuario
			 $this->UsuariosModel->permiso($usuario['ID_USUARIO'],$permiso);
			 // Mensaje de Feedback
			 $this->session->set_flashdata('exito', 'Perfil Registrado');
			 // Redirección
      redirect(base_url('admin/usuarios/perfil?id_usuario=').$this->input->post('IdUsuario'));
    }else{
			$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_perfil_servicios',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		// Validaciones de Formulario
		$this->form_validation->set_rules('NombrePerfil', 'Nombre', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('TelefonoPerfil', 'Teléfono', 'required', array('required' => 'Debes escribir tu %s.'));


		// Valido
		if($this->form_validation->run())
		{
				// Preparo archivo para imagen
				$archivo = $_FILES['ImagenPerfil']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_perfil_servicios'];
				$alto = $this->data['op']['alto_imagenes_perfil_servicios'];
				$calidad = 80;
				$nombre = 'perfil_servicios-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_perfil_servicios'].'completo/';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);
				if($imagen=='default.jpg'){ $imagen = $this->input->post('ImagenAnteriorPerfil'); }

				$parametros = array(
					'ID_USUARIO' => $this->input->post('IdUsuario'),
					'PERFIL_NOMBRE' => $this->input->post('NombrePerfil'),
					'PERFIL_RAZON_SOCIAL' => $this->input->post('RazonSocialPerfil'),
					'PERFIL_RFC' => $this->input->post('RfcPerfil'),
					'PERFIL_TELEFONO' => $this->input->post('TelefonoPerfil'),
					'PERFIL_IMAGEN' => $imagen,
					'PERFIL_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
					'PERFIL_ESTADO' => 'activo'
				);
				// Actualizo la perfil_servicios
				$perfil_servicios_id = $this->PerfilServiciosModel->actualizar( $this->input->post('Identificador'),$parametros);
				// Parámetros de la dirección
				// Parametros dirección
				$parametros_direccion = array(
				 'ID_USUARIO' => $this->input->post('IdUsuario'),
				 'DIRECCION_TIPO' => $this->input->post('TipoDireccion'),
				 'DIRECCION_ALIAS' => $this->input->post('AliasDireccion'),
				 'DIRECCION_PAIS' => $this->input->post('PaisDireccion'),
				 'DIRECCION_ESTADO' => $this->input->post('EstadoDireccion'),
				 'DIRECCION_CIUDAD' => $this->input->post('CiudadDireccion'),
				 'DIRECCION_MUNICIPIO' => $this->input->post('MunicipioDireccion'),
				 'DIRECCION_BARRIO' => $this->input->post('BarrioDireccion'),
				 'DIRECCION_CALLE_Y_NUMERO' => $this->input->post('CalleDireccion'),
				 'DIRECCION_CODIGO_POSTAL' => $this->input->post('CodigoPostalDireccion'),
				 'DIRECCION_REFERENCIAS' => $this->input->post('ReferenciasDireccion'),
				 'DIRECCION_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				 'DIRECCION_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
			 );
				// Reviso si la dirección está vacía
				if(!empty($this->input->post('IdentificadorDireccion'))){
					$direccion_id = $this->input->post('IdentificadorDireccion');
					$this->DireccionesModel->actualizar($this->input->post('IdentificadorDireccion'),$parametros_direccion);
				}else{
					$direccion_id = $this->DireccionesModel->crear($parametros_direccion);
				}
				// Registro la dirección en la perfil_servicios
				echo $this->input->post('Identificador');
				$perfil_servicios_id = $this->PerfilServiciosModel->actualizar($this->input->post('Identificador'),array('ID_DIRECCION'=>$direccion_id));
				// Reviso los permisos del Usuario
 			 $usuario = $this->UsuariosModel->detalles($this->input->post('IdUsuario'));
 			 $tienda = $this->TiendasModel->tienda_usuario($usuario['ID_USUARIO']);
 			 $perfil = $this->PerfilServiciosModel->perfil_usuario($usuario['ID_USUARIO']);
 			 $permiso = $usuario['USUARIO_TIPO'];

 			 if($usuario['USUARIO_TIPO']!='tec-5'&&$usuario['USUARIO_TIPO']!='adm-6'){
 				if(!null == $tienda){
  					$permiso = 'vnd-2';
  				}
  				if(!null == $perfil){
  					$permiso = 'ser-3';
  				}
  				if(!null == $tienda&& !null == $perfil){
  					$permiso = 'vns-4';
  				}
 			 }
 			 // Actualizo el tipo de Usuario
 			 $this->UsuariosModel->permiso($usuario['ID_USUARIO'],$permiso);
 			 // Mensaje de Feedback
 			 $this->session->set_flashdata('exito', 'Se registró la tienda con éxito');
 			 // Redirección

				$this->session->set_flashdata('exito', 'Perfil Actualizado');
				redirect(base_url('admin/usuarios/perfil?id_usuario='.$this->input->post('IdUsuario')));
    }else{
			$this->data['usuario'] = $this->UsuariosModel->detalles($_GET['id_usuario']);
			$this->data['perfil'] = $this->PerfilServiciosModel->detalles($_GET['id_perfil']);
			$this->data['direccion_perfil_servicios'] = $this->DireccionesModel->detalles($this->data['perfil']['ID_DIRECCION']);

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_perfil_servicios',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$pais = $this->PerfilServiciosModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($pais['ID_PAIS']))
        {
            $this->PerfilServiciosModel->borrar($_GET['id']);
            redirect(base_url('admin/perfiles_servicios'));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		$this->PerfilServiciosModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/perfiles_servicios'));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
