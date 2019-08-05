<?php
class TransportistasRangosModel extends CI_Model {
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
  function lista($id_transportista,$orden,$limite){
    $this->db->where('ID_TRANSPORTISTA',$id_transportista);
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('transportistas_rangos');
    return $query->result();
  }
  /*
  * Busqueda del mejor transportista
  */
  function mejor_precio($peso,$importe,$pais,$estado,$nivel){
    $this->db->select('transportistas.ID_TRANSPORTISTA, transportistas.TRANSPORTISTA_NOMBRE, transportistas.TRANSPORTISTA_TIEMPO_ENTREGA, transportistas_rangos.IMPORTE');
    $this->db->join('transportistas', 'transportistas.ID_TRANSPORTISTA = transportistas_rangos.ID_TRANSPORTISTA');
    $this->db->join('transportistas_disponibilidad', 'transportistas_disponibilidad.ID_TRANSPORTISTA = transportistas_rangos.ID_TRANSPORTISTA');
    $this->db->where('transportistas.PLAN_NIVEL <=',$nivel);
    $this->db->where('transportistas.TRANSPORTISTA_ESTADO','activo');
    $this->db->where('transportistas_rangos.PESO_MAX >=',$peso);
    $this->db->where('transportistas_rangos.IMPORTE_MIN <=',$importe);
    $this->db->where('transportistas_disponibilidad.TRANSPORTISTA_PAIS',$pais);
    $this->db->where('transportistas_disponibilidad.TRANSPORTISTA_ESTADO',$estado);
    $this->db->order_by('IMPORTE ASC');
    $this->db->limit(1);
    $query = $this->db->get('transportistas_rangos');
    return $query->row_array();;
  }
  function lista_mejor_precio($peso,$importe,$pais,$estado,$nivel){
      $this->db->select('transportistas.ID_TRANSPORTISTA, transportistas_rangos.ID AS RANGO, transportistas.TRANSPORTISTA_NOMBRE, transportistas.TRANSPORTISTA_TIEMPO_ENTREGA, transportistas_rangos.IMPORTE, transportistas_rangos.PESO_MAX');
      $this->db->join('transportistas', 'transportistas.ID_TRANSPORTISTA = transportistas_rangos.ID_TRANSPORTISTA');
      $this->db->join('transportistas_disponibilidad', 'transportistas_disponibilidad.ID_TRANSPORTISTA = transportistas_rangos.ID_TRANSPORTISTA');
      $this->db->where('transportistas.PLAN_NIVEL <=',$nivel);
      $this->db->where('transportistas.TRANSPORTISTA_ESTADO','activo');
      $this->db->where('transportistas_rangos.PESO_MAX >=',$peso);
      $this->db->where('transportistas_rangos.IMPORTE_MIN <=',$importe);
      $this->db->where('transportistas_disponibilidad.TRANSPORTISTA_PAIS',$pais);
      $this->db->where('transportistas_disponibilidad.TRANSPORTISTA_ESTADO',$estado);
      $this->db->where('transportistas_disponibilidad.TRANSPORTISTA_ESTADO',$estado);
      $this->db->group_by('transportistas_rangos.ID_TRANSPORTISTA');
      $this->db->order_by('IMPORTE ASC');
    $query = $this->db->get('transportistas_rangos');
    return $query->result();
  }
  /*
  * Detalles de una sola entrada
  */
  function detalles($id){
    return $this->db->get_where('transportistas_rangos',array('ID'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('transportistas_rangos',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID',$id);
    return $this->db->update('transportistas_rangos',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('transportistas_rangos',array('ID'=>$id));
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
    $this->db->where('ID_TRANSPORTISTA',$id);
    return $this->db->update('transportistas_rangos',array('TRANSPORTISTA_ESTADO'=>$activo));
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */

}
?>
