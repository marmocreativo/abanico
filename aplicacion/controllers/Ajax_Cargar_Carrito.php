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
			foreach($_SESSION['carrito']['productos'] as $producto){
				if($producto['id_producto']==$_POST['IdProducto']){
					if($_POST['CantidadProducto']<=0){
						unset( $_SESSION['carrito']['productos'][$i]);
					}else{
						if($_POST['CantidadProducto']>=$_POST['CantidadMaxima']){
							$_SESSION['carrito']['productos'][$i]['cantidad_producto'] = $_POST['CantidadMaxima'];
						}else{
							$_SESSION['carrito']['productos'][$i]['cantidad_producto'] = $_POST['CantidadProducto'];
						}
					}
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
	/* Pedido Final */

	public function pedido_final()
	{
		// Datos extra
		$usuario = $this->UsuariosModel->detalles($_SESSION['usuario']['id']);
		$detalles_direccion = $this->DireccionesModel->detalles($_GET['IdDireccion']);
		$direccion = $this->DireccionesModel->direccion_formateada($_GET['IdDireccion']);
		$importe_productos_abanico = $_GET['ImporteProductosParcial'];
		$importe_productos_total = $_GET['ImporteProductosTotal'];
		$envio_pedido_abanico = $_GET['ImporteEnvioParcial'];
		$envio_pedido_total = $_GET['ImporteEnvioTotal'];
		$pedido_tienda = $_GET['PedidoTienda'];
		$importe_total = $_GET['ImporteTotal'];
		$id_transportista_abanico = $_GET['IdTransportistaAbanico'];
		$nombre_transportista_abanico = $_GET['NombreTransportistaAbanico'];

		$_SESSION['pedido']['Folio'] = folio_pedido();
		$_SESSION['pedido']['IdUsuario'] = $_SESSION['usuario']['id'];
		$_SESSION['pedido']['PedidoNombre'] = $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];
		$_SESSION['pedido']['PedidoCorreo'] = $_SESSION['usuario']['correo'];
		$_SESSION['pedido']['PedidoTelefono'] = $usuario['USUARIO_TELEFONO'];
		$_SESSION['pedido']['IdDireccion'] = $detalles_direccion['ID_DIRECCION'];
		$_SESSION['pedido']['Direccion'] = $direccion;
		$_SESSION['pedido']['Divisa'] = $_SESSION['divisa']['iso'];
		$_SESSION['pedido']['Conversion'] = $_SESSION['divisa']['conversion'];
		$_SESSION['pedido']['ImporteProductosParcial'] = number_format($_SESSION['divisa']['conversion']*$importe_productos_abanico,2,'.', '');
		$_SESSION['pedido']['ImporteProductosTotal'] = number_format($_SESSION['divisa']['conversion']*$importe_productos_total,2,'.', '');
		$_SESSION['pedido']['ImporteEnvioParcial'] = number_format($_SESSION['divisa']['conversion']*$envio_pedido_abanico,2,'.', '');
		$_SESSION['pedido']['ImporteEnvioTotal'] = number_format($_SESSION['divisa']['conversion']*$envio_pedido_total,2,'.', '');
		$_SESSION['pedido']['PedidosTiendas'] = $pedido_tienda;
		$_SESSION['pedido']['ImporteTotal'] = number_format($_SESSION['divisa']['conversion']*$importe_total,2,'.', '');
		$_SESSION['pedido']['IdTransportista'] = $id_transportista_abanico;
		$_SESSION['pedido']['NombreTransportista'] = $nombre_transportista_abanico;
		$_SESSION['pedido']['FormaPago'] = 'PayPal';
		$_SESSION['pedido']['EstadoPago'] = 'Pagado';
		$_SESSION['pedido']['EstadoPedido'] = 'Pagado';
		echo '
		<table class="table table-bordered">
	    <tbody>
	      <tr>
	        <td class="text-right" style="width:75%"><b>'.$this->lang->line('proceso_pago_3_importe_productos').':</b></td>
	        <td>
	          <h5>
	          <small>'.$_SESSION['divisa']['signo'].'</small>
	          '.number_format($_SESSION['divisa']['conversion']*$_SESSION['pedido']['ImporteProductosTotal'],2).'
	          <small>'.$_SESSION['divisa']['iso'].'</small>
	          </h5>
	        </td>
	      </tr>
	      <tr>
	        <td class="text-right">
	          <b>Envio Total:</b><br> <span class="text-muted"></span>
	        </td>
	        <td>
	          <h5>
	          <small>'.$_SESSION['divisa']['signo'].'</small>
	          '.number_format($_SESSION['divisa']['conversion']*$_SESSION['pedido']['ImporteEnvioTotal'],2).'
	          <small>'.$_SESSION['divisa']['iso'].'</small>
	          </h5>
	        </td>
	      </tr>
	      <tr>
	        <td class="text-right" style="width:75%"><b>'.$this->lang->line('proceso_pago_3_total').':</b></td>
	        <td>
	          <h5>
						<small>'.$_SESSION['divisa']['signo'].'</small>
					 '.number_format($_SESSION['divisa']['conversion']*$_SESSION['pedido']['ImporteTotal'],2).'
					 <small>'.$_SESSION['divisa']['iso'].'</small>
	          </h5>
	        </td>
	      </tr>
	    </tbody>
	  </table>
		';

	}
}
