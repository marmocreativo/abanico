<?php
class DevolucionesModel extends CI_Model {
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
  function lista($id_pedido){
    $this->db->where('ID_PEDIDO',$id_pedido);
    $query = $this->db->get('devoluciones');
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function todas_las_devoluciones($orden){
    $this->db->join('pedidos', 'devoluciones.ID_PEDIDO = pedidos.ID_PEDIDO');
    $this->db->order_by($orden);
    $query = $this->db->get('devoluciones');
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function devoluciones_usuario($id_usuario,$orden){
    $this->db->join('pedidos', 'devoluciones.ID_PEDIDO = pedidos.ID_PEDIDO');
    $this->db->where('ID_USUARIO',$id_usuario);
    $this->db->order_by($orden);
    $query = $this->db->get('devoluciones');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('devoluciones',array('ID_PEDIDO'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('devoluciones',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_DEVOLUCION',$id);
    return $this->db->update('devoluciones',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('devoluciones',array('ID_DEVOLUCION'=>$id));
  }

}
?>
