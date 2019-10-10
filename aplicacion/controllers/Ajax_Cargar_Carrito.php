<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Cargar_Carrito extends CI_Controller {

	public function __construct(){
    parent::__construct();
		$this->lang->load('front_end', $_SESSION['lenguaje']['iso']);
		if($this->agent->is_mobile()){
			$this->data['dispositivo']  = "mobile";
		}else{
			$this->data['dispositivo']  = "desktop";
		}
		// Cargo Modelos
		$this->load->model('DivisasModel');
		$this->load->model('UsuariosModel');
		$this->load->model('PedidosModel');
		$this->load->model('DireccionesModel');
  }

	public function index()
	{
		$this->load->view($this->data['dispositivo'].'/tienda/carrito',$this->data);
	}

	public function cargar()
	{
		if(isset($_POST['IdProducto'])){
			// Reviso si el producto ya existe
			$existe = false;
			$existe_tienda = false;
			$i = 0;
			foreach($_SESSION['carrito']['productos'] as $producto){
				if($producto['id_producto']==$_POST['IdProducto']&&$producto['detalles_producto']==$_POST['DetallesProducto']){
					// Si existe aumento la cantidad
					$_SESSION['carrito']['productos'][$i]['cantidad_producto'] += $_POST['CantidadProducto'];
					$existe = true;
				}
				++$i;
			}
			// Si no existe lo creo
			if(!$existe){
				$_SESSION['carrito']['productos'][] = [
					'id_producto'=> $_POST['IdProducto'],
					'nombre_producto'=> $_POST['NombreProducto'],
					'imagen_producto'=> $_POST['ImagenProducto'],
					'peso_producto'=> $_POST['PesoProducto'],
					'detalles_producto' => $_POST['DetallesProducto'],
					'sku' => $_POST['Sku'],
					'cantidad_max' => $_POST['CantidadMaxima'],
					'divisa_default' => $_POST['DivisaDefault'],
					'contra_entrega' => $_POST['ContraEntrega'],
					'contra_entrega_pagar' => 'si',
					'envio_gratuito' => $_POST['EnvioGratuito'],
					'cantidad_producto' => $_POST['CantidadProducto'],
					'precio_producto'=> $_POST['PrecioProducto'],
					'id_tienda' => $_POST['IdTienda'],
					'nombre_tienda' => $_POST['NombreTienda']
				];
				// tienda
				if(empty($_SESSION['carrito']['tiendas'][$_POST['IdTienda']])){
					$_SESSION['carrito']['tiendas'][$_POST['IdTienda']]=$_POST['NombreTienda'];
				}
			}
		}
	}
	public function disminuir()
	{
		if(isset($_POST['IdProducto'])){
			// Reviso si el producto ya existe
			$existe = false;
			$i = 0;
			// variables para eliminar tienda en caso de ser necesario
			$productos_tienda = array();
			foreach($_SESSION['carrito']['tiendas']as $key => $tienda){
				$productos_tienda[$key]=0;
			}

			foreach($_SESSION['carrito']['productos'] as $producto){
				$productos_tienda[$producto['id_tienda']] ++;
				if($producto['id_producto']==$_POST['IdProducto']&&$producto['detalles_producto']==$_POST['DetallesProducto']){
					$cantidad_anterior = $_SESSION['carrito']['productos'][$i]['cantidad_producto'];
					$cantidad_nueva = $_SESSION['carrito']['productos'][$i]['cantidad_producto'] - 1;
					if($cantidad_nueva<=0){
						//
						unset( $_SESSION['carrito']['productos'][$i]);
						$productos_tienda[$producto['id_tienda']] --;
						$_SESSION['carrito']['productos'] = array_values($_SESSION['carrito']['productos']);
					}else{
						$_SESSION['carrito']['productos'][$i]['cantidad_producto'] = $cantidad_nueva;
					}
				}
				if($productos_tienda[$producto['id_tienda']]<=0){
					unset( $_SESSION['carrito']['tiendas'][$producto['id_tienda']]);
				}
				++$i;
			}
		}
	}
	public function incrementar()
	{
		if(isset($_POST['IdProducto'])){
			// Reviso si el producto ya existe
			$existe = false;
			$i = 0;
			foreach($_SESSION['carrito']['productos'] as $producto){
				if($producto['id_producto']==$_POST['IdProducto']&&$producto['detalles_producto']==$_POST['DetallesProducto']){
					$cantidad_anterior = $_SESSION['carrito']['productos'][$i]['cantidad_producto'];
					$cantidad_nueva = $cantidad_anterior +=1;
					// reviso la cantidad
					if($cantidad_nueva>$_POST['CantidadMaxima']){
						$_SESSION['carrito']['productos'][$i]['cantidad_producto'] = $_POST['CantidadMaxima'];
					}else{
						$_SESSION['carrito']['productos'][$i]['cantidad_producto'] = $cantidad_nueva;
					}
				}
				++$i;
			}
		}
	}
	public function cantidad()
	{
		if(isset($_POST['IdProducto'])){
			// Reviso si el producto ya existe
			$existe = false;
			$i = 0;
			// variables para eliminar tienda en caso de ser necesario
			$productos_tienda = array();
			foreach($_SESSION['carrito']['tiendas']as $key => $tienda){
				$productos_tienda[$key]=0;
			}
			foreach($_SESSION['carrito']['productos'] as $producto){
				$productos_tienda[$producto['id_tienda']] ++;
				if($producto['id_producto']==$_POST['IdProducto']){
					if($_POST['CantidadProducto']<=0){
						unset( $_SESSION['carrito']['productos'][$i]);
						$productos_tienda[$producto['id_tienda']] --;
					}else{
						if($_POST['CantidadProducto']>=$_POST['CantidadMaxima']){
							$_SESSION['carrito']['productos'][$i]['cantidad_producto'] = $_POST['CantidadMaxima'];
						}else{
							$_SESSION['carrito']['productos'][$i]['cantidad_producto'] = $_POST['CantidadProducto'];
						}
					}
				}
				if($productos_tienda[$producto['id_tienda']]<=0){
					unset( $_SESSION['carrito']['tiendas'][$producto['id_tienda']]);
				}
				++$i;
			}
		}
	}
	public function eliminar()
	{
		if(isset($_POST['IdProducto'])){
			// Reviso si el producto ya existe
			$existe = false;
			$i = 0;

			$productos_tienda = array();

			foreach($_SESSION['carrito']['tiendas']as $key => $tienda){
				$productos_tienda[$key]=0;
			}
			foreach($_SESSION['carrito']['productos'] as $producto){
				$productos_tienda[$producto['id_tienda']] ++;
				if($producto['id_producto']==$_POST['IdProducto']&&$producto['detalles_producto']==$_POST['DetallesProducto']){
					unset( $_SESSION['carrito']['productos'][$i]);
					$productos_tienda[$producto['id_tienda']] --;
					$_SESSION['carrito']['productos'] = array_values($_SESSION['carrito']['productos']);
				}
				if($productos_tienda[$producto['id_tienda']]<=0){
					unset( $_SESSION['carrito']['tiendas'][$producto['id_tienda']]);
				}
				++$i;
			}
			$_SESSION['carrito']['productos']	= array_values($_SESSION['carrito']['productos']);
		}
	}

	public function vaciar()
	{
		unset($_SESSION['carrito']['productos']);
		$_SESSION['carrito']['productos']= array();
		unset($_SESSION['carrito']['tiendas']);
		$_SESSION['carrito']['tiendas']= array();
	}
	public function cantidad_productos_carrito()
	{
			// Conteo de los productos en el carrito
			$i = 0;
			foreach($_SESSION['carrito']['productos'] as $producto){
				$i += $producto['cantidad_producto'];
			}
			echo $i;
	}
	/* Pedido Final */

	public function pedido_final()
	{
		// Datos extra
		$this->data['usuario'] = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
		$this->data['detalles_direccion'] = $this->DireccionesModel->detalles($_GET['IdDireccion']);
		$this->data['direccion'] = $this->DireccionesModel->direccion_formateada($_GET['IdDireccion']);
		$this->data['importe_productos_abanico'] = $_GET['ImporteProductosParcial'];
		$this->data['importe_productos_total'] = $_GET['ImporteProductosTotal'];
		$this->data['envio_pedido_abanico'] = $_GET['ImporteEnvioParcial'];
		$this->data['envio_pedido_total'] = $_GET['ImporteEnvioTotal'];
		$this->data['pedido_tienda'] = $_GET['PedidoTienda'];
		$this->data['importe_descuento'] = $_GET['ImporteDescuento'];
		$this->data['descripcion_descuento'] = $_GET['DescripcionDescuento'];
		$this->data['importe_total'] = $_GET['ImporteTotal'];
		$this->data['id_transportista_abanico'] = $_GET['IdTransportistaAbanico'];
		$this->data['nombre_transportista_abanico'] = $_GET['NombreTransportistaAbanico'];
		$this->load->view($this->data['dispositivo'].'/tienda/pedido_armado',$this->data);

	}
}
