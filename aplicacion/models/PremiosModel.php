<?php
class PremiosModel extends CI_Model {
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
    //$this->db->join('usuarios', 'usuarios.ID_USUARIO = premios.PREMIO_GANADOR');
    $query = $this->db->get('premios');
    return $query->result();
  }
  /*
    * Verificar URI
 */
 function verificar_ganador(){
   $this->db->order_by('PREMIO_FECHA_DISPONIBLE', 'DESC');
   $publicacion = $this->db->get_where('premios',array(
     'PREMIO_FECHA_DISPONIBLE <='=>date('Y-m-d'),
     'PREMIO_GANADOR !='=>0,
   ))->row_array();
   if(!empty($publicacion)){ return TRUE; }else{ return FALSE; }
 }

 /*
   * Obtengo todos los detalles de una sola entrada
*/
 function ultimo_ganador(){
   $this->db->order_by('PREMIO_FECHA_DISPONIBLE', 'DESC');
   return $this->db->get_where('premios',array(
     'PREMIO_FECHA_DISPONIBLE <='=>date('Y-m-d'),
     'PREMIO_GANADOR !='=>0,
   ))->row_array();
 }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('premios',array('ID_PREMIO'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('premios',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_PREMIO',$id);
    return $this->db->update('premios',$parametros);
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function guardar_ganador($id,$id_ganador){
    $this->db->where('ID_PREMIO',$id);
    return $this->db->update('premios',['PREMIO_GANADOR'=>$id_ganador]);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('premios',array('ID_PREMIO'=>$id));
  }
  /*
    * Interruptor cambia el estado de una entrada de activo a inactivo
    * $id es el identificador de la entrada
    * $activo es el estado actual de la entrada
 */
  function activar($id,$activo){

    switch($activo){
      case "pendiente":
        $activo = "entregado";
      break;
      case "entregado":
        $activo = "pendiente";
      break;
      default:
        $activo = "pendiente";
      break;
    }
    $this->db->where('ID_PREMIO',$id);
    return $this->db->update('premios',array('PREMIO_ESTADO'=>$activo));
  }

  /*
    * Creo el orden de los elementos
    * $orden son los identificadores de las entradas en el orden en que quiero que aparezcan
 */
  function ordenar($orden){
    $i = 0;
    foreach($orden as $orden){
      $this->db->where('ID_PREMIO',$orden);
      return $this->db->update('premios',array('ORDEN'=>$i));
      ++$i;
    }
  }

}
?>
