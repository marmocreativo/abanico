<?php
class CategoriasServiciosModel extends CI_Model {
  function __construct()
  {
      parent::__construct();
      // Función Construct
  }
  /*
    * Enlisto todas las entradas
 */
  function lista($id_producto){
    return $this->db->get_where('categorias_servicios',array('ID_SERVICIO'=>$id_producto))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('categorias_servicios',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('categorias_servicios',array('ID_SERVICIO'=>$id));
  }

}
?>
