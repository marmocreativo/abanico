<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Concurso extends CI_Controller {

	public function __construct(){
    parent::__construct();
		// Cargo el modelo
		$this->load->model('ConcursosModel');
  }

	public function index()
	{
    $concurso = $this->ConcursosModel->activo();
    $frase_concurso = unserialize($concurso['FRASE']);
    $ganador = $concurso['ID_GANADOR'];

		if(!empty($concurso)){
			echo '<div class="container my-3 border border-info" style="border-style:dashed !important">';
				$mostrar_concurso = false;
				if(isset($_SESSION['usuario']['id'])){
					$mostrar_concurso = true;
				}
				if($concurso['SOLO_ADMIN']=='si'&&$_SESSION['usuario']['tipo_usuario']!='adm-6'){
					$mostrar_concurso = false;
				}
				if($mostrar_concurso){

						// inicia el concurso
						$id_participante = $_SESSION['usuario']['id'];
						$fecha_inicio = date('Y-m-d H:i:s');
						$palabras = $frase_concurso;
						if(!isset($_SESSION['concurso'])){
							$_SESSION['concurso'] = array();
							$_SESSION['concurso']['id'] = $id_participante;
							$_SESSION['concurso']['fecha_inicio'] = $fecha_inicio;
							foreach($palabras as $palabra){
								$_SESSION['concurso']['palabras'][$palabra]='no';
							}
						}
						//var_dump($_SESSION['concurso']);
					// Escribo las instrucciones
					echo
					'<div class="row  instrucciones" >
						<div class="col-12 col-md-2 text-center">
						<img src="'.base_url('assets/global/img/tesoro.png').'" class="img-fluid">
						</div>
						<div class="col text-center pt-3">
							<h3 class="mb-0">"'.$concurso['TITULO'].'"</h3>
							<h5>1.- Busca las <span class="animated tada infinite" style="display:inline-block">'.count($palabras).' palabras</span>  escondidas  en las descripciones de algunos de nuestros productos y toca o da click en ellas.</h5>
							<h5>2.- Cuando tengas las palabras ordénalas y forma la frase (sabrás que la palabra está en el orden correcto cuando cambie de <span class="text-info">color</span>)</h5>';
						echo '</div>';
						$palabras_encontradas = 0;
						foreach($palabras as $palabra){
							if($_SESSION['concurso']['palabras'][$palabra]=='si'){
								$palabras_encontradas ++;
							}
						}
						echo '<div class="col-12 col-md-2 text-center pt-3">
							<p>Palabras encontradas:</p>
							<p class="display-4">'.$palabras_encontradas.'/'.count($palabras).'</p>
						</div>';
					echo '</div>';
					echo '<div class="row py-4" style="min-height:50px" id="concurso_sortable">';
						shuffle($palabras);
						$i = 0;
						foreach($palabras as $palabra){
							if($_SESSION['concurso']['palabras'][$palabra]=='si'){
								echo '<div class="col border border-info text-info p-3 text-center m-2 animated fadeInUp" style="border-style:dashed !important; cursor:pointer; background-color:rgba(230,230,230,1); animation-delay:'.$i.'00ms" >';
									echo $palabra;
								echo '</div>';
							 }
							 $i++;
						 }
					echo '</div>';
				}else{
					// Si no se ha iniciado sesión los invito a inciarla
					echo '<div class="row py-4" style="min-height:50px">
					<div class="col-2">
					<img src="'.base_url('assets/global/img/tesoro.png').'" class="img-fluid">
					</div>
						<div class="col p-3 text-center" >
							<h1>Hay un concurso en progreso!!!</h1>
							<a href="'.base_url('login').'"> Inicia sesión para participar</a>
						</div>
					</div>';
				}
			echo '</div>';
		}
	}

	public function palabra_encontrada()
	{
		$palabra_encontrada = $_GET['palabra'];
		var_dump($_SESSION['concurso']['palabras']);
		if(isset($_SESSION['concurso']['palabras'][$palabra_encontrada])){
			$_SESSION['concurso']['palabras'][$palabra_encontrada]='si';
		}
	}
}
