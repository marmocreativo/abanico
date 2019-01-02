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
  function lista($ID_USUARIO,$orden,$limite){
    if(!empty($ID_USUARIO)){
      $this->db->where('ID_USUARIO', $ID_USUARIO);
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
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('adjuntos_usuarios',array('ID_GALERIA'=>$id))->row_array();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function adjuntos_usuario($id){
    $this->db->where('ID_USUARIO'=>$id);
    $query = $this->db->get('adjuntos_usuarios');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function adjuntos_usuario_tipo($id,$tipo){
    $this->db->where('ID_USUARIO'=>$id);
    $this->db->where('ADJUNTO_TIPO'=>$id);
    $query = $this->db->get('adjuntos_usuarios');
    return $query->result();
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
    return $this->db->delete('adjuntos_usuarios',array('ID_GALERIA'=>$id));
  }

  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function portada($ID_USUARIO,$id){
    $this->db->where('ID_USUARIO',$ID_USUARIO);
    $this->db->update('adjuntos_usuarios',array('GALERIA_PORTADA'=>'no'));
    $this->db->reset_query();
    $this->db->where('ID_GALERIA',$id);
    $this->db->update('adjuntos_usuarios',array('GALERIA_PORTADA'=>'si'));
  }
  /*
    * Creo el orden de los elementos
    * $orden son los identificadores de las entradas en el orden en que quiero que aparezcan
 */
  function ordenar($orden){
    $i = 0;
    foreach($orden as $orden){
      $this->db->where('ID_GALERIA',$orden);
      return $this->db->update('adjuntos_usuarios',array('ORDEN'=>$i));
      $i++;
    }
  }

}
?>
