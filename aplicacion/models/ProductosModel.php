<?php
class ProductosModel extends CI_Model {
  function __construct()
  {
      parent::__construct();
      // Función Construct
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function lista($parametros,$id_usuario,$orden,$limite){
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($id_usuario)){
      $this->db->where('ID_USUARIO', $id_usuario);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('productos');
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function lista_activos($parametros,$id_usuario,$orden,$limite){
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($id_usuario)){
      $this->db->where('ID_USUARIO', $id_usuario);
    }
    $this->db->order_by('ID_PRODUCTO','RANDOM');
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $this->db->where('PRODUCTO_ESTADO', 'activo');
    $query = $this->db->get('productos');
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function lista_categoria_activos($parametros,$id_CATEGORIA,$orden,$limite){
    // Join
    $this->db->join('categorias_productos', 'productos.ID_PRODUCTO = categorias_productos.ID_PRODUCTO');
    // Parametros
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($id_CATEGORIA)){
      $this->db->where('ID_CATEGORIA', $id_CATEGORIA);
    }
      $this->db->order_by('ID_PRODUCTO','RANDOM');
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $this->db->where('PRODUCTO_ESTADO', 'activo');
    $query = $this->db->get('productos');
    return $query->result();
  }
  /*
    * Conteo de productos
 */
  function conteo_productos_usuario($id_usuario){

    $this->db->where('ID_USUARIO',$id_usuario);
    $query = $this->db->count_all_results('productos');
    return $query;
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function lista_favoritos_activos($favoritos){

    $this->db->where_in('ID_PRODUCTO',$favoritos);
    $this->db->order_by('PRODUCTO_FECHA_PUBLICACION','DESC');
    $this->db->where('PRODUCTO_ESTADO', 'activo');
    $query = $this->db->get('productos');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('productos',array('ID_PRODUCTO'=>$id))->row_array();
  }
  function detalles_tienda_usuario($id){
    return $this->db->get_where('productos',array('ID_USUARIO'=>$id))->row_array();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
  */
   function detalles_slug($id){
     return $this->db->get_where('productos',array('PRODUCTO_URL'=>$id))->row_array();
   }
   /*
     * Verificar URI
  */
  function verificar_uri($url){
    $usuario = $this->db->get_where('productos',array('PRODUCTO_URL'=>$url))->row_array();
    if(!empty($usuario)){ return TRUE; }else{ return FALSE; }
  }
  /*
    * Creo una nueva entrada usando los parámetros
  */
  function crear($parametros){
    $this->db->insert('productos',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_PRODUCTO',$id);
    return $this->db->update('productos',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('productos',array('ID_PRODUCTO'=>$id));
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar_productos_usuario($id){
    return $this->db->delete('productos',array('ID_USUARIO'=>$id));
  }
  /*
    * Interruptor cambia el estado de una entrada de activo a inactivo
    * $id es el identificador de la entrada
    * $activo es el estado actual de la entrada
 */
  function activar($id,$activo){

    switch($activo){
      case "activo":
        $activo = "inactivo";
      break;
      case "inactivo":
        $activo = "activo";
      break;
      default:
        $activo = "activo";
      break;
    }
    $this->db->where('ID_PRODUCTO',$id);
    return $this->db->update('productos',array('PRODUCTO_ESTADO'=>$activo));
  }
  /*
    * Desactivar servicios de un Usuario
 */
  function descativar_productos_usuario($id){
    $this->db->where('ID_USUARIO',$id);
    return $this->db->update('productos',array('PRODUCTO_ESTADO'=>'inactivo'));
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$activo){
    $this->db->where('PRODUCTO_ESTADO',$id);
    return $this->db->update('productos',array('PRODUCTO_ESTADO'=>$activo));
  }
  /*
    * Creo el orden de los elementos
    * $orden son los identificadores de las entradas en el orden en que quiero que aparezcan
 */
  function ordenar($orden){
  }

  /*
    * Funciones de Verificación
  */
  public function id_usuario_existe($id){
    $this->db->where('ID_USUARIO',$id);
    $query = $this->db->get('productos');
    if ($query->num_rows() > 0){
        return true;
    }else{
        return false;
    }
  }

}
?>
