<?php
class UsuariosModel_bak extends CI_Model{

    public function get_usuarios(){
        if(!empty($this->input->get("search"))){
          $this->db->like('title', $this->input->get("search"));
          $this->db->or_like('description', $this->input->get("search"));
        }
        $query = $this->db->get("products");
        return $query->result();
    }


    public function id_usuario_existe($id){
      $this->db->where('ID_USUARIO',$id);
      $query = $this->db->get('usuarios');
      if ($query->num_rows() > 0){
          return true;
      }else{
          return false;
      }
    }

    public function varifico_usuario_pass($correo,$pass){
      // Verifico el correo
      $this->db->where('USUARIO_CORREO',$correo);
      $query = $this->db->get('usuarios',1);
      // Si el correo existe
      if ($query->num_rows() > 0){
        foreach ($query->result_array() as $row)
          {
            // Verifico la contraseña
            if(password_verify ($pass,$row['USUARIO_PASSWORD'])){
              return true;
            }else{
              return false;
            }
          }
      }else{
          return false;
      }
    }

    public function inicio_sesion($correo){
      $this->db->where('USUARIO_CORREO',$correo);
      $query = $this->db->get('usuarios',1);
      foreach ($query->result_array() as $row){
        $default_sesion = array(
          'usuario'=> array(
            'id'  => $row['ID_USUARIO'],
            'nombre'  => $row['USUARIO_NOMBRE'],
            'apellidos'  => $row['USUARIO_APELLIDOS'],
            'tipo_usuario'  => $row['USUARIO_TIPO}']
          )
        );
      }
      $this->session->set_userdata($default_sesion);
    }

    public function registrar($id_usuario,$tipo_usuario)
    {
        if(!isset($tipo_usuario)||empty($tipo_usuario)){
          $tipo_usuario = 'usr-1';
        }
        $pass = password_hash($this->input->post('PassUsuario'), PASSWORD_DEFAULT);
        $data = array(
            'ID_USUARIO'=> $id_usuario,
            'USUARIO_NOMBRE' => $this->input->post('NombreUsuario'),
            'USUARIO_APELLIDOS' => $this->input->post('ApellidosUsuario'),
            'USUARIO_CORREO' => $this->input->post('CorreoUsuario'),
            'USUARIO_TELEFONO' => $this->input->post('TelefonoUsuario'),
            'USUARIO_PASSWORD' => $pass,
						'USUARIO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
						'USUARIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
            'USUARIO_TIPO' => $tipo_usuario,
        );
        $this->db->insert('usuarios', $data);

    }

    public function actualizar($id_usuario)
    {
      if(!isset($tipo_usuario)||empty($tipo_usuario)){
        $tipo_usuario = 'usr-1';
      }
      $pass = password_hash($this->input->post('PassUsuario'), PASSWORD_DEFAULT);
      $data = array(
          'USUARIO_NOMBRE' => $this->input->post('NombreUsuario'),
          'USUARIO_APELLIDOS' => $this->input->post('ApellidosUsuario'),
          'USUARIO_CORREO' => $this->input->post('CorreoUsuario'),
          'USUARIO_TELEFONO' => $this->input->post('TelefonoUsuario'),
          'USUARIO_PASSWORD' => $pass,
          'USUARIO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
          'USUARIO_TIPO' => $tipo_usuario,
      );
      $this->db->where('id',$id);
      return $this->db->update('usuarios',$id_usuario);
    }

    public function get_tienda_usuario($id){
      $this->db->where('ID_USUARIO',$id);
      $query = $this->db->get('tiendas',1);

      return $query->result();
    }

    public function actualizar_tienda_usuario($id_tienda)
    {
      $data = array(
          'ID_USUARIO'=> $_SESSION['usuario']['id'],
          'TIENDA_NOMBRE' => $this->input->post('TiendaNombre'),
          'TIENDA_RAZON_SOCIAL' => $this->input->post('TiendaRazonSocial'),
          'TIENDA_RFC' => $this->input->post('TiendaRFC'),
          'TIENDA_TELEFONO' => $this->input->post('TiendaTelefono'),
          'TIENDA_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
          'ACTIVO'=>'1'
      );
        if(empty($id_tienda)){
            return $this->db->insert('tiendas',$data);
        }else{
            $this->db->where('ID_TIENDA',$id_tienda);
            return $this->db->update('tiendas',$data);
        }
    }

