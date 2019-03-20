<?php
class PublicacionesModel extends CI_Model {
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
    $query = $this->db->get('publicaciones');
    return $query->result();
  }
  /*
    * Verificar URI
 */
 function verificar_uri($url){
   $publicacion = $this->db->get_where('publicaciones',array('PUBLICACION_URL'=>$url))->row_array();
   if(!empty($publicacion)){ return TRUE; }else{ return FALSE; }
 }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('publicaciones',array('ID_PUBLICACION'=>$id))->row_array();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles_urk($url){
    return $this->db->get_where('publicaciones',array('PUBLICACION_URL'=>$url))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('publicaciones',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_PUBLICACION',$id);
    return $this->db->update('publicaciones',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('publicaciones',array('ID_PUBLICACION'=>$id));
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
    $this->db->where('ID_PUBLICACION',$id);
    return $this->db->update('publicaciones',array('PUBLICACION_ESTADO'=>$activo));
  }

  /*
    * Creo el orden de los elementos
    * $orden son los identificadores de las entradas en el orden en que quiero que aparezcan
 */
  function ordenar($orden){
    $i = 0;
    foreach($orden as $orden){
      $this->db->where('ID_PUBLICACION',$orden);
      return $this->db->update('publicaciones',array('ORDEN'=>$i));
      ++$i;
    }
  }

}
?>
