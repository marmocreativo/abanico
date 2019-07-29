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
