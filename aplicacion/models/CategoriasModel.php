<?php
class CategoriasModel extends CI_Model {
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
  function lista($parametros,$tipo_categoria,$orden,$limite){
    if(!empty($parametros)){
      $this->db->where($parametros);
    }
    if(!empty($tipo_categoria)){
      $this->db->where('CATEGORIA_TIPO', $tipo_categoria);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('categorias');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('categorias',array('ID_CATEGORIA'=>$id))->row_array();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles_slug($id){
    return $this->db->get_where('categorias',array('CATEGORIA_URL'=>$id))->row_array();
  }
  /*
    * Verificar URI
 */
 function verificar_uri($url){
   $usuario = $this->db->get_where('categorias',array('CATEGORIA_URL'=>$url))->row_array();
   if(!empty($usuario)){ return TRUE; }else{ return FALSE; }
 }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('categorias',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_CATEGORIA',$id);
    return $this->db->update('categorias',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('categorias',array('ID_CATEGORIA'=>$id));
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
    $this->db->where('ID_CATEGORIA',$id);
    return $this->db->update('categorias',array('CATEGORIA_ESTADO'=>$activo));
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$activo){
    $this->db->where('ID_CATEGORIA',$id);
    return $this->db->update('categorias',array('CATEGORIA_ESTADO'=>$activo));
  }
  /*
    * Creo el orden de los elementos
    * $orden son los identificadores de las entradas en el orden en que quiero que aparezcan
 */
  function ordenar($orden){
    $i = 0;
    foreach($orden as $orden){
      $this->db->where('ID_CATEGORIA',$orden);
      return $this->db->update('categorias',array('ORDEN'=>$i));
      $i++;
    }
  }

}
?>
