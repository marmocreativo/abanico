<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Producto extends CI_Controller {
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
		$this->load->model('UsuariosModel');
		$this->load->model('TiendaModel');
		$this->load->model('ProductosModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasModel');
		$this->load->model('TiendasModel');
		$this->load->model('DireccionesModel');
		$this->load->model('FavoritosModel');
		$this->load->model('CalificacionesModel');

		// Variables comunes
		$this->data['primary'] = "-primary-1";
  }
	 public function index()
 	{
		$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
		$this->data['portada'] = $this->GaleriasModel->galeria_portada($_GET['id']);
		$this->data['galerias'] = $this->GaleriasModel->galeria_producto($_GET['id']);
		$this->data['tienda'] = $this->TiendasModel->tienda_usuario($this->data['producto']['ID_USUARIO']);
		$direccion_fiscal = $this->DireccionesModel->direccion_fiscal($this->data['producto']['ID_USUARIO']);
		$this->data['direccion_formateada'] = $this->DireccionesModel->direccion_formateada($direccion_fiscal['ID_DIRECCION']);
		$this->data['categorias'] = $this->CategoriasModel->lista(['CATEGORIA_PADRE'=>0],'productos','','');

		// Calificaciones
		// Reviso si ya lo calificó el usuario
		if(isset($_SESSION['usuario']['id'])&!empty($_SESSION['usuario']['id'])){
			$this->data['mi_calificacion']= $this->CalificacionesModel->ya_calificado($this->data['producto']['ID_PRODUCTO'],$_SESSION['usuario']['id']);
			$this->data['calificaciones'] = $this->CalificacionesModel->calificaciones_producto($_GET['id'],$this->data['mi_calificacion']['ID_CALIFICACION']);
		}else{
				$this->data['calificaciones'] = $this->CalificacionesModel->calificaciones_producto($_GET['id'],'');
		}

 		$this->load->view($this->data['dispositivo'].'/tienda/headers/header_inicio',$this->data);
 		$this->load->view($this->data['dispositivo'].'/tienda/producto',$this->data);
 		$this->load->view($this->data['dispositivo'].'/tienda/footers/footer_inicio',$this->data);

 	}
	public function favorito()
 {
	 if(verificar_sesion()){
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
		 }
		 redirect(base_url('usuario/favoritos'));
	}else{
		redirect(base_url('login'));
	}

 }
 public function quitar_favorito()
{
	if(verificar_sesion()){
		// verifico si ya existe
		$es_favorito = $this->FavoritosModel->es_favorito($_GET['id'],$_SESSION['usuario']['id'],'producto');
		if($es_favorito){
			$favorito = $this->FavoritosModel->detalles($_GET['id'],$_SESSION['usuario']['id'],'producto');

		 $this->FavoritosModel->borrar($favorito['ID_FAVORITO']);
		}
		redirect(base_url('usuario/favoritos'));
 }else{
	 redirect(base_url('login'));
 }

}
public function calificar()
{
 if(verificar_sesion()){
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
	 redirect(base_url('producto?id='.$this->input->post('IdProducto')));
}else{
	redirect(base_url('login'));
}

}
}
