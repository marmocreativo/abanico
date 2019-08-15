<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Paises extends CI_Controller {

	public function __construct(){
    parent::__construct();
		// Cargo el modelo
		$this->load->model('PaisesModel');
  }

	public function index()
	{
		echo json_encode($this->PaisesModel->lista_activos());
	}
}
