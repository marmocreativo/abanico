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
		// Hay un concurso
		if(!empty($concurso)){
			// Por defecto no muestro el concurso
			$mostrar_concurso = false;
			// Si hay sesión iniciada si lo muestro
			if(isset($_SESSION['usuario']['id'])){
				$mostrar_concurso = true;

				//Si el concurso es solo admin y no es administrador, vuelvo a ocultar el concurso
				if($concurso['SOLO_ADMIN']=='si'&&$_SESSION['usuario']['tipo_usuario']!='adm-6'){
					$mostrar_concurso = false;
				}
			}
			// Si ya hay un ganador, NO MUESTRO EL CONCURSO
			if(!empty($ganador)){
				$mostrar_concurso = false;
			}
				if($mostrar_concurso){

						// inicia el concurso
						$id_participante = $_SESSION['usuario']['id'];
						$fecha_inicio = date('Y-m-d H:i:s');
						$palabras = $frase_concurso;
						if(!isset($_SESSION['concurso'])){
							$_SESSION['concurso'] = array();
							$_SESSION['concurso']['id_concurso'] = $concurso['ID'];
							$_SESSION['concurso']['id'] = $id_participante;
							$_SESSION['concurso']['fecha_inicio'] = $fecha_inicio;
							foreach($palabras as $palabra){
								$_SESSION['concurso']['palabras'][]=array(
									'ORDEN'=>$palabra['ORDEN'],
									'ID'=>$palabra['ID'],
									'PALABRA'=>$palabra['PALABRA'],
									'ENCONTRADA'=>'no'
								);
							}
						}
						//var_dump($_SESSION['concurso']);
					// Escribo las instrucciones
					echo '<div class="container my-3 border border-info" style="border-style:dashed !important">';
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
						foreach($_SESSION['concurso']['palabras'] as $key => $palabra){
							if($palabra['ENCONTRADA']=='si'){
								$palabras_encontradas ++;
							}
						}
						echo '<div class="col-12 col-md-2 text-center pt-3">
							<p>Palabras encontradas:</p>
							<p class="display-4">'.$palabras_encontradas.'/'.count($palabras).'</p>
						</div>';
					echo '</div>';
					echo '<div class="row py-4" style="min-height:50px" id="concurso_sortable" data-numero-palabras="'.count($palabras).'">';
						shuffle($_SESSION['concurso']['palabras']);
						$i = 0;
						//var_dump($_SESSION['concurso']['palabras']);
						foreach($_SESSION['concurso']['palabras'] as $key => $palabra){

							if($palabra['ENCONTRADA']=='si'){
								if($key==$palabra['ORDEN']){
									$clase_visible= 'border border-info bg-info text-white correcto';
								}else{
									$clase_visible= 'border border-info text-info incorrecto';
								}

								echo '<div class="col palabra_concurso p-3 text-center m-2 animated fadeInUp '.$clase_visible.'"
								style="border-style:dashed !important; cursor:pointer; background-color:rgba(230,230,230,1); animation-delay:'.$i.'00ms"
								data-orden="'.$palabra['ORDEN'].'"
								data-id="'.$palabra['ID'].'"
								data-palabra="'.$palabra['PALABRA'].'"
								>';
									echo $palabra['PALABRA'];
								echo '</div>';
							 }

							 $i++;
						 }
					echo '</div>';

					echo '</div>'; // Termina el contenedor Global
				}else{
					if(isset($_SESSION['usuario']['id'])){
					if($concurso['SOLO_ADMIN']=='si'&&$_SESSION['usuario']['tipo_usuario']=='adm-6'){
						echo '<div class="container my-3 border border-info" style="border-style:dashed !important">';
						if(!isset($_SESSION['usuario']['id'])){
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
						}else{
							if(!empty($concurso['ID_GANADOR'])&&$concurso['ID_GANADOR']==$_SESSION['usuario']['id']){
								// Si no se ha iniciado sesión los invito a inciarla
								echo '<div class="row py-4" style="min-height:50px">
								<div class="col-12 col-md-2 text-center">
								<img src="'.base_url('assets/global/img/tesoro.png').'" class="img-fluid">
								</div>
									<div class="col p-3 text-center" >
										<h1>Has ganado!!!!</h1>
										<h3>Muchas gracias por haber participado. pronto nos comunicaremos contigo</h3>
									</div>
								</div>';

							}
							if(!empty($concurso['ID_GANADOR'])&&$concurso['ID_GANADOR']!=$_SESSION['usuario']['id']){
								// Si no se ha iniciado sesión los invito a inciarla
								echo '<div class="row py-4" style="min-height:50px">
								<div class="col-12 col-md-2 text-center">
								<img src="'.base_url('assets/global/img/tesoro.png').'" class="img-fluid">
								</div>
									<div class="col p-3 text-center" >
										<h1>Ya hay ganador!!!!</h1>
										<h3>Muchas gracias por haber participado.</h3>
									</div>
								</div>';
							}
						}
						echo '</div>'; // Termina el contenedor Global
						}
					}
				}

		}
	}

	public function palabra_encontrada()
	{
		$palabra_encontrada = $_GET['palabra'];
		$id_encontrada = $_GET['id'];

		echo $palabra_encontrada;
		echo '<br>';
		echo $id_encontrada;
		foreach($_SESSION['concurso']['palabras'] as $key=>$palabras_sesion){
			if($palabras_sesion['PALABRA']==$palabra_encontrada&&$palabras_sesion['ID']==$id_encontrada){
				$_SESSION['concurso']['palabras'][$key]['ENCONTRADA']='si';
			}
		}
	}

	public function frase_completa()
	{
		$hay_ganador = $this->ConcursosModel->ganador($_SESSION['concurso']['id_concurso']);
		if(!empty($hay_ganador['ID_GANADOR'])){
			echo 'Completaste la frase, pero ya hubo un ganador';
		}else{
			$parametros = array(
				'ID_GANADOR'=>$_SESSION['concurso']['id'],
				'FECHA_GANADOR'=> date('Y-m-d h:i:s')
			);
			$this->ConcursosModel->actualizar($_SESSION['concurso']['id_concurso'],$parametros);
			echo 'HAS GANADO!';
		}
	}
}
