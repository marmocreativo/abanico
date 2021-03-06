<?php
class TiendasModel extends CI_Model {
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
  function lista($parametros,$id_usuario,$orden,$limite){
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($id_usuario)){
      $this->db->where('ID_USUARIO', $id_usuario);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $this->db->where('TIENDA_ESTADO !=','borrada');
    $query = $this->db->get('tiendas');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('tiendas',array('ID_TIENDA'=>$id))->row_array();
  }

  public function tienda_usuario($id){
      return $this->db->get_where('tiendas',array('ID_USUARIO'=>$id),1)->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('tiendas',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_TIENDA',$id);
    return $this->db->update('tiendas',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('tiendas',array('ID_TIENDA'=>$id));
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
    $this->db->where('ID_TIENDA',$id);
    return $this->db->update('tiendas',array('TIENDA_ESTADO'=>$activo));
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$activo){
    $this->db->where('USUARIO_ESTADO',$id);
    return $this->db->update('tiendas',array('USUARIO_ESTADO'=>$activo));
  }
  /*
    * Creo el orden de los elementos
    * $orden son los identificadores de las entradas en el orden en que quiero que aparezcan
 */
  function ordenar($orden){
  }

  /*
    * Funciones de Verificación
  */
  public function id_usuario_existe($id){
    $this->db->where('ID_USUARIO',$id);
    $query = $this->db->get('tiendas');
    if ($query->num_rows() > 0){
        return true;
    }else{
        return false;
    }
  }

}
?>
