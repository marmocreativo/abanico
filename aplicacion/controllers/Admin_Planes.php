<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Planes extends CI_Controller {

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
		$this->load->model('PlanesModel');
		$this->load->model('TiendasModel');
		$this->load->model('PerfilServiciosModel');
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
			$this->data['planes'] = $this->PlanesModel->lista('');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_planes',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function crear()
	{
		$this->form_validation->set_rules('NombrePlan', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
      $parametros = array(
				'PLAN_NOMBRE' => $this->input->post('NombrePlan'),
				'PLAN_DESCRIPCION' => $this->input->post('DescripcionPlan'),
				'PLAN_MENSUALIDAD' => $this->input->post('MensualidadPlan'),
				'PLAN_ALMACENAMIENTO' => $this->input->post('AlmacenamientoPlan'),
				'PLAN_COMISION' => $this->input->post('ComisionPlan'),
				'PLAN_MANEJO_PRODUCTOS' => $this->input->post('ManejoProductosPlan'),
				'PLAN_ENVIO' => $this->input->post('EnvioPlan'),
				'PLAN_SERVICIOS_FINANCIEROS' => $this->input->post('ServiciosFinancierosPlan'),
				'PLAN_SERVICIOS_FINANCIEROS_FIJO' => $this->input->post('ServiciosFinancierosFijoPlan'),
				'PLAN_TIPO' => $this->input->post('TipoPlan'),
				'PLAN_NIVEL' => $this->input->post('NivelPlan'),
				'PLAN_LIMITE_PRODUCTOS' => $this->input->post('LimiteProductosPlan'),
				'PLAN_LIMITE_SERVICIOS' => $this->input->post('LimiteServiciosPlan'),
				'PLAN_FOTOS_PRODUCTOS' => $this->input->post('FotosProductosPlan'),
				'PLAN_FOTOS_SERVICIOS' => $this->input->post('FotosProductosPlan'),
      );

      $plan_id = $this->PlanesModel->crear($parametros);

			$this->session->set_flashdata('exito', 'Plan creado correctamente');
      redirect(base_url('admin/planes'));
    }else{
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_plan',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('NombrePlan', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
			$parametros = array(
				'PLAN_NOMBRE' => $this->input->post('NombrePlan'),
				'PLAN_DESCRIPCION' => $this->input->post('DescripcionPlan'),
				'PLAN_MENSUALIDAD' => $this->input->post('MensualidadPlan'),
				'PLAN_ALMACENAMIENTO' => $this->input->post('AlmacenamientoPlan'),
				'PLAN_COMISION' => $this->input->post('ComisionPlan'),
				'PLAN_MANEJO_PRODUCTOS' => $this->input->post('ManejoProductosPlan'),
				'PLAN_ENVIO' => $this->input->post('EnvioPlan'),
				'PLAN_SERVICIOS_FINANCIEROS' => $this->input->post('ServiciosFinancierosPlan'),
				'PLAN_SERVICIOS_FINANCIEROS_FIJO' => $this->input->post('ServiciosFinancierosFijoPlan'),
				'PLAN_TIPO' => $this->input->post('TipoPlan'),
				'PLAN_NIVEL' => $this->input->post('NivelPlan'),
				'PLAN_LIMITE_PRODUCTOS' => $this->input->post('LimiteProductosPlan'),
				'PLAN_LIMITE_SERVICIOS' => $this->input->post('LimiteServiciosPlan'),
				'PLAN_FOTOS_PRODUCTOS' => $this->input->post('FotosProductosPlan'),
				'PLAN_FOTOS_SERVICIOS' => $this->input->post('FotosProductosPlan'),
      );

      $institucione_id = $this->PlanesModel->actualizar( $this->input->post('Identificador'),$parametros);
      redirect(base_url('admin/planes'));
    }else{

			$this->data['plan'] = $this->PlanesModel->detalles($_GET['id']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_plan',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$plan = $this->PlanesModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($plan['ID_PLAN']))
        {
            $this->PlanesModel->borrar($_GET['id']);
            redirect(base_url('admin/planes'));
        } else {

	         	show_error('La entrada que deseas borrar no existe');
				}
	}

	/*
	* PLAN DE USUARIO
	*/
	public function actualizar_plan_usuario()
	{
		$this->form_validation->set_rules('NombrePlan', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
		{
			$parametros = array(
				'PLAN_NOMBRE' => $this->input->post('NombrePlan'),
				'PLAN_MENSUALIDAD' => $this->input->post('MensualidadPlan'),
				'PLAN_ESPACIO_ALMACENAMIENTO' => $this->input->post('EspacioAlmacenamientoPlan'),
				'PLAN_COSTO_ALMACENAMIENTO' => $this->input->post('CostoAlmacenamientoPlan'),
				'PLAN_COMISION' => $this->input->post('ComisionPlan'),
				'PLAN_MANEJO_PRODUCTOS' => $this->input->post('ManejoProductosPlan'),
				'PLAN_ENVIO' => $this->input->post('EnvioPlan'),
				'PLAN_SERVICIOS_FINANCIEROS' => $this->input->post('ServiciosFinancierosPlan'),
				'PLAN_SERVICIOS_FINANCIEROS_FIJO' => $this->input->post('ServiciosFinancierosFijoPlan'),
				'PLAN_NIVEL' => $this->input->post('NivelPlan'),
				'PLAN_ESTADO'=>$this->input->post('EstadoPlan'),
				'PLAN_LIMITE_PRODUCTOS' => $this->input->post('LimiteProductosPlan'),
				'PLAN_LIMITE_SERVICIOS' => $this->input->post('LimiteServiciosPlan'),
				'PLAN_FOTOS_PRODUCTOS' => $this->input->post('FotosProductosPlan'),
				'PLAN_FOTOS_SERVICIOS' => $this->input->post('FotosProductosPlan'),
			);

			$this->PlanesModel->actualizar_plan_usuario( $this->input->post('Identificador'),$parametros);
			$plan = $this->PlanesModel->detalles_usuario($this->input->post('Identificador'));
			$tienda =  $this->TiendasModel->tienda_usuario($this->input->post('IdUsuario'));
			$perfil = $this->PerfilServiciosModel->perfil_usuario($this->input->post('IdUsuario'));

			$this->session->set_flashdata('exito', 'Plan Actualizado');
			if($plan['PLAN_TIPO']=='productos'){
				redirect(base_url('admin/tiendas/actualizar?id_tienda='.$tienda['ID_TIENDA']));
			}
			if($plan['PLAN_TIPO']=='servicios'){
				redirect('admin/perfiles_servicios/actualizar?id_usuario='.$this->input->post('IdUsuario').'&id_perfil='.$perfil['ID_PERFIL']);
			}
		}else{

			$this->data['plan'] = $this->PlanesModel->detalles_usuario($_GET['id']);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_plan_usuario',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}
	public function lista_planes()
	{
			// Obtengo los datos de mi tiendas
			if(!empty($_GET['tipo'])){
				$tipo = $_GET['tipo'];
			}else{
				$tipo = 'productos';
			}
			$this->data['tienda'] = $this->TiendasModel->tienda_usuario($_SESSION['usuario']['id']);
			$this->data['planes'] = $this->PlanesModel->lista(['PLAN_TIPO'=>$tipo]);
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_planes',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function activar()
	{
			// Debo redireccionar
			if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
				$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
				redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
			}

			$plan = $this->PlanesModel->detalles($_GET['id']);

			$parametros = array(
				'ID_PLAN'=>$plan['ID_PLAN'],
				'ID_USUARIO'=>$_GET['id_usuario'],
				'PLAN_NOMBRE'=>$plan['PLAN_NOMBRE'],
				'PLAN_MENSUALIDAD'=>$plan['PLAN_MENSUALIDAD'],
				'PLAN_ESPACIO_ALMACENAMIENTO'=>0,
				'PLAN_COSTO_ALMACENAMIENTO'=>$plan['PLAN_ALMACENAMIENTO'],
				'PLAN_COMISION'=>$plan['PLAN_COMISION'],
				'PLAN_MANEJO_PRODUCTOS'=>$plan['PLAN_MANEJO_PRODUCTOS'],
				'PLAN_ENVIO'=>$plan['PLAN_ENVIO'],
				'PLAN_SERVICIOS_FINANCIEROS'=>$plan['PLAN_SERVICIOS_FINANCIEROS'],
				'PLAN_SERVICIOS_FINANCIEROS_FIJO'=>$plan['PLAN_SERVICIOS_FINANCIEROS_FIJO'],
				'PLAN_TIPO'=>$plan['PLAN_TIPO'],
				'PLAN_LIMITE_PRODUCTOS'=>$plan['PLAN_LIMITE_PRODUCTOS'],
				'PLAN_LIMITE_SERVICIOS'=>$plan['PLAN_LIMITE_SERVICIOS'],
				'PLAN_FOTOS_PRODUCTOS'=>$plan['PLAN_FOTOS_PRODUCTOS'],
				'PLAN_FOTOS_SERVICIOS'=>$plan['PLAN_FOTOS_SERVICIOS'],
				'PLAN_NIVEL'=>$plan['PLAN_NIVEL'],
				'PLAN_ESTADO'=>'pendiente',
				'FECHA_INICIO'=>date('Y-m-d'),
				'FECHA_TERMINO'=>date('Y-m-d', strtotime("+1 month")),
				'AUTO_RENOVAR'=>'si',
			);
			$this->PlanesModel->crear_plan_usuario($parametros);
			$tienda = $this->TiendasModel->tienda_usuario($_GET['id_usuario']);
			$perfil = $this->PerfilServiciosModel->perfil_usuario($_GET['id_usuario']);
			$this->session->set_flashdata('exito', 'Plan activado');
			if($plan['PLAN_TIPO']=='productos'){
				redirect('admin/tiendas/actualizar?id_tienda='.$tienda['ID_TIENDA']);
			}
			if($plan['PLAN_TIPO']=='servicios'){
				redirect('admin/perfiles_servicios/actualizar?id_usuario='.$this->input->post('IdUsuario').'&id_perfil='.$perfil['ID_PERFIL']);
			}

	}
	public function auto_renovar()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		$plan = $this->PlanesModel->detalles_usuario($_GET['id']);
		$tienda = $this->TiendasModel->tienda_usuario($plan['ID_USUARIO']);
		$perfil = $this->PerfilServiciosModel->perfil_usuario($plan['ID_USUARIO']);
		$this->session->set_flashdata('exito', 'Plan Actualizado');
		$this->PlanesModel->auto_renovar($_GET['id'],$_GET['estado']);
		if($plan['PLAN_TIPO']=='productos'){
			redirect(base_url('admin/tiendas/actualizar?id_tienda='.$tienda['ID_TIENDA']));
		}
		if($plan['PLAN_TIPO']=='servicios'){
			redirect(base_url('admin/perfiles_servicios/actualizar?id_usuario='.$plan['ID_USUARIO'].'&id_perfil='.$perfil['ID_PERFIL']));
		}
	}
}
