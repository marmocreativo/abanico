<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Direcciones extends CI_Controller {

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
		$this->load->model('DireccionesModel');
  }

	public function index()
	{
			$this->data['direcciones'] = $this->DireccionesModel->lista('','','','');
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_direcciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'DIRECCION_NOMBRE'=>$_GET['Busqueda'],
				'DIRECCION_RAZON_SOCIAL'=>$_GET['Busqueda'],
				'DIRECCION_RFC'=>$_GET['Busqueda']
			);
			$this->data['direcciones'] = $this->DireccionesModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_direcciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/direcciones'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('DireccionCalle', 'Calle y Número', 'required', array( 'required' => 'Debes designar el %s.'));

		if($this->form_validation->run())
    {
      $parametros = array(
          'ID_USUARIO'=> $this->input->post('IdUsuario'),
          'DIRECCION_NOMBRE' => $this->input->post('TiendaNombre'),
          'DIRECCION_RAZON_SOCIAL' => $this->input->post('TiendaRazonSocial'),
          'DIRECCION_RFC' => $this->input->post('TiendaRFC'),
          'DIRECCION_TELEFONO' => $this->input->post('TiendaTelefono'),
          'DIRECCION_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
          'DIRECCION_ESTADO'=>'activo'
      );

      $pais_id = $this->DireccionesModel->crear($parametros);
      redirect(base_url('admin/usuarios/perfil?id=').$this->input->post('IdUsuario'));
    }else{
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_direccion',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('IsoPais', 'Código ISO', 'required', array( 'required' => 'Debes designar el %s.'));
		$this->form_validation->set_rules('NombrePais', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'PAIS_ISO' => $this->input->post('IsoPais'),
				'PAIS_NOMBRE' => $this->input->post('NombrePais'),
      );

			if(null !== $this->input->post('EstadoPais') && !empty($this->input->post('EstadoPais'))){ $estado = "activo"; }else{ $estado = "inactivo"; }

			$parametros['PAIS_ESTADO']= $estado;

      $pais_id = $this->DireccionesModel->actualizar( $this->input->post('Identificador'),$parametros);
      redirect(base_url('admin/direcciones'));
    }else{

			$this->data['pais'] = $this->DireccionesModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_pais',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$pais = $this->DireccionesModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($pais['ID_PAIS']))
        {
            $this->DireccionesModel->borrar($_GET['id']);
            redirect(base_url('admin/direcciones'));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		$this->DireccionesModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/direcciones'));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
