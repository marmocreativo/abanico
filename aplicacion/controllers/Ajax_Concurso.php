<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Concurso extends CI_Controller {

	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();
		// Cargo Lenguaje
		$this->lang->load('front_end', $_SESSION['lenguaje']['iso']);
		// Cargo el modelo
		$this->load->model('ConcursosModel');
  }

	public function index()
	{
    $concurso = $this->ConcursosModel->activo();
		$this->data['concurso'] = $concurso;
    $frase_concurso = unserialize($concurso['FRASE']);
    $ganador = $concurso['ID_GANADOR'];
		// Si no hay un concurso no muestro nada
		if(!empty($concurso)){
			// Por defecto no muestro controles del concurso
			$mostrar_concurso = false;
			// Si hay sesión iniciada si lo muestro
			if(isset($_SESSION['usuario']['id'])){
				$mostrar_concurso = true;

				//Si el concurso es solo admin y no es administrador, vuelvo a ocultar el concurso
				if($concurso['SOLO_ADMIN']=='si'&&$_SESSION['usuario']['tipo_usuario']!='adm-6'){
					$mostrar_concurso = false;
				}
			}
			// cargo las vistas de los concursos
			if($mostrar_concurso){
				// Aquí se cargan las vistas que tienen control de los concursos
				$id_participante = $_SESSION['usuario']['id'];
				$fecha_inicio = date('Y-m-d H:i:s');
				$palabras = $frase_concurso;
				$this->data['palabras']= $palabras;

				// Inicializo las variables del concurso
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
					// Genero el historial
					$parametros = array(
						'ID_CONCURSO'=>$concurso['ID'],
						'ID_USUARIO' =>$id_participante,
						'MOVIMIENTO'=>'Iniciaste sesión para empezar a concursar',
						'PALABRAS' => serialize($_SESSION['concurso']['palabras'])
					);
					$this->ConcursosModel->crear_historial($parametros);
				}

				// Reviso en que fase del concurso estamos
				$palabras_faltantes = count($palabras);
				if(isset($_SESSION['concurso']['palabras'])){
					foreach($_SESSION['concurso']['palabras'] as $palabra_sesion){
						if($palabra_sesion['ENCONTRADA']=='si'){ $palabras_faltantes --; }
					}
				}

				if(empty($ganador)){
					if($palabras_faltantes==0){
						$this->load->view('concurso/concurso_ordenar',$this->data);
					}else{
						$this->load->view('concurso/concurso_buscar',$this->data);
					}

				}else{
					// Ya hay un ganador, reviso si soy yo
					if($ganador==$_SESSION['usuario']['id']){
						$this->load->view('concurso/concurso_ganaste',$this->data);
					}else{
						// Si no soy el ganador
						$this->load->view('concurso/concurso_perdiste',$this->data);
					}
				}


			}else{
				// Aquí se cargan las vistas que NO tienen control de los concursos

					$mostrar_invitacion = false;

					if($concurso['SOLO_ADMIN']=='no'){
						$mostrar_invitacion = true;
					}else{
						if(isset($_SESSION['usuario']['id'])){
							if($_SESSION['usuario']['tipo_usuario']=='adm-6'){
								$mostrar_invitacion = true;
							}
						}
					}
					// Muestro la invitación si se cumplieron los requisitos
					if($mostrar_invitacion){
						$this->load->view('concurso/concurso_iniciar',$this->data);
					}

			}
		}else{
			//Cargar cuenta regresiva
			$hoy = date('U');
			$fecha_alerta = date('U', strtotime('2019-09-23 16:00:00'));
			$fecha_concurso = date('U', strtotime('2019-09-24 17:00:00'));

			if($hoy>$fecha_alerta&&$hoy<$fecha_concurso){
				$this->load->view('concurso/cuenta_regresiva',$this->data);
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
				$parametros = array(
					'ID_CONCURSO'=>$_SESSION['concurso']['id_concurso'],
					'ID_USUARIO' =>$_SESSION['usuario']['id'],
					'MOVIMIENTO'=>'Encontraste la palabra "'.$_SESSION['concurso']['palabras'][$key]['PALABRA'].'"',
					'PALABRAS' => serialize($_SESSION['concurso']['palabras'])
				);
				$this->ConcursosModel->crear_historial($parametros);
			}
		}
	}

	public function frase_completa()
	{
		$hay_ganador = $this->ConcursosModel->ganador($_SESSION['concurso']['id_concurso']);
		if(!empty($hay_ganador['ID_GANADOR'])){
			$parametros = array(
				'ID_CONCURSO'=>$_SESSION['concurso']['id_concurso'],
				'ID_USUARIO' =>$_SESSION['usuario']['id'],
				'MOVIMIENTO'=>'Ordenaste las palabras, pero ya había un ganador.',
				'PALABRAS' => serialize($_SESSION['concurso']['palabras']),
				'ORDEN'=>'si'
			);
			$this->ConcursosModel->crear_historial($parametros);
		}else{
			$parametros = array(
				'ID_GANADOR'=>$_SESSION['concurso']['id'],
				'FECHA_GANADOR'=> date('Y-m-d h:i:s')
			);
			$this->ConcursosModel->actualizar($_SESSION['concurso']['id_concurso'],$parametros);
			//
			$parametros = array(
				'ID_CONCURSO'=>$_SESSION['concurso']['id_concurso'],
				'ID_USUARIO' =>$_SESSION['usuario']['id'],
				'MOVIMIENTO'=>'Felicidades fuiste el primero en encontrar y ordenar todas las palabras',
				'PALABRAS' => serialize($_SESSION['concurso']['palabras']),
				'ORDEN'=>'si'
			);
			$this->ConcursosModel->crear_historial($parametros);
		}
	}
}
