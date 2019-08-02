<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Reordenar extends CI_Controller {

	public function __construct(){
    parent::__construct();
		// Cargo el modelo
		$this->load->model('PaisesModel');
  }

	public function publicaciones()
	{
		$this->load->model('PublicacionesModel');
		$i = 0;
		parse_str($_GET['objetos'],$objetos);
		foreach ( $objetos['item'] as $identificador) {

			$parametros = array(
				'ORDEN' => $i,
			);

			$this->PublicacionesModel->actualizar( $identificador,$parametros);
		   $i++;
		}
	}
	public function productos_combinaciones()
	{
		$this->load->model('ProductosCombinacionesModel');
		$i = 0;
		parse_str($_GET['objetos'],$objetos);
		foreach ( $objetos['item'] as $identificador) {

			$parametros = array(
				'ORDEN' => $i,
			);

			$this->ProductosCombinacionesModel->actualizar( $identificador,$parametros);
		   $i++;
		}
	}
	public function galeria_productos()
	{
		$this->load->model('GaleriasModel');
		$i = 0;
		parse_str($_GET['objetos'],$objetos);
		foreach ( $objetos['item'] as $identificador) {

			$parametros = array(
				'ORDEN' => $i,
			);

			$this->GaleriasModel->actualizar( $identificador,$parametros);
		   $i++;
		}
	}
	public function slides()
	{
		$this->load->model('SlidesModel');
		$i = 0;
		parse_str($_GET['objetos'],$objetos);
		foreach ( $objetos['item'] as $identificador) {

			$parametros = array(
				'ORDEN' => $i,
			);

			$this->SlidesModel->actualizar( $identificador,$parametros);
		   $i++;
		}
	}
}
