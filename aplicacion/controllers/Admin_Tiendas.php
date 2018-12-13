<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Tiendas extends CI_Controller {

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
		$this->load->model('TiendasModel');
  }

	public function index()
	{
			$this->data['tiendas'] = $this->TiendasModel->lista('','','','');
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_tiendas',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'TIENDA_NOMBRE'=>$_GET['Busqueda'],
				'TIENDA_RAZON_SOCIAL'=>$_GET['Busqueda'],
				'TIENDA_RFC'=>$_GET['Busqueda']
			);
			$this->data['tiendas'] = $this->TiendasModel->lista($parametros,'','');

			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_tiendas',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/tiendas'));
		}
	}
	public function crear()
	{
		$this->form_validation->set_rules('TiendaRFC', 'RFC de la tienda', 'required|is_unique[tiendas.TIENDA_RFC]', array( 'required' => 'Debes designar el %s.', 'is_unique' => 'Este RFC ya ha sido registrado' ));

		if($this->form_validation->run())
    {
      $parametros = array(
          'ID_USUARIO'=> $this->input->post('IdUsuario'),
          'TIENDA_NOMBRE' => $this->input->post('TiendaNombre'),
          'TIENDA_RAZON_SOCIAL' => $this->input->post('TiendaRazonSocial'),
          'TIENDA_RFC' => $this->input->post('TiendaRFC'),
          'TIENDA_TELEFONO' => $this->input->post('TiendaTelefono'),
          'TIENDA_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
          'TIENDA_ESTADO'=>'activo'
      );

      $pais_id = $this->TiendasModel->crear($parametros);
      redirect(base_url('admin/usuarios/perfil?id=').$this->input->post('IdUsuario'));
    }else{
			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_tienda',$this->data);
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

      $pais_id = $this->TiendasModel->actualizar( $this->input->post('Identificador'),$parametros);
      redirect(base_url('admin/tiendas'));
    }else{

			$this->data['pais'] = $this->TiendasModel->detalles($_GET['id']);

			$this->load->view($this->data['dispositivo'].'/usuarios/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_pais',$this->data);
			$this->load->view($this->data['dispositivo'].'/usuarios/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$pais = $this->TiendasModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($pais['ID_PAIS']))
        {
            $this->TiendasModel->borrar($_GET['id']);
            redirect(base_url('admin/tiendas'));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}
	public function activar()
	{
		$this->TiendasModel->activar($_GET['id'],$_GET['estado']);
		redirect(base_url('admin/tiendas'));
	}
	public function estado()
	{
	}
	public function orden()
	{
	}
}
