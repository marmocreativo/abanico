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
    $productos_concurso = explode(' ',$concurso['PRODUCTOS']);
    $frase_concurso = explode(' ',$concurso['FRASE']);
    $ganador = $concurso['ID_GANADOR'];

		if(!empty($concurso)){
			echo '<div class="container">';
				if(isset($_SESSION['usuario']['id'])){

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
					'<div class="row instrucciones">
						<div class="col text-center pt-3">
							<h4>Hay <span class="animated tada infinite" style="display:inline-block">'.count($palabras).'</span> palabras escondidas en las descripciones de algunos de nuestros productos, sé el primero en encontrarlas, formar la frase y ganarás nuestro premio</h4>';
							if($concurso['MOSTRAR_FRASE']=='si'){
						echo '
							<blockquote class="blockquote">
								<h4 class="mb-0">"'.$concurso['FRASE'].'"</h4>
							</blockquote>';
						}
						echo '<p>Las palabras estás escondidas en la descripción, las notarás por que el cursos cambiará al pasarlo por encima.</p>'
						echo '</div>
					</div>';
					echo '<div class="row py-4" style="min-height:50px" id="concurso_sortable">';
						shuffle($palabras);
						foreach($palabras as $palabra){
							if($_SESSION['concurso']['palabras'][$palabra]=='si'){
								echo '<div class="col p-3 border border-primary" >';
									echo $palabra;
								echo '</div>';
							 }
						 }
					echo '</div>';
				}else{
					// Si no se ha iniciado sesión los invito a inciarla
					echo '<div class="row py-4" style="min-height:50px">
						<div class="col p-3 border border-primary text-center" >
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