    public function crear_producto($id_usuario)
    {
        // reviso Información
        $id_usuario = $id_usuario;
        $nombre = $this->input->post('NombreProducto');
        $url = "";
        $descripcion = $this->input->post('DescripcionProducto');
        $detalles = $this->input->post('DetallesProducto');
        $modelo = $this->input->post('ModeloProducto');
        $origen = $this->input->post('OrigenProducto');

        if(!empty($this->input->post('SkuProducto'))){ $sku =$this->input->post('SkuProducto'); }else { $sku ="";};
        if(!empty($this->input->post('UpcProducto'))){ $upc =$this->input->post('UpcProducto'); }else { $upc ="";};
        if(!empty($this->input->post('EanProducto'))){ $ean =$this->input->post('EanProducto'); }else { $ean ="";};
        if(!empty($this->input->post('JanProducto'))){ $jan =$this->input->post('JanProducto'); }else { $jan ="";};
        if(!empty($this->input->post('IsbnProducto'))){ $isbn =$this->input->post('IsbnProducto'); }else { $isbn ="";};
        if(!empty($this->input->post('MpnProducto'))){ $mpn =$this->input->post('MpnProducto'); }else { $mpn ="";};

        $precio = $this->input->post('PrecioProducto');
        $cantidad = $this->input->post('CantidadProducto');
        $cantidad_minima = $this->input->post('CantidadMinimaProducto');
        $inventario = "1";
        $mensaje_sin_stock = "No disponible para venta";
        /*
        $fecha_registro = $this->input->post('NombreUsuario');
        $fecha_actualizacion = $this->input->post('NombreUsuario');
        $fecha_publicacion = $this->input->post('NombreUsuario');
        */
        $ancho = $this->input->post('AnchoProducto');
        $alto = $this->input->post('AltoProducto');
        $profundo = $this->input->post('ProfundoProducto');
        $peso = $this->input->post('PesoProducto');
        $estado = "activo";
        $orden = "1";

        $data = array(
            'ID_USUARIO'=> $id_usuario,
            'PRODUCTO_NOMBRE'=> $nombre,
            'PRODUCTO_URL'=> $url,
            'PRODUCTO_DESCRIPCION'=> $descripcion,
            'PRODUCTO_DETALLES'=> $detalles,
            'PRODUCTO_MODELO'=> $modelo,
            'PRODUCTO_ORIGEN'=> $origen,
            'PRODUCTO_SKU'=> $sku,
            'PRODUCTO_UPC'=> $upc,
            'PRODUCTO_EAN'=> $ean,
            'PRODUCTO_JAN'=> $jan,
            'PRODUCTO_ISBN'=> $isbn,
            'PRODUCTO_MPN'=> $mpn,
            'PRODUCTO_PRECIO'=> $precio,
            'PRODUCTO_CANTIDAD'=> $cantidad,
            'PRODUCTO_CANTIDAD_MINIMA'=> $cantidad_minima,
            'PRODUCTO_INVENTARIO'=> $inventario,
            'PRODUCTO_MENSAJE_SIN_STOCK'=> $mensaje_sin_stock,
            'PRODUCTO_FECHA_REGISTRO' => date('Y-m-d H:i:s'),
						'PRODUCTO_FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
            'PRODUCTO_FECHA_PUBLICACION' => date('Y-m-d H:i:s'),
            'PRODUCTO_ANCHO'=> $ancho,
            'PRODUCTO_ALTO'=> $alto,
            'PRODUCTO_PROFUNDO'=> $profundo,
            'PRODUCTO_PESO'=> $peso,
            'PRODUCTO_ESTADO'=> $estado,
            'ORDEN'=> $orden
        );
        $this->db->insert('productos', $data);

    }

    public function get_productos($id_usuario){
        $query = $this->db->where('ID_USUARIO',$id_usuario);
        $query = $this->db->get("productos");
        return $query->result();
    }
    public function get_detalles_producto($id_usuario,$id_producto){
        $query = $this->db->where('ID_USUARIO',$id_usuario);
        $query = $this->db->where('ID_PRODUCTO',$id_producto);
        $query = $this->db->get("productos");
        return $query->row_array();
    }

    public function borrar_producto($id_producto){
        $query = $this->db->where('ID_PRODUCTO',$id_producto);
        $query = $this->db->delete("productos");
    }
}
?>
