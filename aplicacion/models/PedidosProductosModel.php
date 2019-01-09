<?php
class PedidosProductosModel extends CI_Model {
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
  function lista($parametros,$orden,$limite){
      $this->db->where($parametros);
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('pedidos_productos');
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function lista_usuario($parametros,$id_usuario,$orden,$limite){
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($id_usuario)){
      $this->db->where('ID_USUARIO',$id_usuario);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('pedidos_productos');
    return $query->result();
  }
  /*
  * Conteo
  */
  function conteo_productos_pedido($id_pedido){

    $this->db->where('ID_PEDIDO',$id_pedido);
    $this->db->select_sum('CANTIDAD');
    $query = $this->db->get('pedidos_productos');
    return $query->row();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('pedidos_productos',array('ID_PEDIDO'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('pedidos_productos',$parametros);
    return $this->db->insert_id();
  }

}
?>
