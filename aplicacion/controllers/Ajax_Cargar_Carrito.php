<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Cargar_Carrito extends CI_Controller {

	public function __construct(){
    parent::__construct();

		if($this->agent->is_mobile()){
			$this->data['dispositivo']  = "mobile";
		}else{
			$this->data['dispositivo']  = "desktop";
		}
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
			foreach($_SESSION['carrito']['productos'] as $producto){
				if($producto['id_producto']==$_POST['IdProducto']&&$producto['detalles_producto']==$_POST['DetallesProducto']){
					$cantidad_anterior = $_SESSION['carrito']['productos'][$i]['cantidad_producto'];
					$cantidad_nueva = $_SESSION['carrito']['productos'][$i]['cantidad_producto'] - 1;
					if($cantidad_nueva<=0){
						//
						unset( $_SESSION['carrito']['tiendas'][$_SESSION['carrito']['productos'][$i]['id_tienda']]);
						unset( $_SESSION['carrito']['productos'][$i]);
						$_SESSION['carrito']['productos'] = array_values($_SESSION['carrito']['productos']);
					}else{
						$_SESSION['carrito']['productos'][$i]['cantidad_producto'] = $cantidad_nueva;
					}
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
					$_SESSION['carrito']['productos'][$i]['cantidad_producto'] += 1;
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
			foreach($_SESSION['carrito']['productos'] as $producto){
				if($producto['id_producto']==$_POST['IdProducto']){
					if($_POST['CantidadProducto']<=0){ unset( $_SESSION['carrito']['productos'][$i]); }else{$_SESSION['carrito']['productos'][$i]['cantidad_producto'] = $_POST['CantidadProducto'];  }
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
			foreach($_SESSION['carrito']['productos'] as $producto){
				if($producto['id_producto']==$_POST['IdProducto']&&$producto['detalles_producto']==$_POST['DetallesProducto']){
					unset( $_SESSION['carrito']['tiendas'][$_SESSION['carrito']['productos'][$i]['id_tienda']]);
					unset( $_SESSION['carrito']['productos'][$i]);
					$_SESSION['carrito']['productos'] = array_values($_SESSION['carrito']['productos']);
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
}
