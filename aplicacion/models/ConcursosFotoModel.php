<?php
class ConcursosFotoModel extends CI_Model {
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
    $query = $this->db->get('concurso_foto');
    return $query->result();
  }

  // Concursantes
  function entradas($id_concurso){

    $this->db->where('ID_CONCURSO',$id_concurso);
    $query = $this->db->get('concurso_foto_entradas');
    return $query->result();
  }

  function mi_entrada($id_concurso,$id_usuario){
    $this->db->where('ID_USUARIO',$id_usuario);
    $this->db->where('ID_CONCURSO',$id_concurso);
    $query = $this->db->get('concurso_foto_entradas');
    return $query->result();
  }


  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('concurso_foto',array('ID'=>$id))->row_array();
  }

  function activo(){
    return $this->db->get_where('concurso_foto',array(
      'FECHA_INICIO <='=>date('Y-m-d H:i:s'),
      'FECHA_FIN >='=>date('Y-m-d H:i:s')
    ))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('concurso_foto',$parametros);
    return $this->db->insert_id();
  }

  function crear_entrada($parametros){
    $this->db->insert('concurso_foto_entradas',$parametros);
    return $this->db->insert_id();
  }

  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID',$id);
    return $this->db->update('concurso_foto',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('concurso_foto',array('ID'=>$id));
  }

}
?>
