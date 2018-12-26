<?php
class GaleriasModel extends CI_Model {
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
  function lista($id_producto,$orden,$limite){
    if(!empty($id_producto)){
      $this->db->where('ID_PRODUCTO', $id_producto);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('galeria_productos');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('galeria_productos',array('ID_GALERIA'=>$id))->row_array();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function galeria_portada($id){
    return $this->db->get_where('galeria_productos',array('ID_PRODUCTO'=>$id,'GALERIA_PORTADA'=>'si'))->row_array();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function galeria_producto($id){
    return $this->db->get_where('galeria_productos',array('ID_PRODUCTO'=>$id))->result();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('galeria_productos',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('galeria_productos',array('ID_GALERIA'=>$id));
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar_todo_de($id){
    return $this->db->delete('galeria_productos',array('ID_PRODUCTO'=>$id));
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
    $this->db->where('ID_GALERIA',$id);
    return $this->db->update('galeria_productos',array('GALERIA_ESTADO'=>$activo));
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function portada($id_producto,$id){
    $this->db->where('ID_PRODUCTO',$id_producto);
    $this->db->update('galeria_productos',array('GALERIA_PORTADA'=>'no'));
    $this->db->reset_query();
    $this->db->where('ID_GALERIA',$id);
    $this->db->update('galeria_productos',array('GALERIA_PORTADA'=>'si'));
  }
  /*
    * Creo el orden de los elementos
    * $orden son los identificadores de las entradas en el orden en que quiero que aparezcan
 */
  function ordenar($orden){
    $i = 0;
    foreach($orden as $orden){
      $this->db->where('ID_GALERIA',$orden);
      return $this->db->update('galeria_productos',array('ORDEN'=>$i));
      $i++;
    }
  }

}
?>
