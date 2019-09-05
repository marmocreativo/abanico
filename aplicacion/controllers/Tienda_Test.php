<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_Test extends CI_Controller {

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
		$this->load->model('TiendaModel');
		$this->load->model('ProductosModel');
		$this->load->model('CategoriasModel');
		$this->load->model('GaleriasModel');
		$this->load->model('CategoriasProductoModel');
		$this->load->model('CalificacionesModel');
		$this->load->model('PedidosModel');
		$this->load->model('PedidosProductosModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('PublicacionesModel');
  }

	public function url_productos()
	{
		/*
		$productos = $this->ProductosModel->lista('','','','');
		foreach($productos as $producto){
			if($producto->META_TITULO!=''){
				$titulo = $producto->META_TITULO;
			}else{
				$titulo = $producto->PRODUCTO_NOMBRE;
			}
			$url = url_title(convert_accented_characters($titulo),'-',TRUE);
			$unico = 'si';
			$existe = $this->ProductosModel->lista_avanzada('',['ID_PRODUCTO !='=>$producto->ID_PRODUCTO, 'PRODUCTO_URL'=>$url],'','',1);
			if(!empty($existe)){
				$url = $url.'-'.url_title(easy_slug(2),'-',TRUE);
				$unico = 'no';
			}
			echo $titulo.' | <b>'.$unico.'</b> | '.$url;
			echo '<br>';
			$parametros = array(
				'PRODUCTO_URL'=>$url
			);
			$this->ProductosModel->actualizar($producto->ID_PRODUCTO,$parametros);
		}
		*/
	}
	public function url_categorias()
	{
		/*
		$categorias = $this->CategoriasModel->lista('','','','');
		foreach($categorias as $categoria){
			$titulo = $categoria->CATEGORIA_NOMBRE;
			$url = url_title(convert_accented_characters($titulo),'-',TRUE);
			$unico = 'si';
			$existe = $this->CategoriasModel->lista_avanzada('',['ID_CATEGORIA !='=>$categoria->ID_CATEGORIA, 'CATEGORIA_URL'=>$url],'','',1);
			if(!empty($existe)){
				$url = $url.'-'.url_title(easy_slug(2),'-',TRUE);
				$unico = 'no';
			}
			echo $titulo.' | <b>'.$unico.'</b> | '.$url;
			echo '<br>';
			$parametros = array(
				'CATEGORIA_URL'=>$url
			);
			$this->CategoriasModel->actualizar($categoria->ID_CATEGORIA,$parametros);
		}
		*/
	}
}
