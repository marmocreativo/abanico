<?php
class AdjuntosUsuariosModel extends CI_Model {
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
  function lista($id_usuario,$orden,$limite){
    if(!empty($ID_USUARIO)){
      $this->db->where('ID_USUARIO', $id_usuario);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('adjuntos_usuarios');
    return $query->result();
  }
  /*
  * Lista de usuarios por tipo de usuario
  */
  function lista_archivos_adjuntos($id_usuario,$id_objeto,$tipo){
    $this->db->where('ID_USUARIO', $id_usuario);
    $this->db->where('ID_OBJETO', $id_objeto);
    $this->db->where('ADJUNTO_TIPO', $tipo);
    $query = $this->db->get('adjuntos_usuarios');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('adjuntos_usuarios',array('ID_ADJUNTO'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('adjuntos_usuarios',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('adjuntos_usuarios',array('ID_ADJUNTO'=>$id));
  }

}
?>
