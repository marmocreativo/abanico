<?php
class ConversacionesModel extends CI_Model {
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
  function lista($id_usuario){
    $this->db->select('usuarios.USUARIO_NOMBRE, usuarios.USUARIO_APELLIDOS ,conversaciones.*');
    $this->db->join('usuarios', 'usuarios.ID_USUARIO = conversaciones.ID_RECEPTOR');
    $this->db->where('ID_RECEPTOR',$id_usuario);
      $this->db->order_by('CONVERSACION_FECHA_CREACION','DESC');
    $query = $this->db->get('conversaciones');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    $this->db->select('usuarios.USUARIO_NOMBRE, usuarios.USUARIO_APELLIDOS ,conversaciones.*');
    $this->db->join('usuarios', 'usuarios.ID_USUARIO = conversaciones.ID_RECEPTOR');
    return $this->db->get_where('conversaciones',array('ID_CONVERSACION'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('conversaciones',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_CONVERSACION',$id);
    return $this->db->update('conversaciones',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('conversaciones',array('ID_CONVERSACION'=>$id));
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
    $this->db->where('ID_CONVERSACION',$id);
    return $this->db->update('conversaciones',array('CONVERSACION_ESTADO'=>$activo));
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$activo){
    $this->db->where('ID_CONVERSACION',$id);
    return $this->db->update('conversaciones',array('CONVERSACION_ESTADO'=>$activo));
  }
  /*
    * Creo el orden de los elementos
    * $orden son los identificadores de las entradas en el orden en que quiero que aparezcan
 */
  function ordenar($orden){
    $i = 0;
    foreach($orden as $orden){
      $this->db->where('ID_CONVERSACION',$orden);
      return $this->db->update('conversaciones',array('ORDEN'=>$i));
      $i++;
    }
  }

}
?>