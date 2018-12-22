<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Municipios extends CI_Controller {

	public function __construct(){
    parent::__construct();
		// Cargo el modelo
		$this->load->model('MunicipiosModel');
  }

	public function index()
	{
		$municipios = $this->MunicipiosModel->municipios_del_estado($_GET['id_pais'],$_GET['estado']);
		echo json_encode($municipios);
	}
}
