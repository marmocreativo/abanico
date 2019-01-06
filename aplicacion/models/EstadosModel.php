<?php
class EstadosModel extends CI_Model {
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
    $query = $this->db->get('estados');
    return $query->result();
  }
  /*
  * Lista de estados asignados a un país
  */
  function estados_del_pais($id_pais){
    $this->db->where('ID_PAIS',$id_pais);
    $this->db->order_by('ESTADO_NOMBRE','ASC');
    $query = $this->db->get('estados');
    return $query->result();
  }

  /*
  * Obtengo el Estado y el país usando el nombre del estado
  */
  function datos_por_estado($estado){
    $this->db->select('PAIS_NOMBRE, ESTADO_NOMBRE');
    $this->db->join('paises', 'paises.ID_PAIS = estados.ID_PAIS');
    $this->db->where('estados.ESTADO_NOMBRE',$estado);
    $query = $this->db->get('estados');
    return $query->row_array();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('estados',array('ID_ESTADO'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('estados',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_ESTADO',$id);
    return $this->db->update('estados',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('estados',array('ID_ESTADO'=>$id));
  }
  /*
    * Interruptor cambia el estado de una entrada de activo a inactivo
    * $id es el identificador de la entrada
    * $activo es el estado actual de la entrada
 */
  function activar($id,$activo){

    switch($activo){
      case "activo":
        $activo = "inactivo";
      break;
      case "inactivo":
        $activo = "activo";
      break;
      default:
        $activo = "activo";
      break;
    }
    $this->db->where('ID_ESTADO',$id);
    return $this->db->update('estados',array('ESTADO_ESTADO'=>$activo));
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$activo){
    $this->db->where('ID_ESTADO',$id);
    return $this->db->update('estados',array('PAIS_ESTADO'=>$activo));
  }
  /*
    * Creo el orden de los elementos
    * $orden son los identificadores de las entradas en el orden en que quiero que aparezcan
 */
  function ordenar($orden){
    $i = 0;
    foreach($orden as $orden){
      $this->db->where('ID_ESTADO',$orden);
      return $this->db->update('estados',array('ORDEN'=>$i));
      $i++;
    }
  }

}
?>
