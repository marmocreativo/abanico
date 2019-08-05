<?php
class TransportistasRestriccionesModel extends CI_Model {
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
  function lista($id_transportista,$tipo,$limite){
    $this->db->where('ID_TRANSPORTISTA',$id_transportista);
    if(!empty($tipo)){
      $this->db->where('TIPO_OBJETO',$tipo);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('transportistas_restricciones');
    return $query->result();
  }
  /*
  * Detalles de una sola entrada
  */
  function detalles($id){
    return $this->db->get_where('transportistas_restricciones',array('ID_RESTRICCION'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('transportistas_restricciones',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_RESTRICCION',$id);
    return $this->db->update('transportistas_restricciones',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('transportistas_restricciones',array('ID_RESTRICCION'=>$id));
  }

}
?>
