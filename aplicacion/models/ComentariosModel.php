<?php
class ComentariosModel extends CI_Model {
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
    $query = $this->db->get('comentarios');
    return $query->result();
  }
  /*
    * Enlisto los comentarios de un usuario de una categoría en específico
 */
  function comentarios_usuario($id,$objeto){
    $this->db->where('ID_USUARIO',$id);
      $this->db->where('COMENTARIO_TIPO',$objeto);
    $query = $this->db->get('comentarios');
    return $query->result();
  }
  /*
    * Enlisto los comentarios de un usuario de una categoría en específico
 */
  function comentarios_objeto($id,$objeto){
    $this->db->where('ID_OBJETO',$id);
      $this->db->where('COMENTARIO_PADRE','0');
      $this->db->where('COMENTARIO_TIPO',$objeto);
      $this->db->order_by('COMENTARIO_FECHA_REGISTRO','DESC');
    $query = $this->db->get('comentarios');
    return $query->result();
  }
  /*
    * Enlisto los comentarios de un usuario de una categoría en específico
 */
  function respuestas_comentario($id_padre,$objeto){
      $this->db->where('COMENTARIO_PADRE',$id_padre);
      $this->db->where('COMENTARIO_TIPO',$objeto);
      $this->db->order_by('COMENTARIO_FECHA_REGISTRO','ASC');
    $query = $this->db->get('comentarios');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id,$id_usuario,$objeto){
    return $this->db->get_where('comentarios',array('ID_USUARIO'=>$id_usuario,'ID_OBJETO'=>$id,'COMENTARIO_TIPO'=>$objeto))->row_array();
  }

  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('comentarios',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$estado){
    $this->db->where('ID_COMENTARIO',$id);
    return $this->db->update('comentarios',array('COMENTARIO_ESTADO'=>$estado));
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('comentarios',array('ID_COMENTARIO'=>$id));
  }

}
?>
