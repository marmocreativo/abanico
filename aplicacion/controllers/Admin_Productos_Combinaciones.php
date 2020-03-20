<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Productos_Combinaciones extends CI_Controller {

	public function __construct(){
    parent::__construct();
		$this->data['op'] = opciones_default();
		sesion_default($this->data['op']);
		$this->data['lenguajes_activos'] = $this->lenguajes_activos->get_lenguajes_activos();
		$this->data['divisas_activas'] = $this->divisas_activas->get_divisas_activas();
// Cargo Lenguaje
$this->lang->load('front_end', $_SESSION['lenguaje']['iso']);

		// Variables defaults
		$this->data['primary'] = "-primary";

		if($this->agent->is_mobile()){
			$this->data['dispositivo']  = "desktop";
		}else{
			$this->data['dispositivo']  = "desktop";
		}

		// Cargo el modelo
		$this->load->model('ProductosModel');
		$this->load->model('UsuariosModel');
		$this->load->model('TiendasModel');
		$this->load->model('ProductosCombinacionesModel');
		$this->load->model('GaleriasModel');
		$this->load->model('EstadisticasModel');
		$this->load->model('NotificacionesModel');
		$this->load->model('GeneralModel');

		// Verifico Sesión
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		// Verifico Permiso
		if(!verificar_permiso(['tec-5','adm-6'])){
			$this->session->set_flashdata('alerta', 'No tienes permiso de entrar en esa sección');
			redirect(base_url('usuario'));
		}
  }

	public function index()
	{
			// Tipo de Producto
			if(!isset($_GET['tipo_producto'])||empty($_GET['tipo_producto'])){ $this->data['tipo_producto']='normal'; }else{ $this->data['tipo_producto']=$_GET['tipo_producto']; }

			$this->data['producto'] = $this->ProductosModel->detalles($_GET['id']);
			$this->data['usuario'] = $this->UsuariosModel->detalles($this->data['producto']['ID_USUARIO']);
			$this->data['tienda'] = $this->TiendasModel->detalles($this->data['producto']['ID_TIENDA']);
			$this->data['combinaciones'] = $this->ProductosCombinacionesModel->lista($_GET['id'],'ORDEN ASC','');
			$this->data['galerias'] = $this->GaleriasModel->lista($_GET['id'],'ORDEN ASC','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_combinaciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
	}

	public function busqueda()
	{
		if(isset($_GET['Busqueda'])&&!empty($_GET['Busqueda'])){
			$parametros = array(
				'PRODUCTO_NOMBRE'=>$_GET['Busqueda'],
				'PRODUCTO_DESCRIPCION'=>$_GET['Busqueda'],
				'PRODUCTO_MODELO'=>$_GET['Busqueda']
			);
			$this->data['productos'] = $this->ProductosModel->lista($parametros,'','','');

			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/lista_productos',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);

		}else{
			redirect(base_url('admin/productos'));
		}
	}


	public function crear()
	{
		// Defino el tipo de Categoria
		$this->form_validation->set_rules('GrupoCombinacion', 'Grupo', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('OpcionCombinacion', 'Opcion', 'required', array( 'required' => 'Debes designar la %s'));

		if($this->form_validation->run())
		{
			// Parametros del producto
			$parametros = array(
				'ID_PRODUCTO'=> $this->input->post('IdProducto'),
				'COMBINACION_GRUPO'=> $this->input->post('GrupoCombinacion'),
				'COMBINACION_OPCION'=> $this->input->post('OpcionCombinacion'),
				'COMBINACION_PRECIO'=> $this->input->post('PrecioCombinacion'),
				'COMBINACION_PRECIO_MAYOREO'=> $this->input->post('PrecioMayoreoCombinacion'),
				'COMBINACION_MOSTRAR_MAYOREO'=> $this->input->post('CombinacionMostrarMayoreo'),
				'COMBINACION_CANTIDAD'=> $this->input->post('CantidadCombinacion'),
				'COMBINACION_IMAGEN'=> $this->input->post('ImagenCombinacion'),
				'COMBINACION_ANCHO'=> $this->input->post('AnchoCombinacion'),
				'COMBINACION_ALTO'=> $this->input->post('AltoCombinacion'),
				'COMBINACION_PROFUNDO'=> $this->input->post('ProfundoCombinacion'),
				'COMBINACION_PESO'=> $this->input->post('PesoCombinacion'),
				'COMBINACION_PESO_NETO'=> $this->input->post('PesoNetoCombinacion')
			);
			// Creo el Producto
			$combinacion_id = $this->ProductosCombinacionesModel->crear($parametros);

			// Ajustar cantidades
			$cantidades_combinaciones = $this->GeneralModel->lista('productos_combinaciones','',['ID_PRODUCTO'=>$this->input->post('IdProducto')],'','','');
			$detalles_producto =  $this->GeneralModel->detalles('productos',['ID_PRODUCTO'=>$this->input->post('IdProducto')]);
			$cantidad_anterior = $detalles_producto['PRODUCTO_CANTIDAD'];
			$cantidad_nueva = 0;
			foreach($cantidades_combinaciones as $cantidad){
				$cantidad_nueva += $cantidad->COMBINACION_CANTIDAD;
			}

			if($cantidad_nueva!=$cantidad_anterior){
				$parametros_movimiento = array(
					'ORIGEN'=>'administrador',
					'ID_PEDIDO'=>'',
					'ID_PRODUCTO'=>$this->input->post('IdProducto'),
					'ID_COMBINACION'=>$combinacion_id,
					'TIPO_MOVIMIENTO'=>'actualizacion',
					'DETALLES'=>$this->input->post('GrupoCombinacion').' '.$this->input->post('OpcionCombinacion').' Actualizada desde el administrador',
					'CANTIDAD_ORIGINAL'=>$cantidad_anterior,
					'CANTIDAD_FINAL'=>$cantidad_nueva,
					'FECHA'=>date('Y-m-d H:i:s'),
					'ID_USUARIO'=>$_SESSION['usuario']['id']
				);

				$movimiento = $this->GeneralModel->crear('movimientos',$parametros_movimiento);

				$parametros_producto = array(
					'PRODUCTO_CANTIDAD'=>$cantidad_nueva
				);

				$this->GeneralModel->actualizar('productos',['ID_PRODUCTO'=>$this->input->post('IdProducto')],$parametros_producto);
			}



			// Mensaje Retroalimentación
			$this->session->set_flashdata('exito', 'Combinación Creado!');
			// Redirección
			redirect(base_url('admin/productos_combinaciones?id='.$this->input->post('IdProducto')));
    }else{
			$this->session->set_flashdata('alerta', 'Combinación No creada');
			redirect(base_url('admin/productos_combinaciones?id='.$this->input->post('IdProducto')));
		}
	}


	public function actualizar()
	{
		// Defino el tipo de Categoria
		$this->form_validation->set_rules('GrupoCombinacion', 'Grupo', 'required', array( 'required' => 'Debes designar el %s'));
		$this->form_validation->set_rules('OpcionCombinacion', 'Opcion', 'required', array( 'required' => 'Debes designar la %s'));

			if($this->form_validation->run())
			{
				// Parametros del producto
				$parametros = array(
					'ID_PRODUCTO'=> $this->input->post('IdProducto'),
					'COMBINACION_GRUPO'=> $this->input->post('GrupoCombinacion'),
					'COMBINACION_OPCION'=> $this->input->post('OpcionCombinacion'),
					'COMBINACION_PRECIO'=> $this->input->post('PrecioCombinacion'),
					'COMBINACION_PRECIO_MAYOREO'=> $this->input->post('PrecioMayoreoCombinacion'),
					'COMBINACION_MOSTRAR_MAYOREO'=> $this->input->post('CombinacionMostrarMayoreo'),
					'COMBINACION_CANTIDAD'=> $this->input->post('CantidadCombinacion'),
					'COMBINACION_IMAGEN'=> $this->input->post('ImagenCombinacion'),
					'COMBINACION_ANCHO'=> $this->input->post('AnchoCombinacion'),
					'COMBINACION_ALTO'=> $this->input->post('AltoCombinacion'),
					'COMBINACION_PROFUNDO'=> $this->input->post('ProfundoCombinacion'),
					'COMBINACION_PESO'=> $this->input->post('PesoCombinacion'),
					'COMBINACION_PESO_NETO'=> $this->input->post('PesoNetoCombinacion')
				);
				// Actualizo la combinación
				 $this->ProductosCombinacionesModel->actualizar($this->input->post('Identificador'),$parametros);

				// Ajustar cantidades
				$cantidades_combinaciones = $this->GeneralModel->lista('productos_combinaciones','',['ID_PRODUCTO'=>$this->input->post('IdProducto')],'','','');
				$detalles_producto =  $this->GeneralModel->detalles('productos',['ID_PRODUCTO'=>$this->input->post('IdProducto')]);
				$cantidad_anterior = $detalles_producto['PRODUCTO_CANTIDAD'];
				$cantidad_nueva = 0;
				foreach($cantidades_combinaciones as $cantidad){
					$cantidad_nueva += $cantidad->COMBINACION_CANTIDAD;
				}

				if($cantidad_nueva!=$cantidad_anterior){
					$parametros_movimiento = array(
						'ORIGEN'=>'administrador',
						'ID_PEDIDO'=>'',
						'ID_PRODUCTO'=>$this->input->post('IdProducto'),
						'ID_COMBINACION'=>$this->input->post('Identificador'),
						'TIPO_MOVIMIENTO'=>'actualizacion',
						'DETALLES'=>$this->input->post('GrupoCombinacion').' '.$this->input->post('OpcionCombinacion').' Actualizada desde el administrador',
						'CANTIDAD_ORIGINAL'=>$cantidad_anterior,
						'CANTIDAD_FINAL'=>$cantidad_nueva,
						'FECHA'=>date('Y-m-d H:i:s'),
						'ID_USUARIO'=>$_SESSION['usuario']['id']
					);

					$movimiento = $this->GeneralModel->crear('movimientos',$parametros_movimiento);
					$parametros_producto = array(
						'PRODUCTO_CANTIDAD'=>$cantidad_nueva
					);

					$this->GeneralModel->actualizar('productos',['ID_PRODUCTO'=>$this->input->post('IdProducto')],$parametros_producto);
				}

				// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Actualización correcta');
			// Redirección
			redirect(base_url('admin/productos_combinaciones?id='.$this->input->post('IdProducto')));
    }else{

			$this->data['combinacion'] = $this->ProductosCombinacionesModel->detalles($_GET['id']);
			$this->data['producto'] = $this->ProductosModel->detalles($this->data['combinacion']['ID_PRODUCTO']);
			$this->data['usuario_producto'] = $this->UsuariosModel->detalles($this->data['producto']['ID_USUARIO']);
			$this->data['galerias'] = $this->GaleriasModel->lista($this->data['producto']['ID_PRODUCTO'],'','');
			$this->load->view($this->data['dispositivo'].'/admin/headers/header',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/form_actualizar_combinaciones',$this->data);
			$this->load->view($this->data['dispositivo'].'/admin/footers/footer',$this->data);
		}
	}

	public function borrar()
	{
		$combinacion = $this->ProductosCombinacionesModel->detalles($_GET['id']);

        // check if the institucione exists before trying to delete it
        if(isset($combinacion['ID_COMBINACION']))
        {
            $this->ProductosCombinacionesModel->borrar($_GET['id']);

						// Ajustar cantidades
						$cantidades_combinaciones = $this->GeneralModel->lista('productos_combinaciones','',['ID_PRODUCTO'=>$combinacion['ID_PRODUCTO']],'','','');
						$detalles_producto =  $this->GeneralModel->detalles('productos',['ID_PRODUCTO'=>$combinacion['ID_PRODUCTO']]);
						$cantidad_anterior = $detalles_producto['PRODUCTO_CANTIDAD'];
						$cantidad_nueva = 0;
						foreach($cantidades_combinaciones as $cantidad){
							$cantidad_nueva += $cantidad->COMBINACION_CANTIDAD;
						}

						if($cantidad_nueva!=$cantidad_anterior){
							$parametros_movimiento = array(
								'ORIGEN'=>'administrador',
								'ID_PEDIDO'=>'',
								'ID_PRODUCTO'=>$combinacion['ID_PRODUCTO'],
								'ID_COMBINACION'=>$combinacion['ID_COMBINACION'],
								'TIPO_MOVIMIENTO'=>'actualizacion',
								'DETALLES'=>$combinacion['COMBINACION_GRUPO'].' '.$combinacion['COMBINACION_OPCION'].' Eliminada desde el administrador',
								'CANTIDAD_ORIGINAL'=>$cantidad_anterior,
								'CANTIDAD_FINAL'=>$cantidad_nueva,
								'FECHA'=>date('Y-m-d H:i:s'),
								'ID_USUARIO'=>$_SESSION['usuario']['id']
							);

							$movimiento = $this->GeneralModel->crear('movimientos',$parametros_movimiento);
							$parametros_producto = array(
								'PRODUCTO_CANTIDAD'=>$cantidad_nueva
							);

							$this->GeneralModel->actualizar('productos',['ID_PRODUCTO'=>$this->input->post('IdProducto')],$parametros_producto);
						}
						// Mensaje de Feedback
						$this->session->set_flashdata('exito', 'Combinación Borrada');
						// Redirección
            redirect(base_url('admin/productos_combinaciones?id=').$combinacion['ID_PRODUCTO']);
        } else {
	         	show_error('La entrada que deseas borrar no existe');
				}

	}
}
