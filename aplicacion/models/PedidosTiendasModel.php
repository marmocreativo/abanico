<?php
class PedidosTiendasModel extends CI_Model {
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
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('pedidos_tiendas');
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function lista_tiendas($id_pedido){
    $this->db->select('tiendas.*,pedidos_tiendas.*');
    $this->db->join('tiendas','pedidos_tiendas.ID_TIENDA = tiendas.ID_TIENDA');
    $this->db->where('ID_PEDIDO',$id_pedido);
    $query = $this->db->get('pedidos_tiendas');
    return $query->result();
  }

  function lista_pedidos_tienda($id_tienda){
    $this->db->select('tiendas.*,pedidos.*,pedidos_tiendas.*');
    $this->db->join('pedidos','pedidos_tiendas.ID_PEDIDO = pedidos.ID_PEDIDO');
    $this->db->join('tiendas','pedidos_tiendas.ID_TIENDA = tiendas.ID_TIENDA');
    $this->db->where('pedidos_tiendas.ID_TIENDA',$id_tienda);
    $query = $this->db->get('pedidos_tiendas');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id_pedido,$id_tienda){
    return $this->db->get_where('pedidos_tiendas',array('ID_PEDIDO'=>$id_pedido,'ID_TIENDA'=>$id_tienda))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('pedidos_tiendas',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID',$id);
    return $this->db->update('pedidos_tiendas',$parametros);
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$activo){
    $this->db->where('ID',$id);
    return $this->db->update('pedidos_tiendas',array('PAIS_ESTADO'=>$activo));
  }

}
?>
