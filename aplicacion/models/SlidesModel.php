<?php
class SlidesModel extends CI_Model {
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
  function lista(){
    $query = $this->db->get('slides');
    return $query->result();
  }/*
    * Enlisto todas las entradas de un slide
 */
  function lista_activos($id_slider){
    $query = $this->db->where('ID_SLIDER',$id_slider);
    $query = $this->db->where('SLIDE_ESTADO','activo');
    $query = $this->db->order_by('ORDEN','ASC');
    $query = $this->db->get('slides');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('slides',array('ID_SLIDE'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('slides',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('slides',array('ID_SLIDE'=>$id));
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
    $this->db->where('ID_SLIDE',$id);
    return $this->db->update('slides',array('SLIDE_ESTADO'=>$activo));
  }

}
?>
