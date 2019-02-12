<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Transportistas extends CI_Controller {

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
		$this->load->model('TransportistasModel');
		$this->load->model('TransportistasDisponibilidadModel');
		$this->load->model('PaisesModel');
		$this->load->model('EstadosModel');
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
			$this->data['transportistas'] = $this->TransportistasModel->lista('','','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_transportistas',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'TRANSPORTISTA_NOMBRE'=>$_GET['Busqueda']
			);
			$this->data['transportistas'] = $this->TransportistasModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_transportistas',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/transportistas'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('NombreTransportista', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));
		$this->form_validation->set_rules('TiempoEntregaTransportista', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes establecer el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {

			if(!empty($_FILES['ImagenTransportista']['name'])){

				$archivo = $_FILES['ImagenTransportista']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_transportistas'];
				$alto = $this->data['op']['alto_imagenes_transportistas'];
				$calidad = 80;
				$nombre = 'transportista-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_transportistas'];
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = 'default.jpg';
			}

      $parametros = array(
				'TRANSPORTISTA_NOMBRE' => $this->input->post('NombreTransportista'),
				'TRANSPORTISTA_DESCRIPCION' => $this->input->post('DescripcionTransportista'),
				'TRANSPORTISTA_LOGO' => $imagen,
				'TRANSPORTISTA_TIEMPO_ENTREGA' => $this->input->post('TiempoEntregaTransportista'),
				'TRANSPORTISTA_URL_RASTREO' => $this->input->post('UrlRastreoTransportista')
      );

			if(null !== $this->input->post('EstadoTransportista') && !empty($this->input->post('EstadoTransportista'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['TRANSPORTISTA_ESTADO']= $estado;

      $transportista_id = $this->TransportistasModel->crear($parametros);

			// disponibilidad
			if(null !== $this->input->post('EstadosDisponible')){

				foreach($this->input->post('EstadosDisponible') as $estado){
					$datos = $this->EstadosModel->datos_por_estado($estado);
					$parametros_disponibilidad= array(
						'ID_TRANSPORTISTA'=> $transportista_id,
						'TRANSPORTISTA_PAIS' => $datos['PAIS_NOMBRE'],
						'TRANSPORTISTA_ESTADO' => $datos['ESTADO_NOMBRE']
					);
					$this->TransportistasDisponibilidadModel->crear($parametros_disponibilidad);
				}
			}
			// Mensaje Feedback
			$this->session->set_flashdata('exito', 'Transportista Creado, no olvides definir las reglas de transporte');
			// Redirecciono
      redirect(base_url('admin/transportistas'));
    }else{

			$this->data['paises'] = $this->PaisesModel->lista_activos();
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_transportista',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('NombreTransportista', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));
		$this->form_validation->set_rules('TiempoEntregaTransportista', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes establecer el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {

			if(!empty($_FILES['ImagenTransportista']['name'])){

				$archivo = $_FILES['ImagenTransportista']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_transportistas'];
				$alto = $this->data['op']['alto_imagenes_transportistas'];
				$calidad = 80;
				$nombre = 'transportista-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes_transportistas'];
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen_abanico_cortar($archivo,$ancho,$alto,$calidad,$nombre,$destino);

			}else{
				$imagen = $this->input->post('ImagenAnteriorTransportista');
			}


			$parametros = array(
				'TRANSPORTISTA_NOMBRE' => $this->input->post('NombreTransportista'),
				'TRANSPORTISTA_DESCRIPCION' => $this->input->post('DescripcionTransportista'),
				'TRANSPORTISTA_LOGO' => $imagen,
				'TRANSPORTISTA_TIEMPO_ENTREGA' => $this->input->post('TiempoEntregaTransportista'),
				'TRANSPORTISTA_URL_RASTREO' => $this->input->post('UrlRastreoTransportista')
			);

			if(null !== $this->input->post('EstadoTransportista') && !empty($this->input->post('EstadoTransportista'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['TRANSPORTISTA_ESTADO']= $estado;

			// disponibilidad
			if(null !== $this->input->post('EstadosDisponible')){

				$this->TransportistasDisponibilidadModel->borrar($this->input->post('Identificador'));

				foreach($this->input->post('EstadosDisponible') as $estado){
					$datos = $this->EstadosModel->datos_por_estado($estado);
					$parametros_disponibilidad= array(
						'ID_TRANSPORTISTA'=> $this->input->post('Identificador'),
						'TRANSPORTISTA_PAIS' => $datos['PAIS_NOMBRE'],
						'TRANSPORTISTA_ESTADO' => $datos['ESTADO_NOMBRE']
					);
					$this->TransportistasDisponibilidadModel->crear($parametros_disponibilidad);
				}
			}

			$transportista_id = $this->TransportistasModel->actualizar($this->input->post('Identificador'),$parametros);
			$this->session->set_flashdata('exito', 'Transportista actualizado');
			// Redirecciono
      redirect(base_url('admin/transportistas'));
    }else{
			$this->data['transportista'] = $this->TransportistasModel->detalles($_GET['id']);
			$this->data['paises'] = $this->PaisesModel->lista_activos();

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_transportista',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$lenguaje = $this->TransportistasModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($lenguaje['ID_TRANSPORTISTA']))
        {
            $this->TransportistasModel->borrar($_GET['id']);
						$this->session->set_flashdata('exito', 'Transportista Eliminado');
            redirect(base_url('admin/transportistas'));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		$this->TransportistasModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/transportistas'));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
