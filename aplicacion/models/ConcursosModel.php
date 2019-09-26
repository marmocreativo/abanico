<?php
class ConcursosModel extends CI_Model {
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
    $query = $this->db->get('concurso');
    return $query->result();
  }

  // Concursantes
  function concursantes($id_concurso,$parametros,$orden,$limite){
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $this->db->where('ID_CONCURSO',$id_concurso);
    $this->db->group_by('ID_USUARIO');
    $query = $this->db->get('concurso_historial');
    return $query->result();
  }

  // Historial
  // Concursantes
  function historial($id_concurso,$id_usuario){
    $this->db->order_by('FECHA_REGISTRO ASC');
    $this->db->where('ID_CONCURSO',$id_concurso);
    $this->db->where('ID_USUARIO',$id_usuario);
    $query = $this->db->get('concurso_historial');
    return $query->result();
  }

  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('concurso',array('ID'=>$id))->row_array();
  }

  function activo(){
    return $this->db->get_where('concurso',array(
      'FECHA_INICIO <='=>date('Y-m-d H:i:s'),
      'FECHA_FIN >='=>date('Y-m-d H:i:s')
    ))->row_array();
  }
  function ganador($id){
    return $this->db->get_where('concurso',array(
      'ID'=>$id,
      'FECHA_INICIO <='=>date('Y-m-d H:i:s'),
      'FECHA_FIN >='=>date('Y-m-d H:i:s')
    ))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('concurso',$parametros);
    return $this->db->insert_id();
  }

  function crear_historial($parametros){
    $this->db->insert('concurso_historial',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID',$id);
    return $this->db->update('concurso',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('concurso',array('ID'=>$id));
  }

}
?>
