<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Estados extends CI_Controller {

	public function __construct(){
    parent::__construct();
		// Cargo el modelo
		$this->load->model('EstadosModel');
  }

	public function index()
	{
		$estados = $this->EstadosModel->estados_del_pais($_GET['id']);
		echo json_encode($estados);
	}
}
