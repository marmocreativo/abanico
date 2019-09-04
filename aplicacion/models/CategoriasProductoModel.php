<?php
class CategoriasProductoModel extends CI_Model {
  function __construct()
  {
      parent::__construct();
      // Función Construct
  }
  /*
    * Enlisto todas las entradas
 */
  function lista($id_producto){
    $query = $this->db->get_where('categorias_productos',array('ID_PRODUCTO'=>$id_producto));
    return $query->result();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('categorias_productos',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('categorias_productos',array('ID_PRODUCTO'=>$id));
  }

}
?>
