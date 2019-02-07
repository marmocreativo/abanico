<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Notificaciones extends CI_Controller {

	public function __construct(){
    parent::__construct();
		// Cargo el modelo
		$this->load->model('NotificacionesModel');
  }

	public function marcar_leidas()
	{
		//var_dump($_POST);
		$this->NotificacionesModel->marcar_todas_leidas($this->input->post('IdUsuario'));
	}
}
