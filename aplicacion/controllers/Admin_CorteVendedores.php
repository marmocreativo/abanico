<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_CorteVendedores extends CI_Controller {

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
			$this->data['todas_tiendas'] = $this->TiendasModel->lista('','','','');
			//
			if(isset($_GET['IdTienda'])&&!empty($_GET['IdTienda'])){
				$this->data['tiendas'] = $this->TiendasModel->lista(['ID_TIENDA'=>$_GET['IdTienda']],'','','');
			}else{
				$this->data['tiendas'] = $this->TiendasModel->lista('','','','');
			}

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_corte_vendedores',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}
	public function actualizar()
	{
		foreach($_POST['FolioLiquidacion'] as $pedido => $folio){
			if(!empty($folio)){
				$parametros = array(
					'PEDIDO_TIENDA_LIQUIDADO'=>'si',
					'FOLIO_LIQUIDAR'=>$folio
				);
				$this->PedidosTiendasModel->actualizar($pedido,$parametros);
			}
		}
		$this->session->set_flashdata('exito', 'Folios Cargados Correctamente');
		redirect(base_url('admin/corte_vendedores?MesCorte='.$_POST['MesCorte'].'&AnioCorte='.$_POST['AnioCorte'].'&IdTienda='.$_POST['IdTienda']));
	}
	public function imprimir()
	{
			$this->data['todas_tiendas'] = $this->TiendasModel->lista('','','','');
			//
			if(isset($_GET['IdTienda'])&&!empty($_GET['IdTienda'])){
				$this->data['tiendas'] = $this->TiendasModel->lista(['ID_TIENDA'=>$_GET['IdTienda']],'','','');
			}else{
				$this->data['tiendas'] = $this->TiendasModel->lista('','','','');
			}
			$this->data['titulo'] = 'Ficha Liquidación';
			$this->load->view($this->data['dispositivo'].'/admin/headers/header_imprimir',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_corte_vendedores_imprimir',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer_imprimir',$this->data);
	}

}
