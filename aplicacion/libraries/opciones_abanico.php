<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opciones_abanico {

        public function cargar_opciones()
        {
          $this->load->database(); // load database
          // Cargo Opciones
      		$this->load->model('opciones');
      		$opciones_raw = $this->opciones->get_opciones();
      		foreach($opciones_raw as $op_raw){
      			$opciones[$op_raw->OPCION_NOMBRE] = $op_raw->OPCION_VALOR;
      		}
      		$this->data['op'] = $opciones;
        }
}
