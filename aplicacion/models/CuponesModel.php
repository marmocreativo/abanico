<?php
class CuponesModel extends CI_Model {
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
    $query = $this->db->get('cupones');
    return $query->result();
  }

  function lista_usuario($id_usuario){
      $this->db->where('ID_USUARIO',$id_usuario);
    $query = $this->db->get('cupones_pedidos');
    return $query->result();
  }
  function lista_pedidos($folio_pedido){
      $this->db->where('FOLIO_PEDIDO',$folio_pedido);
    $query = $this->db->get('cupones_pedidos');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('cupones',array('ID'=>$id))->row_array();
  }

  function detalles_codigo($codigo){
    $this->db->where('FECHA_INICIO <',date('Y-m-d H:i:s'));
    $this->db->where('FECHA_FINAL >',date('Y-m-d H:i:s'));
    $this->db->where('CODIGO',$codigo);
    return $this->db->get_where('cupones',array('CODIGO'=>$codigo))->row_array();
  }

  function detalles_pedido($folio_pedido){
    return $this->db->get_where('cupones_pedidos',array('FOLIO_PEDIDO'=>$folio_pedido))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('cupones',$parametros);
    return $this->db->insert_id();
  }
  function crear_en_pedido($parametros){
    $this->db->insert('cupones_pedidos',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID',$id);
    return $this->db->update('cupones',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('cupones',array('ID'=>$id));
  }

}
?>
